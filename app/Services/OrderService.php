<?php

namespace App\Services;

use App\Models\City;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    public function getAllOrders(Request $request)
    {
        $user = Auth::user();
        $query = Order::query();
        $query->with('warehouse', 'representative');

        if ($user->hasRole('super-admin')) {
            $query->where('receiver_id', $user->warehouse->created_by);
        } else {

            $query->where('representative_id', $user->id);
        }
        return $query->orderBy('created_at', 'desc')->paginate(10);
    }

    public function createOrder(array $data)
    {
        $user = Auth::user();
        Order::create([
            'representative_id' => $user->id,
            'receiver_id' => $user->warehouse->created_by,
            'warehouse_id' => $user->warehouse_id,
            'description' => $data['description'],
            'title' => $data['title'],
        ]);
    }

    public function updateOrder(Order $order, array $data)
    {
        $order->update([
            'title' => $data['title'],
            'description' => $data['description'],
        ]);
    }

    public function deleteOrder(Order $order)
    {
        $order->delete();
    }
}
