<x-app-layout>
    <div class="container mx-auto flex justify-center py-8">
        <div class="w-[90%] bg-white rounded-lg shadow-lg p-8">

            <div class="flex items-center mb-4">
                @if(!isset($data->hau_cert))
                <a href="{{ route('portal.certifications') }}" class="flex items-center bg-maroon text-white px-4 py-2 rounded-md transition duration-300 bg-red-900 hover:bg-red-800 mr-2">
                    <img src="{{ asset('images/icons/back.png') }}" class="w-4 h-4 mr-2">
                    <span>Certifications</span>
                </a>
                @else
                <a href="{{route('portal.training')}}" class="flex items-center bg-maroon text-white px-4 py-2 rounded-md transition duration-300 bg-red-900 hover:bg-red-800 mr-2">
                    <img src="{{asset('images/icons/back.png')}}" class="w-4 h-4 mr-2" alt="">
                    <span>Trainings</span>
                </a>
                @endif


                @if($data->status == 'To-review')
                <a href="{{ route('portal.certifications.edit', ['id'=> $data->id]) }}" class="flex items-center bg-maroon text-white px-4 py-2 rounded-md transition duration-300 bg-red-900 hover:bg-red-800 mr-2">
                    <img src="{{ asset('images/icons/resubmit.png') }}" class="w-4 h-4 mr-2">
                    <span>Resubmit</span>
                </a>

                @else
                <a href="{{ route('portal.certifications.edit', ['id'=> $data->id]) }}" class="flex items-center bg-maroon text-white px-4 py-2 rounded-md transition duration-300 bg-red-900 hover:bg-red-800 mr-2">
                    <img src="{{ asset('images/icons/edit.png') }}" class="w-4 h-4 mr-2">
                    <span>Edit Details</span>
                </a>
                @endif
            </div>

            <div class="mb-6">
                <span class="text-gray-500 text-sm">Certification Title</span>
                <h1 class="text-2xl font-bold text-gray-800">{{ $data->cert_title }}</h1>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                <div>
                    <span class="text-gray-500 text-sm">Certification Type</span>
                    <h1 class="text-lg font-semibold text-gray-800">{{ $data->cert_type }}</h1>
                </div>
                <div>
                    <span class="text-gray-500 text-sm">Role</span>
                    <h1 class="text-lg font-semibold text-gray-800">{{ $data->role }}</h1>
                </div>
                <div>
                    <span class="text-gray-500 text-sm">Date Issued</span>
                    <h1 class="text-lg font-semibold text-gray-800">{{ $data->date_issued }}</h1>
                </div>
                <div>
                    <span class="text-gray-500 text-sm">Validity</span>
                    <h1 class="text-lg font-semibold text-gray-800">{{ $data->cert_validity }}</h1>
                </div>
                <div>
                    <span class="text-gray-500 text-sm">Duration</span>
                    <h1 class="text-lg font-semibold text-gray-800">{{ $data->duration }}</h1>
                </div>
            </div>

            <div class="mb-6">
                <span class="text-gray-500 text-sm mb-2 block">Attachment</span>
                <div class="flex items-center mb-2">
                    <img src="{{ asset('images/icons/attachment.png') }}" class="w-5 h-5 mr-2">
                    <a href="{{ asset('storage/' . $data->file_path) }}" class="text-blue-600 underline" download>{{ $data->attachment }}</a>
                </div>
            </div>

            <iframe id="pdfIframe" src="{{ asset('storage/' . $data->file_path) }}" class="w-full h-96 border-0 mb-6"></iframe>

        </div>
    </div>
</x-app-layout>

<style>
    /* Add your custom styles here if necessary */
</style>
