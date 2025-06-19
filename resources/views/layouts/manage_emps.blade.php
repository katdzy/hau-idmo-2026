<div class="sidebar flex h-screen dark:bg-gray-800">
    <!-- Sidebar -->
    <aside class="bg-white dark:bg-gray-900 w-64 md:w-80 border-r border-gray-200 dark:border-gray-700 flex flex-col items-center flex-shrink-0 main">

    <div class = "w-full flex flex-col items-center mt-4 gap-0"> 
        <h1 class=" font-extrabold text-xl">HAU-IDMO Portal</h1>

    

        <!-- profile card -->

        <div class="w-[90%] grid grid-cols-[20%_80%] bg-red-800 rounded-md py-2 px-1 text-white border border-white border-opacity-10">
                <div class="flex justify-center items-center">
                    @if(Auth::user()->user->profile_picture == '')
                    <img src = "{{asset('images/blankdp.jpg')}}" class="w-[35px] h-[35px] rounded-xl ">
                    
                    @else
                    <img src = "{{asset('storage/profile_pictures/' . Auth::user()->user->profile_picture)}}" class="w-[35px] h-[35px] rounded-full ">
                    @endif
                </div>

                <div class="flex flex-col justify-start items-start whitespace-nowrap text-ellipsis">
                    <h1 class="font-bold text-sm">{{Auth::user()->user->emp_lname . ', ' . Auth::user()->user->emp_fname . ' ' . Auth::user()->user->emp_mname}}</h1>
                    <h1 class="text-gray-100 text-[0.8rem]">{{Auth::user()->role}}</h1>
                </div>


            </div>

        </div> 


    <hr class="w-[90%] rounded-xl opacity-1 my-4">

    <div class = "navigation_links navigation_links flex flex-col items-center"> 

               
        <!-- A LINK NAVIGATION  -->
                <a href="{{ route('manage-emps.dashboard') }}" class="{{ request()->routeIs('manage-emps.dashboard') ? 'font-semibold' : '' }}">
                    <div class="nav-link">
                        
                            <img src="{{ asset('images/icons/nav/dashboard.png') }}" />
                 
                            <h3>Dashboard</h3>
                  
                    </div>
                </a> 

                 <!-- A LINK NAVIGATION  -->
                <a href="{{ route('admin.pendings') }}" class="{{ request()->routeIs('admin.pendings*') ? 'font-semibold' : '' }}">
                    <div class="nav-link">
                        
                            <img src="{{ asset('images/icons/portal_nav/pending.png') }}" />
                 
                            <h3>Pending Requests</h3>
                  
                    </div>
                </a> 

                
                          <!-- A LINK NAVIGATION  -->
                          <a href="{{ route('admin.loads.db') }}" class="{{ request()->routeIs('admin.loads*') ? 'font-semibold' : '' }}">
                    <div class="nav-link">
                        
                            <img src="{{ asset('images/icons/portal_nav/loads.png') }}" />
                 
                            <h3> Teaching Loads</h3>
                  
                    </div>
                </a> 


                          <!-- A LINK NAVIGATION  -->
                <a href="{{ route('admin.subjects') }}" class="{{ request()->routeIs('admin.subjects*') ? 'font-semibold' : '' }}">
                    <div class="nav-link">
                        
                            <img src="{{ asset('images/icons/portal_nav/subjects.png') }}" />
                 
                            <h3>Manage Subjects</h3>
                  
                    </div>
                </a> 

                <a href="{{route('admin.certs')}}" class="{{ request()->routeIs('admin.certs*') ? 'font-semibold' : '' }}">
                    <div class="nav-link">
                        
                            <img src="{{ asset('images/icons/portal_nav/cert.svg') }}" />
                 
                            <h3>Issue Certificates</h3>
                  
                    </div>
                </a> 

                @if(Auth::user()->role !== 'Employee')
                <div class="w-full flex justify-center my-4">
                    <a href="{{route('dashboard')}}" class="w-[90%] flex items-center justify-center px-4 py-1 gap-2 bg-white hover:bg-gray-200 rounded-xl">
                    <img src="{{asset('images/icons/back_maroon.png')}}" alt="" class="w-[20px] h-[20px">
                        <span class="text-red-900 font-semibold">Back to Main Dashboard</span>
                    </a>
                </div>
                @endif






                    
                 







              

    </div> 
    


    
      
    
    
    </aside>

   
</div>


<style> 

a, button { 
    transition: 300ms;
}

.navigation_links { 
    overflow-y: auto;
    overflow-x: hidden;
}

.sidebar{ 
    /* border: 1px solid red; */
    width: 100%;
    color: white;
} 


.main {
    width: 20%; 
    height: 100%;  
    background-color: #70121D;
}    


hr { 
    opacity: 0.3;
    color: lightgray; 
    text-align: center;
}

.b2d { 
    background-color: #a0202a;
    display: flex; 
    justify-content: center;
    align-items: center;
    width: 100%; 
    height: 100%;
}

.b2d a { 
    width: 90%; 
    height: 80%; 
    
}

.b2d .nav-link:hover { 
    background-color: #871c25;
}

.b2d .nav-link{
   
    width: 100%; 
    height: 100%;
    display: grid; 
    grid-template-columns: 20% 80%;
 }

 .b2d .nav-icon { 
    justify-content: end;
    padding-right: 0.5rem;
 }



.title, .navigation_links, .sidebar-title{ 
    width: 100%;
    height: 100%; 
    /* border: 1px solid yellow; */
}

.sidebar-title { 
    display: flex; 
    justify-content: center;
    align-items: center;
    text-align: center;
}

.sidebar-title h1 { 
    text-transform: uppercase;
    /* font-style: italic; */
    /* font-style: oblique; */
    font-weight: bold;
    font-size: clamp(0.8rem, 2vw + 0.5rem, 1.2rem);
    margin-bottom: 1rem;
}

.title { 
    display: flex; 
    flex-direction: column;
    align-items: center;
    padding: 1rem 0;
}


.title img { 
    width: 145px; 
    height: 145px;
}

.title img { 
    width: 145px; 
    height: 145px;
}


.title h3 { 
    line-height:14px;

    font-weight: bold;
}

.title h5 { 
    font-size: clamp(12px, 1.5vw, 14px); 
}


.navigation_links  a{

    width: 90%;
 

    display: flex; 
    justify-content: center;
    align-items: center;
}

.font-semibold > .nav-link {
    background-color:#bc0a18;
}





.nav-link:hover  { 
    background-color: #8A2B36;
}

.nav-link {
    padding: 0.1rem 0 ; 
    border-radius:8px; 

    transition: 200ms;
    width: 100%; 
    display: flex;

    align-items: center;
}

.nav-link h3 { 
    font-size: 1rem;
}

.nav-link img { 
 
    width: 25px; 
    margin: 0.7rem;
    height: 25px; 
}



.change_dp button { 
    margin: 1rem 0;
    background-color: #70121D;
    padding: 5px 10px;
    font-size: 12px;
    color: white;
    border-radius: 15px;
}

.change_dp img { 
    width: 200px; 
    height: 200px;
    border-radius: 15px;
}
</style> 
