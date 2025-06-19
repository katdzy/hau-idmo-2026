<x-app-layout>
    <div class="min-h-screen">
        <div class="flex justify-center items-center w-full py-8">
            <div class="flex-col w-[95%] bg-white rounded-lg py-8">
                <div class="px-8 pb-4">
                    <a href="{{ route('admin.subjects') }}" class="inline-flex gap-1 items-center bg-red-900 hover:bg-red-700 px-6 py-1 text-white rounded-xl">
                        <img src="{{ asset('images/icons/back.png') }}" class="w-[20px] h-[20px]" alt="">
                        <span>Return to Subjects</span>
                    </a>
                </div>
                <div class="w-full flex flex-col items-center justify-center px-8 py-4 leading-tight">
                    <img class="w-[120px] h-[120px] my-0" src="{{ asset('images/logo-circle.png') }}" />
                    <h1 class="text-[3rem] font-bold text-gray-700"> NEW SUBJECT FORM </h1>
                    <span class="text-[0.7rem] text-gray-400">
                        Please be aware that all new subjects submitted through this form must be approved by the Commission on Higher Education (CHED) or the relevant accrediting body.
                    </span>
                </div>

                <div>
                    <form class="flex-col w-full px-8" action="{{ route('admin.subjects.create') }}" method="POST">
                        @csrf
                        @method('POST')

                        <!-- Hidden Subject ID -->
                        <input type="hidden" name="subj_id" value="{{ $subj_id }}"/>

                        <!-- Row 1: Subject Code and Subject Title -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex flex-col">
                                <h1 class="text-gray-500">SUBJECT CODE <span class="font-bold text-red-500">*</span></h1>
                                <input class="rounded-lg w-full" name="subj_code" type="text" required/>
                            </div>
                            <div class="flex flex-col">
                                <h1 class="text-gray-500">SUBJECT TITLE <span class="font-bold text-red-500">*</span></h1>
                                <input class="rounded-lg w-full" name="subj_title" type="text" required/>
                            </div>
                        </div>

                        <!-- Row 2: Subject Description -->
                        <div class="mt-4">
                            <div class="flex flex-col">
                                <h1 class="text-gray-500">SUBJECT DESCRIPTION</h1>
                                <textarea class="rounded-lg w-full" name="subj_description" rows="3"></textarea>
                            </div>
                        </div>

                        <!-- Row 3: Units and School Year -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div class="flex flex-col">
                                <h1 class="text-gray-500">UNITS <span class="font-bold text-red-500">*</span></h1>
                                <input class="rounded-lg w-full" name="units" type="number" required/>
                            </div>
                            <div class="flex flex-col">
                                <h1 class="text-gray-500">SCHOOL YEAR <span class="font-bold text-red-500">*</span></h1>
                                <input class="rounded-lg w-full" name="subj_sy" type="text" required/>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="w-full flex justify-end py-4">
                            <button class="maroon text-white px-12 py-2 rounded-md" type="submit">SUBMIT</button>
                        </div>
                    </form>
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
