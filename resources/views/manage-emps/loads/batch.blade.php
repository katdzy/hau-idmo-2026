{{-- resources/views/manage-emps/loads/batch.blade.php --}}
<x-app-layout>
    <div class="min-h-screen">
        <div class="w-full flex justify-center py-8">
            <div class="w-[95%] flex flex-col bg-white rounded-lg p-8 shadow-lg">
                <!-- Header Section -->
                <div class="px-0 pb-4">
                    <a href="{{ route('admin.loads.db') }}" class="inline-flex gap-1 items-center justify-center bg-red-900 hover:bg-red-700 px-6 py-1 text-white rounded-xl mb-4">
                        <img src="{{ asset('images/icons/back.png') }}" class="w-[20px] h-[20px]" alt="Back">
                        <span>Return to Tools</span>
                    </a>
                </div>
                <div class="w-full grid grid-cols-[85%,15%]">
                    <div class="w-full flex flex-col">
                        <h1 class="text-[1.5rem] font-bold">Batch Load of Subjects</h1>
                        <span class="text-gray-500">Load multiple subjects/teaching loads to users</span>
                    </div>
                </div> 

                <!-- School Year & Semester Form -->
                <div class="w-full flex flex-col mt-8">
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
                    <h2 class="text-lg font-semibold text-red-900 mb-2">School Year & Semester</h2>
                    <form id="batch-issue-form" class="w-full" action="{{ route('admin.queue.upload') }}" method="POST">
                        @csrf
                        <!-- Hidden input to hold JSON-encoded queued user data -->
                        <input type="hidden" name="queued_users" id="queued-users-input" value="{{ old('queued_users') }}" />

                        <!-- School Year Form -->
                        <div class="w-full grid grid-cols-[25%_75%] border border-gray mb-4">
                            <div class="p-2 border-r border-gray flex items-center justify-center">
                                <h1 class="text-gray-500 font-semibold text-sm">SCHOOL YEAR</h1>
                            </div>
                            <div class="p-2 flex gap-2">
                                <input type="text" name="sy_start" placeholder="XXXX" value="{{ old('sy_start') }}" class="w-1/2 border border-gray-300 p-2 rounded-lg text-center" required />
                                <span class="text-gray-500 font-semibold">-</span>
                                <input type="text" name="sy_end" placeholder="XXXX" value="{{ old('sy_end') }}" class="w-1/2 border border-gray-300 p-2 rounded-lg text-center" required />
                            </div>
                        </div>

                        <!-- Semester Form -->
                        <div class="w-full grid grid-cols-[25%_75%] border border-gray mb-4">
                            <div class="p-2 border-r border-gray flex items-center justify-center">
                                <h1 class="text-gray-500 font-semibold text-sm">SEMESTER</h1>
                            </div>
                            <div class="p-2">
                                <select name="sem" class="w-full border border-gray-300 p-2 rounded-lg" required>
                                    <option value="" disabled {{ old('sem') ? '' : 'selected' }}>SELECT SEMESTER</option>
                                    @foreach($semesters as $item)
                                        <option value="{{ $item->item }}" {{ old('sem') == $item->item ? 'selected' : '' }}>
                                            {{ $item->item }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <hr class="w-full opacity-60 mb-4">

                        <!-- Add Users for Batch Loading -->
                        <h2 class="text-lg font-semibold text-red-900 mb-2">Add Users for Batch Loading Subjects</h2>

                        <!-- User Search -->
                        <div class="relative">
                            <input type="text" id="user-search" placeholder="Search user..." class="w-full border border-gray-300 p-2 rounded-lg focus:ring focus:ring-red-300 focus:border-red-500 transition duration-200" autocomplete="off" />
                            <div id="user-search-results" class="absolute w-full mt-2 bg-white border border-gray-300 rounded-lg shadow-lg z-10 hidden max-h-60 overflow-y-auto">
                                <div id="user-search-results-list" class="flex flex-col gap-1">
                                    <!-- Search results will be inserted here -->
                                </div>
                            </div>
                        </div>

                        <!-- Loaded Users Table -->
                        <h3 class="text-md font-semibold text-gray-700 mt-4">Loaded Users:</h3>
                        <table class="min-w-full border border-gray-300 mt-2">
                            <thead>
                                <tr class="bg-red-100">
                                    <th class="border border-gray-300 px-4 py-2 text-left text-gray-600">Employee ID</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left text-gray-600">Subject Code</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left text-gray-600">Class Code</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left text-gray-600">Class Dept</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left text-gray-600">Name</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left text-gray-600">Action</th>
                                </tr>
                            </thead>
                            <tbody id="queued-users">
                                @php
                                    $queuedUsersOld = old('queued_users') ? json_decode(old('queued_users'), true) : [];
                                @endphp
                                @if(count($queuedUsersOld) > 0)
                                    @foreach($queuedUsersOld as $queued)
                                        <tr class="border-t border-gray-300"
                                            data-last-name="{{ $queued['emp_lname'] ?? '' }}"
                                            data-first-name="{{ $queued['emp_fname'] ?? '' }}"
                                            data-middle-name="{{ $queued['emp_mname'] ?? '' }}">
                                            <td class="border border-gray-300 px-4 py-2">{{ $queued['emp_id'] }}</td>
                                            <td class="border border-gray-300 px-4 py-2">
                                                <div class="relative">
                                                    <input type="text" name="subject_code[]" placeholder="Enter subject code" value="{{ $queued['subject_code'] }}" class="subject-search-input border border-gray-300 p-1 rounded-lg w-full" required/>
                                                    <div class="subject-search-results hidden absolute top-full left-0 w-full bg-white border border-gray-300 rounded-lg shadow-lg max-h-60 overflow-y-auto"></div>
                                                </div>
                                            </td>
                                            <td class="border border-gray-300 px-4 py-2">
                                                <input type="text" name="class_code[]" placeholder="Enter class code" value="{{ $queued['class_code'] }}" class="border border-gray-300 p-1 rounded-lg w-full" required/>
                                            </td>
                                            <td class="border border-gray-300 px-4 py-2">
                                                <select name="class_dept[]" class="border border-gray-300 p-1 rounded-lg w-full" required>
                                                    <option value="" disabled>Select Class Department</option>
                                                    @foreach($depts as $department)
                                                        <option value="{{ $department->code }}" {{ (isset($queued['class_dept']) && $queued['class_dept'] == $department->code) ? 'selected' : '' }}>
                                                            {{ $department->dept }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="border border-gray-300 px-4 py-2">
                                                {{ $queued['emp_lname'] }}, {{ $queued['emp_fname'] }} {{ $queued['emp_mname'] }}
                                            </td>
                                            <td class="border border-gray-300 px-4 py-2">
                                                <button type="button" onclick="removeFromQueue(this)" class="text-red-600 hover:text-red-500 transition duration-200">Remove</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="border-t border-gray-300" id="no-users">
                                        <td colspan="6" class="px-4 py-2 text-gray-600 text-center">No user added</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                        <!-- Batch Upload Button -->
                        <div class="mt-4 flex justify-end">
                            <button type="submit" form="batch-issue-form" class="bg-red-900 hover:bg-red-800 text-white px-4 py-2 rounded-lg transition duration-200">Batch Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .circle { border-radius: 50%; }
    .maroon { background-color: maroon; transition: 300ms; }
    .maroon:hover { background-color: #A84655; }
    /* General search results styling */
    #search-results, #user-search-results, .subject-search-results {
        max-height: 240px;
        overflow-y: auto;
    }
    .search-result-item, .user-search-result-item {
        padding: 0.5rem 1rem;
        cursor: pointer;
    }
    .search-result-item:hover, .user-search-result-item:hover {
        background-color: #f0f0f0;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ----------------------------
        // Define department options (via Blade)
        const deptsOptions = `
            <option value="" disabled selected>Select Class Department</option>
            @foreach($depts as $department)
                <option value="{{ $department->code }}"
                    @if($admin_role === "Dean" && isset($admin_dept) && $admin_dept === $department->code)
                        selected
                    @endif
                >
                    {{ $department->dept }}
                </option>
            @endforeach
        `;

        // ----------------------------
        // USER SEARCH SETUP
        const userSearchInput = document.getElementById('user-search');
        const userSearchResults = document.getElementById('user-search-results');
        const userResultsList = document.getElementById('user-search-results-list');

        let userDebounceTimeout;
        function debounceUser(func, delay) {
            return function() {
                clearTimeout(userDebounceTimeout);
                userDebounceTimeout = setTimeout(func, delay);
            }
        }

        function fetchUsers(query) {
            if (!query) {
                userSearchResults.classList.add('hidden');
                userResultsList.innerHTML = '';
                return;
            }
            fetch(`{{ route('admin.pendings.search2') }}?query=${encodeURIComponent(query)}`, {
                method: 'GET',
                headers: { 'Accept': 'application/json' },
            })
            .then(response => response.json())
            .then(data => {
                userResultsList.innerHTML = '';
                if (data.length > 0) {
                    data.forEach(user => {
                        const row = document.createElement('div');
                        row.classList.add('user-search-result-item');
                        row.innerHTML = `
                            <div class="flex items-center justify-between p-2 rounded-md bg-gray-50 hover:bg-gray-100 cursor-pointer"
                                 onclick="addToQueue('${user.emp_id}', '${user.emp_lname}', '${user.emp_fname}', '${user.emp_mname}')">
                                <span class="text-sm font-medium text-gray-800">${user.emp_lname}, ${user.emp_fname} ${user.emp_mname}</span>
                                <button class="bg-red-900 hover:bg-red-800 text-white px-2 py-1 rounded-lg transition duration-200">Add</button>
                            </div>
                        `;
                        userResultsList.appendChild(row);
                    });
                    userSearchResults.classList.remove('hidden');
                } else {
                    userResultsList.innerHTML = '<div class="user-search-result-item text-gray-500">No results found.</div>';
                    userSearchResults.classList.remove('hidden');
                }
            })
            .catch(error => {
                console.error('Error fetching user data:', error);
                userSearchResults.classList.add('hidden');
            });
        }

        userSearchInput.addEventListener('input', debounceUser(function() {
            const query = userSearchInput.value.trim();
            fetchUsers(query);
        }, 300));

        document.addEventListener('click', function(event) {
            if (!userSearchResults.contains(event.target) && event.target !== userSearchInput) {
                userSearchResults.classList.add('hidden');
            }
        });

        // ----------------------------
        // Function to add a user to the queue.
        window.addToQueue = function(empId, lastName, firstName, middleName) {
            console.log("Adding to queue:", empId, lastName, firstName, middleName);
            const noUsersMessage = document.getElementById('no-users');
            if(noUsersMessage) {
                noUsersMessage.style.display = 'none';
            }

            const queuedUsersTable = document.getElementById('queued-users');
            const queuedUser = document.createElement('tr');
            queuedUser.classList.add('border-t', 'border-gray-300');
            // Store name details as data attributes
            queuedUser.dataset.lastName = lastName;
            queuedUser.dataset.firstName = firstName;
            queuedUser.dataset.middleName = middleName;
            queuedUser.innerHTML = `
                <td class="border border-gray-300 px-4 py-2">${empId}</td>
                <td class="border border-gray-300 px-4 py-2">
                    <div class="relative">
                        <input type="text" name="subject_code[]" placeholder="Enter subject code" class="subject-search-input border border-gray-300 p-1 rounded-lg w-full" required/>
                        <div class="subject-search-results hidden absolute top-full left-0 w-full bg-white border border-gray-300 rounded-lg shadow-lg max-h-60 overflow-y-auto"></div>
                    </div>
                </td>
                <td class="border border-gray-300 px-4 py-2">
                    <input type="text" name="class_code[]" placeholder="Enter class code" class="border border-gray-300 p-1 rounded-lg w-full" required/>
                </td>
                <td class="border border-gray-300 px-4 py-2">
                    <select name="class_dept[]" class="border border-gray-300 p-1 rounded-lg w-full" required>
                        ${deptsOptions}
                    </select>
                </td>
                <td class="border border-gray-300 px-4 py-2">${lastName}, ${firstName} ${middleName}</td>
                <td class="border border-gray-300 px-4 py-2">
                    <button type="button" onclick="removeFromQueue(this)" class="text-red-600 hover:text-red-500 transition duration-200">Remove</button>
                </td>
            `;
            queuedUsersTable.appendChild(queuedUser);

            // Clear user search fields
            userSearchInput.value = '';
            userResultsList.innerHTML = '';
            userSearchResults.classList.add('hidden');
        }

        window.removeFromQueue = function(button) {
            button.closest('tr').remove();
            const queuedUsers = document.getElementById('queued-users').rows;
            if (queuedUsers.length <= 1) {
                document.getElementById('no-users').style.display = '';
            }
        }

        // ----------------------------
        // Attach event listener for AJAX subject search (using delegation).
        document.addEventListener('input', function(e) {
            if (e.target && e.target.classList.contains('subject-search-input')) {
                const query = e.target.value.trim();
                const resultsContainer = e.target.parentElement.querySelector('.subject-search-results');
                if (query === "") {
                    resultsContainer.innerHTML = "";
                    resultsContainer.classList.add('hidden');
                    return;
                }
                if (e.target.dataset.debounceTimeout) {
                    clearTimeout(e.target.dataset.debounceTimeout);
                }
                const timeoutId = setTimeout(function() {
                    fetch(`{{ route('admin.subjects.search2') }}?query=${encodeURIComponent(query)}`, {
                        method: 'GET',
                        headers: { 'Accept': 'application/json' }
                    })
                    .then(response => response.json())
                    .then(data => {
                        resultsContainer.innerHTML = "";
                        if (data.length > 0) {
                            data.forEach(subject => {
                                const item = document.createElement('div');
                                item.classList.add('search-result-item');
                                item.innerHTML = `<strong>${subject.subj_code} - ${subject.subj_title}</strong><br><span>Units: ${subject.units}.00</span>`;
                                item.addEventListener('click', function() {
                                    e.target.value = subject.subj_code;
                                    resultsContainer.classList.add('hidden');
                                });
                                resultsContainer.appendChild(item);
                            });
                            resultsContainer.classList.remove('hidden');
                        } else {
                            resultsContainer.innerHTML = '<div class="search-result-item text-gray-500">No results found.</div>';
                            resultsContainer.classList.remove('hidden');
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching subjects:', error);
                        resultsContainer.classList.add('hidden');
                    });
                }, 300);
                e.target.dataset.debounceTimeout = timeoutId;
            }
        });

        // Hide subject search dropdown if clicking outside its relative container.
        document.addEventListener('click', function(event) {
            document.querySelectorAll('.subject-search-results').forEach(function(container) {
                const relativeContainer = container.parentElement;
                if (!relativeContainer.contains(event.target)) {
                    container.classList.add('hidden');
                }
            });
        });

        // Before form submission, serialize the queued rows into JSON.
        document.getElementById('batch-issue-form').addEventListener('submit', function (event) {
            const queuedList = document.getElementById('queued-users');
            const userRows = Array.from(queuedList.querySelectorAll('tr')).filter(row => row.id !== 'no-users');
            if (userRows.length === 0) {
                alert("Please add at least one user to the queue before submitting.");
                event.preventDefault();
                return;
            }
            const userData = userRows.map(row => {
                const empId = row.cells[0].innerText.trim();
                const subjectCode = row.cells[1].querySelector('input').value.trim();
                const classCode = row.cells[2].querySelector('input').value.trim();
                const classDept = row.cells[3].querySelector('select').value.trim();
                const lastName = row.dataset.lastName || '';
                const firstName = row.dataset.firstName || '';
                const middleName = row.dataset.middleName || '';
                return { 
                    emp_id: empId, 
                    subject_code: subjectCode, 
                    class_code: classCode, 
                    class_dept: classDept,
                    emp_lname: lastName,
                    emp_fname: firstName,
                    emp_mname: middleName
                };
            });
            document.getElementById('queued-users-input').value = JSON.stringify(userData);
        });
    });
</script>
