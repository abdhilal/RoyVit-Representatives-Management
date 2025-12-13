<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    protected $table = 'user_informations';
    protected $fillable = [
        'id',
        'birth_date',
        'phone',
        'address',
        'city',
        'state',
        'country',
    ];
    protected $casts = [
        'birth_date' => 'date',
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'id');
    }
}
