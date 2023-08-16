<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Subject extends Model
{
    use HasFactory, softDeletes;
    protected $fillable = [
        'course_id',   
        'code',
        'subj_code',
        'subj_name',
        'unit',
        'year_level',
        'semester',   
        'section',
        'signee_names',  
    ];
}
