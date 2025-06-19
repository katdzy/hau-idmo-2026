<div class="w-full flex justify-center py-8">
<div class="w-full flex flex-col rounded-xl p-0 bg-white">
        <form action="{{ route('portal.emergency', ['id' => Auth::user()->id]) }}" method="POST"> 
            @csrf
            @method('PUT')

            <div class='grid grid-cols-2 gap-4 mb-6'>
                <div>
                    <h3 class="text-gray-600">First Name</h3>
                    <input type="text" name="cp_fname" class="w-full p-2 border border-gray-300 rounded-md bg-gray-100" value="{{ $data->emergency_contact->cp_fname ?? 'n/a' }}">
                </div>
                <div>
                    <h3 class="text-gray-600">Middle Name</h3>
                    <input type="text" name="cp_mname" class="w-full p-2 border border-gray-300 rounded-md bg-gray-100" value="{{ $data->emergency_contact->cp_mname ?? 'n/a' }}">
                </div>
                <div>
                    <h3 class="text-gray-600">Last Name</h3>
                    <input type="text" name="cp_lname" class="w-full p-2 border border-gray-300 rounded-md bg-gray-100" value="{{ $data->emergency_contact->cp_lname ?? 'n/a' }}">
                </div>
                <div>
                    <h3 class="text-gray-600">Relationship</h3>
                    <input type="text" name="cp_relationship" class="w-full p-2 border border-gray-300 rounded-md bg-gray-100" value="{{ $data->emergency_contact->cp_relationship }}">
                </div>
            </div>

            <h1 class="text-lg font-semibold text-gray-700 mb-4">Present Address</h1>
            <div class='grid grid-cols-2 gap-4 mb-6'>
                <div>
                    <h3 class="text-gray-600">House No.</h3>
                    <input type="text" name="cp_house_no" class="w-full p-2 border border-gray-300 rounded-md bg-gray-100" value="{{ $data->emergency_contact->cp_house_no ?? 'n/a' }}">
                </div>
                <div>
                    <h3 class="text-gray-600">Street</h3>
                    <input type="text" name="cp_street" class="w-full p-2 border border-gray-300 rounded-md bg-gray-100" value="{{ $data->emergency_contact->cp_street ?? 'n/a' }}">
                </div>
                <div>
                    <h3 class="text-gray-600">Barangay</h3>
                    <input type="text" name="cp_brgy" class="w-full p-2 border border-gray-300 rounded-md bg-gray-100" value="{{ $data->emergency_contact->cp_brgy ?? 'n/a' }}">
                </div>
                <div>
                    <h3 class="text-gray-600">City</h3>
                    <input type="text" name="cp_city" class="w-full p-2 border border-gray-300 rounded-md bg-gray-100" value="{{ $data->emergency_contact->cp_city ?? 'n/a' }}">
                </div>
                <div>
                    <h3 class="text-gray-600">Province</h3>
                    <input type="text" name="cp_province" class="w-full p-2 border border-gray-300 rounded-md bg-gray-100" value="{{ $data->emergency_contact->cp_province ?? 'n/a' }}">
                </div>
                <div>
                    <h3 class="text-gray-600">Postal Code</h3>
                    <input type="text" name="cp_postal_code" class="w-full p-2 border border-gray-300 rounded-md bg-gray-100" value="{{ $data->emergency_contact->cp_postal_code ?? 'n/a' }}">
                </div>
            </div>

            <div class="line-break mb-4">
                <hr class="opacity-50">
            </div>

            <div class='grid grid-cols-2 gap-4 mb-6'>
                <div>
                    <h3 class="text-gray-600">Home Phone No.</h3>
                    <input type="text" name="cp_home_phone" class="w-full p-2 border border-gray-300 rounded-md bg-gray-100" value="{{ $data->emergency_contact->cp_home_phone ?? 'n/a' }}">
                </div>
                <div>
                    <h3 class="text-gray-600">Mobile Phone No.</h3>
                    <input type="text" name="cp_mobile_no" class="w-full p-2 border border-gray-300 rounded-md bg-gray-100" value="{{ $data->emergency_contact->cp_mobile_no ?? 'n/a' }}">
                </div>
            </div>

            <hr class="my-4 opacity-50">

<div class="flex justify-end">
    <button type="submit" class="flex items-center bg-red-900 text-white rounded-md px-4 py-2 hover:bg-red-700 transition duration-300">
        <img src="{{ asset('images/icons/save.png') }}" class="w-5 h-5 mr-2" alt="Save Icon"/>
        <span class="font-semibold">Save Changes</span>
    </button>
</div>
        </form>
    </div>
</div>
