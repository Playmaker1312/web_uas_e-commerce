<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ZakiOrder;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = ZakiOrder::with(['user', 'items.product'])->get();
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = ZakiOrder::find($id);
        if (!$order) {
            return redirect()->route('orders.index')->with('error', 'Order tidak ditemukan!');
        }
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order berhasil dihapus!');
    }

    /**
     * Confirm the specified order (set status to 'proses').
     */
    public function confirm($id)
    {
        $order = ZakiOrder::find($id);
        if (!$order) {
            return redirect()->route('orders.index')->with('error', 'Order tidak ditemukan!');
        }
        $order->status = 'proses';
        $order->save();
        return redirect()->route('orders.index')->with('success', 'Order berhasil dikonfirmasi!');
    }
}
