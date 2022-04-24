<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }

    public function teacherGrade()
    {
        return $this->belongsTo(TeacherGrade::class, 'grade_id');
    }

    public function teacherStatus()
    {
        return $this->belongsTo(TeacherStatus::class, 'statut_id');
    }
}
