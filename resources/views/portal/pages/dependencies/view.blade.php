@php 
    $file = $viewdata->id . '.' . explode('.', $viewdata->attachment)[1]; 
@endphp

<x-app-layout>
    <div class="container">
        <div class="add-box">
            <!-- Top Row: Details -->
            <div class="details">
                <!-- LEFT SIDE -->
                <div class="ab-left">
                    <section class="back">
                        <a href="{{ route('portal.dependencies') }}" class="back-btn">
                            <div class="btn-icon">
                                <img src="{{ asset('images/icons/back.png') }}" alt="Back Icon"> 
                            </div>
                            <div class="btn-text">
                                <h1>Back to Manage</h1>
                            </div>
                        </a>
                    </section>
                    <section class="logo">
                        <img src="{{ asset('images/hau-logo.png') }}" alt="Logo"> 
                    </section>
                </div>
                
                <!-- RIGHT SIDE -->
                <div class="ab-right">
                    <section class="form-title">
                        <h1>Dependent Details</h1>
                        <div class="form-edit">
                            @if($viewdata->status != "To-review")
                            <a href="{{ route('portal.dependencies.edit', ['id' => $viewdata->id]) }}">
                                <img src="{{ asset('images/icons/edit.png') }}" alt="Edit Icon"> 
                                <span>Edit</span>
                            </a> 
                            @else
                            <a href="{{ route('portal.dependencies.edit', ['id' => $viewdata->id]) }}">
                                <img src="{{ asset('images/icons/resubmit.png') }}" alt="Edit Icon"> 
                                <span>Resubmit</span>
                            </a> 
                            @endif
                        </div>
                    </section>
                    
                    <section class="form-body">
                        <div class="form-row">
                            <span>First Name</span>
                            <h1>{{ $viewdata->fname }}</h1>  
                        </div>
                        <div class="form-row">
                            <span>Middle Name</span>   
                            <h1>{{ $viewdata->mname }}</h1> 
                        </div>
                        <div class="form-row">
                            <span>Last Name</span>
                            <h1>{{ $viewdata->lname }}</h1>
                        </div>
                        <div class="form-row">
                            <span>Relationship</span>
                            <h1>{{ $viewdata->relationship }}</h1>
                        </div>
                        <div class="form-row">
                            <span>Date of Birth</span>
                            <h1>{{ $viewdata->date_of_birth }}</h1>
                        </div>
                    </section>
                </div>
            </div>
            
            <!-- Bottom Row: Birth Certificate -->
            <div class="birth-certificate">
                <span class="certificate-label">Birth Certificate</span>
                @if(isset($approval)) 
                    <iframe id="pdfIframe" src="{{ asset('storage/dependents/' . $user->emp_id . '/' . $file) }}" width="100%" height="500px"></iframe>
                @else
                    <iframe id="pdfIframe" src="{{ asset('storage/dependents/' . Auth::user()->id . '/' . $file) }}" width="100%" height="500px"></iframe>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    /* Container centers the add-box */
    .container { 
        width: 100%; 
        display: flex; 
        justify-content: center;
        padding-top: 3rem; 
    }

    /* The white box now has two rows: details and certificate */
    .add-box { 
        width: 85%; 
        background-color: white;
        border-radius: 15px;  
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        display: grid;
        grid-template-rows: auto auto;
    }

    /* Top row: Two-column grid for details */
    .details { 
        display: grid; 
        grid-template-columns: 40% 60%;
    }

    .ab-left, .ab-right  {
        width: 100%; 
        /* Removed fixed height so content can size naturally */
    }

    .ab-left { 
        display: grid; 
        grid-template-rows: 15% 85%;
    }

    .ab-left section { 
        width: 100%; 
        height: 100%; 
    }

    .back { 
        display: flex; 
        justify-content: center;
        align-items: flex-end;
        padding: 1rem;
    }
    
    .back-btn { 
        display: grid; 
        grid-template-columns: 25% 75%;
        background-color: maroon;
        color: white; 
        width: 70%; 
        height: 90%;
        border-radius: 25px; 
        transition: background-color 300ms;
        text-decoration: none;
    }

    .back-btn:hover { 
        background-color: #A84655;
    }

    .btn-icon, .btn-text { 
        width: 100%; 
        height: 100%; 
        display: flex; 
        align-items: center;
    }

    .btn-text { 
        padding-left: 0.7rem;
    }
    
    .btn-icon { 
        justify-content: flex-end;
    }

    .btn-icon img { 
        width: 15px; 
        height: 15px; 
    }

    .logo { 
        display: flex; 
        justify-content: center; 
        align-items: center;
    }
    
    .logo img { 
        width: 300px; 
        height: 300px;
    }

    .ab-right { 
        display: grid; 
        grid-template-rows: auto auto;
        padding: 2rem;
    }

    .form-title { 
        display: flex; 
        justify-content: space-between;
        align-items: flex-end;
    }

    .form-edit { 
        display: flex; 
        align-items: center;
    }

    .form-edit a { 
        display: flex; 
        align-items: center;
        justify-content: center;
        background-color: maroon;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 25px; 
        text-decoration: none;
        transition: background-color 300ms;
    }

    .form-edit a:hover { 
        background-color: #A84655;
    }

    .form-edit a span { 
        font-size: 1rem;
        margin-left: 0.5rem;
    }

    .form-edit img { 
        width: 25px; 
        height: 25px;
    }

    .form-title h1 { 
        font-size: 1.7rem; 
        font-weight: 900;
        color: rgba(0,0,0,0.7);
    }

    .form-body { 
        display: flex; 
        flex-direction: column;
        margin-top: 1rem;
    }

    .form-row {
        margin: 0.5rem 0;
        display: flex; 
        flex-direction: column;
    }

    .form-row span { 
        font-size: 0.8rem;
        color: gray;
    }

    .form-row h1 { 
        font-weight: 700;
        font-size: 1.5rem;
    }

    /* Bottom row: Certificate styling */
    .birth-certificate {
        padding: 1rem 2rem 2rem 2rem;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .certificate-label {
        margin-bottom: 1rem;
        font-size: 1rem;
        color: gray;
    }
</style>
