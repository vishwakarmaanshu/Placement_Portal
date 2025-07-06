<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseVideo extends Model
{
    protected $table = 'course_videos'; 
    
    protected $fillable = ['course_id', 'video_path'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
