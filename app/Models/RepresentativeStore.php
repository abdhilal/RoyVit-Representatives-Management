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
        return $this->belongsTo(Representative::class);
    }
    public function products()
    {
        return $this->belongsTo(Product::class);
    }
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
    
}
