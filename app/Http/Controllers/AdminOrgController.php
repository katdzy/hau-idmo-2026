<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\orgs;
use App\Models\Subjects;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminOrgController extends Controller
{
    


    public function search(Request $request) { 
    

        $query = $request->get('query');
    


        $userDept = Auth::user()->user->emp_dept; 
        
        switch($userDept) { 
            case 'SuperAdmin': 
                $data = orgs::select('org', DB::raw('count(*) as total'))
                ->where('id', 'LIKE', "%{$query}%")
                ->orWhere('org', 'LIKE', "%{$query}%")
               ->groupBy('org') 
                ->get();
                break; 
            default: 
                $data = orgs::select('org', DB::raw('count(*) as total'))
                    ->where(function ($queryBuilder) use ($query) {
                        $queryBuilder->where('id', 'LIKE', "%{$query}%")
                            ->orWhere('org', 'LIKE', "%{$query}%");
                    })
                    ->whereHas('user', function ($userQuery) use ($userDept) {
                        $userQuery->where('emp_dept', $userDept);
                    })
                    ->groupBy('org')
                    ->get();
                    break; 

        }
        return response()->json($data);
        
    }



    public function loadOrgs() { 


        switch(Auth::user()->role)  { 
            case 'SuperAdmin': 
                $item = orgs::select('org', DB::raw('count(*) as total'))
                ->where('status', 'Approved')
                ->groupBy('org')
                ->orderBy('org')
                ->paginate(10);        

                break; 
            default: 
                $item = orgs::select('org', DB::raw('count(*) as total')) 
                ->where('status', 'Approved')
                ->whereHas('user',function( $q) { 
                    $q->where('emp_dept', Auth::user()->user->emp_dept); 
                })
                ->groupBy('org')
                ->orderBy('org') 
                ->paginate(10); 

                break; 
        }

        // dd($item); 

        return view('admin.records.orgs.main')->with([ 
            'data'=> $item
        ])      ; 
    }

    public function loadOrganization($org){ 
        switch(Auth::user()->role) { 
            case 'SuperAdmin': 
            case 'HR Admin':
                $data = orgs::where('org', $org)
                        ->where('status','Approved')
                        ->get(); 
                break; 

            default: 
                $data = orgs::where('org', $org)
                ->where('status','Approved')
                ->whereHas('user', function($q) { 
                    $q->where('emp_dept', Auth::user()->role); 
                })->get(); 

                break; 
        }

        return view('admin.records.orgs.view')->with([ 
            'org'=> $org, 
            'data'=> $data 
        ]);

        
    }


    //batch delete
    public function delete(Request $request) {
     $items = $request-> input('items'); 
     foreach($items as $item) {
        //get the organization in the current iteration, example: Code Geeks 
        $data = orgs::where('org', $item) -> get(); 

        if($data->count()>0) { 
            //iterate all of the Code Geeks, then delete
            foreach($data as $i) { 
                orgs::destroy([$i->id]); 
            }
        }
     }

     return redirect()-> route('admin.orgs'); 

    }


    //individual delete
    public function destroy($org) { 

        $data = orgs::where('org', $org) -> get(); 

        if($data->count()>0) { 
            foreach($data as $item) { 
                orgs::destroy([$item->id]); 
            }
        }

        return redirect()-> route('admin.orgs'); 

        

    }
}
