<?php

namespace App\Http\Middleware;

use App\Models\Employee;
use App\Models\Employee_Login;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; 

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
          // Check if the user is authenticated
    if (Auth::check()) {
        // Get the current authenticated user ID
        $uid = Auth::user()->id;

        // Retrieve the role of the user
        $role = Employee_Login::where('id', $uid)->pluck('role')->first();


        // Redirect based on the user's role
        if ($role !== 'Employee') {
            return $next($request); // Allow access if not an 'Employee'
    
        }
        // Redirect to the dashboard if the role is 'Employee'
        return redirect()->route('portal.dashboard');
    }

    // Redirect to the home page if the user is not authenticated
    return redirect()->route('home'); // Assuming 'home' is the name of your route for '/'
    }
}
