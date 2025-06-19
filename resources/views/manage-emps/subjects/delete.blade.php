<x-app-layout>
    <div class="min-h-screen">
        <div class="w-full flex justify-center py-8">
            <div class="w-[95%] flex flex-col items-start p-8 bg-white rounded-xl">

                <a href="{{ route('admin.subjects') }}"
                class="flex gap-1 items-center justify-center bg-red-900 hover:bg-red-700 px-6 py-1 text-white rounded-xl">
                    <img src="{{ asset('images/icons/back.png') }}" class="w-[20px] h-[20px]" alt="">
                    <span>Return to Subjects</span>
                </a>

                <div class="flex flex-col gap-0 leading-tight mb-2">
                    <h1 class="text-gray-600 font-bold text-[2rem]">Subjects</h1>
                    <span class="text-gray-400 text-sm">Delete Subject/s</span>
                </div>

                <!-- Search Bar -->
                <input 
                    type="text"
                    id="search"
                    placeholder="Search subjects..."
                    class="w-full border border-gray-300 p-2 rounded-md mb-4"
                >

                <!-- Single Form for Deletion -->
                <form id="deleteForm" method="POST" action="{{ route('admin.subjects.delete') }}" class="w-full bg-white rounded-lg">
                    @csrf
                    @method('DELETE')

                    <!-- The selection bar -->
                    <div class="mb-4 w-full bg-red-600 bg-opacity-100 backdrop-blur-lg px-4 py-1 rounded-xl flex items-center gap-4 justify-center"
                        id="sel" style="display: none;">
                        <button type="button" onclick="resetSelect()" class="text-white hover:text-gray-100 underline">
                            Cancel
                        </button>
                        <span id="selectedCount" class="text-white font-extrabold">Selected Subject/s: 0</span>
                        <button type="button"
                                class="ml-auto flex items-center justify-center text-white px-4 py-1 rounded-md hover:bg-red-800"
                                onclick="confirmDelete()">
                            <img src="{{ asset('images/icons/delete.png') }}" alt="" class="w-[20px] h-[20px]">
                            <span>Delete</span>
                        </button>
                    </div>

                    <!-- CONTAINER where the partial HTML will be injected -->
                    <div id="table-container">
                        {{-- We’ll load the partial with AJAX on page load --}}
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        /* Initially hide the selection bar */
        #sel { display: none; }
    </style>

    <script>
        // We store the selected subj_ids here, so they persist across pages/searches
        let checkedItems = new Set();
        let currentPage = 1;     // Keep track of the current page
        let searchQuery = '';    // Current search query (if any)

        document.addEventListener('DOMContentLoaded', function() {
            // 1) Load the table data (page=1, no search) on initial visit
            loadTableData();

            // 2) Attach event listener for search box
            const searchBox = document.getElementById('search');
            searchBox.addEventListener('input', function() {
                searchQuery = this.value.trim();
                currentPage = 1; // Usually, when search changes, go back to page 1
                loadTableData();
            });
        });

        // Called whenever we need to fetch data from server (pagination or search)
        function loadTableData() {
            // Build the URL to our partial route
            let url = "{{ route('admin.subjects.deletePartial') }}"
                      + "?page=" + currentPage
                      + "&q=" + encodeURIComponent(searchQuery);

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    // data.html is the rendered partial
                    document.getElementById('table-container').innerHTML = data.html;

                    // Re-check any items in 'checkedItems' in the new table
                    recheckSelectedItems();

                    // Bind events to the new checkboxes and pagination links
                    bindCheckboxEvents();
                    bindPaginationLinks();
                });
        }

        function bindCheckboxEvents() {
            // All checkboxes in the newly loaded partial
            const checkboxes = document.querySelectorAll('input[name="items[]"]');
            checkboxes.forEach(checkbox => {
                // Mark as checked if it's in our set
                if (checkedItems.has(checkbox.value)) {
                    checkbox.checked = true;
                }

                // On change, update the global set
                checkbox.addEventListener('change', function() {
                    if (this.checked) {
                        checkedItems.add(this.value);
                    } else {
                        checkedItems.delete(this.value);
                    }
                    updateSelectedCount();
                });
            });
            // Update the bar visibility
            updateSelectedCount();
        }

        function bindPaginationLinks() {
            // If you're using default Tailwind pagination,
            // it’s often wrapped in a <nav> with role="navigation".
            const pageLinks = document.querySelectorAll('#table-container nav[role="navigation"] a');
            
            pageLinks.forEach(link => {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    
                    const urlObj = new URL(this.href);
                    currentPage = urlObj.searchParams.get('page') || 1;
                    loadTableData();  // AJAX call
                });
            });
        }

        function recheckSelectedItems() {
            // When we load new rows, if any row's subj_id is in checkedItems, we check it
            document.querySelectorAll('input[name="items[]"]').forEach(chk => {
                if (checkedItems.has(chk.value)) {
                    chk.checked = true;
                }
            });
        }

        function updateSelectedCount() {
            const count = checkedItems.size;
            if (count > 0) {
                document.getElementById('sel').style.display = 'flex';
                document.getElementById('selectedCount').textContent = `Selected Subject/s: ${count}`;
            } else {
                document.getElementById('sel').style.display = 'none';
            }
        }

        function resetSelect() {
            // Uncheck everything in the UI
            document.querySelectorAll('input[name="items[]"]').forEach(chk => (chk.checked = false));
            // Clear from global set
            checkedItems.clear();
            updateSelectedCount();
        }

        function confirmDelete() {
            if (checkedItems.size === 0) {
                alert('No subjects are selected.');
                return;
            }

            if (confirm('Are you sure you want to delete selected subject/s?')) {
                // Because the user might be on page 2 or 3 with a partially loaded table,
                // the checkboxes for some previously selected items might not be in the DOM.
                // So we can dynamically create hidden inputs for each selected subject ID.

                const form = document.getElementById('deleteForm');

                // Remove any old hidden fields
                document.querySelectorAll('.temp-delete-id').forEach(el => el.remove());

                // For each selected item, append a hidden input to the form
                checkedItems.forEach(subjID => {
                    let hidden = document.createElement('input');
                    hidden.type = 'hidden';
                    hidden.name = 'items[]';
                    hidden.value = subjID;
                    hidden.classList.add('temp-delete-id');
                    form.appendChild(hidden);
                });

                // Finally, submit the form
                form.submit();
            }
        }
    </script>
</x-app-layout>
