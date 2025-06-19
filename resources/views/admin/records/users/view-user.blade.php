<!-- resources/views/admin/records/users/view-user.blade.php -->
<x-app-layout>
    <div class="min-h-screen">
        <div class="flex justify-center py-8">
            <div class="w-[95%] bg-white rounded-lg p-8 shadow-lg">
                <!-- added a Back Button when viewing user profile -->
                <a href="{{ route('admin.users') }}" class="w-[15%] rounded-lg flex items-center justify-center py-2 bg-red-900 text-white font-bold gap-1 hover:bg-red-700">
                    <img src="{{ asset('images/icons/back.png') }}" class="w-4 h-4 mr-2" alt="">
                    Back
                </a>
                <h1 class="text-3xl font-extrabold text-gray-800 text-center">View User Profile</h1>

                <div class="flex items-center justify-center gap-2 mt-4">
                    <img src="{{ asset('images/icons/users_maroon.png') }}" class="w-6 h-6" alt="Users Icon">
                    <a href="{{ route('admin.users') }}" class="text-red-900 hover:text-red-700 font-semibold">Users</a>
                    <span class="text-lg"> &gt; </span>
                    <span class="font-semibold">{{ $data->emp_id }}</span>
                </div>

                <hr class="opacity-90 my-4">

                <div class="w-full py-2 mb-2">
                    @if(session('msg'))
                        <div id="actmsg" class="bg-green-100 text-green-900 font-semibold py-2 px-4 rounded-lg flex items-center gap-2 text-[1rem]">
                            <img src="{{ asset('images/icons/success.png') }}" alt="Activate Icon" class="w-[20px] h-[20px]">
                            <p>{{ session('msg') }}</p>
                        </div>
                    @endif
                </div>

                <div class="w-full">
                    @if($data->login->terminated == 0)
                        <form class="w-full flex justify-center items-center" action="{{ route('admin.users.terminate', ['id' => $data->emp_id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="button" onclick="confirmTerminate(this)" class="bg-white text-red-900 flex gap-2 justify-center items-center py-2 px-8 rounded-lg border-2 border-red-900 shadow-md hover:bg-red-100 hover:shadow-lg focus:outline-none focus:ring-2">
                                <img src="{{ asset('images/icons/terminate.png') }}" alt="" class="w-[25px] h-[25px]">
                                <p class="text-sm font-medium">Terminate User Account</p>
                            </button>
                        </form>
                    @else
                        <form class="w-full flex justify-center items-center" action="{{ route('admin.users.activate', ['id' => $data->emp_id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="button" onclick="confirmActivate(this)" class="bg-white text-green-900 flex gap-2 justify-center items-center py-2 px-8 rounded-lg border-2 border-green-900 shadow-md hover:bg-green-100 hover:shadow-lg focus:outline-none focus:ring-2">
                                <img src="{{ asset('images/icons/restore.png') }}" alt="" class="w-[25px] h-[25px]">
                                <p class="text-sm font-medium">Activate User Account</p>
                            </button>
                        </form>
                    @endif
                </div>

                <div class="profile-card">
                    <!-- Basic Profile Info -->
                    <div class="account-info">
                        <div class="account-info-box">
                            <div class="account-info-box-left">
                                <div class="account-image">
                                    @if($data->profile_picture)
                                        <img class="acc-img" src="{{ asset('storage/profile_pictures/' . $data->profile_picture) }}" alt="user_image"/>
                                    @else
                                        <img class="acc-img" src="{{ asset('images/blankdp.jpg') }}" alt="user_image"/>
                                    @endif
                                </div>
                                <div class="account-details">
                                    <h1 id="empid">{{ $data->emp_id }}</h1>
                                    <h1 class="text-2xl text-gray-600 font-bold">{{ $data->emp_lname }}, {{ $data->emp_fname }} {{ $data->emp_mname }}</h1>
                                    <h3 class="text-sm text-gray-400 font-bold">{{ $data->department->dept ?? 'n/a' }}</h3>
                                </div>
                            </div>
                            @if($dep && $data->department && $data->department->logo != '')
                                <div class="account-info-box-right">
                                    <img class="hau-banner" src="{{ asset('storage/dept/logo/' . $data->department->logo) }}"/>
                                </div>
                            @else
                                <img class="hau-banner" src="{{ asset('images/logo-circle.png') }}" alt="">
                            @endif
                        </div>
                    </div>

                    <!-- Status Filter Dropdown (shown only on filterable tabs) -->
                    <div id="statusDropdownContainer" class="flex justify-end mb-4" style="display: none;">
                        <label for="statusFilter" class="mr-2 font-semibold text-gray-700">Filter by Status:</label>
                        <!-- Make sure the values match the actual status used in your DB -->
                        <select id="statusFilter" class="modern-dropdown">
                            <option value="all">All</option>
                            <option value="Approved">Approved</option>
                            <option value="Pending">Pending</option>
                            <!-- IMPORTANT: match your DB case/spelling for the "To-review" status -->
                            <option value="To-review">To-review</option>
                        </select>
                    </div>


                    <!-- Tabs -->
                    <div class="w-full flex flex-nowrap overflow-x-auto">
                        <button id="profile_btn" class="hover:bg-gray-100 text-gray-400 font-semibold px-8 py-2 whitespace-nowrap active_link">Profile</button>
                        <button id="hiringHistory_btn" class="hover:bg-gray-100 text-gray-400 font-semibold px-8 py-2 whitespace-nowrap">Hiring History</button>
                        <button id="certifications_btn" class="hover:bg-gray-100 text-gray-400 font-semibold px-8 py-2 whitespace-nowrap">Certifications</button>
                        <button id="trainings_btn" class="hover:bg-gray-100 text-gray-400 font-semibold px-8 py-2 whitespace-nowrap">Trainings</button>
                        <button id="licenses_btn" class="hover:bg-gray-100 text-gray-400 font-semibold px-8 py-2 whitespace-nowrap">Licenses</button>
                        <button id="educations_btn" class="hover:bg-gray-100 text-gray-400 font-semibold px-8 py-2 whitespace-nowrap">Educational Background</button>
                        <button id="employments_btn" class="hover:bg-gray-100 text-gray-400 font-semibold px-8 py-2 whitespace-nowrap">Employment</button>
                        <button id="respubs_btn" class="hover:bg-gray-100 text-gray-400 font-semibold px-8 py-2 whitespace-nowrap">Research and Publication</button>
                        <button id="orgs_btn" class="hover:bg-gray-100 text-gray-400 font-semibold px-8 py-2 whitespace-nowrap">Organizations</button>
                        <button id="dependents_btn" class="hover:bg-gray-100 text-gray-400 font-semibold px-8 py-2 whitespace-nowrap">Dependents</button>
                    </div>

                    <hr class="mb-2 opacity-90 w-full">
                    
                    
                    <!-- PROFILE SECTION -->
                    <div id="profile">
                        <!-- Personal Data -->
                        <div class="section personal-data">
                            <div class="section-box">
                                <div class="box-title">
                                    <h1>Personal Data</h1>
                                    <span class="semi-transparent">Last Updated: 
                                        {{ explode(' ', $data->updated_at)[0] . ' | ' . explode(' ', $data->updated_at)[1] }}
                                    </span>
                                    <!-- EDIT BUTTON ADDED -->
                                    <a href="{{ route('admin.users.edit', ['id'=>$data->emp_id, 'section'=>'personal']) }}"
                                    class="bg-red-900 text-white px-8 rounded-xl mx-2 hover:bg-red-800">EDIT</a>
                                </div>
                                <!-- personal data rows ... -->
                                <div class="personal-information">
                                    <div class='box-row'>
                                        <div class="box-row-item" style="width: 300px;">
                                            <h3>First Name</h3>
                                            <h1>{{ $data->emp_fname ?? 'n/a' }}</h1>
                                        </div>
                                        <div class="box-row-item" style="width: 300px;">
                                            <h3>Middle Name</h3>
                                            <h1>{{ $data->emp_mname ?? 'n/a' }}</h1>
                                        </div>
                                        <div class="box-row-item" style="width: 300px;">
                                            <h3>Last Name</h3>
                                            <h1>{{ $data->emp_lname ?? 'n/a' }}</h1>
                                        </div>
                                        <div class="box-row-item" style="width: 100px;">
                                            <h3>Gender</h3>
                                            @if($data->emp_gender == 'Female')
                                                <h1>F</h1>
                                            @else
                                                <h1>M</h1>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="line-break"><hr></div>

                                    <div class='box-row'>
                                        <div class="box-row-item" style="width: 170px;">
                                            <h3>Date of Birth</h3>
                                            <h1>{{ explode(' ', $data->emp_dob)[0] ?? 'n/a' }}</h1>
                                        </div>
                                        <div class="box-row-item" style="width: 250px;">
                                            <h3>Place of Birth</h3>
                                            <h1>{{ $data->emp_pob ?? 'n/a' }}</h1>
                                        </div>
                                        <div class="box-row-item" style="width: 150px;">
                                            <h3>Civil Status</h3>
                                            <h1>{{ $data->emp_cStatus ?? 'n/a' }}</h1>
                                        </div>
                                        <div class="box-row-item" style="width: 200px;">
                                            <h3>Religion</h3>
                                            <h1>{{ $data->emp_religion ?? 'n/a' }}</h1>
                                        </div>
                                        <div class="box-row-item" style="width: 100px;">
                                            <h3>Blood Type</h3>
                                            <h1>{{ $data->emp_blood_type ?? 'n/a' }}</h1>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <!-- Contact Information -->
                                <div class="contact-information">
                                    <div class="box-title">
                                        <h1>Contact Information</h1>
                                        <!-- EDIT BUTTON ADDED -->
                                        <a href="{{ route('admin.users.edit', ['id'=>$data->emp_id, 'section'=>'contact']) }}"
                                        class="bg-red-900 text-white px-8 rounded-xl mx-2 hover:bg-red-800">EDIT</a>
                                    </div>
                                    <h1 class='subtitle'>Present Address</h1>
                                    <div class='box-row'>
                                        <div class="box-row-item" style="width: 70px;">
                                            <h3>House No.</h3>
                                            <h1>{{ $data->emp_houseno ?? 'n/a' }}</h1>
                                        </div>
                                        <div class="box-row-item" style="width: 170px;">
                                            <h3>Street</h3>
                                            <h1>{{ $data->street ?? 'n/a' }}</h1>
                                        </div>
                                        <div class="box-row-item" style="width: 150px;">
                                            <h3>Barangay</h3>
                                            <h1>{{ $data->brgy ?? 'n/a' }}</h1>
                                        </div>
                                        <div class="box-row-item" style="width: 200px;">
                                            <h3>City</h3>
                                            <h1>{{ $data->city ?? 'n/a' }}</h1>
                                        </div>
                                        <div class="box-row-item" style="width: 200px;">
                                            <h3>Province</h3>
                                            <h1>{{ $data->province ?? 'n/a' }}</h1>
                                        </div>
                                        <div class="box-row-item" style="width: 100px;">
                                            <h3>Postal Code</h3>
                                            <h1>{{ $data->postal_code ?? 'n/a' }}</h1>
                                        </div>
                                    </div>

                                    <div class="line-break"><hr></div>

                                    <div class='box-row'>
                                        <div class="box-row-item" style="width: 170px;">
                                            <h3>Home Phone No.</h3>
                                            <h1>{{ $data->home_phone ?? 'n/a' }}</h1>
                                        </div>
                                        <div class="box-row-item" style="width: 170px;">
                                            <h3>Mobile Phone No.</h3>
                                            <h1>{{ $data->mobile_phone ?? 'n/a' }}</h1>
                                        </div>
                                        <div class="box-row-item" style="width: 300px;">
                                            <h3>Primary Email Address</h3>
                                            <h1>{{ $data->email_address_1 ?? 'n/a' }}</h1>
                                        </div>
                                        <div class="box-row-item" style="width: 300px;">
                                            <h3>Secondary Email Address</h3>
                                            <h1>{{ $data->email_address_2 ?? 'n/a' }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Provincial Contact -->
                        <div class="section provincial-contact">
                            <div class="section-box">
                                <div class="box-title">
                                    <h1>Provincial Contact</h1>
                                    @if($data->provincial_contact != null)
                                        <span class="semi-transparent">Last Updated: 
                                            {{ $data->provincial_contact->updated_at->format('Y-m-d H:i:s') }}
                                        </span>
                                    @endif
                                    <!-- EDIT BUTTON ADDED -->
                                    <a href="{{ route('admin.users.edit', ['id'=>$data->emp_id, 'section'=>'provincial']) }}"
                                    class="bg-red-900 text-white px-8 rounded-xl mx-2 hover:bg-red-800">EDIT</a>
                                </div>
                                <h1 class='subtitle' style="margin-top: 1rem">Provincial Address</h1>
                                <div class='box-row'>
                                    @if($data->provincial_contact)
                                        <div class="box-row-item" style="width: 70px;">
                                            <h3>House No.</h3>
                                            <h1>{{ $data->provincial_contact->pc_emp_houseno }}</h1>
                                        </div>
                                        <div class="box-row-item" style="width: 170px;">
                                            <h3>Street</h3>
                                            <h1>{{ $data->provincial_contact->pc_street }}</h1>
                                        </div>
                                        <div class="box-row-item" style="width: 150px;">
                                            <h3>Barangay</h3>
                                            <h1>{{ $data->provincial_contact->pc_brgy }}</h1>
                                        </div>
                                        <div class="box-row-item" style="width: 200px;">
                                            <h3>City</h3>
                                            <h1>{{ $data->provincial_contact->pc_city }}</h1>
                                        </div>
                                        <div class="box-row-item" style="width: 200px;">
                                            <h3>Province</h3>
                                            <h1>{{ $data->provincial_contact->pc_province }}</h1>
                                        </div>
                                        <div class="box-row-item" style="width: 100px;">
                                            <h3>Postal Code</h3>
                                            <h1>{{ $data->provincial_contact->pc_postal_code }}</h1>
                                        </div>
                                    @else
                                        <div class="box-row-item" style="width: 70px;">
                                            <h3>House No.</h3>
                                            <h1>n/a</h1>
                                        </div>
                                        <div class="box-row-item" style="width: 170px;">
                                            <h3>Street</h3>
                                            <h1>n/a</h1>
                                        </div>
                                        <div class="box-row-item" style="width: 150px;">
                                            <h3>Barangay</h3>
                                            <h1>n/a</h1>
                                        </div>
                                        <div class="box-row-item" style="width: 200px;">
                                            <h3>City</h3>
                                            <h1>n/a</h1>
                                        </div>
                                        <div class="box-row-item" style="width: 200px;">
                                            <h3>Province</h3>
                                            <h1>n/a</h1>
                                        </div>
                                        <div class="box-row-item" style="width: 100px;">
                                            <h3>Postal Code</h3>
                                            <h1>n/a</h1>
                                        </div>
                                    @endif
                                </div>
                                <div class='line-break'><hr></div>
                                <div class="box-row">
                                    <div class="box-row-item" style="width: 200px">
                                        <h3>Provincial Phone Number</h3>
                                        <h1>{{ $data->provincial_contact ? $data->provincial_contact->pc_phone : 'n/a' }}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- In-case of Emergency -->
                        <div class="section emergency-box">
                            <div class="section-box">
                                <div class="box-title">
                                    <h1>In-case of Emergency</h1>
                                    <span class="semi-transparent">Last Updated:
                                        @if($data->emergency_contact && $data->emergency_contact->updated_at)
                                            {{ $data->emergency_contact->updated_at->format('Y-m-d H:i:s') }}
                                        @else
                                            n/a
                                        @endif
                                    </span>
                                    <!-- EDIT BUTTON ADDED -->
                                    <a href="{{ route('admin.users.edit', ['id'=>$data->emp_id, 'section'=>'emergency']) }}"
                                    class="bg-red-900 text-white px-8 rounded-xl mx-2 hover:bg-red-800">EDIT</a>
                                </div>
                                <h1 class='subtitle' style="margin-top: 1rem">Contact Person</h1>
                                <div class="box-row">
                                    @if($data->emergency_contact)
                                        <div class="box-row-item" style="width: 300px">
                                            <h3>First Name</h3>
                                            <h1>{{ $data->emergency_contact->cp_fname }}</h1>
                                        </div>
                                        <div class="box-row-item" style="width: 300px">
                                            <h3>Middle Name</h3>
                                            <h1>{{ $data->emergency_contact->cp_mname }}</h1>
                                        </div>
                                        <div class="box-row-item" style="width: 300px">
                                            <h3>Last Name</h3>
                                            <h1>{{ $data->emergency_contact->cp_lname }}</h1>
                                        </div>
                                        <div class="box-row-item" style="width: 200px">
                                            <h3>Relationship</h3>
                                            <h1>{{ $data->emergency_contact->cp_relationship }}</h1>
                                        </div>
                                    @else
                                        <div class="box-row-item" style="width: 300px">
                                            <h3>First Name</h3>
                                            <h1>n/a</h1>
                                        </div>
                                        <div class="box-row-item" style="width: 300px">
                                            <h3>Middle Name</h3>
                                            <h1>n/a</h1>
                                        </div>
                                        <div class="box-row-item" style="width: 300px">
                                            <h3>Last Name</h3>
                                            <h1>n/a</h1>
                                        </div>
                                        <div class="box-row-item" style="width: 200px">
                                            <h3>Relationship</h3>
                                            <h1>n/a</h1>
                                        </div>
                                    @endif
                                </div>

                                <div class="line-break"><hr></div>

                                <div class="box-row">
                                    @if($data->emergency_contact)
                                        <div class="box-row-item" style="width: 70px;">
                                            <h3>House No.</h3>
                                            <h1>{{ $data->emergency_contact->cp_house_no }}</h1>
                                        </div>
                                        <div class="box-row-item" style="width: 170px;">
                                            <h3>Street</h3>
                                            <h1>{{ $data->emergency_contact->cp_street }}</h1>
                                        </div>
                                        <div class="box-row-item" style="width: 150px;">
                                            <h3>Barangay</h3>
                                            <h1>{{ $data->emergency_contact->cp_brgy }}</h1>
                                        </div>
                                        <div class="box-row-item" style="width: 200px;">
                                            <h3>City</h3>
                                            <h1>{{ $data->emergency_contact->cp_city }}</h1>
                                        </div>
                                        <div class="box-row-item" style="width: 200px;">
                                            <h3>Province</h3>
                                            <h1>{{ $data->emergency_contact->cp_province }}</h1>
                                        </div>
                                        <div class="box-row-item" style="width: 100px;">
                                            <h3>Postal Code</h3>
                                            <h1>{{ $data->emergency_contact->cp_postal_code }}</h1>
                                        </div>
                                    @else
                                        <div class="box-row-item" style="width: 70px;">
                                            <h3>House No.</h3>
                                            <h1>n/a</h1>
                                        </div>
                                        <div class="box-row-item" style="width: 170px;">
                                            <h3>Street</h3>
                                            <h1>n/a</h1>
                                        </div>
                                        <div class="box-row-item" style="width: 150px;">
                                            <h3>Barangay</h3>
                                            <h1>n/a</h1>
                                        </div>
                                        <div class="box-row-item" style="width: 200px;">
                                            <h3>City</h3>
                                            <h1>n/a</h1>
                                        </div>
                                        <div class="box-row-item" style="width: 200px;">
                                            <h3>Province</h3>
                                            <h1>n/a</h1>
                                        </div>
                                        <div class="box-row-item" style="width: 100px;">
                                            <h3>Postal Code</h3>
                                            <h1>n/a</h1>
                                        </div>
                                    @endif
                                </div>

                                <div class="box-row">
                                    <div class="box-row-item" style="width: 250px">
                                        <h3>Home Phone No.</h3>
                                        <h1>{{ $data->emergency_contact ? $data->emergency_contact->cp_home_phone : 'n/a' }}</h1>
                                    </div>
                                    <div class="box-row-item" style="width: 250px">
                                        <h3>Mobile Phone No.</h3>
                                        <h1>{{ $data->emergency_contact ? $data->emergency_contact->cp_mobile_no : 'n/a' }}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Accounting Data -->
                        <div class="section accounting-data">
                            <div class="section-box">
                                <div class="box-title">
                                    <h1>Accounting Data</h1>
                                    <span class="semi-transparent">Last Updated:
                                        @if($data->accounting_details && $data->accounting_details->updated_at)
                                            {{ $data->accounting_details->updated_at->format('Y-m-d H:i:s') }}
                                        @else
                                            n/a
                                        @endif
                                    </span>
                                    <!-- EDIT BUTTON ADDED -->
                                    <a href="{{ route('admin.users.edit', ['id'=>$data->emp_id, 'section'=>'accounting']) }}"
                                    class="bg-red-900 text-white px-8 rounded-xl mx-2 hover:bg-red-800">EDIT</a>
                                </div>
                                <div class="box-row">
                                    <div class="box-row-item" style="width: 300px">
                                        <h3>SSS No.</h3>
                                        <h1>{{ $data->accounting_details->sss_no ?? 'n/a' }}</h1>
                                    </div>
                                    <div class="box-row-item" style="width: 300px">
                                        <h3>Tax Identification No.</h3>
                                        <h1>{{ $data->accounting_details->tax_no ?? 'n/a' }}</h1>
                                    </div>
                                    <div class="box-row-item" style="width: 300px">
                                        <h3>Pag-Ibig No.</h3>
                                        <h1>{{ $data->accounting_details->pagibig_no ?? 'n/a' }}</h1>
                                    </div>
                                    <div class="box-row-item" style="width: 300px">
                                        <h3>PhilHealth No.</h3>
                                        <h1>{{ $data->accounting_details->philhealth_no ?? 'n/a' }}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Hiring Information -->
                        <div class="section hiring-info mt-2">
                            <div class="section-box">
                                <div class="box-title">
                                    <h1>Hiring Information</h1>
                                    <a href="{{ route('admin.hiring', $data->emp_id) }}" class="bg-red-900 text-white px-8 rounded-xl mx-2 hover:bg-red-800">
                                        EDIT
                                    </a>
                                </div>
                                <div class="box-row">
                                    <div class="box-row-item" style="width: 150px">
                                        <h3>Position</h3>
                                        <h1>{{ $data->hiring->emp_position ?? 'n/a' }}</h1>
                                    </div>
                                    <div class="box-row-item" style="width: 150px">
                                        <h3>Nature</h3>
                                        <h1>{{ $data->hiring->emp_nature ?? 'n/a' }}</h1>
                                    </div>
                                    <div class="box-row-item" style="width: 300px" class="mr-2">
                                        <h3>Tenure</h3>
                                        <h1>
                                            {{ $data->hiring->emp_tenure ?? 'n/a' }}
                                            @if($data->hiring && $data->hiring->emp_tenure === 'Non-tenured')
                                                - {{ $data->hiring->non_tenured }}
                                            @endif
                                        </h1>
                                    </div>
                                    <div class="box-row-item" style="width: 300px">
                                        <h3>Required License</h3>
                                        @if (($data->hiring->license ?? 0) === 1)
                                            <h1>Yes</h1>
                                        @else
                                            <h1>No</h1>
                                        @endif
                                    </div>
                                    <div class="box-row-item" style="width: 300px">
                                        <h3>Division</h3>
                                        <h1>{{ $data->hiring->division ?? 'n/a' }}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Login Information Section -->
                        <div class="section login-info mt-4">
                            <div class="section-box">
                                <div class="box-title">
                                    <h1>Login Information</h1>
                                    <a href="{{ route('admin.users.edit', ['id' => $data->emp_id, 'section' => 'login']) }}" 
                                        class="bg-red-900 text-white px-8 rounded-xl mx-2 hover:bg-red-800">
                                        EDIT
                                    </a>
                                </div>
                                <div class="box-row">
                                    <div class="box-row-item" style="width: 150px;">
                                        <h3>ID</h3>
                                        <h1>{{ $data->login->id ?? 'n/a' }}</h1>
                                    </div>
                                    <div class="box-row-item" style="width: 300px;">
                                        <h3>Email</h3>
                                        <h1>{{ $data->login->email ?? 'n/a' }}</h1>
                                    </div>
                                    <div class="box-row-item" style="width: 300px;">
                                        <h3>Password</h3>
                                        {{-- Since the password is stored hashed, we show a masked string --}}
                                        <h1>{{ isset($data->login->password) ? str_repeat('*', 10) : 'n/a' }}</h1>
                                    </div>
                                    <div class="box-row-item" style="width: 150px;">
                                        <h3>Role</h3>
                                        <h1>{{ $data->login->role ?? 'n/a' }}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END OF profile -->

                    <!-- HIRING HISTORY TAB -->
                    <div id="hiringHistory" class="w-full flex flex-col border border-gray-200 gap-0 inactive_link">
                        @if($data->hiringHistory->count() == 0)
                            <div class="w-full flex items-center justify-center text-sm text-gray-400 pt-8 pb-12">
                                <span class="italic"> No user data. </span> 
                            </div>
                        @else
                        <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                            <thead class="bg-red-900 text-white">
                                <tr>
                                    <th class="py-4 px-6 text-left text-sm font-medium">DATE</th>
                                    <th class="py-4 px-6 text-left text-sm font-medium">POSITION</th>
                                    <th class="py-4 px-6 text-left text-sm font-medium">DIVISION</th>
                                    <th class="py-4 px-6 text-left text-sm font-medium">DEPARTMENT</th>
                                    <th class="py-4 px-6 text-left text-sm font-medium">NATURE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data->hiringHistory->sortByDesc('date') as $hiring)
                                <tr class="border-b hover:bg-gray-50 transition-all duration-300 ease-in-out">
                                    <td class="py-4 px-6">{{ \Carbon\Carbon::parse($hiring->date)->format('Y-M-d') }}</td>
                                    <td class="py-4 px-6">{{ $hiring->position }}</td>
                                    <td class="py-4 px-6">{{ $hiring->division }}</td>
                                    <td class="py-4 px-6">{{ $hiring->department }}</td>
                                    <td class="py-4 px-6">{{ $hiring->nature }}</td> 
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>

                    <!-- CERTIFICATIONS TAB -->
                    <div id="certs" class="w-full flex flex-col border border-gray-200 gap-0 inactive_link">
                        @if($data->certification->where('hau_cert', null)->count() == 0)
                            <div class="w-full flex items-center justify-center text-sm text-gray-400 pt-8 pb-12">
                                <span class="italic"> No user data. </span> 
                            </div>
                        @else
                            <div class="w-full flex flex-col overflow-y-auto h-[300px]">
                                @foreach($data->certification as $item)
                                    @if(!isset($item->hau_cert))
                                    <div class="w-full grid grid-cols-[85%_15%] hover:bg-gray-100 px-4 py-4 border-l-8 border-red-900 border-b-2 border-t-2 record-item"
                                         data-status="{{ $item->status }}">
                                        <div class="flex flex-col leading-tight">
                                            <h1 class="font-semibold text-gray-700">
                                                <strong>Certification</strong> - {{ $item->cert_title }}
                                            </h1>
                                            <span class="italic text-sm text-gray-500">
                                                Date Issued: {{ $item->date_issued }}
                                            </span>
                                            <div class="flex items-start">
                                                <img src="{{ asset('images/icons/attachment.png') }}" class="w-[20px] h-[20px]"/> 
                                                <a title="{{ $item->attachment }}" class="hover:underline text-gray-600" 
                                                href="{{ asset('storage/' . $item->file_path ) }}" target="_blank">
                                                    {{ $item->attachment }}
                                                </a>
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-end gap-1">
                                            <a href="{{ route('admin.users.viewItem', ['id' => $item->id]) }}"
                                            class="border bg-red-900 rounded-xl p-2 hover:bg-red-700" title="View Info">
                                                <img src="{{ asset('images/icons/eye.svg') }}" alt="" class="w-[20px] h-[20px]">
                                            </a>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- TRAININGS TAB -->
                    <div id="trainings" class="w-full flex flex-col border border-gray-200 gap-0 inactive_link">
                        @if($trainings->count() == 0)
                            <div class="w-full flex items-center justify-center text-sm text-gray-400 pt-8 pb-12">
                                <span class="italic"> No user data. </span> 
                            </div>
                        @else
                            <div class="w-full flex flex-col overflow-y-auto h-[300px]">
                            @foreach($trainings as $item)
                                <div class="w-full grid grid-cols-[85%_15%] hover:bg-gray-100 px-4 py-4 border-l-8 border-red-900 border-b-2 border-t-2 record-item" data-status="{{ $item->status }}">
                                    @if($item instanceof \App\Models\Trainings)
                                        <div class="flex flex-col leading-tight">
                                            <h1 class="font-semibold text-gray-700">
                                                <strong>{{ $item->type }} Training</strong> - {{ $item->title }}
                                            </h1>
                                            <span class="italic text-sm text-gray-500">
                                                Conducted By: {{ $item->organization }}
                                            </span>
                                            <span class="italic text-sm text-gray-500">
                                                Date of Training: {{ $item->start_date }} to {{ $item->end_date }}
                                            </span>
                                            <div class="flex items-start">
                                                <img src="{{ asset('images/icons/attachment.png') }}" class="w-[20px] h-[20px]" alt="Attachment Icon" />
                                                <a title="{{ $item->attachment }}" class="hover:underline text-gray-600" 
                                                href="{{ asset('storage/trainings/' . Auth::user()->id . '/' . $item->id . '.' . explode('.', $item->attachment)[1]) }}"
                                                target="_blank">
                                                    {{ $item->attachment }}
                                                </a>
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-end gap-1">
                                            <a href="{{ route('admin.users.viewItem', ['id' => $item->id]) }}" 
                                            class="border bg-red-900 rounded-xl p-2 hover:bg-red-700" title="View Info">
                                                <img src="{{ asset('images/icons/eye.svg') }}" alt="View Icon" class="w-[20px] h-[20px]" />
                                            </a>
                                        </div>
                                    @elseif($item instanceof \App\Models\certifications)
                                        <div class="flex flex-col leading-tight">
                                            <h1 class="font-semibold text-gray-700">
                                                <strong>HAU Certificate</strong> - {{ $item->cert_title }}
                                            </h1>
                                            <span class="italic text-sm text-gray-500">
                                                Date Issued: {{ $item->date_issued }}
                                            </span>
                                            <div class="flex items-start">
                                                <img src="{{ asset('images/icons/attachment.png') }}" class="w-[20px] h-[20px]" alt="Attachment Icon" />
                                                <a title="{{ $item->attachment }}" class="hover:underline text-gray-600" 
                                                href="{{ asset('storage/' . $item->file_path) }}"
                                                target="_blank">
                                                    {{ $item->attachment }}
                                                </a>
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-end gap-1">
                                            <a href="{{ route('admin.users.viewItem', ['id' => $item->id]) }}" 
                                            class="border bg-red-900 rounded-xl p-2 hover:bg-red-700" title="View Info">
                                                <img src="{{ asset('images/icons/eye.svg') }}" alt="View Icon" class="w-[20px] h-[20px]" />
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- LICENSES TAB -->
                    <div id="licenses" class="w-full flex flex-col border border-gray-200 gap-0 inactive_link">
                        @if($data->licenses->count() == 0)
                            <div class="w-full flex items-center justify-center text-sm text-gray-400 pt-8 pb-12">
                                <span class="italic"> No user data. </span> 
                            </div>
                        @else
                            <div class="w-full flex flex-col items-center overflow-y-auto h-[300px]">
                                @foreach($data->licenses as $item)
                                    <div class="w-full grid grid-cols-[85%_15%] hover:bg-gray-100 px-4 py-4 border-l-8 border-red-900 border-b-2 border-t-2 record-item"
                                         data-status="{{ $item->status }}">
                                        <div class="flex flex-col leading-tight">
                                            <h1 class="font-bold text-gray-700">
                                                {{ $item->type }} - {{ $item->title }}
                                            </h1>
                                            <span class="italic text-sm text-gray-500">
                                                Date Obtained: {{ $item->date_obtained }}
                                            </span>
                                        </div>
                                        <div class="flex items-center justify-end gap-1">
                                            <a href="{{ route('admin.users.viewItem', ['id'=> $item->id]) }}"
                                            class="border bg-red-900 rounded-xl p-2 hover:bg-red-700" title="View Info">
                                                <img src="{{ asset('images/icons/eye.svg') }}" alt="" class="w-[20px] h-[20px]">
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- EDUCATION TAB -->
                    <div id="educations" class="w-full flex flex-col border border-gray-200 rounded-lg shadow-sm overflow-hidden inactive_link">
                        <div class="w-full bg-red-900 text-white grid grid-cols-[10%_10%_20%_35%_15%_10%] p-3 font-semibold text-sm uppercase tracking-wider">
                            <span>From</span>
                            <span>To</span>
                            <span>Education Type</span>
                            <span>School Name</span>
                            <span>School Address</span>
                            <span class="text-center">Actions</span>
                        </div>

                        @if($data->educations->count() == 0)
                            <div class="w-full flex items-center justify-center text-sm text-gray-400 py-8">
                                <span class="italic">No user data available.</span>
                            </div>
                        @else
                            <div class="w-full flex flex-col overflow-y-auto h-[300px]">
                                @foreach($data->educations as $item)
                                <div class="w-full grid grid-cols-[10%_10%_20%_35%_15%_10%] p-4 border-t border-gray-200 bg-white hover:bg-gray-50 transition-colors record-item"
                                     data-status="{{ $item->status }}">
                                    <span class="flex items-center text-gray-700">{{$item->start_date}}</span>
                                    <span class="flex items-center text-gray-700">{{$item->end_date}}</span>
                                    <span class="flex items-center text-gray-700">{{$item->education_type}}</span>
                                    <span class="flex items-center text-gray-700">{{$item->school_name}}</span>
                                    <span class="flex items-center text-gray-700">{{$item->school_address}}</span>
                                    <div class="w-full flex justify-center">
                                            <a href="{{ route('admin.users.viewItem', ['id' => $item->id]) }}"
                                            class="w-[95%] py-2 bg-green-700 text-white rounded-lg hover:bg-green-600 transition-all text-center">
                                            INFO
                                            </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- EMPLOYMENT TAB -->
                    <div id="employments" class="w-full flex flex-col border border-gray-200 rounded-lg shadow-sm overflow-hidden inactive_link">
                        <div class="w-full bg-red-900 text-white grid grid-cols-[35%_20%_15%_15%_15%] p-3 font-semibold text-sm uppercase tracking-wider">
                            <span>Company</span>
                            <span>Position</span>
                            <span>Date Hired</span>
                            <span>Date Resigned</span>
                            <span class="text-center">Actions</span>
                        </div>
                        @if($data->employments->count() == 0)
                            <div class="w-full flex items-center justify-center text-sm text-gray-400 py-8">
                                <span class="italic">No user data available.</span>
                            </div>
                        @else
                            <div class="w-full flex flex-col overflow-y-auto h-[300px]">
                                @foreach($data->employments as $item)
                                    <div class="w-full grid grid-cols-[35%_20%_15%_15%_15%] p-4 border-t border-gray-200 bg-white hover:bg-gray-50 transition-colors record-item"
                                         data-status="{{ $item->status }}">
                                        <span class="flex items-center text-gray-700">{{ $item->company }}</span>
                                        <span class="flex items-center text-gray-700">{{ $item->position }}</span>
                                        <span class="flex items-center text-gray-700">{{ $item->date_hired }}</span>
                                        <span class="flex items-center text-gray-700">{{ $item->date_resigned }}</span>
                                        <div class="w-full flex justify-center">
                                            <a href="{{ route('admin.users.viewItem', ['id' => $item->id]) }}"
                                            class="w-[95%] py-2 bg-green-700 text-white rounded-lg hover:bg-green-600 transition-all text-center">
                                            INFO
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- RESEARCH AND PUBLICATION TAB -->
                    <div id="respubs" class="w-full flex flex-col border border-gray-200 gap-0 inactive_link">
                        @php
                            $merged = $data->research->merge($data->publication);
                        @endphp
                        @if($merged->count() == 0)
                            <div class="w-full flex items-center justify-center text-sm text-gray-400 pt-8 pb-12">
                                <span class="italic"> No user data. </span> 
                            </div>
                        @else
                            <div class="w-full flex flex-col items-center overflow-y-auto h-[300px]">
                                @foreach($merged as $item)
                                    @php
                                        $itemType = ($item instanceof \App\Models\Research) ? 'Research' : 'Publication';
                                    @endphp
                                    <div class="w-full grid grid-cols-[85%_15%] hover:bg-gray-100 px-4 py-4 border-l-8 border-red-900 border-b-2 border-t-2 record-item"
                                         data-status="{{ $item->status }}">
                                        <div class="flex flex-col leading-tight">
                                            <h1 class="font-semibold text-gray-700">
                                                <strong>{{ $itemType }}</strong> - {{ $item->title }}
                                            </h1>
                                            @if($item instanceof \App\Models\Publication)
                                                <span class="italic text-sm text-gray-500">
                                                    Date Published: {{ $item->date_published }}
                                                </span>
                                            @endif
                                            <div class="flex items-start">
                                                <img src="{{ asset('images/icons/attachment.png') }}" class="w-[20px] h-[20px]"/> 
                                                <a title="{{ $item->attachment }}" class="hover:underline text-gray-600"
                                                href="{{ asset('storage/' . $item->file_path) }}" target="_blank">
                                                    {{ $item->attachment }}
                                                </a>
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-end gap-1">
                                            <a href="{{ route('admin.users.viewItem', ['id'=>$item->id]) }}"
                                            class="border bg-red-900 rounded-xl p-2 hover:bg-red-700" title="View Info">
                                                <img src="{{ asset('images/icons/eye.svg') }}" alt="" class="w-[20px] h-[20px]">
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <!-- ORGANIZATION TAB -->
                    <div id="orgs" class="w-full flex flex-col border border-gray-200 rounded-lg shadow-sm overflow-hidden inactive_link">
                        <div class="w-full bg-red-900 text-white grid grid-cols-[35%_20%_15%_15%] p-3 font-semibold text-sm uppercase tracking-wider">
                            <span>Organization</span>
                            <span>Position</span>
                            <span>Date Hired</span>
                            <span class="text-center">Actions</span>
                        </div>
                        @if($data->orgs->count() == 0)
                            <div class="w-full flex items-center justify-center text-sm text-gray-400 py-8">
                                <span class="italic">No user data available.</span>
                            </div>
                        @else
                            <div class="w-full flex flex-col overflow-y-auto h-[300px]">
                                @foreach($data->orgs as $item)
                                    <div class="w-full grid grid-cols-[35%_20%_15%_15%] p-4 border-t border-gray-200 bg-white hover:bg-gray-50 transition-colors record-item"
                                         data-status="{{ $item->status }}">
                                        <span class="flex items-center text-gray-700">{{ $item->org }}</span>
                                        <span class="flex items-center text-gray-700">{{ $item->position }}</span>
                                        <span class="flex items-center text-gray-700">{{ $item->date_joined }}</span>
                                        <div class="w-full flex justify-center">
                                            <a href="{{ route('admin.users.viewItem', ['id' => $item->id]) }}"
                                            class="w-[95%] py-2 bg-green-700 text-white rounded-lg hover:bg-green-600 transition-all text-center">
                                            INFO
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- DEPENDENTS TAB -->
                    <div id="dependents" class="w-full flex flex-col border border-gray-200 rounded-lg shadow-sm overflow-hidden inactive_link">
                        @if($data->dependencies->count() == 0)
                        <div class="w-full flex items-center justify-center text-sm text-gray-400 pt-4 pb-12">
                            <span class="italic">No user data.</span>
                        </div>
                        @else
                            <div class="w-[100%] overflow-hidden border border-gray-300 rounded-lg shadow-lg">
                                <div class="bg-gray-100 p-4">
                                    <h2 class="text-lg font-semibold text-gray-700">Dependents List</h2>
                                </div>
                                <div class="bg-white divide-y divide-gray-300">
                                @foreach($data->dependencies as $item)
                                    <div class="flex items-center justify-between p-4 @if($loop->even) bg-gray-50 @endif record-item"
                                         data-status="{{ $item->status }}">
                                        <div class="flex-1">
                                            <h1 class="font-bold text-gray-800">{{ $item->fname . ' ' . $item->mname . ' ' . $item->lname }}</h1>
                                            <p class="text-sm text-gray-600">{{ $item->relationship }}</p>
                                            <p class="text-xs text-gray-500">{{ $item->created_at->format('Y-m-d H:i') }}</p>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('admin.users.viewItem', ['id' => $item->id]) }}"
                                            class="text-blue-600 hover:underline">
                                                INFO
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
         .active_link {
            border-bottom: 4px solid #FFD700;
            font-weight: 700;
            transition: 300ms;
        }
        .active_link:hover {
            background-color: rgb(230, 230, 230);
        }
        .inactive_link { 
            display: none; 
        }

        .container {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem 0;
        }

        .profile-card {
            width: 100%;
            border-radius: 15px;
            background-color: white;
            padding-bottom: 2rem;
        }

        .account-info {
            width: 100%;
            height: 180px;
        }

        .account-info-box {
            width: 100%;
            height: 100%;
            display: grid;
            grid-template-columns: 80% 20%;
        }

        .account-info-box-left,
        .account-info-box-right {
            width: 100%;
            height: 100%;
        }

        .account-info-box-left {
            display: grid;
            grid-template-columns: 30% 70%;
        }

        .account-image,
        .account-details {
            width: 100%;
            height: 100%;
        }

        .account-image {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .acc-img {
            width: 125px;
            height: 125px;
            border-radius: 50%;
        }

        .account-info-box-right {
            display: flex;
            justify-items: flex-end;
            align-items: center;
        }

        .hau-banner {
            width: 130px;
            height: 130px;
        }

        .account-details {
            display: flex;
            justify-content: center;
            flex-direction: column;
        }

        #empid {
            font-size: 40px;
            font-weight: 900;
            line-height: 1.5rem;
            color: #333333;
        }

        #role {
            font-size: 20px;
            font-weight: 700;
            color: #666666;
        }

        .section {
            width: 100%;
            height: 80px;
            display: flex;
            justify-content: center;
            overflow: hidden;
            transition: 300ms ease-in-out;
        }

        .pd-clicked {
            cursor: default;
            height: 650px;
        }

        .pc-clicked {
            cursor: default;
            height: 300px;
        }

        .emergency-clicked {
            cursor: default;
            height: 370px;
        }

        .ad-clicked {
            cursor: default;
            height: 180px;
        }

        .dep-clicked {
            cursor: default;
            height: 350px;
        }

        .section-box {
            width: 95%;
            height: 95%;
            border: 1px solid rgba(0, 0, 0, 0.3);
            padding: 1rem 2rem;
            border-radius: 15px;
        }

        .box-title {
            width: 100%;
            height: 50px;
            display: flex;
            align-items: center;
            position: relative;
            margin-bottom: 1rem;
        }

        .box-title h1 {
            font-size: 1.2rem;
            font-weight: 700;
            color: #333333;
        }

        .subtitle {
            color: rgb(180, 180, 180);
            font-size: 1rem;
            font-style: italic;
        }

        .box-title a {
            padding: 0 2rem;
            background-color: #70121D;
            color: white;
            border-radius: 10px;
            font-size: 12px;
            transition: 300ms;
            z-index: 3;
        }

        .box-title a:hover {
            background-color: #8A2B36;
        }

        .section-box-button {
            height: 80px;
            width: 10%;
            float: right;
            right: 0;
            position: absolute;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 5;
        }

        .edit-btn {
            position: absolute;
            float: right;
            right: 8%;
        }

        .login-info {
            height: auto;
        }

        .dp_button {
            color: #70121D;
            transition: 300ms;
            font-size: 1.2rem;
            cursor: pointer;
        }

        .dp_button:hover {
            color: #A84655;
            transform: scale(1.1);
        }

        .line-break hr {
            opacity: 0.8;
        }

        .box-row {
            width: 100%;
            padding: 1rem 0;
            display: flex;
        }

        .box-row-item {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .box-row-item h1 {
            font-size: 1rem;
            font-weight: bold;
            color: #333333;
        }

        .box-row-item h3 {
            font-size: 11px;
            opacity: 0.6;
        }

        .status::before {
            content: "●";
            font-size: 1.5rem;
        }

        .status {
            font-weight: 900;
        }
        
        .semi-transparent {
            font-size: 0.8rem;
            opacity: 0.5;
            margin: 0 1rem;
        }

        .approved {
            color: green;
        }

        .pending {
            color: orange;
        }

        .msg-box {
            width: 100%;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #msg {
            width: 95%;
            text-align: center;
            padding: 5px 0;
            background-color: green;
            color: white;
            border-radius: 15px;
        }

        #successMessage {
            display: none;
            text-align: center;
            color: green;
            width: 95%;
            background: #e0ffe0;
            padding: 10px;
            border: 1px solid #b0ffb0;
            border-radius: 25px;
            margin: 0 auto;
            margin-bottom: 10px;
            transition: 300ms;
        }

        .table {
            width: 100%;
        }

        .tbl-header {
            width: 100%;
            height: 40px;
            background-color: maroon;
            display: grid;
        }

        .tbl-row {
            width: 100%;
            height: 40px;
            display: grid;
        }

        .tbl-row h1 {
            font-weight: 500;
            font-size: 14px;
        }

        .empty {
            display: flex;
            justify-content: center;
            align-items: center;
            color: lightgray;
        }

        .empty h1 {
            color: rgba(40, 40, 40, 0.7);
        }

        .table button {
            background-color: maroon;
            color: white;
            padding: 0 2.3rem;
            border-radius: 25px;
            transition: 300ms;
            font-size: 15px;
        }

        .table button:hover {
            background-color: #A84655;
        }

        .tbl-col {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            padding-left: 1rem;
        }

        .stripe {
            background-color: beige;
        }

        .tbl-header .tbl-col h1 {
            color: white;
            font-size: 13px;
            font-weight: 500;
        }

        .dep .tbl-header,
        .dep .tbl-row {
            grid-template-columns: 50% 20% 30%;
        }

        .personal-data {
            height: 550px;
        }

        .provincial-contact {
            height: 300px;
        }

        .emergency-box {
            height: 370px;
        }

        .accounting-data,
        .hiring-info {
            height: 180px;
        }

        /* Modern dropdown styling */
        .modern-dropdown {
            padding: 0.5rem 1rem;
            border: 1px solid #ccc;
            border-radius: 0.5rem;
            font-size: 1rem;
            outline: none;
            transition: border-color 0.3s;
            /* lengthen the dropdown here */
            min-width: 200px;
        }
        .modern-dropdown:focus {
            border-color: #70121D;
            box-shadow: 0 0 5px rgba(112,18,29,0.5);
        }
    </style>

<script>
    setTimeout(() => {
        let actmsg = document.getElementById('actmsg');
        if (actmsg) actmsg.style.display = 'none';
    }, 5000);

    function confirmTerminate(button) {
        if (confirm("Are you sure you want to terminate this account?")) {
            button.closest('form').submit();
        }
    }
    function confirmActivate(button) {
        if (confirm("Are you sure you want to activate this account?")) {
            button.closest('form').submit();
        }
    }

    // Global variable to track the current active tab's id
    let currentActiveTabId = 'profile';

    // Tab UI logic
    const profile_btn = document.getElementById('profile_btn');
    const hiringHistory_btn = document.getElementById('hiringHistory_btn');
    const certifications_btn = document.getElementById('certifications_btn');
    const trainings_btn = document.getElementById('trainings_btn');
    const licenses_btn = document.getElementById('licenses_btn');
    const educations_btn = document.getElementById('educations_btn');
    const employments_btn = document.getElementById('employments_btn');
    const respubs_btn = document.getElementById('respubs_btn');
    const orgs_btn = document.getElementById('orgs_btn');
    const dependents_btn = document.getElementById('dependents_btn');

    const profile = document.getElementById('profile');
    const hiringHistory = document.getElementById('hiringHistory');
    const certs = document.getElementById('certs');
    const trainings = document.getElementById('trainings');
    const licenses = document.getElementById('licenses');
    const educations = document.getElementById('educations');
    const employments = document.getElementById('employments');
    const respubs = document.getElementById('respubs');
    const orgs = document.getElementById('orgs');
    const dependents = document.getElementById('dependents');

    profile_btn.addEventListener("click", () => {
        currentActiveTabId = 'profile';
        profile_btn.classList.add("active_link");
        hiringHistory_btn.classList.remove('active_link');
        certifications_btn.classList.remove('active_link');
        trainings_btn.classList.remove('active_link');
        licenses_btn.classList.remove('active_link');
        educations_btn.classList.remove('active_link');
        employments_btn.classList.remove('active_link');
        respubs_btn.classList.remove('active_link');
        orgs_btn.classList.remove('active_link');
        dependents_btn.classList.remove('active_link');

        profile.classList.remove('inactive_link');
        hiringHistory.classList.add('inactive_link');
        certs.classList.add('inactive_link');
        trainings.classList.add('inactive_link');
        licenses.classList.add('inactive_link');
        educations.classList.add('inactive_link');
        employments.classList.add('inactive_link');
        respubs.classList.add('inactive_link');
        orgs.classList.add('inactive_link');
        dependents.classList.add('inactive_link');

        updateDropdownVisibility('profile');
    });
    hiringHistory_btn.addEventListener("click", () => {
        currentActiveTabId = 'hiringHistory';
        profile_btn.classList.remove("active_link");
        hiringHistory_btn.classList.add('active_link');
        certifications_btn.classList.remove('active_link');
        trainings_btn.classList.remove('active_link');
        licenses_btn.classList.remove('active_link');
        educations_btn.classList.remove('active_link');
        employments_btn.classList.remove('active_link');
        respubs_btn.classList.remove('active_link');
        orgs_btn.classList.remove('active_link');
        dependents_btn.classList.remove('active_link');

        profile.classList.add('inactive_link');
        hiringHistory.classList.remove('inactive_link');
        certs.classList.add('inactive_link');
        trainings.classList.add('inactive_link');
        licenses.classList.add('inactive_link');
        educations.classList.add('inactive_link');
        employments.classList.add('inactive_link');
        respubs.classList.add('inactive_link');
        orgs.classList.add('inactive_link');
        dependents.classList.add('inactive_link');

        updateDropdownVisibility('hiringHistory');
    });
    certifications_btn.addEventListener("click", () => {
        currentActiveTabId = 'certs';
        profile_btn.classList.remove("active_link");
        hiringHistory_btn.classList.remove('active_link');
        certifications_btn.classList.add('active_link');
        trainings_btn.classList.remove('active_link');
        licenses_btn.classList.remove('active_link');
        educations_btn.classList.remove('active_link');
        employments_btn.classList.remove('active_link');
        respubs_btn.classList.remove('active_link');
        orgs_btn.classList.remove('active_link');
        dependents_btn.classList.remove('active_link');

        profile.classList.add('inactive_link');
        hiringHistory.classList.add('inactive_link');
        certs.classList.remove('inactive_link');
        trainings.classList.add('inactive_link');
        licenses.classList.add('inactive_link');
        educations.classList.add('inactive_link');
        employments.classList.add('inactive_link');
        respubs.classList.add('inactive_link');
        orgs.classList.add('inactive_link');
        dependents.classList.add('inactive_link');

        updateDropdownVisibility('certs');
    });
    trainings_btn.addEventListener("click", () => {
        currentActiveTabId = 'trainings';
        profile_btn.classList.remove("active_link");
        hiringHistory_btn.classList.remove('active_link');
        certifications_btn.classList.remove('active_link');
        trainings_btn.classList.add('active_link');
        licenses_btn.classList.remove('active_link');
        educations_btn.classList.remove('active_link');
        employments_btn.classList.remove('active_link');
        respubs_btn.classList.remove('active_link');
        orgs_btn.classList.remove('active_link');
        dependents_btn.classList.remove('active_link');

        profile.classList.add('inactive_link');
        hiringHistory.classList.add('inactive_link');
        certs.classList.add('inactive_link');
        trainings.classList.remove('inactive_link');
        licenses.classList.add('inactive_link');
        educations.classList.add('inactive_link');
        employments.classList.add('inactive_link');
        respubs.classList.add('inactive_link');
        orgs.classList.add('inactive_link');
        dependents.classList.add('inactive_link');

        updateDropdownVisibility('trainings');
    });
    licenses_btn.addEventListener("click", () => {
        currentActiveTabId = 'licenses';
        profile_btn.classList.remove("active_link");
        hiringHistory_btn.classList.remove('active_link');
        certifications_btn.classList.remove('active_link');
        trainings_btn.classList.remove('active_link');
        licenses_btn.classList.add('active_link');
        educations_btn.classList.remove('active_link');
        employments_btn.classList.remove('active_link');
        respubs_btn.classList.remove('active_link');
        orgs_btn.classList.remove('active_link');
        dependents_btn.classList.remove('active_link');

        profile.classList.add('inactive_link');
        hiringHistory.classList.add('inactive_link');
        certs.classList.add('inactive_link');
        trainings.classList.add('inactive_link');
        licenses.classList.remove('inactive_link');
        educations.classList.add('inactive_link');
        employments.classList.add('inactive_link');
        respubs.classList.add('inactive_link');
        orgs.classList.add('inactive_link');
        dependents.classList.add('inactive_link');

        updateDropdownVisibility('licenses');
    });
    educations_btn.addEventListener("click", () => {
        currentActiveTabId = 'educations';
        profile_btn.classList.remove("active_link");
        hiringHistory_btn.classList.remove('active_link');
        certifications_btn.classList.remove('active_link');
        trainings_btn.classList.remove('active_link');
        licenses_btn.classList.remove('active_link');
        educations_btn.classList.add('active_link');
        employments_btn.classList.remove('active_link');
        respubs_btn.classList.remove('active_link');
        orgs_btn.classList.remove('active_link');
        dependents_btn.classList.remove('active_link');

        profile.classList.add('inactive_link');
        hiringHistory.classList.add('inactive_link');
        certs.classList.add('inactive_link');
        trainings.classList.add('inactive_link');
        licenses.classList.add('inactive_link');
        educations.classList.remove('inactive_link');
        employments.classList.add('inactive_link');
        respubs.classList.add('inactive_link');
        orgs.classList.add('inactive_link');
        dependents.classList.add('inactive_link');

        updateDropdownVisibility('educations');
    });
    employments_btn.addEventListener("click", () => {
        currentActiveTabId = 'employments';
        profile_btn.classList.remove("active_link");
        hiringHistory_btn.classList.remove('active_link');
        certifications_btn.classList.remove('active_link');
        trainings_btn.classList.remove('active_link');
        licenses_btn.classList.remove('active_link');
        educations_btn.classList.remove('active_link');
        employments_btn.classList.add('active_link');
        respubs_btn.classList.remove('active_link');
        orgs_btn.classList.remove('active_link');
        dependents_btn.classList.remove('active_link');

        profile.classList.add('inactive_link');
        hiringHistory.classList.add('inactive_link');
        certs.classList.add('inactive_link');
        trainings.classList.add('inactive_link');
        licenses.classList.add('inactive_link');
        educations.classList.add('inactive_link');
        employments.classList.remove('inactive_link');
        respubs.classList.add('inactive_link');
        orgs.classList.add('inactive_link');
        dependents.classList.add('inactive_link');

        updateDropdownVisibility('employments');
    });
    respubs_btn.addEventListener("click", () => {
        currentActiveTabId = 'respubs';
        profile_btn.classList.remove("active_link");
        hiringHistory_btn.classList.remove('active_link');
        certifications_btn.classList.remove('active_link');
        trainings_btn.classList.remove('active_link');
        licenses_btn.classList.remove('active_link');
        educations_btn.classList.remove('active_link');
        employments_btn.classList.remove('active_link');
        respubs_btn.classList.add('active_link');
        orgs_btn.classList.remove('active_link');
        dependents_btn.classList.remove('active_link');

        profile.classList.add('inactive_link');
        hiringHistory.classList.add('inactive_link');
        certs.classList.add('inactive_link');
        trainings.classList.add('inactive_link');
        licenses.classList.add('inactive_link');
        educations.classList.add('inactive_link');
        employments.classList.add('inactive_link');
        respubs.classList.remove('inactive_link');
        orgs.classList.add('inactive_link');
        dependents.classList.add('inactive_link');

        updateDropdownVisibility('respubs');
    });

    orgs_btn.addEventListener("click", () => {
        currentActiveTabId = 'orgs';
        profile_btn.classList.remove("active_link");
        hiringHistory_btn.classList.remove('active_link');
        certifications_btn.classList.remove('active_link');
        trainings_btn.classList.remove('active_link');
        licenses_btn.classList.remove('active_link');
        educations_btn.classList.remove('active_link');
        employments_btn.classList.remove('active_link');
        respubs_btn.classList.remove('active_link');
        orgs_btn.classList.add('active_link');
        dependents_btn.classList.remove('active_link');

        profile.classList.add('inactive_link');
        hiringHistory.classList.add('inactive_link');
        certs.classList.add('inactive_link');
        trainings.classList.add('inactive_link');
        licenses.classList.add('inactive_link');
        educations.classList.add('inactive_link');
        employments.classList.add('inactive_link');
        respubs.classList.add('inactive_link');
        orgs.classList.remove('inactive_link');
        dependents.classList.add('inactive_link');

        updateDropdownVisibility('orgs');
    });

    dependents_btn.addEventListener("click", () => {
        currentActiveTabId = 'dependents';
        profile_btn.classList.remove("active_link");
        hiringHistory_btn.classList.remove('active_link');
        certifications_btn.classList.remove('active_link');
        trainings_btn.classList.remove('active_link');
        licenses_btn.classList.remove('active_link');
        educations_btn.classList.remove('active_link');
        employments_btn.classList.remove('active_link');
        respubs_btn.classList.remove('active_link');
        orgs_btn.classList.remove('active_link');
        dependents_btn.classList.add('active_link');

        profile.classList.add('inactive_link');
        hiringHistory.classList.add('inactive_link');
        certs.classList.add('inactive_link');
        trainings.classList.add('inactive_link');
        licenses.classList.add('inactive_link');
        educations.classList.add('inactive_link');
        employments.classList.add('inactive_link');
        respubs.classList.add('inactive_link');
        orgs.classList.add('inactive_link');
        dependents.classList.remove('inactive_link');

        updateDropdownVisibility('dependents');
    });

      // Filtering logic for dropdown with case-insensitive matching and "All" option support
      function filterRecords(activeTabId) {
        var selectedStatus = document.getElementById('statusFilter').value.toLowerCase().trim();
        var activeTab = document.getElementById(activeTabId);
        if(activeTab) {
            // Determine the default display style based on the active tab
            var defaultDisplay = (activeTabId === 'dependents') ? 'flex' : 'grid';
            var items = activeTab.querySelectorAll('.record-item');
            items.forEach(function(item) {
                // If "All" is selected, display every record
                if(selectedStatus === 'all') {
                    item.style.display = defaultDisplay;
                } else {
                    var itemStatus = (item.getAttribute('data-status') || "").toLowerCase().trim();
                    if(itemStatus === selectedStatus) {
                        item.style.display = defaultDisplay;
                    } else {
                        item.style.display = 'none';
                    }
                }
            });
        }
    }

    // Show/hide dropdown based on active tab and run filtering
    function updateDropdownVisibility(activeTabId) {
        var dropdownContainer = document.getElementById('statusDropdownContainer');
        if(activeTabId === 'profile' || activeTabId === 'hiringHistory') {
            dropdownContainer.style.display = 'none';
        } else {
            dropdownContainer.style.display = 'flex';
            filterRecords(activeTabId);
        }
    }

    // Attach event listener for dropdown changes to filter based on the current active tab
    document.getElementById('statusFilter').addEventListener('change', function() {
        filterRecords(currentActiveTabId);
    });

    document.addEventListener('DOMContentLoaded', function() {
        updateDropdownVisibility('profile'); // default active tab is 'profile'
    });
</script>
</x-app-layout>