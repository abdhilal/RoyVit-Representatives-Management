<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanItem extends Model
{
    protected $fillable = [
        'plan_id',
        'product_id',
        'specialization_id',
    ];
    /** @use HasFactory<\Database\Factories\PlanItemFactory> */
    use HasFactory;
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }
}
