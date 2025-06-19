<x-app-layout>
  <div class="min-h-screen">
    <div class="w-full flex justify-center py-12">
      <div class="w-[80%] grid grid-cols-2 p-8 bg-white rounded-lg">
        <!-- Left Column -->
        <div class="flex flex-col items-center text-center px-4">
          <a href="{{ route('portal.employment.view', ['id' => $data->id]) }}" class="bg-red-900 hover:bg-red-700 text-white px-16 py-1 rounded-[25px] flex gap-2 items-center justify-center">
            <img src="{{ asset('images/icons/back.png') }}" class="w-[15px] h-[15px]" alt="">
            <span>Cancel</span>
          </a>
          @if($data->status != "To-review")
            <h1 class="text-[1.5rem] text-gray-800 font-bold">Edit Employment</h1>
          @else
            <h1 class="text-[1.5rem] text-gray-800 font-bold">Resubmit Employment</h1>
          @endif
          <span class="leading-[1rem] text-gray-500">
            Please ensure that all information and attachments are accurate before updating.
          </span>
          <img src="{{ asset('images/hau-logo.png') }}" class="w-[250px] h-[250px] my-4" alt="">
        </div>

        <!-- Right Column -->
        <div>
          <form action="{{ route('portal.employment.update', ['id' => $data->id]) }}" method="POST" class="w-full flex flex-col gap-2" enctype="multipart/form-data">
            @csrf 
            @method('PUT')
            <h1 class="font-bold text-gray-600 text-[1.5rem] mb-2">Employment Details</h1>
            @if ($errors->any())
             <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline"> Please fix the following issues:</span>
                <ul class="mt-2 list-disc list-inside">
                   @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                   @endforeach
                </ul>
             </div>
          @endif


            <div class="w-full flex flex-col leading-tight">
              <span class="text-gray-400">Company <span class="font-bold text-red-500">*</span></span>
              <input type="text" name="company" class="rounded-lg border border-gray-400" value="{{ $data->company }}" required>
            </div>

            <div class="w-full grid grid-cols-2 gap-2">
              <div class="flex flex-col leading-tight">
                <span class="text-gray-400">Date Hired <span class="font-bold text-red-500">*</span></span>
                <input type="date" name="date_hired" class="rounded-lg border border-gray-400 text-gray-700" min ="1925-01-01" max="{{ date('Y-m-d') }}" value="{{ $data->date_hired }}" required>
              </div>
              <div class="flex flex-col leading-tight">
                <span class="text-gray-400">Date Resigned <span class="font-bold text-red-500">*</span></span>
                <input type="date" name="date_resigned" class="rounded-lg border border-gray-400 text-gray-700" min ="1925-01-01" max="{{ date('Y-m-d') }}" value="{{ $data->date_resigned }}" required>
              </div>
            </div>

            <div class="w-full flex flex-col leading-tight">
              <span class="text-gray-400">Position <span class="font-bold text-red-500">*</span></span>
              <input type="text" name="position" class="rounded-lg border border-gray-400" value="{{ $data->position }}" required>
            </div>

            <div class="w-full flex flex-col leading-tight">
              <span class="text-gray-400">Reason for Exit <span class="font-bold text-red-500">*</span></span>
              <textarea name="reason" class="rounded-lg border border-gray-400" rows="2" required>{{ $data->reason }}</textarea>
            </div>

            <div class="w-full flex flex-col leading-tight">
              <span class="text-gray-400">Attachment | Proof of Employment <span class="font-bold text-red-500">*</span></span>
              <div class="flex-col">
                <div class="w-full flex items-center my-2" id="attachment">
                  <img src="{{ asset('images/icons/attachment.png') }}" alt="" class="w-[20px] h-[20px]">
                  <h1 class="truncate font-semibold text-gray-600">{{ $data->attachment }}</h1>
                  <button type="button" class="bg-gray-900 hover:bg-gray-800 text-white flex items-center px-8 py-1 ml-2 rounded-lg" id="edit_att">
                    <img src="{{ asset('images/icons/upload.png') }}" alt="" class="w-[20px] h-[20px]">
                    <span>Change File</span>
                  </button>
                </div>
              </div>
              <div class="w-full flex gap-2 hide" id="attachment_edit">
                <button type="button" class="bg-gray-900 hover:bg-gray-800 text-white flex items-center px-4 py-1 ml-2 rounded-lg" id="cancel">
                  <img src="{{ asset('images/icons/cancel.png') }}" alt="" class="w-[20px] h-[20px]">
                  <span>Cancel</span>
                </button>
                <input type="file" name="attachment" id="fileinput" class="text-gray-700 truncate">
              </div>
            </div>

            <div class="w-full flex justify-end">
              <button type="submit" class="bg-red-900 hover:bg-red-700 text-white flex items-center justify-center px-12 py-2">
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
  a,
  button {
    transition: 300ms;
  }

  .hide {
    display: none;
  }
</style>

<script>
  let attachment = document.getElementById('attachment');
  let attachment_edit = document.getElementById('attachment_edit');
  let attachment_btn = document.getElementById('edit_att');
  let cancel_btn = document.getElementById('cancel');

  attachment_btn.addEventListener("click", () => {
    attachment_edit.classList.remove('hide');
    attachment.classList.add('hide');
    document.getElementById('fileinput').setAttribute('required', 'required');
  });

  cancel_btn.addEventListener('click', () => {
    attachment_edit.classList.add('hide');
    const fileinput = document.getElementById('fileinput');
    fileinput.value = '';
    fileinput.removeAttribute('required');
    attachment.classList.remove('hide');
  });
</script>
