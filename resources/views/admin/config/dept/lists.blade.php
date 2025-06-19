<x-app-layout>
    <div class="w-full flex justify-center py-8">
        <div class="w-[95%] flex flex-col items-start bg-white rounded-lg p-8">

            <h1 class="text-[2rem] font-bold text-gray-700">Departments - File Manager</h1>

            <div class="w-full flex justify-start mb-4">
                <button id="updatedListBtn" class="px-8 py-4 hover:bg-gray-100 text-gray-600 font-semibold active_link" onclick="setActiveTab('updatedList')">Updated History</button>
                <button id="templatesBtn" class="px-8 py-4 hover:bg-gray-100 text-gray-600 font-semibold" onclick="setActiveTab('templates')">Templates</button>
            </div>

            <hr class="w-full opacity-90 mb-4">

            <!-- Most Recent File Section -->
            <div id="mostRecentFile" class="w-full bg-gray-50 border border-gray-200 rounded-lg p-4 mb-4">
                <h2 class="text-lg font-bold text-gray-700 mb-2">Most Recent File</h2>
                @if(isset($mostRecentFile))
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-100 border-b">
                                <th class="py-2 text-left text-gray-600">File Name</th>
                                <th class="py-2 text-left text-gray-600">File Size</th>
                                <th class="py-2 text-left text-gray-600">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-4 text-gray-700">{{ $mostRecentFile->name }}</td>
                                <td class="py-3 px-4 text-gray-700">{{ number_format($mostRecentFile->size / 1024, 2) }} KB</td>
                                <td class="py-3 px-4">
                                    <a href="{{ route('registry.dept.files.download', ['file' => $mostRecentFile->name]) }}" class="text-blue-500 hover:underline">Download</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                @else
                    <p class="text-gray-500">No recent files available.</p>
                @endif
            </div>

            <!-- File Manager Table for Updated List -->
            <div id="updatedList" class="w-full overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead>
                        <tr class="w-full bg-gray-100 border-b">
                            <th class="py-3 px-4 text-left text-gray-600">File Name</th>
                            <th class="py-3 px-4 text-left text-gray-600">File Size</th>
                            <th class="py-3 px-4 text-left text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($files as $file)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-4 text-gray-700">{{ $file->name }}</td>
                                <td class="py-3 px-4 text-gray-700">{{ number_format($file->size / 1024, 2) }} KB</td>
                                <td class="py-3 px-4">
                                    <a href="{{ asset('storage/sheets/app/' . $file->name) }}" class="text-blue-500 hover:underline">Download</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Template Section -->
                    <div id="templates" class="hidden w-full mt-4">
                        <h2 class="text-lg font-bold text-gray-700 mb-2">Templates</h2>
                        <div class="bg-gray-100 border border-gray-300 p-4 rounded-lg">
                            @if(!empty($template_files) && count($template_files) > 0)
                                <ul>
                                    @foreach($template_files as $template)
                                        <li class="py-2">
                                            {{ $template }} ({{ number_format(filesize(public_path('storage/sheets/temp/' . $template)) / 1024, 2) }} KB)
                                            <a href="{{ route('registry.dept.files.download_temp', ['file' => $template]) }}" class="text-blue-500 hover:underline">Download</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-gray-500">No templates available.</p>
                            @endif
                        </div>
                    </div>

        </div>
    </div>
</x-app-layout>

<style>
    a, button { 
        transition: 300ms;
    }
    .active_link { 
        border-bottom: 4px solid #FFD700;
    }
</style>

<script>
    function setActiveTab(tab) {
        const updatedList = document.getElementById('updatedList');
        const templates = document.getElementById('templates');
        const mostRecentFile = document.getElementById('mostRecentFile');
        const updatedListBtn = document.getElementById('updatedListBtn');
        const templatesBtn = document.getElementById('templatesBtn');

        if (tab === 'updatedList') {
            updatedList.classList.remove('hidden');
            templates.classList.add('hidden');
            mostRecentFile.classList.remove('hidden'); // Show the most recent file section
            updatedListBtn.classList.add('active_link');
            templatesBtn.classList.remove('active_link');
        } else if (tab === 'templates') {
            updatedList.classList.add('hidden');
            templates.classList.remove('hidden');
            mostRecentFile.classList.add('hidden'); // Hide the most recent file section
            templatesBtn.classList.add('active_link');
            updatedListBtn.classList.remove('active_link');
        }
    }
</script>
