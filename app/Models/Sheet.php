<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sheet extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'column',
        'row',
    ];

    // function schedule()
    // {
    //     return $this->belongsTo(Schedule::class);
    // }

}
