<x-app-layout>
  <div class="min-h-screen">
    <div class="w-full flex justify-center py-12">
      <div class="w-[80%] grid grid-cols-2 p-8 bg-white rounded-lg">
        <!-- Left Column -->
        <div class="flex flex-col items-center text-center px-4">
          <a href="{{ route('portal.filing.type') }}" class="bg-red-900 hover:bg-red-700 text-white px-16 py-1 rounded-[25px] flex gap-2 items-center justify-center">
            <img src="{{ asset('images/icons/back.png') }}" class="w-[15px] h-[15px]" alt="">
            <span>Select Category</span>
          </a>
          <h1 class="text-[1.5rem] text-gray-800 font-bold">Employment Application</h1>
          <span class="leading-[1rem] text-gray-500">
            Kindly double check the information and attachments needed before submitting.
          </span>
          <img src="{{ asset('images/hau-logo.png') }}" class="w-[250px] h-[250px] my-4" alt="">
        </div>

        <!-- Right Column -->
        <div>
          <form action="{{ route('portal.filing.employment.add') }}" method="POST" class="w-full flex flex-col gap-2" enctype="multipart/form-data">
            @csrf 
            @method('POST')
            <h1 class="font-bold text-gray-600 text-[1.5rem] mb-2">Employment Details</h1>

            <div class="w-full flex flex-col leading-tight">
              <span class="text-gray-400">Company <span class="font-bold text-red-500">*</span></span>
              <input type="text" name="company" class="rounded-lg border border-gray-400" required>
            </div>

            <div class="w-full grid grid-cols-2 gap-2">
              <div class="flex flex-col leading-tight">
                <span class="text-gray-400">Date Hired <span class="font-bold text-red-500">*</span></span>
                <input type="date" name="date_hired" class="rounded-lg border border-gray-400" min ="1925-01-01" max="{{ date('Y-m-d') }}"required>
              </div>
              <div class="flex flex-col leading-tight">
                <span class="text-gray-400">Date Resigned <span class="font-bold text-red-500">*</span></span>
                <input type="date" name="date_resigned" class="rounded-lg border border-gray-400" min ="1925-01-01" max="{{ date('Y-m-d') }}"required>
              </div>
            </div>

            <div class="w-full flex flex-col leading-tight">
              <span class="text-gray-400">Position <span class="font-bold text-red-500">*</span></span>
              <input type="text" name="position" class="rounded-lg border border-gray-400" required>
            </div>

            <div class="w-full flex flex-col leading-tight">
              <span class="text-gray-400">Reason for Exit <span class="font-bold text-red-500">*</span></span>
              <textarea name="reason" class="rounded-lg border border-gray-400" rows="2" required></textarea>
            </div>

            <div class="w-full flex flex-col leading-tight">
              <span class="text-gray-400">Attachment | Proof of Employment <span class="font-bold text-red-500">*</span></span>
              <input type="file" name="attachment" required>
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
</style>
