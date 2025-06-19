<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View; 
use Illuminate\Support\Facades\Auth;
use App\Models\dependencies; 
use App\Models\Research; 
use App\Models\Publication; 
use App\Models\requests; 
use App\Models\certifications;
use App\Models\Employee;
use App\Models\orgs;

class PendingController extends Controller
{
    protected function delete_certification($id) { 
        $item = certifications::findOrFail($id);
        $delete = $item->delete();

        if ($delete) {
            $del_req = requests::findOrFail($id);
            if ($del_req->delete()) {
                return true; 
            }
        }
        return false;
    } 

    protected function delete_respub($id) {
        // Check if it's a research
        $item = Research::find($id);
        if ($item) {
            $delete = $item->delete();
            if ($delete) {
                $del_req = requests::findOrFail($id);
                if ($del_req->delete()) {
                    return true; 
                }
            }
        } else {
            // Check if it's a publication
            $item = Publication::findOrFail($id);
            $delete = $item->delete();
            if ($delete) {
                $del_req = requests::findOrFail($id);
                if ($del_req->delete()) {
                    return true; 
                }
            }
        }
        return false;
    }

    function create(): View {
        $user_id = Auth::user()->id;

        $pendings = requests::where('emp_id', $user_id)
            ->where(function($query) {
                $query->whereHas('certifications', function($subQuery) {
                    $subQuery->where('status', 'Pending');
                })
                ->orWhereHas('research', function($sq) {
                    $sq->where('status', 'Pending');
                })
                ->orWhereHas('publication', function($sq) {
                    $sq->where('status', 'Pending');
                })
                ->orWhereHas('education', function($subQuery) {
                    $subQuery->where('status', 'Pending');
                })
                ->orWhereHas('employment', function($subQuery) {
                    $subQuery->where('status', 'Pending');
                })
                ->orWhereHas('training', function($sq){
                    $sq->where('status','Pending');
                })
                ->orWhereHas('license', function($sq){
                    $sq->where('status','Pending');
                })
                ->orWhereHas('orgs', function($sq){
                    $sq->where('status','Pending');
                })
                ->orWhereHas('dependents', function($sq){
                    $sq->where('status','Pending');
                });
            })
            ->orderBy('type', 'asc')
            ->get();

        $certifications = requests::where('emp_id', $user_id)
            ->whereHas('certifications', function($sq) {
                $sq->where('status', 'Pending');
            })
            ->orderBy('date_submitted', 'desc')->get(); 

        $respubs = requests::where('emp_id', $user_id)
            ->where(function($query) {
                $query->whereHas('research', function($sq) { 
                    $sq->where('status', 'Pending'); 
                })
                ->orWhereHas('publication', function($sq) {
                    $sq->where('status', 'Pending');
                });
            })->orderBy('date_submitted', 'desc')->get(); 

        $educations = requests::where('emp_id', $user_id)
            ->whereHas('education', function($sq) {
                $sq->where('status', 'Pending'); 
            })->orderBy('date_submitted', 'desc')->get();

        $employments = requests::where('emp_id', $user_id)
            ->whereHas('employment', function($sq) {
                $sq->where('status', 'Pending'); 
            })->orderBy('date_submitted', 'desc')->get(); 

        $licenses = requests::where('emp_id', $user_id)
            ->whereHas('license', function($sq){
                $sq->where('status', 'Pending');
            })->orderBy('date_submitted' ,'desc')->get();

        $trainings = requests::where('emp_id' ,$user_id)
            ->whereHas('training', function($sq) {
                $sq->where('status','Pending'); 
            })->orderBy('date_submitted', 'desc')-> get(); 

        $orgs = requests::where('emp_id' ,$user_id)
            ->whereHas('orgs', function($sq) {
                $sq->where('status','Pending'); 
            })->orderBy('date_submitted', 'desc')-> get(); 

        $dependents = requests::where('emp_id' ,$user_id)
            ->whereHas('dependents', function($sq) {
                $sq->where('status','Pending'); 
            })->orderBy('date_submitted', 'desc')-> get(); 

        return view('portal.pages.filing.pending-requests')->with([
            'user'=> Employee::where('emp_id', $user_id)->first(),
            'pendings'=> $pendings, 
            'certifications'=> $certifications,
            'respubs'=> $respubs,
            'educations'=> $educations,
            'employments'=> $employments,
            'trainings'=> $trainings, 
            'licenses'=>$licenses,
            'orgs'=>$orgs,
            'dependents'=>$dependents
        ]);
    }

    function viewInfo($id) { 
        $info = requests::where('id', $id)->first(); 
        switch($info->type) { 
            case 'Research':
            case 'Publication':  
                return redirect()->route('portal.respub.view', ['id'=> $id]); 
            case 'Certification': 
                return redirect()->route('portal.certifications.view', ['id'=> $id]); 
            case 'Education': 
                return redirect()->route('portal.edu-bg.view', ['id'=> $id]);
            case 'Employment': 
                return redirect()->route('portal.employment.view', ['id'=> $id]);
            case 'Dependent': 
                return redirect()->route('portal.dependencies.view', ['id'=> $id]);
        } 
    }

    function destroyRequest($id) { 
        $info = requests::where('id', $id)->first(); 
        switch($info->type) { 
            case 'Certification': 
                if($this->delete_certification($id)) { 
                    session(['msg' => 'Certification was deleted.']);
                    return redirect()->route('portal.pending.certification');
                }
                break;
            case 'Research':
            case 'Publication':  
                if($this->delete_respub($id)) { 
                    session(['msg' => 'Research/publication was deleted.']);
                    return redirect()->route('portal.pending.respub');
                }
                break;
        }
    }

    public function search(Request $request) {
        // $emp_dept = Employee::where('emp_id', Auth::user()->id)->value('emp_dept'); 
        $query = $request->get('query');

        $emp = Employee::where('emp_id', 'LIKE', "%{$query}%")
                    ->orWhere('emp_fname', 'LIKE', "%{$query}%")
                    ->orWhere('emp_mname', 'LIKE', "%{$query}%")
                    ->orWhere('emp_lname', 'LIKE', "%{$query}%")
                    ->get();

        /* switch(Auth::user()->role) { 
            case 'SuperAdmin': 
                $emp = Employee::where('emp_id', 'LIKE', "%{$query}%")
                    ->orWhere('emp_fname', 'LIKE', "%{$query}%")
                    ->orWhere('emp_mname', 'LIKE', "%{$query}%")
                    ->orWhere('emp_lname', 'LIKE', "%{$query}%")
                    ->get();
                break; 
            case 'HR Admin': 
                $emp = Employee::where('emp_dept', $emp_dept)
                    ->where(function($subQuery) use ($query){ 
                        $subQuery->where('emp_id', 'LIKE', "%{$query}%")
                            ->orWhere('emp_fname', 'LIKE', "%{$query}%")
                            ->orWhere('emp_mname', 'LIKE', "%{$query}%")
                            ->orWhere('emp_lname', 'LIKE', "%{$query}%");
                    })
                    ->get(); 
                break; 
        }
 */
        return response()->json($emp);
    }
}
