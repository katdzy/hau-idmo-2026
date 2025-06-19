<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subjects List</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Custom styling for popup */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9fafb;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            text-align: left;
            padding: 16px;
        }

        th {
            background-color: maroon; /* Primary color */
            color: white;
            text-transform: uppercase;
            font-weight: 600;
        }

        td {
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f0f4f8;
        }

        /* Pagination Styles */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 16px;
        }

        .pagination button {
            padding: 8px 16px;
            border: none;
            background-color: #f3f4f6;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
        }

        .pagination button:hover {
            background-color: #ddd;
        }

        .pagination .active {
            background-color: #b91c1c; /* Primary color */
            color: white;
        }

        /* Custom Close Button */
        .close-btn {
            background-color: transparent;
            border: none;
            color: #b91c1c; /* Primary color */
            font-weight: bold;
            cursor: pointer;
        }

        .close-btn:hover {
            color: #9b1c1c; /* Darker shade */
        }
    </style>
</head>
<body>

<div class="flex items-center justify-center py-6">
    <div class="w-full max-w-[800px] bg-white shadow-xl rounded-lg p-6">

        <!-- Popup Header -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold text-gray-800">Subjects List</h2>
            <button onclick="window.close();" class="close-btn">Close</button>
        </div>

        <!-- Table Section -->
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="text-left text-sm font-medium px-4 py-2">Subject Code</th>
                        <th class="text-left text-sm font-medium px-4 py-2">Subject Title</th>
                        <th class="text-left text-sm font-medium px-4 py-2">Units</th>
                        <th class="text-left text-sm font-medium px-4 py-2">School Year</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subjects as $subject)
                        <tr class="hover:bg-gray-100">
                            <td class="text-sm font-normal px-4 py-3">{{ $subject->subj_code }}</td>
                            <td class="text-sm font-normal px-4 py-3">{{ $subject->subj_title }}</td>
                            <td class="text-sm font-normal px-4 py-3">{{ $subject->units }}</td>
                            <td class="text-sm font-normal px-4 py-3">{{ $subject->subj_sy }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination Section -->
        <div class="pagination">
            {{ $subjects->links() }} <!-- Tailwind pagination links -->
        </div>

        <!-- Empty Subjects Message -->
        @if($subjects->isEmpty())
            <div class="text-center text-gray-600 mt-4">
                <p class="italic">No subjects found.</p>
            </div>
        @endif

    </div>
</div>

</body>
</html>
