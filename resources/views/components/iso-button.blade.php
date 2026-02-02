@props([
    'onClick' => '',
    'color' => 'blue',
    'label' => '',
])

<button
    onclick = {{ $onClick }}
    {{ $attributes->merge([
        'class' => "w-full flex items-center justify-center gap-2 px-4 py-3 bg-{$color}-600 hover:bg-{$color}-700 text-white font-semibold rounded-lg shadow-mg transition duration-200"
    ]) }}
>
    {{ $slot }}
    <span>{{ $label }} </span>
</button>