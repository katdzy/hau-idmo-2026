<x-app-layout>
<div class="min-h-screen py-8 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb & Back -->
        <div class="mb-6 flex justify-between items-center">
            <a href="{{ route('iso.management.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-200 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50 shadow-sm transition-all">
                <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Dashboard
            </a>
            
            <a href="{{ route('iso.management.departments.create') }}" class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-semibold text-white shadow-sm transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-900" style="background-color: #800000; color: #ffffff;">
                <svg class="w-5 h-5 mr-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                </svg>
                Add Department
            </a>
        </div>

        <!-- Session Message -->
        @if (session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-r-lg text-emerald-800 text-sm font-medium shadow-sm flex items-center">
                <svg class="w-5 h-5 mr-3 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- Card Container -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">ISO Departments Directory</h2>
                    <p class="text-sm text-gray-500 mt-1">Manage originating sections, specific offices, and their logos.</p>
                </div>

                <!-- Search & Filter Form -->
                <form method="GET" action="{{ route('iso.management.departments.index') }}" class="w-full md:w-[600px] flex gap-2">
                    <!-- Cluster Filter -->
                    <select name="cluster" onchange="this.form.submit()" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-900 focus:border-red-900 bg-white">
                        <option value="">All Clusters</option>
                        <option value="AAC" {{ ($cluster ?? '') == 'AAC' ? 'selected' : '' }}>Academic Affairs (AAC)</option>
                        <option value="AIE" {{ ($cluster ?? '') == 'AIE' ? 'selected' : '' }}>Academic Innovation (AIE)</option>
                        <option value="ICFSI" {{ ($cluster ?? '') == 'ICFSI' ? 'selected' : '' }}>Institute for Catholic Formation & Social Integration (ICFSI)</option>
                        <option value="CSD" {{ ($cluster ?? '') == 'CSD' ? 'selected' : '' }}>Campus Services (CSD)</option>
                        <option value="EAC" {{ ($cluster ?? '') == 'EAC' ? 'selected' : '' }}>External Affairs (EAC)</option>
                        <option value="FRM" {{ ($cluster ?? '') == 'FRM' ? 'selected' : '' }}>Finance & Resources (FRM)</option>
                        <option value="HRO" {{ ($cluster ?? '') == 'HRO' ? 'selected' : '' }}>Human Resources (HRO)</option>
                        <option value="IAT" {{ ($cluster ?? '') == 'IAT' ? 'selected' : '' }}>Internal Audit (IAT)</option>
                        <option value="OIE" {{ ($cluster ?? '') == 'OIE' ? 'selected' : '' }}>Institutional Effectiveness (OIE)</option>
                        <option value="OOP" {{ ($cluster ?? '') == 'OOP' ? 'selected' : '' }}>Office of the President (OOP)</option>
                        <option value="RSS" {{ ($cluster ?? '') == 'RSS' ? 'selected' : '' }}>Records Systems (RSS)</option>
                        <option value="SSA" {{ ($cluster ?? '') == 'SSA' ? 'selected' : '' }}>Student Services (SSA)</option>
                    </select>

                    <input type="text" 
                           name="query" 
                           value="{{ $query ?? '' }}"
                           placeholder="Search name/code..." 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-900 focus:border-red-900">
                    
                    <button type="submit" class="px-4 py-2 bg-gray-800 hover:bg-gray-700 text-white rounded-lg text-sm font-semibold transition-all">
                        Search
                    </button>
                    @if(!empty($query) || !empty($cluster))
                        <a href="{{ route('iso.management.departments.index') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg text-sm font-semibold transition-all flex items-center">
                            Clear
                        </a>
                    @endif
                </form>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100 text-xs font-bold text-gray-500 uppercase tracking-wider">
                            <th class="px-6 py-4">Code</th>
                            <th class="px-6 py-4">Department Name</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm text-gray-600">
                        @forelse($departments as $dept)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 font-semibold text-gray-900">{{ $dept->code }}</td>
                                <td class="px-6 py-4">{{ $dept->dept }}</td>
                                <td class="px-6 py-4 text-right flex justify-end gap-2">
                                    <a href="{{ route('iso.management.departments.edit', $dept->id) }}" class="inline-flex items-center p-2 bg-amber-50 hover:bg-amber-100 text-amber-700 border border-amber-200 rounded-lg transition-all" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </a>
                                    
                                    <form action="{{ route('iso.management.departments.destroy', $dept->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this department? All associated users and documents will lose this reference.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center p-2 bg-red-50 hover:bg-red-100 text-red-700 border border-red-200 rounded-lg transition-all" title="Delete">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-gray-400 italic">
                                    No department records found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($departments->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                    {{ $departments->appends(['query' => $query, 'cluster' => $cluster])->links() }}
                </div>
            @endif
        </div>

    </div>
</div>
</x-app-layout>
