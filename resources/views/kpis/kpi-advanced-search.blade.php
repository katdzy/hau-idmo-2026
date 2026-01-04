<x-app-layout>
    <div class="min-h-screen">
        <div class="flex justify-center items-center w-full py-8">
            <div class="flex-col w-[95%] bg-white rounded-lg py-8">
                <div class="px-8 pb-4">
                    <a href="{{ route('kpis.dashboard') }}" class="inline-flex gap-1 items-center bg-red-900 hover:bg-red-700 px-6 py-1 text-white rounded-xl mb-6">
                        <img src="{{ asset('images/icons/back.png') }}" class="w-[20px] h-[20px]" alt="">
                        <span>Back to KPI Library</span>
                    </a>

                    <form action="{{ route('kpis.dashboard') }}" method="GET">
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold mb-4">Find KPIs with...</h3>

                            <div class="flex items-center">
                                <label for="objective" class="font-medium w-[120px]">Objective:</label>
                                <input 
                                    type="text" 
                                    id="objective" 
                                    name="objective"
                                    value="{{ request('objective') }}"
                                    class="flex-1 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500"
                                    placeholder="e.g., G9: UPGRADE CAMPUS FACILITIES & RESOURCES"
                                >
                            </div>

                            <div class="flex items-center">
                                <label for="theme" class="font-medium w-[120px]">Theme:</label>
                                <input 
                                    type="text" 
                                    id="theme" 
                                    name="theme"
                                    value="{{ request('theme') }}"
                                    class="flex-1 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500"
                                    placeholder="e.g., ACADEMIC QUALITY & ORGANIZATIONAL EXCELLENCE"
                                >
                            </div>

                            <div class="flex items-center">
                                <label for="perspective" class="font-medium w-[120px]">Perspective:</label>
                                <input 
                                    type="text" 
                                    id="perspective" 
                                    name="perspective"
                                    value="{{ request('perspective') }}"
                                    class="flex-1 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500"
                                    placeholder="e.g., INTERNAL PROCESS"
                                >
                            </div>

                            <div class="flex items-center">
                                <label for="code" class="font-medium w-[120px]">Code:</label>
                                <input 
                                    type="text" 
                                    id="code" 
                                    name="code"
                                    value="{{ request('code') }}"
                                    class="flex-1 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500"
                                    placeholder="e.g., G9-M1"
                                >
                            </div>

                            <div class="flex items-center">
                                <label for="category" class="font-medium w-[120px]">Category:</label>
                                <select 
                                    id="category" 
                                    name="category"
                                    class="flex-1 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500"
                                >
                                    <option value="">All Categories</option>
                                    <option value="institutional" {{ request('category') == 'institutional' ? 'selected' : '' }}>Institutional</option>
                                    <option value="departmental" {{ request('category') == 'departmental' ? 'selected' : '' }}>Departmental</option>
                                    <option value="personnel" {{ request('category') == 'personnel' ? 'selected' : '' }}>Personnel</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex gap-4 pt-4">
                            <a href="{{ route('kpis.advanced-search') }}" class="px-6 py-2 border border-gray-300 rounded hover:bg-gray-50 transition inline-block text-center">
                                Reset
                            </a>
                            <button type="submit" class="px-6 py-2 bg-red-700 text-white rounded hover:bg-red-600 transition">
                                Search
                            </button>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>
</x-app-layout>