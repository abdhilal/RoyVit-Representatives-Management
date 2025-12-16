<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitSample extends Model
{
    protected $fillable = [
        'doctor_visit_id',
        'product_id',
        'quantity',
    ];
    /** @use HasFactory<\Database\Factories\VisitSampleFactory> */
    use HasFactory;

    public function visit()
    {
        return $this->belongsTo(DoctorVisit::class, 'doctor_visit_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
