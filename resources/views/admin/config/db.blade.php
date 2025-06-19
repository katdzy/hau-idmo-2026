<x-app-layout>
    <div class="min-h-screen">
        <div class="w-full flex justify-center py-8">
            <div class="w-[95%] flex flex-col bg-white rounded-lg">
                <div class="w-full px-8 py-4 flex flex-col">
                    <h1 class="text-[1.5rem] font-bold text-gray-600 mb-4">Tools</h1>

                    @if(isset($msg))
                        <span class="msg w-[100%] bg-green-600 text-white rounded-lg px-4 py-2 my-4">
                            {{$msg}}
                        </span>
                    @endif

                    <span class="text-gray-400 font-semibold">Registry</span>
                    <section class="w-full flex pt-1 pb-4 gap-4">
                        <a href="{{ route('admin.registry.dept') }}" class="w-[20%] maroon flex flex-col justify-center items-center py-8 rounded-lg">
                            <img class="w-[100px] h-[100px]" src="{{ asset('images/logo-circle.png') }}" alt="Departments">
                            <h1 class="text-white">Departments</h1>
                        </a>

                        <a href="{{ route('admin.sem') }}" class="w-[20%] maroon flex flex-col justify-center items-center py-8 rounded-lg">
                            <img class="w-[100px] h-[100px]" src="{{ asset('images/icons/calendar.png') }}" alt="Semesters">
                            <h1 class="text-white">Semesters</h1>
                        </a>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .maroon {
        background-color: maroon;
        transition: 300ms;
    }

    .maroon:hover {
        background-color: #A84655;
    }
</style>

<script>
    setTimeout(() => {
        document.querySelector(".msg").style.display = 'none';
    }, 5000);
</script>
