@php
    $dep_count = 0;
    $count = 0;
@endphp

<x-app-layout>
    <div class="min-h-screen">
        <div class="container">
            <div class="profile-card">
                <!-- Account Information -->
                <div class="account-info">
                    <div class="account-info-box">
                        <div class="account-info-box-left">
                            <div class="account-image">
                                @if($data->profile_picture)
                                    <img class="acc-img" src="{{ asset('storage/profile_pictures/' . $data->profile_picture) }}" alt="User Image" />
                                @else
                                    <img class="acc-img" src="{{ asset('images/blankdp.jpg') }}" alt="User Image" />
                                @endif
                            </div>
                            <div class="account-details">
                                <h1 id="empid">{{ Auth::user()->id }}</h1>
                                <h3 id="role">{{ Auth::user()->role }}</h3>
                            </div>
                        </div>
                        <div class="account-info-box-right">
                            <img class="hau-banner" src="{{ asset('images/hau-logo.png') }}" alt="HAU Logo">
                        </div>
                    </div>
                </div>

                @if(session('success'))
                    <div id="successMessage">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Personal Data Section -->
                <div class="section personal-data">
                    <div class="section-box">
                        <div class="box-title">
                            <h1>Personal Data</h1>
                            <span>
                                Last Updated: {{ explode(' ', $data->updated_at)[0] . ' | ' . explode(' ', $data->updated_at)[1] }}
                            </span>
                            <a class="edit-btn" href="{{ route('portal.profile-edit-pd') }}">Edit</a>
                            <div class="section-box-button">
                                <h3 class="dp_button personal">▼</h3>
                            </div>
                        </div>

                        <div class="personal-information">
                            <!-- Row 1 -->
                            <div class="box-row">
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

                            <!-- Row 2 -->
                            <div class="box-row">
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

                            <div class="line-break"><hr></div>

                            <!-- Row 3 -->
                            <div class="box-row">
                                <div class="box-row-item" style="width: 350px;">
                                    <h3>Email Address</h3>
                                    <h1>{{ Auth::user()->email ?? 'n/a' }}</h1>
                                </div>
                                <div class="box-row-item" style="width: 150px;">
                                    <h3>Role</h3>
                                    <h1>{{ Auth::user()->role ?? 'n/a' }}</h1>
                                </div>
                                <div class="box-row-item" style="width: 150px;">
                                    <h3>Status</h3>
                                    <h2 class="status">{{ $data->info_status ?? 'n/a' }}</h2>
                                </div>
                            </div>
                        </div>

                        <br>

                        <!-- Contact Information Section -->
                        <div class="contact-information">
                            <div class="box-title">
                                <h1>Contact Information</h1>
                                <a class="edit-btn" href="{{ route('portal.profile-edit-ci') }}">Edit</a>
                            </div>
                            <h1 class="subtitle">Present Address</h1>
                            <!-- Row 1 -->
                            <div class="box-row">
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

                            <!-- Row 2 -->
                            <div class="box-row">
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
                <!-- End of Personal Data Section -->

                <div class="section provincial-contact">
                    <div class="section-box">
                        <div class="box-title">
                            <h1>Provincial Contact</h1>
                            <a class="edit-btn" href="{{ route('portal.profile-edit-pc') }}">Edit</a>
                            @if($data->provincial_contact != null)
                                <span>Last Updated: {{ $data->provincial_contact->updated_at->format('Y-m-d H:i:s') }}</span>
                            @endif
                            <div class="section-box-button">
                                <h3 class="dp_button provincial">▼</h3>
                            </div>
                        </div>
                        <h1 class="subtitle" style="margin-top: 1rem">Provincial Address</h1>
                        <div class="box-row">
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

                        <div class="line-break"><hr></div>

                        <div class="box-row">
                            <div class="box-row-item" style="width: 200px">
                                <h3>Provincial Phone Number</h3>
                                <h1>{{ $data->provincial_contact ? $data->provincial_contact->pc_phone : 'n/a' }}</h1>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section emergency-box">
                    <div class="section-box">
                        <div class="box-title">
                            <h1>In-case of Emergency</h1>
                            <a class="edit-btn" href="{{ route('portal.profile-edit-ei') }}">Edit</a>
                            <span>
                                Last Updated:
                                @if($data->emergency_contact && $data->emergency_contact->updated_at)
                                    {{ $data->emergency_contact->updated_at->format('Y-m-d H:i:s') }}
                                @else
                                    n/a
                                @endif
                            </span>
                            <div class="section-box-button">
                                <h3 class="dp_button emergency">▼</h3>
                            </div>
                        </div>
                        <h1 class="subtitle" style="margin-top: 1rem">Contact Person</h1>
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

                <!-- Accounting Data Section -->
                <div class="section accounting-data">
                    <div class="section-box">
                        <div class="box-title">
                            <h1>Accounting Data</h1>
                            <a class="edit-btn" href="{{ route('portal.profile-edit-ad') }}">Edit</a>
                            <span>
                                Last Updated:
                                @if($data->accounting_details && $data->accounting_details->updated_at)
                                    {{ $data->accounting_details->updated_at->format('Y-m-d H:i:s') }}
                                @else
                                    n/a
                                @endif
                            </span>
                            <div class="section-box-button">
                                <h3 class="dp_button accounting">▼</h3>
                            </div>
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

                <!-- Dependents Section -->
                <div class="section dependents-box">
                    <div class="section-box">
                        <div class="box-title">
                            <h1>List of Dependents</h1>
                            <a class="edit-btn" href="{{ route('portal.dependencies') }}">
                                <button>Manage</button>
                            </a>
                            <div class="section-box-button">
                                <h3 class="dp_button dependents">▼</h3>
                            </div>
                        </div>

                        <div class="table dep">
                            <div class="tbl-header">
                                <div class="tbl-col"><h1>Name</h1></div>
                                <div class="tbl-col"><h1>Date of Birth</h1></div>
                                <div class="tbl-col"><h1>Relationship</h1></div>
                            </div>

                            @if($data->dependencies->count() == 0)
                                <div class="w-full flex items-center justify-center text-sm text-gray-400 pt-4 pb-12">
                                    <span class="italic">No user data.</span>
                                </div>
                            @else
                                @foreach($data->dependencies as $item)
                                    @if($dep_count % 2 != 0)
                                        <div class="tbl-row stripe">
                                            <div class="tbl-col"><h1>{{ $item->fname . ' ' . $item->mname . ' ' . $item->lname }}</h1></div>
                                            <div class="tbl-col"><h1>{{ $item->date_of_birth }}</h1></div>
                                            <div class="tbl-col"><h1>{{ $item->relationship }}</h1></div>
                                        </div>
                                    @else
                                        <div class="tbl-row">
                                            <div class="tbl-col"><h1>{{ $item->fname . ' ' . $item->mname . ' ' . $item->lname }}</h1></div>
                                            <div class="tbl-col"><h1>{{ $item->date_of_birth }}</h1></div>
                                            <div class="tbl-col"><h1>{{ $item->relationship }}</h1></div>
                                        </div>
                                    @endif
                                    @php $dep_count++; @endphp
                                    @if($dep_count == 4)
                                        @break
                                    @endif
                                @endforeach
                                <div class="tbl-row empty">
                                    @if($data->dependencies->count() > 4)
                                        <span>{{ $data->dependencies->count() - 4 }} more...</span>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Hiring History Section -->
                <div class="section hiring-history">
                    <div class="section-box">
                        <div class="box-title">
                            <h1>Hiring Information</h1>
                            <div class="section-box-button">
                                <h3 class="dp_button hiring">▼</h3>
                            </div>
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
                            <div class="box-row-item" style="width: 300px">
                                <h3>Tenure</h3>
                                <h1>
                                    {{ $data->hiring->emp_tenure ?? 'n/a' }}
                                    @if($data->hiring && $data->hiring->emp_tenure === 'NON-TENURED')
                                        - {{ $data->hiring->non_tenured }}
                                    @endif
                                </h1>
                            </div>
                            <div class="box-row-item" style="width: 300px">
                                <h3>Division</h3>
                                <h1>{{ $data->hiring->division ?? 'n/a' }}</h1>
                            </div>
                        </div>
                        <div class="box-row">
                            <a href="{{ route('portal.hiring') }}" class="bg-red-900 text-white px-4 rounded-xl py-1 hover:bg-red-800">
                                View All Hiring History
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .container {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 2rem 0;
    }

    .profile-card {
        width: 90%;
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

    .account-info-box-left {
        display: grid;
        grid-template-columns: 30% 70%;
    }

    .account-image, .account-details {
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
        opacity: 0.5;
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

    .h-clicked {
        cursor: default;
        height: 250px;
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

    span {
        font-size: 0.8rem;
        opacity: 0.5;
        margin: 0 1rem;
    }

    .section-box-button {
        height: 80px;
        width: 10%;
        position: absolute;
        right: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 5;
    }

    .edit-btn {
        position: absolute;
        right: 8%;
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

    /* Table Template */
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

    .dep .tbl-header, .dep .tbl-row {
        grid-template-columns: 50% 20% 30%;
    }
</style>

<script>
    // Dropdown Toggles for Sections
    var personal_data_box = document.querySelector(".personal-data");
    var personal_data_button = document.querySelector(".personal");

    var provincial_contact_box = document.querySelector('.provincial-contact');
    var provincial_contact_button = document.querySelector('.provincial');

    var emergency_box = document.querySelector(".emergency-box");
    var emergency_button = document.querySelector(".emergency");

    var accounting_data_box = document.querySelector(".accounting-data");
    var accounting_data_button = document.querySelector(".accounting");

    var dependents_box = document.querySelector('.dependents-box');
    var dependents_button = document.querySelector('.dependents');

    var hiring_box = document.querySelector('.hiring-history');
    var hiring_button = document.querySelector('.hiring');

    dependents_button.addEventListener("click", () => {
        if (dependents_box.classList.contains('dep-clicked')) {
            dependents_box.classList.remove('dep-clicked');
            dependents_button.innerHTML = '▼';
        } else {
            dependents_box.classList.add('dep-clicked');
            dependents_button.innerHTML = '▲';
        }
    });

    // Personal Data Toggle
    personal_data_button.addEventListener('click', () => {
        if (personal_data_box.classList.contains('pd-clicked')) {
            personal_data_box.classList.remove('pd-clicked');
            personal_data_button.innerHTML = '▼';
        } else {
            personal_data_box.classList.add('pd-clicked');
            personal_data_button.innerHTML = '▲';
        }
    });

    // Provincial Contact Toggle
    provincial_contact_button.addEventListener('click', () => {
        if (provincial_contact_box.classList.contains('pc-clicked')) {
            provincial_contact_box.classList.remove('pc-clicked');
            provincial_contact_button.innerHTML = '▼';
        } else {
            provincial_contact_box.classList.add('pc-clicked');
            provincial_contact_button.innerHTML = '▲';
        }
    });

    // Emergency Toggle
    emergency_button.addEventListener('click', () => {
        if (emergency_box.classList.contains('emergency-clicked')) {
            emergency_box.classList.remove('emergency-clicked');
            emergency_button.innerHTML = '▼';
        } else {
            emergency_box.classList.add('emergency-clicked');
            emergency_button.innerHTML = '▲';
        }
    });

    // Accounting Data Toggle
    accounting_data_button.addEventListener('click', () => {
        if (accounting_data_box.classList.contains('ad-clicked')) {
            accounting_data_box.classList.remove('ad-clicked');
            accounting_data_button.innerHTML = '▼';
        } else {
            accounting_data_box.classList.add('ad-clicked');
            accounting_data_button.innerHTML = '▲';
        }
    });

    // Hiring Toggle
    hiring_button.addEventListener('click', () => {
        if (hiring_box.classList.contains('h-clicked')) {
            hiring_box.classList.remove('h-clicked');
            hiring_button.innerHTML = '▼';
        } else {
            hiring_box.classList.add('h-clicked');
            hiring_button.innerHTML = '▲';
        }
    });

    // Set status text colors
    var all_status = document.querySelectorAll(".status");
    for (let i = 0; i < all_status.length; i++) {
        if (all_status[i].innerHTML === 'Approved' || all_status[i].innerHTML === 'Active') {
            all_status[i].classList.add('approved');
        } else if (all_status[i].innerHTML === 'Pending') {
            all_status[i].classList.add('pending');
        }
    }

    // Show success message for 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const successMessage = document.getElementById('successMessage');
        if (successMessage) {
            successMessage.style.display = 'block';
            setTimeout(function() {
                successMessage.style.display = 'none';
            }, 5000);
        }
    });
</script>
