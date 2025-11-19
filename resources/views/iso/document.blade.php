<x-app-layout>
<div class="min-h-screen">
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
                <h1 class="text-[1.5rem] font-bold leading-tight">ISO Document Management</h1>
                <span class="text-gray-500 text-sm">Track and manage ISO documents through approval workflow</span>
            </div>

            <hr class="w-full opacity-100">
            <!-- Status Tabs -->
            <div class="w-full flex">
                <button id="draft_btn" class="hover:bg-gray-100 text-gray-400 font-semibold px-8 py-2 active_link">Draft</button>
            <button id="idc_btn" class="hover:bg-gray-100 text-gray-400 font-semibold px-8 py-2">With IDC</button>
            <button id="qmr_btn" class="hover:bg-gray-100 text-gray-400 font-semibold px-8 py-2">With QMR</button>
            <button id="approved_btn" class="hover:bg-gray-100 text-gray-400 font-semibold px-8 py-2">Approved</button>
            </div>

            <hr class="mb-2 opacity-90 w-full">

        </div>
    </div>
</div>    
</div>
</x-app-layout>

<style>
    .container { 
        width: 100%;
        display: flex; 
        justify-content: center;
        padding: 2rem 0;
    }
    
    .con-box { 
        border-radius: 10px; 
        width: 95%;
        background-color: white;
        display: flex; 
        flex-direction: column;
        align-items: center;
        padding: 1rem 0;
    }

    .active_link { 
        border-bottom: 4px solid #FFD700;
        font-weight: 700;
        transition: 150ms;
    }

    .active_link:hover { 
        background-color: rgb(230, 230, 230);
    }

    .inactive_link { 
        display: none;
    }
</style>