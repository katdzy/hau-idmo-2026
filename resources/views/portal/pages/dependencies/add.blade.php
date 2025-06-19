<x-app-layout>

<div class= "min-h-screen">
    <div class="container">

        <div class="add-box">
            <div class="ab-left">
                <section class="back">
                    <a href="{{route('portal.dependencies')}}" class="back-btn">
                        <div class="btn-icon">
                            <img src= "{{asset('images/icons/back.png')}}"> 
                        </div>
                        <div class="btn-text"> <h1>Back to Manage </h1> </div>
                    </a>
                </section>
                <section class="reminder">
                    <h1> Add New Dependent</h1> 
                    <h3> Kindly double check the information before submitting.</h3>
                </section>
                <section class="logo">
                    <img src = "{{asset('images/hau-logo.png')}}"/> 
                </section>
            </div>
            <div class="ab-right">

                <section class="form-title">
                    <h1> Dependent Details </h1> 
                </section>

                <section class="form-body">
                    <form action = "{{route('portal.dependencies.addnew')}}" method = "POST" enctype="multipart/form-data"> 
                        @csrf
                        @method('POST')

                        <!-- First Name -->
                        <div class="form-row">
                            <span>First Name <span class="required-indicator">*</span></span>
                            <input type="text" name="fname" value="{{ old('fname') }}" required /> 
                        </div>

                        <!-- Middle Name -->
                        <div class="form-row">
                            <span>Middle Name</span>   
                            <input type="text" name="mname" value="{{ old('mname') }}" /> 
                        </div>

                        <!-- Last Name -->
                        <div class="form-row">
                            <span>Last Name <span class="required-indicator">*</span></span>
                            <input type="text" name="lname" value="{{ old('lname') }}" required /> 
                        </div>

                        <!-- Relationship -->
                        <div class="form-row">
                            <span>Relationship <span class="required-indicator">*</span></span>
                            <input type="text" name="relationship" value="{{ old('relationship') }}" required /> 
                        </div>

                        <!-- Date of Birth -->
                        <div class="form-row">
                        <div class="form-row">
                        <span>Date of Birth <span class="required-indicator">*</span></span>
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" required min ="1925-01-01" max="{{ date('Y-m-d') }}" />
                        
                        @error('date_of_birth')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror 
                        </div>

                        <div class="w-full flex flex-col leading-tight">
                            <span class=" text-gray-400">Attachment | Birth Certificate<span class="required-indicator">*</span></span>
                            <input type="file" name = "attachment" required>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-row-submit">
                            <button type="submit" class="btn-submit"> Submit </button>
                        </div>

                    </form> 
                </section>




            </div>
        </div>

    </div>
</div>

</x-app-layout>

<style> 
    .required-indicator {
            color: red;
            font-weight: bold;
        }


    .container { 
        width: 100%; 
        display: flex; 
        justify-content: center;
        padding-top: 3rem; 
    }

    .add-box { 
        width: 85%; 
        height: 520px;
        border-radius: 15px;  
        background-color: white;
        display: grid; 
        grid-template-columns: 40% 60%;
    }

    .ab-left, .ab-right  {
        width: 100%; 
        height: 100%;
        /* border: 1px solid red; */
    }

    .ab-left { 
        display: grid; 
        grid-template-rows: 10% 15% 75%;
    }

    .ab-left section { 
        width: 100%; 
        height: 100%; 
    }

    .back { 
        display: flex; 
        justify-content: center;
        align-items:end;
    }
    
    .back-btn { 
        display:grid; 
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
        justify-content: end;
    }

    .btn-icon img  { 
        width: 15px; 
        height: 15px; 
    }

   

    .reminder { 
        /* border: 1px solid red; */
        display: flex; 
        flex-direction: column;
        align-items: center;
        /* justify-content: center; */
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
        /* line-height: 0.8rem; */
    }

    .logo { 
        display: flex; 
        justify-content: center; 
        
    }

    .logo img { 
        width: 300px; 
        height: 300px;
    }


    .ab-right { 
        display:grid; 
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
        color: rgb(0,0,0,0.7)
    }

    .form-body form { 
        display: flex;
        flex-direction: column;
       
    }

    .form-row { 
        width: 100%;
        height: 100%; 
        display: flex; 
        flex-direction: column;
    }

    .ab-right input[type=text], .ab-right input[type=date] { 
        width: 90%; 
        border: 1px solid rgb(0,0,0,0.2); 
        border-radius: 10px; 

    }

    .ab-right input[type=text]:active { 
        border: none;
    }
    
    .form-row-submit {
        width: 100%; 
        height: 100%; 
        display: flex; 
        align-items: center;
        justify-content: end;
        padding-top: 0.7rem;
        padding-right: 3rem;
    }

    .btn-submit {
        background-color: maroon;
        color: white; 
        padding: 0.6rem 3rem;
        border-radius: 15px; 
        transition :300ms;
    }

    .btn-submit:hover { 
        background-color: #A84655;
    }

    

</style> 