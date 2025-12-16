<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'representative_id',
        'receiver_id',
        'warehouse_id',
        'description',
        'title',
    ];
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    public function representative()
    {
        return $this->belongsTo(User::class, 'representative_id');
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
