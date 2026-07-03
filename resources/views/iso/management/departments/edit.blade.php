<x-app-layout>
<div class="min-h-screen py-8 bg-gray-50">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('iso.management.departments.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-200 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50 shadow-sm transition-all">
                <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Departments
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <h2 class="text-xl font-bold text-gray-800">Edit Department</h2>
                <p class="text-sm text-gray-500 mt-1">Update details for the selected department. Saving will automatically update all linked employee profiles and ISO documents/tickets in the database.</p>
            </div>

            <!-- Error Alerts -->
            @if ($errors->any())
                <div class="p-4 mx-6 mt-6 bg-red-50 border-l-4 border-red-500 rounded-r-lg text-red-800 text-sm font-medium">
                    <strong class="font-semibold block mb-1">Please fix the following:</strong>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('iso.management.departments.update', $dept->id) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <!-- Parent Cluster Selection -->
                @php
                    $parents = \App\Models\Departments::where('code', 'NOT LIKE', '%-%')->orderBy('code', 'asc')->get();
                    $parts = explode('-', $dept->code);
                    $hasParent = (count($parts) > 1);
                    $initialParent = $hasParent ? $parts[0] : '';
                    
                    // Check if the code itself is a parent (has no hyphen but matches a parent code)
                    $isParentDirectly = !$hasParent && $parents->contains('code', $dept->code);
                    if ($isParentDirectly) {
                        $initialParent = $dept->code;
                    }
                    
                    $initialSub = $hasParent ? implode('-', array_slice($parts, 1)) : '';
                @endphp
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="parent_code" class="block text-sm font-bold text-gray-700 mb-1">Parent Cluster/Department</label>
                        <select id="parent_code" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-950 focus:border-red-950 bg-white">
                            <option value="">-- Custom / No Parent Cluster --</option>
                            @foreach($parents as $p)
                                <option value="{{ $p->code }}" {{ $initialParent == $p->code ? 'selected' : '' }}>{{ $p->code }} - {{ $p->dept }}</option>
                            @endforeach
                        </select>
                        <small class="text-gray-400 block mt-1">Select an existing cluster code to nest under.</small>
                    </div>

                    <div>
                        <label for="sub_code" class="block text-sm font-bold text-gray-700 mb-1">Sub-Office Code (Suffix)</label>
                        <input type="text" 
                               id="sub_code" 
                               value="{{ $initialSub }}"
                               placeholder="e.g. BED" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-950 focus:border-red-950">
                        <small class="text-gray-400 block mt-1">e.g., BED for Basic Education.</small>
                    </div>
                </div>

                <!-- Final Combined Code -->
                <div>
                    <label for="code" class="block text-sm font-bold text-gray-700 mb-1">Final Department Code <span class="text-red-500">*</span></label>
                    <input type="text" 
                           name="code" 
                           id="code" 
                           value="{{ old('code', $dept->code) }}" 
                           required 
                           placeholder="e.g. AAC-BED" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-950 focus:border-red-950">
                    <small class="text-gray-400 block mt-1">This is the unique identifier saved in the database.</small>
                </div>

                <!-- Department Name -->
                <div>
                    <label for="dept" class="block text-sm font-bold text-gray-700 mb-1">Department Name <span class="text-red-500">*</span></label>
                    <input type="text" 
                           name="dept" 
                           id="dept" 
                           value="{{ old('dept', $dept->dept) }}" 
                           required 
                           placeholder="e.g. Basic Education" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-950 focus:border-red-950">
                    <small class="text-gray-400 block mt-1">The full official name of the department (e.g. Office of Institutional Effectiveness).</small>
                </div>

                <!-- Form Footer Buttons -->
                <div class="pt-4 border-t border-gray-100 flex justify-end gap-3">
                    <a href="{{ route('iso.management.departments.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm font-semibold transition-all">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-2 text-white rounded-lg text-sm font-semibold transition-all shadow-sm" style="background-color: #800000; color: #ffffff;">
                        Update Department
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const parentSelect = document.getElementById('parent_code');
        const subInput = document.getElementById('sub_code');
        const codeInput = document.getElementById('code');

        function updateCode() {
            const parent = parentSelect.value.trim().toUpperCase();
            const sub = subInput.value.trim().toUpperCase();

            if (parent && sub) {
                codeInput.value = `${parent}-${sub}`;
                codeInput.readOnly = true;
                codeInput.classList.add('bg-gray-50');
            } else if (parent) {
                codeInput.value = parent;
                codeInput.readOnly = true;
                codeInput.classList.add('bg-gray-50');
            } else {
                codeInput.readOnly = false;
                codeInput.classList.remove('bg-gray-50');
            }
        }

        parentSelect.addEventListener('change', updateCode);
        subInput.addEventListener('input', updateCode);
        
        // Run once on load to initialize readOnly state
        updateCode();
    });
</script>
</x-app-layout>
