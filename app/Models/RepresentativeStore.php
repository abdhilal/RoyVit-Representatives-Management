<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepresentativeStore extends Model
{
    protected $fillable = ['representative_id', 'product_id', 'warehouse_id', 'quantity'];

    /** @use HasFactory<\Database\Factories\RepresentativeStoreFactory> */
    use HasFactory;

    public function representative()
    {
        return $this->belongsTo(User::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

}
