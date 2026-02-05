<!-- Import Modal -->
<div id="import_modal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="text-xl font-bold text-purple-700 flex items-center gap-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                </svg>
                Import Documents from Excel
            </h2>
            <button id="close_import_modal" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        </div>
        <form id="import_form" enctype="multipart/form-data" class="modal-body">
            @csrf
            <!-- Instructions -->
            <div class="mb-4 p-4 bg-yellow-50 border border-yellow-200 rounded-md">
                <div class="flex gap-2">
                    <svg class="w-5 h-5 text-yellow-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <div class="text-sm text-yellow-800">
                        <p class="font-semibold mb-1">Important Notes:</p>
                        <ul class="list-disc list-inside space-y-1">
                            <li>Download the template first for the correct format</li>
                            <li>Revisions require the original document (revision 0) to exist</li>
                            <li>Accepted formats: .xlsx, .xls, .csv</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- File Upload Area -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Select Excel File <span class="text-red-500">*</span>
                </label>
                <div class="flex items-center justify-center w-full">
                    <label for="excel-file"class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-300 border-dashed rounded-md cursor-pointer bg-gray-50 hover:bg-gray-100 transition">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                            <p class="text-xs text-gray-500">XLSX, XLS or CSV (MAX. 10MB)</p>
                        </div>
                        <input id="excel-file" name="file" type="file" class="hidden"accept=".xlsx,.xls,.csv" onchange="displayFileName(this)"required/>
                    </label>
                </div>
                <p id="file-name"class="mt-2 text-sm text-gray-600 text-center"></p>
            </div>
            <!-- Error Display -->
            <div id="import-errors" class="hidden mb-4 p-4 bg-red-50 border border-red-200 rounded-md">
                <div class="flex gap-2">
                    <svg class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <div class="text-sm text-red-800">
                        <p class="font-semibold mb-1">Import Errors:</p>
                        <ul id="error-list" class="list-disc list-inside space-y-1"></ul>
                    </div>
                </div>
            </div>
            <!-- Success Display -->
            <div id="import-success" class="hidden mb-4 p-4 bg-green-50 border border-green-200 rounded-md">
                <div class="flex gap-2">
                    <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <p id="success-message"class="text-sm text-green-800 font-semibold"></p>
                </div>
            </div>

            <!-- Actions Buttons -->
            <div class="flex justify-end gap-3">
                <button
                    type="button"
                    id="cancel_import_btn"
                    class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50"
                >
                    Cancel
                </button>
                <button
                    type="submit"
                    id="import_submit_btn"
                    class="px-4 py-2 bg-purple-500 horver:bg-purple-600 text-white rounded-md font-semibold flex items-center gap-2"
                >
                    <svg id="import_spinner" class="hidden animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <svg id="import_icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                    </svg>
                    <span id="import_btn_text">Import Documents</span>
                </button>
            </div>
        </form>
    </div>
</div>