<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'visit_period_id',
        'warehouse_id',
    ];
    /** @use HasFactory<\Database\Factories\PlanFactory> */
    use HasFactory;

    public function visitPeriod()
    {
        return $this->belongsTo(VisitPeriod::class);
    }
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
    public function planItems()
    {
        return $this->hasMany(PlanItem::class);
    }
}
