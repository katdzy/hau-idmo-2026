

<x-app-layout>
    <div class="min-h-screen">
        <div class="w-full flex justify-center py-8">
            <div class="w-[95%] flex flex-col p-8 rounded-lg bg-white items-start">
                @if(session('msg'))
                    <span class="msg w-[100%] bg-green-600 text-white rounded-lg px-4 py-2 my-4">{{ session('msg') }}</span>
                @endif

                <!-- header -->
                <div class="w-full flex">
                        
                            
                        <img src = "{{asset('images/logos/school/soc_logo.png')}}" class="w-[100px] h-[100px] mr-2"/> 
                    
                        <div class="w-full flex flex-col justify-center">
                    <!-- title header  -->    
                            <h1 class="text-[1.5rem] font-bold leading-tight">{{$user-> emp_lname . ', ' . $user-> emp_fname . ' ' . $user-> emp_mname}}</h1>
                            <h1 class="text-[1.2rem] font-semibold text-gray-700"> {{$user-> emp_id}}</h1>
                            <span class="text-gray-500 text-sm">Number of Certifications: {{$items-> count()}} </span>
                        </div>
                </div>

                
                <span class="text-sm font-semibold text-gray-400 mb-4">
                Review all earned certifications, along with key details such as certification titles, issuing organizations, and validity periods to stay informed about your professional qualifications.
                </span>


                <!-- updated codes  -->
                <span class="text-md font-bold text-gray-400">
                    To add a new certification: Filing Application > Choose Certification > Fill up the form > Submit and wait for approval.
                </span>
                <span class="text-sm font-semibold text-gray-400">
                    Or, click this <a href="{{ route('portal.filing.certification') }}" class="text-blue-500 underline hover:text-blue-700">
                        link</a> to go to the Certification application page.
                </span>
                
                    <hr class="w-full opacity-100 my-2">

                






            <div class="w-full flex">

                <button id = "approved_btn" class="hover:bg-gray-100 text-gray-400 font-semibold px-8 py-2 active_link"> Approved </button>

                <button id = "pending_btn" class="hover:bg-gray-100 text-gray-400 font-semibold px-8 py-2"> Pending </button>

                <button id = "toreview_btn" class="hover:bg-gray-100 text-gray-400 font-semibold px-8 py-2"> To-review </button>

                
            </div>
            <hr class="mb-2 opacity-90 w-full">
            <!-- table for approved -->
            <div id = "approved" class="w-full flex flex-col border border-gray-200 gap-0">
                

            
                <!-- body with empty data -->

                @if($approved->count()==0) 
                <div class="w-full flex items-center justify-center text-sm text-gray-400 pt-8 pb-12">
                    <span class="italic"> No user data. </span> 
                </div>
                @else


                <div class="w-full flex flex-col overflow-y-auto h-[300px]">

            
                    @foreach($approved as $item)
                    <div class="w-full grid grid-cols-[85%_15%] hover:bg-gray-100 px-4 py-4  border-l-8 border-red-900 border-b-2 border-t-2">
                            <div class="flex flex-col leading-tight">
                                <h1 class="font-semibold text-gray-700"> <strong> Certification </strong>  - {{$item->cert_title}}</h1>
                                <span class="italic text-sm text-gray-500"> Date Issued: {{$item->date_issued}} </span>
                                <div class="flex items-start">
                                    <img src = "{{asset('images/icons/attachment.png')}}" class="w-[20px] h-[20px]"/> 
                                    <a title="{{$item->attachment}}" class="hover:underline text-gray-600" href = "{{asset('storage/' . $item->file_path )}}" target="_blank"> {{$item -> attachment}}</a>
                                </div>
                            </div>

                            <div class="flex items-center justify-end gap-1">
                                <a href="{{route('portal.certifications.view',['id'=> $item->id])}}" class="border bg-red-900 rounded-xl p-2 hover:bg-red-700" title="View Info">
                                    <img src="{{asset('images/icons/eye.svg')}}" alt="" class="w-[20px] h-[20px]" >
                                </a>


                                <form action = "{{route('portal.certifications.delete',['id'=> $item->id])}}"  method = "POST">
                                @csrf
                                @method('DELETE')
                                    <button type = "button" onclick= "confirmDelete(this)" class="border bg-red-900 rounded-xl p-2 hover:bg-red-700" title="Delete Item">
                                        <img src="{{asset('images/icons/delete.png')}}" alt="" class="w-[20px] h-[20px]" >
                                    </button>
                                </form>

                            </div>
                        </div>
                        @endforeach

                    </div>


                @endif
                

            </div>



            <!-- table for pending -->
            <div id = "pending"  class="w-full flex flex-col border border-gray-200 gap-0 inactive_link">


                <!-- body with empty data -->

                @if($pending->count()==0) 
                <div class="w-full flex items-center justify-center text-sm text-gray-400 pt-8 pb-12">
                    <span class="italic"> No user data. </span> 
                </div>
                @else


                <div class="w-full flex flex-col overflow-y-auto h-[300px]">

            
                    @foreach($pending as $item)
                    <div class="w-full grid grid-cols-[85%_15%] hover:bg-gray-100 px-4 py-4  border-l-8 border-red-900 border-b-2 border-t-2">
                            <div class="flex flex-col leading-tight">
                                <h1 class="font-semibold text-gray-700"> <strong> Certification </strong>  - {{$item->cert_title}}</h1>
                                <span class="italic text-sm text-gray-500"> Date Issued: {{$item->date_issued}} </span>
                                <div class="flex items-start">
                                    <img src = "{{asset('images/icons/attachment.png')}}" class="w-[20px] h-[20px]"/> 
                                    <a title="{{$item->attachment}}" class="hover:underline text-gray-600" href = "{{asset('storage/' . $item->file_path )}}" target="_blank"> {{$item -> attachment}}</a>
                                </div>
                            </div>

                            <div class="flex items-center justify-end gap-1">
                                <a href="{{route('portal.certifications.view',['id'=> $item->id])}}" class="border bg-red-900 rounded-xl p-2 hover:bg-red-700" title="View Info">
                                    <img src="{{asset('images/icons/eye.svg')}}" alt="" class="w-[20px] h-[20px]" >
                                </a>


                                <form action = "{{route('portal.certifications.delete',['id'=> $item->id])}}"  method = "POST">
                                @csrf
                                @method('DELETE')
                                    <button type = "button" onclick= "confirmDelete(this)" class="border bg-red-900 rounded-xl p-2 hover:bg-red-700" title="Delete Item">
                                        <img src="{{asset('images/icons/delete.png')}}" alt="" class="w-[20px] h-[20px]" >
                                    </button>
                                </form>

                            </div>
                        </div>
                        @endforeach

                    </div>


                @endif
                

            </div>


            
            <!-- table for to-review -->
            <div  id = "toreview"  class="w-full flex flex-col border border-gray-200 gap-0 inactive_link">
            

                <!-- body with empty data -->

                @if($toreview->count()==0) 
                <div class="w-full flex items-center justify-center text-sm text-gray-400 pt-8 pb-12">
                    <span class="italic"> No user data. </span> 
                </div>
                @else


                <div class="w-full flex flex-col overflow-y-auto h-[300px]">

            
                    @foreach($toreview as $item)
                    <div class="w-full grid grid-cols-[85%_15%] hover:bg-gray-100 px-4 py-4  border-l-8 border-red-900 border-b-2 border-t-2">
                            <div class="flex flex-col leading-tight">
                                <h1 class="font-semibold text-gray-700"> <strong> Certification </strong>  - {{$item->cert_title}}</h1>
                                <span class="italic text-sm text-gray-500"> Date Issued: {{$item->date_issued}} </span>
                                <div class="flex items-start">
                                    <img src = "{{asset('images/icons/attachment.png')}}" class="w-[20px] h-[20px]"/> 
                                    <a title="{{$item->attachment}}" class="hover:underline text-gray-600" href = "{{asset('storage/' . $item->file_path )}}" target="_blank"> {{$item -> attachment}}</a>
                                </div>
                            </div>

                            <div class="flex items-center justify-end gap-1">
                                <a href="{{route('portal.certifications.view',['id'=> $item->id])}}" class="border bg-red-900 rounded-xl p-2 hover:bg-red-700" title="View Info">
                                    <img src="{{asset('images/icons/eye.svg')}}" alt="" class="w-[20px] h-[20px]" >
                                </a>


                                <form action = "{{route('portal.certifications.delete',['id'=> $item->id])}}"  method = "POST">
                                @csrf
                                @method('DELETE')
                                    <button type = "button" onclick= "confirmDelete(this)" class="border bg-red-900 rounded-xl p-2 hover:bg-red-700" title="Delete Item">
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
    a, button { 
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
    const form = button.closest('form');
        if(confirm('Are you sure you want to delete this record?')) { 
           form.submit()
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