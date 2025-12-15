<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'type',
        'warehouse_id',
    ];
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
