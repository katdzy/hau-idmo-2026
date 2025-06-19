<x-app-layout>
    <div class="min-h-screen">
        <div class="w-full flex justify-center py-8">
            <div class="w-[95%] flex flex-col rounded-xl p-8 bg-white items-start">

            <a href="{{route('admin.registry.dept')}}" class="flex gap-1 items-center justify-center bg-red-900 hover:bg-red-700 px-6 py-1 text-white rounded-xl my-4">
            <img src="{{asset('images/icons/back.png')}}" class="w-[20px] h-[20px]" alt="">
            <span>Return to Departments</span>
        </a>



                <h1 class="text-gray-500 font-bold text-2xl">Update Department</h1>
                <form action="{{route('admin.dept.update',['id'=> $dept->id])}}" method="POST" enctype="multipart/form-data" class="space-y-6 w-full">
                    @csrf
                    @method('PUT')

                    <!-- Department Code -->
                    <div>
                        <label for="code" class="block text-sm font-medium text-gray-700">Department Code</label>
                        <input type="text" name="code" id="code" value="{{ old('code', $dept->code) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    </div>

                    <!-- Department Name -->
                    <div>
                        <label for="dept" class="block text-sm font-medium text-gray-700">Department Name</label>
                        <input type="text" name="dept" id="dept" value="{{ old('dept', $dept->dept) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    </div>

                    <!-- Department Logo -->
                    <div>
                        <label for="logo" class="block text-sm font-medium text-gray-700">Department Logo</label>
                        
                        @if ($dept->logo)
                            <p class="mt-2 text-sm text-gray-600">Current Logo: <img src="{{ asset('storage/dept/logo/' . $dept->logo) }}" alt="Logo" class="inline-block h-12"></p>
                            <label for="logo" class="block mt-2 text-sm text-gray-700">Change Logo (optional):</label>
                            <input type="file" name="logo" id="logo" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-indigo-100">
                        @else
                            <p class="mt-2 text-sm text-red-600">No logo uploaded yet.</p>
                            <button id="showUpload" type="button" class="mt-4 px-4 py-2 bg-red-900 text-white rounded-md shadow-sm hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                Add Logo (Optional)
                            </button>

                            <div id="uploadSection" class="mt-4 hidden">
                                <input type="file" name="logo" id="logo" class="block w-full text-sm text-gray-500 py-1 px-2
                                border border-gray-100 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
                            </div>
                        @endif
                    </div>

                    <!-- Submit Button -->`
                    <div class="flex justify-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-900 hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Update Department
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>

        * { 
            transition: 300ms; 
        }
    </style>

    <script>
        document.getElementById('showUpload').addEventListener('click', function() {
            document.getElementById('uploadSection').classList.remove('hidden');
            this.classList.add('hidden');
        });


        
    </script>
</x-app-layout>
