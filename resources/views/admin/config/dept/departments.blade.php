<!-- resources/views/admin/config/dept/departments.blade.php -->
<x-app-layout>
<div class="min-h-screen">
    <div class="w-full flex justify-center py-8">
        <div class="w-[95%] flex flex-col bg-white rounded-lg p-8">
            <!-- title header  -->    
            <a href="{{ route('admin.registry') }}" class="w-[15%] rounded-lg flex items-center justify-center py-2 bg-red-900 text-white font-bold gap-1 hover:bg-red-700">
                <img src="{{ asset('images/icons/back.png') }}" class="w-[20px] h-[20px]" alt="">
                Back
            </a>
            <div class="w-full flex flex-col items-center leading-tight">
                <img src="{{ asset('images/hau-logo.png') }}" class="w-[100px] h-[100px] mr-2"/> 
                <h1 class="text-red-900 text-lg font-extrabold"> Holy Angel University </h1>
                <span class="text-gray-600 text-[1rem]"> List of Departments</span>
                <span class="text-gray-400 text-[0.8rem]"> Last Updated: {{$u_at}}</span>
        
                <div class="w-full flex justify-center my-4 gap-2">
                    <a href="{{ route('admin.registry.dept.edit.all') }}" class="relative flex justify-center items-center bg-gray-500 hover:bg-gray-600 text-white px-12 py-2 gap-4" id="btn">
                        <img src="{{ asset('images/icons/upload_csv.png') }}" class="w-[25px] h-[25px]" alt="">
                        <span>Update Records</span>
                    </a>
                    <a href="{{ asset('documents/department_templates/HAU-IDMO_Deparments_MasterList_Template.xlsx') }}" class="flex justify-center items-center bg-gray-500 hover:bg-gray-600 text-white px-12 py-2 gap-4">
                        <img src="{{ asset('images/icons/download.svg') }}" class="w-[20px] h-[20px]" alt="">
                        <span>Download Template</span>
                    </a>
                </div>
            </div>

            @if(isset($msg) && $msg != '')
                <span class="w-full rounded-xl bg-green-600 text-white py-1 px-4" id="msg">
                    {{$msg}}
                </span>
                {{ session()->forget('msg') }}
            @endif

            <hr class="opacity-100 mb-4"> 

            <!-- Search Bar -->
            <input type="text" id="search" placeholder="Search Department..." class="w-full border border-gray-300 p-2 rounded-md mb-4">

            <!-- table -->
            <div class="w-full flex flex-col border border-gray-200 gap-0">
                <!-- header -->
                <div class="w-full bg-red-900 text-white grid grid-cols-[10%_10%_55%] p-2">
                    <h1></h1>
                    <h1>ID</h1>
                    <h1>Department</h1>
                </div>

                <!-- AJAX-loaded data: table body & pagination -->
                <div id="dept-container">
                    @include('admin.config.dept.departments-data', ['dept' => $dept])
                </div>
            </div>
        </div>
    </div> 
</div>
</x-app-layout>

<style> 
    a, button { 
        transition: 300ms;
    }
    .show { 
        display: flex; 
        flex-direction: column;
    }
    .hide {
        display: none;
    }
</style> 

<script>
    // Toggle function (if used elsewhere)
    function showToggle(){ 
        let dp = document.getElementById('dp'); 
        if(dp.classList.contains('hide')) { 
            dp.classList.remove('hide'); 
            dp.classList.add('show');
        } else { 
            dp.classList.add('hide'); 
            dp.classList.remove('show');
        }
    }

    let dp = document.getElementById('dp'); 
    let btn = document.getElementById('btn');
    document.body.addEventListener("click", (event) => { 
        if(!dp.contains(event.target) && !btn.contains(event.target)) { 
            dp.classList.add('hide');
            dp.classList.remove('show');
        }
    }); 

    let debounceTimer;
    document.getElementById('search').addEventListener('input', function() {
        let searchQuery = this.value;

        // Clear the previous timer whenever the user types
        clearTimeout(debounceTimer);

        // Set a new timer to call fetchSubjects after 2 seconds of no typing
        debounceTimer = setTimeout(function() {
            fetchSubjects(searchQuery);
        }, 2000);
    });

    // Function to fetch departments data (either all paginated or search results paginated)
    function fetchSubjects(query, url = `{{ route('admin.dept.search') }}`) {
        const fullUrl = url + '?query=' + encodeURIComponent(query);
        fetch(fullUrl, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('dept-container').innerHTML = data.html;
        })
        .catch(error => console.error('Error:', error));
    }

    // Intercept pagination link clicks for AJAX-based pagination
    document.addEventListener('click', function(e) {
        let paginationLink = e.target.closest('.pagination a');
        if (paginationLink) {
            e.preventDefault();
            let url = paginationLink.getAttribute('href');
            let query = document.getElementById('search').value;
            fetchSubjects(query, url);
        }
    });

    // Hide the message element after 5 seconds if present
    let msgElement = document.getElementById('msg');
    if (msgElement) {
        setTimeout(() => { 
            msgElement.style.display = 'none'; 
        }, 5000);
    }

    // Confirmation before deletion
    function confirmDelete(button) { 
        const form = button.closest('form'); 
        if (confirm('Are you sure you want to delete this department?')) {  
            form.submit(); 
        }
    }

    function edit_dept(button) { 
        button.closest('form').submit();
    }
</script>
