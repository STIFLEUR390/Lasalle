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

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['ue_code'];


    /* public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    } */

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function ue_code()
    {
        return $this->belongsTo(UeCode::class, 'ue_id');
    }
}
