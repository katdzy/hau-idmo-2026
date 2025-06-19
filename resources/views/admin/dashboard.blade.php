<x-app-layout>
    <div class="min-h-screen">
        <div class="w-full flex justify-center py-8">
            <div class="w-[95%] flex flex-col bg-white rounded-lg px-8 py-8">
                <h1 class = " text-[1.8rem] font-semibold"> Welcome back, <strong class= "text-red-900"> {{$fname}} </strong> </h1> 
                <hr class = "opacity-100 my-4"> 
                <span class= "text-gray-400">Admin Tools </span>
                
                <div class="w-full flex gap-12">
                            <!-- management tools -->   
                            <section class=" flex flex-col mt-2">
                                <h1 class = "text-gray-500 text-[1.7rem] font-bold"> Management</h1> 

                                <div class="w-full flex py-1 gap-2">

                                    <a class= "maroon bg-red-900 text-white rounded-[25px] px-12 py-8 font-semibold flex flex-col items-center justify-center" href="{{route('admin.records')}}">
                                        <img src = "{{asset('images/icons/users.png')}}"> 

                                        <h1> Manage Users</h1>
                                    </a>

                                    @if(Auth::user()->role == "SuperAdmin")

                                    <a class= "maroon bg-red-900 text-white rounded-[25px] px-12 py-8 font-semibold flex flex-col items-center justify-center" href="{{route('admin.registry')}}">
                                        <img src = "{{asset('images/icons/config.png')}}"> 

                                        <h1> App Registry</h1>
                                    </a>
                                    @endif
                                </div>
                            </section>
                        
                </div>
                
            </div>
        </div> 
    </div>
</x-app-layout>

<style> 

.maroon { 
    transition: 300ms;
}
.maroon:hover { 
        background-color: #A84655;
    }
</style> 