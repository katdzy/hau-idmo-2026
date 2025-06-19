<x-app-layout>
    <div class="min-h-screen">
        <div class="w-full flex justify-center py-8">
            <div class="w-[95%] bg-white flex flex-col px-8 pt-8 pb-12 rounded-lg">
                <!-- Back Button -->
                <a href="{{ route('portal.org') }}" class="w-[25%] rounded-lg flex items-center justify-center py-2 bg-red-900 text-white font-bold gap-1 hover:bg-red-700">
                    <img src="{{ asset('images/icons/back.png') }}" class="w-[20px] h-[20px]" alt="Back">
                    <h1>Back</h1>
                </a>

                <!-- Header -->
                <div class="w-full flex flex-col items-center">
                    <img src="{{ asset('images/hau-logo.png') }}" class="w-[120px] h-[120px] mt-4" alt="Logo">
                    <h1 class="text-[2rem] text-gray-700 font-extrabold mt-4 leading-tight">
                        ORGANIZATION MEMBERSHIP
                    </h1>
                    <span class="text-gray-500 text-[0.8rem] text-center px-[8rem]">
                        Please update the form below to modify the existing organization membership details. 
                        Ensure that all required fields are correctly filled out before submitting your changes.
                    </span>
                </div>

                <hr class="opacity-90 my-4">

                <!-- Update Form -->
                <form action="{{ route('portal.org.update', ['id' => $org->id]) }}" method="POST" class="w-full flex flex-col items-center text-center gap-2" enctype="multipart/form-data">
                    @csrf 
                    @method('PUT')
                    
                    <div class="w-[50%] flex flex-col gap-1">
                        <span class="text-gray-500 font-semibold">Organization Name <span class="font-bold text-red-500">*</span> </span>
                        <input type="text" name="org" class="border border-gray-300" value="{{ $org->org }}" required />
                    </div>

                    <div class="w-[50%] flex flex-col gap-1">
                        <span class="text-gray-500 font-semibold">Position <span class="font-bold text-red-500">*</span> </span>
                        <input type="text" name="position" class="border border-gray-300" value="{{ $org->position }}" required />
                    </div>

                    <div class="w-[50%] flex flex-col gap-1">
                        <span class="text-gray-500 font-semibold">Date Joined <span class="font-bold text-red-500">*</span> </span>
                        <input type="date" name="date_joined" class="border border-gray-300 text-center" min="1933-03-08" max="{{ date('Y-m-d') }}" value="{{ $org->date_joined }}" required />
                    </div>

                    <div class="flex flex-col gap-1">
                        <span class="text-gray-500 font-semibold text-center">Attachment | Proof of Membership <span class="font-bold text-red-500">*</span> </span>
                    </div>

                    <!-- Attachment Section -->
                    <div class="flex-col">
                        <div class="w-full flex items-center my-2" id="attachment">
                            <img src="{{ asset('images/icons/attachment.png') }}" alt="Attachment Icon" class="w-[20px] h-[20px]">
                            <h1 class="truncate font-semibold text-gray-600">{{ $org->attachment }}</h1>
                            <button type="button" class="bg-gray-900 hover:bg-gray-800 text-white flex items-center px-8 py-1 ml-2 rounded-lg" id="edit_att">
                                <img src="{{ asset('images/icons/upload.png') }}" alt="Upload" class="w-[20px] h-[20px]">
                                <span>Change File</span>
                            </button>
                        </div>

                        <div class="w-full flex items-center justify-center mt-2 gap-2 hide" id="attachment_edit">
                            <button type="button" class="bg-gray-900 hover:bg-gray-800 text-white flex items-center px-4 py-1 ml-2 rounded-lg" id="cancel">
                                <img src="{{ asset('images/icons/cancel.png') }}" alt="Cancel" class="w-[20px] h-[20px]">
                                <span>Cancel</span>
                            </button>
                            <input type="file" name="attachment" id="fileinput" class="text-gray-700 truncate">
                        </div>
                    </div>

                    @if(isset($msg))
                        <span>{{ $msg }}</span>
                    @endif

                    @if($org->status == "To-review")
                        <button type="submit" class="w-[50%] bg-red-900 hover:bg-red-700 text-white py-2 mt-2">
                            RESUBMIT
                        </button>
                    @else
                        <button type="submit" class="w-[50%] bg-red-900 hover:bg-red-700 text-white py-2 mt-2">
                            UPDATE
                        </button>
                    @endif
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    a,
    button {
        transition: 300ms;
    }
</style>

<script>
    let attachment = document.getElementById('attachment');
    let attachment_edit = document.getElementById('attachment_edit');
    let attachment_btn = document.getElementById('edit_att');
    let cancel_btn = document.getElementById('cancel');

    attachment_btn.addEventListener("click", () => {
        attachment_edit.classList.remove('hide');
        attachment.classList.add('hide');
    });

    cancel_btn.addEventListener("click", () => {
        attachment_edit.classList.add('hide');
        const fileinput = document.getElementById('fileinput');
        fileinput.value = '';
        attachment.classList.remove('hide');
    });
</script>
