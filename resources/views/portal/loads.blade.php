<x-app-layout>
    <div class="min-h-screen">
        <div class="w-full flex justify-center py-8">
            <div class="w-[95%] flex flex-col bg-white rounded-lg p-8">

                <!-- Title Header -->
                <div class="w-full flex">
                    <img src="{{ asset('images/logos/school/soc_logo.png') }}" class="w-[100px] h-[100px] mr-2"/> 
                    <div class="w-full flex flex-col justify-center">
                        <h1 class="text-[1.5rem] font-bold leading-tight"> {{$user->emp_lname}}, {{$user->emp_fname}} {{$user->emp_mname}} </h1>
                        <h1 class="text-[1.2rem] font-semibold text-gray-700"> {{Auth::user()->id}} </h1>
                        <h1 class="text-sm font-semibold text-gray-400"> {{Auth::user()->user->emp_category}} {{Auth::user()-> user->department->dept}} </h1>
                    </div>
                </div>

                <hr class="opacity-100 my-4">

                <!-- Sidebar Tabs and Content -->
                <div class="flex">
                    <!-- Tabs -->
                    <div class="w-1/4 border-r border-gray-200 pr-4">
                        <ul class="flex flex-col space-y-2">
                            <li>
                                <button onclick="showContent('thisYear')" class="tab-button w-full text-left py-2 px-4 text-red-900 font-bold bg-gray-200 rounded-md focus:outline-none" id="thisYearTab">Current Semester</button>
                            </li>
                            <li>
                                <button onclick="showContent('allLoads')" class="tab-button w-full text-left py-2 px-4 text-gray-400 rounded-md focus:outline-none" id="allLoadsTab">All Loads</button>
                            </li>
                        </ul>
                    </div>

                    <!-- Content Panels -->
                    <div class="w-3/4 pl-4">
                        <!-- This Semester Content -->
                        <div id="thisYearContent" class="content-panel">
                        <h1 class="text-gray-500 text-xl font-bold">Current Loads</h1>
                        <span class="text-gray-400 text-sm"> School Year: {{$sy->current_sy}} | {{$sy->current_sem}}</span>

                            <!-- Regular Loads Table -->
                            @if($regular_loads->count() > 0)
                                <div class="w-full flex flex-col border border-gray-200 rounded-lg overflow-hidden mb-4">
                                    <div class="w-full bg-red-900 text-white grid grid-cols-[15%_15%_15%_40%_15%] p-3 font-semibold">
                                        <span>Class Code</span>
                                        <span>Code</span>
                                        <span>Class Dept</span>
                                        <span>Subject</span>
                                        <span>Units</span>
                                    </div>
                                    @foreach($regular_loads as $load)
                                        <div class="w-full grid grid-cols-[15%_15%_15%_40%_15%] p-3 border-t border-gray-200 bg-white hover:bg-gray-100 transition-colors">
                                            <span class="text-gray-700">{{$load->class_code}}</span>
                                            <span class="text-gray-700">{{$load->subject->subj_code}}</span>
                                            <span class="text-gray-700">{{$load->class_dept}}</span>
                                            <span class="text-gray-700">{{$load->subject->subj_title}}</span>
                                            <span class="text-gray-700">{{$load->subject->units}}.00</span>
                                        </div>
                                    @endforeach
                                </div>
                            @else

                            
                                <div class="w-full flex items-center justify-center text-sm text-gray-400 py-2 mt-2">
                                    <span class="italic">No regular loads available for this semester.</span>
                                </div>
                            @endif


                            <hr class="w-full opacity-60 my-4">

                            <!-- Trimester Loads Table -->

                            <h1 class="text-gray-500 text-xl font-bold">Tri-semester Loads</h1>
                            <span class="text-gray-400 text-sm"> School Year: {{$t_sy->current_sy}} | {{$t_sy->current_sem}}</span>

                            @if($trisem_loads->count() > 0)
                            
                                <div class="w-full flex flex-col border border-gray-200 rounded-lg overflow-hidden">
                                <div class="w-full bg-red-900 text-white grid grid-cols-[15%_15%_15%_40%_15%] p-3 font-semibold">
                                        <span>Class Code</span>
                                        <span>Code</span>
                                        <span>Class Dept</span>
                                        <span>Subject</span>
                                        <span>Units</span>
                                    </div>
                                    @foreach($trisem_loads as $load)
                                    <div class="w-full grid grid-cols-[15%_15%_15%_40%_15%] p-3 border-t border-gray-200 bg-white hover:bg-gray-100 transition-colors">
                                            <span class="text-gray-700">{{$load->class_code}}</span>
                                            <span class="text-gray-700">{{$load->subject->subj_code}}</span>
                                            <span class="text-gray-700">{{$load->class_dept}}</span>
                                            <span class="text-gray-700">{{$load->subject->subj_title}}</span>
                                            <span class="text-gray-700">{{$load->subject->units}}.00</span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="w-full flex items-center justify-center text-sm text-gray-400 py-2 mt-2">
                                    <span class="italic">No trimester loads available for this semester.</span>
                                </div>
                            @endif
                        </div>

                        <!-- All Loads Content -->
                        <div id="allLoadsContent" class="content-panel hidden">
                            <h2 class="text-2xl font-bold mb-4">All Loads</h2>
                            @if($loads->count() == 0) <!-- Condition for No Data in All Loads -->
                                <div class="w-full flex items-center justify-center text-sm text-gray-400 py-8">
                                    <span class="italic">No load data available.</span>
                                </div>
                            @else
                                <div class="w-full flex flex-col border border-gray-200 rounded-lg overflow-hidden">
                                    <!-- Header -->
                                    <div class="w-full bg-red-900 text-white grid grid-cols-[15%_25%_15%_15%_15%_15%] p-3 font-semibold">
                                        <span>Class Code</span>
                                        <span>Subject</span>
                                        <span>Class Dept</span>
                                        <span>Units</span>
                                        <span>S.Y</span>
                                        <span>Semester</span>
                                    </div>
                                    <!-- Rows -->
                                    @foreach($loads as $load) <!-- List of All Loads Here -->
                                        <div class="w-full grid grid-cols-[15%_25%_15%_15%_15%_15%] p-3 border-t border-gray-200 bg-white hover:bg-gray-100 transition-colors">
                                            <span class="text-gray-700">{{$load->class_code}}</span>
                                            <span class="text-gray-700">{{$load->subject->subj_code}}</span>
                                            <span class="text-gray-700">{{$load->class_dept}}</span>
                                            <span class="text-gray-700">{{$load->subject->units}}.00</span>
                                            <span class="text-gray-700">{{$load->sy}}</span>
                                            <span class="text-gray-700">{{$load->semester}}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <span class="text-justify italic my-4 text-gray-400 text-sm leading-tight">
                    Reminder: Please be aware that load management and adjustments can only be performed by Administrator accounts. If you need changes made, contact your system administrator for assistance.
                </span>
            </div>
        </div>
    </div>

    <script>
        function showContent(tabName) {
            document.querySelectorAll('.content-panel').forEach(panel => panel.classList.add('hidden'));
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('text-red-900', 'bg-gray-200', 'font-bold');
                button.classList.add('text-gray-400');
            });
            document.getElementById(tabName + 'Content').classList.remove('hidden');
            document.getElementById(tabName + 'Tab').classList.add('text-red-900', 'bg-gray-200', 'font-bold');
            document.getElementById(tabName + 'Tab').classList.remove('text-gray-400');
        }
    </script>
</x-app-layout>
