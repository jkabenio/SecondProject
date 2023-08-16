@extends('layouts.admin-app')

@section('content')
 <style>
.edit-signee_view{
    padding-top: 39px;
    }
.edit_signee_column{
    width: 50%;
    float: left;
    padding-right: 10px;
}
.signee_update_btn{
    margin-left: 555px;
}
.signee_edit_label{
    margin-left: 250px;
    font-weight: bold;
}
.form-control{
 background-color: #e9ecef;
}
</style>
<div class="edit-signee_view">
    <div class="card" style=" border: 2px solid black">
        <div class="card-header">
            <div class="container">
                <div class="error">
                    @if(count($errors) > 0)
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger" style="text-align: center">
                                {{$error}}
                            </div>
                        @endforeach
                    @endif
            
                    @if(session('success'))
                        <div class="alert alert-success" style="text-align: center">
                            {{session('success')}}
                        </div>
                    @endif
            
                    @if(session('error'))
                        <div class="alert alert-danger" style="text-align: center">
                            {{session('error')}}
                        </div>
                    @endif
                </div>
            </div>
            <h4 style="text-align: center"> <b> Edit User </b>
                <a href="{{url('/admin/view-signee-user')}}" class="btn btn-danger float-end">BACK</a>
            </h4>
        </div>
        {!! Form::open(['action' => ['App\Http\Controllers\Admin\AdminController@update_signee',$signee_id->id],'enctype' => 'multipart/form-data']) !!}
        <div class="card-body">
            @csrf
            @method('PUT')
           <div class="edit_signee_row">
                <div class="edit_signee_column">
                    <label class="signee_edit_label">Signee Name <span style="font-weight: normal; font-size: 10px">(Editable)</span></label>
                    <input style="text-align: center" type="text" name="name" value="{{$signee_id->name}}" class="form-control">
                </div>
                <div class="edit_signee_column">
                    <label class="signee_edit_label">Role <span style="font-weight: normal; font-size: 10px">(Editable)</span></label>                   
                        <select style="text-align: center" name="role_as" class="form-control">
                            <option value="{{$signee_id->role_as}}">{{$signee_id->role_as}}</option>
                            @foreach ($roles as $item)
                            @if($item->role_name !== $signee_id->role_as &&  strcasecmp($item->role_name,'Student') !== 0)
                                    <option value="{{$item->role_name}}">{{$item->role_name}}</option>
                                @endif
                            @endforeach                                      
                        </select>
                </div>

                <div class="edit_signee_column">
                    <label class="signee_edit_label">Department <span style="font-weight: normal; font-size: 10px">(Editable)</span></label>                   
                    <select style="text-align: center" name="dept_id" class="form-control">
                        @foreach($dept_list as $list)
                            @if($signee_id->dept_id == $list->id)
                                <option value="{{$signee_id->dept_id}}">{{$list->dept_name}}</option> 
                            @endif
                            @if($signee_id->dept_id == 0)
                                <option value="0">Not Applicable</option>
                                @break
                            @endif
                        
                        @endforeach
                        @if($signee_id->dept_id !== 0)
                        <option value="0">Not Applicable</option>
                    @endif   
                        @foreach($dept_list as $list)
                            @if($signee_id->dept_id !== $list->id)
                                <option value="{{$list->id}}">{{$list->dept_name}}</option>
                            @endif
                        @endforeach
                    
                    </select>
                </div>
                <div class="edit_signee_column">
                    <label class="signee_edit_label">Signee Email <span style="font-weight: normal; font-size: 10px">(Editable)</span></label>
                    <input style="text-align: center" type="text" name="email" value="{{$signee_id->email}}" class="form-control">
                </div>

                <div class="edit_signee_column">
                    <label class="signee_edit_label">Signee School ID <span style="font-weight: normal; font-size: 10px">(Editable)</span></label>
                    <input style="text-align: center" name="school_id" type="text" value="{{$signee_id->school_id}}" class="form-control">
                </div>
                
                <div class="edit_signee_column">
                    <label class="signee_edit_label">Created At</label>
                    <p style="text-align: center" class="form-control">
                        {{date('M,d,D,Y,g:i A',strtotime($signee_id->created_at))}}</p>
                </div>
                <div class="edit_signee_column">
                    <label class="signee_edit_label">Updated At</label>
                    <p style="text-align: center" class="form-control">
                        {{date('M,d,D,Y,g:i A',strtotime($signee_id->updated_at))}}</p>
                </div>
                <div class="edit_signee_column">
                    <label class="signee_edit_label">Deleted At</label>
                    <p style="text-align: center" class="form-control">
                        {{date('M,d,D,Y,g:i A',strtotime($signee_id->deleted_at))}}</p>
                </div>
    
    
            

                {{-- <div class="mb-3">
                        <label>Role as</label>
                        <select name="role_as" class="form-control">
                            <option value="2" {{ $student_id->role_as == '2' ? 'selected' : '' }}>Instructor</option>
                            <option value="1" {{ $student_id->role_as == '1' ? 'selected' : '' }}>Admin</option>                      
                            <option value="0" {{ $student_id->role_as == '0' ? 'selected' : '' }}>Student</option>  
                        </select>
    
                    </div> --}}

                    <div class="signee_update_btn">
                        <button type="submit" class="btn btn-primary">Update User</button>
                    </div>
                </div>       
            {!! Form::close() !!}
        
    </div>
</div>
@endsection