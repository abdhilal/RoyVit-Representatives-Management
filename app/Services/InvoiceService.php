<?php

namespace App\Services;

use App\Models\User;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\InvoiceItem;
use Illuminate\Support\Facades\DB;
use App\Models\RepresentativeStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceService
{

    public function getAll(Request $request)
    {
        $query = Invoice::with(['invoiceItems', 'sender', 'receiver']);
        $user = auth()->user();
        if (auth()->user()->hasRole('super-admin')) {
            $query->where('warehouse_id', $user->warehouse_id)->withCount('invoiceItems');
        }

        if (auth()->user()->hasRole('representative')) {
            $warehouseId = $user->warehouse_id;
            $query->where('warehouse_id', $warehouseId)->where('receiver_id', $user->id)->withCount('invoiceItems');
        }
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('number', 'like', "%$search%")
                    ->orWhereHas('sender', function ($q) use ($search) {
                        $q->where('name', 'like', "%$search%");
                    })
                    ->orWhereHas('receiver', function ($q) use ($search) {
                        $q->where('name', 'like', "%$search%");
                    });
            });
        }
        return $query->orderBy('created_at', 'desc')->paginate(15);
    }
    public function getInformationCraete()
    {
        $warehouseId = auth()->user()->warehouse_id;
        $representatives = User::where('warehouse_id', $warehouseId)->get();
        $products = Product::where('warehouse_id', $warehouseId)->get();
        return compact('representatives', 'products');
    }

    public function store($data)
    {
        $user = Auth::user();





        $invoic = Invoice::create([
            'number' => "ROY" . date('YmdHis'),
            'sender_id' => $user->id,
            'receiver_id' => $data['representative_id'],
            'warehouse_id' => $user->warehouse_id,
            'note' => $data['note'],
        ]);

        $invoiceItems = [];
        foreach ($data['product_id'] as $key => $productId) {
            $invoiceItems[] = [
                'invoice_id' => $invoic->id,
                'product_id' => $productId,
                'quantity' => $data['quantity'][$key],
                'created_at' => now(),

            ];

            $representativeStore = RepresentativeStore::firstOrCreate(
                [

                    'representative_id' => $data['representative_id'],
                    'product_id' => $productId,
                    'warehouse_id' => $user->warehouse_id,
                ]
            );
            $representativeStore->increment('quantity', $data['quantity'][$key]);
        }
        InvoiceItem::insert($invoiceItems);
    }

    public function getInformationUpdate(Invoice $invoice)
    {
        $invoice->load('invoiceItems');
        $warehouseId = auth()->user()->warehouse_id;
        $representatives = User::where('warehouse_id', $warehouseId)->get();
        $products = Product::where('warehouse_id', $warehouseId)->get();
        return compact('representatives', 'products', 'invoice');
    }


    public function update(array $data, Invoice $invoice)
    {

        $invoice->update([
            'receiver_id' => $data['representative_id'],
            'note' => $data['note'] ?? null,
        ]);


        // حذف العناصر القديمة
        InvoiceItem::where('invoice_id', $invoice->id)->delete();

        $invoiceItems = [];

        foreach ($data['product_id'] as $key => $productId) {
            if (!isset($data['quantity'][$key])) {
                continue;
            }

            $invoiceItems[] = [
                'invoice_id' => $invoice->id,
                'product_id' => $productId,
                'quantity' => $data['quantity'][$key],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        InvoiceItem::insert($invoiceItems);
    }

    public function delete(Invoice $invoice)
    {
        $invoice->invoiceItems()->delete();
        $invoice->delete();
    }

    public function getInformationShow(Invoice $invoice)
    {
        $invoice->load('invoiceItems');
        $invoice->load('sender');
        $invoice->load('receiver');
        return compact('invoice');
    }
}
