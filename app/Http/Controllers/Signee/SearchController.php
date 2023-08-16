<?php
namespace App\Http\Controllers\Signee;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Department;
use App\Models\Course;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request){
        $course = Course::all();
        $request->validate([
            'query'=>'required|min:3',
        ]);
        $query = $request->input('query');
        //dd($query);
        $student  = User::where('name','like', "%$query%")->orwhere('school_id','like',"%$query%")->paginate(5);
        //dd($posts);
        return view('signee.search', compact('student','course')); 
    }

    // public function search(Request $request){
    //     $output="";
    //     $student  = User::where('name','like','%'.$request->search.'%')->orwhere('school_id','%'.$request->search.'%')->get();
    //     foreach($student as $student_list)
    //     {
    //         $output.=
    //         '<tr> 
    //             <td>'.$student_list->name.'<td>
    //         </tr>';
           
    //     }
    //     return response($output);
    // }
}
