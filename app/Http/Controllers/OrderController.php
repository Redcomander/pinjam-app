<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of orders for the shop owner.
     */
    public function index()
    {
        // Retrieve the shop_id associated with the authenticated user
        $shopId = Auth::user()->shops()->first()->id;

        // Retrieve orders associated with the shop along with user details
        $orders = Order::where('shop_id', $shopId)
            ->with('user') // Include user information
            ->paginate(10); // Paginate with 10 orders per page

        return view('order.index', compact('orders'));
    }


    /**
     * Display the orders for the customer.
     */
    public function customer()
    {
        // Retrieve orders associated with the authenticated user
        $orders = Order::where('user_id', Auth::id())->paginate(10); // Paginate with 10 orders per page

        return view('order.customer', compact('orders'));
    }

    /**
     * Display the specified order details.
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);

        // Ensure the user is authorized to view the order
        if ($order->user_id != Auth::id() && $order->shop_id != Auth::user()->shops()->first()->id) {
            return redirect()->route('home')->with('error', 'Unauthorized access to this order.');
        }

        return view('order.show', compact('order'));
    }
}
