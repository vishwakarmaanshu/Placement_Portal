<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;
protected $table = 'course_enrollments';

    protected $fillable = ['user_id', 'course_id'];
}
