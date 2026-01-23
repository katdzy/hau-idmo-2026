<x-app-layout>
<!-- Management Dashboard -->
<div class="min-h-screen">
    <div class="container mx-auto">
        <div class="con-box">
            <!-- Success Message -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('msg'))
                <div class="w-full bg-green-600 text-white rounded-xl px-4 py-2 mb-4" id="msg">
                    {{ session('msg') }}
                </div>
            @endif
            <!-- Error message -->
            @if (session('error'))
                <div class="w-full bg-red-600 text-white rounded-xl px-4 py-2 mb-4" id="error">
                    {{ session('error') }}
                </div>
            @endif
            <!-- Header -->
            <div class="w-[95%] px-4 flex my-4 items-center">
                <img src="{{ asset('images/logos/school/soc_logo.png') }}" class="w-[100px] h-[100px] mr-2"/>
                <div class="w-full flex flex-col justify-center">
                    <h1 class="text-[1.5rem] font-bold leading-tight text-purple-700">Document Management System</h1>
                    <span class="text-gray-500 text-sm">Registered Documents Dashboard</span>
                </div>
                <div class="w-full flex gap-4">
                    <!-- Switch to IDC Admin Dashboard -->
                    <a href="{{ route('iso.idc.dashboard') }}" class="bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded-lg font-semibold">
                        Switch to IDC Admin Dashboard
                    </a>
                    <!-- Switch to Document Handler Dashboard -->
                    <a href="{{ route('iso.document') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold">
                        Switch to Document Handler
                    </a>
                </div>
            </div>
            <hr class="w-full opacity-100">

            <!-- Summary Statistics Cards -->
            <div class="w-[95%] grid grid-cols-3 gap-4 px-4 py-4">
                <!-- Total Document Card -->
                <div class="bg-gradient-to-br from-blue-50 to blue-100 border border-blue-200 rounded-lg p-4 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-blue-600 font-medium mb-1">Total Registered Documents</p>
                            <h3 class="text-3xl font-bold text-blue-700">{{ number_format($totalDocuments) }}</h3>
                        </div>
                        <!-- Document Icon -->
                        <div class="bg-blue-500 text-white rounded-full p-3">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a2 2 0 00-2 2v8a2 2 0 002 2h6a2 2 0 002-2V6.414A2 2 0 0016.414 5L14 2.586A2 2 0 0012.586 2H9z"/>
                                <path d="M3 8a2 2 0 012-2v10h8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <!-- Total Active Documents -->
                <div class="bg-gradient-to-br from-emerald-50 to emerald-100 border border-emerald-200 rounded-lg p-4 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-emerald-600 font-medium mb-1">Total Active Documents</p>
                            <h3 class="text-3xl font-bold text-emerald-700">{{ number_format($activeDocuments) }}</h3>
                        </div>
                        <!-- Icon -->
                        <div class="bg-emerald-500 text-white rounded-full p-3">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <!-- Original Documents Card -->
                <div class="bg-gradient-to-br from-green-50 to-green-100 border border-green-200 rounded-lg p-4 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-green-600 font-medium mb-1">Original Documents</p>
                            <h3 class="text-3xl font-bold text-green-700">{{ number_format($originalDocuments) }}</h3>
                        </div>
                        <div class="bg-green-500 text-white rounded-full p-3">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V8z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <!-- Revised Documents Card -->
                <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 border border-yellow-200 rounded-lg p-4 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-yellow-600 font-medium mb-1">Documents with Revision</p>
                            <h3 class="text-3xl font-bold text-yellow-700">{{ number_format($revisedDocuments) }}</h3>
                        </div>
                        <div class="bg-yellow-500 text-white rounded-full p-3">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <!-- Deleted Documents Card -->
                 <div class="bg-gradient-to-br from-red-50 to-red-100 border border-red-200 rounded-lg p-4 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-red-600 font-medium mb-1">Total Deleted Documents</p>
                            <h3 class="text-3xl font-bold text-red-700">{{ number_format($deletedDocuments) }}</h3>
                        </div>
                        <!-- Icon -->
                        <div class="bg-red-500 text-white rounded-full p-3">
    
                        </div>
                    </div>
                </div>
                <!-- Superseded Documents Card -->
                 <div class="bg-gradient-to-br from-rose-50 to-rose-100 border border-rose-200 rounded-lg p-4 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-rose-600 font-medium mb-1">Total Superseded Documents</p>
                            <h3 class="text-3xl font-bold text-rose-700">{{ number_format($supersededDocuments) }}</h3>
                        </div>
                        <!-- Icon -->
                        <div class="bg-rose-500 text-white rounded-full p-3">
    
                        </div>
                    </div>
                </div>
            </div>
            <!-- Breakdown cards -->
            <div class="w[95%] grid grid-cols-2 gap-4 px-4 pb-4">
                <!-- By Source Type -->
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                    <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                        <h5 class="font-bold text-gray-700">By Source Type</h5>
                    </div>
                    <div class="p-4">
                        @forelse($byClassification as $item)
                            <div class="flex justify-between items-center py-2 px-2 mb-2 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                <div class="flex items-center">
                                    <div class="bg-purple-100 text-purple-600 rounded-full p-2 mr-3">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"/>
                                        </svg>
                                    </div>
                                    <span class="font-medium text-gray-700">{{ $item->source_type }}</span>
                                </div>
                                <span class="bg-purple-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                    {{ number_format($item->count) }}
                                </span>
                            </div>
                        @empty
                            <p class="text-gray-400 text-center py-6 italic">No documents registered yet</p>
                        @endforelse
                    </div>
                </div>
                <!-- By Department/Office -->
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                    <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                        <h5 class="font-bold text-gray-700">Top Departments/Offices</h5>
                    </div>
                    <div class="p-4">
                        @forelse($byDepartment as $item)
                            <div class="flex justify-between items-center py-2 px-3 mb-2 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                <div class="flex-items-center">
                                    <div class="bg-green-100 text-green-600 rounded-full p-2 mr-3">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <span class="font-medium text-gray-700 text-sm">{{ $item->originating_section }}</span>
                                </div>
                                <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                    {{ number_format($item->count) }}
                                </span>
                            </div>
                        @empty
                            <p class="text-gray-400 text-center py-6 italic">No documents registered yet</p>
                        @endforelse
                    </div>
                </div>
            </div>
            <!-- Filter Button -->
            <div class="w-[95%] px-4 text-center">
                <button type="button"
                    id="open_filter_modal"
                    class="bg-purple-500 hover:bg-purple-600 text-white px-8 py-3 rounded-lg font-semibold text-lg shadow-sm transition">
                    Open Filters & View Documents
                </button>
            </div>

            <!-- Documents Table (hidden until filters are applied) -->
            <div class="w-[95%] px-4 pb-4" id="documents_table_section" style="display:none;">
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                    <h5 class="font-bold text-gray-700">Filtered Documents</h5>
                    <button type="button"
                            onclick="clearFilters()"
                            class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm font-semibold">
                        Clear FIlters
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-100 border-b">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700">Document Code</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700">Document Title</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700">Source Type</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700">Specific Type</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700">Department/Office</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700">Revision</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700">Status</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700">Registered Date</th>
                            </tr>
                        </thead>
                        <tbody id="documents_table_body">
                            <!-- Populated via AJAX -->
                        </tbody>
                    </table>
                </div>
                <div id="no_results_message" class="text-center py-8 text-gray-400 italic" style="display:none;">
                    No documents match your filters
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Filter Modal -->
@include('iso.management.partials.filter-modal')
</x-app-layout>

<style>
    .container { 
        width: 100%;
        display: flex; 
        justify-content: center;
        padding: 2rem 0;
    }
    
    .con-box { 
        border-radius: 10px; 
        width: 95%;
        background-color: white;
        display: flex; 
        flex-direction: column;
        align-items: center;
        padding: 1rem 0;
    }

    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        justify-content: center;
        align-items: center;
        overflow-y: auto;
        padding: 2rem 0;
    }

    .modal-overlay.active {
        display: flex;
    }

    .modal-content {
        background: white;
        border-radius: 10px;
        width: 90%;
        max-width: 900px;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.5rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .modal-body {
        padding: 1.5rem;
    }
</style>

<script>
const specificOfficeOptions = {
    oop: [
        "(OOP) Office of the President",
        "(OOP-AVI) Aviation Insitute",
        "(OOP-CKS) Center for Kapampangan Studies",
        "(OOP-DPO) Data Privacy Office",
        "(OOP-ITC) Institutional Testing and Evaluation Center",
        "(OOP-ITS) Information Technology Systems & Services",
        "(OOP-OIA) Office of International Affairs",
        "(OOP-TRO) Treasury Office",
        "(OOP-UCO) University Chaplain Office"
    ],
    aac: [
        '(AAC) Academic Affairs Office',
        '(AAC-BED) School of Basic Education',
        '(AAC-CJE) College of Criminal Justice Education & Forensics',
        '(AAC-CTL) Center for Teaching & Learning',
        '(AAC-GSR) Graduate Studies & Research',
        '(AAC-IRB) Institutional Review Board',
        '(AAC-LIB) Library Department',
        '(AAC-LMS) Learning Management System',
        '(AAC-SAS) School of Arts & Sciences',
        '(AAC-SBA) School of Business & Accountancy',
        '(AAC-SEA) School of Engineering & Architecture',
        '(AAC-SED) School of Education',
        '(AAC-SNA) SChool of Nursing & Allied Medical Sciences',
        '(AAC-SOC) School of Computing',
        '(AAC-STM) School of Hospitality & Tourism Management',
        '(AAC-URO) University Research Office'
    ],
    oie: [
        '(OIE-DMO) Institutional Database Management Office',
        '(OIE-IDC) Insitutional Document Controller',
        '(OIE-IPR) Institutional Research, Planning & Publications Office',
        '(OIE-QAO) Quality Assurance Office'
    ],
    cfs: [
        '(CFS-CES) Office of the Community Extension Services',
        '(CFS-CLE) Christian Living Education',
        '(CFS-CMO) Campus Ministry Office'
    ],
    hro: [
        '(HRO-HRD) Human Resource Development',
        '(HRO-HRM) Recruitment and Maintenance'
    ],
    frm: [
        '(FRM) Finance and Resource Management Office',
        '(FRM-ACC) Accounts & Collection',
        '(FRM-ASE) Ancillary Services',
        '(FRM-ATO) Accounting',
        '(FRM-GRT) Grants Accounttant',
        '(FRM-PAO) Payroll'
    ],
    rss: [
        '(RSS-ADO) Admissions Office'
    ],
    ssa: [
        '(SSA-CPO) Career and Placement Office',
        '(SSA-MDS) Medical and Dental Services',
        '(SSA-SAO) Student Affairs',
        '(SSA-SGO) Scholarships & Grants',
        '(SSA-UGC) University Guidance Center',
        '(SSA-USO) University Sports'
    ],
    eac: [
        '(EAC) External Affairs Office',
        '(EAC-ARO) Alumni Relations Office',
        '(EAC-CRE) Creative Services',
        '(EAC-PAM) Performing Arts and Events Management',
        '(EAC-PRO) Public Relations Office'
    ],
    csd: [
        '(CSD-CSO) Campus Services Office',
        '(CSD-ECM) Engineering Construction and Maintenance',
        '(CSD-MCM) Motorpool/Campus Maintenance',
        '(CSD-PCO) Property Custodianship Office',
        '(CSD-PUO) Purchasing Office',
        '(CSD-SEC) Campus Security',
        '(CSD-VLO) Venues and Logistics Office'
    ],
    aie: [
        '(AIE-ETA) Expanded Tertiary Education, Equivalency & Accreditation',
        '(AIE-SPL) School of Professional Education and Lifelong Learning',
        '(AIE-TBI) Technology Business Incubator - KITTO'
    ]
};
const filterModal = document.getElementById('filter_modal');
const openFilterBtn = document.getElementById('open_filter_modal');
const closeFilterBtn = document.getElementById('close_filter_modal');

// Open Modal
openFilterBtn.addEventListener('click', ()=>{
    filterModal.classList.add('active');
});
// Close modal
closeFilterBtn.addEventListener('click', ()=>{
    filterModal.classList.remove('active');
});
// Close modal when clicking outside
filterModal.addEventListener('click', (e)=>{
    if(e.target === filterModal){
        filterModal.classList.remove('active');
    }
});

// Department Search
const departmentSelect = document.getElementById('filter_department');
const officesContainer = document.getElementById('offices_container');
const officesCheckboxes = document.getElementById('offices_checkboxes');

departmentSelect.addEventListener('change', (e)=>{
    const selectedDept = e.target.value;

    officesCheckboxes.innerHTML = '';
    if(!selectedDept || selectedDept===''){
        officesContainer.style.display = 'none';
        return;
    }

    officesContainer.style.display = 'block';

    const offices = specificOfficeOptions[selectedDept];

    offices.forEach((office) =>{
        const label = document.createElement('label');
        label.className = 'flex items-center bg-white p-2 mb-1 rounded hover:bg-gray-100 cursor-pointer';

        label.innerHTML = `
            <input type="checkbox"
                name="originating_section[]"
                value="${office}"
                class="mr-2 text-purple-500 focus:ring-purple-500">
            <span class="text-sm">${office}</span>
        `;

        officesCheckboxes.appendChild(label);
    });
});

// Clear All filters Button
document.getElementById('clear_all_filters').addEventListener('click', ()=>{
    document.getElementById('filter_form').reset();
    officesContainer.style.display = 'none';
    officesCheckboxes.innerHTML = '';
});

// Apply Filters (AJAX)
document.getElementById('filter_form').addEventListener('submit', (e)=>{
    e.preventDefault();

    const formData = new FormData(e.target);

    // Convert to URL parameters
    const params = new URLSearchParams();

    formData.forEach((value, key) => {
        params.append(key, value);
    });

    fetch(`{{ route('iso.management.documents') }}?${params.toString()}`)
        .then(response => {
            if(!response.ok) throw new Error('Network response was not ok');
            return response.json();
        })
        .then(data=>{
            displayDocuments(data);
            filterModal.classList.remove('active');
            document.getElementById('documents_table_section').style.display = 'block';
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to load documents. Please try again.');
        });
});

function displayDocuments(documents){
    const tbody = document.getElementById('documents_table_body');
    const noResults =document.getElementById('no_results_message');

    // Clear exiting rows
    tbody.innerHTML = '';
    if(documents.length === 0){
        noResults.style.display = 'flex';
        return;
    }

    noResults.style.display = 'none';
    documents.forEach((doc) =>{
        const row = createDocumentRow(doc);
        tbody.appendChild(row);
    });
}

function createDocumentRow(doc){
    const tr = document.createElement('tr');
    tr.className = 'border-b bg-gray-50';

    const hasRevisions = doc.current_revision > 0;

    const registeredDate = new Date(doc.registered_at).toLocaleDateString();
    // Status badge colors
    const statusColors = {
        'Active': 'bg-green-100 text-green-800',
        'Superseded': 'bg-yellow-100 text-yellow-800',
        'Deleted' : 'bg-red-100 text-red-800'
    };

    tr.innerHTML = `
        <td class="px-4 py-3 text-sm font-mono text-blue-600">${doc.document_code}</td>
        <td class="px-4 py-3 text-sm">${doc.document_title}</td>
        <td class="px-4 py-3 text-sm">${doc.source_type}</td>
        <td class="px-4 py-3 text-sm">${doc.specific_type}</td>
        <td class="px-4 py-3 text-sm">${doc.originating_section}</td>
        <td class="px-4 py-3 text-sm">
            ${hasRevisions
            ? `<span class="text-purple-600 font-semibold">Rev ${doc.current_revision}</span>`
            : '<span class="text-gray-500">Original</span>'}
        </td>
        <td class="px-4 py-3 text-sm">
            <span class="inline-block px-2 py-1 rounded text-xs ${statusColors[doc.status] || 'bg-gray-100 text-gray-800'}">
                ${doc.status}
            </span>
        </td>
        <td class="px-4 py-3 text-sm text-gray-600">${registeredDate}</td>
    `;
    return tr;
}

function clearFilters(){
    document.getElementById('documents_table_section').style.display = 'none';
    // Reset form
    document.getElementById('filter_form').reset();
}

setTimeout(() => {
    const msg = document.getElementById('msg');
    const errorMsg = document.getElementById('error-msg');
    if(msg) msg.style.display = 'none';
    if(errorMsg) errorMsg.style.display = 'none';
}, 5000);
</script>