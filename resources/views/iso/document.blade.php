<x-app-layout>
<div class="min-h-screen">
<div class="container mx-auto">
    <div class="con-box">
        @if (session('msg'))
            <div class="w-full bg-green-600 text-white rounded-xl px-4 py-2 mb-4" id ="msg">
                {{ session('msg') }}
            </div>
        @endif
        @if(session('error'))
            <div class="w-full bg-red-600 text-white rounded-xl px-4 py-2 mb-4" id="error-msg">
                {{ session('error') }}
            </div>
        @endif

        <div class="w-[95%] px-4 flex my-4 items-center">
            <img src="{{ asset('images/logos/school/soc_logo.png') }}" class="w-[100px] h-[100px] mr-2"/>
            <div class="w-full flex flex-col justify-center">
                <h1 class="text-[1.5rem] font-bold leading-tight">ISO Document Management System</h1>
                <span class="text-gray-500 text-sm"> Document Modification / Creation Notice (DMCN) Tracking</span>
            </div>
        </div>
        <hr class="w-full opacity-100">

        <!-- Status Tabs -->
         <div class="w-full flex">
            <button id="mytickets_btn" class="hover:bg-gray-100 text-gray-400 font-semibold px-8 py-2 active_link">My Tickets</button>
            <button id="submitted_btn" class="hover:bg-gray-100 text-gray-400 font-semibold px-8 py-2">Submitted to IDC</button>
            <button id="qmr_btn" class="hover:bg-gray-100 text-gray-400 font-semibold px-8 py-2">With QMR</button>
            <button id="approved_btn" class="hover:bg-gray-100 text-gray-400 font-semibold px-8 py-2">Approved</button>
            <button id="onhold_btn" class="hover:bg-gray-100 text-gray-400 font-semibold px-8 py-2">On-hold</button>
         </div>
         <hr class="mb-2 opacity-90 w-full">

         <!-- My Tickets Table -->
          <div id="mytickets" class="w-full flex flex-col border border-gray-200 rounded-lg shadow-sm overflow-hidden">
            <div class="w-full items-center justify-center text-sm text-gray-400 pt-4 pb-12">
                <span class="italic">No tickets found.</span>
            </div>
            <!-- TODO: Ticket List goes here -->
          </div>

          <!-- Submitted to IDC table -->
           <div id="submitted" class="w-full flex-col border border-gray-200 rounded-lg shadow-sm overflow-hidden inactive_link">
                <div class="w-full flex items-center justify-center text-sm text-gray-400 pt-4 pb-12">
                    <span class="italic">No tickets with QMR.</span>
                </div>
           </div>

           <!-- Submitted to QMR table -->
            <div id="qmr" class="w-full flex flex-col border border-gray-200 rounded-lg shadow-sm overflow-hidden inactive_link">
                <div class="w-full flex items-center justify-center text-sm text-gray-400 pt-4 pb-12">
                    <span class="italic">No tickets with QMR.</span>
                </div>
            </div>
            <!-- Approved Table -->
             <div id="onhold" class="w-full flex flex-col border border-gray-200 rounded-lg shadow-sm overflow-hidden inactive_link">
                <div class="w-full flex items-center justify-center text-sm text-gray-400 pt-4 pb-12">
                    <span class="italic">No tickets on-hold</span>
                </div>
             </div>

             <!-- Action buttons -->
              <section class="py-4 w-full flex justify-center items-center space-x-4">
                <button id="create_ticket_btn" class="flex items-center justify-center bg-blue-500 text-white py-2 px-6 rounded hover:bg-blue-600">
                    <img src="{{ asset('images/icons/add.png') }}" alt="Add Icon" class="w-6 h-6 mr-6"/>
                    <span>Create new Ticket</span>
                </button>
              </section>
    </div>
</div>
</div>

<!-- Modal for creating new Ticket -->
 <div id="ticket_modal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="text-xl font-bold">Create New DMCN Ticket</h2>
            <button id="close_modal" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        </div>
        <form id="ticket_form" action="#" method="POST" class="modal-body">
            @csrf
            <!-- Ticket Classification -->
             <div class="form-group">
                <label class="form-label">Ticket Classification <span class="text-red-500">*</span></label>
                <select name="classification" class="form-input" required>
                    <option value="">Select Classification</option>
                    <option value="revision">For Revision</option>
                    <option value="addition">Addition</option>
                    <option value="deletion">Deletion</option>
                </select>
             </div>
        

            <!-- Originating Section -->
            <div class="form-group">
                <label class="form-label">Originating Section (Department) <span class="text-red-500">*</span></label>
                <input type="text" name="originating_section" class="form-input" placeholder="e.g., Human Resources, IT Department" required>
            </div>

            <!-- Source Document / Manual -->
            <div class="form-group">
                <label class="form-label">Source Document / Manual <span class="text-red-500">*</span></label>
                <select id="source_type" name="source_type" class="form-input" required>
                    <option value="">Select Document Type</option>
                    <option value="eoms">EOMS Manual</option>
                    <option value="procedures">Procedures</option>
                    <option value="forms">Forms</option>
                    <option value="records">Records Management Manual</option>
                    <option value="others">Others</option>
                </select>
            </div>

            <!-- EOMS Manual Options -->
            <div id="eoms_section" class="form-group conditional-section">
                <label class="form-label">EOMS Manual Type</label>
                <select name="eoms_type" class="form-input">
                    <option value="">Select EOMS Type</option>
                    <option value="4.1">4.1 Interested Parties</option>
                    <option value="4.2">4.2 Risk Assessment</option>
                    <option value="7.4">7.4 Communication</option>
                    <option value="8.1">8.1 EOMS Plan</option>
                </select>
            </div>

            <!-- Procedures Section -->
            <div id="procedures_section" class="conditional-section">
                <div class="form-group">
                    <label class="form-label">Document Code</label>
                    <input type="text" name="procedures_code" class="form-input" placeholder="Enter Document Code">
                </div>
                <div class="form-group">
                    <label class="form-label">Document Title</label>
                    <input type="text" name="procedures_title" class="form-input" placeholder="Enter Document Title">
                </div>
            </div>

            <!-- Forms Section -->
            <div id="forms_section" class="conditional-section">
                <div class="form-group">
                    <label class="form-label">Document Code</label>
                    <input type="text" name="forms_code" class="form-input" placeholder="Enter Document Code">
                </div>
                <div class="form-group">
                    <label class="form-label">Document Title</label>
                    <input type="text" name="forms_title" class="form-input" placeholder="Enter Document Title">
                </div>
            </div>

            <!-- Records Management Plan -->
            <div id="records_section" class="form group conditional-section">
            <label class="form-label">Records Management Type</label>
                <select name="records_type" class="form-input">
                    <option value="">Select records type</option>
                    <option value="3.0">3.0 Records Retention Schedule</option>
                    <option value="4.0">4.0 Definition and Records Series Title</option>
                </select>
            </div>

            <!-- Others Section -->
            <div id="others_section" class="conditional-section">
                <div class="form-group">
                    <label class="form-label">Other Document Types</label>
                    <div class="flex items-center space-x-4 mb-2">
                        <label class="flex items-center">
                            <input type="checkbox" name="others_types[]" value="brochure" class="mr-2">
                            Brochure
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="others_types[]" value="handbook" class="mr-2">
                            Handbook
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="others_types[]" value="manual" class="mr-2">
                            Manual
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Specify Other Details</label>
                    <input type="text" name="others_specify" class="form-input" placeholder="Please specify other document type or details.">
                </div>
            </div>

            <!-- SharePoint Folder Link -->
            <div class="form-group">
                <label class="form-label">SharePoint Folder Link <span class="text-red-500">*</span></label>
                    <input type="url" name="sharepoint_link" class="form-input" placeholder="https://hau.sharepoint.com/..." required>
                <small class="text-gray-500">Provide the link to the SharePoint folder containing the DMCN and actual document</small>
            </div>

            <!-- Email Message to IDC -->
            <div class="form-group">
                <label class="form-label">Message to IDC <span class="text-red-500">*</span></label>
                <textarea name="message_to_idc" class="form-input" rows="4" placeholder="Write a message to the Institutional Document Controller..." required></textarea>
            </div>

            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit" class="w-full bg-green-600 text-white py-3 rounded hover:bg-green700 font-semibold">
                    Submit Ticket to IDC
                </button>
            </div>
        </form>
    </div>
</div>
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

    .active_link { 
        border-bottom: 4px solid #FFD700;
        font-weight: 700;
        transition: 150ms;
    }

    .active_link:hover { 
        background-color: rgb(230, 230, 230);
    }

    .inactive_link { 
        display: none;
    }

    /* Modal Styles */
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
        max-width: 700px;
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

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #374151;
    }

    .form-input {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 0.875rem;
    }

    .form-input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .conditional-section {
        display: none;
    }

    .conditional-section.active {
        display: block;
    }
</style>

<script>
    // Tab switching
    const mytickets_btn = document.getElementById('mytickets_btn');
    const submitted_btn = document.getElementById('submitted_btn');
    const qmr_btn = document.getElementById('qmr_btn');
    const approved_btn = document.getElementById('approved_btn');
    const onhold_btn = document.getElementById('onhold_btn');

    const mytickets_tbl = document.getElementById('mytickets');
    const submitted_tbl = document.getElementById('submitted');
    const qmr_tbl = document.getElementById('qmr');
    const approved_tbl = document.getElementById('approved');
    const onhold_tbl = document.getElementById('onhold');

    function switchTab(activeBtn, activeTbl){
        [mytickets_btn, submitted_btn, qmr_btn, approved_btn, onhold_btn].forEach(btn => {
            btn.classList.remove('active_link');
        });

        [mytickets_tbl, submitted_tbl, qmr_tbl, approved_tbl, onhold_tbl].forEach(tbl =>{
            tbl.classList.remove('inactive_link');
        });

        activeBtn.classList.add('active_link');
        activeTbl.classList.remove('inactive_link');
    }

    // Modal Handling
    const modal = document.getElementById('ticket_modal');
    const createBtn = document.getElementById('create_ticket_btn');
    const closeBtn = document.getElementById('close_modal');

    createBtn.addEventListener('click', ()=> {
        modal.classList.add('active');
    });

    closeBtn.addEventListener('click', () =>{
        modal.classList.remove('active');
    })
    // Close modal when clicking outside
    modal.addEventListener('click', (e) =>{
        if (e.target === modal){
            modal.classList.remove('active');
        }
    });

    // Conditional form section
    const sourceType = document.getElementById('source_type');
    const eomsSection = document.getElementById('eoms_section');
    const proceduresSection = document.getElementById('procedures_section');
    const formsSection = document.getElementById('forms_section');
    const recordsSection = document.getElementById('records_section');
    const otherSection = document.getElementById('others_section');

    sourceType.addEventListener('change', () =>{
        // Hide all sections first
        [eomsSection, proceduresSection, formsSection, recordsSection, otherSection].forEach(section =>{
            section.classList.remove('active');
        });

        // Show relevant section
        const value = sourceType.value;
        if(value === 'eoms') eomsSection.classList.add('active');
        if(value === 'procedures') proceduresSection.classList.add('active');
        if(value === 'forms')formsSection.classList.add('active');
        if(value === 'records')recordsSection.classList.add('active');
        if(value === 'others')otherSection.classList.add('active');
    });

    // Auto-hide messages in 5 seconds or 5000 miliseconds
    setTimeout(() =>{
        const msgElement = document.getElementById('msg');
        if(msgElement) msgElement.style.display = 'none';

        const errorElement = document.getElementById('error-msg');
        if(errorElement) errorElement.style.display = 'none';
    }, 5000);
</script>