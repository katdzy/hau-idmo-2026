<x-app-layout>
    <div class="min-h-screen">
        <div class="flex justify-center items-center w-full py-8">
            <div class="flex-col w-[95%] bg-white rounded-lg py-8">
                <div class="px-8 pb-4">
                    <a href="{{ route('kpis.dashboard') }}" class="inline-flex gap-1 items-center bg-red-900 hover:bg-red-700 px-6 py-1 text-white rounded-xl">
                        <img src="{{ asset('images/icons/back.png') }}" class="w-[20px] h-[20px]" alt="">
                        <span>Return to KPI Dashboard</span>
                    </a>
                </div>
                <div class="w-full flex flex-col items-center justify-center px-8 py-4 leading-tight">
                    <img class="w-[120px] h-[120px] my-0" src="{{ asset('images/logo-circle.png') }}" />
                    <h1 class="text-[3rem] font-bold text-gray-700">EDIT KPI</h1>
                    <span class="text-[0.7rem] text-gray-400">
                        Update the information below to modify the selected KPI.
                    </span>
                </div>

                <!-- Tabbed Interface -->
                <div x-data="{ tab: 'kpi' }" class="w-full">
                    <div class="flex border-b mb-6">
                        <button type="button" @click="tab = 'kpi'" :class="tab === 'kpi' ? 'border-b-2 border-maroon text-maroon' : 'text-gray-500'" class="px-4 py-2 font-semibold focus:outline-none">KPI</button>
                        <button type="button" @click="tab = 'segmentation'" :class="tab === 'segmentation' ? 'border-b-2 border-maroon text-maroon' : 'text-gray-500'" class="px-4 py-2 font-semibold focus:outline-none">Segmentation</button>
                        <button type="button" @click="tab = 'dimensions'" :class="tab === 'dimensions' ? 'border-b-2 border-maroon text-maroon' : 'text-gray-500'" class="px-4 py-2 font-semibold focus:outline-none">Dimensions</button>
                    </div>

                    <!-- KPI Tab -->
                    <div x-show="tab === 'kpi'">
                        <form class="flex-col w-full px-8" action="{{ route('kpis.update', $kpi->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="flex flex-col">
                                    <h1 class="text-gray-500">MEASURE CODE <span class="font-bold text-red-500">*</span></h1>
                                    <input class="rounded-lg w-full" name="measure_code" type="text" value="{{ old('measure_code', $kpi->measure_code) }}" required/>
                                </div>
                                <div class="flex flex-col">
                                    <h1 class="text-gray-500">MEASURE NAME <span class="font-bold text-red-500">*</span></h1>
                                    <input class="rounded-lg w-full" name="measure_name" type="text" value="{{ old('measure_name', $kpi->measure_name) }}" required/>
                                </div>
                                <div class="flex flex-col">
                                    <h1 class="text-gray-500">MEASURE OWNER</h1>
                                    <input class="rounded-lg w-full" name="measure_owner" type="text" value="{{ old('measure_owner', $kpi->measure_owner) }}"/>
                                </div>
                                <div class="flex flex-col">
                                    <h1 class="text-gray-500">DESCRIPTION</h1>
                                    <textarea class="rounded-lg w-full" name="description" rows="3">{{ old('description', $kpi->description) }}</textarea>
                                </div>
                                <div class="flex flex-col">
                                    <h1 class="text-gray-500">UNIT TYPE</h1>
                                    <input class="rounded-lg w-full" name="unit_type" type="text" value="{{ old('unit_type', $kpi->unit_type) }}"/>
                                </div>
                                <div class="flex flex-col">
                                    <h1 class="text-gray-500">MEASURE TYPE</h1>
                                    <input class="rounded-lg w-full" name="measure_type" type="text" value="{{ old('measure_type', $kpi->measure_type) }}"/>
                                </div>
                                <div class="flex flex-col">
                                    <h1 class="text-gray-500">LEAD/LAG</h1>
                                    <input class="rounded-lg w-full" name="lead_lag" type="text" value="{{ old('lead_lag', $kpi->lead_lag) }}"/>
                                </div>
                                <div class="flex flex-col">
                                    <h1 class="text-gray-500">FORMULA</h1>
                                    <textarea class="rounded-lg w-full" name="formula" rows="2">{{ old('formula', $kpi->formula) }}</textarea>
                                </div>
                                <div class="flex flex-col">
                                    <h1 class="text-gray-500">POLARITY</h1>
                                    <input class="rounded-lg w-full" name="polarity" type="text" value="{{ old('polarity', $kpi->polarity) }}"/>
                                </div>
                                <div class="flex flex-col">
                                    <h1 class="text-gray-500">DATA PROVIDER</h1>
                                    <input class="rounded-lg w-full" name="data_provider" type="text" value="{{ old('data_provider', $kpi->data_provider) }}"/>
                                </div>
                                <div class="flex flex-col">
                                    <h1 class="text-gray-500">DATA SOURCE</h1>
                                    <input class="rounded-lg w-full" name="data_source" type="text" value="{{ old('data_source', $kpi->data_source) }}"/>
                                </div>
                                <div class="flex flex-col">
                                    <h1 class="text-gray-500">COLLECTION FREQUENCY</h1>
                                    <input class="rounded-lg w-full" name="collection_frequency" type="text" value="{{ old('collection_frequency', $kpi->collection_frequency) }}"/>
                                </div>
                                <div class="flex flex-col">
                                    <h1 class="text-gray-500">REPORTING FREQUENCY</h1>
                                    <input class="rounded-lg w-full" name="reporting_frequency" type="text" value="{{ old('reporting_frequency', $kpi->reporting_frequency) }}"/>
                                </div>
                                <div class="flex flex-col">
                                    <h1 class="text-gray-500">VERIFIED BY</h1>
                                    <input class="rounded-lg w-full" name="verified_by" type="text" value="{{ old('verified_by', $kpi->verified_by) }}"/>
                                </div>
                                <div class="flex flex-col">
                                    <h1 class="text-gray-500">VALIDATED BY</h1>
                                    <input class="rounded-lg w-full" name="validated_by" type="text" value="{{ old('validated_by', $kpi->validated_by) }}"/>
                                </div>
                                <div class="flex flex-col">
                                    <h1 class="text-gray-500">BASELINE</h1>
                                    <input class="rounded-lg w-full" name="baseline" type="text" value="{{ old('baseline', $kpi->baseline) }}"/>
                                </div>
                                <div class="flex flex-col">
                                    <h1 class="text-gray-500">TARGET</h1>
                                    <input class="rounded-lg w-full" name="target" type="text" value="{{ old('target', $kpi->target) }}"/>
                                </div>
                                <div class="flex flex-col">
                                    <h1 class="text-gray-500">THRESHOLD LOW</h1>
                                    <input class="rounded-lg w-full" name="threshold_low" type="text" value="{{ old('threshold_low', $kpi->threshold_low) }}"/>
                                </div>
                                <div class="flex flex-col">
                                    <h1 class="text-gray-500">THRESHOLD HIGH</h1>
                                    <input class="rounded-lg w-full" name="threshold_high" type="text" value="{{ old('threshold_high', $kpi->threshold_high) }}"/>
                                </div>
                                <div class="flex flex-col">
                                    <h1 class="text-gray-500">TARGET RATIONALE</h1>
                                    <textarea class="rounded-lg w-full" name="target_rationale" rows="2">{{ old('target_rationale', $kpi->target_rationale) }}</textarea>
                                </div>
                                <div class="flex flex-col">
                                    <h1 class="text-gray-500">PERSPECTIVE</h1>
                                    <input class="rounded-lg w-full" name="perspective" type="text" value="{{ old('perspective', $kpi->perspective) }}"/>
                                </div>
                                <div class="flex flex-col">
                                    <h1 class="text-gray-500">STRATEGIC THEME</h1>
                                    <input class="rounded-lg w-full" name="strategic_theme" type="text" value="{{ old('strategic_theme', $kpi->strategic_theme) }}"/>
                                </div>
                                <div class="flex flex-col">
                                    <h1 class="text-gray-500">OBJECTIVE</h1>
                                    <input class="rounded-lg w-full" name="objective" type="text" value="{{ old('objective', $kpi->objective) }}"/>
                                </div>
                                <div class="flex flex-col">
                                    <h1 class="text-gray-500">OBJECTIVE OWNER</h1>
                                    <input class="rounded-lg w-full" name="objective_owner" type="text" value="{{ old('objective_owner', $kpi->objective_owner) }}"/>
                                </div>
                                <div class="flex flex-col">
                                    <h1 class="text-gray-500">INTENDED RESULTS</h1>
                                    <textarea class="rounded-lg w-full" name="intended_results" rows="2">{{ old('intended_results', $kpi->intended_results) }}</textarea>
                                </div>
                                <div class="flex flex-col">
                                    <h1 class="text-gray-500">STRATEGIC INITIATIVES</h1>
                                    <textarea class="rounded-lg w-full" name="strategic_initiatives" rows="2">{{ old('strategic_initiatives', $kpi->strategic_initiatives) }}</textarea>
                                </div>
                                <div class="flex flex-col">
                                    <h1 class="text-gray-500">COMPARATOR</h1>
                                    <textarea class="rounded-lg w-full" name="comparator" rows="2">{{ old('comparator', $kpi->comparator) }}</textarea>
                                </div>
                                <div class="flex flex-col">
                                    <h1 class="text-gray-500">ITEM AUTHOR</h1>
                                    <input class="rounded-lg w-full" name="item_author" type="text" value="{{ old('item_author', $kpi->item_author) }}"/>
                                </div>
                                <div class="flex flex-col">
                                    <h1 class="text-gray-500">DATE</h1>
                                    <input class="rounded-lg w-full" name="date" type="date" value="{{ old('date', $kpi->date) }}"/>
                                </div>
                            </div>
                            <div class="w-full flex justify-end py-4 gap-2">
                                <form action="{{ route('kpis.update', $kpi->id) }}" method="POST" >
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="maroon text-white px-6 py-2 rounded-md">Update KPI</button>
                                </form>
                                <form action="{{ route('kpis.destroy', $kpi->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this KPI?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-md" onclick="return confirm('Are you sure you want to delete this KPI?');">Delete KPI</button>
                                </form>
                            </div>
                        </form>
                    </div>

                    <!-- Segmentation Tab -->
                    <div x-show="tab === 'segmentation'">
                        <div class="px-8">
                            <h2 class="text-xl font-bold text-gray-700 mb-4">Segmentations</h2>
                            <!-- Add New Segmentation Form -->
                            <form x-data="{ showTarget: false, showGoal: false }" action="{{ route('segmentations.store') }}" method="POST" class="mb-6 border p-4 rounded-lg bg-gray-50">
                                @csrf
                                <input type="hidden" name="kpi_id" value="{{ $kpi->id }}">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="flex flex-col">
                                        <h1 class="text-gray-500">Segmentation <span class="font-bold text-red-500">*</span></h1>
                                        <input class="rounded-lg w-full" name="segmentation" type="text" value="{{ old('segmentation') }}" required />
                                    </div>
                                    <div class="flex flex-col">
                                        <h1 class="text-gray-500">Code</h1>
                                        <input class="rounded-lg w-full" name="code" type="text" value="{{ old('code') }}" />
                                    </div>
                                </div>
                                <div class="mt-2 flex flex-col">
                                    <h1 class="text-gray-500">Owner</h1>
                                    <input class="rounded-lg w-full" name="owner" type="text" value="{{ old('owner') }}" />
                                </div>
                                <div class="mt-2 flex gap-4">
                                    <button type="button" @click="showTarget = !showTarget" class="text-maroon underline focus:outline-none">
                                        <span x-show="!showTarget">Add Target Level (optional)</span>
                                        <span x-show="showTarget">Hide Target Level</span>
                                    </button>
                                    <button type="button" @click="showGoal = !showGoal" class="text-maroon underline focus:outline-none">
                                        <span x-show="!showGoal">Add Goal (optional)</span>
                                        <span x-show="showGoal">Hide Goal</span>
                                    </button>
                                </div>
                                <div x-show="showTarget" class="mt-2">
                                    <div class="flex flex-col mb-2">
                                        <h1 class="text-gray-500">Target Level</h1>
                                        <input class="rounded-lg w-full" name="target_level" type="text" value="{{ old('target_level') }}" />
                                    </div>
                                </div>
                                <div x-show="showGoal" class="mt-2">
                                    <div class="flex flex-col">
                                        <h1 class="text-gray-500">Goal</h1>
                                        <input class="rounded-lg w-full" name="goal" type="text" value="{{ old('goal') }}" />
                                    </div>
                                </div>
                                <div class="w-full flex justify-end py-2">
                                    <button class="maroon text-white px-8 py-2 rounded-md" type="submit">Add Segmentation</button>
                                </div>
                            </form>
                            @php
                                $hasTargetLevel = $kpi->segmentations->contains(fn($seg) => !is_null($seg->target_level));
                                $hasGoal = $kpi->segmentations->contains(fn($seg) => !is_null($seg->goal));
                            @endphp
                            @foreach($kpi->segmentations as $segmentation)
                                <form x-data="{ showTarget: {{ $segmentation->target_level ? 'true' : 'false' }}, showGoal: {{ $segmentation->goal ? 'true' : 'false' }} }" action="{{ route('segmentations.update', $segmentation->id) }}" method="POST" class="mb-4">
                                    @csrf
                                    @method('PUT')
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="flex flex-col">
                                            <h1 class="text-gray-500">Segmentation</h1>
                                            <input class="rounded-lg w-full" name="segmentation" type="text" value="{{ old('segmentation', $segmentation->segmentation) }}" />
                                        </div>
                                        <div class="flex flex-col">
                                            <h1 class="text-gray-500">Code</h1>
                                            <input class="rounded-lg w-full" name="code" type="text" value="{{ old('code', $segmentation->code) }}" />
                                        </div>
                                    </div>
                                    <div class="mt-2 flex flex-col">
                                        <h1 class="text-gray-500">Owner</h1>
                                        <input class="rounded-lg w-full" name="owner" type="text" value="{{ old('owner', $segmentation->owner) }}" />
                                    </div>
                                    <div class="mt-2 flex gap-4">
                                        <button type="button" @click="showTarget = !showTarget" class="text-maroon underline focus:outline-none">
                                            <span x-show="!showTarget">Show Target Level (optional)</span>
                                            <span x-show="showTarget">Hide Target Level</span>
                                        </button>
                                        <button type="button" @click="showGoal = !showGoal" class="text-maroon underline focus:outline-none">
                                            <span x-show="!showGoal">Show Goal (optional)</span>
                                            <span x-show="showGoal">Hide Goal</span>
                                        </button>
                                    </div>
                                    <div x-show="showTarget" class="mt-2">
                                        <div class="flex flex-col mb-2">
                                            <h1 class="text-gray-500">Target Level</h1>
                                            <input class="rounded-lg w-full" name="target_level" type="text" value="{{ old('target_level', $segmentation->target_level) }}" />
                                        </div>
                                    </div>
                                    <div x-show="showGoal" class="mt-2">
                                        <div class="flex flex-col">
                                            <h1 class="text-gray-500">Goal</h1>
                                            <input class="rounded-lg w-full" name="goal" type="text" value="{{ old('goal', $segmentation->goal) }}" />
                                        </div>
                                    </div>
                                    <div class="w-full flex justify-end py-2 gap-2">
                                        <button class="maroon text-white px-8 py-2 rounded-md" type="submit">Update</button>
                                        <form action="{{ route('segmentations.destroy', $segmentation->id) }}" method="POST" onsubmit="return confirm('Delete this segmentation?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-md" onclick="return confirm('Are you sure you want to delete this segmentation?');">Delete</button>
                                        </form>
                                    </div>
                                </form>
                            @endforeach
                        </div>
                    </div>

                    <!-- Dimensions Tab -->
                    <div x-show="tab === 'dimensions'">
                        <div class="px-8">
                            <h2 class="text-xl font-bold text-gray-700 mb-4">Dimensions</h2>
                            <!-- Add New Dimension Form -->
                            <form action="{{ route('dimensions.store') }}" method="POST" class="mb-6 border p-4 rounded-lg bg-gray-50">
                                @csrf
                                <input type="hidden" name="kpi_id" value="{{ $kpi->id }}">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="flex flex-col">
                                        <h1 class="text-gray-500">Dimensions <span class="font-bold text-red-500">*</span></h1>
                                        <input class="rounded-lg w-full" name="dimensions" type="text" value="{{ old('dimensions') }}" required />
                                    </div>
                                    <div class="flex flex-col">
                                        <h1 class="text-gray-500">Description</h1>
                                        <input class="rounded-lg w-full" name="description" type="text" value="{{ old('description') }}" />
                                    </div>
                                </div>
                                <div class="w-full flex justify-end py-2">
                                    <button class="maroon text-white px-8 py-2 rounded-md" type="submit">Add Dimension</button>
                                </div>
                            </form>
                            @foreach($kpi->dimensions as $dimension)
                                <form action="{{ route('dimensions.update', $dimension->id) }}" method="POST" class="mb-4">
                                    @csrf
                                    @method('PUT')
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="flex flex-col">
                                            <h1 class="text-gray-500">Dimensions</h1>
                                            <input class="rounded-lg w-full" name="dimensions" type="text" value="{{ old('dimensions', $dimension->dimensions) }}" />
                                        </div>
                                        <div class="flex flex-col">
                                            <h1 class="text-gray-500">Description</h1>
                                            <input class="rounded-lg w-full" name="description" type="text" value="{{ old('description', $dimension->description) }}" />
                                        </div>
                                    </div>
                                    <div class="w-full flex justify-end py-2 gap-2">
                                        <button class="maroon text-white px-8 py-2 rounded-md" type="submit">Update</button>
                                        <form action="{{ route('dimensions.destroy', $dimension->id) }}" method="POST" onsubmit="return confirm('Delete this dimension?');" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-md" onclick="return confirm('Are you sure you want to delete this dimension?');">Delete</button>
                                        </form>
                                    </div>
                                </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .maroon {
        background-color: maroon;
    }
</style>
