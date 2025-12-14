<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'name',
        'warehouse_id',
    ];

    /** @use HasFactory<\Database\Factories\CityFactory> */
    use HasFactory;

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function areas()
    {
        return $this->hasMany(Area::class);
    }
    
}
