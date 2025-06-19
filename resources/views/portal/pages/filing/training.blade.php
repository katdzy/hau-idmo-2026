<x-app-layout>
    <div class="min-h-screen">
        <div class="container">
            <div class="add-box py-4">
                <div class="ab-left">
                    <!-- Back Section -->
                    <section class="back">
                        <a href="{{ route('portal.filing.type') }}" class="back-btn">
                            <div class="btn-icon">
                                <img src="{{ asset('images/icons/back.png') }}" alt="Back Icon">
                            </div>
                            <div class="btn-text">
                                <h1>Select Category</h1>
                            </div>
                        </a>
                    </section>

                    <!-- Reminder Section -->
                    <section class="reminder">
                        <h1>Filing Application</h1>
                        <h3>Kindly double check the information before submitting.</h3>
                    </section>

                    <!-- Logo Section -->
                    <section class="logo">
                        <img src="{{ asset('images/hau-logo.png') }}" alt="Logo">
                    </section>
                </div>

                <div class="ab-right pb-8">
                    <!-- Form Title -->
                    <section class="form-title">
                        <h1>Training Details</h1>
                    </section>

                    <!-- Form Body -->
                    <section class="form-body">
                        <form action="{{ route('portal.filing.training.add') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            @if ($errors->any())
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                                    <strong class="font-bold">Error!</strong>
                                    <span class="block sm:inline"> Please fix the following issues:</span>
                                    <ul class="mt-2 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form-row row1">
                                <span>Training Title<span class="font-bold text-red-500">*</span></span>
                                <input type="text" name="title" required/>
                            </div>

                            <div class="form-row row1">
                                <span>Training Type <span class="font-bold text-red-500">*</span></span>
                                <select name="type" class="border-gray-400">
                                    @foreach($training_types as $item)
                                        <option value="{{ $item->item }}">{{ $item->item }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-row row1">
                                <span>Training Provider <span class="font-bold text-red-500">*</span></span>
                                <input type="text" name="organization" required/>
                            </div>

                            <div class="form-row row2">
                                <div class="form-col">
                                    <span>Date of Start <span class="font-bold text-red-500">*</span></span>
                                    <input type="date" name="start_date" min ="1925-01-01" max="{{ date('Y-m-d') }}" required/>
                                </div>

                                <div class="form-col">
                                    <span>Date of Completion <span class="font-bold text-red-500">*</span></span>
                                    <input type="date" name="end_date" min ="1925-01-01" max="{{ date('Y-m-d') }}" required/>
                                </div>

                                <div class="form-col">
                                    <span>Total Hours <span class="font-bold text-red-500">*</span></span>
                                    <input type="text" name="hours" required/>
                                </div>
                            </div>

                            <div class="w-full flex flex-col mb-2">
                                <span>Skills Acquired <span class="font-bold text-red-500">*</span></span>
                                <input type="text" name="skills" required/>
                            </div>

                            <div class="form-row lastrow">
                                <div class="form-col">
                                    <span>Certificate <span class="font-bold text-red-500">*</span></span>
                                    <input type="file" name="attachment" required/>
                                </div>
                                <div class="flex items-center justify-center">
                                    <button type="submit" class="btn-submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .container {
        width: 100%;
        display: flex;
        justify-content: center;
        padding-top: 3rem;
    }

    .add-box {
        width: 85%;
        border-radius: 15px;
        background-color: white;
        display: grid;
        grid-template-columns: 40% 60%;
    }

    .ab-left,
    .ab-right {
        width: 100%;
        height: 100%;
    }

    .ab-left {
        display: grid;
        grid-template-rows: 10% 15% 75%;
    }

    .ab-left section {
        width: 100%;
        height: 100%;
    }

    /* Back Button */
    .back {
        display: flex;
        justify-content: center;
        align-items: end;
    }

    .back-btn {
        display: grid;
        grid-template-columns: 25% 75%;
        background-color: maroon;
        color: white;
        width: 70%;
        height: 60%;
        border-radius: 25px;
        transition: 300ms;
    }

    .back-btn:hover {
        background-color: #A84655;
    }

    .btn-icon,
    .btn-text {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
    }

    .btn-icon {
        justify-content: end;
    }

    .btn-icon img {
        width: 15px;
        height: 15px;
    }

    .btn-text {
        padding-left: 0.7rem;
    }

    /* Reminder Section */
    .reminder {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        line-height: 1.5rem;
        padding-top: 1rem;
    }

    .reminder h1 {
        font-size: 1.5rem;
        font-weight: bold;
    }

    .reminder h3 {
        font-size: 0.8rem;
    }

    /* Logo Section */
    .logo {
        display: flex;
        justify-content: center;
    }

    .logo img {
        width: 300px;
        height: 300px;
    }

    /* ab-right Styles */
    .ab-right {
        display: grid;
        grid-template-rows: 15% 75%;
        padding-left: 2rem;
    }

    .ab-right section {
        width: 100%;
        height: 100%;
    }

    .form-title {
        display: flex;
        align-items: end;
    }

    .form-title h1 {
        font-size: 1.7rem;
        font-weight: 900;
        color: rgba(0, 0, 0, 0.7);
    }

    .form-body form {
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 2rem 1rem 0 0;
    }

    .form-row {
        width: 100%;
        display: flex;
        flex-direction: column;
        margin-bottom: 0.7rem;
    }

    .form-col {
        width: 100%;
    }

    .row1 input[type="text"] {
        width: 100%;
    }

    .row2 input[type="text"],
    .row2 input[type="date"] {
        width: 95%;
    }

    .lastrow {
        display: grid;
        grid-template-columns: 70% 30%;
    }

    .lastrow div:first-child input[type=file] {
        width: 100%;  
    }


    .row2 {
        display: grid;
        grid-template-columns: 40% 40% 20%;
    }

    .row3 {
        display: grid;
        grid-template-columns: 50% 50%;
    }

    .ab-right input[type="text"],
    .ab-right input[type="date"] {
        border: 1px solid rgba(0, 0, 0, 0.2);
        border-radius: 10px;
    }

    .ab-right input[type="text"]:active {
        border: none;
    }

    .form-row-submit {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: end;
    }

    .btn-submit {
        background-color: maroon;
        color: white;
        padding: 0.6rem 3rem;
        border-radius: 15px;
        transition: 300ms;
    }

    .btn-submit:hover {
        background-color: #A84655;
    }
</style>
