@props(['route', 'icon', 'title', 'excludedRoles' => []])

@php
    $canView = true;
    if (!empty($excludedRoles) && Auth::check()) {
        $canView = !in_array(Auth::user()->role, $excludedRoles);
    }
@endphp

@if($canView)
    <a href="{{ route($route) }}" class="block w-full h-full group">
        <div class="w-full h-full flex flex-col justify-center items-center 
            bg-[#70121D] hover:bg-[#8B2B39] 
            rounded-[25px] text-white text-center 
            leading-4 transition-all duration-300 p-4">
            <div class="mb-2">
                <img src="{{ asset($icon) }}" alt="{{ $title }}" class="w-16 h-16 md:w-24 md:h-24 transition-transform duration-300 group-hover:scale-110"/>
            </div>
            <div>
                <h3 class="text-base font-semibold">{{ $title }}</h3>
            </div> 
        </div>
    </a> 
@endif