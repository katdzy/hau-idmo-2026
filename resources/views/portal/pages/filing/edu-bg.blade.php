<x-app-layout>
   <div class="w-full flex justify-center py-12">
      <div class="w-[80%] grid grid-cols-2 p-8 bg-white rounded-lg">
         <div class="flex flex-col items-center text-center px-4">
            <a href="{{route('portal.filing.type')}}" class="bg-red-900 hover:bg-red-700 text-white px-16 py-1 rounded-[25px] flex gap-2 items-center justify-center">
               <img src="{{asset('images/icons/back.png')}}" class="w-[15px] h-[15px]" alt="">
               <span class="">Select Category</span>
            </a>

            <h1 class="text-[1.5rem] text-gray-800 font-bold">Educational Background Application</h1>
            <span class="leading-[1rem] text-gray-500">Kindly double check the information and attachments needed before submitting.</span>

            <img src="{{asset('images/hau-logo.png')}}" class="w-[250px] h-[250px] my-4" alt="">
         </div>

         <div>
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
            <form action="{{route('portal.filing.edu-bg.add')}}" method="POST" class="w-full flex flex-col gap-2" enctype="multipart/form-data">
               @csrf 
               @method('POST')
               <h1 class="font-bold text-gray-600 text-[1.5rem] mb-2">Educational Background Details</h1>

               <div class="w-full flex flex-col leading-tight">
                  <span class=" text-gray-400">School Name <span class="font-bold text-red-500">*</span></span>
                  <input type="text" name="school_name" class="rounded-lg border border-gray-400" required>
               </div>

               <div class="w-full grid grid-cols-2 gap-2">
                  <div class="flex flex-col leading-tight">
                     <span class=" text-gray-400">From <span class="font-bold text-red-500">*</span></span>
                     <input type="date" name="start_date" class="rounded-lg border border-gray-400" min ="1925-01-01" max="{{ date('Y-m-d') }}" required>
                  </div>

                  <div class="flex flex-col leading-tight">
                     <span class=" text-gray-400">To <span class="font-bold text-red-500">*</span></span>
                     <input type="date" name="end_date" class="rounded-lg border border-gray-400" min ="1925-01-01" max="{{ date('Y-m-d', strtotime('+6 years')) }}"required>
                  </div>
               </div>

               <div class="w-full flex flex-col leading-tight">
                  <span class=" text-gray-400">Education Type <span class="font-bold text-red-500">*</span></span>
                  <select name="education_type" id="education_type" class="rounded-lg border border-gray-400" required>
                     <option value="N/A" selected disabled>Select Type</option>
                     <option value="High School">High School</option>
                     <option value="Associate’s Degree">Associate’s Degree</option>
                     <option value="Undergraduate (Bachelor's)">Undergraduate (Bachelor's)</option>
                     <option value="Post Graduate (Master's)">Post Graduate (Master's)</option>
                     <option value="Post Graduate (PhD)">Post Graduate (PhD)</option>
                     <option value="Vocational/Trade">Vocational/Trade</option>
                     <option value="Others">Others</option>
                  </select>
               </div>

               <div class="w-full flex flex-col leading-tight">
                  <span class=" text-gray-400">School Address <span class="font-bold text-red-500">*</span></span>
                  <input type="text" name="school_address" class="rounded-lg border border-gray-400" required>
               </div>

               <div class="w-full flex flex-col leading-tight">
                  <span class=" text-gray-400">Awards / Honors <span class="font-bold text-red-500">*</span></span>
                  <input type="text" name="awards" class="rounded-lg border border-gray-400" required>
               </div>

               <div class="w-full flex flex-col leading-tight">
                  <span class=" text-gray-400">Graduation Date <span class="font-bold text-red-500">*</span></span>
                  <input type="date" name="grad_date" class="rounded-lg border border-gray-400" required>
               </div>

               <div class="w-full flex flex-col leading-tight">
                  <span class=" text-gray-400">Last Semester Attended <span class="font-bold text-red-500">*</span></span>
                  <select name="last_sem" class="rounded-lg border border-gray-400" required>
                     <option value="N/A" selected disabled>Select Semester</option>
                     <option value="1st Semester">1st Semester</option>
                     <option value="2nd Semester">2nd Semester</option>
                     <option value="1st Trimester">1st Trimester</option>
                     <option value="2nd Trimester">2nd Trimester</option>
                     <option value="3rd Trimester">3rd Trimester</option>
                     <option value="Summer Term">Summer Term</option>
                  </select>
               </div>

               <div class="w-full flex flex-col leading-tight">
                  <span class=" text-gray-400">SO No. of Transcript <span class="font-bold text-red-500">*</span></span>
                  <input type="text" name="so_num" class="rounded-lg border border-gray-400" required>
               </div>

               <div class="w-full flex flex-col leading-tight">
                  <span class=" text-gray-400">Level / Attainment <span class="font-bold text-red-500">*</span></span>
                  <select name="level" id="level" class="rounded-lg border border-gray-400" required>
                     <option value="N/A" selected disabled>Select Level</option>
                     <option value="High School Graduate">High School Graduate</option>
                     <option value="Associate / 2-Year Course">Associate / 2-Year Course</option>
                     <option value="College Graduate (Bachelor’s Degree)">College Graduate (Bachelor’s Degree)</option>
                     <option value="Post-Graduate (Master’s)">Post-Graduate (Master’s)</option>
                     <option value="Post-Graduate (PhD)">Post-Graduate (PhD)</option>
                     <option value="Vocational / Trade">Vocational / Trade</option>
                     <option value="Others">Others</option>
                  </select>
               </div>

               <div class="w-full flex flex-col leading-tight">
                  <span class=" text-gray-400">Course, Program, or Degree <span class="font-bold text-red-500">*</span></span>
                  <input type="text" name="degree" class="rounded-lg border border-gray-400" required>
               </div>

               <div class="w-full flex flex-col leading-tight">
                  <span class=" text-gray-400">Attachment | Transcript of Records <span class="font-bold text-red-500">*</span></span>
                  <input type="file" name="attachment" required>
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
</x-app-layout>

<style>
   a, button { 
      transition: 300ms;
   }
</style>

<!-- JavaScript for dynamic matching -->
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

         // Loop through the Level options to find a match
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

         // Loop through the Level options to find a match
         for (let option of educationTypeSelect.options) {
            if (option.value === educationTypeToSelect) {
               option.selected = true;
               break;
            }
         }
      });
   });
</script>
