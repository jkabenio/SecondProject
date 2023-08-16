<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Livewire\WithPagination;

class Search extends Model
{
    use HasFactory;
    use WithPagination;
    public function render()
    {
        $search = '%' .$this->search . '%';
        $student = User::where('name','LIKE',$search)
        ->orwhere('school_id','LIKE',$search)->paginate(5);
        return view('admin.view-student-user',['student'=>$student]);
    }
}