<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name') }}</title>
 
  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>
  <link rel="icon" type="image/png"  href="{{url('/img/web_logo.png')}}">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  {{-- <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script> --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 </head>
<body>

      @include('inc.admin-sidebar')
    
      @include('inc.messages')
      @yield('content')
  
     
    
      

{{-- popup form html code here --}}


{{-- ends here --}}
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
    
    // function openRightMenu() {
    //   document.getElementById("rightMenu").style.display = "block";
    // }
    
    // function closeRightMenu() {
    //   document.getElementById("rightMenu").style.display = "none";
    // }
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
  </script>

  <script type="text/javascript">
    function RevealHiddenOverflow(d)
    {
    if( d.style.overflow == "hidden" ) { d.style.overflow = "visible"; }
    else { d.style.overflow = "hidden"; }
    }
  </script>
  

  <script>

    //
    function open_active_user_Form() {
      document.getElementById("my_active_user_Form").style.display = "block";
    }

    function close_active_user_Form() {
      document.getElementById("my_active_user_Form").style.display = "none";
    }
 //
    function opensigneeForm(index) {
        document.getElementById(`signeeForm${index}`).style.display = "block";
    }
    function closesigneeForm(index) {
      document.getElementById(`signeeForm${index}`).style.display = "none";
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

// this is for the No button when deleting records
// function close_delete_Form() {
//       document.getElementById("delete_form").style.display = "none";
//     }
</script>

<script>
  //
     function open_signee_pending_Form(index,userId) {
         document.getElementById(`signee_pending_Form-${index}-${userId}`).style.display = "block";
     }
     function close_signee_pending_Form(index,userId) {
       document.getElementById(`signee_pending_Form-${index}-${userId}`).style.display = "none";
     }
  //
      function open_guidance_councilor_pending_Form(index_count,userId) {
       document.getElementById(`guidance_councilor_pending_Form-${index_count}-${userId}`).style.display = "block";
     }
     function close_guidance_councilor_pending_Form(index_count,userId) {
       document.getElementById(`guidance_councilor_pending_Form-${index_count}-${userId}`).style.display = "none";
     }
 //
     function open_student_org_pending_Form(index_count,userId) {
       document.getElementById(`student_org_pending_Form-${index_count}-${userId}`).style.display = "block";
     }
     function close_student_org_pending_Form(index_count,userId) {
       document.getElementById(`student_org_pending_Form-${index_count}-${userId}`).style.display = "none";
     }
 //
     function open_librarian_pending_Form(index_count,userId) {
       document.getElementById(`librarian_pending_Form-${index_count}-${userId}`).style.display = "block";
     }
     function close_librarian_pending_Form(index_count,userId) {
       document.getElementById(`librarian_pending_Form-${index_count}-${userId}`).style.display = "none";
     }
 //
     function open_dean_principal_pending_Form(index_count,userId) {
       document.getElementById(`dean_principal_pending_Form-${index_count}-${userId}`).style.display = "block";
     }
     function close_dean_principal_pending_Form(index_count,userId) {
       document.getElementById(`dean_principal_pending_Form-${index_count}-${userId}`).style.display = "none";
     }
 //
     function open_student_affair_pending_Form(index_count,userId) {
       document.getElementById(`student_affair_pending_Form-${index_count}-${userId}`).style.display = "block";
     }
     function close_student_affair_pending_Form(index_count,userId) {
       document.getElementById(`student_affair_pending_Form-${index_count}-${userId}`).style.display = "none";
     }
    
 //
     function open_registrar_pending_Form(index_count,userId) {
       document.getElementById(`registrar_pending_Form-${index_count}-${userId}`).style.display = "block";
     }
     function close_registrar_pending_Form(index_count,userId) {
       document.getElementById(`registrar_pending_Form-${index_count}-${userId}`).style.display = "none";
     }
 //
     function open_assessment_pending_Form(index_count,userId) {
       document.getElementById(`assessment_pending_Form-${index_count}-${userId}`).style.display = "block";
     }
     function close_assessment_pending_Form(index_count,userId) {
       document.getElementById(`assessment_pending_Form-${index_count}-${userId}`).style.display = "none";
     }
 
 
</script>
  {{-- optonal scripts --}}
  

  <script>
    $('#myModal').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
  </script>

{{-- <script>
  $(function() {
  var select_val = $('#sel_test option:selected').val();
  $('#hdn_test').val(select_val);
  $('#output').text(select_val);
});
</script>

<script>
  $(function() {
  var select_val = $('#sel option:selected').val();
  $('#hdn').val(select_val);
  $('#output').text(select_val);
});
</script> --}}
<script type="text/javascript">
  $('#admin-student-search').on('keyup',function()
  {
      // alert('hello');
      $value=$(this).val();
      // alert( $value);
      $.ajax({
          type:'get',
          url:'{{URL::to('admin/admin-student-search')}}',
          data:{'search':$value},

          success:function(data)
          {
              console.log(data);
              $('#Admin-Student-Content').html(data);

          }
      });
  });
</script>
<script type="text/javascript">
  $('#admin-signee-search').on('keyup',function()
  {
      $value=$(this).val();
      $.ajax({
          type:'get',
          url:'{{URL::to('admin/admin-signee-search')}}',
          data:{'search':$value},

          success:function(data)
          {
              console.log(data);
              $('#Admin-Signee-Content').html(data);
 
          }
      });
  });
</script>
<script type="text/javascript">
  $('#admin-subject-search').on('keyup',function()
  {
      $value=$(this).val();
      $.ajax({
          type:'get',
          url:'{{URL::to('admin/admin-subject-search')}}',
          data:{'search':$value},

          success:function(data)
          {
              console.log(data);
              $('#Admin-Subject-Content').html(data);
 
          }
      });
  });
</script>
<script type="text/javascript">
  $('#student-search-active-user').on('keyup',function()
  {
      $value=$(this).val();
      $.ajax({
          type:'get',
          url:'{{URL::to('admin/signee-search-active-user')}}',
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
          url:'{{URL::to('admin/signee-search-active-signee-user')}}',
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

