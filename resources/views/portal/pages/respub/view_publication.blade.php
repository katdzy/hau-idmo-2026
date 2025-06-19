@php
    $author = $user->emp_fname . ' ' . $user->emp_mname . ' ' . $user->emp_lname; 
@endphp

<x-app-layout>
    <div class="min-h-screen">
        <div class="container">
            <div class="box-card">
                <!-- Action Buttons -->
                <div class="cancel">
                    <a href="{{ route('portal.respub') }}"> 
                        <img src="{{ asset('images/icons/back.png') }}"> 
                        <h1>Return</h1>
                    </a> 

                    @if($data->status == 'To-review')
                    <a href="{{ route('portal.respub.edit', ['id' => $data->id]) }}"> 
                        <img src="{{ asset('images/icons/resubmit.png') }}"> 
                        <h1>Resubmit</h1> 
                    </a> 

                    @else
                    <a href="{{ route('portal.respub.edit', ['id' => $data->id]) }}"> 
                        <img src="{{ asset('images/icons/edit.png') }}"> 
                        <h1>Edit Details</h1> 
                    </a> 

                    @endif
                </div>

                <!-- Title -->
                <div class="box-title">
                    <h1>{{ $data->title }}</h1> 
                </div>

                <!-- Body Content -->
                <div class="box-body">
                    <!-- Description -->
                    <div class="box-row">
                        <span>Description</span>
                        <h1>{{ $data->description }}</h1>
                    </div>

                    <!-- Author, Co-author & Date Published, Participation & Type of Journal -->
                    <div class="form-row grid">
                        <!-- Author -->
                        <div class="form-col">
                            <span>Author</span>
                            <h1>{{ $author }}</h1> 
                        </div>
                    </div>

                    @foreach($coauthors as $coauthor)
                    <div class="form-row grid">
                        <div class = "form-col">
                            <span>Co-author</span>
                            <h1>{{ $coauthor->coauthor_name }}</h1>
                        </div>

                        <div class = "form-col">
                            <span>Participation (%)</span>
                            <h1>{{ $coauthor->coauthor_participation }}</h1>
                        </div>
                    </div>
                    @endforeach

                    <div class="form-row grid">
                        <!-- Type of Journal -->
                        <div class="form-col">
                            <span>Type of Journal</span>
                            <h1>{{ $data->journal_type }}</h1>
                        </div>

                        <!-- Co-author & Date Published -->
                        <div class="form-col">
                            <span>Date Published</span>
                            <h1>{{ $data->date_published }}</h1>
                        </div>

                    </div>

                    <!-- Attachment -->
                    <div class="form-row mt-2">
                        <span>Attachment</span>
                        <div class="file-attachment">
                            <img src="{{ asset('images/icons/attachment.png') }}"/> 
                            <a href="{{ asset('storage/' . $data->file_path) }}" download>{{ $data->attachment }}</a>
                        </div>
                    </div>
                    <iframe id="pdfIframe" src="{{ asset('storage/'.$data->file_path) }}" width="100%" height= "500px" ></iframe>
                </div>
            </div> 
        </div>
    </div> 
</x-app-layout>

<style>
    /* Container and Card */
    .container {
        width: 100%;
        display: flex;
        justify-content: center;
    }
    .box-card {
        width: 90%;
        margin: 2rem 0;
        padding: 2rem 0;
        border-radius: 10px;
        background-color: white;
        display: flex;
        flex-direction: column;
    }

    /* Action Buttons (Top) */
    .cancel {
        display: flex;
        align-items: center;
        padding-left: 1.5rem;
    }
    .cancel a {
        background-color: maroon;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0 0.5rem;
        padding: 0.3rem 2rem;
        border-radius: 25px;
        transition: 300ms;
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
        font-size: 1rem;
    }
    .cancel span {
        font-size: 0.7rem;
        color: gray;
        margin-left: 1rem;
        width: 30%;
    }

    /* Title */
    .box-title {
        width: 100%;
        line-height: 1.7rem;
        display: flex;
        padding: 1rem 2rem;
    }
    .box-title h1 {
        font-size: 1.7rem;
        font-weight: 900;
        color: rgb(90,90,90);
        margin: 0;
    }

    /* Body Content */
    .box-body {
        width: 100%;
        display: flex;
        flex-direction: column;
        padding: 0 2rem;
    }
    .box-row {
        display: flex;
        flex-direction: column;
        width: 100%;
        line-height: 1.5rem;
        margin-bottom: 1rem;
    }
    .box-row span {
        color: rgb(150,150,150);
        font-size: 0.7rem;
    }
    .box-row h1, .form-col h1 {
        font-size: 1rem;
        font-weight: 700;
        color: rgb(40,40,40);
    }

    /* Grids */
    .grid {
        display: grid;
        grid-template-columns: 33% 33% 33%;
        gap: 1rem;
    }
    .form-col {
        padding: 0.5rem 0;
        display: flex;
        flex-direction: column;
    }
    .form-col span {
        margin-bottom: 0.5rem;
    }

    /* Attachment */
    .file-attachment {
        display: flex;
        align-items: center;
        margin-top: 0.5rem; /* Add some space between the label and the attachment */
        overflow: hidden;
    }
    .file-attachment img {
        width: 20px;
        height: 20px;
        margin-right: 0.3rem;
    }
    .file-attachment a {
        color: darkblue;
        text-decoration: underline;
    }
    .file-attachment a:hover {
        color: blue;
    }
</style>
