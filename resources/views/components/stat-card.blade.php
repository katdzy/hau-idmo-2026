@props([
    'title',
    'value',
    'color' => 'blue',
    'icon' => null
])

@php
    // Define color variants
    $colors = [
        'blue' =>[
            'bg' => 'from-blue-50 to-blue-100',
            'border' => 'border-blue-200',
            'text' => 'text-blue-600',
            'heading' => 'text-blue-700',
            'icon-bg' => 'bg-blue-500'
        ],
        'emerald' =>[
            'bg' => 'from-emerald-50 to-emerald-100',
            'border' => 'border-emerald-200',
            'text' => 'text-emerald-600',
            'heading' => 'text-emerald-700',
            'icon-bg' => 'bg-emerald-500'
        ],
        'rose' => [
            'bg' => 'from-rose-50 to-rose-100',
            'border' => 'border-rose-200',
            'text' => 'text-rose-600',
            'heading' => 'text-rose-700',
            'icon-bg' => 'bg-rose-500'
        ],
        'red' => [
            'bg' => 'from-red-50 to-red-100',
            'border' => 'border-red-200',
            'text' => 'text-red-600',
            'heading' => 'text-red-700',
            'icon-bg' => 'bg-red-500'
        ],
        'green' => [
            'bg' => 'from-green-50 to-green-100',
            'border' => 'border-green-200',
            'text' => 'text-green-600',
            'heading' => 'text-green-700',
            'icon-bg' => 'bg-green-500'
        ],
        'yellow' => [
            'bg' => 'from-yellow-50 to-yellow-100',
            'border' => 'border-yellow-200',
            'text' => 'text-yellow-600',
            'heading' => 'text-yellow-700',
            'icon-bg' => 'bg-yellow-500'
        ],
    ];

    $colorClasses = $colors[$color] ?? $colors['blue'];
@endphp

<div class="bg-gradient-to-br {{ $colorClasses['bg'] }} border {{ $colorClasses['border'] }} rounded-lg p-4 shadow-sm">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm {{ $colorClasses['text'] }} font-medium mb-1">{{ $title }}</p>
            <h3 class="text-3xl font-bold {{ $colorClasses['heading'] }}">{{ $value }}</h3>
        </div>
        <div class= "{{ $colorClasses['icon-bg'] }} text-white rounded-full p-3">
            @if($icon)
                {!! $icon !!}
            @else
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 2a2 2 0 00-2 2v8a2 2 0 002 2h6a2 2 0 002-2V6.414A2 2 0 0016.414 5L14 2.586A2 2 0 0012.586 2H9z"/>
                    <path d="M3 8a2 2 0 012-2v10h8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z"/>
                </svg>
            @endif
        </div>
    </div>
</div>