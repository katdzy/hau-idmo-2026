<x-app-layout>
    <div class="w-full flex flex-col items-center py-8 bg-gray-100 min-h-screen">
        <div class="w-[100%] flex flex-col rounded-lg p-8">
            <a href="{{ route('admin.prc') }}" class="w-[15%] rounded-lg flex items-center justify-center py-2 bg-red-900 text-white font-bold gap-1 hover:bg-red-700">
                <img src="{{ asset('images/icons/back.png') }}" class="w-[20px] h-[20px]" alt="Back">
                Back
            </a>
        </div>
        
        <!-- Header Section -->
        <div class="w-11/12 max-w-7xl bg-white rounded-xl shadow-lg p-8 flex flex-row justify-between items-center mb-8">
            <div class="flex flex-col">
                <h1 class="text-3xl font-bold text-gray-800">
                    Examination: <span id="examTitleText">{{ $prc->title }}</span>
                </h1>
                <span class="text-gray-500 text-sm">
                    Date: <span id="examDateText">{{ \Carbon\Carbon::parse($prc->exam_date)->format('F d, Y') }}</span>
                </span>
            </div>

            <!-- Edit, Export and Delete Buttons -->
            <div class="flex items-center gap-4">
                <!-- Edit Button -->
                <button id="editButton" class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                    <img src="{{ asset('images/icons/edit.png') }}" alt="Edit" class="w-4 h-4">
                    Edit
                </button>

                <!-- Export to Excel Button -->
                <a href="{{ route('admin.prc.export', ['id' => $prc->id]) }}" class="bg-green-600 hover:bg-green-500 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                    <img src="{{ asset('images/icons/excel.png') }}" alt="Excel" class="w-4 h-4">
                    Export to Excel
                </a>

                <!-- Delete Button -->
                <form action="{{ route('admin.prc.delete', ['id' => $prc->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this entry?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-500 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                        <img src="{{ asset('images/icons/delete.png') }}" alt="Delete" class="w-4 h-4">
                        Delete
                    </button>
                </form>
            </div>
        </div>

        <!-- Performance and Data Section -->
        <div class="w-11/12 max-w-7xl bg-white rounded-xl shadow-lg p-8 flex flex-col space-y-8 relative">

            <!-- Graphs Section -->
            <div class="flex flex-col md:flex-row md:justify-between gap-8 mb-8">
                <!-- National Performance Pie Chart -->
                <div class="w-full md:w-1/2">
                    <h2 class="text-xl font-semibold mb-4">National Performance</h2>
                    <select id="nationalPerformanceSelect" class="border rounded p-1 mb-4 w-auto min-w-[200px]">
                        <option value="overall">Overall Performance</option>
                        <option value="first">First Timers</option>
                        <option value="repeat">Repeaters</option>
                    </select>
                    <p id="nationalPercentagePassed" class="text-center font-semibold mb-2"></p>
                    <div class="w-[200px] h-[200px] mx-auto">
                        <canvas id="nationalPieChart" style="max-width: 100%; max-height: 100%;"></canvas>
                    </div>
                </div>

                <!-- Pie Chart for Holy Angel University -->
                <div class="w-full md:w-1/2">
                    <h2 class="text-xl font-semibold mb-4">Holy Angel University Performance</h2>
                    @php
                        $hau = $prc->takers->first(function ($item) {
                            return strtolower($item->school) === 'holy angel university';
                        });
                    @endphp

                    @if($hau)
                        <select id="hauPerformanceSelect" class="border rounded p-1 mb-4 w-auto min-w-[200px]">
                            <option value="overall">Overall Performance</option>
                            <option value="first">First Timers</option>
                            <option value="repeat">Repeaters</option>
                        </select>
                        <p id="hauPercentagePassed" class="text-center font-semibold mb-2"></p>
                        <div class="w-[200px] h-[200px] mx-auto">
                            <canvas id="hauPieChart" style="max-width: 100%; max-height: 100%;"></canvas>
                        </div>
                    @else
                        <p>No data.</p>
                    @endif
                </div>
            </div>

            <!-- Table Section (AJAX paginated) -->
            <div id="tableContainer">
                @include('prc.takers_table', ['takers' => $takers])
            </div>

            <!-- Editable Form Section -->
            <form action="{{ route('admin.prc.update', ['id' => $prc->id]) }}" method="POST" id="editForm" class="hidden flex-col space-y-4">
                @csrf
                @method('PUT')
                @if ($errors->any())
                <div class="mb-4">
                    <ul class="list-disc list-inside text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <h2 class="text-xl font-semibold">Edit Examination Details</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Examination Title</label>
                        <select name="title" class="w-full border rounded p-1" required>
                            <option value="" disabled>Select...</option>
                            @foreach ($prc_exams as $item)
                                <option value="{{ $item->item }}" @if($prc->title == $item->item) selected @endif>{{ $item->item }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Date</label>
                        <input type="date" name="exam_date" class="w-full border rounded p-2" value="{{ $prc->exam_date }}" min ="1973-06-22" max="{{ date('Y-m-d') }}">
                    </div>
                </div>

                <!-- Editable Takers Table (sorted alphabetically by school) -->
                <h3 class="text-lg font-semibold mt-4">Edit Takers Data</h3>
                <div class="w-full overflow-x-auto">
                    <table class="min-w-full bg-white border" id="editableTable">
                        <thead>
                            <tr class="bg-gray-100 text-black">
                                <!-- Left-align school column header -->
                                <th class="px-4 py-2 border text-left">School</th>
                                <th class="px-4 py-2 border">F. Passed</th>
                                <th class="px-4 py-2 border">F. Fail</th>
                                <th class="px-4 py-2 border">F. Cond</th>
                                <th class="px-4 py-2 border">R. Passed</th>
                                <th class="px-4 py-2 border">R. Fail</th>
                                <th class="px-4 py-2 border">R. Cond</th>
                                <th class="px-4 py-2 border">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($prc->takers->sortBy('school') as $taker)
                            <tr>
                                <td class="px-4 py-2 border text-left">
                                    <input type="text" name="schoolsData[{{ $loop->index }}][school]" class="border p-1 w-full" value="{{ $taker->school }}" required>
                                </td>
                                <td class="px-4 py-2 border text-center">
                                    <input type="number" min="0" name="schoolsData[{{ $loop->index }}][first_pass]" class="border p-1 w-full" value="{{ $taker->first_pass }}" required>
                                </td>
                                <td class="px-4 py-2 border text-center">
                                    <input type="number" min="0" name="schoolsData[{{ $loop->index }}][first_fail]" class="border p-1 w-full" value="{{ $taker->first_fail }}" required>
                                </td>
                                <td class="px-4 py-2 border text-center">
                                    <input type="number" min="0" name="schoolsData[{{ $loop->index }}][first_cond]" class="border p-1 w-full" value="{{ $taker->first_cond }}" required>
                                </td>
                                <td class="px-4 py-2 border text-center">
                                    <input type="number" min="0" name="schoolsData[{{ $loop->index }}][repeat_pass]" class="border p-1 w-full" value="{{ $taker->repeat_pass }}" required>
                                </td>
                                <td class="px-4 py-2 border text-center">
                                    <input type="number" min="0" name="schoolsData[{{ $loop->index }}][repeat_fail]" class="border p-1 w-full" value="{{ $taker->repeat_fail }}" required>
                                </td>
                                <td class="px-4 py-2 border text-center">
                                    <input type="number" min="0" name="schoolsData[{{ $loop->index }}][repeat_cond]" class="border p-1 w-full" value="{{ $taker->repeat_cond }}" required>
                                </td>
                                <td class="px-4 py-2 border text-center">
                                    <button type="button" class="deleteRow bg-red-600 hover:bg-red-500 text-white px-2 py-1 rounded">
                                        <img src="{{ asset('images/icons/delete.png') }}" alt="Delete" class="w-4 h-4 inline">
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <button type="button" id="addRow" class="mt-2 bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                    + Add Row
                </button>

                <div class="flex justify-end mt-4">
                    <button type="submit" class="bg-green-600 hover:bg-green-500 text-white px-4 py-2 rounded-lg">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>

    <script>
    // Edit mode toggle
    const editButton = document.getElementById('editButton');
    const editForm = document.getElementById('editForm');
    const viewModeTable = document.getElementById('tableContainer');
    let isEditing = false;
    let rowIndex = {{ $prc->takers->count() }}; // Initialize with current number of takers

    editButton.addEventListener('click', () => {
        isEditing = !isEditing;
        if (isEditing) {
            editForm.classList.remove('hidden');
            viewModeTable.classList.add('hidden');
            editButton.textContent = 'Cancel';
            editButton.classList.remove('bg-blue-600', 'hover:bg-blue-500');
            editButton.classList.add('bg-gray-600', 'hover:bg-gray-500');
        } else {
            editForm.classList.add('hidden');
            viewModeTable.classList.remove('hidden');
            editButton.innerHTML = '<img src="{{ asset('images/icons/edit.png') }}" alt="Edit" class="w-4 h-4"> Edit';
            editButton.classList.remove('bg-gray-600', 'hover:bg-gray-500');
            editButton.classList.add('bg-blue-600', 'hover:bg-blue-500');
        }
    });

    // Add Row functionality in edit form
    const addRowButton = document.getElementById('addRow');
    const editableTable = document.getElementById('editableTable').getElementsByTagName('tbody')[0];

    addRowButton.addEventListener('click', () => {
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td class="px-4 py-2 border text-left">
                <input type="text" name="schoolsData[${rowIndex}][school]" class="border p-1 w-full" value="" required>
            </td>
            <td class="px-4 py-2 border text-center">
                <input type="number" min="0" name="schoolsData[${rowIndex}][first_pass]" class="border p-1 w-full" value="0" required>
            </td>
            <td class="px-4 py-2 border text-center">
                <input type="number" min="0" name="schoolsData[${rowIndex}][first_fail]" class="border p-1 w-full" value="0" required>
            </td>
            <td class="px-4 py-2 border text-center">
                <input type="number" min="0" name="schoolsData[${rowIndex}][first_cond]" class="border p-1 w-full" value="0" required>
            </td>
            <td class="px-4 py-2 border text-center">
                <input type="number" min="0" name="schoolsData[${rowIndex}][repeat_pass]" class="border p-1 w-full" value="0" required>
            </td>
            <td class="px-4 py-2 border text-center">
                <input type="number" min="0" name="schoolsData[${rowIndex}][repeat_fail]" class="border p-1 w-full" value="0" required>
            </td>
            <td class="px-4 py-2 border text-center">
                <input type="number" min="0" name="schoolsData[${rowIndex}][repeat_cond]" class="border p-1 w-full" value="0" required>
            </td>
            <td class="px-4 py-2 border text-center">
                <button type="button" class="deleteRow bg-red-600 hover:bg-red-500 text-white px-2 py-1 rounded">
                    <img src="{{ asset('images/icons/delete.png') }}" alt="Delete" class="w-4 h-4 inline">
                </button>
            </td>
        `;
        editableTable.appendChild(newRow);
        rowIndex++; // Increment rowIndex for next addition
    });

    // Delete Row functionality in edit form
    document.addEventListener('click', function(e) {
        if (e.target.closest('.deleteRow')) {
            const row = e.target.closest('tr');
            row.parentNode.removeChild(row);
        }
    });

    // Prepare data for charts (National & HAU) [unchanged]
    const allTakers = @json($allTakers);
    let national = {
        first_pass: 0,
        first_fail: 0,
        first_cond: 0,
        repeat_pass: 0,
        repeat_fail: 0,
        repeat_cond: 0,
        overall_pass: 0,
        overall_fail: 0,
        overall_cond: 0
    };
    allTakers.forEach(taker => {
        national.first_pass += taker.first_pass;
        national.first_fail += taker.first_fail;
        national.first_cond += taker.first_cond;
        national.repeat_pass += taker.repeat_pass;
        national.repeat_fail += taker.repeat_fail;
        national.repeat_cond += taker.repeat_cond;
    });
    national.overall_pass = national.first_pass + national.repeat_pass;
    national.overall_fail = national.first_fail + national.repeat_fail;
    national.overall_cond = national.first_cond + national.repeat_cond;

    const nationalPieCtx = document.getElementById('nationalPieChart').getContext('2d');
    let nationalPieChart;
    function updateNationalPieChart(type) {
        let data, labels, percentagePassed;
        if (type === 'overall') {
            let total = national.overall_pass + national.overall_fail + national.overall_cond;
            percentagePassed = total > 0 ? ((national.overall_pass / total)*100).toFixed(2) + '%' : '0%';
            data = [national.overall_pass, national.overall_fail];
            labels = ['Passed', 'Failed'];
        } else if (type === 'first') {
            let total = national.first_pass + national.first_fail + national.first_cond;
            percentagePassed = total > 0 ? ((national.first_pass / total)*100).toFixed(2) + '%' : '0%';
            data = [national.first_pass, national.first_fail];
            labels = ['Passed', 'Failed'];
        } else {
            let total = national.repeat_pass + national.repeat_fail + national.repeat_cond;
            percentagePassed = total > 0 ? ((national.repeat_pass / total)*100).toFixed(2) + '%' : '0%';
            data = [national.repeat_pass, national.repeat_fail];
            labels = ['Passed', 'Failed'];
        }
        document.getElementById('nationalPercentagePassed').textContent = "Percentage Passed: " + percentagePassed;
        if (nationalPieChart) {
            nationalPieChart.destroy();
        }
        nationalPieChart = new Chart(nationalPieCtx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: ['#4CAF50', '#F44336']
                }]
            }
        });
    }
    const nationalPerformanceSelect = document.getElementById('nationalPerformanceSelect');
    nationalPerformanceSelect.addEventListener('change', (e) => {
        updateNationalPieChart(e.target.value);
    });
    updateNationalPieChart('overall');

    @if($hau)
    const hauPassOverall = {{ $hau->first_pass + $hau->repeat_pass }};
    const hauFailOverall = {{ $hau->first_fail + $hau->repeat_fail }};
    const hauCondOverall = {{ $hau->first_cond + $hau->repeat_cond }};
    const hauPassFirst = {{ $hau->first_pass }};
    const hauFailFirst = {{ $hau->first_fail }};
    const hauPassRepeat = {{ $hau->repeat_pass }};
    const hauFailRepeat = {{ $hau->repeat_fail }};
    const hauPieCtx = document.getElementById('hauPieChart').getContext('2d');
    let hauPieChart;
    function updateHauPieChart(type) {
        let data, labels, percentagePassed;
        if (type === 'overall') {
            let total = hauPassOverall + hauFailOverall + hauCondOverall;
            percentagePassed = total > 0 ? ((hauPassOverall / total)*100).toFixed(2) + '%' : '0%';
            data = [hauPassOverall, hauFailOverall];
            labels = ['Passed', 'Failed'];
        } else if (type === 'first') {
            let total = hauPassFirst + hauFailFirst;
            percentagePassed = total > 0 ? ((hauPassFirst / total)*100).toFixed(2) + '%' : '0%';
            data = [hauPassFirst, hauFailFirst];
            labels = ['Passed', 'Failed'];
        } else {
            let total = hauPassRepeat + hauFailRepeat;
            percentagePassed = total > 0 ? ((hauPassRepeat / total)*100).toFixed(2) + '%' : '0%';
            data = [hauPassRepeat, hauFailRepeat];
            labels = ['Passed', 'Failed'];
        }
        document.getElementById('hauPercentagePassed').textContent = "Percentage Passed: " + percentagePassed;
        if (hauPieChart) {
            hauPieChart.destroy();
        }
        hauPieChart = new Chart(hauPieCtx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: ['#4CAF50', '#F44336']
                }]
            }
        });
    }
    const hauPerformanceSelect = document.getElementById('hauPerformanceSelect');
    hauPerformanceSelect.addEventListener('change', (e) => {
        updateHauPieChart(e.target.value);
    });
    updateHauPieChart('overall');
    @endif

    // AJAX Pagination for takers table
    function fetchTable(pageUrl) {
        fetch(pageUrl, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.text())
        .then(html => {
            document.getElementById('tableContainer').innerHTML = html;
            attachPaginationLinks();
        })
        .catch(error => console.error('Error fetching table:', error));
    }
    function attachPaginationLinks() {
        // Ensure we target the pagination container we added in the partial view
        document.querySelectorAll('#tableContainer .ajax-pagination a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                fetchTable(this.href);
            });
        });
    }
    // Attach on initial load
    attachPaginationLinks();
    </script>

    <style>
        #statsContainer,
        #chartContainer {
            transition: opacity 0.3s ease-in-out;
        }
        .opacity-0 {
            opacity: 0;
        }
        .opacity-100 {
            opacity: 1;
        }
    </style>
</x-app-layout>
