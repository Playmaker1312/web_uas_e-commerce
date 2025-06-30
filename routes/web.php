<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Models\ZakiProduct;
use App\Models\ZakiCategory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

// Register routes
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'user',
    ]);
    // Redirect to login with success message
    return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
});

// Login routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        $role = Auth::user()->role;
        if ($role === 'admin') {
            return redirect('/dashboard');
        } else {
            return redirect('/home');
        }
    }
    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
});

// Logout route
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Admin dashboard (admin only)
Route::get('/dashboard', function () {
    // Statistik
    $totalPenjualanHari = \App\Models\ZakiOrder::whereDate('created_at', today())->sum('total');
    $totalPenjualanBulan = \App\Models\ZakiOrder::whereMonth('created_at', now()->month)->sum('total');
    $orderBaru = \App\Models\ZakiOrder::whereDate('created_at', today())->where('status', 'pending')->count();
    $userCount = \App\Models\User::count();
    $produkTerlaris = \App\Models\ZakiProduct::withCount(['orderItems as terjual' => function($q){ $q->select(\DB::raw('sum(quantity)')); }])->orderByDesc('terjual')->first();
    $produkStokMenipis = \App\Models\ZakiProduct::where('stock', '<', 5)->get();
    $orderTerbaru = \App\Models\ZakiOrder::with('user')->orderByDesc('created_at')->take(5)->get();
    $orderPending = \App\Models\ZakiOrder::where('status', 'pending')->orderByDesc('created_at')->get();
    // Grafik penjualan 7 hari terakhir
    $days = collect(range(0,6))->map(function($i){ return now()->subDays(6-$i)->format('d M'); });
    $sales = collect(range(0,6))->map(function($i){
        return \App\Models\ZakiOrder::whereDate('created_at', now()->subDays(6-$i))->sum('total');
    });
    return view('admin.dashboard', compact('totalPenjualanHari', 'totalPenjualanBulan', 'orderBaru', 'userCount', 'produkTerlaris', 'produkStokMenipis', 'orderTerbaru', 'orderPending', 'days', 'sales'));
})->middleware(['auth', 'role:admin'])->name('admin.dashboard');

// User homepage (user only)
Route::get('/home', function () {
    $cart = session('cart', []);
    $cartCount = array_sum($cart);
    return view('user.home', compact('cartCount'));
})->middleware('role:user')->name('user.home');

Route::middleware(['role:admin'])->prefix('admin')->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('orders', OrderController::class);
});

Route::get('/products', function (\Illuminate\Http\Request $request) {
    $query = ZakiProduct::with('category');
    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }
    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }
    if ($request->filled('harga_min')) {
        $query->where('price', '>=', $request->harga_min);
    }
    if ($request->filled('harga_max')) {
        $query->where('price', '<=', $request->harga_max);
    }
    $products = $query->get();
    $categories = ZakiCategory::all();
    $cart = session('cart', []);
    $cartCount = array_sum($cart);
    $selectedCategory = $request->category_id;
    $harga_min = $request->harga_min;
    $harga_max = $request->harga_max;
    return view('products.index', compact('products', 'categories', 'cartCount', 'selectedCategory', 'harga_min', 'harga_max'));
})->name('products.user');

// Cart routes
Route::get('/cart', function () {
    $cart = session('cart', []);
    $cartCount = array_sum($cart);
    return view('cart.index', compact('cart', 'cartCount'));
})->middleware('auth')->name('cart.index');

Route::post('/cart/add', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'product_id' => 'required|exists:zaki_products,id',
        'quantity' => 'required|integer|min:1',
    ]);
    $cart = session('cart', []);
    $productId = $request->product_id;
    $qty = $request->quantity;
    if (isset($cart[$productId])) {
        $cart[$productId] += $qty;
    } else {
        $cart[$productId] = $qty;
    }
    session(['cart' => $cart]);
    return back()->with('success', 'Produk ditambahkan ke keranjang!');
})->middleware('auth')->name('cart.add');

Route::post('/cart/update', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'product_id' => 'required|exists:zaki_products,id',
        'quantity' => 'required|integer|min:1',
    ]);
    $cart = session('cart', []);
    $cart[$request->product_id] = $request->quantity;
    session(['cart' => $cart]);
    return back();
})->middleware('auth')->name('cart.update');

Route::post('/cart/remove', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'product_id' => 'required|exists:zaki_products,id',
    ]);
    $cart = session('cart', []);
    unset($cart[$request->product_id]);
    session(['cart' => $cart]);
    return back();
})->middleware('auth')->name('cart.remove');

// Konfirmasi checkout
Route::post('/cart/checkout', function () {
    $cart = session('cart', []);
    if (empty($cart)) {
        return back()->with('error', 'Keranjang kosong!');
    }
    $user = Auth::user();
    $cartCount = array_sum($cart);
    $cartProducts = collect($cart)->map(function($qty, $id) {
        $product = \App\Models\ZakiProduct::find($id);
        return $product ? ['product' => $product, 'qty' => $qty, 'subtotal' => $product->price * $qty] : null;
    })->filter();
    $total = $cartProducts->sum('subtotal');
    $shipping_address = $user->shipping_address ?? '';
    return view('cart.confirm', compact('cartProducts', 'total', 'shipping_address', 'cartCount'));
})->middleware('auth')->name('cart.checkout');

Route::post('/cart/confirm', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'shipping_address' => 'required|string|max:255',
    ]);
    $cart = session('cart', []);
    if (empty($cart)) {
        return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');
    }
    $user = Auth::user();
    $total = 0;
    $items = [];
    foreach ($cart as $productId => $qty) {
        $product = \App\Models\ZakiProduct::find($productId);
        if ($product) {
            $items[] = [
                'product_id' => $product->id,
                'quantity' => $qty,
                'price' => $product->price,
            ];
            $total += $product->price * $qty;
        }
    }
    $order = \App\Models\ZakiOrder::create([
        'user_id' => $user->id,
        'total' => $total,
        'shipping_address' => $request->shipping_address,
    ]);
    foreach ($items as $item) {
        $order->items()->create($item);
    }
    session()->forget('cart');
    return redirect()->route('orders.history')->with('success', 'Order berhasil!');
})->middleware('auth')->name('cart.confirm');

Route::get('/orders/history', function () {
    $orders = \App\Models\ZakiOrder::with(['items.product'])->where('user_id', Auth::id())->get();
    $cart = session('cart', []);
    $cartCount = array_sum($cart);
    return view('orders.history', compact('orders', 'cartCount'));
})->middleware('auth')->name('orders.history');

Route::get('/profile', function () {
    $user = Auth::user();
    $cart = session('cart', []);
    $cartCount = array_sum($cart);
    return view('user.profile', compact('user', 'cartCount'));
})->middleware('auth')->name('user.profile');

Route::get('/profile/edit', function () {
    $user = Auth::user();
    $cart = session('cart', []);
    $cartCount = array_sum($cart);
    return view('user.edit-profile', compact('user', 'cartCount'));
})->middleware('auth')->name('user.profile.edit');

Route::post('/profile/edit', function (\Illuminate\Http\Request $request) {
    $user = Auth::user();
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
    ]);
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);
    return redirect()->route('user.profile')->with('success', 'Profil berhasil diupdate!');
})->middleware('auth')->name('user.profile.update');

// Wishlist routes
Route::post('/wishlist/add', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'product_id' => 'required|exists:zaki_products,id',
    ]);
    $wishlist = session('wishlist', []);
    $wishlist[$request->product_id] = true;
    session(['wishlist' => $wishlist]);
    return back()->with('success', 'Produk ditambahkan ke wishlist!');
})->middleware('auth')->name('wishlist.add');

Route::get('/wishlist', function () {
    $wishlist = session('wishlist', []);
    $wishlistProducts = collect($wishlist)->keys()->map(function($id) {
        return \App\Models\ZakiProduct::find($id);
    })->filter();
    $cart = session('cart', []);
    $cartCount = array_sum($cart);
    $wishlistCount = count($wishlist);
    return view('wishlist.index', compact('wishlistProducts', 'cartCount', 'wishlistCount'));
})->middleware('auth')->name('wishlist.index');

Route::post('/wishlist/remove', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'product_id' => 'required|exists:zaki_products,id',
    ]);
    $wishlist = session('wishlist', []);
    unset($wishlist[$request->product_id]);
    session(['wishlist' => $wishlist]);
    return back()->with('success', 'Produk dihapus dari wishlist!');
})->middleware('auth')->name('wishlist.remove');
