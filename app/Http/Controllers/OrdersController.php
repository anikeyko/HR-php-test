<?php

namespace App\Http\Controllers;

use App\Partner;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Order;

class OrdersController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::paginate(10);


        return view('orders.index', ['orders' => $orders]);
    }

    public function edit(Request $request, int $id)
    {
        $order = Order::findOrFail($id);
        $partners = Partner::all();
        $statuses = Order::STATUSES;
        return view('orders.edit', compact('order', 'partners', 'statuses'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'client_email'=>'required|email',
            'partner_id'=>'required',
            'status'=>'required'
        ]);

        $order = Order::findOrFail($id);

        $order->update($request->all());

        return redirect()->route('orders');
    }
}
