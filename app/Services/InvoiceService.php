<?php

namespace App\Services;

use App\Models\User;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\InvoiceItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class InvoiceService
{

    public function getAll()
    {
        $user = auth()->user();
        if (auth()->user()->hasRole('super-admin')) {
            return Invoice::with(['invoiceItems', 'sender', 'receiver'])->where('warehouse_id', $user->warehouse_id)->withCount('invoiceItems')->paginate(15);
        }

        $warehouseId = $user->warehouse_id;
        return Invoice::with(['invoiceItems', 'sender', 'receiver'])->where('warehouse_id', $warehouseId)->where('receiver_id', $user->id)->withCount('invoiceItems')->paginate(15);
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
            ];
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
