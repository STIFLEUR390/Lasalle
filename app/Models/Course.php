<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    /* public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    } */

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
