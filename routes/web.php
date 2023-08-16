<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'App\Http\Controllers\PagesController@index');


// code below is to disable public registration
Auth::routes(['register' => false,
                'reset' => false,
                'login' => false]);
// Auth::routes();
 

Route::prefix('student')->name('student.')->group(function(){
    Route::middleware(['guest:web','RevalidateBackHistory'])->group(function(){
        Route::view('/student_login', 'student.student_login')->name('student_login');
        Route::post('/check',[App\Http\Controllers\Student\StudentController::class,'check'])->name('check')->middleware(['throttle:login']);
    }); 

    Route::middleware(['auth:web','RevalidateBackHistory'])->group(function(){
         Route::get('/studentdashboard', 'App\Http\Controllers\Student\StudentController@index')->name('studentdashboard');
         Route::get('/student-search-active-user', [App\Http\Controllers\Student\StudentController::class, 'student_search_active_user'])->name('student-search-active-user');
         Route::get('/student-search-active-signee-user', [App\Http\Controllers\Student\StudentController::class, 'student_search_active_signee_user'])->name('student-search-active-signee-user');   
    });
});

Route::prefix('admin')->name('admin.')->group(function(){
    Route::middleware(['guest:admin','RevalidateBackHistory'])->group(function(){ 
        Route::view('/admin_login', 'admin.admin_login')->name('admin_login');
        Route::post('/admin-check',[App\Http\Controllers\Admin\AdminController::class,'admin_check'])->name('admin-check')->middleware(['throttle:login']);
    });
    Route::middleware(['auth:admin','RevalidateBackHistory'])->group(function(){
        Route::get('/admindashboard', [App\Http\Controllers\Admin\AdminController::class, 'dashboard_index'])->name('admindashboard');
        // Route::get('/admindashboard', 'App\Http\Controllers\Admin\AdminController@dashboard_index')->name('admindashboard');          
        Route::get('/search', [App\Http\Controllers\Admin\SearchController::class, 'index']);
        // Route::resource('users', 'App\Http\Controllers\Admin\AdminController');
        Route::get('/view-pending-request', [App\Http\Controllers\Admin\AdminController::class, 'view_pending_request'])->name('view-pending-request');
        Route::get('/complete-request', [App\Http\Controllers\Admin\AdminController::class, 'complete_request'])->name('complete-request');
        Route::post('/multiple-store', [App\Http\Controllers\Admin\AdminController::class, 'multiple_store'])->name('multiple-store');
        
        Route::get('/print-student-clearance', [App\Http\Controllers\Admin\AdminController::class, 'print_student_clearance'])->name('print-student-clearance');
        Route::get('/view-generate-pdf', [App\Http\Controllers\Admin\AdminController::class, 'view_generate_pdf'])->name('view-generate-pdf');
       
        Route::get('/signee-search-active-user', [App\Http\Controllers\Admin\AdminController::class, 'signee_search_active_user'])->name('signee-search-active-user');
        Route::get('/signee-search-active-signee-user', [App\Http\Controllers\Admin\AdminController::class, 'signee_search_active_signee_user'])->name('signee-search-active-signee-user');  

        Route::post('/admindashboard', [App\Http\Controllers\Admin\AdminController::class, 'admin_logout'])->name('admindashboard');
        Route::put('/update-multiple-student', [App\Http\Controllers\Admin\AdminController::class, 'update_multiple_student'])->name('update-multiple-student');
        //add student route
        Route::post('/store-student', [App\Http\Controllers\Admin\AdminController::class, 'store_student'])->name('store-student');
        Route::get('/add-student', [App\Http\Controllers\Admin\AdminController::class, 'create_student'])->name('add-student');
        Route::post('/get-subjects', [App\Http\Controllers\Admin\AdminController::class, 'getsubject'])->name('get-subjects');
        Route::get('/FindSubjectName', [App\Http\Controllers\Admin\AdminController::class, 'FindSubjectName']);
        Route::get('/view-student-user', [App\Http\Controllers\Admin\AdminController::class, 'student_index'])->name('view-student-user');
        Route::get('/edit-student/{student_id}', [App\Http\Controllers\Admin\AdminController::class, 'edit_student'])->name('edit-student/{student_id}');
        Route::put('/update-student/{id}', [App\Http\Controllers\Admin\AdminController::class, 'update_student'])->name('update-student/{id}');
        Route::get('/delete-student/{student_id}', [App\Http\Controllers\Admin\AdminController::class, 'destroy_student']);
        Route::get('/permanent-delete-student/{id}', [App\Http\Controllers\Admin\AdminController::class, 'permanent_destroy_student']);
        Route::get('/restore-student/{id}', [App\Http\Controllers\Admin\AdminController::class, 'restore_student']);
        Route::get('/restore-all-student', [App\Http\Controllers\Admin\AdminController::class, 'restore_all_student'])->name('restore-all-student');
        Route::get('/permanent-delete-student-from-trash/{id}', [App\Http\Controllers\Admin\AdminController::class, 'permanent_destroy_student_from_trash']);
        
        Route::get('/admin-student-search', [App\Http\Controllers\Admin\AdminController::class, 'admin_student_search'])->name('admin-student-search');
        Route::get('/admin-signee-search', [App\Http\Controllers\Admin\AdminController::class, 'admin_signee_search'])->name('admin-signee-search');
        Route::get('/admin-subject-search', [App\Http\Controllers\Admin\AdminController::class, 'admin_subject_search'])->name('admin-subject-search');
        
        // add role routes
        Route::get('/view-role', [App\Http\Controllers\Admin\AdminController::class, 'role_index'])->name('view-role');
        Route::get('/add-role', [App\Http\Controllers\Admin\AdminController::class, 'create_role'])->name('add-role');
        Route::post('/store-role', [App\Http\Controllers\Admin\AdminController::class, 'store_role']);
        Route::get('/edit-role/{role_id}', [App\Http\Controllers\Admin\AdminController::class, 'edit_role']);
        Route::put('/update-role/{id}', [App\Http\Controllers\Admin\AdminController::class, 'update_role']);
        Route::get('/delete-role/{role_id}', [App\Http\Controllers\Admin\AdminController::class, 'destroy_role']);
        Route::get('/permanent-delete-role/{id}', [App\Http\Controllers\Admin\AdminController::class, 'permanent_destroy_role']);
        Route::get('/restore-role/{id}', [App\Http\Controllers\Admin\AdminController::class, 'restore_role']);
        Route::get('/restore-all-role', [App\Http\Controllers\Admin\AdminController::class, 'restore_all_role'])->name('restore-all-role');
        Route::get('/permanent-delete-role-from-trash/{id}', [App\Http\Controllers\Admin\AdminController::class, 'permanent_destroy_role_from_trash']);
        
        //add signee route
        Route::post('/store-signee', [App\Http\Controllers\Admin\AdminController::class, 'store_signee']);
        Route::get('/add-signee', [App\Http\Controllers\Admin\AdminController::class, 'create_signee'])->name('add-signee');
        Route::get('/view-signee-user', [App\Http\Controllers\Admin\AdminController::class, 'signee_index'])->name('view-signee-user');
        Route::get('/edit-signee/{signee_id}', [App\Http\Controllers\Admin\AdminController::class, 'edit_signee']);
        Route::put('/update-signee/{id}', [App\Http\Controllers\Admin\AdminController::class, 'update_signee']);
        Route::get('/delete-signee/{signee_id}', [App\Http\Controllers\Admin\AdminController::class, 'destroy_signee']);
        Route::get('/permanent-delete-signee/{id}', [App\Http\Controllers\Admin\AdminController::class, 'permanent_destroy_signee']);
        Route::get('/restore-signee/{id}', [App\Http\Controllers\Admin\AdminController::class, 'restore_signee']);
        Route::get('/restore-all-signee', [App\Http\Controllers\Admin\AdminController::class, 'restore_all_signee'])->name('restore-all-signee');
        Route::get('/permanent-delete-signee-from-trash/{id}', [App\Http\Controllers\Admin\AdminController::class, 'permanent_destroy_signee_from_trash']);
        
        // add department route
        Route::get('/add-department', [App\Http\Controllers\Admin\AdminController::class, 'create_department']);
        Route::post('/store-department', [App\Http\Controllers\Admin\AdminController::class, 'store_department']);
        Route::get('/view-department', [App\Http\Controllers\Admin\AdminController::class, 'department_index']);
        Route::get('/edit-department/{id}', [App\Http\Controllers\Admin\AdminController::class, 'edit_department']);
        Route::put('/update-department/{id}', [App\Http\Controllers\Admin\AdminController::class, 'update_department']);
        Route::get('/delete-department/{id}', [App\Http\Controllers\Admin\AdminController::class, 'destroy_department']);
        Route::get('/permanent-delete-department/{id}', [App\Http\Controllers\Admin\AdminController::class, 'permanent_destroy_department']);
        Route::get('/trash', [App\Http\Controllers\Admin\AdminController::class, 'trashed']);
        Route::get('/restore-department/{id}', [App\Http\Controllers\Admin\AdminController::class, 'restore_department']);
        Route::get('/restore-all-department', [App\Http\Controllers\Admin\AdminController::class, 'restore_all_department']);
        Route::get('/permanent-delete-department-from-trash/{id}', [App\Http\Controllers\Admin\AdminController::class, 'permanent_destroy_department_from_trash']);
        // add course route
        Route::get('/add-course', [App\Http\Controllers\Admin\AdminController::class, 'create_course']); 
        Route::post('/store-course', [App\Http\Controllers\Admin\AdminController::class, 'store_course']);
        Route::get('/view-course', [App\Http\Controllers\Admin\AdminController::class, 'course_index']);
        Route::get('/edit-course/{course_id}', [App\Http\Controllers\Admin\AdminController::class, 'edit_course']);
        Route::put('/update-course/{id}', [App\Http\Controllers\Admin\AdminController::class, 'update_course']);
        Route::get('/delete-course/{course_id}', [App\Http\Controllers\Admin\AdminController::class, 'destroy_course']);
        Route::get('/permanent-delete-course/{id}', [App\Http\Controllers\Admin\AdminController::class, 'permanent_destroy_course']);
        Route::get('/restore-course/{id}', [App\Http\Controllers\Admin\AdminController::class, 'restore_course']);
        Route::get('/restore-all-course', [App\Http\Controllers\Admin\AdminController::class, 'restore_all_course']);
        Route::get('/permanent-delete-course-from-trash/{id}', [App\Http\Controllers\Admin\AdminController::class, 'permanent_destroy_course_from_trash']);
        // add subject route
        Route::get('/add-subject', [App\Http\Controllers\Admin\AdminController::class, 'create_subject']);
        Route::post('/store-subject', [App\Http\Controllers\Admin\AdminController::class, 'store_subject']);
        Route::get('/view-subject', [App\Http\Controllers\Admin\AdminController::class, 'subject_index']);
        Route::get('/edit-subject/{subject_id}', [App\Http\Controllers\Admin\AdminController::class, 'edit_subject']);
        Route::put('/update-subject/{id}', [App\Http\Controllers\Admin\AdminController::class, 'update_subject']);
        Route::get('/delete-subject/{subject_id}', [App\Http\Controllers\Admin\AdminController::class, 'destroy_subject']);
        Route::get('/permanent-delete-subject/{id}', [App\Http\Controllers\Admin\AdminController::class, 'permanent_destroy_subject']);
        Route::get('/restore-subject/{id}', [App\Http\Controllers\Admin\AdminController::class, 'restore_subject']);
        Route::get('/restore-all-subject', [App\Http\Controllers\Admin\AdminController::class, 'restore_all_subject']);
        Route::get('/permanent-delete-subject-from-trash/{id}', [App\Http\Controllers\Admin\AdminController::class, 'permanent_destroy_subject_from_trash']);
        // change password student routes
        Route::get('/change-student-password', [App\Http\Controllers\Admin\AdminController::class, 'change_student_password_index']);
        Route::get('/edit-student-password/{student_id}', [App\Http\Controllers\Admin\AdminController::class, 'edit_student_password']);
        Route::put('/update-student-password/{id}', [App\Http\Controllers\Admin\AdminController::class, 'update_student_password']);
        // change password signee routes
        Route::get('/change-signee-password', [App\Http\Controllers\Admin\AdminController::class, 'change_signee_password_index']);
        Route::get('/edit-signee-password/{signee_id}', [App\Http\Controllers\Admin\AdminController::class, 'edit_signee_password']);
        Route::put('/update-signee-password/{id}', [App\Http\Controllers\Admin\AdminController::class, 'update_signee_password']);
    });
});

Route::prefix('signee')->name('signee.')->group(function(){
    Route::middleware(['guest:signee','RevalidateBackHistory'])->group(function(){
        Route::view('/signee_login', 'signee.signee_login')->name('signee_login');
        Route::post('/check',[App\Http\Controllers\Signee\SigneeController::class,'check'])->name('check')->middleware(['throttle:login']);
    });
    Route::middleware(['auth:signee','RevalidateBackHistory'])->group(function(){
        Route::get('/signeedashboard', 'App\Http\Controllers\Signee\SigneeController@index')->name('signeedashboard');       
        Route::get('/view-signee-pending-request', [App\Http\Controllers\Signee\SigneeController::class,'Pending_signee_request'])->name('view-signee-pending-request');
        Route::get('/quick-view-request', [App\Http\Controllers\Signee\SigneeController::class,'quick_view_request'])->name('quick-view-request');
        Route::put('/update-multiple-student', [App\Http\Controllers\Signee\SigneeController::class, 'update_multiple_student'])->name('update-multiple-student');
        
        Route::post('/signeedashboard', [App\Http\Controllers\Signee\SigneeController::class, 'signee_logout'])->name('signeedashboard');
        // Route::get('/search', [App\Http\Controllers\Signee\SearchController::class, 'index']);
        Route::get('/instructor-search', [App\Http\Controllers\Signee\SigneeController::class, 'instructor_search'])->name('instructor-search');
        Route::get('/guidance-counselor-search', [App\Http\Controllers\Signee\SigneeController::class, 'guidance_counselor_search'])->name('guidance-counselor-search');
        Route::get('/student-org-search', [App\Http\Controllers\Signee\SigneeController::class, 'student_org_search'])->name('student-org-search');
        Route::get('/librarian-search', [App\Http\Controllers\Signee\SigneeController::class, 'librarian_search'])->name('librarian-search');
        Route::get('/student-affair-search', [App\Http\Controllers\Signee\SigneeController::class, 'student_affair_search'])->name('student-affair-search');
        Route::get('/dean-principal-search', [App\Http\Controllers\Signee\SigneeController::class, 'dean_principal_search'])->name('dean-principal-search');
        Route::get('/registrar-search', [App\Http\Controllers\Signee\SigneeController::class, 'registrar_search'])->name('registrar-search');
        Route::get('/assessment-search', [App\Http\Controllers\Signee\SigneeController::class, 'assessment_search'])->name('assessment-search');

        Route::get('/signee-search-active-user', [App\Http\Controllers\Signee\SigneeController::class, 'signee_search_active_user'])->name('signee-search-active-user');
        Route::get('/signee-search-active-signee-user', [App\Http\Controllers\Signee\SigneeController::class, 'signee_search_active_signee_user'])->name('signee-search-active-signee-user');   
        
        Route::get('/edit-student/{student_id}', [App\Http\Controllers\Signee\SigneeController::class, 'edit_student']);
        Route::put('/update-student/{student_id}', [App\Http\Controllers\Signee\SigneeController::class, 'update_student']);
    });
});
