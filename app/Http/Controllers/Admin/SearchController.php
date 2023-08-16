<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request){
        $request->validate([
            'query'=>'required|min:3',
        ]);
        $query = $request->input('query');
        //dd($query);
        $student  = User::where('name','like', "%$query%")->orwhere('school_id','like',"%$query%")->paginate(5);
        //dd($posts);
        return view('admin.search', compact('student')); 
    }
}
