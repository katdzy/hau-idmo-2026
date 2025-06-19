<x-app-layout>
    <div class="p-6 min-h-screen">
        <div class="bg-white rounded-xl shadow-lg p-8 flex flex-col space-y-8 relative">
            <a href="{{ route('admin.prc') }}" class="w-[15%] rounded-lg flex items-center justify-center py-2 bg-red-900 text-white font-bold gap-1 hover:bg-red-700">
                    <img src="{{ asset('images/icons/back.png') }}" class="w-[20px] h-[20px]" alt="Back">
                    Back
                </a>
            <h1 class="text-2xl font-bold mb-6">Add New PRC Results</h1>
            <div class="flex gap-10">
                <div class="border rounded-lg p-4 w-1/2 flex flex-col items-center justify-center hover:bg-gray-100 cursor-pointer">
                    <h2 class="font-bold text-xl mb-4">Upload an Image</h2>
                    <p class="mb-4 text-gray-600">Use OCR to extract data from an uploaded image.</p>
                    <a href="{{ route('admin.prc.add.upload') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Select</a>
                </div>
                <div class="border rounded-lg p-4 w-1/2 flex flex-col items-center justify-center hover:bg-gray-100 cursor-pointer">
                    <h2 class="font-bold text-xl mb-4">Enter Manually</h2>
                    <p class="mb-4 text-gray-600">Manually input the data into the form.</p>
                    <a href="{{ route('admin.prc.add.manual') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Select</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
