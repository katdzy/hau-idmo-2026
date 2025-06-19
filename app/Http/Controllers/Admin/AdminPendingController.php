<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\certifications;
use App\Models\dependencies;
use App\Models\Employee;
use App\Models\Education;
use App\Models\Employment;
use App\Models\Licenses;
use App\Models\requests;
use App\Models\Research;
use App\Models\orgs;
use App\Models\Publication;
use App\Models\ResearchCoauthor;
use App\Models\PublicationCoauthor;
use App\Models\Trainings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; 

class AdminPendingController
{
    protected function fetchGroup($role) { 
        // For all requests that are pending
        // Adjusted queries to check research() and publication() relationships
        if ($role == 'SuperAdmin' || $role == 'HR Admin') {
            $all = requests::where(function ($query) {
                    $query->whereHas('certifications', function ($subQuery) {
                        $subQuery->where('status', 'Pending');
                    })
                    ->orWhereHas('research', function($subQuery) {
                        $subQuery->where('status', 'Pending');
                    })
                    ->orWhereHas('publication', function($subQuery) {
                        $subQuery->where('status', 'Pending');
                    })
                    ->orWhereHas('education', function($subQuery) {
                        $subQuery->where('status', 'Pending');
                    })
                    ->orWhereHas('employment', function($subQuery) {
                        $subQuery->where('status', 'Pending');
                    })
                    ->orWhereHas('training', function($subQuery) {
                        $subQuery->where('status', 'Pending');
                    })
                    ->orWhereHas('license', function($subQuery) {
                        $subQuery->where('status','Pending');
                    })
                    ->orWhereHas('orgs', function($subQuery) {
                        $subQuery->where('status','Pending');
                    })
                    ->orWhereHas('dependents', function($subQuery) {
                        $subQuery->where('status','Pending');
                    });
                })
                ->orderBy('type', 'asc')
                ->get();

            $certifications = requests::where('type', 'Certification')
                ->whereHas('certifications', function($sq) {
                    $sq->where('status','Pending')
                       ->where('hau_cert',NULL);
                })->orderBy('date_submitted', 'asc')->get();

            $educations = requests::where('type','Education')
                ->whereHas('education', function($sq) {
                    $sq->where('status','Pending');
                })->orderBy('date_submitted', 'asc')->get(); 

            $employments = requests::where('type','Employment')
                ->whereHas('employment', function($sq) {
                    $sq->where('status','Pending');
                })->orderBy('date_submitted', 'asc')->get(); 


            $researchQuery = requests::where('type', 'Research')
                ->whereHas('research', function($sq) {
                    $sq->where('status', 'Pending');
                });
                
            $publicationQuery = requests::where('type', 'Publication')
                ->whereHas('publication', function($sq) {
                    $sq->where('status', 'Pending');
                });
            
            // Combine them using union
            $respubs = $researchQuery->union($publicationQuery)
                ->orderBy('date_submitted', 'asc')
                ->get();

            $hauCerts = requests::where('type', 'HAU Certificate')
                ->whereHas('certifications', function($sq){
                    $sq->where('status','Pending')
                        ->whereNotNull('hau_cert');
                });
            
            $pendingTrainings = requests::where('type', 'Training')
                ->whereHas('training', function($sq) {
                    $sq->where('status','Pending'); 
                });
            
            $trainings = $hauCerts->union($pendingTrainings)
                ->orderBy('date_submitted', 'asc')
                ->get();

            $licenses = requests::where('type', 'License')
                ->whereHas('license', function($sq) {
                    $sq->where('status', 'Pending');
                })->orderBy('date_submitted')->get();

            $orgs = requests::where('type', 'Organization')
                ->whereHas('orgs', function($sq) {
                    $sq->where('status', 'Pending');
                })->orderBy('date_submitted')->get();

            $dependents = requests::where('type', 'Dependent')
                ->whereHas('dependents', function($sq) {
                    $sq->where('status', 'Pending');
                })->orderBy('date_submitted')->get();
        } else {
            // For role like 'Dean' or others restricted by dept
            $all = requests::
                whereHas('user', function ($query) {
                    $query->where('emp_dept', Auth::user()->user->emp_dept);  
                })
                ->where(function ($query) {
                    $query->whereHas('certifications', function ($subQuery) {
                        $subQuery->where('status', 'Pending');
                    })
                    ->orWhereHas('research', function($sq) {
                        $sq->where('status','Pending');
                    })
                    ->orWhereHas('publication', function($sq) {
                        $sq->where('status','Pending');
                    })
                    ->orWhereHas('education', function($subQuery) {
                        $subQuery->where('status', 'Pending');
                    })
                    ->orWhereHas('employment', function($subQuery) {
                        $subQuery->where('status', 'Pending');
                    })
                    ->orWhereHas('training', function($subQuery) {
                        $subQuery->where('status', 'Pending');
                    })
                    ->orWhereHas('license', function($subQuery) {
                        $subQuery->where('status','Pending');
                    })
                    ->orWhereHas('orgs', function($subQuery) {
                        $subQuery->where('status','Pending');
                    })
                    ->orWhereHas('dependents', function($subQuery) {
                        $subQuery->where('status','Pending');
                    });
                })
                ->orderBy('date_submitted', 'desc')
                ->get();

            $certifications = requests::whereHas('user', function($q) {
                    $q->where('emp_dept', Auth::user()->user->emp_dept);
                })
                ->whereHas('certifications', function($query) {
                    $query->where('status', 'Pending')
                        ->where('hau_cert',NULL);
                })->orderBy('date_submitted', 'asc')->get();
            
            $educations = requests::whereHas('user', function($user) {
                    $user->where("emp_dept", Auth::user()->user->emp_dept);
                })
                ->whereHas('education', function($q) {
                    $q->where('status','Pending');  
                })->orderBy('date_submitted', 'asc')->get();

            $employments = requests::whereHas('user', function($user) {
                    $user->where("emp_dept", Auth::user()->user->emp_dept);
                })
                ->whereHas('employment', function($q) {
                    $q->where('status','Pending');  
                })->orderBy('date_submitted', 'asc')->get();

            $respubs = requests::whereHas('user', function($user) {
                    $user->where('emp_dept', Auth::user()->user->emp_dept);
                })
                ->where(function($q) {
                    $q->whereHas('research', function($sq) {
                        $sq->where('status','Pending');
                    })
                    ->orWhereHas('publication', function($sq) {
                        $sq->where('status','Pending');
                    });
                })
                ->orderBy('date_submitted', 'asc')->get();

            $hauCerts = requests::whereHas('user', function($q) {
                    $q->where('emp_dept', Auth::user()->user->emp_dept);
                })
                ->whereHas('certifications', function($query) {
                    $query->where('status', 'Pending')
                        ->whereNotNull('hau_cert');
                })->orderBy('date_submitted', 'asc');

            $pendingTrainings = requests::whereHas('user', function($user) {
                    $user->where('emp_dept', Auth::user()->user->emp_dept);
                })
                ->whereHas('training', function($q) {
                    $q->where('status','Pending');
                })->orderBy('date_submitted', 'asc');
            
            $trainings = $hauCerts->union($pendingTrainings)
                ->orderBy('date_submitted', 'asc')
                ->get();

            $licenses = requests::whereHas('user', function($user) {
                    $user->where('emp_dept', Auth::user()->user->emp_dept);
                })
                ->whereHas('license', function($q) {
                    $q->where('status','Pending');
                })->orderBy('date_submitted','asc')->get();

            $orgs = requests::whereHas('user', function($user) {
                    $user->where('emp_dept', Auth::user()->user->emp_dept);
                })
                ->whereHas('orgs', function($q) {
                    $q->where('status','Pending');
                })->orderBy('date_submitted','asc')->get();

            $dependents = requests::whereHas('user', function($user) {
                    $user->where('emp_dept', Auth::user()->user->emp_dept);
                })
                ->whereHas('dependents', function($q) {
                    $q->where('status','Pending');
                })->orderBy('date_submitted','asc')->get();
        }

        return [$all, $certifications, $educations, $employments, $respubs, $trainings, $licenses, $orgs, $dependents]; 
    }

    protected function fetchDataByUser($id) {
        $data = requests::where('emp_id', $id)
            ->where(function($query) {
                $query->whereHas('certifications', function($subQuery) {
                    $subQuery->where('status', 'Pending');
                })
                ->orWhereHas('research', function($subQuery) {
                    $subQuery->where('status', 'Pending');
                })
                ->orWhereHas('publication', function($subQuery) {
                    $subQuery->where('status', 'Pending');
                })
                ->orWhereHas('education', function($subQuery) { 
                    $subQuery->where('status' , 'Pending');
                })
                ->orWhereHas('employment', function($subQuery) { 
                    $subQuery->where('status' , 'Pending');
                })
                ->orWhereHas('training', function($sq) { 
                    $sq->where('status', 'Pending'); 
                })
                ->orWhereHas('license', function($sq) { 
                    $sq->where('status', 'Pending'); 
                })
                ->orWhereHas('orgs', function($sq) { 
                    $sq->where('status', 'Pending'); 
                })
                ->orWhereHas('dependents', function($sq) { 
                    $sq->where('status', 'Pending'); 
                });
            })
            ->orderBy('date_submitted', 'desc')
            ->get();

        $certifications = requests::where('emp_id',$id)
            ->whereHas('certifications', function($q) {
                $q->where('status','Pending');  
            })->orderBy('date_submitted', 'asc')->get();
        
        $educations = requests::where('emp_id',$id)
            ->whereHas('education', function($q) {
                $q->where('status','Pending');  
            })->orderBy('date_submitted', 'asc')->get();

        $employments = requests::where('emp_id',$id)
            ->whereHas('employment', function($q) {
                $q->where('status','Pending');  
            })->orderBy('date_submitted', 'asc')->get();

        $respubs = requests::where('emp_id',$id)
            ->where(function($q) {
                $q->whereHas('research', function($sq) {
                    $sq->where('status','Pending');
                })
                ->orWhereHas('publication', function($sq) {
                    $sq->where('status','Pending');
                });
            })
            ->orderBy('date_submitted', 'asc')->get();

        $hauCerts = requests::where('emp_id',$id)
            ->whereHas('certifications', function($q) {
                $q->where('status', 'Pending')
                ->whereNotNull('hau_cert');
            })->orderBy('date_submitted', 'asc');

        $pendingTrainings = requests::where('emp_id',$id)
            ->whereHas('training', function($q) {
                $q->where('status','Pending');
            })->orderBy('date_submitted', 'asc');
        
        $trainings = $hauCerts->union($pendingTrainings)
            ->orderBy('date_submitted', 'asc')
            ->get();

        $licenses = requests::where('emp_id', $id)
            ->whereHas('license', function($q) {
                $q->where('status','Pending');
            })->orderBy('date_submitted', 'asc')->get();

        $orgs = requests::where('emp_id', $id)
            ->whereHas('orgs', function($q) {
                $q->where('status','Pending');
            })->orderBy('date_submitted', 'asc')->get();
        
        $dependents = requests::where('emp_id', $id)
            ->whereHas('dependents', function($q) {
                $q->where('status','Pending');
            })->orderBy('date_submitted', 'asc')->get();


        return [$data, $certifications, $educations, $employments, $respubs, $trainings, $licenses, $orgs, $dependents];
    }

    protected function deleteRequest($id) {
        $req = requests::findOrFail($id);
        if ($req->delete()) {
            return true;
        } 
        return false;
    }

    protected function approve($id, $type) {
        // We need to handle Research and Publication as well
        switch($type) {
            case 'Certification':
                $item = certifications::findOrFail($id);
                break;
            case 'Training':
                $item = Trainings::findOrFail($id);
                break;
            case 'License':
                $item = Licenses::findOrFail($id);
                break;
            case 'Education':
                $item = Education::findOrFail($id);
                break;
            case 'Employment':
                $item = Employment::findOrFail($id);
                break;
            case 'Research':
                $item = Research::findorfail($id);
                break;
            case 'Publication':
                $item = Publication::findOrFail($id);
                break;
            case 'Organization':
                $item = orgs::findOrFail($id);
                break;
            case 'Dependent':
                $item = dependencies::findOrFail($id);
                break;
            default:
                return; 
        }

        $item->update(['status' => 'Approved']);
        requests::destroy([$id]);
    }

    protected function review($id, $type) {
        switch($type) {
            case 'Certification':
                $item = certifications::findOrFail($id);
                break;
            case 'Training':
                $item = Trainings::findOrFail($id);
                break;
            case 'License':
                $item = Licenses::findOrFail($id);
                break;
            case 'Education':
                $item = Education::findOrFail($id);
                break;
            case 'Employment':
                $item = Employment::findOrFail($id);
                break;
            case 'Research':
                $item = Research::findorfail($id);
                break;
            case 'Publication':
                $item = Publication::findOrFail($id);
                break;
            case 'Organization':
                $item = orgs::findOrFail($id);
                break;
            case 'Dependent':
                $item = dependencies::findOrFail($id);
                break;
            default:
                return;
        }

        $item->update(['status' => 'To-review']);
        requests::destroy([$id]);
    }

    function loadPending() {
        $fetch = $this->fetchGroup(Auth::user()->role);

        return view('manage-emps.pendings.main')->with([
            'msg' => Str::length(session('msg')) > 0 ? session('msg') : null,
            'pendings'=> $fetch[0],
            'certifications'=>$fetch[1],
            'educations'=>$fetch[2],
            'employments'=> $fetch[3],
            'respubs'=>$fetch[4],
            'trainings'=> $fetch[5],
            'licenses'=> $fetch[6],
            'orgs'=> $fetch[7],
            'dependents'=> $fetch[8]
        ]);
    }

    public function reviewItem($id) {
        $data = requests::where('id', $id)->first();

        switch($data->type) {
            case 'Certification':
            case 'HAU Certificate':
                $cert = certifications::where('id', $id)->first();
                $user= Employee::where('emp_id', $cert->emp_id)->first();
                $requests = requests::where('id', $id)->first(); 
                return view('manage-emps.pendings.review.certification', [
                    'data'=> $cert,
                    'user'=> $user,
                    'requests'=> $requests
                ]);
            case 'Research':
            case 'Publication':
                // Check if research or publication
                if($data->type=='Research'){
                    $res = Research::find($id);
                }
                else{
                    $res = Publication::findOrFail($id);
                }
                $coauthors = $res->coauthors;
                $user = Employee::where('emp_id', $res->emp_id)->first();
                $requests = requests::where('id', $id)->first();
                // Load a view based on research or publication if needed
                // Here we assume a common view respub
                return view('manage-emps.pendings.review.respub', [
                    'data'=> $res,
                    'user'=> $user,
                    'requests'=> $requests,
                    'coauthors'=> $coauthors
                ]);
            case 'Education':
                $education = Education::where('id', $id)->first(); 
                $user = Employee::where('emp_id', $education->emp_id)->first();
                $request = requests::where('id', $id)->first();
                return view('portal.pages.edu-bg.view', [
                    'approval'=>true,
                    'data'=> $education,
                    'user'=> $user,
                    'request'=> $request
                ]);
            case 'Employment':
                $employment = Employment::where('id', $id)->first(); 
                $user = Employee::where('emp_id', $employment->emp_id)->first();
                $request = requests::where('id', $id)->first();
                return view('portal.pages.employments.view', [
                    'approval'=>true,
                    'data'=> $employment,
                    'user'=> $user,
                    'request'=> $request
                ]);
            case 'Training':
                $training = Trainings::where('id',$id)->first();
                $user = Employee::where('emp_id', $training-> emp_id)->first();
                $request= requests::where('id',$id)->first(); 
                return view('portal.pages.trainings.view', [
                    'approval'=>true,
                    'data'=> $training,
                    'user'=> $user,
                    'request'=> $request
                ]);
            case 'License':
                $license = Licenses::where('id', $id)->first();
                $user = Employee::where('emp_id', $license->emp_id)->first();
                $request= requests::where('id',$id)->first();
                return view('portal.pages.license.view', [
                    'approval'=>true,
                    'data'=>$license,
                    'user'=> $user,
                    'request'=> $request 
                ]);
            case 'Organization':
                $org = orgs::where('id', $id)->first();
                $user= Employee::where('emp_id', $org->emp_id)->first();
                $requests = requests::where('id', $id)->first(); 
                return view('manage-emps.pendings.review.orgs', [
                    'data'=> $org,
                    'user'=> $user,
                    'requests'=> $requests
                ]);
            case 'Dependent':
                $dependents = dependencies::where('id', $id)->first();
                $user= Employee::where('emp_id', $dependents->emp_id)->first();
                $requests = requests::where('id', $id)->first(); 
                return view('manage-emps.pendings.review.dependents', [
                    'data'=> $dependents,
                    'user'=> $user,
                    'requests'=> $requests
                ]);

        }
    }

    public function search(Request $request) {
        $uid = $request->emp_id; 

        $user = Employee::where('emp_id', $uid)->get(); 
        if($user->count() == 0) {
            $pendings = $this->fetchGroup(Auth::user()->role);
            return view('manage-emps.pendings.main')->with(['pendings'=>$pendings, 'user_not_found'=>'User not found...']);
        }

        return redirect()->route('admin.pendings.loadsearch',['id'=>$uid]);
    }

    public function loadSearch(Request $request) {
        $user = Employee::where('emp_id', $request->emp_id)->first();
        if(!$user) {
            return redirect()->route('admin.pendings')->with('msg', 'User not found...');
        }

        if(Auth::user()->role == 'Dean') {
            if(!($user->department->dept == Auth::user()->user->department->dept)) {
                $fetch = [[],[],[],[],[],[],[],[]]; 
                $userfound = false; 
            } else {
                $fetch = $this->fetchDataByUser($user->emp_id);
                $userfound = true;
            }
        } else {
            $fetch = $this->fetchDataByUser($user->emp_id);
            $userfound = true;
        }

        return view('manage-emps.pendings.main')->with([
            'user_search'=> $user,
            'pendings'=> $fetch[0],
            'certifications'=>$fetch[1],
            'educations'=>$fetch[2],
            'employments'=> $fetch[3],
            'respubs'=>$fetch[4],
            'trainings'=> $fetch[5],
            'licenses'=> $fetch[6],
            'orgs'=> $fetch[7],
            'dependents'=> $fetch[8],
            'userfound' => $userfound
        ]);
    }

    public function approveItem($id) {
        $data = requests::where('id', $id)->first();
        $this->approve($id, $data->type);
        session(['msg'=> 'The request was approved']);
        return redirect()->route('admin.pendings');
    }

    public function toreviewItem($id) {
        $data = requests::where('id', $id)->first();
        $this->review($id, $data->type);
        session(['msg'=> 'The request was sent to be reviewed']);
        return redirect()->route('admin.pendings');
    }
}