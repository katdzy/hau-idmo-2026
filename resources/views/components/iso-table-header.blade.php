@props(['field', 'label'])

<th {{ $attributes->merge(['class' => 'px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider cursor-pointer select-none group']) }}
    onclick="sortTable('{{ $field }}')">
    <div class="flex items-center gap-2 transform transition-transform duration-75 active:scale-95">
        <span class="group-hover:text-gray-900 transition-colors">
            {{ $label ?? $slot }}
        </span>
        <div class="relative w-4 h-4">
            <svg id="sort_icon_{{ $field }}" 
                 class="sort-icon w-3.5 h-3.5 opacity-0 group-hover:opacity-40 transition-all duration-300 ease-in-out" 
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 15l7-7 7 7" />
            </svg>
        </div>
    </div>
</th>
