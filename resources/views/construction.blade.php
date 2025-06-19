<x-app-layout>
    <div class="min-h-screen flex items-center justify-center relative">
        <!-- Fullscreen background image -->
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-white opacity-75"></div>
        </div>

        <!-- Under Construction Card -->
        <div class="z-10 bg-white rounded-lg shadow-lg p-8 text-center mx-4">
            <!-- Under Construction illustrative image -->
            <img src="{{ asset('images/under_construction.png') }}" alt="Under Construction" class="mx-auto mb-4" style="max-width:200px;">
            
            <!-- Under Construction Text -->
            <h1 class="text-3xl font-bold mb-2 text-gray-800">We're Under Construction</h1>
            <p class="text-gray-600 mb-4">This section is currently undergoing maintenance and improvements. Please check back soon!</p>
        </div>
    </div>
</x-app-layout>

<style>
    /* Optional: Additional custom styling */
    html, body {
        margin: 0;
        padding: 0;
        height: 100%;
    }
</style>
