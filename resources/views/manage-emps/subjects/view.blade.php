@php
$count = 1; 
@endphp

<x-app-layout>
    <div class="min-h-screen">
        <div class="w-full flex justify-center py-8 relative">
            <div class="rounded-lg w-11/12 bg-white flex flex-col items-start py-4 px-8">
                <!-- Success Message -->
                @if(session('msg'))
                    <div class="w-full bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">{{ session('msg') }}</span>
                    </div>
                @endif

                <!-- Error Message -->
                @if(session('error'))
                    <div class="w-full bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                <!-- Back Button -->
                <div class="w-full flex flex-col py-2">
                    <a href="{{ route('admin.subjects') }}" class="flex items-center justify-center bg-red-900 hover:bg-red-700 text-white py-2 w-1/4 transition duration-300">
                        <img src="{{ asset('images/icons/back.png') }}" class="w-5 h-5"/>
                        <h3 class="uppercase ml-1">View all Subjects</h3>
                    </a>
                </div>

                <form id="subject-form" action="{{ route('admin.subjects.update', ['id' => $subj->subj_code]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Subject Code -->
                    <div class="w-full flex flex-col py-2">
                        <span class="text-sm text-gray-600">Subject Code</span>
                        <div class="w-full flex items-center space-x-4">
                            <div class="flex-1 flex items-center">
                                <h1 class="view-mode font-bold text-lg mr-4" id="subj_code_view">{{ $subj->subj_code }}</h1>
                                <input type="text" name="subj_code" value="{{ $subj->subj_code }}" class="edit-mode hidden border border-gray-300 rounded p-2 mr-4 flex-1" id="subj_code_input">
                                <h1 class="hidden" id="subj_code">{{ $subj->subj_code }}</h1> 
                            </div>
                            <button type="button" id="clipboard" class="font-bold text-red-900 text-sm cursor-pointer transition duration-300 px-3 py-1 bg-gray-200 rounded">
                                Copy to Clipboard
                            </button>
                            <span id="clipboard_msg" class="hidden text-green-600 text-sm">Copied!</span>  
                        </div>
                    </div>

                    <!-- Subject Title -->
                    <div class="w-full flex flex-col py-2">
                        <span class="text-sm text-gray-600">Subject</span>
                        <h1 class="view-mode font-semibold text-lg" id="subj_title_view">{{ $subj->subj_title }}</h1>
                        <input type="text" name="subj_title" value="{{ $subj->subj_title }}" class="edit-mode hidden border border-gray-300 rounded p-2 mt-1" id="subj_title_input">
                    </div>

                    <!-- Subject Description -->
                    <div class="w-full flex flex-col py-2">
                        <span class="text-sm text-gray-600">Description</span>
                        <h1 class="view-mode font-semibold text-lg" id="subj_description_view">{{ $subj->subj_description }}</h1>
                        <textarea name="subj_description" rows="5" class="edit-mode hidden border border-gray-300 rounded p-2 mt-1" id="subj_description_input">{{ $subj->subj_description }}</textarea>
                    </div>


                    <!-- Units -->
                    <div class="w-full flex flex-col py-2">
                        <span class="text-sm text-gray-600">No. of Units</span>
                        <h3 class="view-mode font-medium text-lg" id="units_view">{{ $subj->units }}.00</h3>
                        <input type="number" name="units" value="{{ $subj->units }}" class="edit-mode hidden border border-gray-300 rounded p-2 mt-1" id="units_input">
                    </div>

                    <!-- School Year -->
                    <div class="w-full flex flex-col py-2">
                        <span class="text-sm text-gray-600">School Year</span>
                        <h3 class="view-mode font-medium text-lg" id="subj_sy_view">{{ $subj->subj_sy }}</h3>
                        <input type="text" name="subj_sy" value="{{ $subj->subj_sy }}" class="edit-mode hidden border border-gray-300 rounded p-2 mt-1" id="subj_sy_input">
                    </div>
                </form>

                <!-- Buttons -->
                <div class="w-full flex items-center px-8 py-4 gap-2">
                    <!-- Delete Subject Button -->
                    <form action="{{ route('admin.subjects.destroy', $subj->subj_code) }}" method="POST" class="w-[20%]" id="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="w-full flex items-center justify-center bg-red-900 hover:bg-red-700 text-white rounded-lg py-2" onclick="confirmDelete()">
                        <img src="{{ asset('images/icons/delete.png') }}" class="w-[25px] h-[25px] mx-2" alt="">
                        <span class="text-lg">Delete Subject</span>
                    </button>
                </form>

                    <!-- Edit/Save Changes Button -->
                    <a id="edit-button" class="w-1/6 flex items-center justify-center bg-red-900 hover:bg-red-700 text-white rounded-lg py-2 cursor-pointer transition duration-300">
                        <img src="{{ asset('images/icons/edit.png') }}" class="w-6 h-6 mx-2" alt="">
                        <span class="text-lg">Edit Subject</span>
                    </a>

                    <!-- Add to User Button -->
                    <a href="{{ route('admin.subjects.load', ['id' => $subj->subj_id]) }}" class="w-1/6 flex items-center justify-center bg-red-900 hover:bg-red-700 text-white rounded-lg py-2 cursor-pointer transition duration-300">
                        <img src="{{ asset('images/icons/link.png') }}" class="w-6 h-6 mx-2" alt="">
                        <span class="text-lg">Add to User</span>
                    </a>
                </div>
            </div>
        </div> 
    </div>
</x-app-layout>

<script>

function confirmDelete() {
        if (confirm('Are you sure you want to delete this subject? This action cannot be undone.')) {
            document.getElementById('delete-form').submit();
        }
    }

document.addEventListener('DOMContentLoaded', function() {
    var editButton = document.getElementById('edit-button');
    var isEditMode = false;

    editButton.addEventListener('click', function(event) {
        event.preventDefault(); // prevent default action

        if (!isEditMode) {
            // Switch to edit mode
            isEditMode = true;
            editButton.querySelector('span').textContent = 'Save Changes';
            editButton.querySelector('img').src = "{{ asset('images/icons/save.png') }}";

            // Show input fields and hide view mode spans
            document.querySelectorAll('.view-mode').forEach(function(el) {
                el.classList.add('hidden');
            });
            document.querySelectorAll('.edit-mode').forEach(function(el) {
                el.classList.remove('hidden');
            });

        } else {
            // Save changes
            document.getElementById('subject-form').submit();
        }
    });

    // Clipboard functionality
    document.querySelector("#clipboard").addEventListener("click", () => { 
        const subjCode = document.querySelector("#subj_code_view").textContent;
        navigator.clipboard.writeText(subjCode).then(() => {
            document.querySelector("#clipboard").classList.add("hidden");
            document.querySelector("#clipboard_msg").classList.remove("hidden");
            setTimeout(() => {
                document.querySelector("#clipboard").classList.remove("hidden");
                document.querySelector("#clipboard_msg").classList.add("hidden");
            }, 3000); // Hide the message after 3 seconds
        }).catch(err => {
            console.error('Failed to copy!', err);
        });
    });
    window.addEventListener("DOMContentLoaded", function() {
        setTimeout(function() {
            const sessionMsg = document.querySelector('div[role="alert"]');
            if (sessionMsg) {
                sessionMsg.style.display = 'none';
            }
        }, 3000);
    });

});

</script>

<style>
    /* Success and Error Alert Styles */
    .alert-success {
        @apply w-full bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4;
    }
    .alert-error {
        @apply w-full bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4;
    }
</style>