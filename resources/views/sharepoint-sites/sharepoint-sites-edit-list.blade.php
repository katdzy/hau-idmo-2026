<x-app-layout>
    <!-- This is where the table of links to choose which one to edit -->
    <div class="p-6">
        @if(session('msg'))
            <div id="success-msg-popup" style="position:fixed;top:90px;left:50%;transform:translateX(-50%);z-index:9999;min-width:300px;max-width:90vw;box-shadow:0 2px 12px rgba(0,0,0,0.15);background:#d1fae5;border:2px solid #10b981;color:#065f46;padding:18px 32px;font-size:1.1rem;border-radius:12px;text-align:center;transition:opacity 0.7s;">
                <strong>Success!</strong> {{ session('msg') }}
            </div>
            <script>
                setTimeout(function() {
                    var msg = document.getElementById('success-msg-popup');
                    if (msg) {
                        msg.style.opacity = '0';
                        setTimeout(function() { msg.style.display = 'none'; }, 700);
                    }
                }, 3000);
            </script>
        @endif
        <h1 class="text-2xl font-bold mb-4">Select a Link to Edit</h1>

        <!-- Back Button -->
        <a href="{{ route('sharepoint-sites.dashboard') }}" 
           class="inline-flex items-center bg-red-900 hover:bg-red-700 text-white px-4 py-2 rounded mb-4 transition">
            <img src="{{ asset('images/icons/back.png') }}" class="w-4 h-4 mr-2" alt="Back Icon">
            Return to Dashboard
        </a>

        <!-- Search Bar -->
        <div class="mb-6">
            <div class="relative">
                <input
                    type="text"
                    id="searchInput"
                    placeholder="Search by label..."
                    class="w-full rounded-lg px-4 py-3 pr-20 shadow-sm text-sm focus:outline-none"
                    style="border: 2px solid #70121D;"
                    autocomplete="off"
                />
                <button type="button" id="clearSearchBtn" class="absolute right-2 px-3 py-1 rounded-lg text-xs font-semibold transition" style="top: 50%; transform: translateY(-50%); background-color: #ffe066; color: #70121D;">
                    Clear
                </button>
            </div>
        </div>

        <div class="overflow-y-auto max-h-[70vh] border">
            <table class="table-auto w-full">
                <thead class="bg-gray-100 sticky top-0 z-10 shadow-sm">
                    <tr>
                        <th class="px-4 py-2 bg-gray-100 border-b-2 border-gray-200">
                            <button id="sortLabelBtn" class="flex items-center justify-center w-full hover:text-red-900 transition">
                                <span>Label</span>
                                <span id="sortLabelIcon" class="ml-2 text-xs">▼</span>
                            </button>
                        </th>
                        <th class="px-4 py-2 bg-gray-100 border-b-2 border-gray-200">
                            <button id="sortCategoryBtn" class="flex items-center justify-center w-full hover:text-red-900 transition">
                                <span>Category</span>
                                <span id="sortCategoryIcon" class="ml-2 text-xs">▼</span>
                            </button>
                        </th>
                        <th class="px-4 py-2 bg-gray-100 border-b-2 border-gray-200">
                            <button id="sortDepartmentBtn" class="flex items-center justify-center w-full hover:text-red-900 transition">
                                <span>Department</span>
                                <span id="sortDepartmentIcon" class="ml-2 text-xs">▼</span>
                            </button>
                        </th>
                        <th class="px-4 py-2 bg-gray-100 border-b-2 border-gray-200">
                            <button id="sortOfficeBtn" class="flex items-center justify-center w-full hover:text-red-900 transition">
                                <span>Office</span>
                                <span id="sortOfficeIcon" class="ml-2 text-xs">▼</span>
                            </button>
                        </th>
                        <th class="px-4 py-2 bg-gray-100 border-b-2 border-gray-200">Actions</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @foreach ($links as $link)
                        <tr class="border-t searchable-row" data-label="{{ $link->label }}" data-category="{{ $link->category }}" data-department="{{ $link->department }}" data-office="{{ $link->office }}">
                            <td class="px-4 py-2 label-cell">{{ $link->label }}</td>
                            <td class="px-4 py-2 category-cell">{{ $link->category }}</td>
                            <td class="px-4 py-2 department-cell">{{ $link->department }}</td>
                            <td class="px-4 py-2 office-cell">{{ $link->office }}</td>
                            <td class="px-4 py-2">
                                <div class="flex gap-2">
                                    <a href="{{ route('sharepoint-sites.edit', ['id' => $link->id]) }}"
                                       class="bg-red-900 text-white px-3 py-1 rounded hover:bg-red-700 transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('sharepoint-sites.delete', ['id' => $link->id]) }}" 
                                          method="POST" 
                                          class="inline"
                                          onsubmit="return confirm('Are you sure you want to delete this link: {{ $link->label }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="bg-red-100 hover:bg-red-200 text-red-700 px-3 py-1 rounded transition">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- No Results Message -->
        <div id="noResults" class="hidden text-center py-8 text-gray-500">
            No links found matching your search.
        </div>

        <script>
            const searchInput = document.getElementById('searchInput');
            const clearSearchBtn = document.getElementById('clearSearchBtn');
            const noResults = document.getElementById('noResults');
            const tableBody = document.getElementById('tableBody');

            // Sort functionality
            let sortStates = {
                label: 'asc',
                category: 'asc',
                department: 'asc',
                office: 'asc'
            };

            function sortTable(column) {
                const rows = Array.from(document.querySelectorAll('.searchable-row'));
                const currentState = sortStates[column];
                const newState = currentState === 'asc' ? 'desc' : 'asc';
                sortStates[column] = newState;

                // Update all icons to default
                document.querySelectorAll('[id^="sort"][id$="Icon"]').forEach(icon => {
                    icon.textContent = '▼';
                    icon.style.color = '';
                });

                // Update current column icon
                const icon = document.getElementById(`sort${column.charAt(0).toUpperCase() + column.slice(1)}Icon`);
                icon.textContent = newState === 'asc' ? '▲' : '▼';
                icon.style.color = '#70121D';

                rows.sort((a, b) => {
                    const aValue = a.dataset[column].toLowerCase();
                    const bValue = b.dataset[column].toLowerCase();
                    
                    if (newState === 'asc') {
                        return aValue.localeCompare(bValue);
                    } else {
                        return bValue.localeCompare(aValue);
                    }
                });

                // Re-append rows in sorted order
                rows.forEach(row => tableBody.appendChild(row));
            }

            document.getElementById('sortLabelBtn').addEventListener('click', () => sortTable('label'));
            document.getElementById('sortCategoryBtn').addEventListener('click', () => sortTable('category'));
            document.getElementById('sortDepartmentBtn').addEventListener('click', () => sortTable('department'));
            document.getElementById('sortOfficeBtn').addEventListener('click', () => sortTable('office'));

            function highlightText(text, searchTerm) {
                if (!searchTerm) return text;
                
                const regex = new RegExp(`(${searchTerm.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')})`, 'gi');
                return text.replace(regex, '<span class="search-highlight">$1</span>');
            }

            function performSearch() {
                const searchValue = searchInput.value.toLowerCase().trim();
                const rows = document.querySelectorAll('.searchable-row');
                let visibleCount = 0;

                rows.forEach(row => {
                    const labelCell = row.querySelector('.label-cell');
                    
                    // Get original text from data attributes
                    const label = row.dataset.label.toLowerCase();

                    // Reset label cell to original text first
                    labelCell.innerHTML = row.dataset.label;

                    // Search by label only
                    if (searchValue === '' || label.includes(searchValue)) {
                        row.style.display = '';
                        visibleCount++;
                        
                        // Highlight the label if it matches
                        if (searchValue !== '' && label.includes(searchValue)) {
                            labelCell.innerHTML = highlightText(row.dataset.label, searchValue);
                        }
                    } else {
                        row.style.display = 'none';
                    }
                });

                // Show/hide no results message
                if (visibleCount === 0 && searchValue !== '') {
                    noResults.classList.remove('hidden');
                } else {
                    noResults.classList.add('hidden');
                }
            }

            searchInput.addEventListener('input', performSearch);
            
            clearSearchBtn.addEventListener('click', function() {
                searchInput.value = '';
                performSearch();
                searchInput.focus();
            });
        </script>

        <style>
            #clearSearchBtn:hover {
                background-color: #ffd700 !important;
            }

            #searchInput:focus {
                outline: none;
                box-shadow: 0 0 0 2px rgba(112, 18, 29, 0.2);
            }

            .search-highlight {
                background-color: #8B1538;
                color: #ffffff !important;
                padding: 0.15rem 0.25rem;
                border-radius: 0.25rem;
            }

            thead button {
                font-weight: 600;
            }

            thead button:hover span:first-child {
                color: #70121D;
            }
        </style>
    </div>
</x-app-layout>