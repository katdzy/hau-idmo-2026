<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the email and ensure a reCAPTCHA response was provided.
        $request->validate([
            'email'                => ['required', 'email'],
            'g-recaptcha-response' => ['required'],
        ]);

        // Verify the reCAPTCHA response with Google.
        $recaptchaResponse = $request->input('g-recaptcha-response');
        $remoteIp = $request->ip();

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret'   => env('RECAPTCHA_SECRET_KEY'),
            'response' => $recaptchaResponse,
            'remoteip' => $remoteIp,
        ]);

        $result = $response->json();

        if (!isset($result['success']) || $result['success'] !== true) {
            return back()->withErrors(['captcha' => 'CAPTCHA verification failed. Please try again.']);
        }

        // Attempt to send the password reset link.
        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }
}
