<x-app-layout>
    <div class="min-h-screen">
        <div class="w-full py-8 flex justify-center">
            <div class="w-[95%] flex flex-col items-start p-8 rounded-xl bg-white">
                <a href="{{route('admin.orgs')}}" class="flex gap-1 items-center bg-red-900 hover:bg-red-700 px-6 py-1 text-white rounded-xl">
                    <img src="{{asset('images/icons/back.png')}}" class="w-[20px] h-[20px]" alt="">
                    <span>Back</span>
                </a>

                <span class="text-[0.8rem] text-gray-400">User Organizations</span>
                <h1 class="text-[2.8rem] font-extrabold text-gray-600 leading-tight">{{$org}}</h1>

                <form class="w-full flex gap-4 items-center" action="{{route('admin.orgs.destroy',['id'=>$org])}}" method = "POST">
                    @csrf 
                    @method('DELETE')
                    
                    <button type="button" onclick="confirmDelete(this)" class="bg-red-900 text-white flex items-center justify-center rounded-xl px-6 py-1 hover:bg-red-800">
                        <img src="{{asset('images/icons/delete.png')}}" alt="" class="w-[20px] h-[20px]">
                        <span>Delete Organization</span>
                    </button>
                    <span class="opacity-50 italic text-sm">Reminder: Once deleted, all membership with this organization will be deleted.</span>
                </form>
                
                <hr class="w-full opacity-90 my-4">
                <span class="text-gray-400 text-md leading-tight"><strong> Members: </strong>  {{$data->count()}}</span>

                <!-- table header -->
                <hr class="opacity-60 w-full my-2">
                <div class="w-full grid grid-cols-[30%_70%]">
                    <h1 class="font-thin text-lg text-gray-400">EMP ID</h1>
                    <h1 class="font-thin text-lg text-gray-400">FULL NAME</h1>
                </div>
                <hr class="opacity-60 w-full my-2">

                @foreach($data as $item) 
                <div class="w-full grid grid-cols-[30%_70%] mb-2">
                    <h1 class="text-lg text-gray-600">{{$item->user->emp_id}}</h1>
                    <h1 class=" text-lg text-gray-600">{{$item->user->emp_lname . ', ' . $item->user->emp_fname . ' ' . $item->user->emp_mname}}</h1>
                </div>
                @endforeach


            </div>
        </div>
    </div>
</x-app-layout>

<style>
    * { 
        transition: 300ms; 
    }
</style>

<script>

function confirmDelete(button) { 
    const form = button.closest('form'); 

    if(confirm('Are you sure you want to delete this organization?')) { 
        form.submit(); 
    }
}
</script>