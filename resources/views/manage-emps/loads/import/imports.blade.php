<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data List</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html, body {
            height: 100%; /* Ensure the body and HTML element take full height */
            margin: 0;
        }
        .popup-content {
            height: 100%; /* Make the content area take up full height of the popup */
            overflow-y: auto; /* Enable vertical scrolling */
        }
    </style>
</head>
<body class="bg-gray-100">

    <div class="w-full h-full flex items-center justify-center">
        <div class="w-full h-full max-w-full bg-white rounded-lg shadow-md px-6 py-8 popup-content">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Teaching Loads - File Upload List</h2>
            
            {{-- Data Table --}}
            <div class="overflow-hidden rounded-lg border border-gray-300">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-100 text-gray-600 text-sm uppercase sticky top-0"> <!-- Sticky header -->
                        <tr>
                            <th class="text-left py-3 px-4">#</th>
                            <th class="text-left py-3 px-4">EMP ID</th>
                            <th class="text-left py-3 px-4">FULL NAME</th>
                            <th class="text-left py-3 px-4">SUBJECT</th>
                            <th class="text-left py-3 px-4">CLASS CODE</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm">
                        @foreach($loads as $index => $load)
                            <tr class="{{ $index % 2 === 0 ? 'bg-gray-50' : 'bg-white' }}">
                                <td class="py-3 px-4">{{ $index + 1 }}</td>
                                <td class="py-3 px-4">{{ $load->emp_id }}</td>
                                <td class="py-3 px-4">{{ $load->user->emp_lname . ', ' . $load->user->emp_fname . ' ' . $load->user->emp_mname }}</td>
                                <td class="py-3 px-4">{{ $load->subject->subj_code }}</td>
                                <td class="py-3 px-4">{{ $load->class_code }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>
