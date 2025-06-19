

<x-app-layout>
    <div class="container">

    <div class="box-card">
            <div class="cancel">

                <div class="request">
                    <a href = "{{route('admin.pendings')}}"> 
                    
                            <img src = "{{asset('images/icons/back.png')}}"> 

                            <h1> Requests  </h1>
                    
                    </a> 
                </div>

                <div class="actions">

                <form action = "{{route('admin.pendings.toreview',['id'=>$data->id])}}" method = "POST">
                        @csrf
                        @method('PATCH')

                        <button> 
                    
                            <img src = "{{asset('images/icons/deny.png')}}"> 

                            <h1> To-review  </h1>
            
                        </button> 
                    </form>

                    <form action = "{{route('admin.pendings.approved',['id'=>$data->id])}}" method = "POST">
                        @csrf
                        @method('PATCH')

                        <button> 
                    
                            <img src = "{{asset('images/icons/approve.png')}}"> 

                            <h1> Approve  </h1>
            
                        </button> 
                    </form>
                </div>

                

                
           
                
                

            </div>


            <div class="box-title" style = "margin: -0.5rem 0 -1rem 0">
                <span> Submission details </span> 
            </div>

        <div class="box-body">

            <div class="form-row subdetails">
                <div class="form-col">
                    <span>Employee ID</span>
                    <h1>{{$user-> emp_id}}</h1>
                </div>

                <div class="form-col">
                    <span>Full Name</span>
                    <h1>{{$user-> emp_lname . ', ' . $user-> emp_fname . ' ' . $user-> emp_mname}}</h1>
                </div>

                <div class="form-col">
                    <span>Department</span>
                    <h1>{{$user-> emp_dept}}</h1>
                </div>

               

            </div>

            <div class="form-row subdetails">
                <div class="form-col">
                    <span>Request Type</span>
                    <h1>{{$requests-> type}}</h1>
                </div>

                <div class="form-col">
                    <span>Date Submitted</span>
                    <h1>{{$requests-> date_submitted}}</h1>
                </div>

            </div>
        </div>

        <hr> 

      



        <div class="box-title">
            <span>Organization </span> 
            <h1> {{$data->org }} </h1> 
        </div>

        
        <div class="box-body">
            <div class="w-2/3 grid grid-cols-2 gap-2">
    
                <div class="form-col">
                    <span> Position </span> 
                    <h1> {{$data->position}} </> 
                </div>

                <div class="form-col">
                    <span> Date Joined </span> 
                    <h1> {{$data->date_joined}} </> 
                </div>
            </div>
            
         
                <div class="form-row grid2">
                    <div  class="form-col">
                    <span style = "margin-bottom: 2rem"> Attachment </span>     
                    <div class="file-attachment">
                        <img src = "{{asset('images/icons/attachment.png')}}"/> 
                        <a href = "{{asset('storage/orgs/'.  $user->emp_id.  '/' . $data->id . '.' . explode('.', $data->attachment)[1])}}" download> {{$data -> attachment}}</a>
                    </div>
                    </div>
                </div>

                <span class="mt-4 text-gray-400">
                        Proof of Membership
                    </span>

            
                <iframe id="pdfIframe" src="{{asset('storage/orgs/'.  $user->emp_id.  '/' . $data->id . '.' . explode('.', $data->attachment)[1])}}" width="100%" height= "500px" ></iframe>

    </iframe>
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
        
        padding: 2rem 0 2rem 0;
         width: 90%; 
         margin: 2rem 0;
         
         border-radius: 10px;
         background-color: white; 
         display: flex; 
         flex-direction: column;
    }

    .subdetails { 
        display: grid; 
        grid-template-columns: 20% 30% 30%;
    }

    .box-title {
        
        width: 100%; 
        line-height: 1.3rem;
        display: flex;
        flex-direction: column;
        padding: 1rem 2rem;
        margin-top: 1rem; 
        
    }

    .box-title span { 
        font-size: 0.8rem; 
        color: gray; 
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
        display: inline-flex; 
        padding-left: 1.5rem;
        align-items: center;
    }

    .request { 
        width: 40%;
        
    }

    .cancel a { 
        background-color: maroon;
        color: white; 
        display: flex; 
        justify-content: center;
        align-items: center;
        margin: 0 0.5rem;
        padding: 0.3rem 0rem;
        border-radius: 25px; 
        transition:300ms; 
        width: 50%;

    }

    

    .cancel span { 
        font-size: 0.7rem; 
        color: gray; 
        margin-left: 1rem; 
    
        width: 30%; 
    }


    .cancel a:hover {
        background-color: #A84655;
    }

    .cancel a img, .actions img { 
        width: 15px; 
        height: 15px;
        margin: 0 0.5rem;
    }

    .cancel a h1, .actions h1 { 
        padding-right: 1rem;
    }

    .actions { 
        display: flex; 
        width: 60%;
        
    }


    .actions form { 
        width: 100%; 
        height: 100%; 
        

        display: flex; 
        justify-content: end;
    
    }
    .actions form button { 

        background-color: maroon;
        color: white; 
        display: flex; 
        justify-content: center;
        align-items: center;
        margin: 0;
        padding: 0.3rem 2rem;
        border-radius: 25px; 
        transition:300ms; 
        width: 90%;

        
       
    }



    .actions { 
        
        padding: 0 2rem;
        
        
    } 


    .actions form:first-child button { 

        background-color: red;
    }

    .actions form:first-child button:hover  { 
        background-color: #ef5350;
    }


    .actions form:last-child button{ 
        background-color: green;
    }
    .actions form:last-child button:hover { 
        background-color: #388e3c;
    }

    
    .box-title h1 { 
        font-size:1.7rem;
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

    

    
    .box-body hr { 
        opacity: 0.8
    }

    hr { 
        opacity: 1;
    }

    .long { 
        display: flex; 
    }

    .long div { 
        padding-right: 2rem;
    }
    
    .box-body { 
        width: 100%; 
        display: flex; 
        flex-direction: column;
        padding: 0 2rem;
    }

    .box-row { 
        display: flex; 
        width: 100%; 
        flex-direction: column;
        line-height: 1.5rem;
        margin-bottom: 1rem;
    }

    .box-row span, .form-col span{ 
        color: rgb(150,150,150); 
        font-size: 0.7rem;
    }

    .box-row h1,.form-col h1 { 
        font-size: 1rem ; 
        font-weight: 700;
        color:rgb(40,40,40)
    }


    


  
    .grid { 
        display: grid; 
        
        grid-template-columns: 20%  20% 20% 20% 20%;
    }

    .grid2 { 
        display: grid; 
        
        grid-template-columns: 100%

   
    } 

    .grid2 .file-attachment { 
        display: flex; 
        
        align-items: center;
        margin-top: 0rem;

    } 


    .grid input[type=text] { 
        width: 95%;
    }

    

    .grid input[type=date] { 
        width: 90%;
    }

  
    .form-col { 
        padding: 0.5rem 0;
    }
    .grid div { 
      
        width: 100%; 
        height: 100%; 
    }


    .submit-box { 
        float: right; 
        width: 30%;
        height: 100%;
        
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

    .file-attachment { 
        display: flex; 
        
        align-items: center;
        margin-top: -0.7rem;

    }

    .file-attachment { 
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

<script> 



</script> 