<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts --> 
  <script src="{{ asset('js/app.js') }}"></script>
  <link rel="icon" type="image/png"  href="{{url('/img/web_logo.png')}}">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  {{-- <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script> --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
  <main>
    @include('inc.messages')
        @yield('content')
  </main>
  <script>
    function open_active_user_Form() {
      document.getElementById("my_active_user_Form").style.display = "block";
    }

    function close_active_user_Form() {
      document.getElementById("my_active_user_Form").style.display = "none";
    }
    function open_guide_Form() {
         document.getElementById("guide_form").style.display = "block";
       }
       function close_guide_Form() {
         document.getElementById("guide_form").style.display = "none";
       }
    //
       function openForm(count_data) {
         document.getElementById(`myForm${count_data}`).style.display = "block";
       }
       function closeForm(count_data) {
         document.getElementById(`myForm${count_data}`).style.display = "none";
       }
   //
       function opensigneeForm() {
           document.getElementById("signeeForm").style.display = "block";
       }
       function closesigneeForm() {
         document.getElementById("signeeForm").style.display = "none";
       }
   //
       function open_treasurer_Form() {
         document.getElementById("student_org").style.display = "block";
       }
       function close_treasurer_Form() {
         document.getElementById("student_org").style.display = "none";
       }
   //
       function open_librarian_Form() {
         document.getElementById("librarian_form").style.display = "block";
       }
       function close_librarian_Form() {
         document.getElementById("librarian_form").style.display = "none";
       }
   //
       function open_deanprincipal_Form() {
         document.getElementById("deanprincipal_form").style.display = "block";
       }
       function close_deanprincipal_Form() {
         document.getElementById("deanprincipal_form").style.display = "none";
       }
   //
       function open_studentaffair_Form() {
         document.getElementById("studentaffair_form").style.display = "block";
       }
       function close_studentaffair_Form() {
         document.getElementById("studentaffair_form").style.display = "none";
       }
       //
       function open_guidance_councilor_Form() {
         document.getElementById("guidance_councilor_form").style.display = "block";
       }
       function close_guidance_councilor_Form() {
         document.getElementById("guidance_councilor_form").style.display = "none";
       }
   //
       function open_registrar_Form() {
         document.getElementById("registrar_form").style.display = "block";
       }
       function close_registrar_Form() {
         document.getElementById("registrar_form").style.display = "none";
       }
   //
       function open_assessment_Form() {
         document.getElementById("assessment_form").style.display = "block";
       }
       function close_assessment_Form() {
         document.getElementById("assessment_form").style.display = "none";
       }

       function open_greeting_Form() {
         document.getElementById("greet_form").style.display = "block";
       }
       function close_greeting_Form() {
         document.getElementById("greet_form").style.display = "none";
       }
       
     </script>


  <script type="text/javascript">
    function RevealHiddenOverflow(d)
    {
    if( d.style.overflow == "hidden" ) { d.style.overflow = "visible"; }
    else { d.style.overflow = "hidden"; }
    }
    
  </script>
  <script type="text/javascript">
    $('#student-search-active-user').on('keyup',function()
    {
        $value=$(this).val();
        $.ajax({
            type:'get',
            url:'{{URL::to('student/student-search-active-user')}}',
            data:{'search':$value},
  
            success:function(data)
            {
                console.log(data);
                $('#Student-Search-Active-User-Content').html(data);
   
            }
        });
    });
  </script>
   <script type="text/javascript">
    $('#student-search-active-signee-user').on('keyup',function()
    {
        $value=$(this).val();
        $.ajax({
            type:'get',
            url:'{{URL::to('student/student-search-active-signee-user')}}',
            data:{'search':$value},
  
            success:function(data)
            {
                console.log(data);
                $('#Student-Search-Active-Signee-User-Content').html(data);
   
            }
        });
    });
  </script>
  
</body>
</html>
