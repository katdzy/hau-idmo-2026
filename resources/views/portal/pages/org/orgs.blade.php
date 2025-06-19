<!-- resources\views\portal\pages\org\orgs.blade.php -->
<x-app-layout>
    <div class="min-h-screen">
        <div class="container">
            <div class="w-full flex flex-col bg-white rounded-lg p-8">
                @if(session('msg'))
                    <span class="msg w-[100%] bg-green-600 text-white rounded-lg px-4 py-2 my-4">{{ session('msg') }}</span>
                @endif

                <!-- Header -->
                <div class="w-full flex mb-2">
                    <img src="{{ asset('images/logos/school/soc_logo.png') }}" class="w-[100px] h-[100px] mr-2" alt="School Logo">
                    <div class="w-full flex flex-col justify-center">
                        <!-- Title Header -->
                        <h1 class="text-[1.5rem] font-bold leading-tight">
                            {{ $user->emp_lname . ', ' . $user->emp_fname . ' ' . $user->emp_mname }}
                        </h1>
                        <h1 class="text-[1.2rem] font-semibold text-gray-700">
                            {{ $user->emp_id }}
                        </h1>
                        <span class="text-gray-500 text-sm">
                            Number of organization/s: {{ $count }}
                        </span>
                    </div>
                </div>

                <!-- Add and Clear Buttons -->
                <div class="w-full flex gap-2">
                    <a href="{{ route('portal.org.add') }}" class="w-[25%] rounded-xl py-2 flex items-center justify-center gap-1 bg-red-900 my-2 hover:bg-red-800">
                        <img src="{{ asset('images/icons/add.png') }}" class="w-[25px] h-[25px]" alt="Add Icon">
                        <h1 class="text-white">Add Organization</h1>
                    </a>
                    <form action="{{ route('portal.org.clear') }}" class="w-[25%]" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="w-full rounded-xl py-2 flex items-center justify-center gap-1 bg-red-900 my-2 hover:bg-red-800" onclick="confirmClear(this)">
                            <img src="{{ asset('images/icons/clear.png') }}" class="w-[25px] h-[25px]" alt="Clear Icon">
                            <h1 class="text-white">Clear all data</h1>
                        </button>
                    </form>
                </div>

                <hr class="opacity-100">

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

                <!-- Table for Approved Organizations -->
                <div id="approved" class="w-full flex flex-col border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                    <!-- Header -->
                    <div class="w-full bg-red-900 text-white grid grid-cols-[25%_20%_15%_20%_20%] p-3 font-semibold text-sm uppercase tracking-wider">
                        <span>Organization</span>
                        <span>Position</span>
                        <span>Date Joined</span>
                        <span>Last Updated</span>
                        <span class="text-center">Actions</span>
                    </div>
                    <!-- Body -->
                    @if($approved->count() == 0)
                        <div class="w-full flex items-center justify-center text-sm text-gray-400 py-8">
                            <span class="italic">No user data available.</span>
                        </div>
                    @else
                        <div class="w-full flex flex-col overflow-y-auto h-[300px]">
                            @foreach($approved as $org)
                                <div class="w-full grid grid-cols-[25%_20%_15%_20%_20%] p-4 border-t border-gray-200 bg-white hover:bg-gray-50 transition-colors">
                                    <span class="flex items-center text-gray-700">{{ $org->org }}</span>
                                    <span class="flex items-center text-gray-700">{{ $org->position }}</span>
                                    <span class="flex items-center text-gray-700">{{ $org->date_joined }}</span>
                                    <span class="flex items-center text-gray-700">{{ $org->updated_at }}</span>
                                    <div class="w-full flex justify-center gap-2">
                                        <!-- Edit Button -->
                                        <form action="{{ route('portal.org.edit', ['user' => Auth::user()->id, 'id' => $org->id]) }}" method="GET">
                                            <button type="submit" class="border bg-red-900 rounded-xl p-2 hover:bg-red-700 transition-all" title="Edit Info">
                                                <img src="{{ asset('images/icons/edit.png') }}" alt="Edit" class="w-[20px] h-[20px]">
                                            </button>
                                        </form>
                                        <!-- Delete Button -->
                                        <form action="{{ route('portal.org.delete') }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="text" name="id" value="{{ $org->id }}" hidden>
                                            <button onclick="confirmDelete(this)" type="button" class="border bg-red-900 rounded-xl p-2 hover:bg-red-700 transition-all" title="Delete Item">
                                                <img src="{{ asset('images/icons/delete.png') }}" alt="Delete" class="w-[20px] h-[20px]">
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Table for Pending Organizations -->
                <div id="pending" class="w-full flex flex-col border border-gray-200 rounded-lg shadow-sm overflow-hidden inactive_link">
                    <!-- Header -->
                    <div class="w-full bg-red-900 text-white grid grid-cols-[25%_20%_15%_20%_20%] p-3 font-semibold text-sm uppercase tracking-wider">
                        <span>Organization</span>
                        <span>Position</span>
                        <span>Date Joined</span>
                        <span>Last Updated</span>
                        <span class="text-center">Actions</span>
                    </div>
                    <!-- Body -->
                    @if($pending->count() == 0)
                        <div class="w-full flex items-center justify-center text-sm text-gray-400 py-8">
                            <span class="italic">No user data available.</span>
                        </div>
                    @else
                        <div class="w-full flex flex-col overflow-y-auto h-[300px]">
                            @foreach($pending as $org)
                                <div class="w-full grid grid-cols-[25%_20%_15%_20%_20%] p-4 border-t border-gray-200 bg-white hover:bg-gray-50 transition-colors">
                                    <span class="flex items-center text-gray-700">{{ $org->org }}</span>
                                    <span class="flex items-center text-gray-700">{{ $org->position }}</span>
                                    <span class="flex items-center text-gray-700">{{ $org->date_joined }}</span>
                                    <span class="flex items-center text-gray-700">{{ $org->updated_at }}</span>
                                    <div class="w-full flex justify-center gap-2">
                                        <!-- Edit Button -->
                                        <form action="{{ route('portal.org.edit', ['user' => Auth::user()->id, 'id' => $org->id]) }}" method="GET">
                                            <button type="submit" class="border bg-red-900 rounded-xl p-2 hover:bg-red-700 transition-all" title="Edit Info">
                                                <img src="{{ asset('images/icons/edit.png') }}" alt="Edit" class="w-[20px] h-[20px]">
                                            </button>
                                        </form>
                                        <!-- Delete Button -->
                                        <form action="{{ route('portal.org.delete') }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="text" name="id" value="{{ $org->id }}" hidden>
                                            <button onclick="confirmDelete(this)" type="button" class="border bg-red-900 rounded-xl p-2 hover:bg-red-700 transition-all" title="Delete Item">
                                                <img src="{{ asset('images/icons/delete.png') }}" alt="Delete" class="w-[20px] h-[20px]">
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Table for To-review Organizations -->
                <div id="toreview" class="w-full flex flex-col border border-gray-200 rounded-lg shadow-sm overflow-hidden inactive_link">
                    <!-- Header -->
                    <div class="w-full bg-red-900 text-white grid grid-cols-[25%_20%_15%_20%_20%] p-3 font-semibold text-sm uppercase tracking-wider">
                        <span>Organization</span>
                        <span>Position</span>
                        <span>Date Joined</span>
                        <span>Last Updated</span>
                        <span class="text-center">Actions</span>
                    </div>
                    <!-- Body -->
                    @if($toreview->count() == 0)
                        <div class="w-full flex items-center justify-center text-sm text-gray-400 py-8">
                            <span class="italic">No user data available.</span>
                        </div>
                    @else
                        <div class="w-full flex flex-col overflow-y-auto h-[300px]">
                            @foreach($toreview as $org)
                                <div class="w-full grid grid-cols-[25%_20%_15%_20%_20%] p-4 border-t border-gray-200 bg-white hover:bg-gray-50 transition-colors">
                                    <span class="flex items-center text-gray-700">{{ $org->org }}</span>
                                    <span class="flex items-center text-gray-700">{{ $org->position }}</span>
                                    <span class="flex items-center text-gray-700">{{ $org->date_joined }}</span>
                                    <span class="flex items-center text-gray-700">{{ $org->updated_at }}</span>
                                    <div class="w-full flex justify-center gap-2">
                                        <!-- Edit Button -->
                                        <form action="{{ route('portal.org.edit', ['user' => Auth::user()->id, 'id' => $org->id]) }}" method="GET">
                                            <button type="submit" class="border bg-red-900 rounded-xl p-2 hover:bg-red-700 transition-all" title="Edit Info">
                                                <img src="{{ asset('images/icons/edit.png') }}" alt="Edit" class="w-[20px] h-[20px]">
                                            </button>
                                        </form>
                                        <!-- Delete Button -->
                                        <form action="{{ route('portal.org.delete') }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="text" name="id" value="{{ $org->id }}" hidden>
                                            <button onclick="confirmDelete(this)" type="button" class="border bg-red-900 rounded-xl p-2 hover:bg-red-700 transition-all" title="Delete Item">
                                                <img src="{{ asset('images/icons/delete.png') }}" alt="Delete" class="w-[20px] h-[20px]">
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <hr class="opacity-100 my-4">
                <span class="text-gray-400 text-[0.8rem]">
                    Please ensure that all data or membership information you provide or upload is legitimate.
                    It is essential that all submissions meet the necessary criteria and comply with our standards to maintain the integrity of our system.
                    Thank you for your cooperation.
                </span>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    a,
    button {
        transition: 300ms;
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

    function confirmDelete(button) {
        const form = button.closest('form');
        if (confirm('Are you sure you want to delete this record?')) {
            form.submit();
        }
    }

    function confirmClear(button) {
        const form = button.closest('form');
        if (confirm("Are you sure you want to clear all organization memberships?")) {
            form.submit();
        }
    }

    window.addEventListener("DOMContentLoaded", function() {
        setTimeout(function() {
            const sessionMsg = document.querySelector('.msg');
            if (sessionMsg) {
                sessionMsg.style.display = 'none';
            }
        }, 3000);
    });
</script>
