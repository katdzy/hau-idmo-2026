<x-app-layout>
    <div class="min-h-screen">
        <div class="w-full flex justify-center py-8">
            <div class="w-[95%] flex flex-col rounded-xl p-8 bg-white shadow-lg">

                <!-- Edit Certificate Header -->
                <h2 class="text-2xl font-bold mb-4">Edit Certificate</h2>

                <!-- Edit Certificate Form -->
                <form action="{{ route('admin.certs.update', ['id' => $data->id]) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div>
                        <label for="cert_title" class="block font-semibold mb-2">Certificate Title</label>
                        <input type="text" name="cert_title" id="cert_title" value="{{ $data->cert_title }}" 
                            class="w-full p-3 border border-gray-300 rounded-lg" required>
                    </div>

                    <!-- Issued By -->
                    <div>
                        <label for="issued_by" class="block font-semibold mb-2">Issued By</label>
                        <input type="text" name="issued_by" id="issued_by" value="{{ $data->issued_by }}" 
                            class="w-full p-3 border border-gray-300 rounded-lg" required>
                    </div>

                    <!-- Duration -->
                    <div>
                        <label for="duration" class="block font-semibold mb-2">Duration</label>
                        <input type="text" name="duration" id="duration" value="{{ $data->duration }}" 
                            class="w-full p-3 border border-gray-300 rounded-lg" required>
                    </div>

                    <!-- Validity -->
                    <div>
                        <label for="cert_validity" class="block font-semibold mb-2">Certificate Validity</label>
                        <input type="date" name="cert_validity" id="cert_validity" value="{{ \Carbon\Carbon::parse($data->cert_validity)->format('Y-m-d') }}" 
                            class="w-full p-3 border border-gray-300 rounded-lg" required>
                    </div>

                    <!-- Type -->
                    <div>
                        <label for="cert_type" class="block font-semibold mb-2">Certificate Type</label>
                        <input type="text" name="cert_type" id="cert_type" value="{{ $data->cert_type }}" 
                            class="w-full p-3 border border-gray-300 rounded-lg" required>
                    </div>

                    <!-- Role -->
                    <div>
                        <label for="role" class="block font-semibold mb-2">Role</label>
                        <input type="text" name="role" id="role" value="{{ $data->role }}" 
                            class="w-full p-3 border border-gray-300 rounded-lg" required>
                    </div>

                    <!-- Attachment (optional) -->
                    <div>
                        <label for="attachment" class="block font-semibold mb-2">Attachment (upload to replace existing)</label>
                        <input type="file" name="attachment" id="attachment" accept=".pdf,.jpg,.jpeg,.png"
                            class="w-full p-3 border border-gray-300 rounded-lg">
                        <p class="text-gray-500 mt-1">Current file: {{ $data->attachment }}</p>
                    </div>

                    <!-- Submit button -->
                    <div>
                        <button type="submit" 
                            class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700">
                            Save Changes
                        </button>
                    </div>
                </form>

                <!-- Divider -->
                <hr class="my-8 border-t border-gray-300">

                <!-- User Addition Section for Batch Issuing -->
                <div class="border border-gray-300 p-4 mb-8 rounded-lg shadow-sm">
                    <h2 class="text-lg font-semibold text-red-900 mb-2">Add Users for Batch Issuing</h2>
                    <div class="flex flex-col">

                        <!-- Search Bar -->
                        <div class="relative mb-4">
                            <input type="text" id="search" placeholder="Search user..." class="w-full border border-gray-300 p-2 rounded-lg focus:ring focus:ring-red-300 focus:border-red-500 transition duration-200" />
                            <div id="search-results" class="mt-2 bg-white shadow-lg rounded-lg z-10 w-full hidden">
                                <div id="search-results-list" class="flex flex-col gap-1">
                                    <!-- Search results will be displayed here -->
                                </div>
                            </div>
                        </div>

                        <!-- Queued Users -->
                        <h3 class="text-md font-semibold text-gray-700">Queued Users:</h3>

                        <form id="batch-issue-form" method="POST" action="{{ route('admin.certs.issue', ['id' => $data->id]) }}">
                            @csrf
                            <input type="hidden" name="queued_users" id="queued-users-input" />
                            
                            <table class="min-w-full border border-gray-300 mt-2">
                                <thead>
                                    <tr class="bg-red-100">
                                        <th class="border border-gray-300 px-4 py-2 text-left text-gray-600">Employee ID</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left text-gray-600">Name</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left text-gray-600">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="queued-users">
                                    <tr class="border-t border-gray-300">
                                        <td colspan="3" class="px-4 py-2 text-gray-600 text-center" id="no-users">No user added</td>
                                    </tr>
                                    <!-- Dynamically added user items will go here -->
                                </tbody>
                            </table>

                            <div class="mt-4">
                                <button type="submit" class="bg-red-900 hover:bg-red-800 text-white px-4 py-2 rounded-lg transition duration-200">
                                    Issue Certificate
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>


<!-- JavaScript Section -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Search functionality
        const searchInput = document.getElementById('search');
        const searchResults = document.getElementById('search-results');
        const searchResultsList = document.getElementById('search-results-list');
        const queuedUsers = document.getElementById('queued-users');
        const noUsersMessage = document.getElementById('no-users');

        searchInput.addEventListener('input', function () {
            const searchQuery = this.value.trim();
            if (searchQuery.length === 0) {
                searchResults.classList.add('hidden');
                searchResultsList.innerHTML = '';
                return;
            }
            fetchUsers(searchQuery);
        });

        function fetchUsers(query) {
            fetch(`{{ route('admin.users.search') }}?query=${encodeURIComponent(query)}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                searchResultsList.innerHTML = ''; // Clear the current results

                if (data.users.length > 0) {
                    data.users.forEach(user => {
                        let profilePicture = user.profile_picture
                            ? `{{ asset('storage/profile_pictures/') }}/${user.profile_picture}`
                            : `{{ asset('images/blankdp.jpg') }}`;

                        let row = `
                            <div class="flex items-center justify-between border p-2 rounded-md shadow-sm bg-gray-50 hover:bg-gray-100 transition duration-200 cursor-pointer" onclick="addToQueue(${user.emp_id}, '${escapeQuotes(user.emp_lname)}', '${escapeQuotes(user.emp_fname)}', '${escapeQuotes(user.emp_mname)}', '${profilePicture}')">
                                <div class="flex items-center gap-2">
                                    <img src="${profilePicture}" class="w-[35px] h-[35px] rounded-full" alt="user_image" />
                                    <h1 class="text-sm font-medium text-gray-800">${user.full_name}</h1>
                                </div>
                                <button class="bg-red-900 hover:bg-red-800 text-white px-2 py-1 rounded-lg transition duration-200">Add</button>
                            </div>
                        `;
                        searchResultsList.innerHTML += row;
                    });
                    searchResults.classList.remove('hidden'); // Show the results
                } else {
                    searchResults.classList.add('hidden'); // Hide if no results
                }
            })
            .catch(error => {
                console.error('Error fetching user data:', error);
            });
        }

        // Utility function to escape single quotes in strings
        function escapeQuotes(str) {
            if (!str) return '';
            return str.replace(/'/g, "\\'");
        }

        window.addToQueue = function(empId, lastName, firstName, middleName, profilePicture) {
            // Check if the user is already in the queued list
            const existingUser = Array.from(queuedUsers.querySelectorAll('tr')).some(row => {
                return row.cells[0].innerText.trim() === empId.toString(); // Check by Employee ID
            });

            if (existingUser) {
                alert('This user is already added to the queue.');
                return; // Exit if the user is already queued
            }

            // Add the user to the queued users list
            noUsersMessage.style.display = 'none'; // Hide the "No user added" message

            let queuedUser = `
                <tr class="border-t border-gray-300">
                    <td class="border border-gray-300 px-4 py-2">${empId}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <div class="flex items-center gap-2">
                            <img src="${profilePicture}" class="w-[30px] h-[30px] rounded-full" alt="user_image" />
                            <span>${lastName}, ${firstName} ${middleName}</span>
                        </div>
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        <button onclick="removeFromQueue(this)" class="text-red-600 hover:text-red-500 transition duration-200">Remove</button>
                    </td>
                </tr>
            `;
            queuedUsers.innerHTML += queuedUser;

            // Optionally, clear search results after adding
            searchResultsList.innerHTML = ''; // Clear search results
            searchResults.classList.add('hidden'); // Hide the results after adding
            searchInput.value = ''; // Clear the search input
        }

        window.removeFromQueue = function(button) {
            // Remove the user from the queued users list
            button.closest('tr').remove();

            // Check if there are any queued users left
            if (queuedUsers.children.length === 0) { 
                noUsersMessage.style.display = 'table-row'; // Show the "No user added" message
            }
        }

        // Submit the form and gather the user IDs before submission
        document.getElementById('batch-issue-form').addEventListener('submit', function (event) {
            const userIds = Array.from(queuedUsers.querySelectorAll('tr'))
                .map(row => row.cells[0].innerText.trim()) // Get Employee IDs
                .filter(id => id !== 'No user added'); // Exclude the 'No user added' row

            document.getElementById('queued-users-input').value = JSON.stringify(userIds); // Serialize and set the input value
        });
    });
</script>
