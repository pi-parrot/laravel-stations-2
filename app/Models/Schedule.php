<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'movie_id',
        'start_time',
        'end_time',
    ];

    public function getStartTimeAttribute($value)
    {
        return Carbon::parse($value);
    }

    public function getEndTimeAttribute($value)
    {
        return Carbon::parse($value);
    }

    function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    function sheet()
    {
        return $this->hasMany(Sheet::class);
    }
}
