@php 
  $file = $data->id . '.' . explode('.', $data->attachment)[1]; 
@endphp

<!-- resources/views/portal/pages/edu-bg/view.blade.php -->
<x-app-layout>
  <div class="w-full flex justify-center py-8">
    <div class="w-[95%] flex flex-col p-8 bg-white rounded-lg items-start">
      
      @if (!isset($approval))
        <a href="{{ route('portal.edu-bg') }}" class="bg-red-900 hover:bg-red-700 text-white px-8 py-1 rounded-[25px] flex gap-2 items-center justify-center">
          <img src="{{ asset('images/icons/back.png') }}" class="w-[15px] h-[15px]" alt="">
          <span>Educational Background</span>
        </a>
      @else
        <div class="w-full flex items-center justify-between my-4">
          <a href="{{ route('admin.pendings') }}" class="bg-red-900 hover:bg-red-700 text-white px-8 py-1 rounded-[25px] flex gap-2 items-center justify-center">
            <img src="{{ asset('images/icons/back.png') }}" class="w-[15px] h-[15px]" alt="">
            <span>Requests</span>
          </a>
          <div class="flex gap-4">
            <form action="{{ route('admin.pendings.toreview', ['id' => $data->id]) }}" method="POST">
              @csrf
              @method('PATCH')
              <button type="submit" class="bg-[#ff0000] hover:bg-[#ff0000] text-white px-8 py-1 rounded-[25px] flex gap-2 items-center justify-center">
                <img src="{{ asset('images/icons/deny.png') }}" class="w-[20px] h-[20px]" alt="">
                <span>To-review</span>
              </button>
            </form>

            <form action="{{ route('admin.pendings.approved', ['id' => $data->id]) }}" method="POST">
              @csrf
              @method('PATCH')
              <button type="submit" class="bg-[#008000] hover:bg-[#008000] text-white px-8 py-1 rounded-[25px] flex gap-2 items-center justify-center">
                <img src="{{ asset('images/icons/approve.png') }}" class="w-[20px] h-[20px]" alt="">
                <span>Approve</span>
              </button>
            </form>
          </div>
        </div>
      @endif

      @if (isset($approval))
        <div class="w-full flex flex-col my-4">
          <h1 class="font-bold text-gray-600 text-[1rem]">Submission Details</h1>
          <!-- First Row -->
          <div class="w-full flex items-center gap-12">
            <div class="flex flex-col">
              <span class="text-gray-400">Employee ID</span>
              <h1 class="font-bold text-gray-600">{{ $user->emp_id }}</h1>
            </div>
            <div class="flex flex-col leading-tight">
              <span class="text-gray-400">Full Name</span>
              <h1 class="font-bold text-gray-600">
                {{ $user->emp_lname . ', ' . $user->emp_fname . ' ' . $user->emp_mname }}
              </h1>
            </div>
            <div class="flex flex-col">
              <span class="text-gray-400">Department</span>
              <h1 class="font-bold text-gray-600">{{ $user->department->dept }}</h1>
            </div>
          </div>

          <!-- Second Row -->
          <div class="w-full flex items-center gap-12">
            <div class="flex flex-col">
              <span class="text-gray-400">Request Type</span>
              <h1 class="font-bold text-gray-600">{{ $request->type }}</h1>
            </div>
            <div class="flex flex-col leading-tight">
              <span class="text-gray-400">Date Submitted</span>
              <h1 class="font-bold text-gray-600">{{ $request->date_submitted }}</h1>
            </div>
          </div>
        </div>

        <hr class="w-full opacity-90 my-2">
      @endif

      <div class="w-full flex items-center justify-start gap-1">
        <img src="{{ asset('images/hau-logo.png') }}" class="w-[40px] h-[40px] my-4" alt="">
        <h1 class="font-bold text-gray-600 text-[1.5rem]">Educational Background Details</h1>

        @if (!isset($approval))
          @if ($data->status != 'To-review')
            <a href="{{ route('portal.edu-bg.edit', ['id' => $data->id]) }}" class="flex px-4 py-1 bg-red-900 hover:bg-red-700 text-white rounded-lg gap-1">
              <img src="{{ asset('images/icons/edit.png') }}" class="w-[20px] h-[20px]" alt="">
              <span>Edit</span>
            </a>
          @else
            <a href="{{ route('portal.edu-bg.edit', ['id' => $data->id]) }}" class="flex px-4 py-1 bg-red-900 hover:bg-red-700 text-white rounded-lg gap-1">
              <img src="{{ asset('images/icons/resubmit.png') }}" class="w-[20px] h-[20px]" alt="">
              <span>Resubmit</span>
            </a>
          @endif

          <form action="{{ route('portal.edu-bg.delete', ['id' => $data->id]) }}" method="POST">
            @csrf 
            @method('DELETE')
            <button type="button" onclick="confirmDelete(this)" class="flex px-4 py-1 bg-red-900 hover:bg-red-700 text-white rounded-lg gap-1">
              <img src="{{ asset('images/icons/delete.png') }}" class="w-[20px] h-[20px]" alt="">
              <span>Delete</span>
            </button>
          </form>
        @endif
      </div>

      <div class="w-full flex flex-col gap-2">
        <div class="w-full flex flex-col leading-tight">
          <span class="text-gray-400">School Name</span>
          <h1 class="text-lg font-bold text-gray-700">{{ $data->school_name }}</h1>
        </div>

        <div class="w-full grid grid-cols-3 gap-2">
          <div class="flex flex-col leading-tight">
            <span class="text-gray-400">Period of Schooling</span>
            <h1 class="text-lg font-bold text-gray-700">{{ $data->start_date }} to {{ $data->end_date }}</h1>
          </div>
          <div class="flex flex-col leading-tight">
            <span class="text-gray-400">Education Type</span>
            <h1 class="text-lg font-bold text-gray-700">{{ $data->education_type }}</h1>
          </div>
          <div class="flex flex-col leading-tight">
            <span class="text-gray-400">School Address</span>
            <h1 class="text-lg font-bold text-gray-700">{{ $data->school_address }}</h1>
          </div>
        </div>

        <div class="w-full grid grid-cols-3 gap-2">
          <div class="flex flex-col leading-tight">
            <span class="text-gray-400">Awards/Honors</span>
            <h1 class="text-lg font-bold text-gray-700">{{ $data->awards }}</h1>
          </div>
          <div class="flex flex-col leading-tight">
            <span class="text-gray-400">Graduation Date</span>
            <h1 class="text-lg font-bold text-gray-700">{{ $data->grad_date }}</h1>
          </div>
          <div class="flex flex-col leading-tight">
            <span class="text-gray-400">Last Semester Attended</span>
            <h1 class="text-lg font-bold text-gray-700">{{ $data->last_sem }}</h1>
          </div>
        </div>

        <div class="w-full grid grid-cols-3 gap-2">
          <div class="flex flex-col leading-tight">
            <span class="text-gray-400">SO No. of Transcript</span>
            <h1 class="text-lg font-bold text-gray-700">{{ $data->so_num }}</h1>
          </div>
          <div class="flex flex-col leading-tight">
            <span class="text-gray-400">Level/Attainment</span>
            <h1 class="text-lg font-bold text-gray-700">{{ $data->level }}</h1>
          </div>
          <div class="flex flex-col leading-tight">
            <span class="text-gray-400">Course, Program, or Degree</span>
            <h1 class="text-lg font-bold text-gray-700">{{ $data->degree }}</h1>
          </div>
        </div>

        <div class="w-full grid grid-cols-3 gap-2">
          <div class="flex flex-col leading-tight">
            <span class="text-gray-400">Attachment</span>
            <div class="flex items-center overflow-hidden">
              <img class="w-[20px] h-[20px]" src="{{ asset('images/icons/attachment.png') }}" alt="">
              @if (isset($approval))
                <a class="text-blue-400 hover:text-blue-600 underline" href="{{ asset('storage/edu-bg/' . $user->emp_id . '/' . $file) }}" download>
                  {{ $data->attachment }}
                </a>
              @else
                <a class="text-blue-400 hover:text-blue-600 underline" href="{{ asset('storage/edu-bg/' . Auth::user()->id . '/' . $file) }}" download>
                  {{ $data->attachment }}
                </a>
              @endif
            </div>
          </div>

          <div class="flex flex-col leading-tight">
            <span class="text-gray-400">Status</span>
            <h1 class="text-lg font-bold text-gray-700">{{ $data->status }}</h1>
          </div>
        </div>

        <span class="mt-4 text-gray-400">Transcript of Records</span>
        
        @if (isset($approval))
          <iframe id="pdfIframe" src="{{ asset('storage/edu-bg/' . $user->emp_id . '/' . $file) }}" width="100%" height="500px"></iframe>
        @else
          <iframe id="pdfIframe" src="{{ asset('storage/edu-bg/' . Auth::user()->id . '/' . $file) }}" width="100%" height="500px"></iframe>
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
    if (confirm('Are you sure you want to delete this record?')) { 
      form.submit(); 
    }
  }

  function confirmResubmit(button) { 
    const form = button.closest('form'); 
    if (confirm('Are you sure you want to resubmit the data?')) { 
      form.submit(); 
    }
  }
</script>
