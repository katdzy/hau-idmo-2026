<x-app-layout>
    <div class="min-h-screen">
        <div class="w-full flex justify-center py-8">
            <div class="w-[95%] flex flex-col p-8 bg-white rounded-lg">


                <!-- Header Section -->
                <div class="w-full flex items-center gap-4">
                    <a href="{{ route('admin.loads.db') }}" class="inline-flex gap-1 items-center justify-center bg-red-900 hover:bg-red-700 px-6 py-1 text-white rounded-xl mb-4">
                        <img src="{{ asset('images/icons/back.png') }}" class="w-[20px] h-[20px]" alt="Back">
                        <span>Return to Tools</span>
                    </a>

                    <h1 class="text-[1.7rem] font-bold text-gray-700">Loads File Upload</h1>
                </div>

                <!-- File Upload Section -->
                @if(!$imported)
                    <span class="text-xl text-gray-500 mt-4">Upload Loads File</span>
                    <span class="text-[0.8rem] text-gray-400">
                        Ensure the uploaded file follows the official template for CSV updates. This is crucial for accurate data processing.
                    </span>

                    <div class="w-full flex flex-col items-start gap-4 my-4">
                        <form action="{{ route('admin.loads.import') }}" method="POST" class="flex flex-col items-start gap-4" enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <!-- File Input -->
                            <div class="flex items-center gap-2">
                                <input class="my-2" type="file" name="file" accept=".xlsx" required />
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-4">
                                <div class="flex bg-red-900 hover:bg-red-700 text-white px-8 py-2 rounded-lg">
                                    <img src="{{ asset('images/icons/upload.png') }}" class="w-[20px] h-[20px] mr-2" alt="">
                                    <button type="submit">Upload File</button>
                                </div>
                                <a href="{{ asset('documents/load_templates/Loads_Template.xlsx') }}" class="flex justify-center items-center bg-red-900 hover:bg-red-700 text-white px-12 py-2 rounded-lg gap-4">
                                    <img src="{{ asset('images/icons/download.svg') }}" class="w-[20px] h-[20px]" alt="">
                                    <span>Download Template</span>
                                </a>
                            </div>
                        </form>
                    </div>
                @endif

                <!-- Display Import Errors -->
                @if(isset($import_errors) && count($import_errors) > 0)
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Failed to Upload Subject/s to Instructor/s:</strong>
                        <ul class="mt-2 list-disc list-inside text-sm">
                            @foreach ($import_errors as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <hr class="opacity-100 my-4">

                @if($imported)
                    <!-- Total Items Count -->
                    <span class="text-gray-500 text-lg mb-2"> Total Loads: <strong>{{ $loads->count() }}</strong> </span>

                    <!-- Data Table -->
                    <div class="w-full flex flex-col border border-gray-200 gap-0 overflow-y-auto relative pb-16">
                        <!-- Table Header -->
                        <div class="w-full bg-gray-500 text-white grid grid-cols-[10%_20%_30%_20%_20%] p-2">
                            <h1>#</h1>
                            <h1>EMP ID</h1>
                            <h1>Full Name</h1>
                            <h1>Subject</h1>
                            <h1>Class Code</h1>
                        </div>

                        <!-- Display First 6 Rows -->
                        @foreach($loads->take(6) as $index => $load)
                            <div class="w-full bg-gray text-gray-500 grid grid-cols-[10%_20%_30%_20%_20%] p-2 border bt-gray-100">
                                <div class="flex items-center">
                                    <h1>{{ $index + 1 }}</h1>
                                </div>
                                <div class="flex items-center">
                                    <h1>{{ $load->emp_id }}</h1>
                                </div>
                                <div class="flex items-center">
                                    <h1>{{ $load->user->emp_lname . ', ' . $load->user->emp_fname . ' ' . $load->user->emp_mname }}</h1>
                                </div>
                                <div class="flex items-center">
                                    <h1>{{ $load->subject->subj_code }}</h1>
                                </div>
                                <div class="flex items-center">
                                    <h1>{{ $load->class_code }}</h1>
                                </div>
                            </div>
                        @endforeach

                        <!-- Extra Items (Initially Hidden) -->
                        @if($loads->count() > 6)
                            <div id="extra-items" class="hidden">
                                @foreach($loads->slice(6) as $index => $load)
                                    <div class="w-full bg-gray text-gray-500 grid grid-cols-[10%_20%_30%_20%_20%] p-2 border bt-gray-100">
                                        <div class="flex items-center">
                                            <h1>{{ $index + 1 }}</h1>
                                        </div>
                                        <div class="flex items-center">
                                            <h1>{{ $load->emp_id }}</h1>
                                        </div>
                                        <div class="flex items-center">
                                            <h1>{{ $load->user->emp_lname . ', ' . $load->user->emp_fname . ' ' . $load->user->emp_mname }}</h1>
                                        </div>
                                        <div class="flex items-center">
                                            <h1>{{ $load->subject->subj_code }}</h1>
                                        </div>
                                        <div class="flex items-center">
                                            <h1>{{ $load->class_code }}</h1>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Show All and Hide Buttons -->
                            <div id="toggleButtonsContainer" class="absolute bottom-2 right-2">
                                <button id="showAllButton" class="bg-gray-700 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded mr-2">
                                    Show All
                                </button>
                                <button id="hideButton" class="bg-gray-700 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded hidden">
                                    Hide
                                </button>
                            </div>
                        @endif
                    </div>

                    <!-- Confirmation and Submission Form -->
                    <div class="w-full grid grid-cols-[75%_25%] leading-tight mt-4">
                        <span class="text-[0.8rem] text-gray-400 text-justify">
                            Before confirming and adding the data to the system, please ensure that the uploaded Excel file is correct. Double-check the loaded data on the page to verify accuracy and completeness. Any errors in the data might affect the system's functionality or integrity. Make sure all information is correct before proceeding.
                        </span>

                        <form action="{{ route('admin.loads.import.save') }}" method="POST" class="flex justify-end">
                            @csrf

                            <button class="bg-green-600 hover:bg-green-700 text-white w-[90%] py-2">Confirm and Proceed</button>
                        </form>
                    </div>
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
    document.addEventListener('DOMContentLoaded', function () {
        const showAllButton = document.getElementById('showAllButton');
        const hideButton = document.getElementById('hideButton');
        const extraItems = document.getElementById('extra-items');

        if (showAllButton && hideButton && extraItems) {
            // Show All Button Click Event
            showAllButton.addEventListener('click', function () {
                extraItems.classList.remove('hidden'); // Show extra items
                showAllButton.classList.add('hidden');  // Hide Show All button
                hideButton.classList.remove('hidden');   // Show Hide button
            });

            // Hide Button Click Event
            hideButton.addEventListener('click', function () {
                extraItems.classList.add('hidden');      // Hide extra items
                showAllButton.classList.remove('hidden'); // Show Show All button
                hideButton.classList.add('hidden');       // Hide Hide button
            });
        }
    });
</script>