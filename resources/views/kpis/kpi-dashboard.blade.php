<x-app-layout>
    <div class="max-w-5xl mx-auto px-6 py-8">
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-red-800 drop-shadow">KPI Library</h1>
            @if(Auth::user()->role === 'SuperAdmin')
            <a href="{{ route('kpis.add') }}"
               class="inline-block bg-red-700 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded-lg shadow text-sm transition">
                + Add KPI
            </a>
            @endif
        </div>

        <!-- Search Form -->
        <div class="relative mb-6 sticky top-0 z-20 bg-white">
            <input
                type="text"
                name="search"
                id="search"
                placeholder="Search KPIs..."
                class="w-full border border-red-300 rounded-lg px-4 py-3 shadow-sm text-sm focus:outline-none focus:ring-2 focus:ring-red-500"
                autocomplete="off"
            >
            <button type="button" id="clear-search" class="absolute right-2 top-1/2 -translate-y-1/2 bg-red-100 hover:bg-red-200 text-red-700 px-3 py-1 rounded-lg text-xs font-semibold transition">Clear</button>
        </div>

        <!-- KPI List Container -->
        <div id="kpi-list" class="flex flex-col gap-6 mt-2">
            @foreach($kpis as $kpi)
                <div class="bg-white rounded-xl shadow-lg p-6 flex flex-row items-center justify-between hover:shadow-xl transition border border-red-100 cursor-pointer" onclick="window.location='{{ route('kpis.show', $kpi->measure_code) }}'">
                    <div class="flex-1 min-w-0">
                        <h2 class="text-xl font-bold text-red-700 mb-1 truncate">
                            <a href="{{ route('kpis.show', $kpi->measure_code) }}" class="hover:underline">{{ $kpi->measure_name }}</a>
                        </h2>
                        <p class="text-gray-600 text-sm mb-2 truncate">{{ $kpi->description }}</p>
                        <div class="flex flex-wrap gap-2 mb-2">
                            <span class="bg-red-50 text-red-700 px-2 py-1 rounded text-xs font-semibold">{{ $kpi->measure_code }}</span>
                            <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs">{{ $kpi->unit_type }}</span>
                            <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs">{{ $kpi->polarity }}</span>
                        </div>
                        <div class="text-xs text-gray-400 mb-2">Owner: {{ $kpi->measure_owner }}</div>
                    </div>
                    <div class="flex flex-col gap-2 items-end ml-6">
                        <!-- View link moved to KPI name above -->
                        @if(Auth::user()->role === 'SuperAdmin')
                        <a href="{{ route('kpis.edit', $kpi->measure_code) }}" class="bg-red-700 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-xs font-semibold shadow transition">Edit</a>
                        <form action="{{ route('kpis.destroy', $kpi->measure_code) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this KPI?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-100 hover:bg-red-200 text-red-700 px-4 py-2 rounded-lg text-xs font-semibold shadow transition">Delete</button>
                        </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        document.getElementById('search').addEventListener('input', function () {
            const search = this.value;
            fetch(`{{ route('kpis.ajax-search') }}?search=${encodeURIComponent(search)}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.text())
            .then(html => {
                document.getElementById('kpi-list').innerHTML = html;
            });
        });

        document.getElementById('clear-search').addEventListener('click', function () {
            const searchInput = document.getElementById('search');
            searchInput.value = '';
            fetch(`{{ route('kpis.ajax-search') }}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.text())
            .then(html => {
                document.getElementById('kpi-list').innerHTML = html;
            });
        });
    </script>
</x-app-layout>
