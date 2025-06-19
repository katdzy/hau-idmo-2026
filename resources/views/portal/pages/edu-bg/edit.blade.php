<x-app-layout>
  <div class="w-full flex justify-center py-12">
    <div class="w-[80%] grid grid-cols-2 p-8 bg-white rounded-lg">
      <!-- Left Column -->
      <div class="flex flex-col items-center text-center px-4">
        <a href="{{ route('portal.edu-bg.view', ['id'=> $data->id]) }}" class="bg-red-900 hover:bg-red-700 text-white px-16 py-1 rounded-[25px] flex gap-2 items-center justify-center">
          <img src="{{ asset('images/icons/back.png') }}" class="w-[15px] h-[15px]" alt="">
          <span>Cancel</span>
        </a>

        @if($data->status != "To-review")
        <h1 class="text-[1.5rem] text-gray-800 font-bold">Edit Educational Background</h1>
        @else
        <h1 class="text-[1.5rem] text-gray-800 font-bold">Resubmit Educational Background</h1>
        @endif
        <span class="leading-[1rem] text-gray-500">
          Please ensure that all information and attachments are accurate before updating.
        </span>
        <img src="{{ asset('images/hau-logo.png') }}" class="w-[250px] h-[250px] my-4" alt="">
      </div>

      <!-- Right Column -->
      <div>
        <form action="{{ route('portal.edu-bg.update', ['id'=> $data->id]) }}" method="POST" class="w-full flex flex-col gap-2" enctype="multipart/form-data">
          @csrf 
          @method('PUT')

          <h1 class="font-bold text-gray-600 text-[1.5rem] mb-2">Educational Background Details</h1>

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
            <span class="text-gray-400">School Name <span class="font-bold text-red-500">*</span></span>
            <input type="text" name="school_name" class="rounded-lg border border-gray-400" value="{{ $data->school_name }}" required>
          </div>

          <div class="w-full grid grid-cols-2 gap-2">
            <div class="flex flex-col leading-tight">
              <span class="text-gray-400">From <span class="font-bold text-red-500">*</span></span>
              <input type="date" name="start_date" class="rounded-lg border border-gray-400" min="1925-01-01" max="{{ date('Y-m-d') }}" value="{{ $data->start_date }}" required>
            </div>
            <div class="flex flex-col leading-tight">
              <span class="text-gray-400">To <span class="font-bold text-red-500">*</span></span>
              <input type="date" name="end_date" class="rounded-lg border border-gray-400" min="1925-01-01" max="{{ date('Y-m-d', strtotime('+6 years')) }}" value="{{ $data->end_date }}" required>
            </div>
          </div>

          <div class="w-full flex flex-col leading-tight">
            <span class="text-gray-400">Education Type <span class="font-bold text-red-500">*</span></span>
            <select name="education_type" id="education_type" class="rounded-lg border border-gray-400" required>
              <option value="N/A" selected disabled>Select Type</option>
              <option value="High School" {{ $data->education_type == "High School" ? 'selected' : '' }}>High School</option>
              <option value="Associate’s Degree" {{ $data->education_type == "Associate’s Degree" ? 'selected' : '' }}>Associate’s Degree</option>
              <option value="Undergraduate (Bachelor's)" {{ $data->education_type == "Undergraduate (Bachelor's)" ? 'selected' : '' }}>Undergraduate (Bachelor's)</option>
              <option value="Post Graduate (Master's)" {{ $data->education_type == "Post Graduate (Master's)" ? 'selected' : '' }}>Post Graduate (Master's)</option>
              <option value="Post Graduate (PhD)" {{ $data->education_type == "Post Graduate (PhD)" ? 'selected' : '' }}>Post Graduate (PhD)</option>
              <option value="Vocational/Trade" {{ $data->education_type == "Vocational/Trade" ? 'selected' : '' }}>Vocational/Trade</option>
              <option value="Others" {{ $data->education_type == "Others" ? 'selected' : '' }}>Others</option>
            </select>
          </div>

          <div class="w-full flex flex-col leading-tight">
            <span class="text-gray-400">School Address <span class="font-bold text-red-500">*</span></span>
            <input type="text" name="school_address" class="rounded-lg border border-gray-400" value="{{ $data->school_address }}" required>
          </div>

          <div class="w-full flex flex-col leading-tight">
            <span class="text-gray-400">Awards / Honors <span class="font-bold text-red-500">*</span></span>
            <input type="text" name="awards" class="rounded-lg border border-gray-400" value="{{ $data->awards }}" required>
          </div>

          <div class="w-full flex flex-col leading-tight">
            <span class="text-gray-400">Graduation Date <span class="font-bold text-red-500">*</span></span>
            <input type="date" name="grad_date" class="rounded-lg border border-gray-400" value="{{ $data->grad_date }}" required>
          </div>

          <div class="w-full flex flex-col leading-tight">
            <span class="text-gray-400">Last Semester Attended <span class="font-bold text-red-500">*</span></span>
            <select name="last_sem" class="rounded-lg border border-gray-400" required>
              <option value="N/A" selected disabled>Select Semester</option>
              <option value="1st Semester" {{ $data->last_sem == "1st Semester" ? 'selected' : '' }}>1st Semester</option>
              <option value="2nd Semester" {{ $data->last_sem == "2nd Semester" ? 'selected' : '' }}>2nd Semester</option>
              <option value="1st Trimester" {{ $data->last_sem == "1st Trimester" ? 'selected' : '' }}>1st Trimester</option>
              <option value="2nd Trimester" {{ $data->last_sem == "2nd Trimester" ? 'selected' : '' }}>2nd Trimester</option>
              <option value="3rd Trimester" {{ $data->last_sem == "3rd Trimester" ? 'selected' : '' }}>3rd Trimester</option>
              <option value="Summer Term" {{ $data->last_sem == "Summer Term" ? 'selected' : '' }}>Summer Term</option>
            </select>
          </div>

          <div class="w-full flex flex-col leading-tight">
            <span class="text-gray-400">SO No. of Transcript <span class="font-bold text-red-500">*</span></span>
            <input type="text" name="so_num" class="rounded-lg border border-gray-400" value="{{ $data->so_num }}" required>
          </div>

          <div class="w-full flex flex-col leading-tight">
            <span class="text-gray-400">Level / Attainment <span class="font-bold text-red-500">*</span></span>
            <select name="level" id="level" class="rounded-lg border border-gray-400" required>
              <option value="N/A" selected disabled>Select Level</option>
              <option value="High School Graduate" {{ $data->level == "High School Graduate" ? 'selected' : '' }}>High School Graduate</option>
              <option value="Associate / 2-Year Course" {{ $data->level == "Associate / 2-Year Course" ? 'selected' : '' }}>Associate / 2-Year Course</option>
              <option value="College Graduate (Bachelor’s Degree)" {{ $data->level == "College Graduate (Bachelor’s Degree)" ? 'selected' : '' }}>College Graduate (Bachelor’s Degree)</option>
              <option value="Post-Graduate (Master’s)" {{ $data->level == "Post-Graduate (Master’s)" ? 'selected' : '' }}>Post-Graduate (Master’s)</option>
              <option value="Post-Graduate (PhD)" {{ $data->level == "Post-Graduate (PhD)" ? 'selected' : '' }}>Post-Graduate (PhD)</option>
              <option value="Vocational / Trade" {{ $data->level == "Vocational / Trade" ? 'selected' : '' }}>Vocational / Trade</option>
              <option value="Others" {{ $data->level == "Others" ? 'selected' : '' }}>Others</option>
            </select>
          </div>

          <div class="w-full flex flex-col leading-tight">
            <span class="text-gray-400">Course, Program, or Degree <span class="font-bold text-red-500">*</span></span>
            <input type="text" name="degree" class="rounded-lg border border-gray-400" value="{{ $data->degree }}" required>
          </div>

          <div class="w-full flex flex-col leading-tight">
            <span class="text-gray-400">Attachment | Transcript of Records <span class="font-bold text-red-500">*</span></span>
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

<!-- Attachment File Handling -->
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

<!-- Dynamic Dropdown Matching -->
<script>
   document.addEventListener('DOMContentLoaded', function() {
      const educationTypeSelect = document.getElementById('education_type');
      const levelSelect = document.getElementById('level');

      // Mapping of Education Type to Level/Attainment
      const educMapping = {
         "High School": "High School Graduate",
         "Associate’s Degree": "Associate / 2-Year Course",
         "Undergraduate (Bachelor's)": "College Graduate (Bachelor’s Degree)",
         "Post Graduate (Master's)": "Post-Graduate (Master’s)",
         "Post Graduate (PhD)": "Post-Graduate (PhD)",
         "Vocational/Trade": "Vocational / Trade",
         "Others": "Others"
      };

      educationTypeSelect.addEventListener('change', function() {
         const selectedType = educationTypeSelect.value;
         const levelToSelect = educMapping[selectedType];
         for (let option of levelSelect.options) {
            if (option.value === levelToSelect) {
               option.selected = true;
               break;
            }
         }
      });

      const levelMapping = {
         "High School Graduate": "High School",
         "Associate / 2-Year Course": "Associate’s Degree",
         "College Graduate (Bachelor’s Degree)": "Undergraduate (Bachelor's)",
         "Post-Graduate (Master’s)": "Post Graduate (Master's)",
         "Post-Graduate (PhD)": "Post Graduate (PhD)",
         "Vocational / Trade": "Vocational/Trade",
         "Others": "Others"
      };

      levelSelect.addEventListener('change', function() {
         const selectedType = levelSelect.value;
         const educationTypeToSelect = levelMapping[selectedType];
         for (let option of educationTypeSelect.options) {
            if (option.value === educationTypeToSelect) {
               option.selected = true;
               break;
            }
         }
      });
   });
</script>
