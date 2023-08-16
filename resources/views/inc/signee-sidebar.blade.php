@if(Auth::guard('signee'))
<style>
  .w3-sidebar{
    background-color: rgb(3, 3, 142) !important;
    height:300px;
    position: sticky;
    z-index: 2;
    /* margin-top: 50px; */
}
</style>

  <style>

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
    color: rgb(0, 0, 0);
    text-decoration: none;
  }
  .dropdown-menu{
  
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
    top: 0 !important;
     bottom: 0 !important;
     left: 0 !important;
    background-color: rgb(3, 3, 142) !important;
    margin: 0;
    
    width: 100%;
    position: sticky !important;
    z-index: 1; 
  }
  </style>
<div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="leftMenu">
  <button onclick="closeLeftMenu()" class="w3-bar-item w3-button w3-large"><div style="float: right">&#9776;</div></button>
  <hr> 
 <!-- Authentication Links -->
  <a class="w3-bar-item w3-button signee_sidebar_label"  href="{{url('/signee/signeedashboard')}}"><img src="{{asset('img/dashboard.png')}}" alt="Italian Trulli"> <b>Dashboard</b></a>
  <a class="w3-bar-item w3-button signee_sidebar_label" href="{{url('/signee/quick-view-request')}}"><img src="{{asset('img/requesticon.png')}}" alt="Italian Trulli"> <b>Quick View Request</b></a>
  <a class="w3-bar-item w3-button signee_sidebar_label" href="{{url('/signee/view-signee-pending-request')}}"><img src="{{asset('/img/add-student.png')}}" alt="Italian Trulli"> <b>Pending Request</b></a>
  <a class="w3-bar-item w3-button signee_sidebar_label" onclick="open_guide_Form()"><img src="{{asset('img/open-book-edited.png')}}" alt="Italian Trulli"> <b>Guide</b></a>
      
  </div>
 

  {{-- <ul > --}}
    {{-- <li class="signee_nav"> <a  href="{{url('/signee/signeedashboard')}}"><img src="/img/dashboard.png" alt="Italian Trulli"> <b>Dashboard</b></a></li>
    <li class="signee_nav" > <a href="{{url('/signee/view-signee-pending-request')}}"><img src="/img/requesticon.png" alt="Italian Trulli"> <b>Request</b></a></li>
    <li class="signee_nav" ><a onclick="open_guide_Form()"><img src="/img/open-book-edited.png" alt="Italian Trulli"> <b>Guide</b></a> --}}
      <div class="guide-form-popup" id="guide_form">
        <p><p class="guide_title"><b>HI THERE BEAUTIFUL CREATURE!<br>
              WELCOME TO OLLCF E-CLEARANCE GUIDE</b></p><br>
            The e-clearance has 3 phases to be followed. Each Phase has different functionalities,
            requirements and instructions so please read carefully.<br><br>
            <img class="phases_img" src = "{{ asset('img/book.gif') }}" alt="Italian Trulli">
            <img class="phases_img" src = "{{ asset('img/phases.jpg') }}" alt="Italian Trulli">
            <br><br>
            <b>PHASE 1:</b><br>
              Phase 1 is open to approved your e-clearance by your SUBJECTS INSTRUCTOR,
              you must submit all your incomplete requirements
              like project, quiz, exam or depends on what they are requesting you to approved your e-clearance.<br><br>

            <b>PHASE 2:</b><br>
              This Phase as well is open for <b>GUIDANCE COUNSELOR</b> and <b>STUDENT ORGANIZATION TREASURER
              (your department treasurer)</b>
              even the phase 1 status are not yet approved.This phase
              2 is about individual evaluation and must be process 
              as soon as possible to reduce the delay of processing your e-clearance.<br><br>
              
            <b>PHASE 3:</b><br>
              Phase 3 are very strict in approving your e-clearance.Before this phase can open,
              all of your status in phase 1 and 2 <b>MUST</b> be all <b>APPROVED</b>.
              Once this is open, your e-clearance will be process in sequence by the <b>LIBRARIAN,
              DEAN of STUDENT AFFAIR, DEAN PRINCIPAL (this is your department head or dean),
              REGISTRAR and ASSESSMENT OFFICE.</b><br><br><br><br>

            <b>STATUS AND DESCRIPTIONS</b><br>
              There are 4 types of Status, this are <b>APPROVED,IN-PROGRESS, COMPLY and REJECTED.</b><br><br>

              <p style="color:green"><b>APPROVED:</b></p>If you see this in your status boxes, this means
              you are cleared and can proceed to the next signee if there are any signees left.<br><br>

              <p style="color:blue"><b>IN-PROGRESS:</b></p>If you see this in your status boxes, this means your e-clearance are being 
              process or check if you have to submit any requirements before approval.<br><br>

              <b><p style="color:orange">COMPLY:</b></p>If you see this in your status boxes, it means that you have to submit or follow an
              instructions.A button will appear in your description box <b>("view details")</b> and you must do what is 
              written inside.<br><br>

              <p style="color:red"><b>REJECTED:</b></p>If you see this in your status boxes, it means that you failed in evaluation or to submit
              what are requested to approved your e-clearance.This may lead you to fail the current semester you are in to.<br><br>

              <b>DESCRIPTION:</b><br> this box in your e-clearance will serve as to view of what you need to comply or submit to
              your signee that put your status in COMPLY or REJECTED.A button will appear inside the box <b>(view details)</b> to see 
              what they are requesting you to submit. <br><br>
              <hr>
              <br>
              <button type="button" class="guide_btn" onclick="close_guide_Form()"><b>Close</b></button> 
        </p>

      </div>
    {{-- </li> --}}
    @guest
    @if (Route::has('login'))
      <button class="login_style"><a  href="{{ route('login') }}">{{ __('Login') }}</a></button>
    @endif
    @else
    <div class="user_btn">
      <button class="w3-button" onclick="openLeftMenu()">&#9776;</button>
      <a>
        
        <a id="navbarDropdown" class="user-name w3-bar-item w3-button dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        <img src = "{{ asset('/img/active-user.png') }}" alt="Italian Trulli"><b> {{ Auth::user()->name }} ({{Auth::user()->role_as}})</b>
        
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
          <form id="logout-form" method="POST" action="{{ route('signee.signeedashboard') }}">
            @csrf
         </form>
        </div>
      </div>
     
    
  @endguest

  {{-- </ul> --}}
@endif






              
