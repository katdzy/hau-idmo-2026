<x-app-layout>
  <div class="container">

    <div class="con-card">
        <div class="title-card">
            <div class="image-logo"> <img src = "{{asset('images/hau-logo.png')}}"> </div>
            <div class="card-text"> <h1> Submit Application </h1> </div>
        </div>

        <div class="card-buttons">
            <div class="card-slot">
                <a href = "{{route('portal.filing.certification')}}"> 
                    <div class="card-btn">
                        <div class="card-icon"> <img src ="{{asset('images/icons/cert_maroon.png')}}"></div>
                        <div class="card-text"><h1>Certification </h1> </div>
                    </div>
                </a> 
            </div>

            <div class="card-slot">
                <a href = "{{route('portal.filing.training')}}"> 
                    <div class="card-btn">
                        <div class="card-icon"> <img src ="{{asset('images/icons/training_maroon.png')}}"></div>
                        <div class="card-text"><h1>Training </h1> </div>
                    </div>
                </a> 
            </div>

            <div class="card-slot">
                <a href = "{{route('portal.filing.license')}}"> 
                    <div class="card-btn">
                        <div class="card-icon"> <img src ="{{asset('images/icons/license_maroon.png')}}"></div>
                        <div class="card-text"><h1>License  </h1> </div>
                    </div>
                </a> 
            </div>

            <div class="card-slot">
                <a href = "{{route('portal.filing.employment')}}" > 
                    <div class="card-btn">
                        <div class="card-icon"> <img src ="{{asset('images/icons/employment_maroon.png')}}"></div>
                        <div class="card-text"><h1>Employment   </h1> </div>
                    </div>
                </a> 
            </div>
            
            <div class="card-slot">
                <a href = "{{route('portal.org.add')}}">
                    <div class="card-btn">
                        <div class="card-icon"><img src="{{asset('images/icons/organizations_maroon.png')}}"></div>
                        <div class="card-text"><h1>Organizations</h1></div>
                    </div>
                </a>
            </div>
            <div class="card-slot">
                <a href = "{{route('portal.filing.edu-bg')}}">
                    <div class="card-btn">
                        <div class="card-icon"><img src="{{asset('images/icons/education_maroon.png')}}"></div>
                        <div class="card-text"><h1>Educational Background</h1></div>
                    </div>
                </a>
            </div>
            <div class="card-slot">
                <a href="{{route('portal.respub.add.research')}}">
                    <div class="card-btn">
                        <div class="card-icon"><img src="{{asset('images/icons/research_maroon.png')}}"></div>
                        <div class="card-text"><h1>Research</h1></div>
                    </div>
                </a>
            </div>
            <div class="card-slot">
                <a href="{{route('portal.respub.add.publication')}}"> 
                    <div class="card-btn">
                        <div class="card-icon"><img src="{{asset('images/icons/publication_maroon.png')}}"></div>
                        <div class="card-text"><h1>Publication</h1></div>
                    </div>
                </a>
            </div>
            <div class="card-slot">
                <a href = "{{route('portal.dependencies.add')}}">
                    <div class="card-btn">
                        <div class="card-icon"><img src="{{asset('images/icons/dependents_maroon.png')}}"></div>
                        <div class="card-text"><h1>Dependents</h1></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
  </div>
  </x-app-layout>
  <style>
    .container {
    width: 100%;
}

.con-card {
    width: 100%;
    height: auto;
    display: flex;
    flex-direction: column;
    gap: 20px;
    align-items: center;
    margin-bottom: 30px;
}

.title-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin-top: 30px;
}

.image-logo img {
    width: 160px;
    height: auto;
}

.card-buttons {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
    justify-content: center;
}

.card-slot {
    display: flex;
    justify-content: center;
    align-items: center;
}

.card-slot a {
    width: 100%;
    height: 100%;
    text-decoration: none;
}

.card-btn {
    width: 95%;
    height: 210px;
    border-radius: 15px;
    background-color: white;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    transition: 300ms;
}

.card-btn:hover {
    transform: scale(1.05);
}

.card-icon img {
    width: 90px;
    height: 90px;
}

.card-text h1 {
    font-size: 1.4rem;
    font-weight: bold;
    color: maroon;
    text-align: center;
}

  </style>
