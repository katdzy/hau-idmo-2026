<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Employee_Login;

use App\Models\Employee;
use App\Models\provincial_contact; 
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {


        // for file upload - to be continued
        // if($request -> file()) { 
        //     $fileName = time().'_'.$request->file->getClientOriginalName();
        //     $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
        // }
        $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'mname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'empid' => ['required', 'integer'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Employee_Login::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

    
        $emp = Employee_Login::create([
            'id' => $request->empid,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'Employee',
            'profile_picture' =>  $request -> file
        ]);

        $emp_info = Employee::create([
            'id' => $request -> empid, 
            'emp_fname'=> $request -> fname, 
            'emp_mname'=> $request-> mname,
            'emp_lname'=> $request -> lname,
            'role' => 'Employee', 
            // 'profile_picture'=>   ''
        ]); 


        $emp_provincial_contact = provincial_contact::create([
            'id' => $request -> empid
        ]);


        event(new Registered($emp));

        Auth::login($emp);

        return redirect(route('dashboard', absolute: false));
    }
}
