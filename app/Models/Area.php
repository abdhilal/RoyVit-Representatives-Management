<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
        'name',
        'city_id',
    ];

    /** @use HasFactory<\Database\Factories\AreaFactory> */
    use HasFactory;

    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }
}
