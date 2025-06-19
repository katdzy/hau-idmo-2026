@php
    $author = $user->emp_fname .' '. $user->emp_mname .' '. $user->emp_lname;
@endphp

<x-app-layout>
    <div class="min-h-screen">
        <div class="container">
            <div class="box-card">
                <div class="box-title">
                    <div class="left">
                        <div class="cancel">
                            <a href="{{ route('portal.respub.type') }}">
                                <img src="{{ asset('images/icons/back.png') }}">
                                <h1> Change Type </h1>
                            </a>
                        </div>
                        <div class="rtitle">
                            <h1> Research - Submission Form</h1>
                        </div>
                    </div>
                    <div class="right">
                        <div class="logo"><img src="{{ asset('images/hau-logo.png') }}"/> </div>
                    </div>
                </div>

                <div class="box-body">
                    <form action="{{ route('portal.respub.store.research') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row" style="height: 80px">
                            <div class="form-col">
                                <span> Title <span class="font-bold text-red-500">*</span></span>
                                <input type="text" name="title" required>
                            </div>
                        </div>

                        <div class="form-row desc" style="height: 150px">
                            <div class="form-col">
                                <span> Description <span class="font-bold text-red-500">*</span></span>
                                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                            </div>
                        </div>

                        <div class="form-row grid">
                            <div class="form-col">
                                <span> Author <span class="font-bold text-red-500">*</span></span>
                                <input type="text" value="{{ $author }}" class="text-gray-500" disabled>
                            </div>
                            <div class="form-col ml-6">
                                <span> Attachment <span class="font-bold text-red-500">*</span></span>
                                <input type="file" name="attachment" required>
                            </div>
                        </div>

                        <hr/>

                        {{-- Container for ALL co-author rows --}}
                        <div id="coauthors-container">

                            {{-- First (default) row --}}
                            {{-- NOTICE: we removed the .grid class and replaced it with .coauthor-row --}}
                            <div class="coauthor-row" data-index="0">
                                <div class="coauthor-inputs">
                                    <span style= "font-weight: 500;">Co-author</span>
                                    <input type="text" name="coauthors[0][name]" style ="border: 1px solid rgba(0,0,0,0.2); border-radius: 5px;"> 
                                </div>

                                <div class="coauthor-inputs">
                                    <span style= "font-weight: 500;">Percentage of Participation</span>
                                    <input type="number"
                                        name="coauthors[0][participation]"
                                        min="1"
                                        max="100"
                                        style="width: 70px; border: 1px solid rgba(0,0,0,0.2); border-radius: 5px;">
                                </div>

                                {{-- Smaller "+" button --}}
                                <button
                                type="button"
                                class="add-coauthor-btn mt-5"
                                style="
                                    background-color: green;
                                    color: white;
                                    padding: 0.3rem 0.6rem;
                                    border-radius: 4px;
                                    border: none;
                                    cursor: pointer;
                                "
                                >
                                +
                                </button>

                                {{-- Hidden remove button on first row (default row) --}}
                                <button
                                type="button"
                                class="remove-coauthor-btn mt-5"
                                style="
                                    background-color: red;
                                    color: white;
                                    padding: 0.3rem 0.6rem;
                                    border-radius: 4px;
                                    border: none;
                                    cursor: pointer;
                                    display: none;
                                    margin-left: 0.5rem;
                                "
                                >
                                –
                                </button>
                            </div>

                        </div>{{-- end #coauthors-container --}}

                        <div class="form-row submit" style="height: 80px">
                            <div class="submit-box">
                                <button type="submit">Upload</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style> 
    .container { 
        width: 100%;
        display: flex ;
        justify-content: center;
    }

    .box-card { 
        width: 90%; 
        margin: 2rem 0;
        border-radius: 10px;
        background-color: white; 
        display: flex; 
        flex-direction: column;
    }

    .box-title { 
        width: 100%; 
        height: 120px; 
        display: grid; 
        grid-template-columns: 80% 20%;
    }

    .left, .right { 
        width: 100%; 
        height: 100%; 
    }

    .left {
        display: grid; 
        grid-template-rows: 50% 50%;
    }

    .left div { 
        width: 100%; 
        height: 100%; 
    }

    .cancel { 
        display: flex; 
        padding-left: 2rem;
        align-items: center;
    }

    .cancel a { 
        background-color: maroon;
        color: white; 
        display: flex; 
        justify-content: center;
        align-items: center;
        padding: 0.3rem 2rem;
        border-radius: 25px; 
        transition:300ms; 
    }

    .cancel a:hover {
        background-color: #A84655;
    }

    .cancel a img { 
        width: 15px; 
        height: 15px;
        margin: 0 0.5rem;
    }

    .cancel a h1 { 
        padding-right: 1rem;
    }

    .rtitle { 
        display: flex; 
        padding-left: 2rem;
    }

    .rtitle h1 { 
        font-size:2rem;
        font-weight: 900;
        color: rgb(90,90,90)
    }

    .right {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .right img {
        width: 90px; 
        height: 90px; 
    }

    .box-body { 
        width: 100%; 
        min-height: 380px;
        display: flex; 
        justify-content: center;
    }

    .box-body form { 
        width: 95%; 
        display: flex; 
        flex-direction: column;
    }

    .form-row { 
        width: 100%; 
    }

    .form-col { 
        width: 100%; 
        display: flex; 
        flex-direction: column;
        padding: 0.5rem 0;
    }

    .form-col input[type=text],
    .form-col input[type=number] { 
        width: 100%;
        border-radius: 5px; 
        border: 1px solid rgba(0,0,0,0.2);
    }

    .form-col span { 
        font-weight: 500;
    }

    .desc textarea { 
        height: 90%;
        border: 1px solid rgba(0,0,0,0.2);
    }

    .grid { 
        display: grid; 
        grid-template-columns: 40%  35% 25%;
    }

    .submit-box { 
        float: right; 
        width: 30%;
        display: flex; 
        justify-content: end;
    }

    .submit-box button { 
        width: 70%;
        height: 60%;
        padding: 0.3rem 3rem; 
        background-color: maroon;
        color: white; 
        border-radius: 10px;
        transition: 300ms;
    }

    .submit-box button:hover { 
        background-color: #A84655;
    }

    /* ================ CO-AUTHOR ROW LAYOUT ================== */

    /* We'll make each co-author row display as flex, so all items line up in one row. */
    .coauthor-row {
        display: flex;
        align-items: center;
        gap: 1rem;  /* space between items */
        margin-bottom: 0.5rem;
    }

    /* A small wrapper so each input can remain stacked label->input. */
    .coauthor-inputs {
        display: flex;
        flex-direction: column;
    }
</style>

<script>
    document.addEventListener('click', function(e) {
        // If user clicked the "+" button
        if (e.target && e.target.classList.contains('add-coauthor-btn')) {
            addCoauthorRow(e.target);
        }

        // If user clicked the remove "–" button
        if (e.target && e.target.classList.contains('remove-coauthor-btn')) {
            removeCoauthorRow(e.target);
        }
    });

    // Function to add a new co-author row
    function addCoauthorRow(plusButton) {
        // Identify the current row's data-index
        const currentRow = plusButton.closest('.coauthor-row');
        let currentIndex = parseInt(currentRow.getAttribute('data-index'));

        // We'll find the largest existing index, then increment for the new row
        const allRows = document.querySelectorAll('.coauthor-row');
        let maxIndex = 0;
        allRows.forEach(row => {
            const idx = parseInt(row.getAttribute('data-index'));
            if (idx > maxIndex) maxIndex = idx;
        });
        const newIndex = maxIndex + 1;

        // Clone the current row
        const newRow = currentRow.cloneNode(true);
        newRow.setAttribute('data-index', newIndex);

        // Fix the "name" attributes inside the new row
        const nameInput = newRow.querySelector(`input[name="coauthors[${currentIndex}][name]"]`);
        const partInput = newRow.querySelector(`input[name="coauthors[${currentIndex}][participation]"]`);

        nameInput.name = `coauthors[${newIndex}][name]`;
        nameInput.value = ''; // clear the input
        partInput.name = `coauthors[${newIndex}][participation]`;
        partInput.value = ''; // clear the input

        // Show the remove button on the new row
        const removeBtn = newRow.querySelector('.remove-coauthor-btn');
        removeBtn.style.display = 'inline-block';

        // Insert the new row AFTER the current row in the container
        const container = document.getElementById('coauthors-container');
        container.insertBefore(newRow, currentRow.nextSibling);
    }

    // Function to remove a co-author row
    function removeCoauthorRow(minusButton) {
        const row = minusButton.closest('.coauthor-row');
        row.remove();
    }
</script>
