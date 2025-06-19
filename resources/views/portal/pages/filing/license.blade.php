<x-app-layout>
   <div class="min-h-screen">
    <div class="w-full flex justify-center py-12">
        <div class="w-[80%] grid grid-cols-2 p-8 bg-white rounded-lg">
            <div class="flex flex-col items-center text-center px-4">
                <a href="{{route('portal.filing.type')}}" class="bg-red-900 hover:bg-red-700 text-white px-16 py-1 rounded-[25px] flex gap-2 items-center justify-center">
                    <img src="{{asset('images/icons/back.png')}}" class="w-[15px] h-[15px]" alt="">
                    <span class="">Select Category</span>
                </a>

                <h1 class="text-[1.5rem] text-gray-800 font-bold">License Application</h1>
                <span class="leading-[1rem] text-gray-500">Kindly double check the information and attachments needed before submitting.</span>

                <img src="{{asset('images/hau-logo.png')}}" class="w-[250px] h-[250px] my-4" alt="">
                


            </div>

            <div>
                <form action="{{route('portal.filing.license.add')}}" method = "POST" class="w-full flex flex-col gap-2" enctype="multipart/form-data">
                    @csrf 
                    @method('POST')
                    <h1 class="font-bold text-gray-600 text-[1.5rem] mb-2">License Details</h1>

                    
                    
                    <div class="w-full flex flex-col leading-tight">
                        <span class=" text-gray-400">Type <span class="font-bold text-red-500">*</span></span>
                        <select type="text" name = "type" class="rounded-lg border border-gray-400">
                            @foreach($license_types as $item)
                            <option value = "{{$item->item}}">{{$item->item}}</option> 
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full flex flex-col leading-tight">
                        <span class=" text-gray-400">License <span class="font-bold text-red-500">*</span></span>
                        <input type="text" name = "title" class="rounded-lg border border-gray-400" required>
                    </div>


                


                    <div class="w-full flex flex-col leading-tight">
                        <span class=" text-gray-400">Date Obtained <span class="font-bold text-red-500">*</span></span>
                        <input type="date" name = "date_obtained" class="rounded-lg border border-gray-400" min ="1925-01-01" max="{{ date('Y-m-d') }}" required>
                    </div>

                

                    <div class="w-full flex flex-col leading-tight">
                        <span class=" text-gray-400">Attachment <span class="font-bold text-red-500">*</span> </span>
                        <input type="file" name = "attachment" required>
                    </div>


                    <div class="w-full flex justify-end">
                        <button class="bg-red-900 hover:bg-red-700 text-white flex items-center justify-center px-12 py-2" type = "submit"> 
                        Submit
                        </button>
                    </div>




                </form>

            </div>

        </div>

    </div>
   </div>
</x-app-layout>

<style>
    a, button { 
        transition: 300ms;
    }
</style>