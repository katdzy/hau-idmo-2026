<x-app-layout>
    <div class="max-w-5xl mx-auto px-6 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">📋 KPI Library</h1>

        <!-- Search Form -->
        <form method="GET" action="{{ route('kpis.dashboard') }}" class="mb-6">
            <input
                type="text"
                name="search"
                placeholder="Search KPIs by name or description..."
                class="w-full border border-gray-300 rounded-lg px-4 py-3 shadow-sm text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                value="{{ request('search') }}"
            >
        </form>

        <!-- KPI List -->
        @forelse($kpis as $kpi)
            <div class="border-t border-gray-200 py-4">
                <a href="{{ route('kpis.show', $kpi->id) }}" class="text-lg font-semibold text-blue-700 hover:underline">
                    {{ $kpi->measure_name }}
                </a>
                <p class="text-sm text-gray-600 mt-1">
                    {{ Str::limit($kpi->description, 200) }}
                </p>
                <p class="text-xs text-gray-500 mt-1">
                    Code: {{ $kpi->measure_code }} &nbsp;|&nbsp; Owner: {{ $kpi->measure_owner }}
                </p>
            </div>
        @empty
            <div class="text-gray-500 italic mt-4">
                No KPIs found.
            </div>
        @endforelse
    </div>
</x-app-layout>
