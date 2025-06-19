<!-- resources/views/admin/records/users/add-user.blade.php -->
<x-app-layout>
    <div class="w-full flex items-center justify-center py-8 px-4">
        <div class="w-full max-w-7xl bg-white px-6 py-8 rounded-lg shadow-md">
            <a href="{{ $origin === 'all' ? route('admin.users') : route('admin.records') }}" class="w-[25%] rounded-lg flex items-center justify-center py-2 bg-red-900 text-white font-bold mb-4 gap-1 hover:bg-red-700">
                <img src="{{ asset('images/icons/back.png') }}" class="w-[20px] h-[20px]" alt="">
                Back
            </a>
            <h2 class="text-2xl font-semibold text-red-900 mb-6 text-center sm:text-left">Add New User</h2>
            
            <!-- Display validation errors -->
            @if ($errors->any())
                <div class="bg-red-500 text-white p-4 rounded-md mb-4">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li class="text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Success Message -->
            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded-md mb-4">
                    <p class="text-sm font-medium">{{ session('success') }}</p>
                </div>
            @endif

            <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6" id="addUserForm">
                @csrf
                
                <!-- Form Sections -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Personal Information -->
                    <div class="bg-gray-100 px-4 py-6 rounded-lg shadow-sm">
                        <h3 class="text-xl font-semibold text-gray-700 mb-4">Personal Information</h3>

                        <div class="space-y-4">
                            <!-- Employee ID -->
                            <div>
                                <label for="emp_id" class="block text-gray-700 font-medium mb-1">
                                    Employee ID <span class="required-indicator">*</span>
                                </label>
                                <input type="text" name="emp_id" id="emp_id" value="{{ old('emp_id') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900"
                                    required>
                            </div>

                            <!-- First Name -->
                            <div>
                                <label for="emp_fname" class="block text-gray-700 font-medium mb-1">
                                    First Name <span class="required-indicator">*</span>
                                </label>
                                <input type="text" name="emp_fname" id="emp_fname" value="{{ old('emp_fname') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900"
                                    required>
                            </div>

                            <!-- Middle Name -->
                            <div>
                                <label for="emp_mname" class="block text-gray-700 font-medium mb-1">Middle Name</label>
                                <input type="text" name="emp_mname" id="emp_mname" value="{{ old('emp_mname') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900">
                            </div>

                            <!-- Last Name -->
                            <div>
                                <label for="emp_lname" class="block text-gray-700 font-medium mb-1">
                                    Last Name <span class="required-indicator">*</span>
                                </label>
                                <input type="text" name="emp_lname" id="emp_lname" value="{{ old('emp_lname') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900"
                                    required>
                            </div>

                            <!-- Department -->
                            <div>
                                <label for="emp_dept" class="block text-gray-700 font-medium mb-1">
                                    Department <span class="required-indicator">*</span>
                                </label>
                                <select name="emp_dept" id="emp_dept"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900"
                                    required>
                                    <option value="" disabled selected>Select...</option>
                                    @foreach ($dept as $department)
                                        <option value="{{ $department->code }}">{{ $department->dept }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Gender -->
                            <div>
                                <label for="emp_gender" class="block text-gray-700 font-medium mb-1">Gender</label>
                                <select name="emp_gender" id="emp_gender"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900">
                                    <option value="" disabled selected>Select...</option>
                                    @foreach ($gender as $item)
                                        <option value="{{ $item->item }}">{{ $item->item }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Maiden Name -->
                            <div>
                                <label for="emp_maiden_name" class="block text-gray-700 font-medium mb-1">Maiden Name</label>
                                <input type="text" name="emp_maiden_name" id="emp_maiden_name" value="{{ old('emp_maiden_name') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900">
                            </div>

                            <!-- Date of Birth -->
                            <div>
                            <label for="emp_dob" class="block text-gray-700 font-medium mb-1">
                                    Date of Birth <span class="required-indicator">*</span>
                                </label>
                                <input type="date" name="emp_dob" id="emp_dob" value="{{ old('emp_dob') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900"
                                    required>
                                <p id="dobError" class="text-red-500 text-sm mt-2 hidden">You must be at least 18 years old.</p>
                            </div>

                            <!-- Place of Birth -->
                            <div>
                                <label for="emp_pob" class="block text-gray-700 font-medium mb-1">
                                    Place of Birth <span class="required-indicator">*</span>
                                </label>
                                <input type="text" name="emp_pob" id="emp_pob" value="{{ old('emp_pob') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900"
                                    required>
                            </div>

                            <!-- Civil Status -->
                            <div>
                                <label for="emp_cStatus" class="block text-gray-700 font-medium mb-1">Civil Status</label>
                                <select name="emp_cStatus" id="emp_cStatus"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900">
                                    <option value="" disabled selected>Select...</option>
                                    @foreach ($civil_status as $item)
                                        <option value="{{ $item->item }}">{{ $item->item }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Religion -->
                            <div>
                                <label for="emp_religion" class="block text-gray-700 font-medium mb-1">Religion</label>
                                <input type="text" name="emp_religion" id="emp_religion" value="{{ old('emp_religion') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900">
                            </div>

                            <!-- Blood Type -->
                            <div>
                                <label for="emp_blood_type" class="block text-gray-700 font-medium mb-1">Blood Type</label>
                                <input type="text" name="emp_blood_type" id="emp_blood_type" value="{{ old('emp_blood_type') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900">
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="bg-gray-100 px-4 py-6 rounded-lg shadow-sm">
                        <h3 class="text-xl font-semibold text-gray-700 mb-4">Contact Information</h3>

                        <div class="space-y-4">
                            <!-- House Number -->
                            <div>
                                <label for="emp_houseno" class="block text-gray-700 font-medium mb-1">
                                    House Number <span class="required-indicator">*</span>
                                </label>
                                <input type="text" name="emp_houseno" id="emp_houseno" value="{{ old('emp_houseno') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900"
                                    required>
                            </div>

                            <!-- Street -->
                            <div>
                                <label for="street" class="block text-gray-700 font-medium mb-1">
                                    Street <span class="required-indicator">*</span>
                                </label>
                                <input type="text" name="street" id="street" value="{{ old('street') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900"
                                    required>
                            </div>

                            <!-- Barangay -->
                            <div>
                                <label for="brgy" class="block text-gray-700 font-medium mb-1">
                                    Barangay <span class="required-indicator">*</span>
                                </label>
                                <input type="text" name="brgy" id="brgy" value="{{ old('brgy') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900"
                                    required>
                            </div>

                            <!-- City -->
                            <div>
                                <label for="city" class="block text-gray-700 font-medium mb-1">
                                    City <span class="required-indicator">*</span>
                                </label>
                                <input type="text" name="city" id="city" value="{{ old('city') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900"
                                    required>
                            </div>

                            <!-- Province -->
                            <div>
                                <label for="province" class="block text-gray-700 font-medium mb-1">
                                    Province <span class="required-indicator">*</span>
                                </label>
                                <input type="text" name="province" id="province" value="{{ old('province') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900"
                                    required>
                            </div>

                            <!-- Postal Code -->
                            <div>
                                <label for="postal_code" class="block text-gray-700 font-medium mb-1">
                                    Postal Code <span class="required-indicator">*</span>
                                </label>
                                <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900"
                                    required>
                            </div>

                            <!-- Home Phone -->
                            <div>
                                <label for="home_phone" class="block text-gray-700 font-medium mb-1">
                                    Home Phone <span class="required-indicator">*</span>
                                </label>
                                <input type="text" name="home_phone" id="home_phone" value="{{ old('home_phone') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900"
                                    required>
                            </div>

                            <!-- Mobile Phone -->
                            <div>
                                <label for="mobile_phone" class="block text-gray-700 font-medium mb-1">
                                    Mobile Phone <span class="required-indicator">*</span>
                                </label>
                                <input type="text" name="mobile_phone" id="mobile_phone" value="{{ old('mobile_phone') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900"
                                    required>
                            </div>

                            <!-- Email Address 1 -->
                            <div>
                                <label for="email_address_1" class="block text-gray-700 font-medium mb-1">
                                    Email Address 1 <span class="required-indicator">*</span>
                                </label>
                                <input type="email" name="email_address_1" id="email_address_1" value="{{ old('email_address_1') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900"
                                    required>
                            </div>

                            <!-- Email Address 2 -->
                            <div>
                                <label for="email_address_2" class="block text-gray-700 font-medium mb-1">
                                    Email Address 2 <span class="required-indicator">*</span>
                                </label>
                                <input type="email" name="email_address_2" id="email_address_2" value="{{ old('email_address_2') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900"
                                    required>
                            </div>
                        </div>
                    </div>

                    <!-- Provincial Contact Information -->
                    <div class="bg-gray-100 px-4 py-6 rounded-lg shadow-sm">
                        <h3 class="text-xl font-semibold text-gray-700 mb-4">Provincial Contact Information</h3>

                        <div class="space-y-4">
                            <!-- House Number -->
                            <div>
                                <label for="pc_emp_houseno" class="block text-gray-700 font-medium mb-1">House Number</label>
                                <input type="text" name="pc_emp_houseno" id="pc_emp_houseno" value="{{ old('pc_emp_houseno') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900">
                            </div>

                            <!-- Street -->
                            <div>
                                <label for="pc_street" class="block text-gray-700 font-medium mb-1">Street</label>
                                <input type="text" name="pc_street" id="pc_street" value="{{ old('pc_street') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900">
                            </div>

                            <!-- Barangay -->
                            <div>
                                <label for="pc_brgy" class="block text-gray-700 font-medium mb-1">Barangay</label>
                                <input type="text" name="pc_brgy" id="pc_brgy" value="{{ old('pc_brgy') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900">
                            </div>

                            <!-- City -->
                            <div>
                                <label for="pc_city" class="block text-gray-700 font-medium mb-1">City</label>
                                <input type="text" name="pc_city" id="pc_city" value="{{ old('pc_city') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900">
                            </div>

                            <!-- Province -->
                            <div>
                                <label for="pc_province" class="block text-gray-700 font-medium mb-1">Province</label>
                                <input type="text" name="pc_province" id="pc_province" value="{{ old('pc_province') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900">
                            </div>

                            <!-- Postal Code -->
                            <div>
                                <label for="pc_postal_code" class="block text-gray-700 font-medium mb-1">Postal Code</label>
                                <input type="text" name="pc_postal_code" id="pc_postal_code" value="{{ old('pc_postal_code') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900">
                            </div>

                            <!-- Phone -->
                            <div>
                                <label for="pc_phone" class="block text-gray-700 font-medium mb-1">Phone</label>
                                <input type="text" name="pc_phone" id="pc_phone" value="{{ old('pc_phone') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900">
                            </div>
                        </div>
                    </div>

                    <!-- Emergency Contact Information -->
                    <div class="bg-gray-100 px-4 py-6 rounded-lg shadow-sm">
                        <h3 class="text-xl font-semibold text-gray-700 mb-4">Emergency Contact Information</h3>

                        <div class="space-y-4">
                            <!-- Contact Person First Name -->
                            <div>
                                <label for="cp_fname" class="block text-gray-700 font-medium mb-1">
                                    First Name <span class="required-indicator">*</span>
                                </label>
                                <input type="text" name="cp_fname" id="cp_fname" value="{{ old('cp_fname') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900"
                                    required>
                            </div>

                            <!-- Contact Person Middle Name -->
                            <div>
                                <label for="cp_mname" class="block text-gray-700 font-medium mb-1">Middle Name</label>
                                <input type="text" name="cp_mname" id="cp_mname" value="{{ old('cp_mname') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900">
                            </div>

                            <!-- Contact Person Last Name -->
                            <div>
                                <label for="cp_lname" class="block text-gray-700 font-medium mb-1">
                                    Last Name <span class="required-indicator">*</span>
                                </label>
                                <input type="text" name="cp_lname" id="cp_lname" value="{{ old('cp_lname') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900"
                                    required>
                            </div>

                            <!-- Relationship -->
                            <div>
                                <label for="cp_relationship" class="block text-gray-700 font-medium mb-1">
                                    Relationship <span class="required-indicator">*</span>
                                </label>
                                <input type="text" name="cp_relationship" id="cp_relationship" value="{{ old('cp_relationship') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900"
                                    required>
                            </div>

                            <!-- House Number -->
                            <div>
                                <label for="cp_house_no" class="block text-gray-700 font-medium mb-1">
                                    House Number <span class="required-indicator">*</span>
                                </label>
                                <input type="text" name="cp_house_no" id="cp_house_no" value="{{ old('cp_house_no') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900"
                                    required>
                            </div>

                            <!-- Street -->
                            <div>
                                <label for="cp_street" class="block text-gray-700 font-medium mb-1">
                                    Street <span class="required-indicator">*</span>
                                </label>
                                <input type="text" name="cp_street" id="cp_street" value="{{ old('cp_street') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900"
                                    required>
                            </div>

                            <!-- City -->
                            <div>
                                <label for="cp_city" class="block text-gray-700 font-medium mb-1">
                                    City <span class="required-indicator">*</span>
                                </label>
                                <input type="text" name="cp_city" id="cp_city" value="{{ old('cp_city') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900"
                                    required>
                            </div>

                            <!-- Province -->
                            <div>
                                <label for="cp_province" class="block text-gray-700 font-medium mb-1">
                                    Province <span class="required-indicator">*</span>
                                </label>
                                <input type="text" name="cp_province" id="cp_province" value="{{ old('cp_province') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900"
                                    required>
                            </div>

                            <!-- Postal Code -->
                            <div>
                                <label for="cp_postal_code" class="block text-gray-700 font-medium mb-1">
                                    Postal Code <span class="required-indicator">*</span>
                                </label>
                                <input type="text" name="cp_postal_code" id="cp_postal_code" value="{{ old('cp_postal_code') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900"
                                    required>
                            </div>

                            <!-- Home Phone -->
                            <div>
                                <label for="cp_home_phone" class="block text-gray-700 font-medium mb-1">
                                    Home Phone <span class="required-indicator">*</span>
                                </label>
                                <input type="text" name="cp_home_phone" id="cp_home_phone" value="{{ old('cp_home_phone') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900"
                                    required>
                            </div>

                            <!-- Mobile Phone -->
                            <div>
                                <label for="cp_mobile_no" class="block text-gray-700 font-medium mb-1">
                                    Mobile Phone <span class="required-indicator">*</span>
                                </label>
                                <input type="text" name="cp_mobile_no" id="cp_mobile_no" value="{{ old('cp_mobile_no') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900"
                                    required>
                            </div>
                        </div>
                    </div>

                    <!-- Accounting Details -->
                    <div class="bg-gray-100 px-4 py-6 rounded-lg shadow-sm">
                        <h3 class="text-xl font-semibold text-gray-700 mb-4">Accounting Details</h3>

                        <div class="space-y-4">
                            <!-- SSS Number -->
                            <div>
                                <label for="sss_no" class="block text-gray-700 font-medium mb-1">
                                    SSS Number <span class="required-indicator">*</span>
                            </label>
                                <input type="text" name="sss_no" id="sss_no" value="{{ old('sss_no') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900">
                            </div>

                            <!-- Tax Number -->
                            <div>
                                <label for="tax_no" class="block text-gray-700 font-medium mb-1">
                                    Tax Identification Number <span class="required-indicator">*</span>
                                </label>
                                <input type="text" name="tax_no" id="tax_no" value="{{ old('tax_no') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900">
                            </div>

                            <!-- Pag-IBIG Number -->
                            <div>
                                <label for="pagibig_no" class="block text-gray-700 font-medium mb-1">
                                    Pag-IBIG Number <span class="required-indicator">*</span>
                                </label>
                                <input type="text" name="pagibig_no" id="pagibig_no" value="{{ old('pagibig_no') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900">
                            </div>

                            <!-- PhilHealth Number -->
                            <div>
                                <label for="philhealth_no" class="block text-gray-700 font-medium mb-1">
                                    PhilHealth Number <span class="required-indicator">*</span>
                                </label>
                                <input type="text" name="philhealth_no" id="philhealth_no" value="{{ old('philhealth_no') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900">
                            </div>
                        </div>
                    </div>

                    <!-- Hiring Information -->
                    <div class="bg-gray-100 px-4 py-6 rounded-lg shadow-sm">
                        <h3 class="text-xl font-semibold text-gray-700 mb-4">Hiring Information</h3>
                        
                        <div class="space-y-4">
                            <!-- Date Hired -->
                            <div>
                                <label for="date_hired" class="block text-gray-700 font-medium mb-1">
                                    Date Hired <span class="required-indicator">*</span>
                                </label>
                                <input type="date" name="date_hired" id="date_hired" value="{{ old('date_hired') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900"
                                    required>
                            </div>

                            <!-- Position -->
                            <div>
                                <label for="position" class="block text-gray-700 font-medium mb-1">
                                    Position <span class="required-indicator">*</span>
                                </label>
                                <select name="position" id="position"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900"
                                    required>
                                    <option value="" disabled selected>Select...</option>
                                    @foreach ($position as $item)
                                        <option value="{{ $item->item }}">{{ $item->item }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Nature -->
                            <div>
                                <label for="nature" class="block text-gray-700 font-medium mb-1">
                                    Nature <span class="required-indicator">*</span>
                                </label>
                                <select name="nature" id="nature" value="{{ old('emp_status') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900"
                                    required>
                                    <option value="" disabled selected>Select...</option>
                                    @foreach ($nature as $nat)
                                        <option value="{{ $nat->item }}">{{ $nat->item }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Tenure -->
                            <div>
                                <label for="tenure" class="block text-gray-700 font-medium mb-2">
                                    Tenure <span class="required-indicator">*</span>
                                </label>
                                <select 
                                    id="tenure" 
                                    name="tenure" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900"
                                    onchange="toggleNonTenuredField()"
                                    required>
                                    <option value="" disabled selected>Select...</option>
                                    @foreach ($tenure as $ten)
                                        <option value="{{ $ten->item }}">{{ $ten->item }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Non-Tenured Info (Conditional) -->
                            <div id="non-tenured-field">
                                <label for="nontenured" class="block text-gray-700 font-medium mb-2">
                                    Non-Tenured Info <span class="required-indicator">*</span>
                                </label>
                                <select 
                                    id="nontenured" 
                                    name="nontenured" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900"
                                    required>
                                    <option value="" disabled selected>Select...</option>
                                    @foreach ($nontenured as $item)
                                        <option value="{{ $item->item }}">{{ $item->item }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Require License -->
                            <div class="flex items-center">
                                <label for="license" class="block text-gray-700 font-medium mb-1">
                                    Required License
                                </label>
                                <input type="hidden" name="license" value="0">
                                <input name="license" type="checkbox" id="license" value="1"
                                    class="ml-2 px-3 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900"
                                    >
                            </div>
                        </div>

                    </div>

                    <!-- Login Information -->
                    <div class="bg-gray-100 px-4 py-6 rounded-lg shadow-sm">
                        <h3 class="text-xl font-semibold text-gray-700 mb-4">Login Information</h3>

                        <div class="space-y-4">
                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-gray-700 font-medium mb-1">
                                    Email <span class="required-indicator">*</span>
                                </label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900"
                                    required>
                            </div>





                            <!-- Password -->
                            <div class="relative">
                                <label for="password" class="block text-gray-700 font-medium mb-1">
                                    Password <span class="required-indicator">*</span>
                                </label>
                                <input id="password" type="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900" required>
                                <span onclick="togglePassword('password', 'togglePasswordIcon')" class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer">
                                
                            </div>

                            <div class="mt-4">
                                <label for="password_confirmation" class="block text-gray-700 font-medium mb-1">
                                        Confirm Password <span class="required-indicator">*</span>
                                </label>
                                <input id="password_confirmation" type="password" name="password_confirmation" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900" required>
                                <p id="passwordMismatch" class="text-red-500 text-sm mt-2 hidden">Passwords do not match.</p>
                            </div>

                            <!-- Show Password Checkbox -->
                            <div class="mt-2 flex items-center">
                                <input type="checkbox" id="showPassword" class="mr-2">
                                <label for="showPassword" class="text-sm text-gray-700">Show Password</label>
                            </div>





                                                        <!-- former codes for Role -
                                                        <div>
                                                            <label for="role" class="block text-gray-700 font-medium mb-1">
                                                                Role <span class="required-indicator">*</span>
                                                            </label>
                                                            <select name="role" id="role"
                                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900"
                                                                required>
                                                                <option value="Employee" {{ old('role') == 'Employee' ? 'selected' : '' }}>Employee</option>
                                                                <option value="SuperAdmin" {{ old('role') == 'SuperAdmin' ? 'selected' : '' }}>SuperAdmin</option>
                                                                <option value="HR" {{ old('role') == 'HR' ? 'selected' : '' }}>HR</option>
                                                                <option value="Dean" {{ old('role') == 'Dean' ? 'selected' : '' }}>Dean</option>
                                                            </select>
                                                        </div> --->


                                                        <div>
                                <label for="role" class="block text-gray-700 font-medium mb-1">
                                    Role <span class="required-indicator">*</span>
                                </label>
                                <select name="role" id="role"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-900"
                                    required>
                                    <option value="" disabled selected>Select...</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->item }}" {{ old('role') == $role->item ? 'selected' : '' }}>
                                            {{ $role->item }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>






                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center space-x-4 mt-6">
                    <!-- Cancel Button -->
                    <a href="{{ route('admin.users') }}" 
                        class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md text-sm hover:bg-gray-400 transition-colors duration-200">
                        Cancel
                    </a>
                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="bg-red-900 text-white px-6 py-2 rounded-md shadow focus:outline-none focus:ring-2 focus:ring-red-900 hover:bg-red-800 transition-colors duration-200">
                        Add User
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        .required-indicator {
            color: red;
            font-weight: bold;
        }
    </style>

    <!-- JavaScript for Password Matching Validation -->
    <script>
        function toggleNonTenuredField() {
            const tenureValue = document.getElementById('tenure').value;
            const nonTenuredField = document.getElementById('non-tenured-field');
            const nonTenuredSelect = document.getElementById('nontenured');
            
            // Check if the selected tenure value is 'Non-tenured' and toggle visibility accordingly
            if (tenureValue === 'Non-tenured') {
                nonTenuredField.classList.remove('hidden');
                nonTenuredSelect.required = true;
            } else {
                nonTenuredField.classList.add('hidden');
                nonTenuredSelect.required = false;
            }
        }

        // Initialize on page load to ensure the non-tenured field is shown if needed
        document.addEventListener('DOMContentLoaded', () => {
            toggleNonTenuredField();
        });

        document.addEventListener('DOMContentLoaded', function () {
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('password_confirmation');
            const passwordMismatch = document.getElementById('passwordMismatch');
            const submitButton = document.querySelector('button[type="submit"]');

            function validatePassword() {
                if (confirmPassword.value && password.value !== confirmPassword.value) {
                    passwordMismatch.classList.remove('hidden');
                    submitButton.disabled = true;
                } else {
                    passwordMismatch.classList.add('hidden');
                    submitButton.disabled = false;
                }
            }

            password.addEventListener('input', validatePassword);
            confirmPassword.addEventListener('input', validatePassword);





          
          
    document.getElementById('showPassword').addEventListener('change', function() {
        let passwordField = document.getElementById('password');
        let confirmPasswordField = document.getElementById('password_confirmation');

        if (this.checked) {
            passwordField.type = "text";
            confirmPasswordField.type = "text";
        } else {
            passwordField.type = "password";
            confirmPasswordField.type = "password";
        }
    });

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

    



        });

    
    </script>
</x-app-layout>