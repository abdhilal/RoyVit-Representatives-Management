<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [

        'name',
        'phone',
        'address',
        'gender',
        'area_id',
        'warehouse_id',
        'classification_id',
        'specialization_id',
        'representative_id',
        'visits_count',
    ];
    /** @use HasFactory<\Database\Factories\DoctorFactory> */
    use HasFactory;



    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
    public function area()
    {
        return $this->belongsTo(Area::class);
    }
    public function classification()
    {
        return $this->belongsTo(Classification::class);
    }
    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }
    public function representative()
    {
        return $this->belongsTo(User::class, 'representative_id');
    }

    public function doctorVisits()
    {
        return $this->hasMany(DoctorVisit::class);
    }




}
