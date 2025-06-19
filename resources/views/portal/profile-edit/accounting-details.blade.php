

<div class="w-full flex justify-center py-8">
    <div class="w-full flex flex-col rounded-xl p-0 bg-white">

        <form action="{{ route('portal.accounting-details', ['id' => Auth::user()->id]) }}" method="POST"> 
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-gray-600 text-sm mb-1" for="sss_no">SSS No.</label>
                    <input type="text" name="sss_no" id="sss_no" value="{{ $data->accounting_details->sss_no ?? 'n/a' }}" class="block w-full p-2 border rounded-lg bg-gray-200 focus:bg-white focus:border-gray-400" />
                </div>

                <div>
                    <label class="block text-gray-600 text-sm mb-1" for="tax_no">Tax Identification No.</label>
                    <input type="text" name="tax_no" id="tax_no" value="{{ $data->accounting_details-> tax_no ?? 'n/a' }}" class="block w-full p-2 border rounded-lg bg-gray-200 focus:bg-white focus:border-gray-400" />
                </div>

                <div>
                    <label class="block text-gray-600 text-sm mb-1" for="pagibig_no">Pag-Ibig No.</label>
                    <input type="text" name="pagibig_no" id="pagibig_no" value="{{ $data->accounting_details->pagibig_no ?? 'n/a' }}" class="block w-full p-2 border rounded-lg bg-gray-200 focus:bg-white focus:border-gray-400" />
                </div>

                <div>
                    <label class="block text-gray-600 text-sm mb-1" for="philhealth_no">PhilHealth</label>
                    <input type="text" name="philhealth_no" id="philhealth_no" value="{{ $data->accounting_details->philhealth_no ?? 'n/a' }}" class="block w-full p-2 border rounded-lg bg-gray-200 focus:bg-white focus:border-gray-400" />
                </div>
            </div>
            <hr class="my-4 opacity-50">

            <div class="flex justify-end">
                <button type="submit" class="flex items-center bg-red-900 text-white rounded-md px-4 py-2 hover:bg-red-700 transition duration-300">
                    <img src="{{ asset('images/icons/save.png') }}" class="w-5 h-5 mr-2" alt="Save Icon"/>
                    <span class="font-semibold">Save Changes</span>
                </button>
            </div>
        </form>
    </div>
</div>
