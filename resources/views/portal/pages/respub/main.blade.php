<!-- resources\views\portal\pages\respub\main.blade.php -->
<x-app-layout>
    <div class="min-h-screen">
        <div class="w-full flex justify-center py-8">
            <div class="w-[95%] flex flex-col p-8 rounded-lg bg-white items-start">
                <div class="w-full flex">
                    <img src="{{asset('images/logos/school/soc_logo.png')}}" class="w-[100px] h-[100px] mr-2"/> 
                    <div class="w-full flex flex-col justify-center">
                        <h1 class="text-[1.5rem] font-bold leading-tight">{{$user->emp_lname . ', ' . $user->emp_fname . ' ' . $user->emp_mname}}</h1>
                        <h1 class="text-[1.2rem] font-semibold text-gray-700">{{$user->emp_id}}</h1>
                        <span class="text-gray-500 text-sm">Number of Research and Publications: {{$count}} </span>
                    </div>
                </div>

                <a href="{{route('portal.respub.type')}}" class="flex justify-center items-center bg-gray-500 hover:bg-gray-400 text-white rounded-lg px-8 py-1 gap-2 mb-4">
                    <img src="{{asset('images/icons/upload.png')}}" class="w-[20px] h-[20px]" alt="">
                    <span> Add Research or Publication </span>
                </a>

                @if(isset($msg)) 
                    <span id="msg" class="w-full text-center py-1 bg-green-700 text-white rounded-xl">{{$msg}}</span>
                @endif

                <hr class="w-full opacity-100 my-2">

                <div class="w-full flex">
                    <button id="overview_btn" class="hover:bg-gray-100 text-gray-400 font-semibold px-8 py-2 active_link"> Overview </button>
                    <button id="approved_btn" class="hover:bg-gray-100 text-gray-400 font-semibold px-8 py-2"> Approved </button>
                    <button id="pending_btn" class="hover:bg-gray-100 text-gray-400 font-semibold px-8 py-2"> Pending </button>
                    <button id="toreview_btn" class="hover:bg-gray-100 text-gray-400 font-semibold px-8 py-2"> To-review </button>
                </div>
                <hr class="mb-2 opacity-90 w-full">

                <div id="overview" class="w-full grid grid-cols-2">
                    <div>
                        <h1 class="font-extrabold text-gray-700 text-[1.5rem] mb-2"> My Research </h1>
                        <div class="w-full flex items-center gap-1 mb-4">
                            <div class="flex flex-col items-center justify-center w-[100px] h-[100px] rounded-lg bg-red-700 text-white leading-tight">
                                <span class="font-thin">Approved</span>
                                <h1 class="text-[3rem] font-bold">{{$rapproved->count()}}</h1>
                            </div>

                            <div class="flex flex-col items-center justify-center w-[100px] h-[100px] rounded-lg bg-red-700 text-white leading-tight">
                                <span class="font-thin">Pending</span>
                                <h1 class="text-[3rem] font-bold">{{$rpending->count()}}</h1>
                            </div>

                            <div class="flex flex-col items-center justify-center w-[100px] h-[100px] rounded-lg bg-red-700 text-white leading-tight">
                                <span class="font-thin">To-review</span>
                                <h1 class="text-[3rem] font-bold">{{$rtoreview->count()}}</h1>
                            </div>

                            <div class="flex flex-col items-center justify-center w-[100px] h-[100px] rounded-lg bg-red-900 text-white leading-tight">
                                <span class="font-thin">Total</span>
                                <h1 class="text-[3rem] font-bold">{{$research->count()}}</h1>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h1 class="font-extrabold text-gray-700 text-[1.5rem] mb-2"> My Publications </h1>
                        <div class="w-full flex items-center gap-1 mb-4">
                            <div class="flex flex-col items-center justify-center w-[100px] h-[100px] rounded-lg bg-red-700 text-white leading-tight">
                                <span class="font-thin">Approved</span>
                                <h1 class="text-[3rem] font-bold">{{$papproved->count()}}</h1>
                            </div>

                            <div class="flex flex-col items-center justify-center w-[100px] h-[100px] rounded-lg bg-red-700 text-white leading-tight">
                                <span class="font-thin">Pending</span>
                                <h1 class="text-[3rem] font-bold">{{$ppending->count()}}</h1>
                            </div>

                            <div class="flex flex-col items-center justify-center w-[100px] h-[100px] rounded-lg bg-red-700 text-white leading-tight">
                                <span class="font-thin">To-review</span>
                                <h1 class="text-[3rem] font-bold">{{$ptoreview->count()}}</h1>
                            </div>

                            <div class="flex flex-col items-center justify-center w-[100px] h-[100px] rounded-lg bg-red-900 text-white leading-tight">
                                <span class="font-thin">Total</span>
                                <h1 class="text-[3rem] font-bold">{{$publication->count()}}</h1>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Approved -->
                <div id="approved" class="w-full flex flex-col border border-gray-200 gap-0 inactive_link">
                    @if($approved->count()==0) 
                        <div class="w-full flex items-center justify-center text-sm text-gray-400 pt-8 pb-12">
                            <span class="italic"> No user data. </span> 
                        </div>
                    @else
                        <div class="w-full flex flex-col items-center overflow-y-auto h-[300px]">
                            @foreach($approved as $item)
                            @php
                                $itemType = ($item instanceof \App\Models\Research) ? 'Research' : 'Publication';
                            @endphp
                            <div class="w-full grid grid-cols-[85%_15%] hover:bg-gray-100 px-4 py-4 border-l-8 border-red-900 border-b-2 border-t-2">
                                <div class="flex flex-col leading-tight">
                                    <h1 class="font-semibold text-gray-700"><strong>{{$itemType}}</strong> - {{$item->title}}</h1>
                                    @if($item instanceof \App\Models\Publication)
                                        <span class="italic text-sm text-gray-500">Date Published: {{$item->date_published}}</span>
                                    @endif
                                    <div class="flex items-start">
                                        <img src="{{asset('images/icons/attachment.png')}}" class="w-[20px] h-[20px]"/> 
                                        <a title="{{$item->attachment}}" class="hover:underline text-gray-600" href="{{asset('storage/' . $item->file_path)}}" target="_blank" download>{{$item->attachment}}</a>
                                    </div>
                                </div>

                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{route('portal.respub.view',['id'=> $item->id])}}" class="border bg-red-900 rounded-xl p-2 hover:bg-red-700" title="View Info">
                                        <img src="{{asset('images/icons/eye.svg')}}" alt="" class="w-[20px] h-[20px]">
                                    </a>

                                    <form action="{{route('portal.respub.delete',['id'=> $item->id])}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete(this)" class="border bg-red-900 rounded-xl p-2 hover:bg-red-700" title="Delete Item">
                                            <img src="{{asset('images/icons/delete.png')}}" alt="" class="w-[20px] h-[20px]">
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Pending -->
                <div id="pending" class="w-full flex flex-col border border-gray-200 gap-0 inactive_link">
                    @if($pending->count()==0) 
                        <div class="w-full flex items-center justify-center text-sm text-gray-400 pt-8 pb-12">
                            <span class="italic"> No user data. </span> 
                        </div>
                    @else
                        <div class="w-full flex flex-col items-center overflow-y-auto h-[300px]">
                            @foreach($pending as $item)
                            @php
                                $itemType = ($item instanceof \App\Models\Research) ? 'Research' : 'Publication';
                            @endphp
                            <div class="w-full grid grid-cols-[85%_15%] hover:bg-gray-100 px-4 py-4 border-l-8 border-red-900 border-b-2 border-t-2">
                                <div class="flex flex-col leading-tight">
                                    <h1 class="font-semibold text-gray-700"><strong>{{$itemType}}</strong> - {{$item->title}}</h1>
                                    @if($item instanceof \App\Models\Publication)
                                        <span class="italic text-sm text-gray-500">Date Published: {{$item->date_published}}</span>
                                    @endif
                                    <div class="flex items-start">
                                        <img src="{{asset('images/icons/attachment.png')}}" class="w-[20px] h-[20px]"/> 
                                        <a title="{{$item->attachment}}" class="hover:underline text-gray-600" href="{{asset('storage/' . $item->file_path)}}" target="_blank" download>{{$item->attachment}}</a>
                                    </div>
                                </div>

                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{route('portal.respub.view',['id'=> $item->id])}}" class="border bg-red-900 rounded-xl p-2 hover:bg-red-700" title="View Info">
                                        <img src="{{asset('images/icons/eye.svg')}}" alt="" class="w-[20px] h-[20px]">
                                    </a>
                                    <form action="{{route('portal.respub.delete',['id'=> $item->id])}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete(this)" class="border bg-red-900 rounded-xl p-2 hover:bg-red-700" title="Delete Item">
                                            <img src="{{asset('images/icons/delete.png')}}" alt="" class="w-[20px] h-[20px]">
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- To-review -->
                <div id="toreview" class="w-full flex flex-col border border-gray-200 gap-0 inactive_link">
                    @if($toreview->count()==0) 
                        <div class="w-full flex items-center justify-center text-sm text-gray-400 pt-8 pb-12">
                            <span class="italic"> No user data. </span> 
                        </div>
                    @else
                        <div class="w-full flex flex-col items-center overflow-y-auto h-[300px]">
                            @foreach($toreview as $item)
                            @php
                                $itemType = ($item instanceof \App\Models\Research) ? 'Research' : 'Publication';
                            @endphp
                            <div class="w-full grid grid-cols-[85%_15%] hover:bg-gray-100 px-4 py-4 border-l-8 border-red-900 border-b-2 border-t-2">
                                <div class="flex flex-col leading-tight">
                                    <h1 class="font-semibold text-gray-700"><strong>{{$itemType}}</strong> - {{$item->title}}</h1>
                                    @if($item instanceof \App\Models\Publication)
                                        <span class="italic text-sm text-gray-500">Date Published: {{$item->date_published}}</span>
                                    @endif
                                    <div class="flex items-start">
                                        <img src="{{asset('images/icons/attachment.png')}}" class="w-[20px] h-[20px]"/> 
                                        <a title="{{$item->attachment}}" class="hover:underline text-gray-600" href="{{asset('storage/' . $item->file_path)}}" target="_blank" download>{{$item->attachment}}</a>
                                    </div>
                                </div>

                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{route('portal.respub.view',['id'=> $item->id])}}" class="border bg-red-900 rounded-xl p-2 hover:bg-red-700" title="View Info">
                                        <img src="{{asset('images/icons/eye.svg')}}" alt="" class="w-[20px] h-[20px]">
                                    </a>
                                    <form action="{{route('portal.respub.delete',['id'=> $item->id])}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete(this)" class="border bg-red-900 rounded-xl p-2 hover:bg-red-700" title="Delete Item">
                                            <img src="{{asset('images/icons/delete.png')}}" alt="" class="w-[20px] h-[20px]">
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
        border-bottom: 4px solid #FFD700;
        font-weight: 700;
        transition: 300ms;
    }
    .active_link:hover { 
        background-color: rgb(230,230,230);
    }
    .inactive_link { 
        display: none;
    }
    #msg { 
        opacity: 1;
        transition: opacity 300ms ease-in-out;
    } 
</style>

<script>
const approved_btn = document.getElementById('approved_btn'); 
const pending_btn = document.getElementById('pending_btn');
const toreview_btn =document.getElementById('toreview_btn');
const overview_btn = document.getElementById('overview_btn');

const approved_tbl = document.getElementById('approved'); 
const pending_tbl = document.getElementById('pending'); 
const toreview_tbl = document.getElementById('toreview'); 
const overview = document.getElementById('overview');

approved_btn.addEventListener("click",()=> { 
    approved_btn.classList.add("active_link"); 
    pending_btn.classList.remove('active_link'); 
    toreview_btn.classList.remove('active_link'); 
    overview_btn.classList.remove('active_link'); 

    approved_tbl.classList.remove('inactive_link'); 
    pending_tbl.classList.add('inactive_link');  
    toreview_tbl.classList.add('inactive_link');
    overview.classList.add('inactive_link');
})

pending_btn.addEventListener("click",()=> { 
    approved_btn.classList.remove("active_link"); 
    pending_btn.classList.add('active_link'); 
    toreview_btn.classList.remove('active_link'); 
    overview_btn.classList.remove('active_link'); 
    
    approved_tbl.classList.add('inactive_link'); 
    pending_tbl.classList.remove('inactive_link');  
    toreview_tbl.classList.add('inactive_link');
    overview.classList.add('inactive_link');
})

toreview_btn.addEventListener("click",()=> { 
    approved_btn.classList.remove("active_link"); 
    pending_btn.classList.remove('active_link'); 
    toreview_btn.classList.add('active_link'); 
    overview_btn.classList.remove('active_link'); 
    
    approved_tbl.classList.add('inactive_link'); 
    pending_tbl.classList.add('inactive_link');  
    toreview_tbl.classList.remove('inactive_link');
    overview.classList.add('inactive_link');
})

overview_btn.addEventListener("click",()=> { 
    approved_btn.classList.remove("active_link"); 
    pending_btn.classList.remove('active_link'); 
    toreview_btn.classList.remove('active_link'); 
    overview_btn.classList.add('active_link'); 
    
    approved_tbl.classList.add('inactive_link'); 
    pending_tbl.classList.add('inactive_link');  
    toreview_tbl.classList.add('inactive_link');
    overview.classList.remove('inactive_link');
})

function confirmDelete(button) { 
    const form = button.closest('form');
    if(confirm('Are you sure you want to delete this record?')) { 
       form.submit()
    }
}

//hide message
if(document.getElementById('msg')) { 
    setTimeout(()=> { 
        let msg = document.getElementById('msg')
        msg.style.opacity = '0' 
        setTimeout(()=> { 
            msg.style.display= 'none'
        }, 100)
    }, 5000)
}
</script>
