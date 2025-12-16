<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    /** @use HasFactory<\Database\Factories\WarehouseFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'created_by',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function classifications()
    {
        return $this->hasMany(Classification::class);
    }

    public function specializations()
    {
        return $this->hasMany(Specialization::class);
    }
    public function areas()
    {
        return $this->hasMany(Area::class);
    }
    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
