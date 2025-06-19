<!-- resources/views/admin/loads/search.blade.php -->
@php
    $count = 1; 
@endphp

<x-app-layout>
    <div class="min-h-screen">
        <div class="w-full flex justify-center py-8">
            <div class="w-[95%] flex flex-col rounded-xl p-8 bg-white">
                <!-- Success Message -->
                @if (session('success'))
                    <div class="bg-green-500 text-white p-4 rounded-md mb-4">
                        <p class="text-sm font-medium">{{ session('success') }}</p>
                    </div>
                @endif
                <!-- Display flash message from session -->
                @if(session('msg'))
                    <div class="w-full flex items-center justify-between bg-green-600 text-white rounded-lg px-4 py-2 shadow-md my-2">
                        <div class="flex items-center space-x-2">
                            <h1 class="font-bold text-lg">{{ session('msg') }}</h1>
                        </div>
                        <button onclick="this.parentElement.remove();" class="text-white hover:text-gray-200 transition duration-200">
                            &times; <!-- Close button -->
                        </button>
                    </div>
                @endif
                <div class="px-0 pb-4">
                    <a href="{{ route('admin.loads.db') }}" class="inline-flex gap-1 items-center justify-center bg-red-900 hover:bg-red-700 px-6 py-1 text-white rounded-xl mb-4">
                        <img src="{{ asset('images/icons/back.png') }}" class="w-[20px] h-[20px]" alt="Back">
                        <span>Return to Tools</span>
                    </a>
                </div>
                <section class='search-header'>
                    <form action="{{ route('admin.loads.user.search') }}" method="GET" class="flex flex-col items-center">
                        @csrf
                        @method('GET')
                        <h1 class="text-2xl font-bold text-red-900">View User's Load</h1>
                        <span class="text-gray-600 text-sm mt-2 text-center">
                            Kindly provide relevant keywords such as names to assist in locating the user. Accurate keywords will help streamline the search process.
                        </span>
                        <div class="formrow mt-4 flex space-x-2">
                            <input id="search" type="text" name="id" placeholder="Enter Employee ID..." class="border border-gray-300 rounded-lg px-4 py-2">
                            <!-- Search Results -->
                            <div id="search-results" class="absolute w-1/8 bg-white mt-11 z-10 shadow-lg border border-gray-300 rounded-lg hidden"> </div>
                            <button type="submit" class="bg-red-900 text-white rounded-lg px-4 py-2 hover:bg-red-800">Load User</button>
                        </div>

                        @if(isset($errormsg))
                            <span class="mt-1 text-red-500">{{ $errormsg }}</span>
                        @endif
                    </form> 
                </section>

                @if(!isset($userinfo)) 
                    <hr class="my-4 border-gray-300"> 
                    <div class="w-full flex flex-col">
                        <h1 class="text-xl font-bold text-red-900">Your Recent Activity</h1>
                        <span class="text-gray-400 text-sm italic">Track the most recent loads you've shared with others</span>

                        <div class="flex flex-col w-full border border-gray-400 mt-2 rounded-lg overflow-hidden">
                            <div class="w-full bg-gray-500 grid grid-cols-[10%_30%_40%_20%] text-white p-2">
                                <h1>ID</h1>
                                <h1>FULL NAME</h1>
                                <h1>SUBJECT</h1>
                                <h1>DATE</h1>
                            </div>

                            @if($loads->count() == 0)
                                <div class="w-full flex items-center justify-center text-sm text-gray-400 pt-4 pb-12">
                                    <span class="italic py-8">No user data.</span> 
                                </div>
                            @else
                                @foreach($loads as $load) 
                                    <div class="w-full grid grid-cols-[10%_30%_40%_20%] text-gray-600 p-2 border-b border-gray-200">
                                        <h1>{{ $load->emp_id }}</h1>
                                        <h1>{{ $load->user->emp_lname . ', ' . $load->user->emp_fname . ' ' . $load->user->emp_mname }}</h1>
                                        <h1>{{ $load->subject->subj_code . ' - ' . $load->subject->subj_title }}</h1>
                                        <h1>{{ $load->created_at }}</h1>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endif

                @if(isset($msg))
                    <div class="w-full flex items-center justify-between bg-green-600 text-white rounded-lg px-4 py-2 shadow-md my-2">
                        <div class="flex items-center space-x-2">
                            <svg class="w-6 h-6 text-green-300" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 0a10 10 0 1 1 0 20 10 10 0 0 1 0-20zm1 15.293l5-5-1.414-1.414L11 12.586l-2.586-2.586L7 10l4 4 1 1.293z" />
                            </svg>
                            <h1 class="font-bold text-lg">{{ $msg }}</h1>
                        </div>
                        <button onclick="this.parentElement.remove();" class="text-white hover:text-gray-200 transition duration-200">
                            &times; <!-- Close button -->
                        </button>
                    </div>
                @endif

                @if(isset($userinfo)) 
                    <section class="userinfo mb-4">
                        <h1 class="text-2xl font-bold text-red-900">{{ $userinfo->emp_id }}</h1>
                        <h1 class='name text-xl'>{{ $userinfo->emp_lname . ', ' . $userinfo->emp_fname . ' ' . $userinfo->emp_mname }}</h1>
                        <span class="text-gray-600">{{ $userinfo->email_address_1 }}</span>
                    </section>

                    <div class="table-section mb-4">
                        <div class="table main-dep w-full border border-gray-300 rounded-lg overflow-hidden shadow-md">
                            @if($loads->count() == 0) 
                                <div class="w-full flex items-center justify-center text-sm text-gray-400 pt-4 pb-12">
                                    <span class="italic py-8">No user data.</span> 
                                </div>
                            @else
                                <div class="px-2 grid grid-cols-[10%_25%_10%_10%_10%_15%_10%_5%] bg-red-900 text-white">
                                    <div class="py-2 font-bold ">SUBJ CODE</div>
                                    <div class="py-2 font-bold ">SUBJECT</div>
                                    <div class="py-2 font-bold ">CLASS</div>
                                    <div class="py-2 font-bold ">CLASS DEPT</div>
                                    <div class="py-2 font-bold ">SY</div>
                                    <div class="py-2 font-bold ">SEMESTER</div>
                                    <div class="py-2 font-bold ">UNITS</div>
                                    <div class="py-2 font-bold ">ACTION</div>
                                </div>

                                @foreach($loads as $item) 
                                    <div class="px-2 {{ $count % 2 == 0 ? 'bg-gray-100' : 'bg-white' }} grid grid-cols-[10%_25%_10%_10%_10%_15%_10%_5%] py-4 border-b border-gray-300"> 
                                        <div>{{ $item->subject->subj_code }}</div> 
                                        <div>{{ $item->subject->subj_title }}</div>
                                        <div>{{ $item->class_code }}</div> 
                                        <div>{{ $item->class_dept }}</div> 
                                        <div>{{ $item->sy }}</div> 
                                        <div>{{ $item->semester }}</div> 
                                        <div>{{ $item->subject->units }}.00</div> 
                                        <div> 
                                            <form id="edit-dependent-form" action="{{ route('admin.loads.search.delete', ['id' => $item->id]) }}" method="POST"> 
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="emp_id" value="{{ $userinfo->emp_id }}">
                                                <!-- Include redirect value so that the controller knows to send back to search page -->
                                                <input type="hidden" name="redirect" value="search">
                                                <button type="button" onclick="confirmDelete(this)" class="bg-red-900 text-white rounded-lg px-2 py-1 hover:bg-red-800 transition duration-200">
                                                    Delete
                                                </button>  
                                            </form> 
                                        </div>
                                    </div>
                                    @php $count++; @endphp 
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function confirmDelete(button) { 
        if (confirm('Are you sure you want to delete this load?')) { 
            const form = button.closest('form'); 
            form.submit(); 
        }
    }

    setTimeout(function() {
        const depMsg = document.querySelector('.dep-msg');
        if(depMsg) {
            depMsg.innerHTML = '';
        }
    }, 5000); // Hide after 5 seconds

    // For confirmation 
    function confirmClearDependencies() {
        if (confirm('Are you sure you want to clear the dependencies?')) {
            document.getElementById('clear-dependencies-form').submit();
        }
    }

    function deleteDependency(button)  {
        const form = button.closest('form');
        if (confirm('Are you sure you want to cancel this request?')) { 
            form.submit();
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('search');
        const searchResults = document.getElementById('search-results');
        let debounceTimeout;

        // Debounce function to limit API calls
        function debounce(func, delay) {
            return function (...args) {
                clearTimeout(debounceTimeout);
                debounceTimeout = setTimeout(() => func.apply(this, args), delay);
            };
        }

        // Perform search
        function performSearch() {
            const query = searchInput.value.trim();

            if (!query) {
                searchResults.classList.add('hidden'); // Hide results if input is empty
                searchResults.innerHTML = ''; // Clear previous results
                return;
            }

            fetch(`{{ route('admin.pendings.search2') }}?query=${encodeURIComponent(query)}`)
                .then((response) => response.json())
                .then((data) => {
                    searchResults.innerHTML = ''; // Clear previous results
                    searchResults.classList.remove('hidden'); // Show results container

                    if (data.length > 0) {
                        data.forEach((user) => {
                            const resultItem = document.createElement('div');
                            resultItem.classList.add(
                                'p-2',
                                'hover:bg-gray-200',
                                'cursor-pointer',
                                'text-sm',
                                'text-gray-700'
                            );

                            resultItem.innerHTML = `
                                <h1 class="font-bold">${user.emp_lname}, ${user.emp_fname} ${user.emp_mname || ''}</h1>
                                <p>ID: ${user.emp_id}</p>
                                <p>Email: ${user.email_address_1}</p>
                            `;

                            // Click event to select a result
                            resultItem.addEventListener('click', () => {
                                searchInput.value = user.emp_id;
                                searchResults.classList.add('hidden'); // Hide results after selection
                                searchResults.innerHTML = ''; // Clear results
                            });

                            searchResults.appendChild(resultItem);
                        });
                    } else {
                        searchResults.innerHTML = '<div class="p-2 text-gray-500">No results found.</div>';
                    }
                })
                .catch((error) => {
                    console.error('Error fetching search results:', error);
                    searchResults.innerHTML = '<div class="p-2 text-red-500">An error occurred. Please try again.</div>';
                });
        }

        // Attach the input event listener with debouncing
        searchInput.addEventListener('input', debounce(performSearch, 300));

        // Hide search results when clicking outside
        document.addEventListener('click', (event) => {
            if (!searchResults.contains(event.target) && event.target !== searchInput) {
                searchResults.classList.add('hidden');
            }
        });
    });
</script>

<style>
    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .tbl-row:nth-child(even) {
        background-color: #f7fafc; /* Light gray for even rows */
    }

    .tbl-row:hover {
        background-color: #edf2f7; /* Light hover effect */
    }
</style>
