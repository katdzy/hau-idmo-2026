<?php

namespace App\Http\Controllers;

use App\Models\semconfig;
use Illuminate\Http\Request;

class SemesterController extends Controller
{

    public function index() { 
        $latest_reg = semconfig::where('category', 'reg')->first(); 
        $latest_tri  =semconfig::where('category', 'tri')-> first(); 

        $msg = ''; 
     

        if(session('sem_msg') == true) { 
            $msg = 'The semester has been updated successfully.'; 
            session(['sem_msg'=> false]) ;
          
        }
        return view('admin.config.sem.main')->with([ 
            'reg'=> $latest_reg, 
            'tri'=> $latest_tri, 
            'msg'=> $msg, 
        ]); 


    }
    public function updateRegular(Request $request) { 
        $data = semconfig::where('id',1)-> first(); 

        $data->update([ 
            'current_sy'=> $request->sy, 
            'current_sem'=> $request->sem
        ]) ;

        session([
            'sem_msg'=> true
        ]); 

        return redirect()->route('admin.sem'); 

    }

    public function updateTrimester(Request $request) { 
        $data = semconfig::where('id',2)-> first(); 
        $data->update([ 
            'current_sy'=> $request->sy, 
            'current_sem'=> $request->sem
        ]) ;

        session([
            'sem_msg'=> true
        ]); 
        return redirect()->route('admin.sem'); 




    }
}
