<?php

namespace App\Models;
use App\Models\Admin;
use App\Models\Signee;
use App\Models\Course;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, softDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_as',
        'subjects',
        'school_id',
        'last_seen',
        'course',
        'dept_id',
        'year_lvl',
        'semester',
        'status',
        'description',
        'student_signee_names',
        'student_section',
    //general signees
        'student_org_treasurer',
        'student_org_description',

        'librarian',
        'librarian_description',

        'dean_of_student_affair',
        'dean_of_student_affair_description',

        'dean_principal',
        'dean_principal_description',

        'guidance_councilor',
        'guidance_councilor_description',

        'registrar',
        'registrar_description',

        'accounting_assessment',
        'accounting_assessment_description',
    ];
 
    public function scopeSearch($query, $q)
{
    if ($q == null) return $query;
    return $query
            ->where('name', 'LIKE', "%{$q}%")
            ->orWhere('school_id', 'LIKE', "%{$q}%")
            ->orWhere('year_lvl', 'LIKE', "%{$q}%")
            ->orWhere('course', 'LIKE', "%{$q}%");
}
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'subjects' => 'array',
        'status'  => 'array',
        'description'  => 'array',
        'student_signee_names'  => 'array',
        'student_section'  => 'array',
    ];
    // public function admin(){
    //     return $this->hasMany('App\Models\Admin');
    // }

    // private function getPayloadUpdate($id, $statuses,$descriptions, $role){
    //     $payload = [
    //         'status' => $statuses[$id],
    //         'description' => $descriptions[$id],
    //      ];

    //     switch ($role) {
    //         case 'guidance Counselor':
    //             $payload = [
    //                 'guidance_councilor' => $request->get('guidance_councilor')[$id],
    //                 'guidance_councilor_description' => $request->get('guidance_councilor_description')[$id],

    //             ];
    //             break;

    //         case 'student Org. treasurer':
    //             $payload = [
    //                 'student_org_treasurer' => $request->get('student_org_treasurer')[$id],
    //                 'student_org_description' => $request->get('student_org_description')[$id],

    //             ];
    //             break;
            
    //         default:
    //             break;
    //     }

    //     return $payload;
    // }

    // public function updateStatusDescriptionByIds($ids,$statuses, $descriptions, $role){
    //     foreach ($ids as $id) {
    //         User::where('id',$id)->update($this->getPayloadUpdate($id,$statuses, $descriptions,$role));  
    //     }
    // }
}
