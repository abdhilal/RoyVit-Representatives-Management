<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['sender_id', 'receiver_id', 'warehouse_id', 'note','number'];

    /** @use HasFactory<\Database\Factories\InvoiceFactory> */
    use HasFactory;

    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }
}
