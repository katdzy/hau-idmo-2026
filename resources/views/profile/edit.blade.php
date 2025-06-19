<x-app-layout>
    <div class="container"> 
        <div class="form-div"> 
            <div class="profile-form"> 
                @include('profile.partials.update-profile-information-form')
            </div> 
        </div>
        
        <div class="form-div"> 
            <div class="profile-form"> 
                @include('profile.partials.update-password-form')
            </div> 
        </div> 
    </div> 
</x-app-layout>

<style> 
    .container { 
        width: 100%;  
    }

    .form-div { 
        padding: 2rem 1rem;
        width: 100%;
        display: flex; 
        justify-content: center;
    }

    .profile-form {
        border-radius: 15px;
        display: flex; 
        justify-content: center;
        align-items: center;
        background-color: white; 
        width: 90%; 
    }
</style>
