<div id="filter_modal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="text-xl font-bold text-purple-700">Filter Documents</h2>
            <button id="close_filter_modal" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        </div>
        <div class="modal-body">
            <form id="filter_form">
                <!-- Search Filter -->
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Search Documents</label>
                    <div class="relative">
                        <input type="text"
                                name="search"
                                id="search_input"
                                placeholder="Search by code, title, or type..."
                                class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        <svg class="absolute left-3 top-3 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <button type="button"
                                id="clear_search_button"
                                onclick="clearSearch()"
                                class="hidden absolute right-3 top-3 text-gray-400 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Search in: Document Code, Document Title, Source Type or Specific Type</p>
                </div>
                <hr class="my-4">
                <!-- Source Type Filter -->
                <div class="mb-4">
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Source Type</label>
                        <button type="button"
                                onclick="toggleAllCheckboxes('source_type', this)"
                                class="text-xs text-purple-600 hover:text-purple-800 font-semibold underline">
                            Select All
                        </button>
                    </div>
                    <div class="grid grid-cols-3 gap-2">
                        @php
                            $sourceTypes = \App\Models\IsoMasterDocument::distinct()
                                ->pluck("source_type")
                                ->filter()
                                ->sort();
                        @endphp
                        @foreach ($sourceTypes as $type)
                            @php
                                $label = $typeConfig[$type]['label'] ?? ucfirst($type);
                            @endphp
                            <label class="flex items-center bg-gray-50 p-2 rounded hover:bg-gray-100 cursor-pointer">
                                <input type="checkbox" name="source_type[]" value="{{ $type }}" class="mr-2 text-purple-500 focus:ring-purple-500">
                                <span class="text-sm">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                
                <hr class="my-4">
                <!-- Department/Office Filter -->
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Department</label>
                    <select id="filter_department" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <option value="">All Departments</option>
                        <option value="aac">Academic Affairs Cluster (AAC)</option>
                        <option value="aie">Institute for Academic Innovation & Entrepreneurship (AIE)</option>
                        <option value="icfsi">Institute for Christian Formation & Social Integration (ICFSI)</option>
                        <option value="csd">Campus Services & Development Office (CSD)</option>
                        <option value="eac">External Affairs Cluster (EAC)</option>
                        <option value="frm">Finance & Resources Management Services (FRM)</option>
                        <option value="hro">Human Resource Management Office (HRO)</option>
                        <option value="oie">Office of Institutional Effectiveness (OIE)</option>
                        <option value="oop">Office of the President (OOP)</option>
                        <option value="rss">Records Services & Affairs (RSS)</option>
                        <option value="ssa">Student Services & Affairs (SSA)</option>
                    </select>
                </div>
                <!-- Offices Checkboxes -->
                <div class="mb-4" id="offices_container"style="display:none;">
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Specific Offices</label>
                        <button type="button"
                                    onclick="toggleAllCheckboxes('originating_section', this)"
                                    class="text-xs text-purple-600 hover:text-purple-800 font-semibold underline">
                                Select All
                        </button>
                    </div>
                    <div class="max-h-60 overflow-y-auto border border-gray-200 rounded-lg p-3 bg-gray-50">
                        <div id="offices_checkboxes">
                            <!-- Will be populated via JS -->
                        </div>
                    </div>
                </div>
                <hr class="my-4">

                <!-- Revision Status Filter -->
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Revision Status</label>
                    <div class="space-y">
                        <label class="flex items-center bg-gray-50 p-2 rounded hover:bg-gray-100 cursor-pointer">
                            <input type="radio" name="revision_filter" value="all" class="mr-2 text-purple-500 focus:ring-purple-500" checked>
                            <span class="text-sm">All Documents</span>
                        </label>
                        <label class="flex items-center bg-gray-50 p-2 rounded hover:bg-gray-100 cursor-pointer">
                            <input type="radio" name="revision_filter" value="original_only" class="mr-2 text-purple-500 focus:ring-purple-500" checked>
                            <span class="text-sm">Original Documents Only</span>
                        </label>
                        <label class="flex items-center bg-gray-50 p-2 rounded hover:bg-gray-100 cursor-pointer">
                            <input type="radio" name="revision_filter" value="has_revisions" class="mr-2 text-purple-500 focus:ring-purple-500" checked>
                            <span class="text-sm">Documents with Revisions</span>
                        </label>
                    </div>
                </div>

                <hr class="my-4">
                
                <!-- Document Status Filter -->
                <div class="mb-4">
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Document Status</label>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-xs text-gray-400 italic mr-2">Uncheck to exclude from the filter. </span>
                            <button type="button"
                                        onclick="toggleAllCheckboxes('status', this)"
                                        class="text-xs text-purple-600 hover:text-purple-800 font-semibold underline">
                                    Select All
                            </button>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-2">
                        <label class="flex items-center bg-green-50 p-2 rounded hover:bg-green-100 cursor-pointer">
                            <input type="checkbox" name="status[]" value="Active" class="mr-2 text-green-500 focus:ring-green-500" checked>
                            <span class="text-sm">Active</span>
                        </label>
                        <label class="flex items-center bg-yellow-50 p-2 rounded hover:bg-yellow-100 cursor-pointer">
                            <input type="checkbox" name="status[]" value="Superseded" class="mr-2 text-yellow-500 focus:ring-yellow-500" checked>
                            <span class="text-sm">Superseded</span>
                        </label>
                        <label class="flex items-center bg-red-50 p-2 rounded hover:bg-red-100 cursor-pointer">
                            <input type="checkbox" name="status[]" value="Deleted" class="mr-2 text-red-500 focus:ring-red-500" checked>
                            <span class="text-sm">Deleted</span>
                        </label>
                    </div>
                </div>
                <!-- Action Buttons -->
                <div class="flex justify-end gap-3 mt-6">
                    <button type="button"
                            id="clear_all_filters"
                            class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-semibold">
                        Clear All
                    </button>
                    <button type="submit"
                            class="px-6 py-2 bg-purple-500 hover:bg-purple-600 text-white rounded-lg font-semibold">
                        Apply Filters
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>