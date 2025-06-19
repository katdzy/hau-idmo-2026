<x-app-layout>
    <div class="min-h-screen">
        <div class="w-full flex justify-center py-8">
            <div class="w-[95%] flex flex-col rounded-xl p-8 bg-white shadow-lg">

                <!-- Certificate Details -->
                <div class="mb-6">
                    <h3 class="text-xl font-semibold mb-2">Certificate Details</h3>
                    <p class="text-gray-700"><strong>Title:</strong> {{ $data->cert_title }}</p>
                    <p class="text-gray-700"><strong>Issued By:</strong> {{ $data->issued_by }}</p>
                    <p class="text-gray-700"><strong>Date Issued:</strong> {{ \Carbon\Carbon::parse($data->date_issued)->format('M d, Y') }}</p>
                    <p class="text-gray-700"><strong>Validity:</strong> {{ \Carbon\Carbon::parse($data->cert_validity)->format('M d, Y') }}</p>
                    
                    <!-- Show/Hide Preview Button -->
                    <button id="togglePreview" class="mt-4 bg-red-900 text-white px-4 py-2 rounded-md hover:bg-red-800 focus:outline-none">
                        Show Preview
                    </button>
                    
                    <!-- Iframe for Certificate Preview -->
                    <div id="previewContainer" class="hidden my-2">
                        <iframe src="{{ asset('storage/' . $data->file_path) }}" width="100%" height="500px" frameborder="0"></iframe>
                    </div>
                </div>

                <!-- Employee List -->
                <h3 class="text-xl font-semibold mb-2">Issued To:</h3>
                @if(count($certs)) 
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($certs as $cert)
                            <div class="flex items-center p-4 border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                                <div class="flex-shrink-0">
                                    @if($cert->user->profile_picture == '')
                                        <img src="{{ asset('images/blankdp.jpg') }}" class="w-[50px] h-[50px] rounded-full" alt="Profile Picture">
                                    @else
                                        <img src="{{ asset('storage/profile_pictures/' . $cert->user->profile_picture) }}" class="w-[50px] h-[50px] rounded-full" alt="Profile Picture">
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <span class="font-medium">{{ $cert->user->emp_lname }}, {{ $cert->user->emp_fname }} {{ $cert->user->emp_mname }}</span>
                                    <div class="text-gray-500">Employee ID: {{ $cert->user->emp_id }}</div>
                                </div>
                            </div>
                        @endforeach 
                    </div>
                @else
                    <p class="text-gray-600">No employees have been issued this certificate yet.</p>
                @endif

            </div>
        </div>
    </div>

    <script>
        // Toggle the visibility of the certificate preview
        document.getElementById('togglePreview').addEventListener('click', function() {
            const previewContainer = document.getElementById('previewContainer');
            if (previewContainer.classList.contains('hidden')) {
                previewContainer.classList.remove('hidden');
                this.textContent = 'Hide Preview';
            } else {
                previewContainer.classList.add('hidden');
                this.textContent = 'Show Preview';
            }
        });
    </script>
</x-app-layout>
