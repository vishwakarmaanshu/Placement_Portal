<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Placement extends Model
{

    protected $fillable = [
        'user_id',      // ✅ make sure this is included
        'course_id',
        'company',
        'photo',
    ];



    

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    
public function user()
{
    return $this->belongsTo(User::class);
}




    
}
