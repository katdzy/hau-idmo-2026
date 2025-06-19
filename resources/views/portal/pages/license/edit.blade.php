<x-app-layout>
  <div class="min-h-screen">
    <div class="w-full flex justify-center py-12">
      <div class="w-[80%] grid grid-cols-2 p-8 bg-white rounded-lg">
        <!-- Left Column -->
        <div class="flex flex-col items-center text-center px-4">
          <a href="{{ route('portal.license.view', ['id'=> $data->id]) }}" class="bg-red-900 hover:bg-red-700 text-white px-16 py-1 rounded-[25px] flex gap-2 items-center justify-center">
            <img src="{{ asset('images/icons/cancel.png') }}" class="w-[15px] h-[15px]" alt="">
            <span>Cancel</span>
          </a>
          @if($data->status != "To-review")
            <h1 class="text-[1.5rem] text-gray-800 font-bold">Edit License</h1>
          @else
            <h1 class="text-[1.5rem] text-gray-800 font-bold">Resubmit License</h1>
          @endif
          <span class="leading-[1rem] text-gray-500">
            Kindly double check the information and attachments needed before saving.
          </span>
          <img src="{{ asset('images/hau-logo.png') }}" class="w-[250px] h-[250px] my-4" alt="">
        </div>

        <!-- Right Column -->
        <div>
          <form action="{{ route('portal.license.update', ['id'=> $data->id]) }}" method="POST" class="w-full flex flex-col gap-2" enctype="multipart/form-data">
            @csrf 
            @method('PUT')
            <h1 class="font-bold text-gray-600 text-[1.5rem] mb-2">License Details</h1>

            <div class="w-full flex flex-col leading-tight">
              <span class="text-gray-400">Type <span class="font-bold text-red-500">*</span></span>
              <select name="type" class="rounded-lg border border-gray-400">
                @foreach($license_types as $item)
                  <option value="{{ $item->item }}">{{ $item->item }}</option>
                @endforeach
              </select>
            </div>

            <div class="w-full flex flex-col leading-tight">
              <span class="text-gray-400">License <span class="font-bold text-red-500">*</span></span>
              <input type="text" name="title" class="rounded-lg border border-gray-400" value="{{ $data->title }}" required>
            </div>

            <div class="w-full flex flex-col leading-tight">
              <span class="text-gray-400">Date Obtained <span class="font-bold text-red-500">*</span></span>
              <input type="date" name="date_obtained" class="rounded-lg border border-gray-400" min="1925-01-01" max="{{ date('Y-m-d') }}" value="{{ $data->date_obtained }}" required>
            </div>

            <div class="w-full flex flex-col leading-tight">
              <span class="text-gray-400">Attachment <span class="font-bold text-red-500">*</span></span>
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
                <input type="file" name="attachment" class="text-gray-700" id="fileinput">
              </div>
            </div>

            <div class="w-full flex justify-end">
              <button class="bg-red-900 hover:bg-red-700 text-white flex items-center justify-center px-12 py-2" type="submit">
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
    attachment.classList.remove('hide'); 
    document.getElementById('fileinput').removeAttribute('required');
  });
</script>
