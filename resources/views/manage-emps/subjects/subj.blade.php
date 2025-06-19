@php
    // Initialize count based on the current page
    $count = ($data->currentPage() - 1) * $data->perPage() + 1;
@endphp

<x-app-layout>
    <div class="w-full flex justify-center py-8 relative">
        <div class="rounded-lg w-11/12 bg-white flex flex-col items-center py-4">
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
            <!-- Search Header -->
            <section class="w-full flex relative mb-6">
                <!-- Search Section -->
                <div class="w-1/2 pl-8 flex flex-col relative">
                    <span class="text-sm text-gray-500">Search for Subject</span>
                    <input id="search" type="text" name="search" placeholder="Enter a keyword..." class="w-full placeholder-gray-400 text-sm focus:outline-none focus:shadow-none border border-gray-300 rounded">
                    <div class="absolute w-full bg-gray-50 top-full flex flex-col max-h-[300px] search-results"></div>
                </div>
                <!-- Dropdown Section -->
                <div class="w-1/2 flex items-end justify-end">
                    <h1 id="dp-ind" class="hidden">hidden</h1>
                    <button type="button" class="dp mr-8 h-10 flex items-center justify-center bg-red-800 text-white w-10 transition duration-300 relative hover:bg-red-700 rounded">
                        <img src="{{ asset('images/icons/menu.png') }}" class="w-5 h-5">
                    </button>
                    <div class="dropdown-menu absolute top-full right-8 hidden flex flex-col bg-red-800 rounded shadow">
                        <a href="{{ route('admin.subjects.add') }}" class="dp-item px-4 py-2 text-white hover:bg-red-700">ADD NEW SUBJECT</a>
                        <a href="{{ route('admin.subjects.delete') }}" class="dp-item px-4 py-2 text-white hover:bg-red-700">DELETE SUBJECT</a>
                        <a href="{{ route('admin.subjects.upload') }}" class="dp-item px-4 py-2 text-white hover:bg-red-700">UPLOAD SUBJECTS</a>
                    </div>
                </div>
            </section>

            <!-- Table Header -->
            <div class="w-11/12 grid grid-cols-3 h-10 bg-red-800 text-white">
                <div class="flex items-center pl-4">
                    <h1 class="text-sm font-medium">SUBJ_CODE</h1>
                </div>
                <div class="flex items-center pl-4">
                    <h1 class="text-sm font-medium">SUBJ_TITLE</h1>
                </div>
                <div></div>
            </div>

            <!-- Table Section -->
            <section class="w-11/12">
                @if($data->count() == 0)
                    <div class="w-full text-center py-4 text-gray-500">
                        <h1>No data.</h1>
                    </div>
                @else
                    @foreach($data as $item)
                        <div class="grid grid-cols-3 w-full py-4 @if($count % 2 == 0) bg-gray-100 @endif hover:bg-gray-200 transition">
                            <div class="flex items-center pl-4">
                                <h1 class="subj_code text-gray-700 font-normal text-base cursor-pointer">{{ $item->subj_code }}</h1>
                            </div>
                            <div class="flex items-center pl-4">
                                <h1 class="text-gray-700 font-normal text-base">{{ $item->subj_title }}</h1>
                            </div>
                            <div class="flex items-center justify-end pr-4">
                                <form action="{{ route('admin.subjects.view') }}" method="GET">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item->subj_code }}">
                                    <button type="submit" class="bg-green-700 text-white px-6 py-1 rounded-full text-sm hover:bg-green-500">READ</button>
                                </form>
                            </div>
                        </div>
                        @php $count++; @endphp
                    @endforeach

                    <!-- Pagination Links -->
                    <div class="mt-2">
                        {{ $data->links() }}
                    </div>
                @endif
            </section>
        </div>
    </div>
</x-app-layout>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search');
    const searchResults = document.querySelector('.search-results');
    let debounceTimeout;

    function fetchSearchResults(query) {
        if (query === '') {
            searchResults.innerHTML = '';
            return;
        }

        fetch(`{{ route('admin.subjects.search2') }}?query=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                searchResults.innerHTML = '';
                if (data.length > 0) {
                    data.forEach(post => {
                        const resultItem = document.createElement('div');
                        resultItem.innerHTML = `
                            <form class="w-full p-4 leading-6 bg-gray-100 hover:bg-gray-200 border border-gray-300" action="{{ route('admin.subjects.view') }}" method="GET">
                                <input type="hidden" name="id" value="${post.subj_code}">
                                <button type="submit" class="w-full text-left">
                                    <h1 class="italic text-base font-bold">${post.subj_code} - ${post.subj_title}</h1>
                                    <h3 class="text-sm">${post.subj_description}</h3>
                                </button>
                            </form>`;
                        searchResults.appendChild(resultItem);
                    });
                } else {
                    searchResults.innerHTML = '<div class="p-4">No results found.</div>';
                }
            });
    }

    function debounce(func, delay) {
        return function (...args) {
            clearTimeout(debounceTimeout);
            debounceTimeout = setTimeout(() => func.apply(this, args), delay);
        };
    }

    searchInput.addEventListener('keyup', debounce(function () {
        const query = searchInput.value;
        fetchSearchResults(query);
    }, 500));

    // Dropdown functionality
    document.querySelector(".dp").addEventListener("click", () => {
        const dpMenu = document.querySelector(".dropdown-menu");
        dpMenu.classList.toggle('hidden');
    });
});
window.addEventListener("DOMContentLoaded", function() {
        setTimeout(function() {
            const sessionMsg = document.querySelector('.flash-message');
            if (sessionMsg) {
                sessionMsg.style.display = 'none';
            }
        }, 3000);
    });

</script>
