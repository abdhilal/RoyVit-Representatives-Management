<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    protected $fillable = ['name', 'warehouse_id'];

    /** @use HasFactory<\Database\Factories\SpecializationFactory> */
    use HasFactory;

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }
}
