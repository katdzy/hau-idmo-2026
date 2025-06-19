{{-- admin.subjects.delete-partial --}}
<table class="w-full bg-white border border-gray-100">
    <thead>
        <tr class="w-full bg-red-900 text-gray-800 text-white">
            <th class="py-2 px-4 text-left"></th>
            <th class="py-2 px-4 text-left">Subject Code</th>
            <th class="py-2 px-4 text-left">Subject Name</th>
            <th class="py-2 px-4 text-left">Units</th>
            <th class="py-2 px-4 text-left">School Year</th>
        </tr>
    </thead>

    <tbody id="subject-list">
    @foreach($subjects as $option)
        <tr class="border-b hover:bg-gray-100 text-gray-500">
            <td class="py-2 px-4">
                <input 
                    type="checkbox"
                    name="items[]"
                    value="{{ $option->subj_id }}"
                    class="w-4 h-4 text-red-900 border-black-300 rounded focus:ring-red-500"
                >
            </td>
            <td class="py-2 px-4">{{ $option->subj_code }}</td>
            <td class="py-2 px-4">{{ $option->subj_title }}</td>
            <td class="py-2 px-4">{{ $option->units }}</td>
            <td class="py-2 px-4 text-left">{{ $option->subj_sy }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

{{-- Render pagination links. Each link includes ?page=N, so we can catch it via AJAX. --}}
<div class="mt-4">
    {{ $subjects->appends(['q' => request('q')])->links() }}
</div>
