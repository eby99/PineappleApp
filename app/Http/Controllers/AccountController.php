<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{

    /**
     * Display my account page
     *
     * @return Response
     */
    public function index(): Response
    {
        return response()->view('page.account');
    }

    /**
     * Login user in to the system
     *
     * @param Request $request
     */
    public function login(Request $request)
    {
        $request->validate([
            'login_email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $request->login_email,  // Map login_email back to email for authentication
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('success')
                ->with('success_message', 'Login successful! Welcome back.');
        }

        return redirect()->back()
            ->withInput($request->only('login_email'))
            ->with('login_error', 'Invalid email or password.');
    }

    /**
     * Logout user from the system
     *
     */
    public function logout()
    {
        Auth::logout();
        
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/')->with('success_message', 'You have been logged out successfully.');
    }

    /**
     * Register user in the system
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|same:password',
        ], [
            'email.unique' => 'An account with this email address already exists. Please use a different email or try signing in.',
        ]);

        try {
            $user = User::create([
                'firstname' => trim($request->firstname),
                'lastname' => trim($request->lastname),
                'email' => strtolower(trim($request->email)),
                'password' => Hash::make($request->password),
                'subscribed' => $request->has('subscribed') ? 1 : 0,
            ]);

            return redirect()->back()
                ->with('register_success', 'Account created successfully!')
                ->with('registered_email', $user->email);

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput($request->except(['password', 'confirm_password']))
                ->with('register_error', 'Registration failed. Please try again.');
        }
    }

    /**
     * Display a success message for logged-in users
     *
     */
    public function success()
    {
        // Check if user is authenticated
        if (Auth::check()) {
            $user = Auth::user();
            return view('page.success')->with([
                'firstname' => $user->firstname,
                'lastname' => $user->lastname,
                'email' => $user->email
            ]);
        }

        // User is not authenticated, redirect to login
        return redirect('/')
            ->with('login_error', 'Please login to access this page.');
    }
}