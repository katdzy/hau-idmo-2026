<div id="filter_modal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="text-xl font-bold text-purple-700">Filter Documents</h2>
            <button id="close_filter_modal" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        </div>
        <div class="modal-body">
            <form id="filter_form">
                <!-- Source Type Filter -->
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Source Type</label>
                    <div class="grid grid-cols-3 gap-2">
                        @php
                            $sourceTypes = \App\Models\IsoMasterDocument::distinct()
                                ->pluck("source_type")
                                ->filter()
                                ->sort();
                        @endphp
                        @foreach ($sourceTypes as $type)
                            <label class="flex items-center bg-gray-50 p-2 rounded hover:bg-gray-100 cursor-pointer">
                                <input type="checkbox" name="source_type[]" value="{{ $type }}" class="mr-2 text-purple-500 focus:ring-purple-500">
                                <span class="text-sm">{{ $type }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                
                <hr class="my-4">
                <!-- Department/Office Filter -->
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Department/Office</label>
                    <!-- Search box for departments -->
                    <input type="text"
                        id="dept_search"
                        placeholder="Search departments..."
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg mb-3 focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <!-- Get unique departments -->
                    <div class="max-h-60 overflow-y-auto border border-gray-200 rounded-lg p-2">
                        @php
                            $departments = \App\Models\IsoMasterDocument::distinct()
                                ->pluck('originating_section')
                                ->filter()
                                ->sort();
                        @endphp
                        @foreach ($departments as $dept)
                            <label class="dept-item flex items-center bg-gray-50 p-2 mb-1 rounded hover:bg-gray-100 cursor-pointer" data-debt="{{ strtolower($dept) }}">
                                <input type="checkbox" name="originating_section[]" value="{{ $dept }}" class="mr-2 text-purple-500 focus:ring-purple-500">
                                <span class="text-sm">{{ $dept }}</span>
                            </label>
                        @endforeach
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
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Document Status</label>
                    <div class="grid grid-cols-3 gap-2">
                        <label class="flex items-center bg-green-50 p-2 rounded hover:bg-green-100 cursor-pointer">
                            <input type="radio" name="status[]" value="Active" class="mr-2 text-green-500 focus:ring-green-500" checked>
                            <span class="text-sm">All Documents</span>
                        </label>
                        <label class="flex items-center bg-yellow-50 p-2 rounded hover:bg-yellow-100 cursor-pointer">
                            <input type="radio" name="status[]" value="Superseded" class="mr-2 text-yellow-500 focus:ring-yellow-500" checked>
                            <span class="text-sm">Original Documents Only</span>
                        </label>
                        <label class="flex items-center bg-red-50 p-2 rounded hover:bg-red-100 cursor-pointer">
                            <input type="radio" name="status[]" value="Deleted" class="mr-2 text-red-500 focus:ring-red-500" checked>
                            <span class="text-sm">Documents with Revisions</span>
                        </label>
                    </div>
                </div>
                <!-- Action Buttons -->
                <div class="flex justify-end gap-3 mt-6">
                    <button type="button"
                            id="clear_all_filters"
                            class="px- py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-semibold">
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