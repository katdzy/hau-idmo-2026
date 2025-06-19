<x-app-layout>
    <div class="min-h-screen">
        <div class="w-full flex justify-center py-8">
            <div class="w-[95%] flex flex-col p-8 rounded-lg bg-white items-start">

                <!-- Header -->
                <div class="w-full flex justify-start">
                    <a href="{{ route('portal.filing.type') }}" class="flex justify-center items-center bg-gray-500 hover:bg-gray-400 text-white rounded-lg px-16 py-2 gap-2">
                        <img src="{{ asset('images/icons/upload.png') }}" class="w-[20px] h-[20px]" alt="Upload Icon">
                        <span class="font-bold">File an Application</span>
                    </a>
                </div>

                <span class="text-gray-500 text-sm py-2">
                    These requests are currently being processed and will be addressed promptly. Please check back later for updates or take action if necessary.
                </span>

                <hr class="opacity-90 w-full mt-8 mb-2">

                <!-- Navigation Buttons -->
                <div class="w-full flex flex-nowrap overflow-x-auto">
                    <button id="certifications_btn" class="hover:bg-gray-100 text-gray-400 font-semibold px-8 py-2 whitespace-nowrap active_link">
                        Certification
                    </button>
                    <button id="trainings_btn" class="hover:bg-gray-100 text-gray-400 font-semibold whitespace-nowrap px-8 py-2">
                        Training
                    </button>
                    <button id="licenses_btn" class="hover:bg-gray-100 text-gray-400 font-semibold whitespace-nowrap px-8 py-2">
                        License
                    </button>
                    <button id="educations_btn" class="hover:bg-gray-100 text-gray-400 font-semibold whitespace-nowrap px-8 py-2">
                        Educational Background
                    </button>
                    <button id="employments_btn" class="hover:bg-gray-100 text-gray-400 font-semibold whitespace-nowrap px-8 py-2">
                        Employment
                    </button>
                    <button id="respubs_btn" class="hover:bg-gray-100 text-gray-400 font-semibold whitespace-nowrap px-8 py-2">
                        Research and Publication
                    </button>
                    <button id="orgs_btn" class="hover:bg-gray-100 text-gray-400 font-semibold whitespace-nowrap px-8 py-2">
                        Organization
                    </button>
                    <button id="dependents_btn" class="hover:bg-gray-100 text-gray-400 font-semibold whitespace-nowrap px-8 py-2">
                        Dependents
                    </button>
                </div>

                <hr class="mb-2 opacity-90 w-full">

                <!-- Table for Certifications -->
                <div id="certifications" class="w-full flex flex-col gap-0">
                    @if($certifications->count() == 0)
                        <div class="w-full flex items-center justify-center text-sm text-gray-400 pt-8 pb-12">
                            <span class="italic">No user data.</span>
                        </div>
                    @else
                        <div class="w-full flex flex-col overflow-y-auto h-[300px]">
                            @foreach($certifications as $item)
                                <div class="w-full grid grid-cols-[85%_15%] hover:bg-gray-100 px-4 py-4 border-l-8 border-red-900 border-b-2 border-t-2">
                                    <div class="flex flex-col leading-tight">
                                        <h1 class="font-semibold text-gray-700">
                                            <strong>{{ $item->type }}</strong> - {{ $item->title }}
                                        </h1>
                                        <span class="italic text-sm text-gray-500">
                                            Date Submitted: {{ $item->date_submitted }}
                                        </span>
                                        <div class="flex items-start">
                                            <img src="{{ asset('images/icons/attachment.png') }}" class="w-[20px] h-[20px]" alt="Attachment Icon">
                                            <a title="{{ $item->attachment }}" class="hover:underline text-gray-600" 
                                               href="{{ asset('storage/' . $item->certifications->file_path) }}" target="_blank">
                                                {{ $item->certifications->attachment }}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('portal.certifications.view', ['id' => $item->id]) }}" 
                                           class="border bg-red-900 rounded-xl p-2 hover:bg-red-700" title="View Info">
                                            <img src="{{ asset('images/icons/eye.svg') }}" class="w-[20px] h-[20px]" alt="View Icon">
                                        </a>
                                        <form action="{{ route('portal.certifications.delete', ['id' => $item->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete(this)" 
                                                    class="border bg-red-900 rounded-xl p-2 hover:bg-red-700" title="Delete Item">
                                                <img src="{{ asset('images/icons/delete.png') }}" class="w-[20px] h-[20px]" alt="Delete Icon">
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Table for Trainings -->
                <div id="trainings" class="w-full flex flex-col gap-0 inactive_link">
                    @if($trainings->count() == 0)
                        <div class="w-full flex items-center justify-center text-sm text-gray-400 pt-8 pb-12">
                            <span class="italic">No user data.</span>
                        </div>
                    @else
                        <div class="w-full flex flex-col overflow-y-auto h-[300px]">
                            @foreach($trainings as $item)
                                <div class="w-full grid grid-cols-[85%_15%] hover:bg-gray-100 px-4 py-4 border-l-8 border-red-900 border-b-2 border-t-2">
                                    <div class="flex flex-col leading-tight">
                                        <h1 class="font-semibold text-gray-700">
                                            <strong>{{ $item->type }}</strong> - {{ $item->title }}
                                        </h1>
                                        <span class="italic text-sm text-gray-500">
                                            Date Submitted: {{ $item->date_submitted }}
                                        </span>
                                        <div class="flex items-start">
                                            <img src="{{ asset('images/icons/attachment.png') }}" class="w-[20px] h-[20px]" alt="Attachment Icon">
                                            <a title="{{ $item->attachment }}" class="hover:underline text-gray-600" 
                                               href="{{ asset('storage/trainings/' . Auth::user()->id . '/' . $item->id . '.' . explode('.', $item->training->attachment)[1]) }}" target="_blank">
                                                {{ $item->training->attachment }}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('portal.training.view', ['id' => $item->id]) }}" 
                                           class="border bg-red-900 rounded-xl p-2 hover:bg-red-700" title="View Info">
                                            <img src="{{ asset('images/icons/eye.svg') }}" class="w-[20px] h-[20px]" alt="View Icon">
                                        </a>
                                        <form action="{{ route('portal.training.delete', ['id' => $item->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete(this)" 
                                                    class="border bg-red-900 rounded-xl p-2 hover:bg-red-700" title="Delete Item">
                                                <img src="{{ asset('images/icons/delete.png') }}" class="w-[20px] h-[20px]" alt="Delete Icon">
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Table for Licenses -->
                <div id="licenses" class="w-full flex flex-col gap-0 inactive_link">
                    @if($licenses->count() == 0)
                        <div class="w-full flex items-center justify-center text-sm text-gray-400 pt-8 pb-12">
                            <span class="italic">No user data.</span>
                        </div>
                    @else
                        <div class="w-full flex flex-col overflow-y-auto h-[300px]">
                            @foreach($licenses as $item)
                                <div class="w-full grid grid-cols-[85%_15%] hover:bg-gray-100 px-4 py-4 border-l-8 border-red-900 border-b-2 border-t-2">
                                    <div class="flex flex-col leading-tight">
                                        <h1 class="font-semibold text-gray-700">
                                            <strong>{{ $item->type }}</strong> - {{ $item->title }}
                                        </h1>
                                        <span class="italic text-sm text-gray-500">
                                            Date Submitted: {{ $item->date_submitted }}
                                        </span>
                                        <div class="flex items-start">
                                            <img src="{{ asset('images/icons/attachment.png') }}" class="w-[20px] h-[20px]" alt="Attachment Icon">
                                            <a title="{{ $item->attachment }}" class="hover:underline text-gray-600" 
                                               href="{{ asset('storage/' . $item->license->file_path) }}" target="_blank">
                                                {{ $item->license->attachment }}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('portal.license.view', ['id' => $item->id]) }}" 
                                           class="border bg-red-900 rounded-xl p-2 hover:bg-red-700" title="View Info">
                                            <img src="{{ asset('images/icons/eye.svg') }}" class="w-[20px] h-[20px]" alt="View Icon">
                                        </a>
                                        <form action="{{ route('portal.license.delete', ['id' => $item->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete(this)" 
                                                    class="border bg-red-900 rounded-xl p-2 hover:bg-red-700" title="Delete Item">
                                                <img src="{{ asset('images/icons/delete.png') }}" class="w-[20px] h-[20px]" alt="Delete Icon">
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Table for Educational Background -->
                <div id="educations" class="w-full flex flex-col gap-0 inactive_link">
                    @if($educations->count() == 0)
                        <div class="w-full flex items-center justify-center text-sm text-gray-400 pt-8 pb-12">
                            <span class="italic">No user data.</span>
                        </div>
                    @else
                        <div class="w-full flex flex-col overflow-y-auto h-[300px]">
                            @foreach($educations as $item)
                                <div class="w-full grid grid-cols-[85%_15%] hover:bg-gray-100 px-4 py-4 border-l-8 border-red-900 border-b-2 border-t-2">
                                    <div class="flex flex-col leading-tight">
                                        <h1 class="font-semibold text-gray-700">
                                            <strong>{{ $item->type }}</strong> - {{ $item->title }}
                                        </h1>
                                        <span class="italic text-sm text-gray-500">
                                            Date Submitted: {{ $item->date_submitted }}
                                        </span>
                                        <div class="flex items-start">
                                            <img src="{{ asset('images/icons/attachment.png') }}" class="w-[20px] h-[20px]" alt="Attachment Icon">
                                            <a title="{{ $item->education->attachment }}" class="hover:underline text-gray-600" 
                                               href="{{ asset('storage/edu-bg/' . Auth::user()->id . '/' . $item->id . '.' . explode('.', $item->education->attachment)[0]) }}" target="_blank">
                                                {{ $item->education->attachment }}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('portal.edu-bg.view', ['id' => $item->id]) }}" 
                                           class="border bg-red-900 rounded-xl p-2 hover:bg-red-700" title="View Info">
                                            <img src="{{ asset('images/icons/eye.svg') }}" class="w-[20px] h-[20px]" alt="View Icon">
                                        </a>
                                        <form action="{{ route('portal.edu-bg.delete', ['id' => $item->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete(this)" 
                                                    class="border bg-red-900 rounded-xl p-2 hover:bg-red-700" title="Delete Item">
                                                <img src="{{ asset('images/icons/delete.png') }}" class="w-[20px] h-[20px]" alt="Delete Icon">
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Table for Employments -->
                <div id="employments" class="w-full flex flex-col gap-0 inactive_link">
                    @if($employments->count() == 0)
                        <div class="w-full flex items-center justify-center text-sm text-gray-400 pt-8 pb-12">
                            <span class="italic">No user data.</span>
                        </div>
                    @else
                        <div class="w-full flex flex-col overflow-y-auto h-[300px]">
                            @foreach($employments as $item)
                                <div class="w-full grid grid-cols-[85%_15%] hover:bg-gray-100 px-4 py-4 border-l-8 border-red-900 border-b-2 border-t-2">
                                    <div class="flex flex-col leading-tight">
                                        <h1 class="font-semibold text-gray-700">
                                            <strong>{{ $item->type }}</strong> - {{ $item->title }}
                                        </h1>
                                        <span class="italic text-sm text-gray-500">
                                            Date Submitted: {{ $item->date_submitted }}
                                        </span>
                                        <div class="flex items-start">
                                            <img src="{{ asset('images/icons/attachment.png') }}" class="w-[20px] h-[20px]" alt="Attachment Icon">
                                            <a title="{{ $item->employment->attachment }}" class="hover:underline text-gray-600" 
                                               href="{{ asset('storage/employments/' . Auth::user()->id . '/' . $item->id . '.' . explode('.', $item->employment->attachment)[0]) }}" target="_blank">
                                                {{ $item->employment->attachment }}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('portal.employment.view', ['id' => $item->id]) }}" 
                                           class="border bg-red-900 rounded-xl p-2 hover:bg-red-700" title="View Info">
                                            <img src="{{ asset('images/icons/eye.svg') }}" class="w-[20px] h-[20px]" alt="View Icon">
                                        </a>
                                        <form action="{{ route('portal.employment.delete', ['id' => $item->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete(this)" 
                                                    class="border bg-red-900 rounded-xl p-2 hover:bg-red-700" title="Delete Item">
                                                <img src="{{ asset('images/icons/delete.png') }}" class="w-[20px] h-[20px]" alt="Delete Icon">
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Table for Research and Publication -->
                <div id="respubs" class="w-full flex flex-col gap-0 inactive_link">
                    @if($respubs->count() == 0)
                        <div class="w-full flex items-center justify-center text-sm text-gray-400 pt-8 pb-12">
                            <span class="italic">No user data.</span>
                        </div>
                    @else
                        <div class="w-full flex flex-col overflow-y-auto h-[300px]">
                            @foreach($respubs as $item)
                                <div class="w-full grid grid-cols-[85%_15%] hover:bg-gray-100 px-4 py-4 border-l-8 border-red-900 border-b-2 border-t-2">
                                    <div class="flex flex-col leading-tight">
                                        @if($item->research)
                                            <h1 class="font-semibold text-gray-700">
                                                <strong>Research</strong> - {{ $item->title }}
                                            </h1>
                                        @elseif($item->publication)
                                            <h1 class="font-semibold text-gray-700">
                                                <strong>Publication</strong> - {{ $item->title }}
                                            </h1>
                                        @endif
                                        <span class="italic text-sm text-gray-500">
                                            Date Submitted: {{ $item->date_submitted }}
                                        </span>
                                        <div class="flex items-start">
                                            <img src="{{ asset('images/icons/attachment.png') }}" class="w-[20px] h-[20px]" alt="Attachment Icon">
                                            @if($item->research)
                                                <a title="{{ $item->research->attachment }}" class="hover:underline text-gray-600"
                                                   href="{{ asset('storage/' . $item->research->file_path) }}" target="_blank">
                                                    {{ $item->research->attachment }}
                                                </a>
                                            @elseif($item->publication)
                                                <a title="{{ $item->publication->attachment }}" class="hover:underline text-gray-600"
                                                   href="{{ asset('storage/' . $item->publication->file_path) }}" target="_blank">
                                                    {{ $item->publication->attachment }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('portal.respub.view', ['id' => $item->id]) }}" 
                                           class="border bg-red-900 rounded-xl p-2 hover:bg-red-700" title="View Info">
                                            <img src="{{ asset('images/icons/eye.svg') }}" class="w-[20px] h-[20px]" alt="View Icon">
                                        </a>
                                        <form action="{{ route('portal.respub.delete', ['id' => $item->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete(this)" 
                                                    class="border bg-red-900 rounded-xl p-2 hover:bg-red-700" title="Delete Item">
                                                <img src="{{ asset('images/icons/delete.png') }}" class="w-[20px] h-[20px]" alt="Delete Icon">
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Table for Organization -->
                <div id="orgs" class="w-full flex flex-col gap-0 inactive_link">
                    @if($orgs->count() == 0)
                        <div class="w-full flex items-center justify-center text-sm text-gray-400 pt-8 pb-12">
                            <span class="italic">No user data.</span>
                        </div>
                    @else
                        <div class="w-full flex flex-col overflow-y-auto h-[300px]">
                            @foreach($orgs as $item)
                                <div class="w-full grid grid-cols-[85%_15%] hover:bg-gray-100 px-4 py-4 border-l-8 border-red-900 border-b-2 border-t-2">
                                    <div class="flex flex-col leading-tight">
                                        <h1 class="font-semibold text-gray-700">
                                            <strong>{{ $item->type }}</strong> - {{ $item->title }}
                                        </h1>
                                        <span class="italic text-sm text-gray-500">
                                            Date Submitted: {{ $item->date_submitted }}
                                        </span>
                                        <div class="flex items-start">
                                            <img src="{{ asset('images/icons/attachment.png') }}" class="w-[20px] h-[20px]" alt="Attachment Icon">
                                            <a title="{{ $item->attachment }}" class="hover:underline text-gray-600" 
                                               href="{{ asset('storage/' . $item->orgs->file_path) }}" target="_blank">
                                                {{ $item->orgs->attachment }}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-end gap-1">
                                        <form action="{{ route('portal.org.edit', ['user' => Auth::user()->id, 'id' => $item->id]) }}" method="GET">
                                            <button type="submit" class="border bg-red-900 rounded-xl p-2 hover:bg-red-700 transition-all" title="View Info">
                                                <img src="{{ asset('images/icons/eye.svg') }}" class="w-[20px] h-[20px]" alt="View Icon">
                                            </button>
                                        </form>
                                        <form action="{{ route('portal.org.delete') }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete(this)" 
                                                    class="border bg-red-900 rounded-xl p-2 hover:bg-red-700" title="Delete Item">
                                                <img src="{{ asset('images/icons/delete.png') }}" class="w-[20px] h-[20px]" alt="Delete Icon">
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Table for Dependents -->
                <div id="dependents" class="w-full flex flex-col gap-0 inactive_link">
                    @if($dependents->count() == 0)
                        <div class="w-full flex items-center justify-center text-sm text-gray-400 pt-8 pb-12">
                            <span class="italic">No user data.</span>
                        </div>
                    @else
                        <div class="w-full flex flex-col overflow-y-auto h-[300px]">
                            @foreach($dependents as $item)
                                <div class="w-full grid grid-cols-[85%_15%] hover:bg-gray-100 px-4 py-4 border-l-8 border-red-900 border-b-2 border-t-2">
                                    <div class="flex flex-col leading-tight">
                                        <h1 class="font-semibold text-gray-700">
                                            <strong>{{ $item->type }}</strong> - {{ $item->title }}
                                        </h1>
                                        <span class="italic text-sm text-gray-500">
                                            Date Submitted: {{ $item->date_submitted }}
                                        </span>
                                        <div class="flex items-start">
                                            <img src="{{ asset('images/icons/attachment.png') }}" class="w-[20px] h-[20px]" alt="Attachment Icon">
                                            <a title="{{ $item->attachment }}" class="hover:underline text-gray-600" 
                                               href="{{ asset('storage/' . $item->dependents->file_path) }}" target="_blank">
                                                {{ $item->dependents->attachment }}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-end gap-1">
                                        <form action="{{ route('portal.dependencies.view', ['user' => Auth::user()->id, 'id' => $item->id]) }}" method="GET">
                                            <button type="submit" class="border bg-red-900 rounded-xl p-2 hover:bg-red-700 transition-all" title="View Info">
                                                <img src="{{ asset('images/icons/eye.svg') }}" class="w-[20px] h-[20px]" alt="View Icon">
                                            </button>
                                        </form>
                                        <form action="{{ route('portal.dependencies.delete', ['dep_id' => $item->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete(this)" 
                                                    class="border bg-red-900 rounded-xl p-2 hover:bg-red-700" title="Delete Item">
                                                <img src="{{ asset('images/icons/delete.png') }}" class="w-[20px] h-[20px]" alt="Delete Icon">
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

<style>
    a,
    button {
        transition: 150ms;
    }

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

    #msg {
        opacity: 1;
        transition: opacity 300ms ease-in-out;
    }
</style>

<script>
    const certifications_btn = document.getElementById('certifications_btn');
    const trainings_btn = document.getElementById('trainings_btn');
    const licenses_btn = document.getElementById('licenses_btn');
    const educations_btn = document.getElementById('educations_btn');
    const employments_btn = document.getElementById('employments_btn');
    const respubs_btn = document.getElementById('respubs_btn');
    const orgs_btn = document.getElementById('orgs_btn');
    const dependents_btn = document.getElementById('dependents_btn');

    const certifications_tbl = document.getElementById('certifications');
    const trainings_tbl = document.getElementById('trainings');
    const licenses_tbl = document.getElementById('licenses');
    const educations_tbl = document.getElementById('educations');
    const employments_tbl = document.getElementById('employments');
    const respubs_tbl = document.getElementById('respubs');
    const orgs_tbl = document.getElementById('orgs');
    const dependents_tbl = document.getElementById('dependents');

    // Event Listeners for Navigation Buttons
    certifications_btn.addEventListener("click", () => {
        certifications_btn.classList.add('active_link');
        trainings_btn.classList.remove('active_link');
        licenses_btn.classList.remove('active_link');
        educations_btn.classList.remove('active_link');
        employments_btn.classList.remove('active_link');
        respubs_btn.classList.remove('active_link');
        orgs_btn.classList.remove('active_link');
        dependents_btn.classList.remove('active_link');

        certifications_tbl.classList.remove('inactive_link');
        trainings_tbl.classList.add('inactive_link');
        licenses_tbl.classList.add('inactive_link');
        educations_tbl.classList.add('inactive_link');
        employments_tbl.classList.add('inactive_link');
        respubs_tbl.classList.add('inactive_link');
        orgs_tbl.classList.add('inactive_link');
        dependents_tbl.classList.add('inactive_link');
    });

    trainings_btn.addEventListener("click", () => {
        certifications_btn.classList.remove('active_link');
        trainings_btn.classList.add('active_link');
        licenses_btn.classList.remove('active_link');
        educations_btn.classList.remove('active_link');
        employments_btn.classList.remove('active_link');
        respubs_btn.classList.remove('active_link');
        orgs_btn.classList.remove('active_link');
        dependents_btn.classList.remove('active_link');

        certifications_tbl.classList.add('inactive_link');
        trainings_tbl.classList.remove('inactive_link');
        licenses_tbl.classList.add('inactive_link');
        educations_tbl.classList.add('inactive_link');
        employments_tbl.classList.add('inactive_link');
        respubs_tbl.classList.add('inactive_link');
        orgs_tbl.classList.add('inactive_link');
        dependents_tbl.classList.add('inactive_link');
    });

    licenses_btn.addEventListener("click", () => {
        certifications_btn.classList.remove('active_link');
        trainings_btn.classList.remove('active_link');
        licenses_btn.classList.add('active_link');
        educations_btn.classList.remove('active_link');
        employments_btn.classList.remove('active_link');
        respubs_btn.classList.remove('active_link');
        orgs_btn.classList.remove('active_link');
        dependents_btn.classList.remove('active_link');

        certifications_tbl.classList.add('inactive_link');
        trainings_tbl.classList.add('inactive_link');
        licenses_tbl.classList.remove('inactive_link');
        educations_tbl.classList.add('inactive_link');
        employments_tbl.classList.add('inactive_link');
        respubs_tbl.classList.add('inactive_link');
        orgs_tbl.classList.add('inactive_link');
        dependents_tbl.classList.add('inactive_link');
    });

    educations_btn.addEventListener("click", () => {
        certifications_btn.classList.remove('active_link');
        trainings_btn.classList.remove('active_link');
        licenses_btn.classList.remove('active_link');
        educations_btn.classList.add('active_link');
        employments_btn.classList.remove('active_link');
        respubs_btn.classList.remove('active_link');
        orgs_btn.classList.remove('active_link');
        dependents_btn.classList.remove('active_link');

        certifications_tbl.classList.add('inactive_link');
        trainings_tbl.classList.add('inactive_link');
        licenses_tbl.classList.add('inactive_link');
        educations_tbl.classList.remove('inactive_link');
        employments_tbl.classList.add('inactive_link');
        respubs_tbl.classList.add('inactive_link');
        orgs_tbl.classList.add('inactive_link');
        dependents_tbl.classList.add('inactive_link');
    });

    employments_btn.addEventListener("click", () => {
        certifications_btn.classList.remove('active_link');
        trainings_btn.classList.remove('active_link');
        licenses_btn.classList.remove('active_link');
        educations_btn.classList.remove('active_link');
        employments_btn.classList.add('active_link');
        respubs_btn.classList.remove('active_link');
        orgs_btn.classList.remove('active_link');
        dependents_btn.classList.remove('active_link');

        certifications_tbl.classList.add('inactive_link');
        trainings_tbl.classList.add('inactive_link');
        licenses_tbl.classList.add('inactive_link');
        educations_tbl.classList.add('inactive_link');
        employments_tbl.classList.remove('inactive_link');
        respubs_tbl.classList.add('inactive_link');
        orgs_tbl.classList.add('inactive_link');
        dependents_tbl.classList.add('inactive_link');
    });

    respubs_btn.addEventListener("click", () => {
        certifications_btn.classList.remove('active_link');
        trainings_btn.classList.remove('active_link');
        licenses_btn.classList.remove('active_link');
        educations_btn.classList.remove('active_link');
        employments_btn.classList.remove('active_link');
        respubs_btn.classList.add('active_link');
        orgs_btn.classList.remove('active_link');
        dependents_btn.classList.remove('active_link');

        certifications_tbl.classList.add('inactive_link');
        trainings_tbl.classList.add('inactive_link');
        licenses_tbl.classList.add('inactive_link');
        educations_tbl.classList.add('inactive_link');
        employments_tbl.classList.add('inactive_link');
        respubs_tbl.classList.remove('inactive_link');
        orgs_tbl.classList.add('inactive_link');
        dependents_tbl.classList.add('inactive_link');
    });

    orgs_btn.addEventListener("click", () => {
        certifications_btn.classList.remove('active_link');
        trainings_btn.classList.remove('active_link');
        licenses_btn.classList.remove('active_link');
        educations_btn.classList.remove('active_link');
        employments_btn.classList.remove('active_link');
        respubs_btn.classList.remove('active_link');
        orgs_btn.classList.add('active_link');
        dependents_btn.classList.remove('active_link');

        certifications_tbl.classList.add('inactive_link');
        trainings_tbl.classList.add('inactive_link');
        licenses_tbl.classList.add('inactive_link');
        educations_tbl.classList.add('inactive_link');
        employments_tbl.classList.add('inactive_link');
        respubs_tbl.classList.add('inactive_link');
        orgs_tbl.classList.remove('inactive_link');
        dependents_tbl.classList.add('inactive_link');
    });

    dependents_btn.addEventListener("click", () => {
        certifications_btn.classList.remove('active_link');
        trainings_btn.classList.remove('active_link');
        licenses_btn.classList.remove('active_link');
        educations_btn.classList.remove('active_link');
        employments_btn.classList.remove('active_link');
        respubs_btn.classList.remove('active_link');
        orgs_btn.classList.remove('active_link');
        dependents_btn.classList.add('active_link');

        certifications_tbl.classList.add('inactive_link');
        trainings_tbl.classList.add('inactive_link');
        licenses_tbl.classList.add('inactive_link');
        educations_tbl.classList.add('inactive_link');
        employments_tbl.classList.add('inactive_link');
        respubs_tbl.classList.add('inactive_link');
        orgs_tbl.classList.add('inactive_link');
        dependents_tbl.classList.remove('inactive_link');
    });

    function confirmDelete(button) {
        const form = button.closest('form');
        if (confirm('Are you sure you want to delete this record?')) {
            form.submit();
        }
    }

    // Hide message after 5 seconds
    if (document.getElementById('msg')) {
        setTimeout(() => {
            let msg = document.getElementById('msg');
            msg.style.opacity = '0';
            setTimeout(() => {
                msg.style.display = 'none';
            }, 100);
        }, 5000);
    }
</script>
