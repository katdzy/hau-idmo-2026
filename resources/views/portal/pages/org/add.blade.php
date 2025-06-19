<x-app-layout>
    <div class="min-h-screen">
        <div class="w-full flex justify-center py-8">
            <div class="w-[95%] bg-white flex flex-col px-8 pt-8 pb-12 rounded-lg">
                <a href="{{route('portal.org')}}" class="w-[25%] rounded-lg flex items-center justify-center py-2 bg-red-900 text-white font-bold gap-1 hover:bg-red-700">
                    <img src="{{asset('images/icons/back.png')}}" class="w-[20px] h-[20px]" alt="">
                    <h1>Back </h1>
                </a>

                <div class="w-full flex flex-col items-center">

                    <img src = "{{asset('images/hau-logo.png')}}" class="w-[120px] h-[120px] mt-4"/> 
                    <h1 class="text-[2rem] text-gray-700 font-extrabold mt-4 leading-tight">ORGANIZATION MEMBERSHIP</h1>
                    <span class="text-gray-500 text-[0.8rem]">Please fill out the form below to add a new organization membership. Ensure all required fields are completed before submitting. </span>
                </div>

                <hr class="opacity-90 my-4"> 

                <form action="{{route('portal.org.store')}}" method ="POST" enctype="multipart/form-data" class="w-full flex flex-col items-center gap-2 text-center">

                @csrf 
                @method('POST')
                    <div class="w-[50%] flex flex-col gap-1">
                        <span class="text-gray-500 font-semibold"> Organization Name <span class="font-bold text-red-500">*</span></span> 
                        <input type = "text" name = "org" class="border border-gray-300 text-center" required/> 
                    </div>

                    <div class="w-[50%] flex flex-col gap-1">
                        <span class="text-gray-500 font-semibold"> Position <span class="font-bold text-red-500">*</span></span> 
                        <input type = "text" name = "position" class="border border-gray-300 text-center" required/> 
                    </div>

                    <div class="w-[50%] flex flex-col gap-1">
                        <span class="text-gray-500 font-semibold"> Date Joined <span class="font-bold text-red-500">*</span></span> 
                        <input type = "date" name = "date_joined" class="border border-gray-300 text-center" min="1933-03-08" max="{{ date('Y-m-d') }}" required/> 
                    </div>

                    <div class="flex flex-col gap-1">
                        <span class="text-gray-500 font-semibold text-center">Attachment | Proof of Membership <span class="font-bold text-red-500">*</span></span>
                        <input type="file" name = "attachment" class=" text-center" required>
                    </div>


                    @if(isset($msg)) 
                        <span> {{$msg}} </span> 
                    @endif
                    <button type = submit class="w-[50%] bg-red-900 hover:bg-red-700 text-white py-2 mt-2">SUBMIT</button>
                </form>



                
            </div>
        </div>
    </div>
     
</x-app-layout>

<style> 

a,button{  
    transition: 300ms;
}
</style>  