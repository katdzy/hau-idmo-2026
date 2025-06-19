<!-- resources/views/admin/loads/sub/main.blade.php -->

<x-app-layout>
    <div class="min-h-screen">
        <div class="w-full flex justify-center py-8">
            <div class="w-[95%] flex flex-col p-8 bg-white rounded-xl">
            
                <a href="{{ route('admin.loads.db') }}" class="w-[15%] rounded-lg flex items-center justify-center py-2 bg-red-900 text-white font-bold mb-4 gap-1 hover:bg-red-700">
                    <img src="{{ asset('images/icons/back.png') }}" class="w-[20px] h-[20px]" alt="Back">
                    <span>Return to Tools</span>
                </a>

                <div class="flex flex-col gap-0 leading-tight mb-4">
                    <h1 class="text-gray-600 font-bold text-[2rem]">Loads by Subject</h1>
                    <span class="text-gray-400 text-sm">Teaching Loads Organized by Subject</span>
                </div>

                <!-- Table of Subjects and Their Loads -->
                <table class="w-full bg-white border border-gray-100">
                    <thead>
                        <tr class="w-full bg-red-900 text-gray-800 text-white">
                            <th class="py-2 px-4 text-left">Subject Code</th>
                            <th class="py-2 px-4 text-left">Subject Name</th>
                            <th class="py-2 px-4 text-left">Units</th>
                            <th class="py-2 px-4 text-left">Number of Loads</th>
                            <th class="py-2 px-4 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="subject-list">
                        @foreach($subjects as $subject)
                            <tr class="border-b text-gray-500">
                                <td class="py-2 px-4">{{ $subject->subj_code }}</td>
                                <td class="py-2 px-4">{{ $subject->subj_title }}</td>
                                <td class="py-2 px-4">{{ $subject->units }}</td>
                                <td class="py-2 px-4">{{ $subject->loads->count() }}</td>
                                <td class="py-2 px-4">
                                    <a href="{{ route('admin.lbs.view', ['id' => $subject->subj_id]) }}" class="flex items-center justify-center p-1 bg-red-900 hover:bg-red-800 rounded">
                                        <img src="{{ asset('images/icons/right.png') }}" alt="View" class="w-[20px] h-[20px]">
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination Links -->
                <div class="mt-4">
                    {{ $subjects->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    #sel { 
        display: none; 
    }
</style>

<script>
    // Removed or updated JavaScript related to the search bar since it's no longer present.

    let checkedItems = new Set();

    // If you still have functionalities that depend on checkboxes or other elements, ensure they are present in the blade.
    // Otherwise, remove related JavaScript to prevent errors.

    function updateSelectedCount() {
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        const selectedCount = Array.from(checkboxes).filter(checkbox => checkbox.checked).length;

        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                checkedItems.add(checkbox.value);
            } else {
                checkedItems.delete(checkbox.value);
            }
        });

        if (selectedCount > 0) {
            document.getElementById('sel').style.display = 'flex';
            document.getElementById('selectedCount').textContent = `Selected Subject/s: ${selectedCount}`;
        } else {
            document.getElementById('sel').style.display = 'none';
        }
    }

    function resetSelect() {
        document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => checkbox.checked = false);
        checkedItems.clear();
        updateSelectedCount();
    }

    function confirmDelete(button) {
        if (confirm('Are you sure you want to delete selected subject/s?')) {
            button.closest('form').submit();
        }
    }
</script>
