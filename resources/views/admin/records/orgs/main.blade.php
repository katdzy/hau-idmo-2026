<x-app-layout>
    <div class="min-h-screen">
        <div class="w-full flex justify-center py-8">
            <div class="w-[95%] flex flex-col items-start p-8 bg-white rounded-xl">
                <!-- Return Button -->
                <a href="{{ route('admin.records') }}" class="flex gap-1 items-center justify-center bg-red-900 hover:bg-red-700 px-6 py-1 text-white rounded-xl">
                    <img src="{{ asset('images/icons/back.png') }}" class="w-[20px] h-[20px]" alt="Back">
                    <span>Return to User Management</span>
                </a>

                <!-- Header -->
                <div class="flex flex-col gap-0 leading-tight mb-2">
                    <h1 class="text-gray-600 font-bold text-[2rem]">User Organizations</h1>
                    <span class="text-gray-400 text-sm">Manage Organizations</span>
                </div>

                <!-- Search Bar -->
                <input type="text" id="search" placeholder="Search organizations..." class="w-full border border-gray-300 p-2 rounded-md mb-4">

                <!-- Delete Form -->
                <form method="POST" action="{{ route('admin.orgs.delete') }}" class="w-full bg-white rounded-lg flex flex-col">
                    <div id="sel" class="mb-4 w-full bg-red-600 bg-opacity-100 backdrop-blur-lg px-4 py-1 rounded-xl flex items-center gap-4 justify-center">
                        <button type="button" onclick="resetSelect()" class="text-white hover:text-gray-100 underline">
                            Cancel
                        </button>
                        <span id="selectedCount" class="text-white font-extrabold">
                            Selected Organization/s: 0
                        </span>
                        <button type="button" onclick="confirmDelete(this)" class="ml-auto flex items-center justify-center text-white px-4 py-1 rounded-md hover:bg-red-800">
                            <img src="{{ asset('images/icons/delete.png') }}" alt="Delete" class="w-[20px] h-[20px]">
                            <span>Delete</span>
                        </button>
                    </div>

                    @csrf
                    @method('DELETE')

                    <table class="w-full bg-white h-[100px] overflow-y-auto">
                        <thead>
                            <tr class="w-full bg-red-900 text-white">
                                <th class="py-2 px-4 text-left"></th>
                                <th class="py-2 px-4 text-left">Organization</th>
                                <th class="py-2 px-4 text-left">Members</th>
                            </tr>
                        </thead>
                        <tbody id="subject-list">
                            @foreach($data as $option)
                                <tr class="border-b hover:bg-gray-100 text-gray-500">
                                    <td class="py-2 px-4">
                                        <input type="checkbox" id="option_{{ $loop->index }}" name="items[]" value="{{ $option->org }}"
                                            class="w-4 h-4 text-red-900 border-gray-300 rounded focus:ring-red-500"
                                            ${isChecked ? 'checked' : ''} onchange="updateSelectedCount()">
                                    </td>
                                    <td class="py-2 px-4">
                                        <a href="{{ route('admin.orgs.view', ['id' => $option->org]) }}"
                                           class="hover:text-blue-900 hover:underline">
                                            {{ $option->org }}
                                        </a>
                                    </td>
                                    <td class="py-2 px-4">{{ $option->total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tbody>
                        </tbody>
                    </table>
                    @if($data->count() == 0)
                        <div class="w-full text-center">
                            <h1 class="text-gray-400 pb-16">No data found.</h1>
                        </div>
                    @endif
                </form>
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
    let checkedItems = new Set();

    document.getElementById('search').addEventListener('input', function() {
        let searchQuery = this.value;
        fetchData(searchQuery);
    });

    function fetchData(query) {
        fetch(`{{ route('admin.orgs.search') }}?query=${query}`)
            .then(response => response.json())
            .then(data => {
                let tbody = document.getElementById('subject-list');
                tbody.innerHTML = ''; // Clear current list

                data.forEach(subject => {
                    const isChecked = checkedItems.has(subject.org);
                    let row = `
                        <tr class="border-b hover:bg-gray-100 text-gray-500">
                            <td class="py-2 px-4">
                                <input type="checkbox" id="option_${subject.org}" name="items[]" value="${subject.org}"
                                    class="w-4 h-4 text-red-900 border-gray-300 rounded focus:ring-red-500"
                                    ${isChecked ? 'checked' : ''} onchange="updateSelectedCount()">
                            </td>
                            <td class="py-2 px-4">
                                <a href="" class="hover:text-blue-900 hover:underline">
                                    ${subject.org}
                                </a>
                            </td>
                            <td class="py-2 px-4">${subject.total}</td>
                        </tr>
                    `;
                    tbody.innerHTML += row;
                });
                updateSelectedCount();
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }

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
            document.getElementById('selectedCount').textContent = `Selected Organization/s: ${selectedCount}`;
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
        if (confirm('Are you sure you want to delete selected organization/s?')) {
            button.closest('form').submit();
        }
    }
</script>
