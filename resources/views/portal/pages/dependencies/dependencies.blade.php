@php
$dep_count = 1; 



@endphp


<!-- resources\views\portal\pages\dependencies\dependencies.blade.php -->
<x-app-layout>
<div class ="min-h-screen">
<div class="container mx-auto">
    <div class="con-box">
    @if(session('msg'))
            <div class="w-full bg-green-600 text-white rounded-xl px-4 py-2 mb-4" id="msg">
                {{ session('msg') }}
            </div>
        @endif
        <div class="w-[95%] px-4 flex my-4 items-center">
        
      
            <img src="{{ asset('images/logos/school/soc_logo.png') }}" class="w-[100px] h-[100px] mr-2" />
            <div class="w-full flex flex-col justify-center">
                <h1 class="text-[1.5rem] font-bold leading-tight">
                    {{ $user->emp_lname . ', ' . $user->emp_fname . ' ' . $user->emp_mname }}
                </h1>
                <h1 class="text-[1.2rem] font-semibold text-gray-700">{{ $user->emp_id }}</h1>
                <span class="text-gray-500 text-sm">Number of dependents: {{ $dependencies->count() }}</span>
            </div>
        </div>
        <hr class="w-full opacity-100 ">
        <div class="w-full flex">

            <button id = "approved_btn" class="hover:bg-gray-100 text-gray-400 font-semibold px-8 py-2 active_link"> Approved </button>

            <button id = "pending_btn" class="hover:bg-gray-100 text-gray-400 font-semibold px-8 py-2"> Pending </button>

            <button id = "toreview_btn" class="hover:bg-gray-100 text-gray-400 font-semibold px-8 py-2"> To-review </button>

            
        </div>
        <hr class="mb-2 opacity-90 w-full">

        <!-- table for approved -->
    <div id="approved" class="w-full flex flex-col border border-gray-200 rounded-lg shadow-sm overflow-hidden">
        @if($approved->count() == 0)
            <div class="w-full flex items-center justify-center text-sm text-gray-400 pt-4 pb-12">
                <span class="italic">No user data.</span>
            </div>
        @else
            <div class="w-[95%] overflow-hidden border border-gray-300 rounded-lg shadow-lg">
                <div class="bg-gray-100 p-4">
                    <h2 class="text-lg font-semibold text-gray-700">Dependents List</h2>
                </div>
                <div class="bg-white divide-y divide-gray-300">
                    @foreach($approved as $item)
                        <div class="flex items-center justify-between p-4 @if($loop->even) bg-gray-50 @endif">
                            <div class="flex-1">
                                <h1 class="font-bold text-gray-800">{{ $item->fname . ' ' . $item->mname . ' ' . $item->lname }}</h1>
                                <p class="text-sm text-gray-600">{{ $item->relationship }}</p>
                                <p class="text-xs text-gray-500">{{ $item->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <form action="{{ route('portal.dependencies.view', ['id' => $item->id]) }}" method="GET">
                                    @csrf
                                    @method('GET')
                                    <button type="submit" class="text-blue-600 hover:underline">Info</button>
                                </form>
                                <form id="delete-form-{{$item->id}}" action="{{ route('portal.dependencies.delete', ['dep_id' => $item->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    <button type="button" onclick="deleteDependency(this)" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

       <!-- table for pending-->
       <div id="pending" class="w-full flex flex-col border border-gray-200 rounded-lg shadow-sm overflow-hidden inactive_link">
        @if($pending->count() == 0)
            <div class="w-full flex items-center justify-center text-sm text-gray-400 pt-4 pb-12">
                <span class="italic">No user data.</span>
            </div>
        @else
            <div class="w-[95%] overflow-hidden border border-gray-300 rounded-lg shadow-lg">
                <div class="bg-gray-100 p-4">
                    <h2 class="text-lg font-semibold text-gray-700">Dependents List</h2>
                </div>
                <div class="bg-white divide-y divide-gray-300">
                    @foreach($pending as $item)
                        <div class="flex items-center justify-between p-4 @if($loop->even) bg-gray-50 @endif">
                            <div class="flex-1">
                                <h1 class="font-bold text-gray-800">{{ $item->fname . ' ' . $item->mname . ' ' . $item->lname }}</h1>
                                <p class="text-sm text-gray-600">{{ $item->relationship }}</p>
                                <p class="text-xs text-gray-500">{{ $item->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <form action="{{ route('portal.dependencies.view', ['id' => $item->id]) }}" method="GET">
                                    @csrf
                                    @method('GET')
                                    <button type="submit" class="text-blue-600 hover:underline">Info</button>
                                </form>
                                <form id="delete-form-{{$item->id}}" action="{{ route('portal.dependencies.delete', ['dep_id' => $item->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    <button type="button" onclick="deleteDependency(this)" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

     <!-- table for to-review -->
     <div id="toreview" class="w-full flex flex-col border border-gray-200 rounded-lg shadow-sm overflow-hidden inactive_link">
        @if($toreview->count() == 0)
            <div class="w-full flex items-center justify-center text-sm text-gray-400 pt-4 pb-12">
                <span class="italic">No user data.</span>
            </div>
        @else
            <div class="w-[95%] overflow-hidden border border-gray-300 rounded-lg shadow-lg">
                <div class="bg-gray-100 p-4">
                    <h2 class="text-lg font-semibold text-gray-700">Dependents List</h2>
                </div>
                <div class="bg-white divide-y divide-gray-300">
                    @foreach($toreview as $item)
                        <div class="flex items-center justify-between p-4 @if($loop->even) bg-gray-50 @endif">
                            <div class="flex-1">
                                <h1 class="font-bold text-gray-800">{{ $item->fname . ' ' . $item->mname . ' ' . $item->lname }}</h1>
                                <p class="text-sm text-gray-600">{{ $item->relationship }}</p>
                                <p class="text-xs text-gray-500">{{ $item->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <form action="{{ route('portal.dependencies.view', ['id' => $item->id]) }}" method="GET">
                                    @csrf
                                    @method('GET')
                                    <button type="submit" class="text-blue-600 hover:underline">Info</button>
                                </form>
                                <form id="delete-form-{{$item->id}}" action="{{ route('portal.dependencies.delete', ['dep_id' => $item->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    <button type="button" onclick="deleteDependency(this)" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

        <section class="py-4 w-full flex justify-center items-center space-x-4">
    <a class="flex items-center justify-center bg-blue-500 text-white py-1 px-6 rounded hover:bg-blue-600" href="{{ route('portal.dependencies.add') }}">
        <img src="{{ asset('images/icons/add.png') }}" alt="Add Icon" class="w-6 h-6" />
        <span class="act-btn-text">Add New Dependent</span>
    </a>

    <form id="clear-dependencies-form" action="{{ route('portal.dependencies.clear') }}" method="POST" class="py-1">
        @csrf
        @method('DELETE')
        <button type="button" class="flex items-center justify-center bg-red-500 text-white rounded  py-1 px-6  hover:bg-red-600 " onclick="confirmClearDependencies()">
            
                <img src="{{ asset('images/icons/reset.png') }}" alt="Reset Icon" class="w-6 h-6" />
           
            <span class="act-btn-text">Clear All</span>
        </button>
    </form>
</section>

    </div>
</div>
</div>

</x-app-layout>


<style> 

    .container { 
        width: 100% ;
        display: flex; 
        justify-content: center;
        padding: 2rem 0 ;
    }
    
    .con-box { 
        /* for windowed layout */
        border-radius: 10px; 
        width: 95%;   

        /* for full screen */
        /* width: 100%;   */

        background-color: white;
        display: flex; 
        flex-direction: column;
        align-items: center;
        padding: 1rem 0;
       
        /* border-radius: 15px;  */
    }

    .box-header { 
        
        height: 80px; 
        width: 95%; 
        display: flex;
        justify-content: center;
   
    }

    .searchbar { 
        width: 50%; 
        height: 100%; 
       
        display: flex; 
        align-items: center;
    }

    

   
    .bar { 
        width: 100%; 
        margin-left: 1rem; 
        display: grid; 

        grid-template-columns: 10% 90%;
        border: 1px solid rgb(0,0,0,0.3); 
        border-radius: 15px; 
        overflow: hidden;
    }

    .icon, .searchfield { 
        width: 100%; 
        height: 100%; 
        display: flex; 
        align-items: center;
    }

    .icon { 
        justify-content: end;
    }


    .icon img { 
        width: 25px ; 
        height: 25px; 
    }

    input[type=text] {  
        border: none;
        width: 100%;
       
    
    }

    input[type="text"]:focus {
    outline: none; /* Removes the outline */
    box-shadow: none; /* Optionally removes any shadow */
    }



    .table-section { 
        width: 95% ;
        height: 350px;
        margin-bottom: 1rem;
        overflow-y: auto;
    
    }
    
        /* table template codes */
    .table { 
        width: 100%; 
        border: 1px solid rgb(0,0,0,0.1);
    }

    .tbl-header { 
       
        width: 95%; 
        height: 40px; 
        background-color: maroon;

        display: grid; 
    }

    .tbl-row { 
        width: 100%; 
        padding: 1rem 0;
        display: grid; 
        padding: 1rem 0;
        transition: 300ms; 
        

        
    }

    .tbl-row:hover { 
        background-color: beige;
    }

    .tbl-row h1 { 
        color: #696969; 
        font-weight:400;
        font-size: 14px; 
    }

    .empty { 
        display: flex; 
        justify-content: center;
        align-items: center;
        color: lightgray; 
    }

    .empty span { 
        color: rgb(40, 40,40);
    }
    .table button {
        background-color: maroon;
        color: white;
        padding: 0 2.3rem;
        border-radius: 25px; 
        transition: 300ms; 
        font-size: 15px;

    }

    .table button:hover { 
        background-color: #A84655;
    }

    .tbl-col { 
        width: 100%; 
        height: 100%; 
        display: flex; 
        align-items: center;
        padding-left: 1rem;
    }

   
    .stripe { 
       background-color: #f7f7f7;
    }


    
    .tbl-header .tbl-col h1 { 
        color: white;
        font-size: 13px; 
        font-weight: 500;
        
    }
    /* should be changed based on the sizing of the table */
    .tbl-header, .main-dep .tbl-header, .main-dep .tbl-row { 
        grid-template-columns: 30% 30% 20% 20% ;
    }

    .tbl-header { 
        grid-template-columns: 30% 30% 20% 20% ;
    }

    .col-acts { 
       display: flex; 
       
    }

 

    .col-acts button { 
        color: white; 
        padding: 0.1rem 1rem; 
        border-radius: 10px;
        text-align: center;
        margin: 0 0.3rem;
        transition: 300ms; 
    }


    #edit {
        background-color: green; 
    }
    #edit:hover { 
        background-color: #32CD32;
    }

    #delete { 
        
        background-color: red;
    }
    
    #delete:hover { 
        background-color:#FF6347;
    }


    /*** set height of your table here | call the unique class name so that it won't affect other table*/
    .main-dep { 
        height: 350px; 
        overflow-y: auto;
        
    }


    .actions { 
        width: 95%; 
        height: 50px; 
        display: flex; 
    

    }


    .act-slot { 
        width: 35%; 
        height: 100%; 
        display: flex; 
        align-items: center;
        padding-right: 0.5rem;
        
    }

    .act-slot form { 
        width: 100%; 
        height: 100%; 
        display: flex ;
        align-items: center;

    }
    /* .act-slot button { 
        width: 100%; 
        height: 70%; 
        background-color: maroon;
        display: grid; 
        grid-template-columns: 20% 80%;
        border-radius: 10px; 
        transition: 300ms; 
    } */

    .act-btn { 
        width: 100%; 
        height: 70%; 
        background-color: maroon;
        display: grid; 
        grid-template-columns: 20% 80%;
        border-radius: 10px; 
        transition: 300ms; 
    }

    .act-btn:hover { 
        background-color: #A52A2A;
    }


   
    .act-btn-icon, .act-btn-text { 
        width: 100%; 
        height: 100%; 
        display: flex; 
        
        align-items: center;
    }


    .act-btn-icon img { 
        width: 30px ; 
        height: 30px; 
    }
    .act-btn-icon{ 
        justify-content: end;
    }

    .act-btn-text {
        padding-left:0.5rem; 
        color: white;
    }

    .active_link{ 
        border-bottom: 4px solid #FFD700   ;
        font-weight: 700;
        transition: 150ms;
    }

    

    .active_link:hover { 
        background-color: rgb(230,230,230);

    }

    .inactive_link { 
        display: none;
    }

    
    

</style>


<script>
    const approved_btn = document.getElementById('approved_btn'); 
    const pending_btn = document.getElementById('pending_btn');
    const toreview_btn =document.getElementById('toreview_btn');

    const approved_tbl = document.getElementById('approved');
    const pending_tbl = document.getElementById('pending');
    const toreview_tbl = document.getElementById('toreview'); 


    //class for hiding the table is: 'hide'

    approved_btn.addEventListener("click",()=> { 
        approved_btn.classList.add("active_link"); 
        pending_btn.classList.remove('active_link'); 
        toreview_btn.classList.remove('active_link'); 
        

        approved_tbl.classList.remove('inactive_link'); 
        pending_tbl.classList.add('inactive_link');  
        toreview_tbl.classList.add('inactive_link');

    })


    pending_btn.addEventListener("click",()=> { 
        approved_btn.classList.remove("active_link"); 
        pending_btn.classList.add('active_link'); 
        toreview_btn.classList.remove('active_link'); 
        

        approved_tbl.classList.add('inactive_link'); 
        pending_tbl.classList.remove('inactive_link');  
        toreview_tbl.classList.add('inactive_link');

    })

    toreview_btn.addEventListener("click",()=> { 
        approved_btn.classList.remove("active_link"); 
        pending_btn.classList.remove('active_link'); 
        toreview_btn.classList.add('active_link'); 
        

        approved_tbl.classList.add('inactive_link'); 
        pending_tbl.classList.add('inactive_link');  
        toreview_tbl.classList.remove('inactive_link');

    })

    setTimeout(function() {
        var msgElement = document.getElementById('msg');
        if (msgElement) {
            msgElement.style.display = 'none';
        }
    }, 5000); // Hide after 5 seconds




        

        
    // for confirmation 
    function confirmClearDependencies() {
        if (confirm('Are you sure you want to clear the dependents?')) {
            document.getElementById('clear-dependencies-form').submit();
        }
    }


    function deleteDependency(button)  {
        const form = button.closest('form');
        if(confirm('Are you sure you want to delete this dependent?')) { 
           form.submit()
        }

    }
      



   





</script> 