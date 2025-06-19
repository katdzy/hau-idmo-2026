<x-app-layout> 
    <div class="min-h-screen">
        <div class="w-full flex justify-center py-8">
            <div class="w-[95%] flex flex-col rounded-xl p-8 bg-white">
                <div class="w-full flex justify-between items-center mb-4">
                    <a href="{{ route('portal.profile') }}" class="flex items-center space-x-2 p-2 rounded-lg bg-red-900 text-white transition duration-300 hover:bg-red-800">
                        <img src="{{ asset('images/icons/cancel.png') }}" alt="Cancel" class="w-5 h-5"/>
                        <h1 class="text-lg font-semibold">Cancel Edit</h1>
                    </a>
                </div>

                <div class="edit-box w-full">
                    @if(str_contains(Request::url(), 'personal-data'))
                        @include('portal.profile-edit.personal-data')
                    @elseif (str_contains(Request::url(), 'contact-information'))
                        @include('portal.profile-edit.contact-information')
                    @elseif (str_contains(Request::url(), 'provincial-contact'))
                        @include('portal.profile-edit.provincial-contact')
                    @elseif (str_contains(Request::url(), 'accounting-details'))
                        @include('portal.profile-edit.accounting-details') 
                    @elseif (str_contains(Request::url(), 'emergency'))
                        @include('portal.profile-edit.emergency-information')
                    @endif
                </div> 
            </div>
        </div>
    </div>
</x-app-layout>
