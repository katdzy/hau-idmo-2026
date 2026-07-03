{{-- Combined View Details + Change Status Modal --}}
<div id="details_modal" class="modal-overlay">
    <div class="modal-content">

        {{-- ── Modal Header ── --}}
        <div class="modal-header">
            {{-- Left: document icon + ticket title/subtitle --}}
            <div class="flex items-start gap-3">
                <div class="modal-icon-box">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/>
                        <line x1="16" y1="17" x2="8" y2="17"/>
                        <polyline points="10 9 9 9 8 9"/>
                    </svg>
                </div>
                <div>
                    <h2 class="modal-title">Ticket: <span id="detail_ticket_number"></span></h2>
                    <p class="modal-subtitle">IDC ADMIN &mdash; DOCUMENT MANAGEMENT</p>
                </div>
            </div>

            {{-- Right: close button (isolated, clean) --}}
            <button id="close_details_modal" class="modal-close-btn" title="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2.5"
                    stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>

        {{-- ── Action Bar (Delete Ticket, hidden for registered) ── --}}
        <div id="modal_action_bar" class="modal-action-bar" style="display:none;">
            <button id="delete_ticket_btn" class="delete-ticket-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="3 6 5 6 21 6"/>
                    <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                    <path d="M10 11v6M14 11v6"/>
                    <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                </svg>
                Delete Ticket
            </button>
        </div>

        {{-- ── Modal Body ── --}}
        <div class="modal-body">

            {{-- Ticket Information --}}
            <div class="info-card mb-4">
                <h3 class="section-label mb-3">Ticket Information</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="field-label">Originating Section</p>
                        <p class="field-value" id="detail_section"></p>
                    </div>
                    <div>
                        <p class="field-label">Status</p>
                        <p class="field-value" id="detail_status"></p>
                    </div>
                    <div>
                        <p class="field-label">Created</p>
                        <p class="field-value" id="detail_created"></p>
                    </div>
                    <div>
                        <p class="field-label">Created By</p>
                        <p class="field-value" id="detail_creator"></p>
                    </div>
                </div>
            </div>

            {{-- Sharepoint Link --}}
            <div class="info-card info-card--blue mb-4">
                <p class="field-label mb-1">Sharepoint Folder</p>
                <a id="detail_sharepoint" href="#" target="_blank"
                    class="text-blue-600 hover:text-blue-800 font-medium break-all text-sm"></a>
            </div>

            {{-- Documents List --}}
            <div class="mb-4">
                <h3 class="section-label mb-2">Documents in this Ticket</h3>
                <div class="border border-gray-200 rounded-xl overflow-hidden">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-3 py-2.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Code</th>
                                <th class="px-3 py-2.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Title</th>
                                <th class="px-3 py-2.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Modification</th>
                                <th class="px-3 py-2.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Source</th>
                                <th class="px-3 py-2.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Status</th>
                                <th class="px-3 py-2.5 text-center text-xs font-semibold text-gray-500 uppercase tracking-wide">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="detail_documents_list">
                            {{-- Populated via JS --}}
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Message to IDC --}}
            <div class="info-card mb-4">
                <p class="field-label mb-1">Message to IDC</p>
                <p class="text-gray-800 whitespace-pre-wrap text-sm leading-relaxed" id="detail_message"></p>
            </div>

            {{-- Change Status Section (hidden for registered tickets) --}}
            <div id="change_status_section" class="info-card info-card--purple" style="display:none;">
                <h3 class="section-label text-purple-700 mb-3">Change Ticket Status</h3>
                <form id="status_form" method="POST">
                    @csrf
                    @method('PATCH')
                    <p class="text-sm text-gray-600 mb-3">
                        Current Status:
                        <span id="current_status" class="font-semibold text-purple-700"></span>
                    </p>
                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            New Status <span class="text-red-500">*</span>
                        </label>
                        <select name="status" id="new_status"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-purple-400"
                            required>
                            <option value="">Select new status...</option>
                            <option value="submitted_to_idc">Submitted to IDC</option>
                            <option value="with_qmr">Send to QMR</option>
                        </select>
                        <p class="text-xs text-orange-500 mt-2">
                            &#9888; Warning: This will change ALL document statuses to match the ticket status.
                        </p>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-5 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg text-sm font-semibold transition">
                            Update Status
                        </button>
                    </div>
                </form>
            </div>

        </div>{{-- end modal-body --}}
    </div>
</div>