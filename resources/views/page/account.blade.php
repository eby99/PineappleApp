@extends('layout.default')

@section('content')
    <div class="container flex flex-col md:flex-row flex-wrap my-1 font-bold lg:mt-2 text-lg">
        <h1 class="text-gray-900 page-title title-font md:w-1/2 md:pr-4">
            <span class="base" data-ui-id="page-title-wrapper">
                Customer Login
            </span>
        </h1>
        <h1 class="text-gray-900 page-title title-font md:w-1/2">
            <span class="base">
                CREATE NEW CUSTOMER ACCOUNT
            </span>
        </h1>
    </div>

    <!-- Display Success/Error Messages -->
    @if(session('success_message'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            <div class="flex">
                <div class="py-1">
                    <svg class="fill-current h-6 w-6 text-green-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold">Success!</p>
                    <p class="text-sm">{{ session('success_message') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if(session('register_success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            <div class="flex">
                <div class="py-1">
                    <svg class="fill-current h-6 w-6 text-green-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold">Registration Successful!</p>
                    <p class="text-sm">{{ session('register_success') }}</p>
                    @if(session('registered_email'))
                        <p class="text-sm mt-1"><strong>Email:</strong> {{ session('registered_email') }}</p>
                    @endif
                </div>
            </div>
        </div>
    @endif

    @if(session('login_error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
            <div class="flex">
                <div class="py-1">
                    <svg class="fill-current h-6 w-6 text-red-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold">Login Error!</p>
                    <p class="text-sm">{{ session('login_error') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if(session('register_error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
            <div class="flex">
                <div class="py-1">
                    <svg class="fill-current h-6 w-6 text-red-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold">Registration Error!</p>
                    <p class="text-sm">{{ session('register_error') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="columns">
        <div class="column main">
            <div id="customer-login-container" class="login-container">
                <div class="w-full md:w-1/2 card mr-4" style="height: fit-content;">
                    <div aria-labelledby="block-customer-login-heading">
                        <form class="form form-login"
                              action="{{ url('login') }}"
                              method="post"
                              id="customer-login-form"
                        >
                            @csrf
                            <fieldset class="fieldset login">
                                <legend class="mb-1">
                                    <h2 class="text-base font-medium title-font text-primary">
                                        Login
                                    </h2>
                                </legend>
                                <div class="text-secondary-darker mb-2 text-sm">
                                    If you have an account, sign in with your email address.
                                </div>
                                <div class="field mb-2">
                                    <label class="label text-xs font-medium text-gray-700 mb-1 block" for="email">
                                        <span>Email</span>
                                    </label>
                                    <div class="control">
                                        <input data-test="login-email" 
                                               name="login_email" 
                                               class="w-1/3 px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent @error('login_email', 'login') border-red-500 @enderror" 
                                               required="" 
                                               value="{{ old('login_email') }}"
                                               autocomplete="off" 
                                               id="email" 
                                               type="email" 
                                               title="Email">
                                    </div>
                                    @error('login_email', 'login')
                                        <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="field mb-2">
                                    <label for="pass" class="label text-xs font-medium text-gray-700 mb-1 block">
                                        <span>Password</span>
                                    </label>
                                    <div class="control">
                                        <input data-test="login-password" 
                                               name="password" 
                                               class="w-1/3 px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent @error('password') border-red-500 @enderror" 
                                               required=""
                                               autocomplete="off" 
                                               id="pass" 
                                               title="Password" 
                                               type="password">
                                    </div>
                                    @error('password')
                                        <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="actions-toolbar flex justify-between pt-1 pb-1 items-center">
                                    <button data-test="login-submit" 
                                            type="submit" 
                                            class="bg-green-600 hover:bg-green-700 active:bg-green-800 text-white font-medium py-1 px-4 rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 text-sm" 
                                            name="send">
                                        <span>Sign In</span>
                                    </button>
                                    <a class="text-teal-600 hover:text-teal-700 underline text-xs font-medium" href="#">
                                        <span>Forgot Your Password?</span>
                                    </a>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
                <div class="card w-full md:w-1/2 my-2 md:my-0">
                    <div>
                        <h3 class="text-base font-medium title-font mb-1 text-primary" role="heading" aria-level="3">
                            Personal Information
                        </h3>
                    </div>
                    
                    <!-- Registration Form -->
                    <form class="form form-register"
                          action="{{ url('register') }}"
                          method="post"
                          id="customer-register-form"
                    >
                        @csrf
                        <fieldset class="fieldset register">
                            <div class="field mb-2">
                                <label class="label text-xs font-medium text-gray-700 mb-1 block" for="register-firstname">
                                    <span>First Name </span>
                                </label>
                                <div class="control">
                                    <input data-test="register-firstName" 
                                           name="firstname" 
                                           class="w-1/3 px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent @error('firstname') border-red-500 @enderror" 
                                           required="" 
                                           value="{{ old('firstname') }}"
                                           autocomplete="given-name" 
                                           id="register-firstname" 
                                           type="text" 
                                           title="First Name">
                                </div>
                                @error('firstname')
                                    <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="field mb-2">
                                <label class="label text-xs font-medium text-gray-700 mb-1 block" for="register-lastname">
                                    <span>Last Name </span>
                                </label>
                                <div class="control">
                                    <input data-test="register-lastName" 
                                           name="lastname" 
                                           class="w-1/3 px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent @error('lastname') border-red-500 @enderror" 
                                           required="" 
                                           value="{{ old('lastname') }}"
                                           autocomplete="family-name" 
                                           id="register-lastname" 
                                           type="text" 
                                           title="Last Name">
                                </div>
                                @error('lastname')
                                    <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Sign-In Information Section -->
                            <div class="mb-1">
                                <h3 class="text-base font-medium title-font mb-1 text-primary" role="heading" aria-level="3">
                                    Sign-In Information
                                </h3>
                            </div>
                            
                            <div class="field mb-2">
                                <label class="label text-xs font-medium text-gray-700 mb-1 block" for="register-email">
                                    <span>Email </span>
                                </label>
                                <div class="control">
                                    <input data-test="register-email" 
                                           name="email" 
                                           class="w-1/3 px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent @error('email') border-red-500 @enderror" 
                                           required="" 
                                           value="{{ old('email') }}"
                                           autocomplete="email" 
                                           id="register-email" 
                                           type="email" 
                                           title="Email">
                                </div>
                                @error('email')
                                    <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
                                @enderror
                                <div class="field-error text-red-600 text-xs mt-1 hidden" id="register-email-error">
                                    <!-- Client-side error messages will be displayed here -->
                                </div>
                            </div>

                            <div class="field mb-2">
                                <label class="label text-xs font-medium text-gray-700 mb-1 block" for="register-password">
                                    <span>Password </span>
                                </label>
                                <div class="control">
                                    <input data-test="register-password" 
                                           name="password" 
                                           class="w-1/3 px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent @error('password') border-red-500 @enderror" 
                                           required="" 
                                           autocomplete="new-password" 
                                           id="register-password" 
                                           type="password" 
                                           title="Password"
                                           minlength="8"
                                           pattern="(?=.*[a-zA-Z])(?=.*\d).{8,}">
                                </div>
                                <div class="text-xs text-gray-600 mt-1">
                                    Password must be at least 8 characters and contain both letters and numbers.
                                </div>
                                @error('password')
                                    <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
                                @enderror
                                <div class="field-error text-red-600 text-xs mt-1 hidden" id="register-password-error">
                                    <!-- Client-side error messages will be displayed here -->
                                </div>
                            </div>

                            <div class="field mb-2">
                                <label class="label text-xs font-medium text-gray-700 mb-1 block" for="register-password-confirm">
                                    <span>Confirm Password </span>
                                </label>
                                <div class="control">
                                    <input data-test="register-passwordConfirm" 
                                           name="confirm_password" 
                                           class="w-1/3 px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent @error('confirm_password') border-red-500 @enderror" 
                                           required="" 
                                           autocomplete="new-password" 
                                           id="register-password-confirm" 
                                           type="password" 
                                           title="Confirm Password">
                                </div>
                                @error('confirm_password')
                                    <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
                                @enderror
                                <div class="field-error text-red-600 text-xs mt-1 hidden" id="register-password-confirm-error">
                                    <!-- Client-side error messages will be displayed here -->
                                </div>
                            </div>

                            <div class="field mb-2">
                                <div class="control flex items-center">
                                    <div class="relative">
                                        <input data-test="register-newsletter" 
                                               name="subscribed" 
                                               class="w-4 h-4 text-green-600 bg-white border-2 border-gray-300 rounded focus:ring-green-500 focus:ring-2" 
                                               id="register-newsletter" 
                                               type="checkbox" 
                                               value="1"
                                               {{ old('subscribed') ? 'checked' : '' }}>
                                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none opacity-0 checked:opacity-100">
                                            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <label class="label text-xs text-gray-700 ml-2" for="register-newsletter">
                                        <span>Subscribe to newsletter</span>
                                    </label>
                                </div>
                            </div>

                            <div class="actions-toolbar pt-1 pb-1 flex justify-start">
                                <button data-test="register-submit" 
                                        type="submit" 
                                        class="bg-green-600 hover:bg-green-700 active:bg-green-800 text-white font-medium py-1 px-4 rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 text-sm" 
                                        name="register">
                                    <span>Create an Account</span>
                                </button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom checkbox styling to match the design */
        input[type="checkbox"]:checked {
            background-color: #059669;
            border-color: #059669;
        }
        
        input[type="checkbox"]:checked + div {
            opacity: 1;
        }
        
        /* Button hover effects */
        .bg-green-600:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);
        }
        
        /* Link hover effects */
        a:hover {
            transition: all 0.2s ease;
        }
        
        /* Input focus states */
        input:focus {
            box-shadow: 0 0 0 2px rgba(5, 150, 105, 0.2);
        }
        
        /* Error input styling */
        .border-red-500 {
            border-color: #ef4444 !important;
        }
    </style>

    <script>
        // Client-side validation for registration form
        document.addEventListener('DOMContentLoaded', function() {
            const registerForm = document.getElementById('customer-register-form');
            const emailField = document.getElementById('register-email');
            const passwordField = document.getElementById('register-password');
            const confirmPasswordField = document.getElementById('register-password-confirm');
            
            // Email validation
            emailField.addEventListener('blur', function() {
                const emailError = document.getElementById('register-email-error');
                const email = this.value.trim();
                
                if (!email) {
                    emailError.textContent = 'Email address is required';
                    emailError.classList.remove('hidden');
                } else if (!isValidEmail(email)) {
                    emailError.textContent = 'Please provide a valid e-mail address';
                    emailError.classList.remove('hidden');
                } else {
                    emailError.classList.add('hidden');
                }
            });
            
            // Password confirmation validation
            function validatePasswordMatch() {
                const confirmError = document.getElementById('register-password-confirm-error');
                const password = passwordField.value;
                const confirmPassword = confirmPasswordField.value;
                
                if (confirmPassword && password !== confirmPassword) {
                    confirmError.textContent = 'This field value must be the same as "Password".';
                    confirmError.classList.remove('hidden');
                } else {
                    confirmError.classList.add('hidden');
                }
            }
            
            passwordField.addEventListener('input', validatePasswordMatch);
            confirmPasswordField.addEventListener('input', validatePasswordMatch);
            
            // Email validation helper function
            function isValidEmail(email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }
            
            // Auto-hide success messages after 5 seconds
            setTimeout(function() {
                const successMessages = document.querySelectorAll('.bg-green-100');
                successMessages.forEach(function(message) {
                    message.style.transition = 'opacity 0.5s ease-out';
                    message.style.opacity = '0';
                    setTimeout(function() {
                        message.remove();
                    }, 500);
                });
            }, 5000);
        });
    </script>
@stop