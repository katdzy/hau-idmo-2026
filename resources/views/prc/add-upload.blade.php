<x-app-layout>
    <div class="p-6 min-h-screen flex flex-col items-center">
        <div class="bg-white rounded-xl shadow-lg p-8 w-full relative">
            <a href="{{ route('admin.prc.addInitial') }}" class="w-[15%] rounded-lg flex items-center justify-center py-2 bg-red-900 text-white font-bold gap-1 hover:bg-red-700 mb-2">
            <img src="{{ asset('images/icons/back.png') }}" class="w-[20px] h-[20px]" alt="Back">
                Back
            </a>

            <h1 class="text-2xl font-bold mb-6 text-gray-800">Upload Images for OCR</h1>

            <!-- Instructions Section -->
            <div class="mb-6 space-y-3 text-gray-800">
                <h2 class="text-lg font-semibold">Before You Proceed</h2>
                <ul class="list-disc list-inside space-y-1">
                    <!-- <li><strong>Quality Over Quantity:</strong> High-resolution, zoomed-in images yield better accuracy.</li> -->
                    <li><strong>No Headers or Column Names:</strong> Only include raw data (School Name, First-Time Takers, Repeaters Data).</li>
                    <li><strong>OCR Not 100% Accurate:</strong> Double-check the extracted data before submission.</li>
                    <li><strong>Required Format:</strong> The screenshot should contain only the school name and relevant numbers. Additional data will be computed automatically.</li>
                </ul>

                <button type="button" class="inline-flex items-center gap-2 bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded mt-3" id="sampleScreenshotBtn">
                    <img src="{{ asset('images/icons/eye.svg') }}" alt="View Sample Screenshot" class="w-5 h-5">
                    View Sample Screenshot
                </button>
            </div>

            <!-- Modal for sample screenshot -->
            <div id="sampleScreenshotModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white p-4 rounded shadow-lg relative max-w-3xl w-full">
                    <button type="button" class="absolute top-2 right-2 text-red-500 font-bold hover:text-red-700" id="closeModalBtn">
                        X
                    </button>
                    <img src="{{ asset('images/sample_screenshot.png') }}" alt="Sample Screenshot" class="w-full h-auto rounded border border-gray-200">
                </div>
            </div>

            <form action="{{ route('admin.prc.ocr.process') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div id="fileInputsContainer" class="space-y-4">
                    <div class="flex items-center space-x-2">
                        <div class="relative inline-block">
                            <input type="file" name="ocr_images[]" accept=".jpg,.jpeg,.png" 
                                   class="border border-gray-300 rounded p-2 w-72" required>
                        </div>
                    </div>
                </div>

                <div class="flex space-x-2">
                    <button type="button" id="addFileInputBtn" 
                            class="bg-blue-500 text-white px-3 py-1.5 rounded hover:bg-blue-600">Add Another Screenshot</button>
                </div>

                <div>
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Process OCR</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const addFileInputBtn = document.getElementById('addFileInputBtn');
        const fileInputsContainer = document.getElementById('fileInputsContainer');

        addFileInputBtn.addEventListener('click', function() {
            const div = document.createElement('div');
            div.classList.add('flex', 'items-center', 'space-x-2');

            div.innerHTML = `
                <div class="relative inline-block">
                    <input type="file" name="ocr_images[]" accept=".jpg,.jpeg,.png" class="border border-gray-300 rounded p-2 w-72" required>
                </div>
                <button type="button" class="removeFileInputBtn text-white bg-red-500 hover:bg-red-600 font-bold py-1 px-2 rounded">
                    X
                </button>
            `;

            fileInputsContainer.appendChild(div);
        });

        fileInputsContainer.addEventListener('click', function(e) {
            if (e.target.classList.contains('removeFileInputBtn')) {
                const parentDiv = e.target.closest('div.flex.items-center');
                if (parentDiv) {
                    parentDiv.remove();
                }
            }
        });

        const sampleBtn = document.getElementById('sampleScreenshotBtn');
        const modal = document.getElementById('sampleScreenshotModal');
        const closeModalBtn = document.getElementById('closeModalBtn');

        sampleBtn.addEventListener('click', () => {
            modal.classList.remove('hidden');
        });

        closeModalBtn.addEventListener('click', () => {
            modal.classList.add('hidden');
        });

        // Hide modal on outside click
        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.add('hidden');
            }
        });
    </script>
</x-app-layout>
