<!-- resources/views/portal/profile-edit/personal-data.blade.php -->
<div class="w-full flex justify-center py-8">
    <div class="w-full flex flex-col rounded-xl p-0 bg-white">
        <form action="{{ route('portal.personal-data', ['id' => Auth::user()->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Start of personal data box -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="emp_fname">First Name</label>
                    <input type="text" id="emp_fname" name="emp_fname" value="{{ $data->emp_fname ?? 'n/a' }}" class="shadow border rounded-md w-full py-2 px-3 text-gray-700" placeholder="Enter first name" required>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="emp_mname">Middle Name</label>
                    <input type="text" id="emp_mname" name="emp_mname" value="{{ $data->emp_mname ?? 'n/a' }}" class="shadow border rounded-md w-full py-2 px-3 text-gray-700" placeholder="Enter middle name">
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="emp_lname">Last Name</label>
                    <input type="text" id="emp_lname" name="emp_lname" value="{{ $data->emp_lname ?? 'n/a' }}" class="shadow border rounded-md w-full py-2 px-3 text-gray-700" placeholder="Enter last name" required>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="emp_gender">Gender</label>
                    <select id="emp_gender" name="emp_gender" class="shadow border rounded-md w-full py-2 px-3 text-gray-700" required>
                        @foreach($gender_tags as $tag)
                            <option value="{{ $tag->item }}" 
                                @if(strtolower($tag->item) == strtolower($data->emp_gender)) 
                                    selected 
                                @endif>
                                {{ $tag->item }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="emp_dob">Date of Birth</label>
                    <input type="date" name="emp_dob" id="emp_dob" 
                        value="{{ isset($data->emp_dob) ? \Carbon\Carbon::parse($data->emp_dob)->format('Y-m-d') : '' }}"
                        class="shadow border rounded-md w-full py-2 px-3 text-gray-700" required>
                    <p id="dobError" class="text-red-500 text-sm mt-2 hidden">You must be at least 18 years old.</p>
                    </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="emp_pob">Place of Birth</label>
                    <input type="text" id="emp_pob" name="emp_pob" value="{{ $data->emp_pob ?? 'n/a' }}" class="shadow border rounded-md w-full py-2 px-3 text-gray-700" placeholder="Enter place of birth">
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="emp_cStatus">Civil Status</label>
                    <select id="emp_cStatus" name="emp_cStatus" value="{{ $data->emp_cStatus ?? 'n/a' }}" class="shadow border rounded-md w-full py-2 px-3 text-gray-700">
                        @foreach($civil_status as $tag)
                            <option value="{{ $tag->item }}" 
                                @if(strtolower($tag->item) == strtolower($data->emp_cStatus)) 
                                    selected 
                                @endif>
                                {{ $tag->item }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="emp_religion">Religion</label>
                    <input type="text" id="emp_religion" name="emp_religion" value="{{ $data->emp_religion ?? 'n/a' }}" class="shadow border rounded-md w-full py-2 px-3 text-gray-700" placeholder="Enter religion">
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="emp_blood_type">Blood Type</label>
                    <input type="text" id="emp_blood_type" name="emp_blood_type" value="{{ $data->emp_blood_type ?? 'n/a' }}" class="shadow border rounded-md w-full py-2 px-3 text-gray-700" placeholder="Enter blood type">
                </div>
            </div>

            <div class="line-break mt-6 mb-4">
                <hr class="border-gray-300">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="emp_email">Email Address</label>
                    <input type="text" id="emp_email" name="emp_email" value="{{ Auth::user()->email ?? 'n/a' }}" disabled class="bg-gray-100 shadow border rounded-md w-full py-2 px-3 text-gray-700">
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="role">Role</label>
                    <input type="text" id="role" name="role" value="{{ Auth::user()->role ?? 'n/a' }}" disabled class="bg-gray-100 shadow border rounded-md w-full py-2 px-3 text-gray-700">
                </div>
            </div>

            <div class="line-break mt-6 mb-4">
                <hr class="border-gray-300">
            </div>

            <div class="flex justify-end mt-6">
                <button type="submit" class="w-full md:w-auto bg-red-900 text-white font-bold py-2 px-4 rounded-md shadow hover:bg-red-700 transition duration-300">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('emp_dob').addEventListener('change', function () {
        const dobInput = this.value;
        const dob = new Date(dobInput);
        const today = new Date();
        const age = today.getFullYear() - dob.getFullYear();
        const monthDiff = today.getMonth() - dob.getMonth();
        const dayDiff = today.getDate() - dob.getDate();

        if (age < 18 || (age === 18 && monthDiff < 0) || (age === 18 && monthDiff === 0 && dayDiff < 0)) {
            document.getElementById('dobError').classList.remove('hidden');
            this.setCustomValidity("You must be at least 18 years old.");
        } else {
            document.getElementById('dobError').classList.add('hidden');
            this.setCustomValidity("");
        }
    });
</script>
