<x-app-layout>
    <div class="min-h-screen">
        <div class="w-full flex justify-center py-8">
            <div class="w-[95%] flex flex-col p-8 bg-white rounded-lg">

                <div class="w-full flex items-center gap-4">
                <a href="{{route('admin.registry.dept')}}" class="w-[25%] rounded-lg flex items-center justify-center py-2 bg-red-900 text-white font-bold gap-1 hover:bg-red-700">
                    <img src="{{asset('images/icons/back.png')}}" class="w-[20px] h-[20px]" alt="">
                    <h1>Back </h1>
                </a>


                <h1 class="text-[1.7rem] font-bold text-gray-700"> Update All Records </h1>
                </div>
            
                <span class="text-xl text-gray-500 mt-4">Upload Update File</span>
                <span class="text-[0.8rem] text-gray-400">Ensure the uploaded file follows the official template for CSV updates. This is crucial for accurate data processing.</span>
                @if(!isset($excel_data))
                

                <form action="{{route('admin.registry.dept.edit.all.load')}}" method = "POST"  class="w-full flex flex-col gap-1 my-4" enctype="multipart/form-data"> 
                        @csrf
                        @method('POST')
            
                <input class="my-2" type = "file" name = "file" accept = ".xlsx" required/>
                <button class="w-[30%] bg-red-900 hover:bg-red-700 text-white py-2 rounded-lg mt-2"> Load Template</button>
                    
                </form>

                @endif
                <!-- Display Import Errors -->
                @if(isset($import_errors) && count($import_errors) > 0)
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Error(s) in uploaded file:</strong>
                        <ul class="mt-2 list-disc list-inside text-sm">
                            @foreach($import_errors as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <hr class="opacity-100 my-4">

                @if(isset($excel_data)) 

                <span class="text-gray-500 text-lg mb-2"> Total Department: <strong> {{$excel_data->count()}}  </strong> </span>

                <div class="w-full flex flex-col border border-gray-200 gap-0 overflow-y-auto">
                <!-- header -->
                <div class="w-full bg-gray-500 text-white grid grid-cols-[15%_85%] p-2 ">
                    
                        <h1>ID</h1>
                        <H1>Department</H1>
                </div>

                    @foreach($excel_data as $item) 
                    <div class="w-full bg-gray text-gray-500 grid grid-cols-[15%_85%] p-2 border bt-gray-100">
                            
                        
                            <div class="flex items-center">

                                <h1>{{$item->code}}</h1>
                            </div>
                            <div class="flex items-center">

                                <h1>{{$item->department}}</h1>
                            </div>

                    </div>

                    @endforeach
                </div> 

                <div class="w-full grid grid-cols-[75%_25%] leading-tight mt-4">
                    <span class="text-[0.8rem] text-gray-400 text-justify">Before confirming and adding the data to the system, please ensure that the uploaded Excel file is correct. Double-check the loaded data on the page to verify accuracy and completeness. Any errors in the data might affect the system's functionality or integrity. Make sure all information is correct before proceeding. </span>

                    <form action="{{route('admin.registry.dept.edit.all.save')}}" method = "POST" class="flex justify-end">
                        @csrf
                        @method('POST')
                        <button class="bg-red-900 hover:bg-red-700 text-white w-[90%] py-2">UPDATE RECORDS</button>
                    </form>
                </div>
                    @endif

                    @if(isset($msg)) 


                    <span class="font-bold italic text-red-700">{{$msg}}</span>


                    @endif
                
                                                                
            </div>
        </div>
    </div>
</x-app-layout>

<style>

    a, button { 
        transition: 300ms;
    }
</style>