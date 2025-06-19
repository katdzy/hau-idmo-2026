<x-app-layout>
    <div class="min-h-screen">
        <div class="w-full flex items-center justify-center py-8">
            <div class="w-[95%] bg-white px-8 py-8 rounded-lg">

            <!-- Title Header -->
            <div class="w-full flex">
                    <img src="{{ asset('images/logos/school/soc_logo.png') }}" class="w-[100px] h-[100px] mr-2"/> 
                    <div class="w-full flex flex-col justify-center">
                        <h1 class="text-[1.5rem] font-bold leading-tight"> {{$user->emp_lname}}, {{$user->emp_fname}} {{$user->emp_mname}} </h1>
                        <h1 class="text-[1.2rem] font-semibold text-gray-700"> {{Auth::user()->id}} </h1>
                        <h1 class="text-sm font-semibold text-gray-400"> {{Auth::user()-> user->department->dept}} </h1>
                    </div>
                </div>

                <hr class="opacity-60 w-full">
                <h2 class="text-2xl font-bold text-gray-900 mt-6">Hiring History</h2>
                <span class="text-gray-400 mb-4">Browse Through Hiring Records</span>
                <table class="min-w-full bg-white border border-gray-300 rounded-lg mt-4">
                    <thead class="bg-red-900 text-white">
                        <tr>
                            <th class="py-4 px-6 text-left text-sm font-medium">DATE</th>
                            <th class="py-4 px-6 text-left text-sm font-medium">POSITION</th>
                            <th class="py-4 px-6 text-left text-sm font-medium">DIVISION</th>
                            <th class="py-4 px-6 text-left text-sm font-medium">DEPARTMENT</th>
                            <th class="py-4 px-6 text-left text-sm font-medium">NATURE</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hirings as $hiring)
                        <tr class="border-b hover:bg-gray-50 transition-all duration-300 ease-in-out">
                            <td class="py-4 px-6">{{ \Carbon\Carbon::parse($hiring->date)->format('Y-M-d') }}</td>
                            <td class="py-4 px-6">{{ $hiring->position }}</td>
                            <td class="py-4 px-6">{{ $hiring->division }}</td>
                            <td class="py-4 px-6">{{ $hiring->department }}</td>
                            <td class="py-4 px-6">{{ $hiring->nature }}</td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
