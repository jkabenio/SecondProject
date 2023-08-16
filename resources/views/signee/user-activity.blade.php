
<style> 
    body {font-family: Arial, Helvetica, sans-serif !important;}
    * {box-sizing: border-box !important;}
    
    /* Button used to open the contact form - fixed at the bottom of the page */
    .open-button {
      background-color: #555 !important;
      color: white !important;

      border: none !important;
      cursor: pointer !important;
      opacity: 0.8 !important;
      position: fixed !important;
      bottom: 23px !important;
      right: 28px !important;
      width: 150px !important;
      height: 30px;
      
    }
    /* Add a red background color to the cancel button */
    .form-container-activity-active-user{
        font-size: 12px !important;
        width: 100% !important;
        height: 300px !important;
        /* margin-bottom: 5px; */
      /* position: fixed; */
    }
    .scroll_active_users{
        overflow: auto !important;
        overscroll-behavior: contain;
        font-size: 12px !important;
        width: 100% !important;
        height: 300px !important;
        
    }
    .search_col{
        float: left !important;
        width:100%;
      
        border-radius: 0px !important;
    }
    .active-users-tr{
        text-align: left;
        } 
    .btn_close_users_active{
        width: 100px;
        float: right;
        /* margin-left: 38px; */
    }
.active_users_row{
    background-color: rgb(1, 1, 100);
}
.search_student_active_users{
    height:20px;
    margin-bottom: 10px !important;
}
::-webkit-scrollbar {
    width: 0; 
    background: transparent; 
}
    </style> 

<button class="open-button" onclick="open_active_user_Form()">Active Users</button>

<div class="form-popup" id="my_active_user_Form">
    
    <form  class="form-container-activity-active-user" style="background-color: rgb(1, 1, 100); ">
        <button type="button" class="btn btn-danger form-control btn_close_users_active" style="background-color: red" onclick="close_active_user_Form()"><b>Close</b></button>                   
    <br>
    <br>
    <div class="active_users_row">
        <div class="search_col">
            <input type="search" class="form-control search_student_active_users"  name="search" id="student-search-active-signee-user" placeholder="Signee Search:"/>                                                                                            
        </div> 
        <div class="search_col">
            <input type="search" class="form-control search_student_active_users"  name="search" id="student-search-active-user" placeholder="Student Search:"/>                                              
        </div>
    </div>
        <div class="scroll_active_users">
        <table class="table" style=" font-size: 10px; background-color: rgb(1, 1, 100); color: white;">
            <thead >
                <tr class="active-users-tr"> 
                    <th>Admin</th>
                    <th>Last Seen</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody >
                @foreach ($admin_user as $item_activity)  
                <tr class="active-users-tr">
                    <td>{{$item_activity->name}}</td>
                    <td>{{Carbon\Carbon::parse($item_activity->last_seen)->diffForHumans()}}</td>
                    <td>
                        @if(Cache::has('admin-is-online-' . $item_activity->id))
                        <span class="text-success">Online</span>
                        @else
                        <span class="text-danger">Offline</span>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
<br>
<br>       
        <table class="table" style=" font-size: 10px; background-color: rgb(1, 1, 100); color: white;">
            <tbody id="Student-Search-Active-Signee-User-Content">
                @foreach ($signee_user as $item_activity)
                <tr class="active-users-tr">
                    @if(Cache::has('signee-is-online-' . $item_activity->id))
                        <td>{{$item_activity->name}}</td>
                        <td>{{Carbon\Carbon::parse($item_activity->last_seen)->diffForHumans()}}</td>
                        <td>
                            @if(Cache::has('signee-is-online-' . $item_activity->id))
                            <span class="text-success">Online</span>
                            @else
                            <span class="text-danger">Offline</span>
                            @endif
                        </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>    
        <table class="table" style="font-size: 10px; background-color: rgb(1, 1, 100); color: white;">
            <tbody id="Student-Search-Active-User-Content">
                @foreach ($student_user as $item_activity)
                <tr class="active-users-tr">
                    @if(Cache::has('user-is-online-' . $item_activity->id))
                        <td>{{$item_activity->name}}</td>
                        <td>{{Carbon\Carbon::parse($item_activity->last_seen)->diffForHumans()}}</td>
                        <td>
                            @if(Cache::has('user-is-online-' . $item_activity->id))
                            <span class="text-success">Online</span>
                            @else
                            <span class="text-danger">Offline</span>
                            @endif
                        </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table> 
    </form>
</div> 
