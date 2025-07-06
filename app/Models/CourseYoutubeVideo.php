<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseYoutubeVideo extends Model
{
    protected $fillable = ['course_id', 'youtube_url'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
