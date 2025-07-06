<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'contact_no',
        'password',
        'role',
    ];

    protected $hidden = ['password', 'remember_token'];

//     public function enrollments()
// {
//     return $this->hasMany(\App\Models\CourseEnrollment::class); // adjust namespace if needed
// }

public function enrollments()
{
    return $this->hasMany(CourseEnrollment::class);
}

public function placements()
{
    return $this->hasMany(Placement::class);
}

public function courseEnrollments()
{
    return $this->hasMany(CourseEnrollment::class);
}



}

