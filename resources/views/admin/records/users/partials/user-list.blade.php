@foreach($users as $user)
    <div class="w-full flex items-center">
        <div class="w-3/4 flex items-center gap-2 py-2">
            @if($user->profile_picture != '')
                <img src="{{ asset('storage/profile_pictures/' . $user->profile_picture) }}?v={{ $user->updated_at->timestamp }}" class="w-[30px] h-[30px] rounded-full" alt="User Image"/>
            @else
                <img src="{{ asset('images/blankdp.jpg') }}" class="w-[30px] h-[30px] rounded-lg" alt="User Image"/>
            @endif
            <h1 class="text-lg font-semibold">
                <!-- Fix Displaying Null -->
                {{ $user->full_name }}
            </h1>
            <span class="text-sm text-gray-400">
                {{ $user->login->email }}
            </span>
        </div>
        <div class="w-1/4 flex items-center justify-end gap-4">
            <span class="text-sm text-gray-400">
                {{ $user->login->role }}, 
                <strong class="uppercase">{{ $user->emp_dept }}</strong>
            </span>
            <a href="{{ route('admin.users.view', ['id' => $user->emp_id]) }}" class="bg-gray-900 hover:bg-gray-700 p-2 rounded-xl" title="View Profile">
                <img src="{{ asset('images/icons/view.svg') }}" class="w-[25px] h-[25px]" alt="View Icon">
            </a>
        </div>
    </div>
    <hr class="opacity-60 my-2">
@endforeach
