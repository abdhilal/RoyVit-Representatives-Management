<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Enums\OrderStatuses;
use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;

class OrderController extends Controller
{
    protected $OrderService;

    public function __construct(OrderService $OrderService)
    {
        $this->OrderService = $OrderService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $orders = $this->OrderService->getAllOrders($request);
        $summary = $this->OrderService->getOrderSummaryCounts($request);


        return view('pages.orders.index', [
            'orders' => $orders,
            'ordersCount' => $summary['total'],
            'ordersCountPending' => $summary['pending'],
            'ordersCountAccepted' => $summary['accepted'],
            'ordersCountCancelled' => $summary['cancelled'],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $order = new Order();

        return view('pages.orders.partials.form', compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $this->OrderService->createOrder($request->validated());
        return redirect()->route('orders.index')->with('success', __('Order created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order->load(['representative']);
        return view('pages.orders.partials.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        return view('pages.orders.partials.form', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $this->OrderService->updateOrder($order, $request->validated());
        return redirect()->route('orders.index')->with('success', __('Order updated successfully'));
    }

    public function accept(Order $order)
    {
        abort_unless(auth()->user()->hasPermissionTo('accept-orders'), 403);
        $this->OrderService->updateOrderStatus($order, OrderStatuses::ACCEPTED);
        return redirect()->route('orders.show', $order)->with('success', __('Order accepted successfully'));
    }

    public function reject(Order $order)
    {
        abort_unless(auth()->user()->hasPermissionTo('reject-orders'), 403);
        $this->OrderService->updateOrderStatus($order, OrderStatuses::CANCELLED);
        return redirect()->route('orders.show', $order)->with('success', __('Order rejected successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $this->OrderService->deleteOrder($order);
        return redirect()->route('orders.index')->with('success', __('Order deleted successfully'));
    }
}
