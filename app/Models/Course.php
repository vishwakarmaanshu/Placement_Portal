<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CourseYoutubeVideo;


class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'duration',
        'technologies',
        'image',
        'youtube_links',
    ];

    protected $casts = [
    'youtube_links' => 'array',
];

    public function placements()
    {
        return $this->hasMany(Placement::class);
    }

public function videos()
{
    return $this->hasMany(CourseVideo::class);
}

// public function youtubeVideos()
// {
//     return $this->hasMany(CourseYoutubeVideo::class);
// }

public function youtubeVideos()
{
    return $this->hasMany(CourseYoutubeVideo::class, 'course_id');
}




   

}


  



