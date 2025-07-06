<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CourseEnrollment;

class CourseEnrollment extends Model
{
    use HasFactory;

     protected $table = 'course_enrollments';

    // protected $fillable = ['user_id', 'course_name'];
    
public function user()
{
    return $this->belongsTo(User::class);
}

  protected $fillable = ['user_id', 'course_id'];

    // public function user() {
    //     return $this->belongsTo(User::class);
    // }

    public function course() {
        return $this->belongsTo(Course::class);
    }
}




