@props(['nav' => 'nav', 'route', 'icon', 'title', 'excludedRoles' => []])

@php
    $canView = true;
    if (!empty($excludedRoles) && Auth::check()) {
        $canView = !in_array(Auth::user()->role, $excludedRoles);
    }
@endphp

@if($canView)
    @if($nav === "portal")
        <a href="{{ route($route) }}" class="{{ request()->routeIs($route . '*') ? 'font-semibold' : '' }}">
            <div class="nav-link transition-[background-color] duration-200 w-full flex rounded-[5px] items-center hover:bg-[#8A2B36]">
                <img src="{{ asset($icon) }}" class="w-[25px] h-[25px] m-[0.7rem]" />
                <h3 class="text-base">{{ $title }}</h3>
            </div>
        </a> 

        <style> 
            .font-semibold > .nav-link {
                background-color: #bc0a18;
                font-weight: 700;
            }
        </style>
    @else
        <a href="{{ route($route) }}" class="{{ request()->routeIs($route . '*') ? 'bg-[#bc0a18]' : '' }}">
            <div class="w-full flex items-center 
                        transition-all duration-200 
                        hover:bg-[#8A2B36]">

                <img class="w-[25px] h-[25px] m-[0.7rem]" src="{{ asset($icon) }}" alt="{{ $title }}">

                <h3 class="text-base">{{ $title }}</h3>
            </div>
        </a>
    @endif
@endif