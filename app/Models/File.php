<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';
    protected $fillable = [
        'id',
        'path',
        'name',
        'month',
        'year',
        'month_year',
        'warehouse_id',
    ];
    protected $casts = [
        'month' => 'integer',
        'year' => 'integer',
        'month_year' => 'date',
    ];
    /** @use HasFactory<\Database\Factories\FileFactory> */
    use HasFactory;

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
