

<div class="w-full flex justify-center py-8">
<div class="w-full flex flex-col rounded-xl p-0 bg-white">

        <form action="{{ route('portal.contact-information', ['id' => Auth::user()->id]) }}" method="POST"> 
            @csrf
            @method('PUT')

            <!-- Start of Present Address Box -->
            <div class="mb-6">
                <h1 class="text-lg font-semibold text-gray-700 mb-4">Present Address</h1>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-gray-600 text-sm mb-1" for="emp_houseno">House No.</label>
                        <input type="text" name="emp_houseno" id="emp_houseno" value="{{ $data->emp_houseno ?? 'n/a' }}" class="block w-full p-2 border rounded-lg bg-gray-200 focus:bg-white focus:border-gray-400" />
                    </div>
                    <div>
                        <label class="block text-gray-600 text-sm mb-1" for="street">Street</label>
                        <input type="text" name="street" id="street" value="{{ $data->street ?? 'n/a' }}" class="block w-full p-2 border rounded-lg bg-gray-200 focus:bg-white focus:border-gray-400" />
                    </div>
                    <div>
                        <label class="block text-gray-600 text-sm mb-1" for="brgy">Barangay</label>
                        <input type="text" name="brgy" id="brgy" value="{{ $data->brgy ?? 'n/a' }}" class="block w-full p-2 border rounded-lg bg-gray-200 focus:bg-white focus:border-gray-400" />
                    </div>
                    <div>
                        <label class="block text-gray-600 text-sm mb-1" for="city">City</label>
                        <input type="text" name="city" id="city" value="{{ $data->city ?? 'n/a' }}" class="block w-full p-2 border rounded-lg bg-gray-200 focus:bg-white focus:border-gray-400" />
                    </div>
                    <div>
                        <label class="block text-gray-600 text-sm mb-1" for="province">Province</label>
                        <input type="text" name="province" id="province" value="{{ $data->province ?? 'n/a' }}" class="block w-full p-2 border rounded-lg bg-gray-200 focus:bg-white focus:border-gray-400" />
                    </div>
                    <div>
                        <label class="block text-gray-600 text-sm mb-1" for="postal_code">Postal Code</label>
                        <input type="text" name="postal_code" id="postal_code" value="{{ $data->postal_code ?? 'n/a' }}" class="block w-full p-2 border rounded-lg bg-gray-200 focus:bg-white focus:border-gray-400" />
                    </div>
                </div>
            </div>

            <div class="line-break mb-6">
                <hr class="border-gray-300 opacity-80" />
            </div>

            <div class="mb-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-gray-600 text-sm mb-1" for="home_phone">Home Phone No.</label>
                        <input type="text" name="home_phone" id="home_phone" value="{{ $data->home_phone ?? 'n/a' }}" class="block w-full p-2 border rounded-lg bg-gray-200 focus:bg-white focus:border-gray-400" />
                    </div>
                    <div>
                        <label class="block text-gray-600 text-sm mb-1" for="mobile_phone">Mobile Phone No.</label>
                        <input type="text" name="mobile_phone" id="mobile_phone" value="{{ $data->mobile_phone ?? 'n/a' }}" class="block w-full p-2 border rounded-lg bg-gray-200 focus:bg-white focus:border-gray-400" />
                    </div>
                    <div>
                        <label class="block text-gray-600 text-sm mb-1" for="email_address_1">Primary Email Address</label>
                        <input type="text" name="email_address_1" id="email_address_1" value="{{ $data->email_address_1 ?? 'n/a' }}" class="block w-full p-2 border rounded-lg bg-gray-200 focus:bg-white focus:border-gray-400" />
                    </div>
                    <div>
                        <label class="block text-gray-600 text-sm mb-1" for="email_address_2">Secondary Email Address</label>
                        <input type="text" name="email_address_2" id="email_address_2" value="{{ $data->email_address_2 ?? 'n/a' }}" class="block w-full p-2 border rounded-lg bg-gray-200 focus:bg-white focus:border-gray-400" />
                    </div>
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
