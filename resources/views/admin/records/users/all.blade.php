<x-app-layout>
    <div class="min-h-screen">
        <div class="w-full flex justify-center py-8">
            <div class="w-[95%] flex flex-col p-8 bg-white rounded-lg">

                <!-- Success Message -->
                @if (session('success'))
                    <div class="bg-green-500 text-white p-4 rounded-md mb-4">
                        <p class="text-sm font-medium">{{ session('success') }}</p>
                    </div>
                @endif

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="bg-red-500 text-white p-4 rounded-md mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-sm">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <a href="{{ route('admin.records') }}" class="w-[15%] rounded-lg flex items-center justify-center py-2 bg-red-900 text-white font-bold mb-4 hover:bg-red-700">
                    <img src="{{ asset('images/icons/back.png') }}" class="w-[20px] h-[20px]" alt="">
                    Back
                </a>

                <span class="text-gray-400">Manage Users</span>
                <div class="w-full grid grid-cols-2">
                    <h1 class="text-[1.8rem] text-gray-600 font-semibold">All Users</h1>
                    <div class="flex items-center justify-end gap-4 float-right">
                        <div class="w-[25%] text-right">
                            <span id="user-count" class="font-semibold">
                                {{ $count }} user/s
                            </span>
                        </div>

                        <!-- Dropdown Button -->
                        <div class="relative">
                            <button type="button"
                                    class="flex items-center justify-center bg-red-900 hover:bg-red-800 rounded-lg text-white py-1 px-3 transition duration-300"
                                    id="add-user-dropdown-button">
                                <img src="{{ asset('images/icons/add_plain.png') }}" class="w-[25px] h-[25px] mr-2" alt="Add Icon">
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7">
                                    </path>
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div id="add-user-dropdown"
                                class="absolute right-0 w-52 bg-red-800 border rounded-md shadow-lg hidden z-50">
                                <a href="{{ route('admin.users.add', 'all') }}"
                                class="block text-right px-4 py-2 text-white hover:bg-red-700">
                                    ADD NEW USER
                                </a>
                                <a href="{{ route('admin.users.addMultiple', 'all') }}"
                                class="block text-right px-4 py-2 text-white hover:bg-red-700">
                                    ADD MULTIPLE USERS
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <span class="text-xl text-gray-500 font-semibold mb-2">
                    @if(isset($dept))
                        Department - {{ $dept }}
                    @endif

                    @if(isset($role))
                        Role - {{ $role }}
                    @endif
                </span>

                <!-- Filter Button -->
                <button id="filter-btn" onclick="filter_clicked(this)"
                        class="w-[10%] flex items-center justify-center gap-2 bg-white hover:bg-gray-200 rounded-lg inactive">
                    <img src="{{ asset('images/icons/filter.svg') }}" class="w-[15px] h-[15px]" alt="Filter Icon">
                    <span class="font-semibold text-gray-400">Filter</span>
                </button>

                <!-- Filter Box -->
                <div id="filter-box" class="w-full flex flex-col p-2 mt-2 rounded-xl">
                    <!-- Multi-filter Form -->
                    <form id="filter-form" class="mt-4 border rounded p-4">
                        <!-- Department Filter -->
                        <div class="mb-3">
                            <p class="font-semibold">Department</p>
                            <select name="dept" class="border border-gray-200 rounded-md mr-2">
                                <option value="">All Departments</option>
                                @foreach($depts as $item)
                                    <option value="{{ $item->code }}"
                                        @if(!empty($deptSelected) && $deptSelected == $item->code) selected @endif
                                    >{{ $item->dept }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Role Filter -->
                        <div class="mb-3">
                            <p class="font-semibold">Role</p>
                            <select name="role" class="border border-gray-200 w-[300px] rounded-md mr-2">
                                <option value="">All Roles</option>
                                <option value="Employee"     @if(!empty($roleSelected) && $roleSelected == 'Employee') selected @endif>Employee</option>
                                <option value="HR Admin"     @if(!empty($roleSelected) && $roleSelected == 'HR Admin') selected @endif>HR Admin</option>
                                <option value="Dean"         @if(!empty($roleSelected) && $roleSelected == 'Dean') selected @endif>Dean</option>
                                <option value="SuperAdmin"   @if(!empty($roleSelected) && $roleSelected == 'SuperAdmin') selected @endif>SuperAdmin</option>
                                <option value="IDC Admin"    @if(!empty($roleSelected) && $roleSelected == 'IDC Admin') selected @endif>IDC Admin</option>
                                <option value="IDC Admin"    @if(!empty($roleSelected) && $roleSelected == 'IDC Document Handler') selected @endif>IDC Document Handler</option>
                            </select>
                        </div>

                        <!-- Position Filter (multiple checkboxes) -->
                        <div class="mb-3">
                            <p class="font-semibold">Position</p>
                            <label class="mr-4">
                                <input type="checkbox" name="positions[]" value="Faculty"
                                    @if(!empty($positionsSelected) && in_array('Faculty', $positionsSelected)) checked @endif />
                                Faculty
                            </label>
                            <label class="mr-4">
                                <input type="checkbox" name="positions[]" value="NTP"
                                    @if(!empty($positionsSelected) && in_array('NTP', $positionsSelected)) checked @endif />
                                NTP
                            </label>
                        </div>

                        <!-- Nature Filter (multiple checkboxes) -->
                        <div class="mb-3">
                            <p class="font-semibold">Nature</p>
                            <label class="mr-4">
                                <input type="checkbox" name="natures[]" value="Full-time"
                                    @if(!empty($naturesSelected) && in_array('Full-time', $naturesSelected)) checked @endif />
                                Full-time
                            </label>
                            <label class="mr-4">
                                <input type="checkbox" name="natures[]" value="Part-time"
                                    @if(!empty($naturesSelected) && in_array('Part-time', $naturesSelected)) checked @endif />
                                Part-time
                            </label>
                        </div>

                        <!-- Tenure Filter (multiple checkboxes) -->
                        <div class="mb-3">
                            <p class="font-semibold">Tenure</p>
                            <label class="mr-4">
                                <input type="checkbox" name="tenures[]" value="Permanent"
                                    @if(!empty($tenuresSelected) && in_array('Permanent', $tenuresSelected)) checked @endif />
                                Permanent
                            </label>
                            <label class="mr-4">
                                <input type="checkbox" name="tenures[]" value="Probationary"
                                    @if(!empty($tenuresSelected) && in_array('Probationary', $tenuresSelected)) checked @endif />
                                Probationary
                            </label>
                            <label class="mr-4">
                                <input type="checkbox" name="tenures[]" value="Non-tenured"
                                    @if(!empty($tenuresSelected) && in_array('Non-tenured', $tenuresSelected)) checked @endif />
                                Non-tenured
                            </label>
                        </div>

                        <!-- License Filter (multiple checkboxes) -->
                        <div class="mb-3">
                            <p class="font-semibold">License</p>
                            <label class="mr-4">
                                <input type="checkbox" name="license[]" value="1"
                                    @if(!empty($licenseSelected) && in_array('1', $licenseSelected)) checked @endif />
                                Required
                            </label>
                            <label class="mr-4">
                                <input type="checkbox" name="license[]" value="0"
                                    @if(!empty($licenseSelected) && in_array('0', $licenseSelected)) checked @endif />
                                Not Required
                            </label>
                        </div>

                        <!-- Status Filter (0 = active, 1 = terminated) -->
                        <div class="mb-3">
                            <p class="font-semibold">Status</p>
                            <label class="mr-4">
                                <input type="checkbox" name="status[]" value="0"
                                    @if(!empty($statusSelected) && in_array('0', $statusSelected)) checked @endif />
                                Active
                            </label>
                            <label class="mr-4">
                                <input type="checkbox" name="status[]" value="1"
                                    @if(!empty($statusSelected) && in_array('1', $statusSelected)) checked @endif />
                                Terminated
                            </label>
                        </div>

                        <!-- Educational Attainment Filter (multiple checkboxes) -->
                        <div class="mb-3">
                            <p class="font-semibold">Educational Attainment</p>
                            <label class="mr-4">
                                <input type="checkbox" name="education[]" value="High School Graduate"
                                    @if(!empty($educationSelected) && in_array('High School Graduate', $educationSelected)) checked @endif />
                                High School Graduate
                            </label>
                            <label class="mr-4">
                                <input type="checkbox" name="education[]" value="Associate / 2-Year Course"
                                    @if(!empty($educationSelected) && in_array('Associate / 2-Year Course', $educationSelected)) checked @endif />
                                Associate / 2-Year Course
                            </label>
                            <label class="mr-4">
                                <input type="checkbox" name="education[]" value="College Graduate (Bachelor’s Degree)"
                                    @if(!empty($educationSelected) && in_array('College Graduate (Bachelor’s Degree)', $educationSelected)) checked @endif />
                                College Graduate (Bachelor’s Degree)
                            </label>
                            <label class="mr-4">
                                <input type="checkbox" name="education[]" value="Post-Graduate (Master’s)"
                                    @if(!empty($educationSelected) && in_array('Post-Graduate (Master’s)', $educationSelected)) checked @endif />
                                Post-Graduate (Master’s)
                            </label>
                            <label class="mr-4">
                                <input type="checkbox" name="education[]" value="Post-Graduate (PhD)"
                                    @if(!empty($educationSelected) && in_array('Post-Graduate (PhD)', $educationSelected)) checked @endif />
                                Post-Graduate (PhD)
                            </label>
                            <label class="mr-4">
                                <input type="checkbox" name="education[]" value="Vocational / Trade"
                                    @if(!empty($educationSelected) && in_array('Vocational / Trade', $educationSelected)) checked @endif />
                                Vocational / Trade
                            </label>
                            <label class="mr-4">
                                <input type="checkbox" name="education[]" value="Others"
                                    @if(!empty($educationSelected) && in_array('Others', $educationSelected)) checked @endif />
                                Others
                            </label>
                        </div>

                        <!-- Note: The APPLY button has been removed so that filters auto-apply -->
                        <button type="button" onclick="resetFilter()" class="hover:bg-gray-100 px-2" title="Clear Filter">
                            <img src="{{ asset('images/icons/clear.svg') }}" class="w-[20px] h-[20px]" alt="Clear Filter">
                        </button>
                    </form>
                </div>

                <!-- Inline PHP to compute chart data based on current filters -->
                @php
                    // Default chart data (all departments and all roles)
                    $query = \App\Models\Employee::with('login', 'hiring', 'educations')->orderBy('emp_lname', 'asc');
                    if(!in_array(Auth::user()->role, ['SuperAdmin','HR Admin'])){
                        $query->where('emp_dept', Auth::user()->emp_dept);
                    }
                    $allEmployees = $query->get();
                    $grouped = $allEmployees->groupBy(function($item) {
                        return $item->emp_dept . ', ' . ($item->login->role ?? 'Unknown');
                    });
                    $chartDataArray = $grouped->map(function($group) {
                        return $group->count();
                    })->toArray();
                    $totalEmployees = array_sum(array_values($chartDataArray));
                @endphp

                <!-- Preload Chart Data into JavaScript Variables -->
                <script>
                    var chartLabels = <?php echo json_encode(array_keys($chartDataArray)); ?>;
                    var chartData   = <?php echo json_encode(array_values($chartDataArray)); ?>;
                </script>

                <!-- Display Statistics Checkbox & Chart + Summary Container -->
                <div class="flex items-center my-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" id="toggleStats" class="form-checkbox">
                        <span class="ml-2 text-gray-600">Display Statistics</span>
                    </label>
                </div>
                <div id="statsContainer" class="mb-4" style="display: none;">
                    <div class="flex flex-row space-x-4">
                        <!-- Chart Section -->
                        <div class="w-1/2" style="height: 400px;">
                            <canvas id="statsChart" class="w-full h-full"></canvas>
                        </div>
                        <!-- Summary Section -->
                        <div class="w-1/2 p-4 bg-white rounded-lg shadow-lg">
                            <h3 class="text-xl font-bold mb-4">Total Employees: <span id="totalEmployees">{{ $totalEmployees }}</span></h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200" id="statsTable">
                                    <thead class="bg-gray-200">
                                        <tr>
                                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Group</th>
                                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Employee Count</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($chartDataArray as $groupLabel => $count)
                                            <tr>
                                                <td class="px-4 py-2 text-sm text-gray-900">{{ $groupLabel }}</td>
                                                <td class="px-4 py-2 text-sm text-gray-900">{{ $count }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="opacity-90 my-4">

                <!-- Search Bar -->
                @if($count != 0)
                    <input type="text" id="search" placeholder="Search user..." class="w-full border border-gray-200 p-2 rounded-sm mb-4">
                @endif

                @if($count == 0)
                    <div class="w-full text-center">
                        <h1 class="text-gray-400">No data found.</h1>
                    </div>
                @endif

                <!-- User List -->
                <div id="user-list" class="flex flex-col gap-1">
                    @include('admin.records.users.partials.user-list', ['users' => $users])
                </div>
                <!-- Pagination Links -->
                <div id="search-pagination" class="mt-4">
                    @include('admin.records.users.partials.pagination', ['users' => $users])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Styles -->
<style>
    a, button {
        transition: 300ms;
    }
    #filter-box {
        display: none;
    }
    .dept {
        display: none;
    }
    .role {
        display: none;
    }
    .act {
        background-color: rgb(229 231 235);
    }
    /* Dropdown Styles */
    #add-user-dropdown a {
        display: block;
    }
    /* Additional Styles for Filter */
    .deptc.act, .rolec.act {
        background-color: rgb(229, 231, 235);
    }
</style>

<!-- Include Chart.js Library from CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Scripts -->
<script>
    // Base URL
    const baseUrl = "{{ url('/') }}";

    // Store the default HTML for resetting the page without reloading
    const defaultUserListHtml = document.getElementById('user-list').innerHTML;
    const defaultPaginationHtml = document.getElementById('search-pagination').innerHTML;
    const defaultUserCount = document.getElementById('user-count').textContent;

    // Toggle Filter Box
    function filter_clicked(button) {
        let box = document.getElementById('filter-box');
        if (button.classList.contains('inactive')) {
            box.style.display = 'flex';
            button.classList.remove('inactive');
            button.style.backgroundColor = 'rgb(229, 231, 235)';
        } else {
            box.style.display = 'none';
            button.classList.add('inactive');
            button.style.backgroundColor = 'white';
        }
    }

    // Reset Filter
    function resetFilter() {
        if (confirm('Are you sure you want to clear the filter?')) {
            window.location = '{{ route("admin.users") }}';
        }
    }

    // --- Updated Search Functionality with Debounce ---
    let searchDebounceTimer;
    document.getElementById('search').addEventListener('input', function() {
        clearTimeout(searchDebounceTimer);
        let searchQuery = this.value.trim();
        searchDebounceTimer = setTimeout(() => {
            if (searchQuery === '') {
                // Reset the page to its default state without reloading
                document.getElementById('user-list').innerHTML = defaultUserListHtml;
                document.getElementById('user-count').textContent = defaultUserCount;
                document.getElementById('search-pagination').innerHTML = defaultPaginationHtml;
            } else {
                fetchUsers(searchQuery);
            }
        }, 300);
    });

    function fetchUsers(query, pageUrl = null) {
        let url = pageUrl ? pageUrl : `${baseUrl}/admin/users/search?query=${encodeURIComponent(query)}`;
        fetch(url, {
            method: 'GET',
            headers: { Accept: 'application/json' },
        })
        .then(response => response.json())
        .then(data => {
            let userList = document.getElementById('user-list');
            let userCount = document.getElementById('user-count');
            let paginationDiv = document.getElementById('search-pagination');
            userList.innerHTML = '';
            paginationDiv.innerHTML = '';
            if (data.users.length === 0) {
                userList.innerHTML = `<div class="w-full text-center">
                        <h1 class="text-gray-400">No data found.</h1>
                    </div>`;
                userCount.textContent = "0 user/s";
                return;
            }
            userCount.textContent = `${data.count} user/s`;
            data.users.forEach(user => {
                let profilePicture = user.profile_picture
                    ? `${baseUrl}/storage/profile_pictures/${user.profile_picture}`
                    : `${baseUrl}/images/blankdp.jpg`;
                let viewProfileUrl = `${baseUrl}/admin/records/users/${user.emp_id}`;
                let row = 
                    `<div class="w-full flex items-center">
                        <div class="w-3/4 flex items-center gap-2 py-2">
                            <img src="${profilePicture}" class="w-[30px] h-[30px] rounded-full" alt="User Image" />
                            <h1 class="text-lg font-semibold">
                                ${user.full_name} 
                            </h1>
                            <span class="text-sm text-gray-400">
                                ${user.login.email}
                            </span>
                        </div>
                        <div class="w-1/4 flex items-center justify-end gap-4">
                            <span class="text-sm text-gray-400">
                                ${user.login.role}, <strong class="uppercase">${user.emp_dept}</strong>
                            </span>
                            <a href="${viewProfileUrl}" class="bg-gray-900 hover:bg-gray-700 p-2 rounded-xl" title="View Profile">
                                <img src="${baseUrl}/images/icons/view.svg" class="w-[25px] h-[25px]" alt="View Icon">
                            </a>
                        </div>
                    </div>
                    <hr class="opacity-60 my-2">`;
                userList.innerHTML += row;
            });
            paginationDiv.innerHTML = data.links;
            let paginationLinks = paginationDiv.querySelectorAll('a');
            paginationLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    let nextPageUrl = this.getAttribute('href');
                    if (nextPageUrl) {
                        fetchUsers(query, nextPageUrl);
                    }
                });
            });
        })
        .catch(error => {
            console.error('Error fetching user data:', error);
            document.getElementById('user-list').innerHTML = `<div class="w-full text-center">
                        <h1 class="text-gray-400">An error occurred while fetching user data.</h1>
                    </div>`;
        });
    }

    // Auto-filtering: Attach change event listeners to filter form inputs
    document.querySelectorAll('#filter-form input, #filter-form select').forEach(function(element) {
        element.addEventListener('change', function(){
            applyFilters();
        });
    });

    function applyFilters() {
        let form = document.getElementById('filter-form');
        let formData = new FormData(form);
        let queryString = new URLSearchParams(formData).toString();
        let url = "{{ route('admin.users.filter', 'multi') }}" + "?" + queryString;
        fetch(url, {
            method: 'GET',
            headers: { 'Accept': 'application/json' }
        })
        .then(response => response.json())
        .then(data => {
            // If no users are returned, update both the user list and summary
            if (data.userCount == 0) {
                document.getElementById('user-list').innerHTML = `<div class="w-full text-center">
                    <h1 class="text-gray-400">No data found.</h1>
                </div>`;
                document.getElementById('user-count').textContent = "0 user/s";
                document.getElementById('search-pagination').innerHTML = "";
                let statsTableBody = document.querySelector("#statsTable tbody");
                statsTableBody.innerHTML = `<tr>
                    <td colspan="2" class="px-4 py-2 text-sm text-gray-900 text-center">No data found.</td>
                </tr>`;
                // Clear the chart if it’s displayed
                if(document.getElementById('toggleStats').checked) {
                    if (window.statsChart && typeof window.statsChart.destroy === 'function') {
                        window.statsChart.destroy();
                    }
                }
                return;
            }

            // Update user list and pagination
            document.getElementById('user-list').innerHTML = data.userListHtml;
            document.getElementById('user-count').textContent = data.userCount + " user/s";
            document.getElementById('search-pagination').innerHTML = data.paginationHtml;

            // Update chart data variables and summary table
            chartLabels = data.chartLabels;
            chartData = data.chartData;
            document.getElementById('totalEmployees').textContent = data.totalEmployees;
            let statsTableBody = document.querySelector("#statsTable tbody");
            statsTableBody.innerHTML = "";
            data.chartLabels.forEach((label, index) => {
                statsTableBody.innerHTML += `<tr>
                    <td class="px-4 py-2 text-sm text-gray-900">${label}</td>
                    <td class="px-4 py-2 text-sm text-gray-900">${data.chartData[index]}</td>
                </tr>`;
            });
            // Update chart if displayed
            if(document.getElementById('toggleStats').checked) {
                if (window.statsChart && typeof window.statsChart.destroy === 'function') {
                    window.statsChart.destroy();
                }
                setTimeout(function(){
                    var statsCanvas = document.getElementById('statsChart');
                    if (statsCanvas) {
                        var ctx = statsCanvas.getContext('2d');
                        window.statsChart = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: chartLabels,
                                datasets: [{
                                    data: chartData,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.6)',
                                        'rgba(54, 162, 235, 0.6)',
                                        'rgba(255, 206, 86, 0.6)',
                                        'rgba(75, 192, 192, 0.6)',
                                        'rgba(153, 102, 255, 0.6)',
                                        'rgba(255, 159, 64, 0.6)'
                                    ]
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false
                            }
                        });
                    }
                }, 50);
            }
        })
        .catch(error => console.error('Error applying filters:', error));
    }

    // Dropdown Functionality for Add User
    document.getElementById('add-user-dropdown-button').addEventListener('click', function(event) {
        event.stopPropagation();
        const dropdown = document.getElementById('add-user-dropdown');
        dropdown.classList.toggle('hidden');
    });

    // Close Dropdown When Clicking Outside
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('add-user-dropdown');
        const button = document.getElementById('add-user-dropdown-button');
        if (!dropdown.contains(event.target) && !button.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
    });

    // --- Statistics (Chart) Toggle & Initialization ---
    document.getElementById('toggleStats').addEventListener('change', function(){
        let statsContainer = document.getElementById('statsContainer');
        if (this.checked) {
            statsContainer.style.display = 'block';
            if (window.statsChart && typeof window.statsChart.destroy === 'function') {
                window.statsChart.destroy();
            }
            setTimeout(function(){
                var statsCanvas = document.getElementById('statsChart');
                if (statsCanvas) {
                    var ctx = statsCanvas.getContext('2d');
                    window.statsChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: chartLabels,
                            datasets: [{
                                data: chartData,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.6)',
                                    'rgba(54, 162, 235, 0.6)',
                                    'rgba(255, 206, 86, 0.6)',
                                    'rgba(75, 192, 192, 0.6)',
                                    'rgba(153, 102, 255, 0.6)',
                                    'rgba(255, 159, 64, 0.6)'
                                ]
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false
                        }
                    });
                }
            }, 50);
        } else {
            statsContainer.style.display = 'none';
        }
    });
</script>
