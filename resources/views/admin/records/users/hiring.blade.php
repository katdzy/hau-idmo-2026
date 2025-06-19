<x-app-layout>
    <div class= "min-h-screen">
        <div class="w-full flex items-center justify-center py-8">
            <div class="w-[95%] bg-white px-6 py-6 rounded-lg shadow-md">
                
                <h2 class="text-2xl font-semibold text-red-900 mb-6">Update Hiring Information</h2>
                
                <form action="{{ route('admin.hiring.save', $user->emp_id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Position -->
                    <div>
                        <label for="position" class="block text-gray-700 font-medium mb-2">Position</label>
                        <select 
                            id="position" 
                            name="position" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900"
                            required>
                            @foreach ($position as $pos)
                                <option value="{{ $pos->item }}" 
                                    {{ $user->emp_position == $pos->item ? 'selected' : '' }}>{{ $pos->item }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Department -->
                    <div>
                        <label for="department" class="block text-gray-700 font-medium mb-2">Department</label>
                        <select 
                            id="department" 
                            name="department" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900"
                            required>
                            @foreach ($dept as $department)
                                <option value="{{ $department->dept }}" 
                                    {{ $user->user->department->dept == $department->dept ? 'selected' : '' }}>{{ $department->dept }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Nature -->
                    <div>
                        <label for="nature" class="block text-gray-700 font-medium mb-2">Nature</label>
                        <select 
                            id="nature" 
                            name="nature" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900"
                            required>
                            @foreach ($nature as $nat)
                                <option value="{{ $nat->item }}" 
                                    {{ $user->emp_nature == $nat->item ? 'selected' : '' }}>{{ $nat->item }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tenure -->
                    <div>
                        <label for="tenure" class="block text-gray-700 font-medium mb-2">Tenure</label>
                        <select 
                            id="tenure" 
                            name="tenure" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900"
                            onchange="toggleNonTenuredField()">
                            @foreach ($tenure as $ten)
                                <option value="{{ $ten->item }}" 
                                    {{ $user->emp_tenure == $ten->item ? 'selected' : '' }}>{{ $ten->item }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Non-Tenured Info (Conditional) -->
                    <div id="non-tenured-field" class="{{ $user->emp_tenure == 'Non-tenured' ? '' : 'hidden' }}">
                        <label for="nontenured" class="block text-gray-700 font-medium mb-2">Non-Tenured Info</label>
                        <select 
                            id="nontenured" 
                            name="nontenured" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900">
                            @foreach ($nontenured as $item)
                                <option value="{{ $item->item }}" 
                                    {{ $user->non_tenured == $item->item ? 'selected' : '' }}>{{ $item->item }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex">
                        <label for="license" class="block text-gray-700 font-medium mb-1">Required License</label>
                        <input type="hidden" name="license" value="0">
                        <input name="license" type="checkbox" id="license" value="1" 
                            {{ $user->license ? 'checked' : '' }}
                            class="ml-2 px-3 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900">
                    </div>
                    <!-- Action Buttons -->
                    <div class="flex justify-between">
                        <!-- Cancel Button -->
                        <a href="{{ route('admin.users.view', $user->emp_id) }}" 
                            class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md text-sm">
                            Return to Previous Page
                        </a>
                        
                        <!-- Update Button -->
                        <button 
                            type="submit" 
                            class="bg-red-900 text-white px-6 py-2 rounded-md shadow focus:outline-none focus:ring-2 focus:ring-red-900">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Function to toggle the visibility of the Non-Tenured Info field
        function toggleNonTenuredField() {
            const tenureValue = document.getElementById('tenure').value;
            const nonTenuredField = document.getElementById('non-tenured-field');
            
            // Check if the selected tenure value is 'NON-TENURED' and toggle visibility accordingly
            if (tenureValue === 'Non-tenured') {
                nonTenuredField.classList.remove('hidden');
            } else {
                nonTenuredField.classList.add('hidden');
            }
        }

        // Initialize on page load to ensure the non-tenured field is shown if needed
        document.addEventListener('DOMContentLoaded', () => {
            toggleNonTenuredField();
        });

        // Close the success message
        function closeSuccessMessage() {
            const successMessage = document.getElementById('success-message');
            successMessage.style.display = 'none';
        }
    </script>
</x-app-layout>
