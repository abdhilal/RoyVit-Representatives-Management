<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\InvoiceItem;
use App\Services\DashboardService;
use App\Models\RepresentativeStore;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller
{
    protected $DashboardService;
    public function __construct(DashboardService $DashboardService)
    {
        $this->DashboardService = $DashboardService;
    }
    use AuthorizesRequests;

    public function dashboard()
    {
        return "Sacx";
        return view('layouts.app');
    }




    public function storeee()
    {
        $usrs = User::with('representativeStore')->get();
        $user_sender = $usrs->first();
        $productIds = Product::all()->pluck('id');







        foreach ($usrs as $user) {
            // $user->representativeStore()->delete();
            $user->representativeStore()->delete();
            $invoic = Invoice::create([
                'number' => "ROY" . date('YmdHis')*rand(1,1000),
                'sender_id' => $user_sender->id,
                'receiver_id' => $user->id,
                'warehouse_id' => 1,
                'note' =>' 2 فاتورة تجريبية',
            ]);

            $invoiceItems = [];
            foreach ($productIds as $productId) {
                $invoiceItems[] = [
                    'invoice_id' => $invoic->id,
                    'product_id' => $productId,
                    'quantity' => 50,
                    'created_at' => now(),

                ];

                $representativeStore = RepresentativeStore::firstOrCreate(
                    [

                        'representative_id' => $user->id,
                        'product_id' => $productId,
                        'warehouse_id' => 1,
                    ]
                );
                $representativeStore->increment('quantity', 50);
            }
            InvoiceItem::insert($invoiceItems);
        }

        return "done";
    }
}
