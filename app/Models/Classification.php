<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    protected $fillable = [
        'name',
        'warehouse_id',
    ];

    /** @use HasFactory<\Database\Factories\ClassificationFactory> */
    use HasFactory;

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
