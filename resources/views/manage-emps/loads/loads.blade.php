@php
    $count = 1; 
@endphp

<x-app-layout>
    <div class="min-h-screen">
        <div class="w-full flex justify-center py-8">
            <div class="rounded-lg w-[95%] bg-white flex flex-col items-start py-4 shadow-md">
        
                <!-- Flash Messages -->
                @if(session('msg') || isset($msg))
                    @php
                        $message = session('msg') ?? $msg;
                        $isSuccess = false;
                        if(strpos($message, 'successfully') !== false || strpos($message, 'successful') !== false || strpos($message, 'removed') !== false || strpos($message, 'added') !== false) {
                            $isSuccess = true;
                        }
                    @endphp
                    <div class="w-full mb-4 p-4 rounded flash-message {{ $isSuccess ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                        {{ $message }}
                    </div>
                @endif
                <div class="px-8">
                    <a href="{{ route('admin.loads.db') }}" class="flex gap-1 items-center justify-center bg-red-900 hover:bg-red-700 px-6 py-1 text-white rounded-xl mb-4">
                        <img src="{{ asset('images/icons/back.png') }}" class="w-[20px] h-[20px]" alt="Back">
                        <span>Return to Tools</span>
                    </a>
                </div>

                <!-- User Selection Section -->
                <section class="w-full flex items-center justify-center py-4">
                    <form action="{{ route('admin.loads.user') }}" method="GET" class="flex flex-col px-8 w-full relative space-y-4">
                        @csrf
                        @method('GET')
                        <h1 class="text-2xl font-bold">Add New Load</h1>
                        <span class="text-base">
                            First, load the user details, then select the subject you want to add. Once both are loaded, submit the form to complete the process.
                        </span>
                        
                        <div class="w-full flex items-center gap-4">
                            <span class="bg-red-900 text-white w-10 h-10 font-bold text-xl rounded-full flex items-center justify-center">1</span> 
                            <h1 class="font-extrabold text-2xl text-gray-600">SELECT A USER</h1>
                        </div>

                        <div class="w-full mb-2 flex relative">
                            <!-- User Search Input -->
                            <input 
                                class="w-1/2 pr-4 border-gray-300 py-2 text-base placeholder-gray-400 placeholder-italic" 
                                id="user-search" 
                                type="text" 
                                name="id" 
                                placeholder="Enter Employee ID..." 
                                autocomplete="off"
                            >
                            <button 
                                type="submit" 
                                class="bg-red-800 text-white px-4 py-2 rounded ml-4 transition-colors duration-300 hover:bg-red-700"
                            >
                                Load User
                            </button>
                            <div class="absolute w-1/2 bg-white mt-11 z-10 shadow-lg search-results-users">
                                <!-- User Search results will appear here -->
                            </div>
                        </div>
                        <!-- Removed existing inline messages -->
                    </form> 
                </section>

                @if(!isset($userinfo)) 
                    <div class="w-full h-52"></div>
                @endif

                @if(isset($userinfo)) 
                    <!-- User Information Section -->
                    <section class="userinfo w-full px-8 flex flex-col space-y-2">
                        <h1 class="text-base font-semibold">{{ $userinfo->emp_id }}</h1>
                        <h1 class="name text-xl font-bold">{{ $userinfo->emp_lname . ', ' . $userinfo->emp_fname . ' ' . $userinfo->emp_mname }}</h1>
                        <span class="text-gray-500">{{ $userinfo->email_address_1 }}</span> 

                        <hr class="my-4"> 

                        <h3 class="font-semibold text-lg">Number of Teaching Loads: {{ $loads->count() }}</h3> 
                    </section>

                    <!-- Updated Teaching Loads Table with Remove Option -->
                    <div class="tbl-header uppercase bg-red-800 text-white text-sm font-medium grid grid-cols-4 md:grid-cols-8 w-full h-10 mt-4">
                        <div class="tbl-col flex items-center justify-start px-2"><h1>SUBJ_CODE</h1></div>
                        <div class="tbl-col flex items-center justify-start px-2"><h1>SUBJ_TITLE</h1></div>
                        <div class="tbl-col flex items-center justify-start px-2"><h1>UNITS</h1></div>
                        <div class="tbl-col flex items-center justify-start px-2"><h1>SCHOOL YEAR</h1></div>
                        <div class="tbl-col flex items-center justify-start px-2"><h1>SEMESTER</h1></div>
                        <div class="tbl-col flex items-center justify-start px-2"><h1>CLASS CODE</h1></div>
                        <div class="tbl-col flex items-center justify-start px-2"><h1>CLASS DEPT</h1></div>
                        <div class="tbl-col flex items-center justify-start px-2"><h1></h1></div>
                    </div>
                    <section class="table-section w-full max-h-60 overflow-y-auto">
                        <div class="table w-full border border-gray-200">
                            @if($loads->count() == 0) 
                                <div class="tbl-row empty flex justify-center items-center h-20 text-gray-400"> 
                                    <h1>No teaching loads.</h1>
                                </div>
                            @else
                                @foreach($loads as $item) 
                                    <div class='tbl-row grid grid-cols-4 md:grid-cols-8 p-4 hover:bg-yellow-100 transition-colors {{ $count % 2 == 0 ? "bg-gray-100" : "" }}'> 
                                        <div class='tbl-col flex items-center justify-start px-2'><h1 class="text-gray-600 text-sm">{{ $item->subject->subj_code }}</h1></div> 
                                        <div class='tbl-col flex items-center justify-start px-2'><h1 class="text-gray-600 text-sm">{{ $item->subject->subj_title }}</h1></div> 
                                        <div class='tbl-col flex items-center justify-start px-2'><h1 class="text-gray-600 text-sm">{{ $item->subject->units }}.00</h1></div> 
                                        <div class='tbl-col flex items-center justify-start px-2'><h1 class="text-gray-600 text-sm">{{ $item->sy }}</h1></div>
                                        <div class='tbl-col flex items-center justify-start px-2'><h1 class="text-gray-600 text-sm">{{ $item->semester }}</h1></div>
                                        <div class='tbl-col flex items-center justify-start px-2'><h1 class="text-gray-600 text-sm">{{ $item->class_code }}</h1></div>
                                        <div class='tbl-col flex items-center justify-start px-2'><h1 class="text-gray-600 text-sm">{{ $item->class_dept }}</h1></div>
                                        <div class='tbl-col flex items-center justify-start px-2'>
                                            <form action="{{ route('admin.loads.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="emp_id" value="{{ $userinfo->emp_id }}">
                                                <button 
                                                    type="button" 
                                                    onclick="deleteDependency(this)" 
                                                    class="w-8 h-8 bg-red-800 text-white rounded-full flex items-center justify-center hover:bg-red-700 transition duration-300"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div> 
                                    @php $count++; @endphp 
                                @endforeach
                            @endif
                        </div>
                    </section>

                    <!-- Subject Selection Section -->
                    <section class="add-subject-section mt-8 w-full px-4">

                        <div class="w-full flex items-center gap-4 ml-4 mb-4">
                            <span class="bg-red-900 text-white w-10 h-10 font-bold text-xl rounded-full flex items-center justify-center">2</span> 
                            <h1 class="font-extrabold text-2xl text-gray-600">SELECT A SUBJECT</h1>
                            <a 
                                class="bg-red-800 ml-4 text-white px-8 py-2 rounded-lg transition-colors duration-300 hover:bg-red-700" 
                                href="{{ route('admin.subjects') }}" 
                                onclick="window.open(this.href, 'newwindow', 'width='+screen.width+',height='+screen.height+',top=0,left=0'); return false;"
                            >
                                View All Subjects
                            </a>
                        </div>
                        
                        <div class="w-full flex flex-col leading-tight space-y-4">

                            <div class="w-full flex flex-col leading-normal space-y-4">
                                <div class="w-full flex items-center">
                                    <!-- Optional: Add any header or information here -->
                                </div>

                                <!-- Subject Search Section -->
                                <div class='w-full'>
                                    <form action="{{ route('admin.loads.subj') }}" method="GET" class='w-full ml-4 flex relative space-x-2'> 
                                        @csrf
                                        <!-- Subject Search Input -->
                                        <input 
                                            class="w-1/2 pr-4 border-gray-300 py-2 text-base placeholder-gray-400 placeholder-italic" 
                                            id="subject-search" 
                                            type="text" 
                                            name="id" 
                                            placeholder="Enter Subject Code" 
                                            autocomplete="off"
                                        >
                                        <input type="hidden" name="emp_id" value="{{ $userinfo->emp_id }}"> 
                                        <button 
                                            class="bg-red-800 text-white px-4 py-2 rounded transition-colors duration-300 hover:bg-red-700" 
                                            type="submit"
                                        >
                                            Load Subject
                                        </button>
                                        <div class="absolute w-1/2 bg-white mt-11 z-10 shadow-lg search-results-subjects">
                                            <!-- Subject Search results will appear here -->
                                        </div>
                                    </form>
                                </div>
                                    
                                <!-- Display Validation Errors -->

                                @if($errors->any())
                                    <div class="text-red-500 text-sm mt-2">
                                        <ul class="list-disc list-inside">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if(isset($subj))
                                    <!-- Subject Details Section -->
                                    <div class="mt-4 w-full flex flex-col space-y-2">
                                        <div class="w-full grid grid-cols-[25%_75%] border border-gray-300">
                                            <div class="p-2 border-r border-gray-300 flex items-center justify-center">
                                                <h1 class="text-gray-500 font-semibold">SUBJECT CODE</h1> 
                                            </div>
                                            <div class="p-2"><h1 class="text-gray-500">{{ $subj->subj_code }}</h1></div>
                                        </div>

                                        <div class="w-full grid grid-cols-[25%_75%] border border-gray-300">
                                            <div class="p-2 border-r border-gray-300 flex items-center justify-center">
                                                <h1 class="text-gray-500 font-semibold">SUBJECT</h1> 
                                            </div>
                                            <div class="p-2"><h1 class="text-gray-500">{{ $subj->subj_title }}</h1></div>
                                        </div>

                                        <div class="w-full grid grid-cols-[25%_75%] border border-gray-300">
                                            <div class="p-2 border-r border-gray-300 flex items-center justify-center">
                                                <h1 class="text-gray-500 font-semibold">DESCRIPTION</h1> 
                                            </div>
                                            <div class="p-2"><h1 class="text-gray-500">{{ $subj->subj_description }}</h1></div>
                                        </div>

                                        <div class="w-full grid grid-cols-[25%_75%] border border-gray-300">
                                            <div class="p-2 border-r border-gray-300 flex items-center justify-center">
                                                <h1 class="text-gray-500 font-semibold">UNITS</h1> 
                                            </div>
                                            <div class="p-2"><h1 class="text-gray-500">{{ $subj->units }}.00</h1></div>
                                        </div>
                                    </div>

                                    <!-- Add to User Form -->
                                    <form class="w-full mt-6" action="{{ route('admin.loads.store') }}" method="POST">
                                        @csrf 
                                        @method('POST')
                                        <input type="hidden" name="subj_id" value="{{ $subj->subj_id }}">
                                        <input type="hidden" name="id" value="{{ $userinfo->emp_id }}">

                                        <!-- School Year & Semester Section -->
                                        <div class="mt-4 w-full flex flex-col space-y-4">
                                            <h2 class="text-lg font-semibold text-red-900">Details</h2>
                                            <div class="w-full grid grid-cols-[25%_75%] border border-gray-300">
                                                <div class="p-2 border-r border-gray-300 flex items-center justify-center">
                                                    <h1 class="text-gray-500 font-semibold">SCHOOL YEAR</h1>
                                                </div>
                                                <div class="p-2 flex items-center gap-2">
                                                    <input 
                                                        type="text" 
                                                        name="sy_start" 
                                                        value="{{ old('sy_start') }}" 
                                                        placeholder="XXXX" 
                                                        class="w-1/2 p-2 rounded-lg text-center border border-gray-300" 
                                                        required 
                                                    />
                                                    <span class="text-gray-500 font-semibold">-</span>
                                                    <input 
                                                        type="text" 
                                                        name="sy_end" 
                                                        value="{{ old('sy_end') }}" 
                                                        placeholder="XXXX" 
                                                        class="w-1/2 p-2 rounded-lg text-center border border-gray-300" 
                                                        required 
                                                    />
                                                </div>
                                            </div>
                                            <div class="w-full grid grid-cols-[25%_75%] border border-gray-300">
                                                <div class="p-2 border-r border-gray-300 flex items-center justify-center">
                                                    <h1 class="text-gray-500 font-semibold">SEMESTER</h1>
                                                </div>
                                                <div class="p-2">
                                                    <select 
                                                        name="sem" 
                                                        class="w-full p-2 rounded-lg border border-gray-300" 
                                                        required
                                                    >
                                                        <option value="" disabled selected>Select Semester</option>
                                                        @foreach($semesters as $item)
                                                            <option value="{{ $item->item }}" @if(old('sem') == $item->item) selected @endif>{{ $item->item }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="w-full grid grid-cols-[25%_75%] border border-gray-300">
                                                <div class="p-2 border-r border-gray-300 flex items-center justify-center">
                                                    <h1 class="text-gray-500 font-semibold">CLASS CODE</h1>
                                                </div>
                                                <div class="p-2">
                                                    <input 
                                                        type="text" 
                                                        name="class_code" 
                                                        value="{{ old('class_code') }}" 
                                                        placeholder="Enter Class Code" 
                                                        class="w-full p-2 rounded-lg border border-gray-300" 
                                                        required 
                                                    />
                                                </div>
                                            </div>
                                            <div class="w-full grid grid-cols-[25%_75%] border border-gray-300">
                                                <div class="p-2 border-r border-gray-300 flex items-center justify-center">
                                                    <h1 class="text-gray-500 font-semibold">CLASS DEPARTMENT</h1>
                                                </div>
                                                <div class="p-2">
                                                    <select 
                                                        name="class_dept" 
                                                        class="w-full p-2 rounded-lg border border-gray-300" 
                                                        required
                                                    >
                                                        <option value="" disabled selected>Select Class Department</option>
                                                        @foreach($depts as $department)
                                                            <option value="{{ $department->code}}" @if($admin_role == "Dean" && $admin_dept == $department->code) selected @endif>{{$department->dept}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Add to User Button -->
                                        <div class="w-full mt-4 flex justify-end">
                                            <button 
                                                type="submit" 
                                                class="bg-red-800 text-white px-12 py-2 rounded-lg flex items-center justify-center transition-colors duration-300 hover:bg-red-700"
                                            > 
                                                <img class="w-5 h-5 mr-4" src="{{ asset('images/icons/add.png') }}" alt="Add Icon">
                                                <span>ADD TO USER</span> 
                                            </button>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </section>

                @endif

            </div>
        </div>
    </div>
</x-app-layout>

<!-- Tailwind CSS does not require a separate <style> block, so it's been removed -->

<!-- JavaScript remains unchanged -->
    <script>
    setTimeout(function() {
        const msgElement = document.querySelector('.flash-message');
        if(msgElement) {
            msgElement.remove();
        }
    }, 5000); // Hide after 5 seconds

    // Confirmation functions (if needed)
    function confirmClearDependencies() {
        if (confirm('Are you sure you want to clear the dependencies?')) {
            document.getElementById('clear-dependencies-form').submit();
        }
    }

    function deleteDependency(button)  {
        const form = button.closest('form');
        if(confirm('Are you sure you want to remove this teaching load?')) { 
           form.submit()
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        /* User Search Functionality */
        const userSearchInput = document.getElementById('user-search');
        const userSearchResults = document.querySelector('.search-results-users');
        let userDebounceTimeout;

        function userDebounce(func, delay) {
            return function() {
                clearTimeout(userDebounceTimeout);
                userDebounceTimeout = setTimeout(func, delay);
            };
        }

        function userPerformSearch() {
            const query = userSearchInput.value.trim();

            if (query === '') {
                userSearchResults.innerHTML = ''; // Clear results if the input is empty
                return;
            }

            fetch(`{{ route('admin.pendings.search2') }}?query=${encodeURIComponent(query)}`, {
                method: 'GET',
            })
            .then(response => response.json())
            .then(data => {
                userSearchResults.innerHTML = ''; // Clear previous results

                if (data.length > 0) {
                    data.forEach(post => {
                        const resultItem = document.createElement('div');
                        // Updated hover classes to match subj.blade.php
                        resultItem.classList.add('p-2', 'cursor-pointer', 'hover:bg-gray-200');
                        resultItem.innerHTML = `
                            <div>
                                <strong>${post.emp_lname}, ${post.emp_fname} ${post.emp_mname}</strong>
                                <br>
                                <span>ID: ${post.emp_id}</span>
                                <br>
                                <span>Email: ${post.email_address_1}</span>
                            </div>
                        `;
                        userSearchResults.appendChild(resultItem);

                        // Add click event to select the user
                        resultItem.addEventListener('click', () => {
                            userSearchInput.value = post.emp_id; // Set the input value to the employee ID
                            userSearchResults.innerHTML = '';
                            
                            // Optionally, submit the form automatically
                            // document.querySelector('.search-header form').submit();
                        });
                    });
                } else {
                    // Updated hover classes for consistency
                    userSearchResults.innerHTML = '<div class="p-2 text-gray-500">No results found.</div>';
                }
            })
            .catch(error => {
                console.error('Error fetching user data:', error);
            });
        }

        userSearchInput.addEventListener('keyup', userDebounce(userPerformSearch, 300)); // Adjust the delay as needed

        /* Subject Search Functionality */
        const subjectSearchInput = document.getElementById('subject-search');
        const subjectSearchResults = document.querySelector('.search-results-subjects');
        let subjectDebounceTimeout;

        function subjectDebounce(func, delay) {
            return function() {
                clearTimeout(subjectDebounceTimeout);
                subjectDebounceTimeout = setTimeout(func, delay);
            };
        }

        function subjectPerformSearch() {
            const query = subjectSearchInput.value.trim();

            if (query === '') {
                subjectSearchResults.innerHTML = ''; // Clear results if the input is empty
                return;
            }

            fetch(`{{ route('admin.subjects.search2') }}?query=${encodeURIComponent(query)}`, {
                method: 'GET',
            })
            .then(response => response.json())
            .then(data => {
                subjectSearchResults.innerHTML = ''; // Clear previous results

                if (data.length > 0) {
                    data.forEach(post => {
                        const resultItem = document.createElement('div');
                        // Updated hover classes to match subj.blade.php
                        resultItem.classList.add('p-2', 'cursor-pointer', 'hover:bg-gray-200');
                        resultItem.innerHTML = `
                            <div>
                                <strong>${post.subj_code} - ${post.subj_title}</strong>
                                <br>
                                <span>Description: ${post.subj_description}</span>
                            </div>
                        `;
                        subjectSearchResults.appendChild(resultItem);

                        // Add click event to select the subject
                        resultItem.addEventListener('click', () => {
                            subjectSearchInput.value = post.subj_code; // Set the input value to the subject code
                            subjectSearchResults.innerHTML = '';
                            
                            // Optionally, submit the form automatically
                            // document.querySelector('.add-subject-section form').submit();
                        });
                    });
                } else {
                    // Updated hover classes for consistency
                    subjectSearchResults.innerHTML = '<div class="p-2 text-gray-500">No results found.</div>';
                }
            })
            .catch(error => {
                console.error('Error fetching subject data:', error);
            });
        }

        subjectSearchInput.addEventListener('keyup', subjectDebounce(subjectPerformSearch, 300)); // Adjust the delay as needed
    });
</script>
