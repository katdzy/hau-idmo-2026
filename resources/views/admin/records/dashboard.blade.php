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

                    <span class="text-gray-400 font-semibold">User Management</span>
                    <section class="w-full flex pt-1 pb-4 gap-4">
                        <a href="{{ route('admin.users') }}" class="w-[20%] maroon flex flex-col justify-center items-center py-8 rounded-lg">
                            <img class="w-[80px] h-[80px]" src="{{ asset('images/icons/portal_nav/records.png') }}" alt="View All Users">
                            <h1 class="text-white">View All Users</h1>
                        </a>

                        <a href="{{ route('admin.users.add') }}" class="w-[20%] maroon flex flex-col justify-center items-center py-8 rounded-lg">
                            <img class="w-[80px] h-[80px]" src="{{ asset('images/icons/add_to_user.png') }}" alt="Add User">
                            <h1 class="text-white">Add User</h1>
                        </a>

                        <a href="{{ route('admin.users.addMultiple') }}" class="w-[20%] maroon flex flex-col justify-center items-center py-8 rounded-lg">
                            <img class="w-[80px] h-[80px]" src="{{ asset('images/icons/group_add.png') }}" alt="Add Multiple Users">
                            <h1 class="text-white">Add Multiple Users</h1>
                        </a>

                        <a href="{{ route('admin.orgs') }}" class="w-[20%] maroon flex flex-col justify-center items-center py-8 rounded-lg">
                            <img class="w-[80px] h-[80px]" src="{{ asset('images/icons/portal_nav/organization.png') }}" alt="User Organizations">
                            <h1 class="text-white">User Organizations</h1>
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
        const msgElement = document.querySelector(".msg");
        if (msgElement) {
            msgElement.style.display = 'none';
        }
    }, 5000);
</script>
