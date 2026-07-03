@extends('layouts.main')

@section('title', 'Information Hub')

@section('content')
<div style="background-image: url('{{ asset('images/hau-side.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat; position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -1; opacity: 0.3;"></div>
    <div class="max-w-6xl mx-auto py-10 px-4" style="position: relative; z-index: 1; background-color: rgba(255, 255, 255, 0.9); border-radius: 1rem; backdrop-filter: blur(10px); margin-top: 2rem;">
        <!-- Header -->
        <div class="text-center mb-6">
            <img src="{{ asset('images/logo-circle.png') }}" class="mx-auto mb-4" alt="Logo Circle" style="width: 180px; height: 180px; object-fit: contain;" />
            <h1 class="text-2xl font-bold" style="color: #70121D;">Information Hub</h1>
            <p class="mt-2" style="color: #5c5c5c;">Access institutional Information Hub and resources</p>
        </div>
        
        <hr class="opacity-100 my-4">

        <!-- Tabs -->
        <div class="mb-6">
            <ul class="flex border-b justify-start" id="tabs">
                @foreach ($categories as $i => $cat)
                    <li class="-mb-px mr-2">
                        <button class="tab-btn {{ $i === 0 ? 'active' : '' }}" data-tab="tab-{{ Str::slug($cat, '-') }}">
                            {{ $cat }}
                        </button>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Search Bar -->
        <div class="mb-6">
            <div class="relative">
                <input
                    type="text"
                    id="information-hub-search"
                    placeholder="Search Information Hub Sites..."
                    class="w-full rounded-lg px-4 py-3 pr-16 shadow-sm text-sm focus:outline-none"
                    style="border: 2px solid #70121D; focus:ring: 2px solid #8B1538;"
                    autocomplete="off"
                />
                <button type="button" id="clear-information-hub-search" class="absolute right-2 px-3 py-1 rounded-lg text-xs font-semibold transition" style="top: 50%; transform: translateY(-50%); background-color: #ffe066; color: #70121D; hover:background-color: #ffd700;">
                    Clear
                </button>
            </div>
            <div id="search-results" class="hidden mt-4">
                <h3 class="text-lg font-semibold mb-3" style="color: #70121D;">Search Results:</h3>
                <div id="search-results-content" class="space-y-2"></div>
            </div>
        </div>

        @foreach ($categories as $i => $cat)
            <div id="tab-{{ Str::slug($cat, '-') }}" class="tab-content {{ $i === 0 ? '' : 'hidden' }}" style="border: 2px solid #70121D; border-radius: 0.75rem; padding: 1.5rem;">
                <div class="w-full flex flex-col gap-6">
                    <ul class="space-y-6">
                        @foreach (($linksByCategory[$cat] ?? []) as $subCategory => $subCatLinks)
                            <li>
                                @if ($subCategory)
                                    {{-- Show collapsible button if subcategory exists --}}
                                    <button type="button" class="subcategory-btn w-full text-left font-bold px-4 py-2 rounded transition mb-4">
                                        {{ $subCategory }}
                                    </button>
                                    <div class="ml-6 hidden link-list grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                                        @foreach ($subCatLinks as $link)
                                            <div class="link-card bg-white border border-gray-200 rounded-2xl p-6 md:p-8 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 flex flex-row items-center gap-6 md:gap-8">
                                                <span class="link-meta hidden" data-type="{{ $link->type }}" data-image="{{ $link->image_path ? asset($link->image_path) : '' }}"></span>
                                                @if ($link->type === 'Video')
                                                    <div class="w-32 h-24 md:w-44 md:h-32 bg-gradient-to-br from-red-50 to-red-100 border border-red-200 rounded-xl shadow-sm flex items-center justify-center flex-shrink-0 text-red-700">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12 md:w-16 md:h-16 transition-transform duration-300 hover:scale-110">
                                                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm14.024-.986a.75.75 0 0 1 0 1.972l-5.677 3.195A.75.75 0 0 1 9.5 15.521V9.48a.75.75 0 0 1 1.097-.66l5.677 3.194Z" clip-rule="evenodd" />
                                                        </svg>
                                                    </div>
                                                @else
                                                    @php
                                                        $imageClass = 'w-28 h-28 md:w-36 md:h-36 object-cover rounded-xl shadow-md border border-gray-200 flex-shrink-0'; // default
                                                        if ($link->type === 'Document') {
                                                            $imageClass = 'w-32 h-44 md:w-40 md:h-56 object-cover rounded-xl shadow-md border border-gray-200 flex-shrink-0';
                                                        }
                                                    @endphp
                                                    <img src="{{ asset($link->image_path) }}" class="{{ $imageClass }}" alt="{{ $link->title }}" data-type="{{ $link->type }}"/>
                                                @endif
                                                <div class="flex flex-col flex-grow justify-between min-h-[140px] py-1">
                                                    <div>
                                                        <h4 class="link-card-title text-lg md:text-2xl font-bold text-red-950 hover:text-red-700 transition leading-snug mb-2 line-clamp-2">
                                                            {{ $link->title }}
                                                        </h4>
                                                        <p class="text-xs md:text-sm text-gray-500 font-medium mb-4">
                                                            {{ $link->sub_category ?: ($link->type ?: 'Access Resource') }}
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <a href="{{ $link->url }}" target="_blank" class="inline-flex items-center text-xs md:text-sm font-semibold text-red-700 hover:text-red-900 transition-colors">
                                                            [ Click here to view ]
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    {{-- No subcategory - show links directly without button --}}
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 my-2">
                                        @foreach ($subCatLinks as $link)
                                            <div class="link-card bg-white border border-gray-200 rounded-2xl p-6 md:p-8 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 flex flex-row items-center gap-6 md:gap-8">
                                                <span class="link-meta hidden" data-type="{{ $link->type }}" data-image="{{ $link->image_path ? asset($link->image_path) : '' }}"></span>
                                                @if ($link->type === 'Video')
                                                    <div class="w-32 h-24 md:w-44 md:h-32 bg-gradient-to-br from-red-50 to-red-100 border border-red-200 rounded-xl shadow-sm flex items-center justify-center flex-shrink-0 text-red-700">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12 md:w-16 md:h-16 transition-transform duration-300 hover:scale-110">
                                                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm14.024-.986a.75.75 0 0 1 0 1.972l-5.677 3.195A.75.75 0 0 1 9.5 15.521V9.48a.75.75 0 0 1 1.097-.66l5.677 3.194Z" clip-rule="evenodd" />
                                                        </svg>
                                                    </div>
                                                @else
                                                    @php
                                                        $imageClass = 'w-28 h-28 md:w-36 md:h-36 object-cover rounded-xl shadow-md border border-gray-200 flex-shrink-0'; // default
                                                        if ($link->type === 'Document') {
                                                            $imageClass = 'w-32 h-44 md:w-40 md:h-56 object-cover rounded-xl shadow-md border border-gray-200 flex-shrink-0';
                                                        }
                                                    @endphp
                                                    <img src="{{ asset($link->image_path) }}" class="{{ $imageClass }}" alt="{{ $link->title }}" data-type="{{ $link->type }}"/>
                                                @endif
                                                <div class="flex flex-col flex-grow justify-between min-h-[140px] py-1">
                                                    <div>
                                                        <h4 class="link-card-title text-lg md:text-2xl font-bold text-red-950 hover:text-red-700 transition leading-snug mb-2 line-clamp-2">
                                                            {{ $link->title }}
                                                        </h4>
                                                        <p class="text-xs md:text-sm text-gray-500 font-medium mb-4">
                                                            {{ $link->sub_category ?: ($link->type ?: 'Access Resource') }}
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <a href="{{ $link->url }}" target="_blank" class="inline-flex items-center text-xs md:text-sm font-semibold text-red-700 hover:text-red-900 transition-colors">
                                                            [ Click here to view ]
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach

        <!-- Login Link -->
        <div class="mt-8 text-center">
            <a href="{{ route('login') }}" class="login-btn inline-block px-6 py-3 rounded-md text-white hover:bg-red-600 transition">
                Login to Access Full System
            </a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize tabs functionality
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                // Clear search first if there's an active search
                if (searchInput.value.trim() !== '') {
                    searchInput.value = '';
                    searchResults.classList.add('hidden');
                }
                
                // Reset all tab styles and content visibility
                document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(tc => {
                    tc.classList.add('hidden');
                    tc.style.display = '';
                });
                
                // Activate the clicked tab
                btn.classList.add('active');
                const targetTab = document.getElementById(btn.getAttribute('data-tab'));
                if (targetTab) {
                    targetTab.classList.remove('hidden');
                }
            });
        });

        // Initialize collapsible subcategory sections
        document.querySelectorAll('.subcategory-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const linkList = this.nextElementSibling;
                document.querySelectorAll('.link-list').forEach(list => {
                    if (list !== linkList) list.classList.add('hidden');
                });
                linkList.classList.toggle('hidden');
            });
        });
    });

    // Search functionality
    const searchInput = document.getElementById('information-hub-search');
    const clearSearchBtn = document.getElementById('clear-information-hub-search');
    const searchResults = document.getElementById('search-results');
    const searchResultsContent = document.getElementById('search-results-content');
    const tabContents = document.querySelectorAll('.tab-content');

    function performSearch() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        
        if (searchTerm === '') {
            // Show normal tabs, hide search results
            searchResults.classList.add('hidden');
            // Restore normal tab functionality - show only the active tab
            tabContents.forEach(content => {
                content.style.display = '';
                content.classList.add('hidden');
            });
            // Show the currently active tab
            const activeTabBtn = document.querySelector('.tab-btn.active');
            if (activeTabBtn) {
                const activeTabId = activeTabBtn.getAttribute('data-tab');
                const activeTab = document.getElementById(activeTabId);
                if (activeTab) {
                    activeTab.classList.remove('hidden');
                }
            }
            return;
        }

        // Hide tab contents, show search results
        tabContents.forEach(content => {
            content.style.display = 'none';
            content.classList.add('hidden');
        });
        searchResults.classList.remove('hidden');
        
        // Clear previous results
        searchResultsContent.innerHTML = '';

        // Search through all link items by title
        const allLinkContainers = document.querySelectorAll('.tab-content .link-card');
        let resultsHTML = '';
        let hasResults = false;

        allLinkContainers.forEach(container => {
            // Get the title element
            const titleElement = container.querySelector('.link-card-title');
            if (!titleElement) return;
            
            const title = titleElement.textContent.trim();
            const titleLower = title.toLowerCase();
            
            // Check if title matches search term
            if (titleLower.includes(searchTerm)) {
                hasResults = true;
                
                // Get image src, type, and link info via metadata
                const meta = container.querySelector('.link-meta');
                const imgType = meta ? meta.getAttribute('data-type') : '';
                const imgSrc = meta ? meta.getAttribute('data-image') : '';
                const link = container.querySelector('a[href]');
                const linkHref = link ? link.getAttribute('href') : '';
                
                // Get subcategory if exists
                let subCategoryOriginal = '';
                const linkLi = container.closest('li');
                if (linkLi) {
                    let currentElement = linkLi;
                    while (currentElement) {
                        const subCategoryBtn = currentElement.querySelector('.subcategory-btn');
                        if (subCategoryBtn) {
                            subCategoryOriginal = subCategoryBtn.textContent.trim();
                            break;
                        }
                        currentElement = currentElement.parentElement?.closest('li');
                    }
                }
                
                // Determine image or icon based on type
                let mediaHTML = '';
                if (imgType === 'Video') {
                    mediaHTML = `
                        <div class="w-32 h-24 md:w-44 md:h-32 bg-gradient-to-br from-red-50 to-red-100 border border-red-200 rounded-xl shadow-sm flex items-center justify-center flex-shrink-0 text-red-700">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12 md:w-16 md:h-16 transition-transform duration-300 hover:scale-110">
                                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm14.024-.986a.75.75 0 0 1 0 1.972l-5.677 3.195A.75.75 0 0 1 9.5 15.521V9.48a.75.75 0 0 1 1.097-.66l5.677 3.194Z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    `;
                } else {
                    let imageClass = 'w-28 h-28 md:w-36 md:h-36 object-cover rounded-xl shadow-md border border-gray-200 flex-shrink-0';
                    if (imgType === 'Document') {
                        imageClass = 'w-32 h-44 md:w-40 md:h-56 object-cover rounded-xl shadow-md border border-gray-200 flex-shrink-0';
                    }
                    mediaHTML = `<img src="${imgSrc}" class="${imageClass}" alt="${title}" data-type="${imgType}"/>`;
                }

                resultsHTML += `
                    <div class="link-card bg-white border border-gray-200 rounded-2xl p-6 md:p-8 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 flex flex-row items-center gap-6 md:gap-8">
                        ${mediaHTML}
                        <div class="flex flex-col flex-grow justify-between min-h-[140px] py-1">
                            <div>
                                <h4 class="link-card-title text-lg md:text-2xl font-bold text-red-950 hover:text-red-700 transition leading-snug mb-2 line-clamp-2">
                                    ${highlightText(title, searchTerm)}
                                </h4>
                                <p class="text-xs md:text-sm text-gray-500 font-medium mb-4">
                                    ${subCategoryOriginal ? subCategoryOriginal : (imgType ? imgType : 'Access Resource')}
                                </p>
                            </div>
                            <div>
                                <a href="${linkHref}" target="_blank" class="inline-flex items-center text-xs md:text-sm font-semibold text-red-700 hover:text-red-900 transition-colors">
                                    [ Click here to view ]
                                </a>
                            </div>
                        </div>
                    </div>
                `;
            }
        });

        if (hasResults) {
            searchResultsContent.innerHTML = `
                <div style="border: 2px solid #70121D; border-radius: 0.75rem; padding: 1.5rem;">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        ${resultsHTML}
                    </div>
                </div>
            `;
        } else {
            searchResultsContent.innerHTML = '<div class="p-4 text-center text-gray-500">No Information Hub links found matching your search.</div>';
        }
    }

    function highlightText(text, searchTerm) {
        if (!searchTerm) return text;
        
        const tempDiv = document.createElement('div');
        tempDiv.textContent = text;
        
        const plainText = tempDiv.textContent;
        const regex = new RegExp(`(${searchTerm.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')})`, 'gi');
        
        const parts = plainText.split(regex);
        const fragment = document.createDocumentFragment();
        
        parts.forEach((part, index) => {
            if (index % 2 === 1) {
                const span = document.createElement('span');
                span.className = 'search-highlight px-1 rounded';
                span.style.backgroundColor = '#8B1538';
                span.style.color = '#ffffff';
                span.style.padding = '0.15rem 0.25rem';
                span.style.borderRadius = '0.25rem';
                span.textContent = part;
                fragment.appendChild(span);
            } else {
                fragment.appendChild(document.createTextNode(part));
            }
        });
        
        const container = document.createElement('div');
        container.appendChild(fragment);
        return container.innerHTML;
    }

    searchInput.addEventListener('input', performSearch);
    
    clearSearchBtn.addEventListener('click', () => {
        searchInput.value = '';
        performSearch();
        searchInput.focus();
    });
</script>

<style>
    /* HAU Colors */
    .subcategory-btn {
        background-color: #f5f5f5 !important;
        color: #70121D !important;
        transition: all 0.3s ease;
    }
    
    .subcategory-btn:hover {
        background-color: #e5e5e5 !important;
    }

    /* Information Hub Links with HAU gold */
    a[href*="information-hub"], a[href*="onedrive"] {
        background-color: #ffe066 !important;
        color: #70121D !important;
        transition: all 0.3s ease;
    }

    a[href*="information-hub"]:hover, a[href*="onedrive"]:hover {
        background-color: #ffd700 !important;
        color: #70121D !important;
    }

    /* Custom CSS for consistency with HAU branding */
    .login-btn {
        background-color: #70121D;
    }

    .tab-btn {
        background-color: white;
        padding: 0.5rem 1rem;
        font-weight: 600;
        color: #70121D;
        border: 1px solid #70121D;
        border-bottom: none;
        border-top-left-radius: 0.5rem;
        border-top-right-radius: 0.5rem;
        transition: all 0.3s ease;
    }

    .tab-btn.active {
        background-color: #ffe066;
        border-bottom: 2px solid #70121D;
        color: #70121D;
    }

    .tab-btn:hover:not(.active) {
        background-color: #f9f9f9;
    }

    .tab-content {
        animation: fadeIn 0.2s;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    /* Search results styling */
    #search-results-content .text-blue-600 {
        color: #70121D !important;
    }

    #search-results-content .text-blue-600:hover {
        color: #8B1538 !important;
    }

    .search-highlight {
        background-color: #8B1538;
        color: #ffffff !important;
        padding: 0.15rem 0.25rem;
        border-radius: 0.25rem;
    }

    #search-results-content a[href] {
        background-color: transparent !important;
        color: #70121D !important;
        padding: 0;
        border-radius: 0;
        text-decoration: none;
    }

    #search-results-content a[href]:hover {
        background-color: transparent !important;
        color: #8B1538 !important;
        text-decoration: none;
    }

    /* Custom Scrollbar Styles */
    .tab-content::-webkit-scrollbar {
        width: 12px;
    }

    .tab-content::-webkit-scrollbar-track {
        background: transparent;
        border: none;
    }

    .tab-content::-webkit-scrollbar-thumb {
        background: linear-gradient(180deg, #70121D, #8B1538);
        border-radius: 10px;
        border: none;
        transition: all 0.3s ease;
    }

    .tab-content::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(180deg, #8B1538, #70121D);
    }

    .tab-content::-webkit-scrollbar-corner {
        background: transparent;
    }

    .tab-content::-webkit-scrollbar-button {
        display: none;
    }

    .tab-content {
        scrollbar-width: thin;
        scrollbar-color: #70121D transparent;
    }
</style>
@endsection

@php
$useWhiteOverlay = false;
@endphp