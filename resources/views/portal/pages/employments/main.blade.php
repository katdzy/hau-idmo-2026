<x-app-layout>
    <div class="min-h-screen">
        <div class="w-full flex justify-center py-8">
            <div class="w-[95%] flex flex-col p-8 rounded-lg bg-white items-start">
                <!-- Header -->
                <div class="w-full flex">
                    <img src="{{ asset('images/logos/school/soc_logo.png') }}" class="w-[100px] h-[100px] mr-2" alt="School Logo" />
                    <div class="w-full flex flex-col justify-center">
                        <!-- Title Header -->
                        <h1 class="text-[1.5rem] font-bold leading-tight">
                            {{ $user->emp_lname . ', ' . $user->emp_fname . ' ' . $user->emp_mname }}
                        </h1>
                        <h1 class="text-[1.2rem] font-semibold text-gray-700">
                            {{ $user->emp_id }}
                        </h1>
                    </div>
                </div>

                <a href="{{ route('portal.filing.employment') }}" class="flex justify-center items-center bg-gray-500 hover:bg-gray-400 text-white rounded-lg px-8 py-1 gap-2 mb-4">
                    <img src="{{ asset('images/icons/add.png') }}" class="w-[25px] h-[25px]" alt="Add Icon">
                    <span> Add New Record</span>
                </a>

                @if(isset($msg))
                    <h1 class="w-full bg-green-600 text-white rounded-xl px-4 py-2" id="msg">
                        {{ $msg }}
                    </h1>
                @endif

                <hr class="w-full opacity-100 my-2">

                <!-- Navigation Buttons -->
                <div class="w-full flex">
                    <button id="approved_btn" class="hover:bg-gray-100 text-gray-400 font-semibold px-8 py-2 active_link">
                        Approved
                    </button>
                    <button id="pending_btn" class="hover:bg-gray-100 text-gray-400 font-semibold px-8 py-2">
                        Pending
                    </button>
                    <button id="toreview_btn" class="hover:bg-gray-100 text-gray-400 font-semibold px-8 py-2">
                        To-review
                    </button>
                </div>
                <hr class="mb-2 opacity-90 w-full">

                <!-- Table for Approved -->
                <div id="approved" class="w-full flex flex-col border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                    <!-- Header -->
                    <div class="w-full bg-red-900 text-white grid grid-cols-[35%_20%_15%_15%_15%] p-3 font-semibold text-sm uppercase tracking-wider">
                        <span>Company</span>
                        <span>Position</span>
                        <span>Date Hired</span>
                        <span>Date Resigned</span>
                        <span class="text-center">Actions</span>
                    </div>

                    <!-- Body -->
                    @if($approved->count() == 0)
                        <div class="w-full flex items-center justify-center text-sm text-gray-400 py-8">
                            <span class="italic">No user data available.</span>
                        </div>
                    @else
                        <div class="w-full flex flex-col overflow-y-auto h-[300px]">
                            @foreach($approved as $item)
                                <div class="w-full grid grid-cols-[35%_20%_15%_15%_15%] p-4 border-t border-gray-200 bg-white hover:bg-gray-50 transition-colors">
                                    <span class="flex items-center text-gray-700">{{ $item->company }}</span>
                                    <span class="flex items-center text-gray-700">{{ $item->position }}</span>
                                    <span class="flex items-center text-gray-700">{{ $item->date_hired }}</span>
                                    <span class="flex items-center text-gray-700">{{ $item->date_resigned }}</span>
                                    <div class="w-full flex justify-center">
                                        <form action="{{ route('portal.employment.view', ['id' => $item->id]) }}" method="GET" class="w-full">
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <button class="w-[95%] py-2 bg-green-700 text-white rounded-lg hover:bg-green-600 transition-all">
                                                INFO
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Table for Pending -->
                <div id="pending" class="w-full flex flex-col border border-gray-200 rounded-lg shadow-sm overflow-hidden inactive_link">
                    <!-- Header -->
                    <div class="w-full bg-red-900 text-white grid grid-cols-[35%_20%_15%_15%_15%] p-3 font-semibold text-sm uppercase tracking-wider">
                        <span>Company</span>
                        <span>Position</span>
                        <span>Date Hired</span>
                        <span>Date Resigned</span>
                        <span class="text-center">Actions</span>
                    </div>

                    <!-- Body -->
                    @if($pending->count() == 0)
                        <div class="w-full flex items-center justify-center text-sm text-gray-400 py-8">
                            <span class="italic">No user data available.</span>
                        </div>
                    @else
                        <div class="w-full flex flex-col overflow-y-auto h-[300px]">
                            @foreach($pending as $item)
                                <div class="w-full grid grid-cols-[35%_20%_15%_15%_15%] p-4 border-t border-gray-200 bg-white hover:bg-gray-50 transition-colors">
                                    <span class="flex items-center text-gray-700">{{ $item->company }}</span>
                                    <span class="flex items-center text-gray-700">{{ $item->position }}</span>
                                    <span class="flex items-center text-gray-700">{{ $item->date_hired }}</span>
                                    <span class="flex items-center text-gray-700">{{ $item->date_resigned }}</span>
                                    <div class="w-full flex justify-center">
                                        <form action="{{ route('portal.employment.view', ['id' => $item->id]) }}" method="GET" class="w-full">
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <button class="w-[95%] py-2 bg-green-700 text-white rounded-lg hover:bg-green-600 transition-all">
                                                INFO
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Table for To-review -->
                <div id="toreview" class="w-full flex flex-col border border-gray-200 rounded-lg shadow-sm overflow-hidden inactive_link">
                    <!-- Header -->
                    <div class="w-full bg-red-900 text-white grid grid-cols-[35%_20%_15%_15%_15%] p-3 font-semibold text-sm uppercase tracking-wider">
                        <span>Company</span>
                        <span>Position</span>
                        <span>Date Hired</span>
                        <span>Date Resigned</span>
                        <span class="text-center">Actions</span>
                    </div>

                    <!-- Body -->
                    @if($toreview->count() == 0)
                        <div class="w-full flex items-center justify-center text-sm text-gray-400 py-8">
                            <span class="italic">No user data available.</span>
                        </div>
                    @else
                        <div class="w-full flex flex-col overflow-y-auto h-[300px]">
                            @foreach($toreview as $item)
                                <div class="w-full grid grid-cols-[35%_20%_15%_15%_15%] p-4 border-t border-gray-200 bg-white hover:bg-gray-50 transition-colors">
                                    <span class="flex items-center text-gray-700">{{ $item->company }}</span>
                                    <span class="flex items-center text-gray-700">{{ $item->position }}</span>
                                    <span class="flex items-center text-gray-700">{{ $item->date_hired }}</span>
                                    <span class="flex items-center text-gray-700">{{ $item->date_resigned }}</span>
                                    <div class="w-full flex justify-center">
                                        <form action="{{ route('portal.employment.view', ['id' => $item->id]) }}" method="GET" class="w-full">
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <button class="w-[95%] py-2 bg-green-700 text-white rounded-lg hover:bg-green-600 transition-all">
                                                INFO
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    a,
    button {
        transition: 150ms;
    }

    .active_link {
        border-bottom: 4px solid #FFD700;
        font-weight: 700;
        transition: 150ms;
    }

    .active_link:hover {
        background-color: rgb(230, 230, 230);
    }

    .inactive_link {
        display: none;
    }
</style>

<script>
    const approved_btn = document.getElementById('approved_btn');
    const pending_btn = document.getElementById('pending_btn');
    const toreview_btn = document.getElementById('toreview_btn');

    const approved_tbl = document.getElementById('approved');
    const pending_tbl = document.getElementById('pending');
    const toreview_tbl = document.getElementById('toreview');

    approved_btn.addEventListener("click", () => {
        approved_btn.classList.add("active_link");
        pending_btn.classList.remove("active_link");
        toreview_btn.classList.remove("active_link");

        approved_tbl.classList.remove("inactive_link");
        pending_tbl.classList.add("inactive_link");
        toreview_tbl.classList.add("inactive_link");
    });

    pending_btn.addEventListener("click", () => {
        approved_btn.classList.remove("active_link");
        pending_btn.classList.add("active_link");
        toreview_btn.classList.remove("active_link");

        approved_tbl.classList.add("inactive_link");
        pending_tbl.classList.remove("inactive_link");
        toreview_tbl.classList.add("inactive_link");
    });

    toreview_btn.addEventListener("click", () => {
        approved_btn.classList.remove("active_link");
        pending_btn.classList.remove("active_link");
        toreview_btn.classList.add("active_link");

        approved_tbl.classList.add("inactive_link");
        pending_tbl.classList.add("inactive_link");
        toreview_tbl.classList.remove("inactive_link");
    });

    setTimeout(() => {
        const msgDiv = document.getElementById('msg');
        if (msgDiv) {
            msgDiv.style.display = 'none';
        }
    }, 5000);
</script>
