@extends('layouts.student-app')

@section('content')









<style>
    .student-clearance-form-popup {
        display: none;
        position: fixed;
        top:35%;
        left: 35%;
        right: 35%;
        bottom: 40%;
        border: 3px solid #0800ff;
        z-index: 9;
        background-color: rgb(212, 212, 212);
        width: 500px;
        margin: -50px 0 0 -50px;
      }
      
      /* Add styles to the form container */
      .form-container-activity {
        margin: auto !important;
        width: 300px !important;
        height: 300px !important;
        overflow: auto !important;
      /* way to prevent an element from scrolling its parent. */
      overscroll-behavior: contain;
      }
      
      /* Set a style for the submit/login button */
      .form-container-activity .btn_cancel {
        background-color: #04AA6D;
        color: white;
        padding: 16px 20px;
        border: none;
        cursor: pointer;
        width: 100%;
        margin-bottom:10px;
        opacity: 0.8;
      }
      
      /* Add a red background color to the cancel button */
      .form-container-activity .cancel {
        background-color: red;
        width: 50px;
        font-size: 12px;
        height: 24px;
        padding-top: 2px;
        margin-top: 0px;
        margin-bottom: 0px;
        border-radius: 0px;
        margin-left: 250px;
        /* position: fixed; */
      }
      
      /* Add some hover effects to buttons */
      .form-container-activity .btn_cancel:hover, .open-button:hover {
        opacity: 1;
      } 
       /* Remove scrollbar space */
        /* Optional: just make scrollbar invisible */
      /* ::-webkit-scrollbar {
      width: 0; 
      background: transparent; 
      } */
      .btn.cancel{
       
        background-color: red;
        color: white;
    
      }
      .form-control{
        background-color: #e9ecef;
      }
      .description_info{
        height: 155px;
        width: 490px;
      }
    
      select[readonly]
    {
        pointer-events: none;
    }
    /* irrelevent styling */
    *[readonly]
    {
    
    }
    </style>








@foreach($student as $users)
    @if(Auth::user()->id == $users->id)
    @php
    $passed_status = array();
    foreach ($users->status as $signee_list){
        $value = $signee_list; 
        array_push($passed_status, $value);
    }
    // print_r ($passed_status);  
@endphp 
        <div class="clearance_body_student">        
            <div class="card-header-dashboard">
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
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <a class="logout_btn" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <b>{{ __('Logout') }}  </b>
                </a>
                <div class="logo_inside">
                    <img class="ollcf_logo_css" src = "{{ asset('/img/Ollfc_Logo.png') }}" alt="Italian Trulli"/>
                </div>
                <h2 style="text-align: center"><b> Our Lady of Lourdes College Foundation</h2>
                <h5 style="text-align: center">Daet, Camarines Norte</h5>
                <h4 style="text-align: center">E-CLEARANCE</b>
                </h4>
                <p  style="text-align: center;font-size: 12px"> 
                    {{$users->year_lvl}}<br>
                    {{$users->semester}}
                </p>
                
                <div class="two_column ">
                    <div class="form-control">
                        @guest
                            @if (Route::has('login'))
                                    <button class="login_style"><a  href="{{ route('login') }}">{{ __('Login') }}</a></button>
                            @endif
                            <br>
                            @if (Route::has('register'))
                                    <button class="login_style"><a  href="{{ route('register') }}">{{ __('Register') }}</a></button>
                            @endif
                            @else
                            {{--class="nav-link_name dropdown-toggle"
                            
                                class="dropdown-menu dropdown-menu-center"--}}
                            <a>
                                
                                <a id="navbarDropdown"   role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <b >{{ Auth::user()->name }}</b>
                                </a>
                            </a>
                            
                            <div   aria-labelledby="navbarDropdown" >
                                <a  class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}   
                                </a>
                                <form  id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                            </a>
                        @endguest
                    </div>
                </div>
                <div class="two_column ">
                    <p class="form-control" onclick="RevealHiddenOverflow(this)">
                        @foreach($course as $course_list)
                            @if($course_list->id == Auth::user()->course)
                                <b>{{$course_list->course_name}}</b>
                            @endif
                            
                        @endforeach
                        {{-- <b>{{$users->year_lvl}}</b> --}}
                        
                    </p>
                    
                </div>
                
               
            </div>
            <div class="card-body">
                <div class="first_row">
        
                </div>
                <div class="second_row">
                
                        <div class="four_column">
                            <label class="clearance"><b>SUBJECTS</b></label>
                            @foreach($users->subjects as $subject_list)
                                <p class="form-control" title="{{$subject_list}}" onclick="RevealHiddenOverflow(this)">
                                    {{$subject_list}}
                                </p>
                            @endforeach
                        </div>
                

                    
                        <div class="four_column">
                            <label class="clearance"><b>INSTRUCTOR</b></label>
                            @foreach($users->student_signee_names as $signee_list)
                                <p class="form-control" onclick="RevealHiddenOverflow(this)">
                                    {{$signee_list}}
                                </p>
                            @endforeach
                        </div>
                    
                    <div class="four_column" onclick="RevealHiddenOverflow(this)">
                        <label class="clearance"><b>STATUS</b></label>
                        @foreach($users->status as $status_list)
                            @if($status_list == "IN-PROGRESS")
                            <p class="form-control" style="color:blue" onclick="RevealHiddenOverflow(this)"><b>{{$status_list}}</b></p>
                            @endif
                            @if($status_list == "COMPLY")
                            <p class="form-control" style="color:orange" onclick="RevealHiddenOverflow(this)"><b>{{$status_list}}</b></p>
                            @endif
                            @if($status_list == "REJECTED")
                            <p class="form-control" style="color:red" onclick="RevealHiddenOverflow(this)"><b>{{$status_list}}</b></p>
                            @endif
                            @if($status_list == "APPROVED")
                            <p class="form-control" style="color:green" onclick="RevealHiddenOverflow(this)"><b>{{$status_list}}</b></p>
                            @endif
                        @endforeach
                    </div>  
                    <div class="four_column">
                        <label class="clearance"><b>DESCRIPTION</b></label>
                        @foreach ($users->description as $count_data => $description_list)
                        @if($description_list !== null && $passed_status[$count_data] !== "APPROVED")  
                            <p class="form-control" style="text-align:center;"><a onclick="openForm({{$count_data}})"><b>View Detail</b></a></p>
                        @endif
                        @if( $description_list == null && $passed_status[$count_data] !== "APPROVED")  
                        <p class="form-control"></p>
                    @endif
                        @if(($description_list == null || $description_list !== null) && $passed_status[$count_data] == "APPROVED")
                        <p class="form-control"></p>
                        @endif      
                            <div class="student-clearance-form-popup" id="myForm{{$count_data}}">
                                <textarea readonly="readonly" class="description_info" value="{{$description_list}}">{{$description_list}}</textarea>
                                <button type="button" class="btn cancel" onclick="closeForm({{$count_data}})">Close</button>       
                            </div>
                        @endforeach     
                    </div>


                    <?php
                    $total_count = 0;
                    $current_status = 0;
                 ?>
                @foreach($users->status as $status_list)
                    <?php
                        if($status_list == "APPROVED"){
                            $current_status++;
                        }
                        $total_count++;
                    ?>
                @endforeach
                <style>
                    .greetings{
                        background: #0E00CF;
                        background: repeating-radial-gradient(circle farthest-corner at center center, #0E00CF 0%, #00128A 50%, #CF0000 100%);
                        -webkit-background-clip: text;
                        -webkit-text-fill-color: transparent;
                        
                    }
                </style>
                @if($total_count == $current_status && $users->guidance_councilor == "APPROVED" && $users->student_org_treasurer == "APPROVED" && $users->dean_of_student_affair == "APPROVED" && $users->dean_principal == "APPROVED" && $users->registrar == "APPROVED" && $users->accounting_assessment == "APPROVED" && $users->librarian == "APPROVED")
                <h1 class="greetings"><b><img src = "{{ asset('/img/party-popper.png') }}" width="5%" height="5%">CONGRATULATIONS<img src = "{{ asset('/img/party-popper.png') }}" width="5%" height="5%"><br><img src = "{{ asset('/img/party.png') }}" width="5%" height="5%">"{{ Auth::user()->name }}"<img src = "{{ asset('/img/party.png') }}" width="5%" height="5%"> <br> YOUR E-CLEARANCE IS NOW COMPLETE!</b></h1>
                
            @endif


                    <div class="four_column_general">
                        <label class="clearance"><b>Guidance Councilor</b></label>
                        @if($users->guidance_councilor == "IN-PROGRESS")
                            <p class="form-control" style="color:blue" onclick="RevealHiddenOverflow(this)"><b>{{$users->guidance_councilor}}</b></p>
                        @endif
                        @if($users->guidance_councilor == "COMPLY")
                            <p class="form-control" style="color:orange" onclick="RevealHiddenOverflow(this)"><b>{{$users->guidance_councilor}}</b></p>
                        @endif
                        @if($users->guidance_councilor == "REJECTED")
                            <p class="form-control" style="color:red" onclick="RevealHiddenOverflow(this)"><b>{{$users->guidance_councilor}}</b></p>
                        @endif
                        @if($users->guidance_councilor == "APPROVED")
                            <p class="form-control" style="color:green" onclick="RevealHiddenOverflow(this)"><b>{{$users->guidance_councilor}}</b></p>
                        @endif
                        <label class="clearance"><b>Description</b></label>
                        @if(($users->guidance_councilor_description !== null) && ($users->guidance_councilor == "REJECTED" || $users->guidance_councilor== "COMPLY"))  
                            <p class="form-control" style="text-align:center;"><a onclick="open_guidance_councilor_Form()"><b>View Details</b></a></p>
                        @endif
                        @if(($users->guidance_councilor_description == null) && ($users->guidance_councilor == "REJECTED" || $users->guidance_councilor== "COMPLY"))  
                            <p class="form-control"></p>
                        @endif
                        @if(($users->guidance_councilor_description == null || $users->guidance_councilor_description !== null) && ($users->guidance_councilor == "IN-PROGRESS" || $users->guidance_councilor == "APPROVED"))
                            <p class="form-control"></p>
                        @endif      
                        <div class="student-clearance-form-popup" id="guidance_councilor_form">
                            <textarea readonly="readonly" class="description_info" value="{{$users->guidance_councilor_description}}">{{$users->guidance_councilor_description}}</textarea>
                            <button type="button" class="btn cancel" onclick="close_guidance_councilor_Form()">Close</button>       
                        </div>     
                    </div>
                    <div class="four_column_general">
                        <label class="clearance"><b>Student Org. Treasurer</b></label>
                        @if($users->student_org_treasurer == "IN-PROGRESS")
                            <p class="form-control" style="color:blue" onclick="RevealHiddenOverflow(this)"><b>{{$users->student_org_treasurer}}</b></p>
                        @endif
                        @if($users->student_org_treasurer == "COMPLY")
                            <p class="form-control" style="color:orange" onclick="RevealHiddenOverflow(this)"><b>{{$users->student_org_treasurer}}</b></p>
                        @endif
                        @if($users->student_org_treasurer == "REJECTED")
                            <p class="form-control" style="color:red" onclick="RevealHiddenOverflow(this)"><b>{{$users->student_org_treasurer}}</b></p>
                        @endif
                        @if($users->student_org_treasurer == "APPROVED")
                            <p class="form-control" style="color:green" onclick="RevealHiddenOverflow(this)"><b>{{$users->student_org_treasurer}}</b></p>
                        @endif
                        <label class="clearance"><b>Description</b></label>
                        @if(($users->student_org_description !== null) && ($users->student_org_treasurer == "REJECTED" || $users->student_org_treasurer == "COMPLY"))
                            <p class="form-control" style="text-align:center;"><a onclick="open_treasurer_Form()"><b>View Details</b></a></p>
                        @endif
                        @if(($users->student_org_description == null) && ($users->student_org_treasurer == "REJECTED" || $users->student_org_treasurer == "COMPLY"))
                        <p class="form-control"></p>
                    @endif
                        @if(($users->student_org_description == null || $users->student_org_description !== null) && ($users->student_org_treasurer == "IN-PROGRESS" || $users->student_org_treasurer == "APPROVED"))
                        <p class="form-control"></p>
                        @endif      
                        <div class="student-clearance-form-popup" id="student_org">
                            <textarea readonly="readonly" class="description_info" value="{{$users->student_org_description}}">{{$users->student_org_description}}</textarea>
                            <button type="button" class="btn cancel" onclick="close_treasurer_Form()">Close</button>       
                        </div>
                    </div>
                    <div class="four_column_general"> 
                        <label class="clearance"><b>Librarian</b></label>
                        @if($users->librarian == "IN-PROGRESS")
                            <p class="form-control" style="color:blue" onclick="RevealHiddenOverflow(this)"><b>{{$users->librarian}}</b></p>
                        @endif
                        @if($users->librarian == "COMPLY")
                            <p class="form-control" style="color:orange" onclick="RevealHiddenOverflow(this)"><b>{{$users->librarian}}</b></p>
                        @endif
                        @if($users->librarian == "REJECTED")
                            <p class="form-control" style="color:red" onclick="RevealHiddenOverflow(this)"><b>{{$users->librarian}}</b></p>
                        @endif
                        @if($users->librarian == "APPROVED")
                            <p class="form-control" style="color:green" onclick="RevealHiddenOverflow(this)"><b>{{$users->librarian}}</b></p>
                        @endif
                        <label class="clearance"><b>Description</b></label>
                        @if(($users->librarian_description !== null) && ($users->librarian == "REJECTED" || ($users->librarian == "COMPLY"))) 
                            <p class="form-control" style="text-align:center;"><a onclick="open_librarian_Form()"><b>View Details</b></a></p>
                        @endif
                        @if(($users->librarian_description == null) && ($users->librarian == "REJECTED" || ($users->librarian == "COMPLY"))) 
                            <p class="form-control"></p>
                        @endif
                        @if(($users->librarian_description == null || $users->librarian_description !== null) && ($users->librarian == "APPROVED" || $users->librarian == "IN-PROGRESS"))
                            <p class="form-control"></p>
                        @endif      
                        <div class="student-clearance-form-popup" id="librarian_form">
                            <textarea readonly="readonly" class="description_info" value="{{$users->librariran_description}}">{{$users->librarian_description}}</textarea>
                            <button type="button" class="btn cancel" onclick="close_librarian_Form()">Close</button>       
                        </div>
                        </p>
                    </div>   
                    <div class="four_column_general">
                        <label class="clearance"><b>Dean of Student affair</b></label>
                        @if($users->dean_of_student_affair == "IN-PROGRESS")
                            <p class="form-control" style="color:blue" onclick="RevealHiddenOverflow(this)"><b>{{$users->dean_of_student_affair}}</b></p>
                        @endif
                        @if($users->dean_of_student_affair == "COMPLY")
                            <p class="form-control" style="color:orange"><b>{{$users->dean_of_student_affair}}</b></p>
                        @endif
                        @if($users->dean_of_student_affair == "REJECTED")
                            <p class="form-control" style="color:red" onclick="RevealHiddenOverflow(this)"><b>{{$users->dean_of_student_affair}}</b></p>
                        @endif
                        @if($users->dean_of_student_affair == "APPROVED")
                            <p class="form-control" style="color:green" onclick="RevealHiddenOverflow(this)"><b>{{$users->dean_of_student_affair}}</b></p>
                        @endif
                        <label><b>Description</b></label>
                        @if(($users->dean_of_student_affair_description !== null) && ($users->dean_of_student_affair == "REJECTED" || $users->dean_of_student_affair == "COMPLY"))
                            <p class="form-control" style="text-align:center;"><a onclick="open_studentaffair_Form()"><b>View Details</b></a></p>
                        @endif
                        @if(($users->dean_of_student_affair_description == null) && ($users->dean_of_student_affair == "REJECTED" || $users->dean_of_student_affair == "COMPLY"))
                            <p class="form-control"></p>
                        @endif
                        @if(($users->dean_of_student_affair_description == null || $users->dean_of_student_affair_description !== null) && ($users->dean_of_student_affair == "APPROVED" || ($users->dean_of_student_affair == "IN-PROGRESS")))
                            <p class="form-control"></p>
                        @endif      
                        <div class="student-clearance-form-popup" id="studentaffair_form">
                            <textarea readonly="readonly" class="description_info" value="{{$users->dean_of_student_affair_description}}">{{$users->dean_of_student_affair_description}}</textarea>
                            <button type="button" class="btn cancel" onclick="close_studentaffair_Form()">Close</button>       
                        </div>
                    </div>
                    <div class="four_column_general">
                        <label class="clearance"><b>Dean Principal</b></label>
                        @if($users->dean_principal == "IN-PROGRESS")
                            <p class="form-control" style="color:blue" onclick="RevealHiddenOverflow(this)"><b>{{$users->dean_principal}}</b></p>
                        @endif
                        @if($users->dean_principal == "COMPLY")
                            <p class="form-control" style="color:orange" onclick="RevealHiddenOverflow(this)"><b>{{$users->dean_principal}}</b></p>
                        @endif
                        @if($users->dean_principal == "REJECTED")
                            <p class="form-control" style="color:red" onclick="RevealHiddenOverflow(this)"><b>{{$users->dean_principal}}</b></p>
                        @endif
                        @if($users->dean_principal == "APPROVED")
                            <p class="form-control" style="color:green" onclick="RevealHiddenOverflow(this)"><b>{{$users->dean_principal}}</b></p>
                        @endif
                        <label class="clearance"><b>Description</b></label>
                        @if(($users->dean_principal_description !== null) && ($users->dean_principal == "REJECTED" || $users->dean_principal == "COMPLY")) 
                            <p class="form-control" style="text-align:center;"><a onclick="open_deanprincipal_Form()"><b>View Details</b></a></p>
                        @endif
                        @if(($users->dean_principal_description == null) && ($users->dean_principal == "REJECTED" || $users->dean_principal == "COMPLY")) 
                            <p class="form-control"></p>
                        @endif
                        @if(($users->dean_principal_description == null || $users->dean_principal_description !== null) && ($users->dean_principal == "APPROVED" || $users->dean_principal == "IN-PROGRESS"))
                            <p class="form-control"></p>
                        @endif      
                        <div class="student-clearance-form-popup" id="deanprincipal_form">
                            <textarea readonly="readonly" class="description_info" value="{{$users->dean_principal_description}}">{{$users->dean_principal_description}}</textarea>
                            <button type="button" class="btn cancel" onclick="close_deanprincipal_Form()">Close</button>       
                        </div>
                    </div>
                
                    <div class="four_column_general">
                        <label class="clearance"><b>Registrar</b></label>
                        @if($users->registrar == "IN-PROGRESS")
                            <p class="form-control" style="color:blue" onclick="RevealHiddenOverflow(this)"><b>{{$users->registrar}}</b></p>
                        @endif
                        @if($users->registrar == "COMPLY")
                            <p class="form-control" style="color:orange" onclick="RevealHiddenOverflow(this)"><b>{{$users->registrar}}</b></p>
                        @endif
                        @if($users->registrar == "REJECTED")
                            <p class="form-control" style="color:red" onclick="RevealHiddenOverflow(this)"><b>{{$users->registrar}}</b></p>
                        @endif
                        @if($users->registrar == "APPROVED")
                            <p class="form-control" style="color:green" onclick="RevealHiddenOverflow(this)"><b>{{$users->registrar}}</b></p>
                        @endif
                        <label class="clearance"><b>Description</b></label>
                        @if(($users->registrar_description !== null) && ($users->registrar == "REJECTED" || $users->registrar == "COMPLY"))
                            <p class="form-control" style="text-align:center;"><a onclick="open_registrar_Form()"><b>View Details</b></a></p>
                        @endif
                        @if(($users->registrar_description == null) && ($users->registrar == "REJECTED" || $users->registrar == "COMPLY"))
                            <p class="form-control"></p>
                        @endif
                        @if(($users->registrar_description == null || $users->registrar_description !== null) && ($users->registrar == "APPROVED" || $users->registrar == "IN-PROGRESS"))
                        <p class="form-control"></p>
                        @endif      
                        <div class="student-clearance-form-popup" id="registrar_form">
                            <textarea readonly="readonly" class="description_info" value="{{$users->registrar_description}}">{{$users->registrar_description}}</textarea>
                            <button type="button" class="btn cancel" onclick="close_registrar_Form()">Close</button>       
                        </div> 
                    </div>
                    <div class="four_column_general">
                        <label class="clearance"><b>Accounting-Assessment</b></label>
                        @if($users->accounting_assessment == "IN-PROGRESS")
                            <p class="form-control" style="color:blue" onclick="RevealHiddenOverflow(this)"><b>{{$users->accounting_assessment}}</b></p>
                        @endif
                        @if($users->accounting_assessment == "COMPLY")
                            <p class="form-control" style="color:orange" onclick="RevealHiddenOverflow(this)"><b>{{$users->accounting_assessment}}</b></p>
                        @endif
                        @if($users->accounting_assessment == "REJECTED")
                            <p class="form-control" style="color:red" onclick="RevealHiddenOverflow(this)"><b>{{$users->accounting_assessment}}</b></p>
                        @endif
                        @if($users->accounting_assessment == "APPROVED")
                            <p class="form-control" style="color:green" onclick="RevealHiddenOverflow(this)"><b>{{$users->accounting_assessment}}</b></p>
                        @endif
                        <label class="clearance"><b>Description</b></label>
                        @if(($users->accounting_assessment_description !== null) && ($users->accounting_assessment == "REJECTED" || $users->accounting_assessment == "COMPLY")) 
                            <p class="form-control" style="text-align:center;"><a onclick="open_assessment_Form()"><b>View Details</b></a></p>
                        @endif
                        @if(($users->accounting_assessment_description == null) && ($users->accounting_assessment == "REJECTED" || $users->accounting_assessment == "COMPLY")) 
                            <p class="form-control"></p>
                        @endif
                        @if(($users->accounting_assessment_description == null || $users->accounting_assessment_description !== null) && ($users->accounting_assessment == "APPROVED" || $users->accounting_assessment == "IN-PROGRESS"))
                        <p class="form-control"></p>
                        @endif      
                        <div class="student-clearance-form-popup" id="assessment_form">
                            <textarea readonly="readonly" class="description_info" value="{{$users->accounting_assessment_description}}">{{$users->accounting_assessment_description}}</textarea>
                            <button type="button" class="btn cancel" onclick="close_assessment_Form()">Close</button>       
                        </div>
                    </div> 
                </div>  
            </div>
    <button class="w3-bar-item w3-button" onclick="open_guide_Form()"><img src="{{asset('img/open-book-edited.png')}}" alt="Italian Trulli"> <b>Guide</b></button>
    @endif
    
@endforeach
 @include('student.user-activity')
@endsection
