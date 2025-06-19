@php
$count = 1; 



@endphp



<x-app-layout>
    <div class="container">
        <div class="con-box">
            <section class="box-header">
               <div class="categories">

                    <div class="cat-slot">
                        <form action = "{{route('portal.pending')}}">
                            <button class="{{ request()->routeIs('portal.pending') ? 'active' : '' }}" type =  "submit"> All </button> 
                        </form> 
                    </div>



                    <div class="cat-slot">
                        <form action = "{{route('portal.pending.certification')}}">
                        <button class="{{ request()->routeIs('portal.pending.certification') ? 'active' : '' }}" type =  "submit"> Certification </button> 
                        </form> 
                    </div>

                    <div class="cat-slot">
                        <form action = "{{route('portal.pending.training')}}">
                        <button class="{{ request()->routeIs('portal.pending.training') ? 'active' : '' }}" type =  "submit"> Training </button> 
                        </form> 
                    </div>

                    <div class="cat-slot">
                        <form action = "{{route('portal.pending.license')}}">
                        <button class="{{ request()->routeIs('portal.pending.license') ? 'active' : '' }}" type =  "submit"> License </button> 
                        </form> 
                    </div>

                    <div class="cat-slot">
                        <form action = "{{route('portal.pending.employment')}}">
                        <button class="{{ request()->routeIs('portal.pending.employment') ? 'active' : '' }}" type =  "submit"> Employment </button> 
                        </form> 
                    </div>

                    <div class="cat-slot">
                        <form action = "{{route('portal.pending.respub')}}" method = "GET">
                            
                        <button class="{{ request()->routeIs('portal.pending.respub') ? 'active' : '' }}" type =  "submit"> Research and Publications </button> 
                        </form> 
                    </div>

               </div>
            </section>

            <div class="tbl-header">
                    <div class="tbl-col"><h1>Employee ID </h1></div>
                    <div class="tbl-col"> <h1> Title/Name </h1></div>
                    <div class="tbl-col"> <h1> Type </h1></div>
                    <div class="tbl-col"> <h1> Date submitted </h1></div>
              
                    <div class="tbl-col"> <h1> </h1></div>
                </div>
            <section class="table-section">
                
              

                <div class="table main-dep">
                   
                    @if($pendings->count()==0) 
                        <div class = "tbl-row empty"> 
                            <h1> No pending request.</h1>
                        </div>
                    @else
                        @foreach($pendings as $item) 
                            @if($count % 2 == 0) 
                                <div class = 'tbl-row stripe'> 

                                    <div class = 'tbl-col'><h1> {{$item->emp_id}} </h1>  </div> 
                                    <div class = 'tbl-col'><h1> {{$item->title}} </h1>  </div> 
                                    <div class = 'tbl-col'><h1> {{$item-> type}}</h1> </div> 
                                  
                                    <div class = 'tbl-col'><h1> {{$item->date_submitted}}</h1> </div> 
                                    
                                <div class="tbl-col col-acts"> 
                                <form action = "{{route('portal.pending.view',['id'=>$item->id])}}" method = "GET"> 
                                            @csrf
                                            @method('GET') 
                                            <button id =  "edit" type = "submit"> Review </button>  
                                        </form> 

                    

                                      
                                       
                                    </div>
                                </div> 
                            @else 
                                <div class = 'tbl-row'> 
                                    <div class = 'tbl-col'><h1> {{$item->emp_id}} </h1>  </div> 
                                    <div class = 'tbl-col'><h1> {{$item->title}} </h1>  </div> 
                                    <div class = 'tbl-col'><h1> {{$item-> type}}</h1> </div> 
                                  
                                    <div class = 'tbl-col'><h1> {{$item->date_submitted}}</h1> </div> 
                           
                                    <div class="tbl-col col-acts"> 
                                        <form id="edit-dependent-form" action = "{{route('portal.pending.view',['id'=>$item->id])}}" method = "GET"> 
                                            @csrf
                                            @method('GET') 
                                            <button id =  "edit" type = "submit"> Review </button>  
                                        </form> 

                                     

                                      
                                    </div>
                                </div> 
                            @endif
                            

                            @php $count++; @endphp 
                        
                        @endforeach
                    @endif
            

                    
                 
                </div>

            </section>

            <section class="actions">
                <!-- for blank slots -->
                <div class="act-slot">
                   
                    
                        <h1 class = "dep-msg" id = "msg"> {{ session('msg') }} </h1>
                  
                    {{session(['msg'=> ''])}}
                 
                   
                </div> 
                <div class="act-slot"></div> 
                <div class="act-slot"></div> 
                <!-- end of blank slots  -->
                <div class="act-slot">
                 
                    <a class="act-btn" href = "{{route('portal.filing.type')}}">
                        <div class="act-btn-icon"><img src = "{{asset('images/icons/add.png')}}"/> </div>
                        <span class="act-btn-text"> File an Application </sp>
                    </a>
                
                </div>

              


                
            </section>
        </div>

        
    </div>
</x-app-layout>


<style> 

    .container { 
        width: 100% ;
        display: flex; 
        justify-content: center;
        padding: 2rem 0 ;
    }
    
    .con-box { 
        /* for windowed layout */
        border-radius: 10px; 
        width: 95%;   

        /* for full screen */
        /* width: 100%;   */

        background-color: white;
        display: flex; 
        flex-direction: column;
        align-items: center;
        padding: 1rem 0; 
       
        /* border-radius: 15px;  */
    }

    .box-header { 
        
        height: 80px; 
        width: 95%; 
        display: flex;
        
   
    }

    .categories { 
        width: 90%; 
        height: 100%; 
        
       
        display: grid; 
        grid-template-columns: 10% 17% 15% 15% 17% 26%;
    }

    .categories div { 
        width: 100%; 
        height: 100%; 
    }
    
    .cat-slot form { 
        width: 100%; 
        height: 100%;
        display: flex; 
        justify-content: center;
        align-items: center;
    }
    
    .cat-slot form button { 
        color: white; 
        width: 95%; 
        height: 50%; 
        border-radius: 10px; 
        background-color: #555556;
        transition: 300ms; 
    }

    .cat-slot form .active  { 
        background-color: #9d9898;
    }

    .cat-slot form button:hover { 
        background-color: #6c6c6c ;
    }

    .cat-slot form .active:hover{ 
        background-color:#b3aead  ;
    }




   
    .bar { 
        width: 100%; 
        margin-left: 1rem; 
        display: grid; 

        grid-template-columns: 10% 90%;
        border: 1px solid rgb(0,0,0,0.3); 
        border-radius: 15px; 
        overflow: hidden;
    }

    .icon, .searchfield { 
        width: 100%; 
        height: 100%; 
        display: flex; 
        align-items: center;
    }

    .icon { 
        justify-content: end;
    }


    .icon img { 
        width: 25px ; 
        height: 25px; 
    }

    input[type=text] {  
        border: none;
        width: 100%;
       
    
    }

    input[type="text"]:focus {
    outline: none; /* Removes the outline */
    box-shadow: none; /* Optionally removes any shadow */
    }



    .table-section { 
        width: 95% ;
        height: 350px;
        margin-bottom: 1rem;
        overflow-y: auto;
    
    }
    
        /* table template codes */
    .table { 
        width: 100%; 
        border: 1px solid rgb(0,0,0,0.1);
    }

    .tbl-header { 
       
        width: 95%; 
        height: 40px; 
        background-color: maroon;

        display: grid; 
    }

    .tbl-row { 
        width: 100%; 
        padding: 1rem 0;
        display: grid; 
        transition: 300ms; 

        
    }

    .tbl-row:hover{ 
        background-color: beige;
    }

    .tbl-row h1 { 
        color: #696969; 
        font-weight:400;
        font-size: 14px; 
    }

    .empty { 
        display: flex; 
        justify-content: center;
        align-items: center;
        color: lightgray; 
    }

    .empty span { 
        color: rgb(40, 40,40);
    }
    .table button {
        background-color: maroon;
        color: white;
        padding: 0 2.3rem;
        border-radius: 25px; 
        transition: 300ms; 
        font-size: 15px;

    }

    .table button:hover { 
        background-color: #A84655;
    }

    .tbl-col { 
        width: 100%; 
        height: 100%; 
        display: flex; 
        align-items: center;
        padding-left: 1rem;
    }
    .stripe { 
       background-color: #f7f7f7;
    }


    .tbl-header .tbl-col h1 { 
        color: white;
        font-size: 13px; 
        font-weight: 500;
        
    }
    /* should be changed based on the sizing of the table */
    .tbl-header, .main-dep .tbl-header, .main-dep .tbl-row { 
        grid-template-columns: 20% 25% 20% 20% 10%
    }

    .tbl-header { 
        grid-template-columns: 20% 25% 20% 20% 10%
    }

    .col-acts { 
       display: flex; 
       
    }

 

    .col-acts button { 
        color: white; 
        padding: 0.1rem 1rem; 
        border-radius: 10px;
        text-align: center;
        margin: 0 0.3rem;
        transition: 300ms; 
    }


    #edit {
        background-color: green; 
    }
    #edit:hover { 
        background-color: #32CD32;
    }

    #delete { 
        
        background-color: red;
    }
    
    #delete:hover { 
        background-color:#FF6347;
    }


    /*** set height of your table here | call the unique class name so that it won't affect other table*/
    .main-dep { 
        height: 350px; 
        overflow-y: auto;
        
    }


    .actions { 
        width: 95%; 
        height: 50px; 
        display: flex; 
    

    }


    .act-slot { 
        width: 35%; 
        height: 100%; 
        display: flex; 
        align-items: center;
        padding-right: 0.5rem;
        
    }

    .act-slot form { 
        width: 100%; 
        height: 100%; 
        display: flex ;
        align-items: center;

    }
    /* .act-slot button { 
        width: 100%; 
        height: 70%; 
        background-color: maroon;
        display: grid; 
        grid-template-columns: 20% 80%;
        border-radius: 10px; 
        transition: 300ms; 
    } */

    .act-btn { 
        width: 100%; 
        height: 70%; 
        background-color: maroon;
        display: grid; 
        grid-template-columns: 20% 80%;
        border-radius: 10px; 
        transition: 300ms; 
    }

    .act-btn:hover { 
        background-color: #A52A2A;
    }


   
    .act-btn-icon, .act-btn-text { 
        width: 100%; 
        height: 100%; 
        display: flex; 
        
        align-items: center;
    }


    .act-btn-icon img { 
        width: 30px ; 
        height: 30px; 
    }
    .act-btn-icon{ 
        justify-content: end;
    }

    .act-btn-text {
        padding-left:0.5rem; 
        color: white;
    }

    #msg  { 
        
    color: green;
        font-weight: 500
    }

    
   

    
    

</style>


<script>

setTimeout(function() {
            
            document.querySelector('.dep-msg').innerHTML = '';
        }, 5000); // Hide after 5 seconds


    // for confirmation 
    function confirmClearDependencies() {
        if (confirm('Are you sure you want to clear the dependencies?')) {
            document.getElementById('clear-dependencies-form').submit();
        }
    }


    function deleteDependency(button)  {
        const form = button.closest('form');
        if(confirm('Are you sure you want to cancel this request?')) { 
           form.submit()
        }

    }
      


</script> 