{{-- @if(Auth::guard('admin')) --}}
<style> 
    body {font-family: Arial, Helvetica, sans-serif !important;}
    * {box-sizing: border-box !important;}
    
    /* Button used to open the contact form - fixed at the bottom of the page */
    .open-button {
      background-color: #555 !important;
      color: white !important;
      padding: 16px 20px !important;
      border: none !important;
      cursor: pointer !important;
      opacity: 0.8 !important;
      position: fixed !important;
      bottom: 23px !important;
      right: 28px !important;
      width: 150px !important;
      
    }
    
    /* The popup form - hidden by default */
    .form-popup-users {
      display: none !important;
      position: fixed !important;
      bottom: 0 !important;
      right: 15px !important;
      border: 3px solid #f1f1f1 !important;
      z-index: 9!important;
      width: 10px;
    }
    
    /* Add styles to the form container */
    .form-container {
      
      margin: auto !important;
    width: 300px !important;
    height: 300px !important;
    overflow: auto !important;
    /* way to prevent an element from scrolling its parent. */
    overscroll-behavior: contain;
    }
    
    /* Set a style for the submit/login button */
    .form-container .btn {
      background-color: #04AA6D !important;
      color: white !important;
      padding: 16px 20px !important;
      border: none !important;
      cursor: pointer !important;
      width: 100% !important;
      margin-bottom:10px !important;
      opacity: 0.8 !important;
    }
    
    /* Add a red background color to the cancel button */
    .form-container .cancel {
      background-color: red !important;
      width: 50px !important;
      font-size: 12px !important;
      height: 24px !important;
      padding-top: 2px!important;
      margin-top: 0px !important;
      margin-bottom: 0px!important;
      border-radius: 0px!important;
      margin-left: 235px!important;
      /* position: fixed; */
    }
    
    /* Add some hover effects to buttons */
    .form-container .btn:hover, .open-button:hover {
      opacity: 1 !important;
    } 
     /* Remove scrollbar space */
      /* Optional: just make scrollbar invisible */
    /* ::-webkit-scrollbar {
    width: 0; 
    background: transparent; 
    } */
    .cancel_bg{
      background-color:rgb(1, 1, 100) !important;
      width: 275px !important;
      height: 24px !important;
      position: fixed !important;
    }
    </style> 

<button class="open-button" onclick="openForm()">Active Users</button>
{{-- style="display:block" --}}
<div class="form-popup-users" id="myForm"  >
  <form  class="form-container-user" style="background-color: rgb(1, 1, 100); ">
    <table class="table" style=" font-size: 10px; background-color: rgb(1, 1, 100); color: white;">
      <thead >
          <tr >
            <button type="button" class="btn cancel" onclick="closeForm()">&times;</button>
              
          </tr>
      </thead>
      <tbody >
          @foreach ($users as $item_activity)
          <tr >
              <td>{{$item_activity->name}}</td>
              <td>
                  {{ Carbon\Carbon::parse($item_activity->last_seen)->diffForHumans()}}
              </td>

              <td>
                  @if(Cache::has('user-is-online-' . $item_activity->id))
                  <span class="text-success">Online</span>
                  
                  @else
                  <span class="text-secondary">Offline</span>
                  @endif
                  {{-- {{ $item->role_as == '0' ? 'Student' : ''}}                                 
                  {{$item->role_as == '1' ? 'Admin':''}}
                  {{ $item->role_as == '2' ? 'Instructor' : ''}} --}}
              </td>
          </tr>
          {{-- @endif --}}
          @endforeach
      </tbody>

  </table>
  {{-- {{$users->links()}}  --}}
    
  </form>
</div>

{{-- @endif --}}