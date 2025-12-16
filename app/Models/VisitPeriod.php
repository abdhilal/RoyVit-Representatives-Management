<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitPeriod extends Model
{
    protected $fillable = [
        'month',
        'max_visits',
        'warehouse_id',
    ];

    /** @use HasFactory<\Database\Factories\VisitPeriodFactory> */
    use HasFactory;

    public function visits()
    {
        return $this->hasMany(DoctorVisit::class);
    }

    public function scopeCurrent($query)
    {
        return $query->where('month', now()->format('Y-m'));
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
