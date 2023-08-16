
<style>
/* Remove scrollbar space */
/* Optional: just make scrollbar invisible */

.w3-sidebar{
  background-color: rgb(3, 3, 142) !important;
  position: sticky ;
  z-index: 2;
  /* margin-top: 50px; */
}
.signee_nav{
  display: block;
  padding: 10px;
  padding-top: 13px; 
  font-size: 15px;
  cursor: pointer;
}
.user-name{
  float: right !important;
  font-size: 16px;
  height: 38px;
  color: white;
  position: sticky ;
}
.signee_nav:hover{
  background-color: whitesmoke;
  color: rgb(0, 0, 0);
  text-decoration: none;
}
.dropdown-item{
  float:left !important;
  margin-left: 0% !important;
}
a:hover{
  background-color: whitesmoke;
  color: rgb(0, 0, 0)!important;
  text-decoration: none;
}
.phases_img{
  width: 50%;
  height: 50%;
}
.w3-button{
  background-color: rgb(3, 3, 142) !important;
  /* width: 50%; */
color: white;

}
.user_btn{
  background-color: rgb(3, 3, 142) !important;

  width: 100%;
  position: fixed !important;
  z-index: 1;
  height:39px;
  margin: 0px;
}
</style>
@if(Auth::user())
  <style>
    ::-webkit-scrollbar{
    width: 0; 
    background: transparent; 
  }
  </style>
@guest
    @if (Route::has('login'))
      <button class="login_style"><a  href="{{ route('login') }}">{{ __('Login') }}</a></button>
    @endif
    @else
    <div class="user_btn">
      <button class="w3-button" onclick="openLeftMenu()">&#9776;</button>
      <a>
        
        <a id="navbarDropdown" class="user-name w3-bar-item w3-button dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        <img src = "{{ asset('/img/active-user.png') }}" alt="Italian Trulli"><b> {{ Auth::user()->name }}</b>
        
      </a>
  
        <div class="dropdown-menu  dropdown-menu-end" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
          </a>
          {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form> --}}
          <form id="logout-form" method="POST" action="{{ route('admin.admindashboard') }}">
            @csrf
            {{-- <button type="submit" class="btn btn-primary">Logout</button> --}}
         </form>
        </div>
      </div>
  @endguest
<b> 
  <div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="leftMenu">
    <button onclick="closeLeftMenu()" class="w3-bar-item w3-button w3-large"><div style="float: right">&#9776;</div></button>
      <hr>
    <!-- Authentication Links -->
    <a href="{{url('/admin/admindashboard')}}" style="text-decoration: none;" class="w3-bar-item w3-button"><img src="{{asset('/img/dashboard.png')}}" alt="Italian Trulli"> DashBoard</a>
    <a class="w3-bar-item w3-button" style="text-decoration: none;" href="{{url('/admin/view-pending-request')}}"><img src="{{asset('/img/requesticon.png')}}" alt="Italian Trulli"> Pending Request</a>
    <a class="w3-bar-item w3-button" style="text-decoration: none;" href="{{url('/admin/complete-request')}}"><img src="{{asset('/img/completed-task.png')}}" alt="Italian Trulli"> Complete Request</a>
    <button class="dropdown-btn w3-bar-item w3-button"><img src="{{asset('/img/department.png')}}" alt="Italian Trulli"> Department<i class="fa fa-caret-down"></i></button>
    <div class="dropdown-container ">
      <a class="a_link" href="{{url('/admin/add-department')}}">Add Department</a>
      <a class="a_link" href="{{url('/admin/view-department')}}">Department List</a>
    </div>
    <button class="dropdown-btn w3-bar-item w3-button"><img  src="{{asset('/img/online-course.png')}}" alt="Italian Trulli"> Courses<i class="fa fa-caret-down"></i></button>
    <div class="dropdown-container">
      <a class="a_link" href="{{url('/admin/add-course')}}">Add Course</a>
      <a class="a_link" href="{{url('/admin/view-course')}}">Course List</a>
    </div>

    <button class="dropdown-btn w3-bar-item w3-button"><img src="{{asset('/img/books.png')}}" alt="Italian Trulli"> Subjects
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
      <a class="a_link" href="{{url('/admin/add-subject')}}">Add Subject</a>
      <a class="a_link" href="{{url('/admin/view-subject')}}">Subject List</a>
    </div>

    <button class="dropdown-btn w3-bar-item w3-button"><img src="{{asset('/img/add-student.png')}}" alt="Italian Trulli"> Add Student Account
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
      <a class="a_link" href="{{url('/admin/add-student')}}">Add Student</a>
      <a class="a_link" href="{{url('/admin/view-student-user')}}">Student List</a>
      <a class="a_link" href="{{url('/admin/change-student-password')}}">Change Student Password</a>
    </div> 

    <button class="dropdown-btn w3-bar-item w3-button"><img src="{{asset('/img/teacher.png')}}" alt="Italian Trulli"> Add Signee Account
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
      <a class="a_link" href="{{url('/admin/add-signee')}}">Add Signee</a>
      <a class="a_link" href="{{url('/admin/view-signee-user')}}">Signee List</a>
      <a class="a_link" href="{{url('/admin/change-signee-password')}}">Change Signee Password</a>
    </div>

    <button class="dropdown-btn w3-bar-item w3-button"><img src="{{asset('/img/employee.png')}}" alt="Italian Trulli"> Add New Role
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
      <a class="a_link" href="{{url('/admin/add-role')}}">Add Role</a>
      <a class="a_link" href="{{url('/admin/view-role')}}">Role List</a>
    </div>
    <a class="w3-bar-item w3-button" style="text-decoration: none;" href="{{url('/admin/trash')}}"><img src="{{asset('/img/recycle-bin.png')}}" alt="Italian Trulli"> Recyle Bin</a>
    <a class="w3-bar-item w3-button" style="text-decoration: none;" href="{{url('/admin/print-student-clearance')}}"><img src="{{asset('/img/add-file.png')}}" alt="Italian Trulli">Generate Clearance</a>
    {{-- <a href="/admin/change-user-password" class="w3-bar-item w3-button">Change User Password</a> --}}
    {{-- <a href="/view-users" class="w3-bar-item w3-button">Users</a>
    <a href="/create-users" class="w3-bar-item w3-button">Create Users</a> --}}
    </div>
    <div>
    </b>
  
@endif