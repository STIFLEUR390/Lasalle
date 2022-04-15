<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function faculties()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function rooms()
    {
        return $this->belongsTo(Room::class);
    }

    public function courses()
    {
        return $this->belongsTo(Course::class);
    }
}
