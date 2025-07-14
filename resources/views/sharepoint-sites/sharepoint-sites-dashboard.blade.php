<!-- This is the Sharepoint Sites dashboard -->
<x-app-layout>
    <div class="min-h-screen bg-gray-50">
        <div class="w-full flex justify-center py-8">
            <div class="w-[95%] flex flex-col bg-white rounded-lg px-8 py-8 shadow-lg">
                <h1 class="text-[1.8rem] font-semibold mb-2">
                    SharePoint Sites
                </h1>
                <hr class="opacity-100 my-4">

                <!-- Tabs -->
                <div class="mb-6">
                    <ul class="flex border-b" id="tabs">
                        <li class="-mb-px mr-2">
                            <button class="tab-btn active" data-tab="tab-iso">
                                ISO
                            </button>
                        </li>
                        <li class="-mb-px mr-2">
                            <button class="tab-btn" data-tab="tab-planning">
                                Planning and Review
                            </button>
                        </li>
                        <li class="-mb-px mr-2">
                            <button class="tab-btn" data-tab="tab-quality">
                                Quality Assurance
                            </button>
                        </li>
                    </ul>
                </div>

                <!-- ISO Tab -->
                <div id="tab-iso" class="tab-content overflow-y-auto" style="max-height: 70vh;">
                    <div class="w-full flex flex-col gap-8">
                        <p class="font-semibold text-red-900 mb-2">
                            This site serves as HAU’s central repository for documentation related to the university's implementation of the ISO 21001:2018 Educational Organization Management System (EOMS). It provides access to institutional manuals, audit reports, policies, procedures, forms, and other records. 
                            <br>The site also supports coordination for internal audits and continual improvement tracking.
                        </p>
                        <ul id="departments-list" class="space-y-4">
                            @foreach ($isoLinks as $department => $deptLinks)
                                <li>
                                    <button type="button" class="department-btn w-full text-left font-bold text-red-900 px-4 py-2 bg-gray-100 rounded hover:bg-gray-200">
                                        {{ $department ?? 'Uncategorized Department' }}
                                    </button>
                                    @php $offices = $deptLinks->groupBy('office'); @endphp
                                    <ul class="ml-6 mt-2 hidden office-list">
                                        @foreach ($offices as $office => $officeLinks)
                                            <li>
                                                @if ($office)
                                                    <button type="button" class="office-btn w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100">
                                                        {{ $office }}
                                                    </button>
                                                    <ul class="ml-6 mt-1 hidden file-list">
                                                        @foreach ($officeLinks as $link)
                                                            <li>
                                                                <a href="{{ $link->url }}" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200">
                                                                    {{ $link->label }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    @foreach ($officeLinks as $link)
                                                        <li>
                                                            <a href="{{ $link->url }}" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200">
                                                                {{ $link->label }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Planning and Review Tab -->
                <div id="tab-planning" class="tab-content hidden overflow-y-auto" style="max-height: 70vh;">
                    <div class="w-full flex flex-col gap-8">
                        <ul class="space-y-4">
                            @foreach ($planningLinks as $department => $deptLinks)
                                <li>
                                    <button type="button" class="department-btn w-full text-left font-bold text-red-900 px-4 py-2 bg-gray-100 rounded hover:bg-gray-200">
                                        {{ $department ?? 'Uncategorized Department' }}
                                    </button>
                                    @php $offices = $deptLinks->groupBy('office'); @endphp
                                    <ul class="ml-6 mt-2 hidden office-list">
                                        @foreach ($offices as $office => $officeLinks)
                                            <li>
                                                @if ($office)
                                                    <button type="button" class="office-btn w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100">
                                                        {{ $office }}
                                                    </button>
                                                    <ul class="ml-6 mt-1 hidden file-list">
                                                        @foreach ($officeLinks as $link)
                                                            <li>
                                                                <a href="{{ $link->url }}" target="_blank" title="{{ $link->description }}"
                                                                    class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200">
                                                                    {{ $link->label }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    @foreach ($officeLinks as $link)
                                                        <li>
                                                            <a href="{{ $link->url }}" target="_blank" title="{{ $link->description }}"
                                                                class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200">
                                                                {{ $link->label }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Quality Assurance Tab -->
                <div id="tab-quality" class="tab-content hidden overflow-y-auto" style="max-height: 70vh;">
                    <div class="w-full flex flex-col gap-8">
                        <ul class="space-y-4">
                            @foreach ($qaLinks as $department => $deptLinks)
                                <li>
                                    <button type="button" class="department-btn w-full text-left font-bold text-red-900 px-4 py-2 bg-gray-100 rounded hover:bg-gray-200">
                                        {{ $department ?? 'Uncategorized Department' }}
                                    </button>
                                    @php $offices = $deptLinks->groupBy('office'); @endphp
                                    <ul class="ml-6 mt-2 hidden office-list">
                                        @foreach ($offices as $office => $officeLinks)
                                            <li>
                                                @if ($office)
                                                    <button type="button" class="office-btn w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100">
                                                        {{ $office }}
                                                    </button>
                                                    <ul class="ml-6 mt-1 hidden file-list">
                                                        @foreach ($officeLinks as $link)
                                                            <li>
                                                                <a href="{{ $link->url }}" target="_blank" title="{{ $link->description }}" 
                                                                    class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200">
                                                                    {{ $link->label }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    @foreach ($officeLinks as $link)
                                                        <li>
                                                            <a href="{{ $link->url }}" target="_blank" title="{{ $link->description }}" 
                                                                class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200">
                                                                {{ $link->label }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(tc => tc.classList.add('hidden'));
                btn.classList.add('active');
                document.getElementById(btn.getAttribute('data-tab')).classList.remove('hidden');
            });
        });

        document.querySelectorAll('.department-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const officeList = this.nextElementSibling;
                document.querySelectorAll('.office-list').forEach(list => {
                    if (list !== officeList) list.classList.add('hidden');
                });
                officeList.classList.toggle('hidden');
            });
        });

        document.querySelectorAll('.office-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const fileList = this.nextElementSibling;
                document.querySelectorAll('.file-list').forEach(list => {
                    if (list !== fileList) list.classList.add('hidden');
                });
                fileList.classList.toggle('hidden');
            });
        });
    });
</script>

<style>
    .tab-btn {
        background-color: white;
        padding: 0.5rem 1rem;
        font-weight: 600;
        color: #70121D;
        border: 1px solid #e5e7eb;
        border-bottom: none;
        border-top-left-radius: 0.5rem;
        border-top-right-radius: 0.5rem;
    }

    .tab-btn.active {
        background-color: #f3f4f6;
        border-bottom: 2px solid #70121D;
        color: #70121D;
    }

    .tab-content {
        animation: fadeIn 0.2s;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .maroon {
        transition: 300ms;
    }

    .maroon:hover {
        background-color: #A84655;
    }
</style>
