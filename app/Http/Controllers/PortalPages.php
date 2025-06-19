<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View; 
use Illuminate\Support\Facades\Auth;

//import models here
use App\Models\dependencies; 

class PortalPages extends Controller
{

    public function loadDependencies(Request $request): View 
    { 

        $userId = Auth::user()->id; 
        $dependencies = dependencies::where('emp_id', $userId)-> get(); 

        session(['dependencies'=> $dependencies]); 
        return view('portal.pages.dependencies');



    }

}
