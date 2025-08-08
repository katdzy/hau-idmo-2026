<x-app-layout>
    <div class="max-w-5xl mx-auto p-6 bg-white rounded shadow text-sm text-gray-800">
        <div class="mb-4 flex gap-4 items-center">
            <a href="{{ route('kpis.dashboard') }}" class="inline-flex gap-1 items-center bg-red-900 hover:bg-red-700 px-6 py-1 text-white rounded-xl">
                <img src="{{ asset('images/icons/back.png') }}" class="w-[20px] h-[20px]" alt="">
                <span>Return to KPI Dashboard</span>
            </a>
            <a href="{{ route('kpis.export', $kpi->measure_code) }}" class="inline-flex gap-1 items-center bg-green-600 hover:bg-green-700 px-6 py-1 text-white rounded-xl">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
                <span>Export to Excel</span>
            </a>
        </div>
        <h1 class="text-xl font-bold mb-4">Balanced Scorecard KPI Dictionary for {{ $kpi->measure_code }}</h1>

        <div class="border border-gray-300">
            {{-- HEADER --}}
            <div class="grid grid-cols-4 bg-yellow-100 font-semibold text-center">
                <div class="col-span-4 bg-yellow-200 py-2">HOLY ANGEL UNIVERSITY<br>BALANCED SCORECARD Performance Measures Information Card</div>
            </div>

            {{-- ROW 1 --}}
            <div class="grid grid-cols-4 border-t border-gray-300">
                <div class="bg-gray-100 p-2 font-semibold">Measure Code</div>
                <div class="p-2">{{ $kpi->measure_code }}</div>
                <div class="bg-gray-100 p-2 font-semibold">Measure Owner</div>
                <div class="p-2">{{ $kpi->measure_owner }}</div>
            </div>

            {{-- ROW 2 --}}
            <div class="grid grid-cols-4 border-t border-gray-300">
                <div class="bg-gray-100 p-2 font-semibold">Measure Name</div>
                <div class="p-2 font-bold uppercase">{{ $kpi->measure_name }}</div>
                <div class="bg-gray-100 p-2 font-semibold">Perspective</div>
                <div class="p-2">{{ $kpi->perspective }}</div>
            </div>

            {{-- ROW 3 — Strategic Theme or Strategy --}}
            @if ($kpi->strategic_theme)
                <div class="grid grid-cols-4 border-t border-gray-300">
                    <div class="bg-gray-100 p-2 font-semibold">Strategic Theme</div>
                    <div class="p-2 bg-red-900 text-white col-span-3">{{ $kpi->strategic_theme }}</div>
                </div>
            @elseif ($kpi->strategy)
                <div class="grid grid-cols-4 border-t border-gray-300">
                    <div class="bg-gray-100 p-2 font-semibold">Strategy</div>
                    <div class="p-2 bg-red-900 text-white col-span-3">{{ $kpi->strategy }}</div>
                </div>
            @endif

            {{-- ROW 4 --}}
            <div class="grid grid-cols-4 border-t border-gray-300">
                <div class="bg-gray-100 p-2 font-semibold">Description</div>
                <div class="p-2 col-span-3 whitespace-pre-line">{{ $kpi->description }}</div>
            </div>

           {{-- ROW 5 — Objective and Objective Owner --}}
            <div class="grid grid-cols-4 border-t border-gray-300">
                <div class="bg-gray-100 p-2 font-semibold">Objective</div>
                <div class="p-2">{{ $kpi->objective }}</div>
                <div class="bg-gray-100 p-2 font-semibold">Objective Owner</div>
                <div class="p-2">{{ $kpi->objective_owner }}</div>
            </div>

            {{-- ROW 6 — Measure Type --}}
            <div class="grid grid-cols-4 border-t border-gray-300">
                <div class="bg-gray-100 p-2 font-semibold">Measure Type</div>
                <div class="p-2">{{ $kpi->measure_type }}</div>
                <div class="bg-gray-100 p-2 font-semibold">Lead/Lag</div>
                <div class="p-2">{{ $kpi->lead_lag }}</div>
            </div>

            {{-- ROW 8: Formula --}}
            <div class="grid grid-cols-4 border-t border-gray-300">
                <div class="bg-gray-100 p-2 font-semibold">Formula</div>
                <div class="p-2 col-span-3 whitespace-pre-line">{{ $kpi->formula }}</div>
            </div>

            {{-- ROW 9: Unit Type, Polarity, Data --}}
            <div class="grid grid-cols-4 border-t border-gray-300">
                <div class="bg-gray-100 p-2 font-semibold">Unit Type</div>
                <div class="p-2">{{ $kpi->unit_type }}</div>
                <div class="bg-gray-100 p-2 font-semibold">Polarity</div>
                <div class="p-2">{{ $kpi->polarity }}</div>
            </div>

            {{-- ROW 10 --}}
            <div class="grid grid-cols-4 border-t border-gray-300">
                <div class="bg-gray-100 p-2 font-semibold">Data Provider</div>
                <div class="p-2">{{ $kpi->data_provider }}</div>
                <div class="bg-gray-100 p-2 font-semibold">Data Source</div>
                <div class="p-2">{{ $kpi->data_source }}</div>
            </div>

            {{-- ROW 11 --}}
            <div class="grid grid-cols-4 border-t border-gray-300">
                <div class="bg-gray-100 p-2 font-semibold">Collection Frequency</div>
                <div class="p-2">{{ $kpi->collection_frequency }}</div>
                <div class="bg-gray-100 p-2 font-semibold">Reporting Frequency</div>
                <div class="p-2">{{ $kpi->reporting_frequency }}</div>
            </div>

            {{-- ROW 12 --}}
            <div class="grid grid-cols-4 border-t border-gray-300">
                <div class="bg-gray-100 p-2 font-semibold">Verified by</div>
                <div class="p-2">{{ $kpi->verified_by }}</div>
                <div class="bg-gray-100 p-2 font-semibold">Validated by</div>
                <div class="p-2">{{ $kpi->validated_by }}</div>
            </div>

            {{-- ROW 13 --}}
            <div class="grid grid-cols-4 border-t border-gray-300">
                <div class="bg-gray-100 p-2 font-semibold">Baseline</div>
                <div class="p-2">{{ $kpi->baseline }}</div>
                <div class="bg-gray-100 p-2 font-semibold">Target</div>
                <div class="p-2">{{ $kpi->target }}</div>
            </div>

            {{-- ROW 14: Thresholds --}}
            <div class="grid grid-cols-4 border-t border-gray-300">
                <div class="bg-gray-100 p-2 font-semibold">Thresholds</div>
                <div class="p-2 col-span-3">
                    @if($kpi->threshold_low)
                        <span class="inline-block w-6 h-4 bg-red-500 mr-1 align-middle"></span> {{ $kpi->threshold_low }}<span class="inline-block w-16 h-4 bg-yellow-300 ml-4 mr-1 align-middle"></span>
                    @endif
                    @if($kpi->threshold_high)
                        {{ $kpi->threshold_high }}<span class="inline-block w-6 h-4 bg-green-500 ml-4 mr-1 align-middle"></span>
                    @endif
                </div>
            </div>

            {{-- ROW 15: Intended Results --}}
            <div class="grid grid-cols-4 border-t border-gray-300">
                <div class="bg-gray-100 p-2 font-semibold">Intended Results</div>
                <div class="p-2 col-span-3">{{ $kpi->intended_results }}</div>
            </div>

            {{-- ROW 16: Strategic Initiatives --}}
            <div class="grid grid-cols-4 border-t border-gray-300">
                <div class="bg-gray-100 p-2 font-semibold">Strategic Initiatives / Action Plans</div>
                <div class="p-2 col-span-3">{{ $kpi->strategic_initiatives }}</div>
            </div>

            {{-- ROW 17: Target Rationale --}}
            <div class="grid grid-cols-4 border-t border-gray-300">
                <div class="bg-gray-100 p-2 font-semibold">Target Rationale</div>
                <div class="p-2 col-span-3">{{ $kpi->target_rationale }}</div>
            </div>

            {{-- ROW 18: Comparator --}}
            <div class="grid grid-cols-4 border-t border-gray-300">
                <div class="bg-gray-100 p-2 font-semibold">Comparator</div>
                <div class="p-2 col-span-3">{{ $kpi->comparator }}</div>
            </div>

            {{-- ROW 18: Item Author and Date --}}
            <div class="grid grid-cols-4 border-t border-gray-300">
                <div class="bg-gray-100 p-2 font-semibold">Item Author</div>
                <div class="p-2">{{ $kpi->item_author }}</div>
                <div class="bg-gray-100 p-2 font-semibold">Date</div>
                <div class="p-2">{{ $kpi->date }}</div>
            </div>
        </div>

        {{-- SEGMENTATION TABLE --}}
        @if($kpi->segmentations && $kpi->segmentations->count())
            @php
                $hasTargetLevel = $kpi->segmentations->contains(fn($seg) => !is_null($seg->target_level));
                $hasGoal = $kpi->segmentations->contains(fn($seg) => !is_null($seg->goal));
            @endphp

            <div class="mt-6">
                <table class="table-fixed border border-gray-300 w-full text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2 text-left w-1/4">Segmentation</th>
                            <th class="border px-4 py-2 text-left w-1/6">Code</th>
                            <th class="border px-4 py-2 text-left w-1/6">Owner</th>
                            @if ($hasTargetLevel)
                                <th class="border px-4 py-2 text-left w-1/6">Target Level</th>
                            @endif
                            @if ($hasGoal)
                                <th class="border px-4 py-2 text-left w-1/4">Goal</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kpi->segmentations as $seg)
                            <tr>
                                <td class="border px-4 py-2 w-1/4">{{ $seg->segmentation }}</td>
                                <td class="border px-4 py-2 w-1/6">{{ $seg->code }}</td>
                                <td class="border px-4 py-2 w-1/6">{{ $seg->owner }}</td>
                                @if ($hasTargetLevel)
                                    <td class="border px-4 py-2 w-1/6">
                                        {{ $seg->target_level ?? '-' }}
                                    </td>
                                @endif
                                @if ($hasGoal)
                                    <td class="border px-4 py-2 w-1/4">
                                        {{ $seg->goal ?? '-' }}
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif


        {{-- ACCREDITING BODY TABLE --}}
        @if($kpi->accreditations && $kpi->accreditations->count())
            <div class="mt-6">
                <table class="table-auto border border-gray-300 w-full text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2 text-left w-1/3">Accrediting Body ID</th>
                            <th class="border px-4 py-2 text-left w-1/3">Accrediting Body Name</th>
                            <th class="border px-4 py-2 text-left w-1/3">Program Unit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kpi->accreditations as $acc)
                            <tr>
                                <td class="border px-4 py-2">{{ $acc->accrediting_body_id }}</td>
                                <td class="border px-4 py-2">{{ $acc->accrediting_body_name }}</td>
                                <td class="border px-4 py-2">{{ $acc->program_unit }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        {{-- DIMENSIONS TABLE --}}
        @if($kpi->dimensions && $kpi->dimensions->count())
            <div class="mt-6">
                <table class="table-auto border border-gray-300 w-full text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2 text-left w-1/3">Dimensions</th>
                            <th class="border px-4 py-2 text-left w-1/3">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kpi->dimensions as $dim)
                            <tr>
                                <td class="border px-4 py-2">{{ $dim->dimensions }}</td>
                                <td class="border px-4 py-2">{{ $dim->description }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif


    </div>
</x-app-layout>
