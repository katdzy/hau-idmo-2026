<x-app-layout>
    <div class="min-h-screen">
        <div class="w-full flex justify-center py-8">
            <div class="w-[95%] flex flex-col px-6 py-6 p-8 bg-white rounded-lg">

                <!-- Header Section -->
                <div class="w-full flex flex-col gap-4">
                    <a href="{{ $origin === 'all' ? route('admin.users') : route('admin.records') }}" 
                    class="w-[25%] rounded-lg flex items-center justify-center py-2 bg-red-900 text-white font-bold gap-1 hover:bg-red-700">
                        <img src="{{ asset('images/icons/back.png') }}" class="w-[20px] h-[20px]" alt="">
                        <h1>Back</h1>
                    </a>

                    <h1 class="text-[1.7rem] font-bold text-gray-700">Add Multiple Users</h1>
                </div>
            
                <!-- Upload Section -->
                <span class="text-xl text-gray-500 mt-4">Upload Users File</span>
                <span class="text-[0.8rem] text-gray-400">Ensure the uploaded file follows the official template for CSV updates. This is crucial for accurate data processing.</span>

                @if(!isset($excel_data))
                    <div class="w-full flex flex-col items-start gap-4 my-4">
                        <form action="{{ route('admin.users.addMultiple.load') }}" method="POST" class="flex flex-col items-start gap-4" enctype="multipart/form-data"> 
                            @csrf
                            @method('POST')

                            <!-- Hidden Origin Input -->
                            <input type="hidden" name="origin" value="{{ $origin }}">

                            <!-- File Input -->
                            <div class="flex items-center gap-2">
                                <input class="my-2" type="file" name="file" accept=".xlsx" required/>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-4">
                                <div class="flex bg-red-900 hover:bg-red-700 text-white px-8 py-2 rounded-lg">
                                    <img src="{{ asset('images/icons/upload.png') }}" class="w-[20px] h-[20px] mr-2" alt="">
                                    <button type="submit">Upload File</button>
                                </div>
                                <a href="{{ asset('documents/user_templates/User_Data_Template.xlsx') }}" 
                                class="flex justify-center items-center bg-red-900 hover:bg-red-700 text-white px-12 py-2 rounded-lg gap-4">
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
                    <!-- Total Users Count -->
                    <span class="text-gray-500 text-lg mb-2">
                        Total Users: <strong>{{ $excel_data->count() }}</strong>
                    </span>

                    <!-- Users Table -->
                    <div class="w-full flex flex-col border border-gray-200 gap-0 overflow-y-auto relative pb-16">
                        <!-- Table Header -->
                        <div class="w-full bg-gray-500 text-white grid grid-cols-[16%_16%_16%_20%_16%_16%] p-2">
                            <h1>Emp ID</h1>
                            <h1>First Name</h1>
                            <h1>Last Name</h1>
                            <h1>Email</h1>
                            <h1>Department</h1>
                            <h1>Gender</h1>
                        </div>

                        <!-- Display First 6 Users -->
                        @foreach($excel_data->take(6) as $index => $item) 
                            <div class="w-full bg-gray text-gray-500 grid grid-cols-[16%_16%_16%_20%_16%_16%] p-2 border bt-gray-100">
                                <div class="flex items-center">
                                    <h1>{{ $item->emp_id }}</h1>
                                </div>
                                <div class="flex items-center">
                                    <h1>{{ $item->emp_fname }}</h1>
                                </div>
                                <div class="flex items-center">
                                    <h1>{{ $item->emp_lname }}</h1>
                                </div>
                                <div class="flex items-center">
                                    <h1>{{ $item->email }}</h1>
                                </div>
                                <div class="flex items-center">
                                    <h1>{{ $item->emp_dept }}</h1>
                                </div>
                                <div class="flex items-center">
                                    <h1>{{ $item->emp_gender }}</h1>
                                </div>
                            </div>
                        @endforeach

                        <!-- Extra Items (Initially Hidden) -->
                        @if($excel_data->count() > 6)
                            <div id="extra-items" class="hidden">
                                @foreach($excel_data->slice(6) as $item)
                                    <div class="w-full bg-gray text-gray-500 grid grid-cols-[16%_16%_16%_20%_16%_16%] p-2 border bt-gray-100">
                                        <div class="flex items-center">
                                            <h1>{{ $item->emp_id }}</h1>
                                        </div>
                                        <div class="flex items-center">
                                            <h1>{{ $item->emp_fname }}</h1>
                                        </div>
                                        <div class="flex items-center">
                                            <h1>{{ $item->emp_lname }}</h1>
                                        </div>
                                        <div class="flex items-center">
                                            <h1>{{ $item->email }}</h1>
                                        </div>
                                        <div class="flex items-center">
                                            <h1>{{ $item->emp_dept }}</h1>
                                        </div>
                                        <div class="flex items-center">
                                            <h1>{{ $item->emp_gender }}</h1>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Show All / Hide Buttons -->
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
                            Before confirming and adding the data to the system, please ensure that the uploaded Excel file is correct. 
                            Double-check the loaded data on the page to verify accuracy and completeness. Any errors in the data might 
                            affect the system's functionality or integrity. Make sure all information is correct before proceeding.
                        </span>

                        <!-- 
                            The key changes begin below: We add IDs and hide the form upon submission, 
                            show a fake progress bar, and handle redirection once done.
                        -->
                        <form id="save-multiple-form" action="{{ route('admin.users.addMultiple.save') }}" 
                            method="POST" class="flex justify-end w-full">
                            @csrf
                            @method('POST')

                            <!-- Hidden Origin Input -->
                            <input type="hidden" name="origin" value="{{ $origin }}">

                            <button id="addUsersBtn" type="submit"
                                    class="bg-red-900 hover:bg-red-700 text-white w-[90%] py-2">
                                ADD USERS
                            </button>
                        </form>
                    </div>
                @endif

                <!-- Success or Message Display -->
                @if(isset($msg)) 
                    <span class="font-bold italic text-red-700">{{ $msg }}</span>
                @endif                                                                        
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Progress Bar Overlay (hidden by default) -->
<div id="progressModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
    <div class="bg-white p-6 rounded-lg w-1/3 flex flex-col items-center">
        <h2 class="text-xl font-bold mb-4">Adding Users...</h2>
        <div class="w-full bg-gray-200 rounded-full h-4 mb-4">
            <div id="progressBar" class="bg-green-500 h-4 rounded-full" style="width: 0%;"></div>
        </div>
        <span id="progressText" class="text-gray-700 font-semibold">0%</span>
    </div>
</div>

<style>
    a, button { 
        transition: 300ms;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Toggle Show/Hide "Extra Items" in the table
        const showAllButton = document.getElementById('showAllButton');
        const hideButton = document.getElementById('hideButton');
        const extraItems = document.getElementById('extra-items');

        if (showAllButton && hideButton && extraItems) {
            // Show All Button Click Event
            showAllButton.addEventListener('click', function () {
                extraItems.classList.remove('hidden');   // Show extra items
                showAllButton.classList.add('hidden');   // Hide Show All button
                hideButton.classList.remove('hidden');   // Show Hide button
            });

            // Hide Button Click Event
            hideButton.addEventListener('click', function () {
                extraItems.classList.add('hidden');      // Hide extra items
                showAllButton.classList.remove('hidden');// Show Show All button
                hideButton.classList.add('hidden');      // Hide Hide button
            });
        }

        // Handle the form submission to show a progress bar
        const saveForm      = document.getElementById('save-multiple-form');
        const addUsersBtn   = document.getElementById('addUsersBtn');
        const progressModal = document.getElementById('progressModal');
        const progressBar   = document.getElementById('progressBar');
        const progressText  = document.getElementById('progressText');

        if (saveForm) {
            // Intercept the form submission
            saveForm.addEventListener('submit', function (e) {
                e.preventDefault();  // Stop normal form submission
                
                // Hide all main content (the outer container) or disable form
                document.querySelector('.w-full.flex.justify-center.py-8').style.display = 'none';

                // Show the progress modal
                progressModal.classList.remove('hidden');

                // We will do an AJAX (Fetch) POST submission
                const formData = new FormData(saveForm);
                const url      = saveForm.getAttribute('action');

                // Function to animate the progress bar from 0 to 100
                // in small increments. The speed can be adjusted as desired.
                let progress = 0;
                const fakeProgress = setInterval(() => {
                    if (progress < 90) {
                        // Slowly increment until 90%, then wait for the server response
                        progress++;
                        progressBar.style.width = progress + '%';
                        progressText.textContent = progress + '%';
                    } 
                    else {
                        // Stop increasing artificially and wait for server response
                        clearInterval(fakeProgress);
                    }
                }, 500);

                // Now actually send the data to the server
                fetch(url, {
                    method: 'POST',
                    body: formData,
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not OK');
                    }
                    // If the server response is 2xx, assume success
                    return response.text();
                })
                .then(data => {
                    // Once server completes, fill progress bar to 100
                    clearInterval(fakeProgress);
                    progressBar.style.width = '100%';
                    progressText.textContent = '100%';

                    // Give a short pause for user to see 100% progress,
                    // then redirect to "all.blade.php" (which is admin.users)
                    setTimeout(() => {
                        window.location.href = "{{ route('admin.users') }}";
                    }, 600);
                })
                .catch(error => {
                    clearInterval(fakeProgress);
                    progressBar.style.width = '100%';
                    progressText.textContent = 'Error';
                    console.error('Error:', error);

                    // Optionally show an alert or error message
                    setTimeout(() => {
                        alert('An error occurred while adding users. Check console for details.');
                        // Reload or do something else
                        window.location.reload();
                    }, 1500);
                });
            });
        }
    });
</script>
