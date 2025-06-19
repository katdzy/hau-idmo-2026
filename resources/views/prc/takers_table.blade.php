<div id="viewModeTable" class="w-full overflow-x-auto">
    <table class="min-w-full bg-white border">
        <thead>
            <tr class="bg-gray-100 text-black">
                <!-- Left-align the school header -->
                <th class="px-4 py-2 border text-left">School</th>
                <th colspan="5" class="px-4 py-2 border">First Timers</th>
                <th colspan="5" class="px-4 py-2 border">Repeaters</th>
                <th colspan="5" class="px-4 py-2 border">Overall Performance</th>
            </tr>
            <tr class="bg-gray-100 text-black">
                <th class="px-4 py-2 border"></th>
                <!-- First Timers Sub-columns -->
                <th class="px-4 py-2 border">Passed</th>
                <th class="px-4 py-2 border">Failed</th>
                <th class="px-4 py-2 border">Cond</th>
                <th class="px-4 py-2 border">Total</th>
                <th class="px-4 py-2 border">% Passed</th>
                <!-- Repeaters Sub-columns -->
                <th class="px-4 py-2 border">Passed</th>
                <th class="px-4 py-2 border">Failed</th>
                <th class="px-4 py-2 border">Cond</th>
                <th class="px-4 py-2 border">Total</th>
                <th class="px-4 py-2 border">% Passed</th>
                <!-- Overall Performance Sub-columns -->
                <th class="px-4 py-2 border">Passed</th>
                <th class="px-4 py-2 border">Failed</th>
                <th class="px-4 py-2 border">Cond</th>
                <th class="px-4 py-2 border">Total</th>
                <th class="px-4 py-2 border">% Passed</th>
            </tr>
        </thead>
        <tbody>
            @forelse($takers as $taker)
                @php
                    $first_total = $taker->first_pass + $taker->first_fail + $taker->first_cond;
                    $first_percentage = $first_total > 0 ? number_format(($taker->first_pass / $first_total) * 100, 2) . '%' : '0%';
                    $repeat_total = $taker->repeat_pass + $taker->repeat_fail + $taker->repeat_cond;
                    $repeat_percentage = $repeat_total > 0 ? number_format(($taker->repeat_pass / $repeat_total) * 100, 2) . '%' : '0%';
                    $overall_pass = $taker->first_pass + $taker->repeat_pass;
                    $overall_fail = $taker->first_fail + $taker->repeat_fail;
                    $overall_cond = $taker->first_cond + $taker->repeat_cond;
                    $overall_total = $overall_pass + $overall_fail + $overall_cond;
                    $overall_percentage = $overall_total > 0 ? number_format(($overall_pass / $overall_total) * 100, 2) . '%' : '0%';
                @endphp
                <tr class="@if($loop->even) bg-gray-100 @else bg-white @endif hover:bg-gray-200 transition">
                    <!-- Left-align school name -->
                    <td class="px-4 py-2 border text-left">{{ $taker->school }}</td>
                    <!-- First Timers Data -->
                    <td class="px-4 py-2 border text-center">{{ $taker->first_pass }}</td>
                    <td class="px-4 py-2 border text-center">{{ $taker->first_fail }}</td>
                    <td class="px-4 py-2 border text-center">{{ $taker->first_cond }}</td>
                    <td class="px-4 py-2 border text-center">{{ $first_total }}</td>
                    <td class="px-4 py-2 border text-center">{{ $first_percentage }}</td>
                    <!-- Repeaters Data -->
                    <td class="px-4 py-2 border text-center">{{ $taker->repeat_pass }}</td>
                    <td class="px-4 py-2 border text-center">{{ $taker->repeat_fail }}</td>
                    <td class="px-4 py-2 border text-center">{{ $taker->repeat_cond }}</td>
                    <td class="px-4 py-2 border text-center">{{ $repeat_total }}</td>
                    <td class="px-4 py-2 border text-center">{{ $repeat_percentage }}</td>
                    <!-- Overall Performance Data -->
                    <td class="px-4 py-2 border text-center">{{ $overall_pass }}</td>
                    <td class="px-4 py-2 border text-center">{{ $overall_fail }}</td>
                    <td class="px-4 py-2 border text-center">{{ $overall_cond }}</td>
                    <td class="px-4 py-2 border text-center">{{ $overall_total }}</td>
                    <td class="px-4 py-2 border text-center">{{ $overall_percentage }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="16" class="px-4 py-2 border text-center text-gray-500">No data available.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <!-- Wrap pagination links in a container with class "ajax-pagination" -->
    <div class="mt-4 ajax-pagination">
        {{ $takers->links() }}
    </div>
</div>
