<div class="w-full flex justify-center py-8">
<div class="w-full flex flex-col rounded-xl p-0 bg-white">
        <form action="{{ route('portal.provincial-contact', ['id' => Auth::user()->id]) }}" method="POST">  
            @csrf
            @method('PUT')

            <!-- Start of personal data box -->
            <h1 class="text-xl font-semibold text-gray-700 mb-4">Present Address</h1>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div>
                    <label class="block text-gray-600 mb-1" for="houseNo">House No.</label>
                    <input type="text" id="houseNo" name="pc_emp_houseno" 
                           class="block w-full p-2 border rounded-md bg-gray-100 focus:outline-none focus:ring-2 focus:ring-red-900" 
                           value="{{ $data->provincial_contact->pc_emp_houseno ?? 'n/a' }}">
                </div>

                <div>
                    <label class="block text-gray-600 mb-1" for="street">Street</label>
                    <input type="text" id="street" name="pc_street" 
                           class="block w-full p-2 border rounded-md bg-gray-100 focus:outline-none focus:ring-2 focus:ring-red-900" 
                           value="{{ $data->provincial_contact->pc_street ?? 'n/a' }}">
                </div>

                <div>
                    <label class="block text-gray-600 mb-1" for="barangay">Barangay</label>
                    <input type="text" id="barangay" name="pc_brgy" 
                           class="block w-full p-2 border rounded-md bg-gray-100 focus:outline-none focus:ring-2 focus:ring-red-900" 
                           value="{{ $data->provincial_contact->pc_brgy ?? 'n/a' }}">
                </div>
            </div>

            <hr class="my-4 opacity-50">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                <div>
                    <label class="block text-gray-600 mb-1" for="city">City</label>
                    <input type="text" id="city" name="pc_city" 
                           class="block w-full p-2 border rounded-md bg-gray-100 focus:outline-none focus:ring-2 focus:ring-red-900" 
                           value="{{ $data->provincial_contact->pc_city ?? 'n/a' }}">
                </div>

                <div>
                    <label class="block text-gray-600 mb-1" for="province">Province</label>
                    <input type="text" id="province" name="pc_province" 
                           class="block w-full p-2 border rounded-md bg-gray-100 focus:outline-none focus:ring-2 focus:ring-red-900" 
                           value="{{ $data->provincial_contact->pc_province ?? 'n/a' }}">
                </div>

                <div>
                    <label class="block text-gray-600 mb-1" for="postalCode">Postal Code</label>
                    <input type="text" id="postalCode" name="pc_postal_code" 
                           class="block w-full p-2 border rounded-md bg-gray-100 focus:outline-none focus:ring-2 focus:ring-red-900" 
                           value="{{ $data->provincial_contact->pc_postal_code ?? 'n/a' }}">
                </div>

                <div>
                    <label class="block text-gray-600 mb-1" for="mobilePhone">Mobile Phone No.</label>
                    <input type="text" id="mobilePhone" name="pc_phone" 
                           class="block w-full p-2 border rounded-md bg-gray-100 focus:outline-none focus:ring-2 focus:ring-red-900" 
                           value="{{ $data->provincial_contact->pc_phone ?? 'n/a' }}">
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
