@php
    $author = $user->emp_fname . ' ' . $user->emp_mname . ' ' . $user->emp_lname; 
@endphp

<x-app-layout>
    <div class="container">
        <div class="box-card">
            <div class="box-title">
                <div class="left">
                    <div class="cancel">
                        <a href="{{ route('portal.respub.view', ['id' => $data->id]) }}"> 
                             <img src="{{ asset('images/icons/back.png') }}"> 
                             <h1> Cancel </h1>
                        </a> 
                    </div>
                    @if($data->status == "To-review")
                        <div class="rtitle">
                            <h1> Publication - Resubmit Form</h1>
                        </div>
                        @else
                        <div class="rtitle">
                            <h1> Publication - Edit Form</h1>
                        </div>
                        @endif
                </div>
                <div class="right">
                    <div class="logo">
                        <img src="{{ asset('images/hau-logo.png') }}"/> 
                    </div>
                </div>
            </div>

            <div class="box-body">
                <form action="{{ route('portal.respub.update', ['id' => $data->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf 
                    @method('PUT') 
                    <div class="form-row" style="margin-bottom:1rem;">
                        <div class="form-col">
                            <span> Title <span class="font-bold text-red-500">*</span></span>
                            <input type="text" id="focus" name="title" value="{{ $data->title }}" required>  
                        </div>
                    </div>

                    <div class="form-row desc" style="margin-bottom:1rem;">
                        <div class="form-col">
                            <span> Description <span class="font-bold text-red-500">*</span></span>     
                            <textarea class="form-control" id="description" name="description" rows="4" required>{{ $data->description }}</textarea>
                        </div>
                    </div>

                    <div class="form-row grid-two" style="margin-bottom:1rem;">
                        <div class="form-col">
                            <span> Type of Journal <span class="font-bold text-red-500">*</span></span>
                            <select name="journal_type" required>
                                <option value="" disabled></option>
                                <option value="review" {{ $data->journal_type == 'review' ? 'selected' : '' }}>Review</option>
                                <option value="case_study" {{ $data->journal_type == 'case_study' ? 'selected' : '' }}>Case Study</option>
                                <option value="other" {{ $data->journal_type == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <div class="form-col">
                            <span> Date Published <span class="font-bold text-red-500">*</span></span>     
                            <input type="date" name="date_published" value="{{ $data->date_published }}" min="1933-03-08" max="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>

                    <div class="form-row grid-two" style="margin-bottom:1rem;">
                        <div class="form-col">
                            <span> Author <span class="font-bold text-red-500">*</span></span>     
                            <input type="text" value="{{ $author }}" disabled> 
                        </div>
                        <!-- Attachment field removed -->
                    </div>

                    {{-- Co-authors Section --}}
                    <div id="coauthors-container">
                        @if($coauthors->count() > 0)
                            @foreach ($coauthors as $index => $coauthor)
                                <div class="coauthor-row" data-index="{{ $index }}">
                                    <div class="coauthor-inputs">
                                        <span style="font-weight: 500;">Co-author</span>
                                        <input type="text" name="coauthors[{{ $index }}][name]" value="{{ $coauthor->coauthor_name }}" style="border: 1px solid rgba(0,0,0,0.2); border-radius: 5px;">
                                    </div>
                                    <div class="coauthor-inputs">
                                        <span style="font-weight: 500;">Percentage of Participation</span>
                                        <input type="number" name="coauthors[{{ $index }}][participation]" value="{{ $coauthor->coauthor_participation }}" min="1" max="100" style="width: 70px; border: 1px solid rgba(0,0,0,0.2); border-radius: 5px;">
                                    </div>
                                    <button type="button" class="add-coauthor-btn mt-5" style="background-color: green; color: white; padding: 0.3rem 0.6rem; border-radius: 4px; border: none; cursor: pointer;">
                                        +
                                    </button>
                                    <button type="button" class="remove-coauthor-btn mt-5" style="background-color: red; color: white; padding: 0.3rem 0.6rem; border-radius: 4px; border: none; cursor: pointer; margin-left: 0.5rem;">
                                        –
                                    </button>
                                </div>
                            @endforeach
                        @else
                            <div class="coauthor-row" data-index="0">
                                <div class="coauthor-inputs">
                                    <span style="font-weight: 500;">Co-author</span>
                                    <input type="text" name="coauthors[0][name]" style="border: 1px solid rgba(0,0,0,0.2); border-radius: 5px;">
                                </div>
                                <div class="coauthor-inputs">
                                    <span style="font-weight: 500;">Percentage of Participation</span>
                                    <input type="number" name="coauthors[0][participation]" min="1" max="100" style="width: 70px; border: 1px solid rgba(0,0,0,0.2); border-radius: 5px;">
                                </div>
                                <button type="button" class="add-coauthor-btn mt-5" style="background-color: green; color: white; padding: 0.3rem 0.6rem; border-radius: 4px; border: none; cursor: pointer;">
                                    +
                                </button>
                                <button type="button" class="remove-coauthor-btn mt-5" style="background-color: red; color: white; padding: 0.3rem 0.6rem; border-radius: 4px; border: none; cursor: pointer; margin-left: 0.5rem;">
                                    –
                                </button>
                            </div>
                        @endif
                    </div>
                    {{-- End Co-authors Section --}}
                    <div class="w-2/3 flex flex-col leading-tight mt-4">
                        <span style="font-weight: 500;">Attachment <span class="font-bold text-red-500">*</span></span>


                        <div class="flex-col">
                            <div class="w-full flex items-center my-2" id="attachment">
                                <img src="{{asset('images/icons/attachment.png')}}" alt="" class="w-[20px] h-[20px]">
                                <h1 class="truncate font-semibold text-gray-600"> {{$data->attachment}} </h1>
                                <button type='button' class="bg-gray-900 hover:bg-gray-800 text-white flex items-center px-8 py-1 ml-2 rounded-lg" id = "edit_att"> 
                                    <img src="{{asset('images/icons/upload.png')}}" alt="" class="w-[20px] h-[20px]">
                                    <span>Change File</span>
                                </button>
                            </div>

                        

                        </div>

                        <div class="w-full flex  gap-2 hide" id="attachment_edit">
                            <button type = 'button' class=" bg-gray-900 hover:bg-gray-800 text-white flex items-center justify-center px-8 py-1 ml-2 rounded-lg" id = "cancel"> 
                                    <img src="{{asset('images/icons/cancel.png')}}" alt="" class="w-[20px] h-[20px]">
                                    <span>Cancel</span>
                            </button>
                            <input type="file" id = "fileinput" name = "attachment" class="text-gray-700 truncate">

                        </div>
                    </div>

                    <div class="form-row submit" style="height: 80px; margin-top: 1rem;">
                            @if($data->status == "To-review")
                            <div class="submit-box">
                                <button type="submit">Resubmit</button>
                            </div>
                            @else
                            <div class="submit-box">
                                <button type="submit">Save Changes</button>
                            </div>
                            @endif
                        </div>
                </form> 
            </div>
        </div> 
    </div> 
</x-app-layout>

<style> 
    .container { 
        width: 100%;
        display: flex;
        justify-content: center;
    }

    .box-card { 
         width: 90%; 
         margin: 2rem 0;
         border-radius: 10px;
         background-color: white; 
         display: flex; 
         flex-direction: column;
         padding: 2rem;
    }

    .box-title { 
        width: 100%; 
        height: 120px; 
        display: grid; 
        grid-template-columns: 80% 20%;
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
        text-decoration: none;
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
        font-size:1rem;
    }

    .rtitle { 
        display: flex; 
        padding-left: 2rem;
        align-items: end;
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
    }

    .form-col input[type=text],
    .form-col input[type=number],
    .form-col input[type=date],
    .form-col select {
        width: 100%;
        border-radius: 5px; 
        border: 1px solid rgba(0,0,0,0.2);
        padding:0.5rem;
    }

    .desc textarea { 
        height: 90%;
        border: 1px solid rgba(0,0,0,0.2);
        padding:0.5rem;
    }

    .form-col span { 
        font-weight: 600;  
        margin-bottom: 0.5rem; 
    }

    .grid-two {
        display: grid;
        grid-template-columns: 25% 30%;
        gap: 1rem;
    }

    .submit-box { 
        float: right; 
        width: 30%;
        height: 100%;
        display: flex; 
        justify-content: end;
        align-items: center;
    }

    .submit-box button { 
        width: 70%;
        padding: 0.5rem 3rem; 
        background-color: maroon;
        color: white; 
        border-radius: 10px;
        transition: 300ms;
        border: none;
    }

    .submit-box button:hover { 
        background-color: #A84655;
    }

    /* Co-author row styling */
    .coauthor-row {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 0.5rem;
    }
    .coauthor-inputs {
        display: flex;
        flex-direction: column;
    }

    /* Initially hide all remove buttons */
    .remove-coauthor-btn {
        display: none;
    }
</style>

<script>
    // Update remove button visibility based on current row count
    function updateRemoveButtons() {
        const allRows = document.querySelectorAll('.coauthor-row');
        if(allRows.length === 1) {
            allRows[0].querySelector('.remove-coauthor-btn').style.display = 'none';
        } else {
            allRows.forEach(row => {
                row.querySelector('.remove-coauthor-btn').style.display = 'inline-block';
            });
        }
    }

    document.addEventListener('click', function(e) {
        // Add new co-author row when "+" button is clicked
        if (e.target && e.target.classList.contains('add-coauthor-btn')) {
            addCoauthorRow(e.target);
        }
        // Remove a co-author row when "–" button is clicked
        if (e.target && e.target.classList.contains('remove-coauthor-btn')) {
            removeCoauthorRow(e.target);
        }
    });

    // Function to add a new co-author row
    function addCoauthorRow(plusButton) {
        const currentRow = plusButton.closest('.coauthor-row');
        let currentIndex = parseInt(currentRow.getAttribute('data-index'));

        // Determine the new index
        const allRows = document.querySelectorAll('.coauthor-row');
        let maxIndex = 0;
        allRows.forEach(row => {
            const idx = parseInt(row.getAttribute('data-index'));
            if (idx > maxIndex) maxIndex = idx;
        });
        const newIndex = maxIndex + 1;

        // Clone and update the row
        const newRow = currentRow.cloneNode(true);
        newRow.setAttribute('data-index', newIndex);

        // Update name attributes and clear values
        const nameInput = newRow.querySelector(`input[name="coauthors[${currentIndex}][name]"]`);
        const partInput = newRow.querySelector(`input[name="coauthors[${currentIndex}][participation]"]`);
        nameInput.name = `coauthors[${newIndex}][name]`;
        nameInput.value = '';
        partInput.name = `coauthors[${newIndex}][participation]`;
        partInput.value = '';

        // Ensure remove button is visible on the new row
        newRow.querySelector('.remove-coauthor-btn').style.display = 'inline-block';

        // Insert the new row after the current row
        const container = document.getElementById('coauthors-container');
        container.insertBefore(newRow, currentRow.nextSibling);

        // Update remove button visibility
        updateRemoveButtons();
    }

    // Function to remove a co-author row
    function removeCoauthorRow(minusButton) {
        const row = minusButton.closest('.coauthor-row');
        row.remove();
        // Update remove button visibility after removal
        updateRemoveButtons();
    }

    window.onload = function() {
        var input = document.getElementById('focus');
        if(input) {
            input.focus();
            input.setSelectionRange(input.value.length, input.value.length);
        }
        updateRemoveButtons();
    };
</script>

<script>
    
let attachment = document.getElementById('attachment'); 
let attachment_edit = document.getElementById('attachment_edit') 

let attachment_btn = document.getElementById('edit_att') 
let cancel_btn = document.getElementById('cancel')
 
attachment_btn.addEventListener("click",()=> { 

        attachment_edit.classList.remove('hide'); 

        attachment.classList.add('hide'); 
        document.getElementById('fileinput').setAttribute('required', 'required');


})

cancel_btn.addEventListener('click' ,()=> { 
    attachment_edit.classList.add('hide'); 

    //clear the file input value
    const fileinput = document.getElementById('fileinput')
    fileinput.value ='',
    fileinput.removeAttribute('required');
    attachment.classList.remove('hide'); 
})




</script>

