<x-app-layout>
    <div class="min-h-screen">
        <div class="w-full flex justify-center py-8">
            <div class="w-[95%] flex flex-col p-8 bg-white rounded-lg items-start">
                @if(session('msg'))
                    <span class="msg w-[100%] bg-green-600 text-white rounded-lg px-4 py-2 my-4">{{ session('msg') }}</span>
                @endif

                <h1 class="text-xl font-bold text-gray-700"> My Licenses</h1>

                <span class="text-gray-500 text-sm">This page displays all of your license records. Review the status and validity of each license, and keep track of any upcoming renewals or pending approvals.</span>

                <a href="{{route('portal.filing.license')}}" class="flex justify-center items-center bg-gray-500 hover:bg-gray-400 text-white rounded-lg px-8 py-1 gap-2 my-4">
                    <img src="{{asset('images/icons/add.png')}}" class="w-[25px] h-[25px]" alt="">
                    <span> Submit License </span>
                </a>
                
                <!-- tabs -->
                <div class="w-full flex">

                    <button id = "approved_btn" class="hover:bg-gray-100  text-gray-400 font-semibold px-8 py-2 active_link"> Approved </button>

                    <button id = "pending_btn" class="hover:bg-gray-100 text-gray-400 font-semibold px-8 py-2"> Pending </button>

                    <button id = "toreview_btn" class="hover:bg-gray-100 text-gray-400 font-semibold px-8 py-2"> To-review </button>


                </div>
                <hr class="mb-2 opacity-90 w-full">

                <!-- table for approved -->
                <div id = "approved" class="w-full flex flex-col border border-gray-200 gap-0 ">
                <!-- body with empty data -->

                @if($approved->count()==0) 
                    <div class="w-full flex items-center justify-center text-sm text-gray-400 pt-8 pb-12">
                        <span class="italic"> No user data. </span> 
                    </div>
                    @else


                    <div class="w-full flex flex-col items-center overflow-y-auto h-[300px]">


                        <!-- an item -->
                        @foreach($approved as $item)
                        <div class="w-full grid grid-cols-[85%_15%] hover:bg-gray-100 px-4 py-4 border-b border-gray-200">
                            <div class="flex flex-col leading-tight">
                                <h1 class="font-bold text-gray-700"> {{$item->type}}  -  {{$item->title}}</h1>
                                <span class="italic text-sm text-gray-500"> Date Obtained: {{$item->date_obtained}} </span>
                            </div>

                            <div class="flex items-center justify-end gap-1">
                                <a href = "{{route('portal.license.view',['id'=> $item->id])}}" class="border bg-red-900 rounded-xl p-2 hover:bg-red-700" title="View Info">
                                    <img src="{{asset('images/icons/eye.svg')}}" alt="" class="w-[20px] h-[20px]" >
                                </a>

                                <form action="{{route('portal.license.delete', ['id'=> $item->id])}}" method = "POST">
                                    @csrf 
                                    @method('DELETE')

                                    <button onclick="confirmDelete(this)" type = "button" class="border bg-red-900 rounded-xl p-2 hover:bg-red-700" title="Delete Item">
                                        <img src="{{asset('images/icons/delete.png')}}" alt="" class="w-[20px] h-[20px]" >
                                    </button>
                                </form>

                            </div>
                        </div>

                        @endforeach
                            

                    </div>


                @endif
                

                </div>



            <div id = "pending" class="w-full flex flex-col border border-gray-200 gap-0  inactive_link">
                <!-- body with empty data -->

                @if($pending->count()==0) 
                <div class="w-full flex items-center justify-center text-sm text-gray-400 pt-8 pb-12">
                    <span class="italic"> No user data. </span> 
                </div>
                @else


                <div class="w-full flex flex-col items-center overflow-y-auto h-[300px]">


                    <!-- an item -->
                    @foreach($pending as $item)
                    <div class="w-full grid grid-cols-[85%_15%] hover:bg-gray-100 px-4 py-4 border-b border-gray-200">
                        <div class="flex flex-col leading-tight">
                            <h1 class="font-bold text-gray-700"> {{$item->type}} - {{$item->title}}</h1>
                            <span class="italic text-sm text-gray-500"> Date Obtained: {{$item->date_obtained}} </span>
                        </div>

                        <div class="flex items-center justify-end gap-1">
                            <a href = "{{route('portal.license.view',['id'=> $item->id])}}" class="border bg-red-900 rounded-xl p-2 hover:bg-red-700" title="View Info">
                                <img src="{{asset('images/icons/eye.svg')}}" alt="" class="w-[20px] h-[20px]" >
                            </a>

                            <form action="{{route('portal.license.delete', ['id'=> $item->id])}}" method = "POST">
                                    @csrf 
                                    @method('DELETE')

                                    <button onclick="confirmDelete(this)" type = "button" class="border bg-red-900 rounded-xl p-2 hover:bg-red-700" title="Delete Item">
                                        <img src="{{asset('images/icons/delete.png')}}" alt="" class="w-[20px] h-[20px]" >
                                    </button>
                                </form>

                        </div>
                    </div>

                    @endforeach
                        

                </div>


                @endif
                

            </div>


            
            <div id = "toreview" class="w-full flex flex-col border border-gray-200 gap-0  inactive_link">
                <!-- body with empty data -->

                @if($toreview->count()==0) 
                <div class="w-full flex items-center justify-center text-sm text-gray-400 pt-8 pb-12">
                    <span class="italic"> No user data. </span> 
                </div>
                @else


                <div class="w-full flex flex-col items-center overflow-y-auto h-[300px]">


                    <!-- an item -->
                    @foreach($toreview as $item)
                    <div class="w-full grid grid-cols-[85%_15%] hover:bg-gray-100 px-4 py-4 border-b border-gray-200">
                        <div class="flex flex-col leading-tight">
                            <h1 class="font-bold text-gray-700"> {{$item->type}} - {{$item->title}}</h1>
                            <span class="italic text-sm text-gray-500"> Date Obtained: {{$item->date_obtained}} </span>
                        </div>

                        <div class="flex items-center justify-end gap-1">
                            <a href = "{{route('portal.license.view',['id'=> $item->id])}}" class="border bg-red-900 rounded-xl p-2 hover:bg-red-700" title="View Info">
                                <img src="{{asset('images/icons/eye.svg')}}" alt="" class="w-[20px] h-[20px]" >
                            </a>

                            <form action="{{route('portal.license.delete', ['id'=> $item->id])}}" method = "POST">
                                    @csrf 
                                    @method('DELETE') 

                                    <button onclick="confirmDelete(this)" type = "button" class="border bg-red-900 rounded-xl p-2 hover:bg-red-700" title="Delete Item">
                                        <img src="{{asset('images/icons/delete.png')}}" alt="" class="w-[20px] h-[20px]" >
                                    </button>
                                </form>

                        </div>
                    </div>

                    @endforeach
                        

                </div>


                @endif
                

            </div>


                
            </div>

        </div>
    </div>
</x-app-layout>



<style>


    a, button, div { 
        transition: 150ms;
    }

    .active_link{ 
        border-bottom: 4px solid #FFD700   ;
        font-weight: 700;
        transition: 300ms;
    }

    

    .active_link:hover { 
        background-color: rgb(230,230,230);
        

    }

    .inactive_link { 
        display: none;
    }


    #msg{ 
        opacity: 1;
    transition: opacity 300ms ease-in-out;
    } 
</style>

<script>
    
const approved_btn = document.getElementById('approved_btn'); 
const pending_btn = document.getElementById('pending_btn')
const toreview_btn =document.getElementById('toreview_btn')

const approved_tbl = document.getElementById('approved') 
const pending_tbl = document.getElementById('pending') 
const toreview_tbl = document.getElementById('toreview') 


//class for hiding the table is: 'hide'

approved_btn.addEventListener("click",()=> { 
    approved_btn.classList.add("active_link"); 
    pending_btn.classList.remove('active_link'); 
    toreview_btn.classList.remove('active_link'); 
    

    approved_tbl.classList.remove('inactive_link'); 
    pending_tbl.classList.add('inactive_link')  
    toreview_tbl.classList.add('inactive_link')

})


pending_btn.addEventListener("click",()=> { 
    approved_btn.classList.remove("active_link"); 
    pending_btn.classList.add('active_link'); 
    toreview_btn.classList.remove('active_link'); 
    

    approved_tbl.classList.add('inactive_link'); 
    pending_tbl.classList.remove('inactive_link')  
    toreview_tbl.classList.add('inactive_link')

})

toreview_btn.addEventListener("click",()=> { 
    approved_btn.classList.remove("active_link"); 
    pending_btn.classList.remove('active_link'); 
    toreview_btn.classList.add('active_link'); 
    

    approved_tbl.classList.add('inactive_link'); 
    pending_tbl.classList.add('inactive_link')  
    toreview_tbl.classList.remove('inactive_link')

})

function confirmDelete(button) { 
    if(confirm('Are you sure you want to delete this item?')) { 
        const form = button.closest('form');
        form.submit(); 
    }
}

window.addEventListener("DOMContentLoaded", function() {
        setTimeout(function() {
            const sessionMsg = document.querySelector('.msg');
            if (sessionMsg) {
                sessionMsg.style.display = 'none';
            }
        }, 3000);
    });

</script>