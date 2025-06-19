<x-app-layout>
<div class="min-h-screen">
    <div class="w-full flex justify-center py-8">
        <div class="w-[95%] flex flex-col p-8 rounded-xl bg-white">
            <div class="w-full flex flex-col py-2">
                <form action="{{ route('admin.subjects.view') }}" method = "GET">
                    @csrf
                    <button type="submit" class="flex items-center justify-center bg-red-900 hover:bg-red-700 text-white py-2 w-[15%] transition duration-300">
                        <input type="hidden" name="id" value="{{ $subj->subj_code }}">
                        <img src="{{ asset('images/icons/back.png') }}" class="w-5 h-5"/>
                        <h3 class="uppercase ml-1">Back</h3>
                    </button>
                </form>
            </div>
            <span class="text-[0.8rem] text-gray-400">Load Subject to User</span>
            <h1 class="text-xl text-gray-600 font-bold"><strong>{{$subj->subj_code}} </strong> - {{$subj->subj_title}} ( Units: {{$subj->units}}.00  )</h1>

            <hr class="w-full opacity-60 my-4">
            <div class="w-full flex flex-col justify-start mb-4">

            <form action="{{route('admin.subjects.loadsearch',['subj'=> $subj->subj_id])}}" class="w-full flex flex-col" method ="GET">
                @csrf
                @method('GET')
                <span class="font-semibold text-gray-400"> Search for specific user </span>
                <div class="formrow w-full flex">
                    <input id="search" type="text" name="emp_id" placeholder="Enter Employee ID..." class="w-[50%]">
                    <button type="submit" class="bg-red-900 text-white hover:bg-red-800 px-6"> Load Requests </button>
                    <div class="search-results"></div> 
                </div>
                @if(isset($user_not_found))
                    <span> {{$user_not_found}} </span>
                @endif
            </form> 
            </div>
            
            @if(isset($user)) 

            <hr class="w-full opacity-60 mb-4">

            <span class="text-[0.8rem] text-gray-400 font-semibold mb-2 ">User Details</span>
            <div class="flex justify-start gap-4 mb-4">
<!-- Here below -->
                <img src="{{asset('storage/profile_pictures/' . $user->profile_picture)}}?v={{ $user->updated_at->timestamp }}" class="w-[120px] h-[120px] rounded-[50%]"/>
                <div class="flex flex-col items-start justify-center text-gray-700 font-bold gap-0 leading-tight">
                    <h1> {{$user->emp_id}}</h1>
<!-- changed below -->
                    <h1> {{ $user->full_name }}</h1> 
                    <h1> {{$user->login->email}}</h1>
                </div> 
            </div>

            <!-- School Year and Semester -->
            <form action="{{route('admin.subjects.loadtouser')}}" method="POST" >
                @csrf   
                @method('POST')

                <input type="hidden" value="{{$subj->subj_id}}" name="subj">
                <input type="hidden" value="{{$user-> emp_id}}" name="user">

                <span class="text-[0.8rem] text-gray-400 font-semibold mb-2 ">School Year </span>
                <div>
                    <input type="text" name="sy_start" placeholder="XXXX" class="w-20 text-center border-gray-300 " style="margin-bottom: 10px;" required>
                    <span class="text-gray-500 font-semibold">-</span>
                    <input type="text" name="sy_end" placeholder="XXXX" class="w-20 text-center border-gray-300 " style="margin-bottom: 10px;" required>
                </div>

                <span class="text-[0.8rem] text-gray-400 font-semibold mb-2 ">Semester </span>
                <div class="w-[20%]">
                    <select name="sem" class="w-full mb-2 border-gray-300" required>
                        <option value="" disabled selected>Select Semester</option>
                        @foreach($semesters as $item)
                            <option value="{{$item->item}}">{{$item->item}}</option>
                        @endforeach
                    </select>
                </div>

                <span class="text-[0.8rem] text-gray-400 font-semibold mb-2 " required>Class Code </span>
                <div class="w-[20%]">
                    <input type="text" name="class_code" class="w-full mb-2 border-gray-300 " placeholder="Enter class code">
                </div>

                <span class="text-[0.8rem] text-gray-400 font-semibold mb-2 ">Class Department </span>
                <div class="w-[25%]">
                    <select name="class_dept" class="w-full mb-2 border-gray-300" required>
                        <option value="" disabled selected>Select Class Department</option>
                        @foreach($depts as $item)
                            <option value="{{$item->code}}"@if($admin_role == "Dean" && $admin_dept == $item->code) selected @endif>{{$item->dept}}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Current Loads -->
                <span class="text-[0.8rem] text-gray-400 font-semibold mb-2 ">Current Loads</span>
                <div class="container mx-auto my-2">
                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                <div class="overflow-hidden shadow-lg border border-gray-200 rounded-lg">
                                    @if($loads->count()>0)
                                    <table class="min-w-full divide-y divide-gray-200 bg-white">
                                        <thead class="bg-red-900 text-white">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                                    SUBJ_CODE
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                                    SUBJECT
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                                    CLASS CODE
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                                    CLASS DEPT
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                                    SEMESTER
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                                    SY
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                                    UNITS
                                                </th>
                                            
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200">
                                            @foreach($loads as $item)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $item->subject->subj_code }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $item->subject->subj_title }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $item->class_code}}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $item->class_dept}}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $item->semester}}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $item->sy}}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-500">{{ $item->subject->units }}</div>
                                                </td>
                                            
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @else 
                                    <div class="w-full flex justify-center items-center">
                                        <span class="py-8 text-gray-400 ">No teaching loads.</span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Error Message -->
                @if(session('error'))
                <span class="text-red-600 font-semibold">{{ session('error') }}</span>
                @endif

                <div class="mt-4">
                    <button class="bg-red-900 text-white px-6 py-1 flex items-center justify-center hover:bg-red-800">
                        <img src="{{asset('images/icons/link.png')}}" class="w-[20px] h-[20px]" alt="">
                        <span>Load subject to user</span>
                    </button>
                </div>
            </form>
            @endif

        </div>
    </div>
</div>
</x-app-layout>

<style> 
    * { 
        transition: 300ms;
    }

    
    .formrow { 
        position: relative;
    }
    
    .search-results { 
        /* box-shadow: 0px 0px 2px 0px; */
        /* border: 1px solid rgb(190,190,190);  */
        position: absolute;
        width: 50%; 
    
        
        background-color: beige;
        top: 100%;
        display: flex;

        flex-direction: column;
        max-height: 300px; /* Set a maximum height */
        overflow-x: auto;
    
    }



    .search-results button { 
        display: flex;
        text-align: left;
        width: 100%; 
        
        
        padding:0.5rem 1rem;
        line-height: 1rem;
        transition: 300ms; 
        border: 1px solid lightgray;
        

    }

    .search-results button:hover { 
        background-color: maroon;
    }


    .search-results h1 {
        font-size: 1rem; 
        font-weight: 700; 
        font-style:italic;
    }

    .search-results h3  { 
        font-size: 0.8rem;
        font-weight: 500;

        
    }

</style>


<script>
    
    document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search');
    const searchResults = document.querySelector('.search-results');
    let debounceTimer;

    searchInput.addEventListener('keyup', function() {
        clearTimeout(debounceTimer);

        const query = searchInput.value;

        if (query === '') {
            searchResults.innerHTML = ''; // Clear results if the input is empty
            return;
        }

        debounceTimer = setTimeout(() => {
            fetch(`{{ route('admin.pendings.search2') }}?query=${encodeURIComponent(query)}`, {
                method: 'GET',
            })
            .then(response => response.json())
            .then(data => {
                searchResults.innerHTML = ''; // Clear previous results

                if (data.length > 0) {
                    data.forEach(post => {
                        const resultItem = document.createElement('div');

                        resultItem.innerHTML = `
                            <button type="button" class="sr-item" style="background-color: beige; color: black;">
                                <div class="details">
                                    <h1>${post.emp_lname}, ${post.emp_fname} ${post.emp_mname}</h1>
                                    <h3>${post.emp_id}</h3>
                                    <span>${post.email_address_1}</span>
                                </div>
                            </button>
                        `;
                        searchResults.appendChild(resultItem);

                        // Add the event listener to the dynamically created button
                        const button = resultItem.querySelector('.sr-item');
                        button.addEventListener('click', () => {
                            const h3Element = button.querySelector('.details h3');
                            const h3Content = h3Element.innerHTML;
                            searchInput.value = h3Content; // Set the input value to the h3 content
                            searchResults.innerHTML = '';
                        });
                    });
                } else {
                    searchResults.innerHTML = '<div style="padding: 0.5rem 1rem"><span>No results found</span></div>';
                }
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
        }, 300); // Adjust the delay (in milliseconds) as needed
    });
});


</script>