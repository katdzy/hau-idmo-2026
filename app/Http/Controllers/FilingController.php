<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\Storage; 
use Illuminate\View\View; 

use App\Models\certifications_entries;
use Illuminate\Support\Facades\DB; 



class FilingController extends Controller
{




    public function loadTypes():View { 
        return view('portal.pages.filing.splash');
    }

    public function loadCertification() { 
        return view('portal.pages.filing.certification'); 
    }


    public function loadSuccess() { 
        return view('portal.pages.filing.success');
    }
}
