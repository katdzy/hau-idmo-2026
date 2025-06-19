<x-app-layout>
    <div class="p-6 min-h-screen">
        <div class="bg-white rounded-xl shadow-lg p-8 flex flex-col space-y-8 relative">
            <div class="w-full flex flex-col rounded-lg mb-2">
                <a href="{{ route('admin.prc.addInitial') }}" class="w-[15%] rounded-lg flex items-center justify-center py-2 bg-red-900 text-white font-bold gap-1 hover:bg-red-700">
                    <img src="{{ asset('images/icons/back.png') }}" class="w-[20px] h-[20px]" alt="Back">
                    Back
                </a>
            </div>
            <h1 class="text-2xl font-bold mb-6">Add New PRC Results</h1>

            <form action="{{ route('admin.prc.store') }}" method="POST">
                @csrf
                <!-- Examination Title and Date Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Examination Title</label>
                        <select name="title" class="w-full border rounded p-1" required>
                            <option value="" disabled selected>Select...</option>
                            @foreach ($prc_exams as $item)
                                <option value="{{ $item->item }}">{{ $item->item }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Date</label>
                        <input type="date" name="exam_date" class="w-full border rounded p-1" min ="1973-06-22" max="{{ date('Y-m-d') }}" required>
                    </div>
                </div>

                <div class="overflow-auto">
                    <table class="min-w-full border-collapse border">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border p-2 text-center align-middle">School</th>
                                <th colspan="3" class="border p-2 text-center">First Timers</th>
                                <th colspan="3" class="border p-2 text-center">Repeaters</th>
                                <th class="border p-2"></th>
                            </tr>
                            <tr>
                                <th class="border p-2 text-center"></th>
                                <th class="border p-2 text-center">Passed</th>
                                <th class="border p-2 text-center">Failed</th>
                                <th class="border p-2 text-center">Conditional</th>
                                <th class="border p-2 text-center">Passed</th>
                                <th class="border p-2 text-center">Failed</th>
                                <th class="border p-2 text-center">Conditional</th>
                                <th class="border p-2 text-center"></th>
                            </tr>
                        </thead>
                        <tbody id="prc-rows">
                            <tr>
                                <td class="border p-2">
                                    <input type="text" name="schoolsData[0][school]" class="w-full border rounded p-1" placeholder="e.g. University of XYZ" required>
                                </td>
                                <td class="border p-2">
                                    <input type="number" min="0" name="schoolsData[0][first_pass]" class="w-full border rounded p-1" placeholder="0" required>
                                </td>
                                <td class="border p-2">
                                    <input type="number" min="0" name="schoolsData[0][first_fail]" class="w-full border rounded p-1" placeholder="0" required>
                                </td>
                                <td class="border p-2">
                                    <input type="number" min="0" name="schoolsData[0][first_cond]" class="w-full border rounded p-1" placeholder="0" required>
                                </td>
                                <td class="border p-2">
                                    <input type="number" min="0" name="schoolsData[0][repeat_pass]" class="w-full border rounded p-1" placeholder="0" required>
                                </td>
                                <td class="border p-2">
                                    <input type="number" min="0" name="schoolsData[0][repeat_fail]" class="w-full border rounded p-1" placeholder="0" required>
                                </td>
                                <td class="border p-2">
                                    <input type="number" min="0" name="schoolsData[0][repeat_cond]" class="w-full border rounded p-1" placeholder="0" required>
                                </td>
                                <td class="border p-2 text-center">
                                    <div class="flex items-center gap-2 justify-center">
                                        <button type="button" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600 add-row" title="Add Row">+</button>
                                        <button type="button" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600 delete-row" title="Delete Row">
                                            <img src="{{ asset('images/icons/delete.png') }}" alt="Delete" class="w-4 h-4 inline">
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const prcRows = document.getElementById('prc-rows');

            // Function to create a new row
            function createNewRow() {
                const rowCount = prcRows.children.length;
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td class="border p-2">
                        <input type="text" name="schoolsData[${rowCount}][school]" class="w-full border rounded p-1" placeholder="e.g. University of XYZ" required>
                    </td>
                    <td class="border p-2">
                        <input type="number" min="0" name="schoolsData[${rowCount}][first_pass]" class="w-full border rounded p-1" placeholder="0" required>
                    </td>
                    <td class="border p-2">
                        <input type="number" min="0" name="schoolsData[${rowCount}][first_fail]" class="w-full border rounded p-1" placeholder="0" required>
                    </td>
                    <td class="border p-2">
                        <input type="number" min="0" name="schoolsData[${rowCount}][first_cond]" class="w-full border rounded p-1" placeholder="0" required>
                    </td>
                    <td class="border p-2">
                        <input type="number" min="0" name="schoolsData[${rowCount}][repeat_pass]" class="w-full border rounded p-1" placeholder="0" required>
                    </td>
                    <td class="border p-2">
                        <input type="number" min="0" name="schoolsData[${rowCount}][repeat_fail]" class="w-full border rounded p-1" placeholder="0" required>
                    </td>
                    <td class="border p-2">
                        <input type="number" min="0" name="schoolsData[${rowCount}][repeat_cond]" class="w-full border rounded p-1" placeholder="0" required>
                    </td>
                    <td class="border p-2 text-center">
                        <div class="flex items-center gap-2 justify-center">
                            <button type="button" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600 add-row" title="Add Row">+</button>
                            <button type="button" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600 delete-row" title="Delete Row">
                                <img src="{{ asset('images/icons/delete.png') }}" alt="Delete" class="w-4 h-4 inline">
                            </button>
                        </div>
                    </td>
                `;
                prcRows.appendChild(newRow);
            }

            // Event delegation for Add and Delete buttons
            prcRows.addEventListener('click', function (e) {
                if (e.target.closest('.add-row')) {
                    createNewRow();
                }

                if (e.target.closest('.delete-row')) {
                    const row = e.target.closest('tr');
                    if (prcRows.children.length > 1) { // Ensure at least one row remains
                        row.remove();
                        // Update the name attributes to maintain proper indexing
                        Array.from(prcRows.children).forEach((tr, index) => {
                            tr.querySelectorAll('input').forEach(input => {
                                const nameParts = input.getAttribute('name').split('][');
                                nameParts[0] = `schoolsData[${index}][${nameParts[0].split('[')[1]}`;
                                input.setAttribute('name', nameParts.join(']['));
                            });
                        });
                    } else {
                        alert('At least one row must be present.');
                    }
                }
            });
        });
    </script>
</x-app-layout>
