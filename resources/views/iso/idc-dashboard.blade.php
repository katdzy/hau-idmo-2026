<x-app-layout>
@php
function getStatusColor($status){
    $colors = [
        'pending' => 'bg-yellow-100 text-yellow-800',
        'submitted_to_idc' => 'bg-blue-100 text-blue-800',
        'with_qmr' => 'bg-purple-100 text-purple-800',
        'approved'=> 'bg-green-100 text-green-800',
        'on_hold' => 'bg-red-100 text-red-800'
    ];
    return $colors[$status] ?? 'bg-gray-100 text-gray-800';
}
@endphp

<div class="min-h-screen">
    <div class="container mx-auto">
        <div class="con-box">
            <!-- Success/Error messages -->
             @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
            </div>
            @endif
            @if (session('msg'))
                <div class="w-full bg-green-600 text-white rounded-xl px-4 py-2 mb-4" id ="msg">
                    {{ session('msg') }}
                </div>
            @endif
            @if(session('error'))
                <div class="w-full bg-red-600 text-white rounded-xl px-4 py-2 mb-4" id="error-msg">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Header -->
            <div class="w-[95%] px-4 flex my-4 items-center">
                <img src="{{ asset('images/logos/school/soc_logo.png') }}"class="w-[100px] h-[100px] mr-2"/>
                <div class="w-full flex flex-col justify-center">
                    <h1 class="text-[1.5rem] font-bold leading-tight text-purple-700">IDC Management Dashboard</h1>
                    <span class="text-gray-500 text-sm">Institutional Document Controller - Ticket Management</span>
                </div>
            </div>
            <hr class="w-full opacity-100">

            <!-- Search Box  (Same as the one on the document blade) -->
            <div class="w-full px-4 py-3 bg-gray-50 rounded-lg mb-b">
                <form method="GET" action="{{ route('iso.idc.dashboard') }}" class="flex gap-3 items-center">
                    <!-- Preserve status filter -->
                    <input type="hidden" name="status" value="{{ $statusFilter ?? 'submitted_to_idc' }}">

                    <!-- Search Input -->
                    <div class="flex-1">
                        <input type="text"
                            name="search"
                            value="{{ $search ?? '' }}"
                            placeholder="Search by Ticket ID, Section, Document Code, or document Title..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                    </div>

                    <!-- Search button -->
                    <button type="submit" class="bg-purple-500 hover:bg-purple-600 text-white px-6 py-2 rounded-lg font-semibold">
                        Search
                    </button>

                    <!-- Clear Button (only show if searching) -->
                    @if ($search ?? false)
                        <a href="{{ route('iso.idc.dashboard', ['status' => $statusFilter ?? 'submitted_to_idc']) }}"
                            class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg font-semibold">
                            Clear
                        </a>
                    @endif
                </form>
            </div>

            <!-- Search results info -->
            @if($search ?? false)
                <div class="w-full px-4 py-2 bg-blue-50 border-l-4 border-blue-500 mb-4">
                    <p class="text-sm text-blue-800">
                        <strong>Searching for:</strong> "{{ $search }}"
                        <span class="text-blue-600">({{ count($tickets) }} result{{ count($tickets) != 1 ? 's': '' }} found)</span>
                    </p>
                </div>
            @endif

            <!-- TODO: Status tabs will go here next -->
            <div class="w-full flex">
                <a href="{{ route('iso.idc.dashboard', ['status' => 'submitted_to_idc', 'search' => $search ?? null]) }}"
                    class="hover:bg-gray-100 text-gray-400 font-semibold px-8 py-2 {{ ($statusFilter ?? 'submitted_to_idc') === 'submitted_to_idc' ? 'active_link' : '' }}">
                    Submitted to IDC
                </a>
                <a href="{{ route('iso.idc.dashboard', ['status' => 'with_qmr', 'search' => $search ?? null]) }}"
                    class="hover:bg-gray-100 text-gray-400 font-semibold px-8 py-2 {{ ($statusFilter ?? 'with_qmr') === 'with_qmr' ? 'active_link' : '' }}">
                    With QMR
                </a>
                <a href="{{ route('iso.idc.dashboard', ['status' => 'approved', 'search' => $search ?? null]) }}"
                    class="hover:bg-gray-100 text-gray-400 font-semibold px-8 py-2 {{ ($statusFilter ?? 'approved') === 'approved' ? 'active_link' : '' }}">
                    Approved
                </a>
                <a href="{{ route('iso.idc.dashboard', ['status' => 'on_hold', 'search' => $search ?? null]) }}"
                    class="hover:bg-gray-100 text-gray-400 font-semibold px-8 py-2 {{ ($statusFilter ?? 'on_hold') === 'on_hold' ? 'active_link' : '' }}">
                    On Hold
                </a>
                <a href="{{ route('iso.idc.dashboard', ['status' => 'all', 'search' => $search ?? null]) }}"
                    class="hover:bg-gray-100 text-gray-400 font-semibold px-8 py-2 {{ ($statusFilter ?? 'all') === 'all' ? 'active_link' : '' }}">
                    All Tickets
                </a>
            </div>
            <!-- TODO: Tickets table will go here -->
        </div>
    </div>
</div>
</x-app-layout>

<style>
    .container { 
        width: 100%;
        display: flex; 
        justify-content: center;
        padding: 2rem 0;
    }
    
    .con-box { 
        border-radius: 10px; 
        width: 95%;
        background-color: white;
        display: flex; 
        flex-direction: column;
        align-items: center;
        padding: 1rem 0;
    }

    .active_link {
        border-bottom: 4px solid #9333EA; /* Purple color for IDC */
        font-weight: 700;
        transition: 150ms;
    }

    .active_link:hover{
        background-color: rgb(230,230,230);
    }
</style>

<script>
    // Auto-hide messages after 5 seconds
    setTimeout(() => {
        const msgElement = document.getElementById('msg');
        if(msgElement) msgElement.style.display = 'none';
        const errorElement = document.getElementById('error-msg');
        if(errorElement) errorElement.styledisplay = 'none';
    }, 5000)
</script>