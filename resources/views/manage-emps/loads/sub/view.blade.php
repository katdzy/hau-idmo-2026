<!-- resources/views/admin/loads/sub/view.blade.php -->
<x-app-layout>
    <div class="min-h-screen">
        <div class="w-full flex justify-center py-8">
            <div class="w-[95%] flex flex-col justify-start items-start rounded-xl p-8 bg-white shadow-lg">
                <!-- Success Message -->
                @if (session('success'))
                    <div class="bg-green-500 text-white p-4 rounded-md mb-4">
                        <p class="text-sm font-medium">{{ session('success') }}</p>
                    </div>
                @endif
                <!-- Display flash message from session -->
                @if(session('msg'))
                    <div class="w-full flex items-center justify-between bg-green-600 text-white rounded-lg px-4 py-2 shadow-md my-2">
                        <div class="flex items-center space-x-2">
                            <h1 class="font-bold text-lg">{{ session('msg') }}</h1>
                        </div>
                        <button onclick="this.parentElement.remove();" class="text-white hover:text-gray-200 transition duration-200">
                            &times; <!-- Close button -->
                        </button>
                    </div>
                @endif
                <a href="{{ route('admin.lbs') }}" class="flex gap-1 items-center justify-center bg-red-900 hover:bg-red-700 px-6 py-1 text-white rounded-xl">
                    <img src="{{ asset('images/icons/back.png') }}" class="w-[20px] h-[20px]" alt="">
                    <span>Return to Subjects</span>
                </a>

                <!-- Subject Details Section -->
                <div class="mb-8 w-full">
                    <h2 class="text-2xl font-bold text-red-900 mb-4">Subject Details</h2>
                    <div class="bg-gray-100 p-6 rounded-lg shadow-inner">
                        <p class="text-gray-700"><strong>Subject ID:</strong> {{ $subj->subj_id }}</p>
                        <p class="text-gray-700"><strong>Subject Code:</strong> {{ $subj->subj_code }}</p>
                        <p class="text-gray-700"><strong>Subject:</strong> {{ $subj->subj_title }}</p>
                        <p class="text-gray-700"><strong>Units:</strong> {{ $subj->units }}</p>
                    </div>
                </div>

                <!-- Loads List Section -->
                <div class="mb-8 w-full">
                    <h2 class="text-2xl font-bold text-red-900 mb-4">Teaching Loads</h2>
                    <div class="overflow-x-auto flex flex-col">
                        @if($loads->count() > 0) 
                            <table class="min-w-full divide-y divide-gray-200 bg-white rounded-lg shadow-lg overflow-hidden">
                                <thead class="bg-red-900 text-white">
                                    <tr class="grid grid-cols-[15%_30%_10%_10%_10%_15%_5%]">
                                        <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">Employee ID</th>
                                        <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">Full Name</th>
                                        <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">Class</th>
                                        <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">Class Dept</th>
                                        <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">SY</th>
                                        <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">Semester</th>
                                        <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach($loads as $load)
                                        <tr class="grid grid-cols-[15%_30%_10%_10%_10%_15%_5%] text-gray-600 hover:bg-gray-100 transition duration-300">
                                            <td class="px-6 py-4 whitespace-nowrap text-md">{{ $load->user->emp_id }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-md">{{ $load->user->emp_lname }}, {{ $load->user->emp_fname }} {{ $load->user->emp_mname }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-md">{{ $load->class_code }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-md">{{ $load->class_dept }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-md">{{ $load->sy }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-md">{{ $load->semester }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-md"> 
                                                <form id="edit-dependent-form" action="{{ route('admin.loads.search.delete', ['id' => $load->id]) }}" method="POST"> 
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="emp_id" value="{{ $load->user->emp_id }}"> 
                                                    <!-- Pass redirect value to tell controller to go back to view page -->
                                                    <input type="hidden" name="redirect" value="view">
                                                    <!-- Pass the subject id so the controller can redirect correctly -->
                                                    <input type="hidden" name="subj_id" value="{{ $subj->subj_id }}">
                                                    <button type="button" onclick="confirmDelete(this)" class="bg-red-900 text-white rounded-lg px-2 py-1 hover:bg-red-800 transition duration-200">
                                                        Delete
                                                    </button>  
                                                </form> 
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else 
                            <div class="w-full">
                                <span class="text-gray-400 text-[0.8rem]">No user loaded into this subject.</span>
                            </div>
                        @endif
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function confirmDelete(button) { 
        if (confirm('Are you sure you want to delete this load?')) { 
            const form = button.closest('form'); 
            form.submit(); 
        }
    }
</script>
