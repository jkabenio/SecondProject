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

  {{-- sample sidebar lnk --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      

  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  {{-- <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script> --}}
</head>
<body>
  <div id="app">
    @if(Auth::user())
      @include('inc.signee-sidebar')
    @endif
    <main>
      @include('inc.messages')
        @yield('content')
    </main>
  </div>
  <script>
    // $("document").ready(function(){
    //     setTimeout(function(){
    //        $("div.alert").remove().delay(3000);
    //     }, 5000 ); // 5 secs
    
    // });
    $('div.alert').delay(10000).slideUp(1000);
    </script>
  <script>
    function openLeftMenu() {
      document.getElementById("leftMenu").style.display = "block";
    }
    
    function closeLeftMenu() {
      document.getElementById("leftMenu").style.display = "none";
    }

    </script>

   <script>
    /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;
    
    for (i = 0; i < dropdown.length; i++) {
      dropdown[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
          dropdownContent.style.display = "none";
        } else {
          dropdownContent.style.display = "block";
        }
      });
    }

    function openForm() {
      document.getElementById("myForm").style.display = "block";
    }
    function closeForm() {
      document.getElementById("myForm").style.display = "none";
    }
  </script>
   
  <script>
  function open_active_user_Form() {
      document.getElementById("my_active_user_Form").style.display = "block";
    }

    function close_active_user_Form() {
      document.getElementById("my_active_user_Form").style.display = "none";
    } 
    //
       function openForm() {
         document.getElementById("myForm").style.display = "block";
       }
       function closeForm() {
         document.getElementById("myForm").style.display = "none";
       }
   //
   function open_edit_signeeForm(count_data) {
        document.getElementById(`edit_signeeForm${count_data}`).style.display = "block";
    }
    function close_edit_signeeForm(count_data) {
      document.getElementById(`edit_signeeForm${count_data}`).style.display = "none";
    }
    //
     function open_edit_guidance_councilor_Form() {
        document.getElementById("edit_guidance_councilor_form").style.display = "block";
    }
    function close_edit_guidance_councilor_Form() {
      document.getElementById("edit_guidance_councilor_form").style.display = "none";
    }
       function open_edit_treasurer_Form() {
         document.getElementById("edit_student_org").style.display = "block";
       }
       function close_edit_treasurer_Form() {
         document.getElementById("edit_student_org").style.display = "none";
       }
   //
       function open_edit_librarian_Form() {
         document.getElementById("edit_librarian_form").style.display = "block";
       }
       function close_edit_librarian_Form() {
         document.getElementById("edit_librarian_form").style.display = "none";
       }
   //
       function open_edit_deanprincipal_Form() {
         document.getElementById("edit_deanprincipal_form").style.display = "block";
       }
       function close_edit_deanprincipal_Form() {
         document.getElementById("edit_deanprincipal_form").style.display = "none";
       }
   //
       function open_edit_studentaffair_Form() {
         document.getElementById("edit_studentaffair_form").style.display = "block";
       }
       function close_edit_studentaffair_Form() {
         document.getElementById("edit_studentaffair_form").style.display = "none";
       }
    //
       function open_edit_registrar_Form() {
         document.getElementById("edit_registrar_form").style.display = "block";
       }
       function close_edit_registrar_Form() {
         document.getElementById("edit_registrar_form").style.display = "none";
       }
   //
       function open_edit_assessment_Form() {
         document.getElementById("edit_assessment_form").style.display = "block";
       }
       function close_edit_assessment_Form() {
         document.getElementById("edit_assessment_form").style.display = "none";
       }

       function open_greeting_Form() {
         document.getElementById("greet_form").style.display = "block";
       }
       function close_greeting_Form() {
         document.getElementById("greet_form").style.display = "none";
       }
      //  
      function open_guide_Form() {
         document.getElementById("guide_form").style.display = "block";
       }
       function close_guide_Form() {
         document.getElementById("guide_form").style.display = "none";
       }
     </script>
<script>
function opensigneeForm(count_data, userId) {
        document.getElementById(`signeeForm-${count_data}-${userId}`).style.display = "block";
    }
    function closesigneeForm(count_data, userId) {
      document.getElementById(`signeeForm-${count_data}-${userId}`).style.display = "none";
    }
    //
     function open_guidance_councilor_Form(index_count, userId) {
        document.getElementById(`guidance_councilor_form-${index_count}-${userId}`).style.display = "block";
    }
    function close_guidance_councilor_Form(index_count, userId) {
      document.getElementById(`guidance_councilor_form-${index_count}-${userId}`).style.display = "none";
    }
    //
    function open_treasurer_Form(index_count, userId) {
      document.getElementById(`student_org-${index_count}-${userId}`).style.display = "block";
    }
    function close_treasurer_Form(index_count, userId) {
      document.getElementById(`student_org-${index_count}-${userId}`).style.display = "none";
    }
   //
    function open_librarian_Form(index_count, userId) {
      document.getElementById(`librarian_form-${index_count}-${userId}`).style.display = "block";
    }
    function close_librarian_Form(index_count, userId) {
      document.getElementById(`librarian_form-${index_count}-${userId}`).style.display = "none";
    }
   //
   function open_studentaffair_Form(index_count, userId) {
      document.getElementById(`studentaffair_form-${index_count}-${userId}`).style.display = "block";
    }
    function close_studentaffair_Form(index_count, userId) {
      document.getElementById(`studentaffair_form-${index_count}-${userId}`).style.display = "none";
    }
    //
       function open_deanprincipal_Form(index_count, userId) {
         document.getElementById(`deanprincipal_form-${index_count}-${userId}`).style.display = "block";
       }
       function close_deanprincipal_Form(index_count, userId) {
         document.getElementById(`deanprincipal_form-${index_count}-${userId}`).style.display = "none";
       }
   //
       function open_registrar_Form(index_count, userId) {
         document.getElementById(`registrar_form-${index_count}-${userId}`).style.display = "block";
       }
       function close_registrar_Form(index_count, userId) {
         document.getElementById(`registrar_form-${index_count}-${userId}`).style.display = "none";
       }
   //
       function open_assessment_Form(index_count, userId) {
         document.getElementById(`assessment_form-${index_count}-${userId}`).style.display = "block";
       }
       function close_assessment_Form(index_count, userId) {
         document.getElementById(`assessment_form-${index_count}-${userId}`).style.display = "none";
       }
 
  </script>



<script type="text/javascript">
  $('#student-search-active-user').on('keyup',function()
  {
      $value=$(this).val();
      $.ajax({
          type:'get',
          url:'{{URL::to('signee/signee-search-active-user')}}',
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
          url:'{{URL::to('signee/signee-search-active-signee-user')}}',
          data:{'search':$value},

          success:function(data)
          {
              console.log(data);
              $('#Student-Search-Active-Signee-User-Content').html(data);
 
          }
      });
  });
</script>
<script type="text/javascript">
  $('#instructor-search').on('keyup',function()
  {
      // alert('hello');
      $value=$(this).val();
      // alert( $value);
      $.ajax({
          type:'get',
          url:'{{URL::to('signee/instructor-search')}}',
          data:{'search':$value},

          success:function(data)
          {
              console.log(data);
              $('#Instructor-Content').html(data);

          }
      });
  });
</script>
<script type="text/javascript">
  $('#guidance-counselor-search').on('keyup',function()
  {
      // alert('hello');
      $value=$(this).val();
      // alert( $value);
      $.ajax({
          type:'get',
          url:'{{URL::to('signee/guidance-counselor-search')}}',
          data:{'search':$value},

          success:function(data)
          {
              console.log(data);
              $('#Guidance-Counselor-Content').html(data);

          }
      });
  });
</script>
<script type="text/javascript">
  $('#student-org-search').on('keyup',function()
  {
      // alert('hello');
      $value=$(this).val();
      // alert( $value);
      $.ajax({
          type:'get',
          url:'{{URL::to('signee/student-org-search')}}',
          data:{'search':$value},

          success:function(data)
          {
              console.log(data);
              $('#Student-Org-Content').html(data);

          }
      });
  });
</script>
<script type="text/javascript">
  $('#librarian-search').on('keyup',function()
  {
      // alert('hello');
      $value=$(this).val();
      // alert( $value);
      $.ajax({
          type:'get',
          url:'{{URL::to('signee/librarian-search')}}',
          data:{'search':$value},

          success:function(data)
          {
              console.log(data);
              $('#Librarian-Content').html(data);

          }
      });
  });
</script>
<script type="text/javascript">
  $('#student-affair-search').on('keyup',function()
  {
      $value=$(this).val();
      $.ajax({
          type:'get',
          url:'{{URL::to('signee/student-affair-search')}}',
          data:{'search':$value},

          success:function(data)
          {
              console.log(data);
              $('#Student-Affair-Content').html(data);

          }
      });
  });
</script>
<script type="text/javascript">
  $('#dean-principal-search').on('keyup',function()
  {
      $value=$(this).val();
      $.ajax({
          type:'get',
          url:'{{URL::to('signee/dean-principal-search')}}',
          data:{'search':$value},

          success:function(data)
          {
              console.log(data);
              $('#Dean-Principal-Content').html(data);

          }
      });
  });
</script>
<script type="text/javascript">
  $('#registrar-search').on('keyup',function()
  {
      $value=$(this).val();
      $.ajax({
          type:'get',
          url:'{{URL::to('signee/registrar-search')}}',
          data:{'search':$value},
          success:function(data)
          {
              console.log(data);
              $('#Registrar-Content').html(data);

          }
      });
  });
</script>
<script type="text/javascript">
  $('#assessment-search').on('keyup',function()
  {
      $value=$(this).val();
      $.ajax({
          type:'get',
          url:'{{URL::to('signee/assessment-search')}}',
          data:{'search':$value},
          success:function(data)
          {
              console.log(data);
              $('#Assessment-Content').html(data);

          }
      });
  });
</script>
</body>
</html>
