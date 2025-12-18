<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorVisit extends Model
{
    protected $fillable = [
        'representative_id',
        'warehouse_id',
        'doctor_id',
        'visit_period_id',
        'visit_date',
        'image',
        'notes',
    ];

    protected $casts = [
        'visit_date' => 'datetime',
    ];
    /** @use HasFactory<\Database\Factories\DoctorVisitFactory> */
    use HasFactory;

    public function representative()
    {
        return $this->belongsTo(User::class, 'representative_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function period()
    {
        return $this->belongsTo(VisitPeriod::class, 'visit_period_id');
    }

    public function samples()
    {
        return $this->hasMany(VisitSample::class);
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . ltrim($this->image, '/')) : null;
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
