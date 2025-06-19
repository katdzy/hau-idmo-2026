<!-- resources/views/admin/records/users/profile/view-item.blade.php -->
<x-app-layout>
    <div class="container mx-auto flex justify-center py-8">
        <div class="box-card w-[90%] bg-white rounded-lg shadow-lg p-8">

        <div class="flex items-center mb-4">
                <!-- Back Button -->
                @if($user)
                    <a href="{{ route('admin.users.view', ['id' => $user->emp_id]) }}"
                    class="w-[15%] rounded-lg flex items-center justify-center py-2 bg-red-900 text-white font-bold gap-1 hover:bg-red-700">
                        <img src="{{ asset('images/icons/back.png') }}" class="w-4 h-4 mr-2">
                        <span>Back</span>
                    </a>
                @else
                    <!-- Fallback -->
                    <a href="{{ route('admin.users') }}"
                    class="w-[15%] rounded-lg flex items-center justify-center py-2 bg-red-900 text-white font-bold gap-1 hover:bg-red-700">
                        <img src="{{ asset('images/icons/back.png') }}" class="w-4 h-4 mr-2">
                        <span>Back</span>
                    </a>
                @endif

                <!-- Grouped buttons on the right -->
                <div class="ml-auto flex gap-2">
                    @if($item->status == "Pending")
                        <form action="{{route('admin.users.toreview', $item->id)}}" method="POST">
                            @csrf
                            <button type="submit" class="bg-[#ff0000] hover:bg-[#ff0000] text-white px-8 py-1 rounded-[25px] flex gap-2 items-center justify-center">
                                <img src="{{asset('images/icons/deny.png')}}" class="w-[20px] h-[20px]" alt="">
                                <span>To-review</span>
                            </button>
                        </form>
                        <form action="{{ route('admin.users.approve', $item->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-[#008000] hover:bg-[#008000] text-white px-8 py-1 rounded-[25px] flex gap-2 items-center justify-center">
                                    <img src="{{ asset('images/icons/approve.png') }}" class="w-[20px] h-[20px]" alt="">
                                    <span>Approve</span>
                            </button>
                        </form>
                    @elseif($item->status == "To-review")
                        <form action="{{ route('admin.users.approve', $item->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-[#008000] hover:bg-[#008000] text-white px-8 py-1 rounded-[25px] flex gap-2 items-center justify-center">
                                    <img src="{{ asset('images/icons/approve.png') }}" class="w-[20px] h-[20px]" alt="">
                                    <span>Approve</span>
                            </button>
                        </form>
                    @endif
                </div>
            </div>


            <!-- Use instanceof checks to handle each item type -->
            @if($item instanceof \App\Models\certifications)
                {{-- ================== CERTIFICATION ================== --}}
                <div class="w-full flex items-center justify-start gap-1">
                    <img src="{{ asset('images/hau-logo.png') }}" class="w-[40px] h-[40px] my-4" alt="">
                    <h1 class="font-bold text-gray-600 text-[1.5rem]">Certification Details</h1>
                </div>
                <div class="mb-6">
                    <span class="text-gray-500 text-sm">Certification Title</span>
                    <h1 class="text-2xl font-bold text-gray-800">{{ $item->cert_title }}</h1>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                    <div>
                        <span class="text-gray-500 text-sm">Certification Type</span>
                        <h1 class="text-lg font-semibold text-gray-800">{{ $item->cert_type }}</h1>
                    </div>
                    <div>
                        <span class="text-gray-500 text-sm">Role</span>
                        <h1 class="text-lg font-semibold text-gray-800">{{ $item->role }}</h1>
                    </div>
                    <div>
                        <span class="text-gray-500 text-sm">Date Issued</span>
                        <h1 class="text-lg font-semibold text-gray-800">{{ $item->date_issued }}</h1>
                    </div>
                    <div>
                        <span class="text-gray-500 text-sm">Validity</span>
                        <h1 class="text-lg font-semibold text-gray-800">{{ $item->cert_validity }}</h1>
                    </div>
                    <div>
                        <span class="text-gray-500 text-sm">Duration</span>
                        <h1 class="text-lg font-semibold text-gray-800">{{ $item->duration }}</h1>
                    </div>
                </div>
                <div class="mb-6">
                    <span class="text-gray-500 text-sm mb-2 block">Attachment</span>
                    <div class="flex items-center mb-2">
                        <img src="{{ asset('images/icons/attachment.png') }}" class="w-5 h-5 mr-2">
                        <a href="{{ asset('storage/' . $item->file_path) }}" class="text-blue-600 underline" download>{{ $item->attachment }}</a>
                    </div>
                </div>
                <div>
                    <iframe src="{{ asset('storage/' . $item->file_path) }}" class="w-full h-96 border-0"></iframe>
                </div>

            @elseif($item instanceof \App\Models\Trainings)
                {{-- ================== TRAINING ================== --}}
                <div class="w-full flex items-center justify-start gap-1">
                    <img src="{{ asset('images/hau-logo.png') }}" class="w-[40px] h-[40px] my-4" alt="">
                    <h1 class="font-bold text-gray-600 text-[1.5rem]">Training Details</h1>
                </div>
                <div class="w-full flex flex-col gap-2">
                    <div class="w-full flex flex-col leading-tight">
                        <span class=" text-gray-400">Training</span>
                        <h1 class="text-lg font-bold text-gray-700">{{ $item->title }}</h1>
                    </div>
                    <div class="w-2/3 grid grid-cols-3 gap-2">
                        <div class="flex flex-col leading-tight">
                            <span class=" text-gray-400"> Training Type</span>
                            <h1 class="text-lg font-bold text-gray-700">{{ $item->type }}</h1>
                        </div>
                        <div class="flex flex-col leading-tight">
                            <span class=" text-gray-400">Conducted by</span>
                            <h1 class="text-lg font-bold text-gray-700">{{ $item->organization }}</h1>
                        </div>
                        <div class="flex flex-col leading-tight">
                            <span class=" text-gray-400">Skills Acquired </span>
                            <h1 class="text-lg font-bold text-gray-700">{{ $item->skills }}</h1>
                        </div>
                    </div>
                    <div class="w-2/3 grid grid-cols-3 gap-2">
                        <div class="w-full flex flex-col leading-tight">
                            <span class=" text-gray-400">Date of Start</span>
                            <h1 class="text-lg font-bold text-gray-700">{{ $item->start_date }}</h1>
                        </div>
                        <div class="flex flex-col leading-tight">
                            <span class=" text-gray-400">Date of Completion</span>
                            <h1 class="text-lg font-bold text-gray-700">{{ $item->end_date }}</h1>
                        </div>
                        <div class="flex flex-col leading-tight">
                            <span class=" text-gray-400">Total Hours </span>
                            <h1 class="text-lg font-bold text-gray-700">{{ $item->hours }}</h1>
                        </div>
                    </div>
                    <span class="mt-4 text-gray-400">
                        Proof of Completion
                    </span>
                    <div>
                        <iframe src="{{ asset('storage/trainings/' . $item->emp_id . '/' . $item->id . '.' . explode('.', $item->attachment)[1]) }}"
                                class="w-full h-96 border-0"></iframe>
                    </div>
                </div>

            @elseif($item instanceof \App\Models\Licenses)
                {{-- ================== LICENSE ================== --}}
                <div class="w-full flex items-center justify-start gap-2">
                    <img src="{{ asset('images/hau-logo.png') }}" class="w-[40px] h-[40px] my-4" alt="">
                    <h1 class="font-bold text-gray-600 text-[1.5rem]">License Details</h1>
                </div>
                <div class="w-full flex flex-col gap-2">
                    <div class="w-2/3 grid grid-cols-2 gap-2">
                        <div class="flex flex-col leading-tight">
                            <span class="text-gray-400">License</span>
                            <h1 class="text-lg font-bold text-gray-700">{{ $item->title }}</h1>
                        </div>
                        <div class="flex flex-col leading-tight">
                            <span class="text-gray-400">License Type</span>
                            <h1 class="text-lg font-bold text-gray-700">{{ $item->type }}</h1>
                        </div>
                    </div>
                    <div class="w-full grid grid-cols-3 gap-2">
                        <div class="w-full flex flex-col leading-tight">
                            <span class="text-gray-400">Date Obtained</span>
                            <h1 class="text-lg font-bold text-gray-700">{{ $item->date_obtained }}</h1>
                        </div>
                    </div>
                    <div>
                        <iframe src="{{ asset('storage/licenses/' . $item->emp_id . '/' . $item->id . '.' . explode('.', $item->attachment)[1]) }}"
                                class="w-full h-96 border-0"></iframe>
                    </div>
                </div>

            @elseif($item instanceof \App\Models\Education)
                {{-- ================== EDUCATION ================== --}}
                <div class="w-full flex items-center justify-start gap-1">
                    <img src="{{ asset('images/hau-logo.png') }}" class="w-[40px] h-[40px] my-4" alt="">
                    <h1 class="font-bold text-gray-600 text-[1.5rem]">Educational Background Details</h1>
                </div>
                <div class="w-full flex flex-col gap-2">
                    <div class="w-full flex flex-col leading-tight">
                        <span class=" text-gray-400">School Name</span>
                        <h1 class="text-lg font-bold text-gray-700">{{ $item->school_name }}</h1>
                    </div>
                    <div class="w-full grid grid-cols-3 gap-2">
                        <div class="flex flex-col leading-tight">
                            <span class=" text-gray-400">Period of Schooling</span>
                            <h1 class="text-lg font-bold text-gray-700">{{ $item->start_date }} to {{ $item->end_date }}</h1>
                        </div>
                        <div class="flex flex-col leading-tight">
                            <span class=" text-gray-400">Education Type</span>
                            <h1 class="text-lg font-bold text-gray-700">{{ $item->education_type }}</h1>
                        </div>
                        <div class="w-full flex flex-col leading-tight">
                            <span class=" text-gray-400">School Address</span>
                            <h1 class="text-lg font-bold text-gray-700">{{ $item->school_address }}</h1>
                        </div>
                    </div>
                    <div class="w-full grid grid-cols-3 gap-2">
                        <div class="flex flex-col leading-tight">
                            <span class=" text-gray-400">Awards/Honors</span>
                            <h1 class="text-lg font-bold text-gray-700">{{ $item->awards }}</h1>
                        </div>
                        <div class="flex flex-col leading-tight">
                            <span class=" text-gray-400">Graduation Date</span>
                            <h1 class="text-lg font-bold text-gray-700">{{ $item->grad_date }}</h1>
                        </div>
                        <div class="w-full flex flex-col leading-tight">
                            <span class=" text-gray-400">Last Semester Attended</span>
                            <h1 class="text-lg font-bold text-gray-700">{{ $item->last_sem }}</h1>
                        </div>
                    </div>
                    <div class="w-full grid grid-cols-3 gap-2">
                        <div class="flex flex-col leading-tight">
                            <span class=" text-gray-400">SO No. of Transcript</span>
                            <h1 class="text-lg font-bold text-gray-700">{{ $item->so_num }}</h1>
                        </div>
                        <div class="flex flex-col leading-tight">
                            <span class=" text-gray-400">Level/Attainment</span>
                            <h1 class="text-lg font-bold text-gray-700">{{ $item->level }}</h1>
                        </div>
                        <div class="w-full flex flex-col leading-tight">
                            <span class=" text-gray-400">Course, Program, or Degree</span>
                            <h1 class="text-lg font-bold text-gray-700">{{ $item->degree }}</h1>
                        </div>
                    </div>
                    <div class="w-full grid grid-cols-3 gap-2">
                        <div class="flex flex-col leading-tight">
                            <span class=" text-gray-400">Attachment</span>
                            <h1 class="text-lg font-bold text-gray-700 truncate">{{ $item->attachment }}</h1>
                        </div>
                        <div class="flex flex-col leading-tight">
                            <span class=" text-gray-400">Status </span>
                            <h1 class="text-lg font-bold text-gray-700">{{ $item->status }}</h1>
                        </div>
                    </div>
                    <span class="mt-4 text-gray-400">
                        Transcript of Records
                    </span>
                    @php
                        $file = $item->id . '.' . explode('.', $item->attachment)[1];
                    @endphp
                    <iframe src="{{ asset('storage/edu-bg/' . $item->emp_id . '/' . $file) }}"
                            class="w-full h-96 border-0"></iframe>
                </div>
            @elseif($item instanceof \App\Models\Employment)
                {{-- ================== EMPLOYMENT ================== --}}
                <div class="w-full flex items-center justify-start gap-1">
                    <img src="{{ asset('images/hau-logo.png') }}" class="w-[40px] h-[40px] my-4" alt="">
                    <h1 class="font-bold text-gray-600 text-[1.5rem]">Employment Details</h1>
                </div>
                <div class="w-full flex flex-col gap-2">
                    <div class="w-full flex flex-col leading-tight">
                        <span class=" text-gray-400">Company</span>
                        <h1 class="text-lg font-bold text-gray-700">{{ $item->company }}</h1>
                    </div>
                    <div class="w-full grid grid-cols-3 gap-2">
                        <div class="flex flex-col leading-tight">
                            <span class=" text-gray-400">Date Hired</span>
                            <h1 class="text-lg font-bold text-gray-700">{{ $item->date_hired }}</h1>
                        </div>
                        <div class="flex flex-col leading-tight">
                            <span class=" text-gray-400">Date Resigned</span>
                            <h1 class="text-lg font-bold text-gray-700">{{ $item->date_resigned }}</h1>
                        </div>
                    </div>
                    <div class="w-full grid grid-cols-3 gap-2">
                        <div class="w-full flex flex-col leading-tight">
                            <span class=" text-gray-400">Position</span>
                            <h1 class="text-lg font-bold text-gray-700">{{ $item->position }}</h1>
                        </div>
                        <div class="w-full flex flex-col leading-tight">
                            <span class=" text-gray-400">Reason for Exit</span>
                            <h1 class="text-lg font-bold text-gray-700">{{ $item->reason }}</h1>
                        </div>
                    </div>
                    <span class="mt-4 text-gray-400">
                        Proof of Employment
                    </span>
                    <div>
                        @php
                            $file = $item->id . '.' . explode('.', $item->attachment)[1];
                        @endphp
                        <iframe src="{{ asset('storage/employment/' . $item->emp_id . '/' . $file) }}"
                                class="w-full h-96 border-0"></iframe>
                    </div>
                </div>
            @elseif($item instanceof \App\Models\Research)
                {{-- ================== RESEARCH ================== --}}
                <div class="box-title">
                    <h1>{{ $item->title }}</h1> 
                </div>
                <div class="box-body">
                    <div class="box-row">
                        <span>Description</span>
                        <h1>{{ $item->description }}</h1>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <span>Author</span>
                            <h1>{{ $user->emp_fname }} {{ $user->emp_mname }} {{ $user->emp_lname }}</h1> 
                        </div>
                    </div>
                    @foreach ($coauthors as $coauthor)
                    <div class="w-2/3 grid grid-cols-2 gap-2">
                        <div class="form-col">
                            <span>Co-author</span>
                            <h1>{{ $coauthor->coauthor_name }}</h1>
                        </div>
                        <div class="form-col">
                            <span>Participation (%)</span>
                            <h1>{{ $coauthor->coauthor_participation }}</h1>
                        </div>
                    </div>
                    @endforeach
                    <div class="form-row mt-4">
                        <span>Attachment</span>
                        <div class="file-attachment">
                            <img src="{{ asset('images/icons/attachment.png') }}"/> 
                            <a href="{{ asset('storage/' . $item->file_path) }}" download>{{ $item->attachment }}</a>
                        </div>
                    </div>
                    <div>
                        @php
                            $ext = explode('.', $item->attachment)[1];
                        @endphp
                        <iframe src="{{ asset('storage/respub/' . $item->emp_id . '/' . $item->id . '.' . $ext) }}"
                                class="w-full h-96 border-0"></iframe>
                    </div>
                </div>
            @elseif($item instanceof \App\Models\Publication)
                {{-- ================== PUBLICATION ================== --}}
                <div class="box-title">
                    <h1>{{ $item->title }}</h1> 
                </div>
                <div class="box-body">
                    <div class="box-row">
                        <span>Description</span>
                        <h1>{{ $item->description }}</h1>
                    </div>
                    <div class="form-row grid">
                        <div class="form-col">
                            <span>Author</span>
                            <h1>{{ $user->emp_fname }} {{ $user->emp_mname }} {{ $user->emp_lname }}</h1> 
                        </div>
                    </div>
                    @foreach($coauthors as $coauthor)
                    <div class="w-2/3 grid grid-cols-2 gap-2">
                        <div class="form-col">
                            <span>Co-author</span>
                            <h1>{{ $coauthor->coauthor_name }}</h1>
                        </div>
                        <div class="form-col">
                            <span>Participation (%)</span>
                            <h1>{{ $coauthor->coauthor_participation }}</h1>
                        </div>
                    </div>
                    @endforeach
                    <div class="w-2/3 grid grid-cols-2 gap-2">
                        <div class="form-col">
                            <span>Type of Journal</span>
                            <h1>{{ $item->journal_type }}</h1>
                        </div>
                        <div class="form-col">
                            <span>Date Published</span>
                            <h1>{{ $item->date_published }}</h1>
                        </div>
                    </div>
                    <div class="form-row mt-2">
                        <span>Attachment</span>
                        <div class="file-attachment">
                            <img src="{{ asset('images/icons/attachment.png') }}"/> 
                            <a href="{{ asset('storage/' . $item->file_path) }}" download>{{ $item->attachment }}</a>
                        </div>
                    </div>
                    <div>
                        @php
                            $ext = explode('.', $item->attachment)[1];
                        @endphp
                        <iframe src="{{ asset('storage/respub/' . $item->emp_id . '/' . $item->id . '.' . $ext) }}"
                                class="w-full h-96 border-0"></iframe>
                    </div>
                </div>
            @elseif($item instanceof \App\Models\orgs)
                {{-- ================== ORGANIZATION ================== --}}
                <div class="w-full flex items-center justify-start gap-1">
                    <img src="{{ asset('images/hau-logo.png') }}" class="w-[40px] h-[40px] my-4" alt="">
                    <h1 class="font-bold text-gray-600 text-[1.5rem]">Organization Details</h1>
                </div>
                <div class="w-full flex flex-col gap-2">
                    <div class="w-full flex flex-col leading-tight">
                        <span class=" text-gray-400">Organization</span>
                        <h1 class="text-lg font-bold text-gray-700">{{ $item->org }}</h1>
                    </div>
                    <div class="w-full grid grid-cols-3 gap-2">
                        <div class="w-full flex flex-col leading-tight">
                            <span class=" text-gray-400">Position</span>
                            <h1 class="text-lg font-bold text-gray-700">{{ $item->position }}</h1>
                        </div>
                        <div class="flex flex-col leading-tight">
                            <span class=" text-gray-400">Date Joined</span>
                            <h1 class="text-lg font-bold text-gray-700">{{ $item->date_joined }}</h1>
                        </div>
                    </div>
                    <span class="mt-4 text-gray-400">
                        Proof of Membership
                    </span>
                    <div>
                        @php
                            $file = $item->id . '.' . explode('.', $item->attachment)[1];
                        @endphp
                        <iframe src="{{ asset('storage/orgs/' . $item->emp_id . '/' . $file) }}"
                                class="w-full h-96 border-0"></iframe>
                    </div>
                </div>
            @elseif($item instanceof \App\Models\dependencies)
                {{-- ================== DEPENDENTS ================== --}}
                <div class="w-full flex items-center justify-start gap-1">
                    <img src="{{ asset('images/hau-logo.png') }}" class="w-[40px] h-[40px] my-4" alt="">
                    <h1 class="font-bold text-gray-600 text-[1.5rem]">Dependent Details</h1>
                </div>
                <div class="w-full flex flex-col gap-2">
                    <div class="w-full flex flex-col leading-tight">
                        <span class=" text-gray-400">Dependent Name</span>
                        <h1 class="text-lg font-bold text-gray-700">{{ $item->fname . ' ' . $item->mname . ' ' . $item->lname }}</h1>
                    </div>
                    <div class="w-full grid grid-cols-3 gap-2">
                        <div class="w-full flex flex-col leading-tight">
                            <span class=" text-gray-400">Relationship</span>
                            <h1 class="text-lg font-bold text-gray-700">{{ $item->relationship }}</h1>
                        </div>
                        <div class="flex flex-col leading-tight">
                            <span class=" text-gray-400">Date of Birth</span>
                            <h1 class="text-lg font-bold text-gray-700">{{ $item->date_of_birth }}</h1>
                        </div>
                    </div>
                    <span class="mt-4 text-gray-400">
                        Birth Certificate
                    </span>
                    <div>
                        @php
                            $file = $item->id . '.' . explode('.', $item->attachment)[1];
                        @endphp
                        <iframe src="{{ asset('storage/dependents/' . $item->emp_id . '/' . $file) }}"
                                class="w-full h-96 border-0"></iframe>
                    </div>
                </div>
            @else
                <p class="text-red-500 font-bold">Unknown record type.</p>
            @endif
        </div>
    </div>
</x-app-layout>

<style>
    /* Title */
    .box-title {
        width: 100%;
        line-height: 1.7rem;
        display: flex;
        padding: 1rem 2rem;
    }
    .box-title h1 {
        font-size: 1.7rem;
        font-weight: 900;
        color: rgb(90,90,90);
        margin: 0;
    }
    /* Body Content */
    .box-body {
        width: 100%;
        display: flex;
        flex-direction: column;
        padding: 0 2rem;
    }
    .box-row {
        display: flex;
        flex-direction: column;
        width: 100%;
        line-height: 1.5rem;
        margin-bottom: 1rem;
    }
    .box-row span {
        color: rgb(150,150,150);
        font-size: 0.7rem;
    }
    .box-row h1, .form-col h1 {
        font-size: 1rem;
        font-weight: 700;
        color: rgb(40,40,40);
    }
    /* Grids */
    .form-col {
        padding: 0.5rem 0;
        display: flex;
        flex-direction: column;
    }
    .form-col span {
        margin-bottom: 0.5rem;
    }
    /* Attachment */
    .file-attachment {
        display: flex;
        align-items: center;
        margin-top: 0.5rem;
        overflow: hidden;
    }
    .file-attachment img {
        width: 20px;
        height: 20px;
        margin-right: 0.3rem;
    }
    .file-attachment a {
        color: darkblue;
        text-decoration: underline;
    }
    .file-attachment a:hover {
        color: blue;
    }
</style>
