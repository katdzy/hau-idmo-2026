<!-- resources\views\admin\config\sem\main.blade.php -->
<x-app-layout>
    <div class="min-h-screen">
        <div class="w-full flex justify-center py-8">
            <div class="w-[95%] flex flex-col rounded-xl p-8 bg-white shadow-lg">
                <a href="{{ route('admin.registry') }}" class="w-[15%] rounded-lg flex items-center justify-center py-2 bg-red-900 text-white font-bold gap-1 hover:bg-red-700">
                <img src="{{ asset('images/icons/back.png') }}" class="w-[20px] h-[20px]" alt="">
                    Back
                </a>
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-bold text-red-900">Current Semester</h2>
                </div>

                @if($msg != '' )
                <div class="w-full flex justify-center my-4" id="msg">
                    <div class="w-full bg-green-600 text-white rounded-lg shadow-md p-2 flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m-3-8a9 9 0 100 18 9 9 0 000-18z" />
                        </svg>
                        <span class="font-semibold">Success!</span>
                        <span>{{$msg}}</span>
                    </div>
                </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Regular Semester -->
                    <div class="relative p-6 border rounded-lg shadow-sm bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-700">Regular Semester</h3>
                        <p class="text-gray-600 text-2xl font-extrabold">{{$reg->current_sem}}</p>
                        <p class="text-gray-600">School Year: {{$reg->current_sy}}</p>

                        <button onclick="toggleEdit('regEdit')" class="absolute top-2 right-2 bg-red-900 text-white rounded-lg px-3 py-1 hover:bg-red-800 transition duration-200">
                            Edit
                        </button>

                        <!-- Regular Semester Edit Form -->
                        <div id="regEdit" class="hidden mt-4">
                            <form action = "{{route ('admin.sem.updatereg')}}" method = "POST">
                                @csrf 
                                @method('PUT')
                                <div>
                                    <label class="block text-gray-700">Current Semester</label>
                                    <select name = "sem" class="mt-1 block w-full border rounded-lg px-3 py-2">
                                        <option value="1ST SEMESTER" {{ $reg->current_sem == '1ST SEMESTER' ? 'selected' : '' }}>1ST SEMESTER</option>
                                        <option value="2ND SEMESTER" {{ $reg->current_sem == '2ND SEMESTER' ? 'selected' : '' }}>2ND SEMESTER</option>
                                    
                                        <!-- Add more options as needed -->
                                    </select>
                                </div>
                                <div class="mt-4">
                                    <label class="block text-gray-700">School Year</label>
                                    <input name = "sy" type="text" value="{{$reg->current_sy}}" class="mt-1 block w-full border rounded-lg px-3 py-2" />
                                </div>
                                <div class="flex justify-end mt-6">
                                    <button type="button" onclick="toggleEdit('regEdit')" class="bg-gray-300 text-gray-700 rounded-lg px-4 py-2 hover:bg-gray-200">Cancel</button>
                                    <button type="submit" class="bg-red-900 text-white rounded-lg px-4 py-2 hover:bg-red-800 ml-2">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Trimester Semester -->
                    <div class="relative p-6 border rounded-lg shadow-sm bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-700">Trimester Semester</h3>
                        <p class="text-gray-600 text-2xl font-extrabold">{{$tri->current_sem}}</p>
                        <p class="text-gray-600">School Year: {{$tri->current_sy}}</p>

                        <button onclick="toggleEdit('triEdit')" class="absolute top-2 right-2 bg-red-900 text-white rounded-lg px-3 py-1 hover:bg-red-800 transition duration-200">
                            Edit
                        </button>

                        <!-- Trimester Semester Edit Form -->
                        <div id="triEdit" class="hidden mt-4">
                        <form action = "{{route ('admin.sem.updatetri')}}" method = "POST">
                                @csrf 
                                @method('PUT')
                                <div>
                                    <label class="block text-gray-700">Current Semester</label>
                                    <select name = "sem"  class="mt-1 block w-full border rounded-lg px-3 py-2">
                                        <option value="1ST TRIMESTER" {{ $tri->current_sem == '1ST TRIMESTER' ? 'selected' : '' }}>1ST TRIMESTER</option>
                                        <option value="2ND TRIMESTER" {{ $tri->current_sem == '2ND TRIMESTER' ? 'selected' : '' }}>2ND TRIMESTER</option>
                                        <option value="3RD TRIMESTER" {{ $tri->current_sem == '3RD TRIMESTER' ? 'selected' : '' }}>3RD TRIMESTER</option>
                                        <!-- Add more options as needed -->
                                    </select>
                                </div>
                                <div class="mt-4">
                                    <label class="block text-gray-700">School Year</label>
                                    <input name = "sy" type="text" value="{{$tri->current_sy}}" class="mt-1 block w-full border rounded-lg px-3 py-2" />
                                </div>
                                <div class="flex justify-end mt-6">
                                    <button type="button" onclick="toggleEdit('triEdit')" class="bg-gray-300 text-gray-700 rounded-lg px-4 py-2 hover:bg-gray-200">Cancel</button>
                                    <button type="submit" class="bg-red-900 text-white rounded-lg px-4 py-2 hover:bg-red-800 ml-2">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function toggleEdit(editId) {
        const editForm = document.getElementById(editId);
        editForm.classList.toggle('hidden');
    }

    setTimeout(()=> { 
        document.getElementById('msg').style.display = 'none'
    }, 5000 )
</script>