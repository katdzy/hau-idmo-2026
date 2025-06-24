@php
    $changed  = session('changed'); 
    session(['changed'=>false]); 
@endphp

<section>
    <header>
        <div> 
            @if($changed==true)
                <p class="msg mt-1 mb-2">
                    {{ __("Profile picture successfully updated.") }}
                </p>
            @endif
        </div> 
        <h2 class="text-lg font-medium text-gray-900 dark:text-black-100">
            {{ __('Profile Information') }}
        </h2>
        <p class="mt-1 mb-2 text-sm text-white-600 dark:text-gray-400">
            {{ __("Update your account's profile picture and email address.") }}
        </p>
    </header>

    {{-- Display the current image --}}
    <div class="change_dp"> 
        @if($data->profile_picture)
            <img id="preview" src="{{ asset('storage/profile_pictures/' . $data->profile_picture) }}" alt="user_image"/> 
        @else 
            <img id="preview" src="{{ asset('images/blankdp.jpg') }}" alt="default image"/>
        @endif

        @if($changedp == false) 
            <div class="w-full flex mt-2 gap-2">
                <a class="bg-red-900 hover:bg-red-800 px-4 py-2 text-white rounded-xl" href="{{ route('profile.changepic') }}"> 
                    <span>Change Profile Picture</span>
                </a>
            </div>
        @else 
            {{-- The form that processes the final submission (after cropping) --}}
            <form 
                method="post" 
                action="{{ route('update-pic', ['id'=> Auth::user()->id]) }}" 
                enctype="multipart/form-data"
                id="profilePictureForm"
            >
                @csrf
                @method('PUT')

                <div class="row">
                    <label for="file">Choose a file:</label>
                    <input type="file" id="file" name="profile_picture" accept="image/*">
                </div>

                {{-- We'll keep the CANCEL link here as requested, but remove the Save button in favor of the modal --}}
                <div class="row" style="margin-top: 1rem;">
                    <a class="cancel" href="{{ route('profile.edit') }}">Cancel</a>
                </div>

                {{-- Hidden field will store the cropped image data as base64 (once user clicks "Save Changes" in the modal) --}}
                <input type="hidden" name="cropped_image" id="cropped_image">
            </form>
        @endif
    </div> 

    {{-- Standard form for email, etc. --}}
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input 
                id="email" 
                name="email" 
                type="email" 
                class="mt-1 block w-full" 
                :value="old('email', $user->email)" 
                required 
                autocomplete="username" 
                disabled 
            />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>
    </form>
</section>

{{-- ############## MODAL FOR CROPPING ############## --}}
<div id="cropModal" class="modal" style="display:none;">
    <div class="modal-content">
        <div class="modal-header">
            <span class="close" id="cropModalClose">&times;</span>
            <h2>Adjust your profile picture</h2>
        </div>
        <div class="modal-body">
            <div style="width: 100%; text-align: center;">
                <img id="cropPreview" style="max-width: 100%;"/>
            </div>
        </div>
        <div class="modal-footer">
            <button id="confirmCrop" class="save-btn" type="button">Save Changes</button>
            <button id="cancelCrop" type="button" class="cancel-btn">Cancel</button>
        </div>
    </div>
</div>

<style>
    section { 
        width: 75%;
        padding: 2rem 0;
    }
    .cancel { 
        font-size: 12px; 
        margin: 0 1rem;
        text-decoration: underline;
    }
    .msg { 
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-size: 0.8rem; 
        text-align: center;
        background-color: green; 
        color: white; 
    }
    .change_dp img {
        width: 150px !important;
        height: 150px !important;
        border-radius: 50% !important;
        object-fit: cover !important;
    }

    /* ====== Modal styling ====== */
    .modal {
        position: fixed; 
        z-index: 999; 
        left: 0; 
        top: 0; 
        width: 100%; 
        height: 100%; 
        overflow: auto; 
        background-color: rgba(0,0,0,0.5); 
    }
    .modal-content {
        background-color: #fefefe;
        margin: 5% auto; 
        padding: 20px;
        border: 1px solid #888;
        width: 50%; 
        max-width: 600px;
        border-radius: 8px;
    }
    .modal-header, .modal-body, .modal-footer {
        margin-bottom: 1rem;
    }
    .close {
        float: right;
        font-size: 1.5rem;
        font-weight: bold;
        cursor: pointer;
    }
    .save-btn, .cancel-btn {
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    .save-btn {
        background-color: #28a745;
        color: #fff;
    }
    .cancel-btn {
        margin-left: 1rem;
        background-color: #dc3545;
        color: #fff;
    }
</style>

{{-- ########### Include Cropper.js (via CDN) ########### --}}
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/cropperjs@1.5.13/dist/cropper.css"
/>
<script src="https://cdn.jsdelivr.net/npm/cropperjs@1.5.13/dist/cropper.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Hides the green success message after 5 seconds
        var statusChanged = @json($changed);
        if(statusChanged == true) { 
            setTimeout(function() { 
                const msgDiv = document.querySelector('.msg');
                if(msgDiv) msgDiv.style.display = 'none';
            }, 5000)
        }

        // If changedp == true, then we have the file input displayed
        let changedp = @json($changedp);
        if(changedp) {
            let fileInput = document.getElementById('file');
            let cropModal = document.getElementById('cropModal');
            let cropPreview = document.getElementById('cropPreview');
            let cropper = null;

            // Buttons in modal
            let confirmCropBtn = document.getElementById('confirmCrop');
            let cancelCropBtn = document.getElementById('cancelCrop');
            let closeModalBtn = document.getElementById('cropModalClose');

            // Listen for file selection
            fileInput.addEventListener('change', function(event) {
                let file = event.target.files[0];
                if (file) {
                    // Read file & open the modal
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        cropPreview.src = e.target.result;
                        
                        // Show modal
                        cropModal.style.display = 'block';

                        // Destroy old cropper (if any), then re-init
                        if(cropper) {
                            cropper.destroy();
                        }
                        cropper = new Cropper(cropPreview, {
                            aspectRatio: 1,
                            viewMode: 1
                        });
                    };
                    reader.readAsDataURL(file);
                }
            });

            // When user clicks "Save Changes" in the modal:
            confirmCropBtn.addEventListener('click', function() {
                if(cropper) {
                    // Get cropped canvas and convert to base64
                    let canvas = cropper.getCroppedCanvas({
                        width: 300,
                        height: 300
                    });
                    let base64Data = canvas.toDataURL('image/png');

                    // Put the base64 string in hidden input
                    document.getElementById('cropped_image').value = base64Data;

                    // Submit the form
                    document.getElementById('profilePictureForm').submit();
                }
            });

            // Cancel Crop inside the modal: just close the modal
            cancelCropBtn.addEventListener('click', function() {
                cropModal.style.display = 'none';
                // Reset the file input (so user can choose again if they want)
                fileInput.value = "";
            });

            // Clicking X (top-right) also closes the modal
            closeModalBtn.addEventListener('click', function(){
                cropModal.style.display = 'none';
                fileInput.value = "";
            });
        }
    });
</script>
