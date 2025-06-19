@php
    // Initialize count based on the current page
    $count = ($data->currentPage() - 1) * $data->perPage() + 1;
@endphp

<x-app-layout>
    <div class ="min-h-screen">
        <div class="w-full flex justify-center py-8 relative">
            <div class="rounded-lg w-11/12 bg-white flex flex-col items-center py-4">

                @if (session('success'))
                    <div class="bg-green-500 text-white p-4 rounded-md mb-4 w-full">
                        <p class="text-sm font-medium">{{ session('success') }}</p>
                    </div>
                @endif

                <!-- Search and Add Button Header -->
                <section class="w-full flex flex-col md:flex-row mb-2 px-8 items-center">
                    <!-- Search Bar -->
                    <div class="flex flex-col w-full md:w-1/2 md:mb-0">
                        <label for="search" class="text-sm text-gray-500 mb-1">Search</label>
                        <input id="search" 
                            type="text" 
                            name="search" 
                            value="{{ $search ?? '' }}" 
                            placeholder="Enter a keyword..." 
                            class="w-full border border-gray-200 p-2 rounded-sm placeholder-gray-400 text-sm focus:outline-none focus:shadow-none">
                    </div>
                    
                    <!-- Add Button -->
                    <div class="w-full md:w-auto flex justify-end md:ml-auto">
                        <a href="{{ route('admin.prc.addInitial') }}" class="flex items-center justify-center bg-red-800 hover:bg-red-700 rounded-lg text-white py-2 px-4 transition duration-300" id="add-prc-button">
                            <img src="{{ asset('images/icons/add_plain.png') }}" class="w-5 h-5 mr-2" alt="Add Icon">
                            <span class="text-sm font-medium">Add</span>
                        </a>
                    </div>
                </section>

                <!-- Filter Button and Filter Box -->
                <section class="w-full px-8 mb-2">
                    <!-- Filter Button -->
                    <button id="filter-btn" 
                            class="flex items-center gap-2 bg-white hover:bg-gray-200 rounded-lg px-4 py-2">
                        <img src="{{ asset('images/icons/filter.svg') }}" class="w-4 h-4" alt="Filter Icon">
                        <span class="font-semibold text-gray-700">Filter</span> 
                    </button>

                    <!-- Filter Box -->
                    <div id="filter-box" class="w-full flex flex-col p-4 mb-4 rounded-xl bg-white shadow-md hidden">
                        <div class="w-full flex flex-wrap md:flex-nowrap gap-4">
                            <!-- Examination Filter -->
                            <div class="flex flex-col w-full md:w-1/3">
                                <label for="examination" class="text-sm text-gray-500 mb-1">Examination</label>
                                <select id="examination" name="examination" class="w-full border border-gray-200 rounded-md p-2 text-sm">
                                    <option value="">All Examinations</option>
                                    @foreach($prc_exams as $exam)
                                        <option value="{{ $exam->item }}" {{ (isset($examination) && $examination == $exam->item) ? 'selected' : '' }}>{{ $exam->item }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Date Range Filter -->
                            <div class="flex flex-col w-full md:w-1/3">
                                <label class="text-sm text-gray-500 mb-1">Exam Date Range</label>
                                <div class="flex gap-2">
                                    <input id="start_date" 
                                        type="date" 
                                        name="start_date" 
                                        value="{{ $start_date ?? '' }}" 
                                        class="w-1/2 border border-gray-200 p-2 rounded-md text-sm">
                                    <input id="end_date" 
                                        type="date" 
                                        name="end_date" 
                                        value="{{ $end_date ?? '' }}" 
                                        class="w-1/2 border border-gray-200 p-2 rounded-md text-sm">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Table Header -->
                <div class="w-11/12 grid grid-cols-3 h-10 bg-red-800 text-white">
                    <div class="flex items-center pl-4">
                        <h1 class="text-sm font-medium">DATE</h1>
                    </div>
                    <div class="flex items-center pl-4">
                        <h1 class="text-sm font-medium">EXAMINATION</h1>
                    </div>
                    <div class="flex items-center justify-end pr-4">
                        <h1 class="text-sm font-medium">ACTION</h1>
                    </div>
                </div>

                <!-- Table + Pagination Container -->
                <section class="w-11/12" id="results-container">
                    <div id="prc-list">
                        @if(count($data) == 0)
                            <div class="w-full text-center py-4 text-gray-500">
                                <h1>No data.</h1>
                            </div>
                        @else
                            @foreach($data as $item)
                                <div class="grid grid-cols-3 w-full py-4 @if($count % 2 == 0) bg-gray-100 @endif hover:bg-gray-200 transition">
                                    <div class="flex items-center pl-4">
                                        <h1 class="date text-gray-700 font-normal text-base cursor-pointer">{{ $item->exam_date }}</h1>
                                    </div>
                                    <div class="flex items-center pl-4">
                                        <h1 class="text-gray-700 font-normal text-base">{{ $item->title }}</h1>
                                    </div>
                                    <div class="flex items-center justify-end pr-4">
                                        <form action="{{ route('admin.prc.view', ['id'=> $item->id]) }}" method="GET">
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <button type="submit" class="bg-green-700 text-white px-6 py-1 rounded-full text-sm hover:bg-green-500">READ</button>
                                        </form>
                                    </div>
                                </div>
                                @php $count++; @endphp
                            @endforeach
                        @endif
                    </div>

                    <!-- Pagination Links -->
                    <div class="w-full mt-4 flex justify-end" id="pagination-links">
                        {{ $data->appends([
                            'search' => $search,
                            'examination' => $examination ?? '',
                            'start_date' => $start_date ?? '',
                            'end_date' => $end_date ?? ''
                        ])->links() }}
                    </div>
                </section>

            </div>
        </div>

        <script>
            const baseUrl = "{{ url('/') }}";
            const searchInput = document.getElementById('search');
            const examinationSelect = document.getElementById('examination');
            const startDateInput = document.getElementById('start_date');
            const endDateInput = document.getElementById('end_date');
            const filterBtn = document.getElementById('filter-btn');
            const filterBox = document.getElementById('filter-box');

            // Toggle Filter Box
            filterBtn.addEventListener('click', function() {
                filterBox.classList.toggle('hidden');
            });

            // Function to get current filter values
            function getFilters() {
                return {
                    search: searchInput.value.trim(),
                    examination: examinationSelect.value,
                    start_date: startDateInput.value,
                    end_date: endDateInput.value
                };
            }

            // Event listeners for filters
            searchInput.addEventListener('input', debounce(function() {
                fetchResults();
            }, 500));

            examinationSelect.addEventListener('change', function() {
                fetchResults();
            });

            startDateInput.addEventListener('change', function() {
                fetchResults();
            });

            endDateInput.addEventListener('change', function() {
                fetchResults();
            });

            // Debounce function to limit the rate of function calls
            function debounce(func, delay) {
                let debounceTimer;
                return function() {
                    const context = this;
                    const args = arguments;
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(() => func.apply(context, args), delay);
                };
            }

            // Function to fetch results with current filters
            function fetchResults(page = 1) {
                const filters = getFilters();
                const queryParams = new URLSearchParams({
                    query: filters.search,
                    examination: filters.examination,
                    start_date: filters.start_date,
                    end_date: filters.end_date,
                    page: page
                });

                fetch(`${baseUrl}/prc/search?${queryParams.toString()}`, {
                    method: 'GET',
                    headers: {
                        Accept: 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    const prcList = document.getElementById('prc-list');
                    const paginationLinks = document.getElementById('pagination-links');

                    prcList.innerHTML = '';
                    if (data.data.length === 0) {
                        prcList.innerHTML = `
                            <div class="w-full text-center py-4 text-gray-500">
                                <h1>No results.</h1>
                            </div>`;
                        paginationLinks.innerHTML = '';
                        return;
                    }

                    // Populate new rows
                    let html = '';
                    let count = data.from;
                    data.data.forEach(item => {
                        const bgClass = count % 2 === 0 ? 'bg-gray-100' : '';
                        html += `
                            <div class="grid grid-cols-3 w-full py-4 ${bgClass} hover:bg-gray-200 transition">
                                <div class="flex items-center pl-4">
                                    <h1 class="date text-gray-700 font-normal text-base cursor-pointer">${item.exam_date}</h1>
                                </div>
                                <div class="flex items-center pl-4">
                                    <h1 class="text-gray-700 font-normal text-base">${item.title}</h1>
                                </div>
                                <div class="flex items-center justify-end pr-4">
                                    <form action="${baseUrl}/prc/view?id=${item.id}" method="GET">
                                        <input type="hidden" name="id" value="${item.id}">
                                        <button type="submit" class="bg-green-700 text-white px-6 py-1 rounded-full text-sm hover:bg-green-500">READ</button>
                                    </form>
                                </div>
                            </div>`;
                        count++;
                    });

                    prcList.innerHTML = html;

                    // Update pagination links
                    paginationLinks.innerHTML = data.links;

                    // Add event listeners to new pagination links
                    const newPaginationLinks = paginationLinks.querySelectorAll('a');
                    newPaginationLinks.forEach(link => {
                        link.addEventListener('click', function(e) {
                            e.preventDefault();
                            const url = new URL(link.href);
                            const page = url.searchParams.get('page');
                            fetchResults(page);
                            // Scroll to top of results
                            window.scrollTo(0, 0);
                        });
                    });
                })
                .catch(error => console.error('Error fetching search results:', error));
            }

            // Handle pagination link clicks on initial load
            document.addEventListener('DOMContentLoaded', function() {
                const initialPaginationLinks = document.getElementById('pagination-links').querySelectorAll('a');
                initialPaginationLinks.forEach(link => {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        const url = new URL(link.href);
                        const page = url.searchParams.get('page');
                        fetchResults(page);
                        // Scroll to top of results
                        window.scrollTo(0, 0);
                    });
                });
            });
        </script>
    </div>
</x-app-layout>
