<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Course extends Model
{
    use HasFactory, softDeletes;
    protected $table='courses';
    protected $fillable = [
        'course_name',
        'course_acronym',
        // 'belong_to',
        'dept_id',       
    ];
}
