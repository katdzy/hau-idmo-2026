@php 
$file = $data->id . '.' . explode('.', $data->attachment)[1]; 

@endphp

<!-- resources\views\portal\pages\trainings\view.blade.php -->
<x-app-layout>
   <div class="w-full flex justify-center py-8">
      <div class="w-[95%] flex flex-col p-8 bg-white rounded-lg items-start">
         @if(!isset($approval))

         <a href="{{route('portal.training')}}" class="bg-red-900 hover:bg-red-700 text-white px-8 py-1 rounded-[25px] flex gap-2 items-center justify-center">
            <img src="{{asset('images/icons/back.png')}}" class="w-[15px] h-[15px]" alt="">
            <span>Trainings</span>
         </a>

         @else

         <div class="w-full flex items-center justify-between my-4">
            <a href="{{route('admin.pendings')}}" class="bg-red-900 hover:bg-red-700 text-white px-8 py-1 rounded-[25px] flex gap-2 items-center justify-center">
               <img src="{{asset('images/icons/back.png')}}" class="w-[15px] h-[15px]" alt="">
               <span>Requests</span>
            </a>

            <div class="flex gap-4">
               <form action="{{route('admin.pendings.toreview',['id'=>$data->id])}}" method="POST">
                  @csrf
                  @method('PATCH')
                  <button type="submit" class="bg-[#ff0000] hover:bg-[#ff0000] text-white px-8 py-1 rounded-[25px] flex gap-2 items-center justify-center">
                     <img src="{{asset('images/icons/deny.png')}}" class="w-[20px] h-[20px]" alt="">
                     <span>To-review</span>
                  </button>
               </form>

               <form action="{{route('admin.pendings.approved',['id'=>$data->id])}}" method="POST">
                  @csrf
                  @method('PATCH')
                  <button type="submit" class="bg-[#008000] hover:bg-[#008000] text-white px-8 py-1 rounded-[25px] flex gap-2 items-center justify-center">
                     <img src="{{asset('images/icons/approve.png')}}" class="w-[20px] h-[20px]" alt="">
                     <span>Approve</span>
                  </button>
               </form>
            </div>
         </div>


    @endif
    


    @if(isset($approval))
        <div class="w-full flex flex-col my-4">
            <h1 class="font-bold text-gray-600 text-[1rem]"> Submission Details</h1>

            <!-- first row -->
            <div class="w-full items-center flex gap-12">
                <div class="flex flex-col ">
                    <span class="text-gray-400">Employee ID</span>
                    <h1 class="font-bold text-gray-600"> {{$user->emp_id }}</h1>
                </div>

                <div class="flex flex-col leading-tight">
                    <span class="text-gray-400">Full Name</span>
                    <h1 class="font-bold text-gray-600">{{$user-> emp_lname . ', ' . $user-> emp_fname . ' ' . $user-> emp_mname}}</h1>
                </div> 



                <div class="flex flex-col">
                    <span class="text-gray-400">Department</span>
                    <h1 class="font-bold text-gray-600"> {{$user->department->dept }}</h1>
                </div>
            </div>


             <!-- second row -->
             <div class="w-full items-center flex gap-12">
                <div class="flex flex-col ">
                    <span class="text-gray-400">Request Type</span>
                    <h1 class="font-bold text-gray-600"> {{$request->type}}</h1>
                </div>

                <div class="flex flex-col leading-tight">
                    <span class="text-gray-400">Date Submitted</span>
                    <h1 class="font-bold text-gray-600">{{$request->date_submitted}}</h1>

                </div>


            </div>

        </div>

        <hr class="w-full opacity-90 my-2">

    @endif

            <div class="w-full flex items-center justify-start gap-1">

                <img src="{{asset('images/hau-logo.png')}}" class="w-[40px] h-[40px] my-4" alt="">
                <h1 class="font-bold text-gray-600 text-[1.5rem]">Training Details</h1>

                    @if(!isset($approval))
                    <a href="{{route('portal.training.edit', ['id'=> $data->id])}}" class="flex px-4 py-1 bg-red-900 hover:bg-red-700 text-white rounded-lg gap-1">
                        @if($data->status !='To-review')
                            <img src="{{asset('images/icons/edit.png')}}" class="w-[20px] h-[20px] " alt="">
                            <span> Edit </span>
                        @else
                            <img src="{{asset('images/icons/resubmit.png')}}" class="w-[20px] h-[20px] " alt="">
                            <span> Resubmit </span>
                        @endif
                    </a>

                    <form action="{{route('portal.training.delete', ['id'=> $data->id])}}" method = "POST">
                        @csrf 
                        @method('DELETE')
                        <button type = "button" onclick="confirmDelete(this)" class="flex px-4 py-1 bg-red-900 hover:bg-red-700 text-white rounded-lg gap-1">
                            <img src="{{asset('images/icons/delete.png')}}" class="w-[20px] h-[20px] " alt="">
                            <span> Delete </span>
                        </button>

                    </form>

                    @endif
                </div>
           



              
         

            
            


       

        <div class="w-full flex flex-col gap-2">
                <div class="w-full flex flex-col leading-tight">
                    <span class=" text-gray-400">Training</span>
                    <h1 class="text-lg font-bold text-gray-700">{{$data->title}}</h1>
                </div>

                <div class="w-2/3 grid grid-cols-3 gap-2">
                    <div class="flex flex-col leading-tight">
                        <span class=" text-gray-400"> Training Type</span>
                        <h1 class="text-lg font-bold text-gray-700">{{$data->type}}</h1>
                    </div>

                    <div class="flex flex-col leading-tight">
                        <span class=" text-gray-400">Conducted by</span>
                        <h1 class="text-lg font-bold text-gray-700">{{$data->organization}}</h1>
                    </div>

                

                </div>

                <div class="w-2/3 grid grid-cols-3 gap-2">
                    <div class="w-full flex flex-col leading-tight">
                        <span class=" text-gray-400">Date of Start</span>
                        <h1 class="text-lg font-bold text-gray-700">{{$data->start_date}}</h1>
                    </div>


                    <div class="flex flex-col leading-tight">
                        <span class=" text-gray-400">Date of Completion</span>
                        <h1 class="text-lg font-bold text-gray-700">{{$data->end_date}}</h1>
                    </div>

                    <div class="flex flex-col leading-tight">
                        <span class=" text-gray-400">Total Hours </span>
                        <h1 class="text-lg font-bold text-gray-700">{{$data->hours}}</h1>
                    </div>
                </div>

                <div class="w-2/3 grid grid-cols-3 gap-2">
                    <div class="flex flex-col leading-tight">
                        <span class=" text-gray-400">Skills Acquired </span>
                        <h1 class="text-lg font-bold text-gray-700">{{$data->skills}}</h1>
                    </div>

                    <div class="flex flex-col leading-tight">
                        <span class=" text-gray-400">Attachment </span>
                        <div class="flex items-center overflow-hidden">
                            <img class="w-[20px] h-[20px]" src = "{{asset('images/icons/attachment.png')}}"/> 
                            @if(isset($approval))
                            <a class ="text-blue-400 hover:text-blue-600 text-decoration-line: underline" href = "{{asset('storage/trainings/'.  $user->emp_id.  '/' . $data->id . '.' . explode('.', $data->attachment)[1])}}" download> {{$data -> attachment}}</a>
                            @else
                            <a class ="text-blue-400 hover:text-blue-600 text-decoration-line: underline" href = "{{asset('storage/trainings/'.  Auth::user()-> id .  '/' . $data->id . '.' . explode('.', $data->attachment)[1])}}" download> {{$data -> attachment}}</a>
                            @endif
                        </div>
                    </div>
                </div>


                    <span class="mt-4 text-gray-400">
                        Proof of Completion
                    </span>

               
                
                    @if(isset($approval))
                    <iframe id="pdfIframe" src="{{asset('storage/trainings/'.  $user->emp_id.  '/' . $data->id . '.' . explode('.', $data->attachment)[1])}}" width="100%" height= "500px" ></iframe>
                    @else
                    <iframe id="pdfIframe" src="{{asset('storage/trainings/'.  Auth::user()-> id .  '/' . $data->id . '.' . explode('.', $data->attachment)[1])}}" width="100%" height= "500px" ></iframe>
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


<script>

function confirmDelete(button) { 
    const form = button.closest('form'); 
    if(confirm('Are you sure you want to delete this record?')){ 
        form.submit(); 
    }
}

function confirmResubmit(button) { 
    const form = button.closest('form' ); 
    if(confirm('Are you sure you want to resubmit the data?')) { 
        form.submit(); 
    }
}

</script>