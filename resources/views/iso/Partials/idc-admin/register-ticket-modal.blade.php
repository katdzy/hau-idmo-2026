{{-- Register Ticket Confirmation Modal --}}
<div id="register_modal" class="modal-overlay">
    <div class="modal-content" style="max-width: 480px;">

        {{-- Header --}}
        <div class="modal-header">
            <div class="flex items-start gap-3">
                <div class="modal-icon-box" style="background:#f0fdf4; color:#16a34a;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                </div>
                <div>
                    <h2 class="modal-title">Register Ticket</h2>
                    <p class="modal-subtitle">Ticket: <span id="register_ticket_number"></span></p>
                </div>
            </div>
            <button id="close_register_modal" class="modal-close-btn" title="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2.5"
                    stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>

        {{-- Body --}}
        <div class="modal-body">

            {{-- Warning Banner --}}
            <div style="background:#fefce8; border-left: 4px solid #eab308; border-radius:8px; padding:1rem; margin-bottom:1.25rem;">
                <p style="font-weight:700; color:#854d0e; margin-bottom:0.4rem;">⚠️ This action is permanent and cannot be undone.</p>
                <p style="font-size:0.85rem; color:#92400e;">Please make sure all documents have been fully reviewed before registering.</p>
            </div>

            {{-- What will happen --}}
            <div class="info-card mb-4">
                <p class="section-label mb-3">What happens when you register:</p>
                <ul style="list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:0.6rem;">
                    <li style="display:flex; align-items:flex-start; gap:0.5rem; font-size:0.875rem; color:#374151;">
                        <span style="color:#16a34a; font-weight:700; margin-top:1px;">✓</span>
                        <span>All documents are moved to the <strong>Official Document Registry</strong></span>
                    </li>
                    <li style="display:flex; align-items:flex-start; gap:0.5rem; font-size:0.875rem; color:#374151;">
                        <span style="color:#16a34a; font-weight:700; margin-top:1px;">✓</span>
                        <span>The ticket is <strong>permanently locked</strong> — no further edits or deletion</span>
                    </li>
                    <li style="display:flex; align-items:flex-start; gap:0.5rem; font-size:0.875rem; color:#374151;">
                        <span style="color:#16a34a; font-weight:700; margin-top:1px;">✓</span>
                        <span>Document counts in the <strong>Management View</strong> will update</span>
                    </li>
                    <li style="display:flex; align-items:flex-start; gap:0.5rem; font-size:0.875rem; color:#dc2626;">
                        <span style="color:#dc2626; font-weight:700; margin-top:1px;">✕</span>
                        <span>You <strong>will NOT be able to</strong> reverse this registration</span>
                    </li>
                </ul>
            </div>

            {{-- Confirmation checkbox --}}
            <label style="display:flex; align-items:flex-start; gap:0.75rem; cursor:pointer; margin-bottom:1.25rem; padding:0.75rem; border:1.5px solid #e5e7eb; border-radius:10px;">
                <input type="checkbox" id="register_confirm_checkbox" style="margin-top:2px; width:16px; height:16px; accent-color:#16a34a; cursor:pointer; flex-shrink:0;">
                <span style="font-size:0.875rem; color:#374151;">
                    I have completed my final review and confirm this ticket is ready to be officially registered.
                </span>
            </label>

            {{-- Action Buttons --}}
            <div style="display:flex; justify-content:flex-end; gap:0.75rem;">
                <button id="cancel_register_btn"
                    style="padding:0.5rem 1.2rem; border:1px solid #d1d5db; border-radius:8px; background:white; color:#374151; font-size:0.875rem; font-weight:600; cursor:pointer;">
                    Cancel — Go Back
                </button>
                <button id="confirm_register_btn"
                    disabled
                    style="padding:0.5rem 1.2rem; border-radius:8px; background:#d1d5db; color:#9ca3af; font-size:0.875rem; font-weight:600; cursor:not-allowed; transition:all 0.2s;">
                    ✓ Register Ticket
                </button>
            </div>

        </div>
    </div>
</div>
