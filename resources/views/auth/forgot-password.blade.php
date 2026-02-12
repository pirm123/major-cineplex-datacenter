<x-guest-layout>
    <!-- Description -->
    <div class="forgot-description">
        <svg class="description-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"/>
            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/>
            <line x1="12" y1="17" x2="12.01" y2="17"/>
        </svg>
        <p>{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div class="input-group">
            <label for="email" class="input-label">
                <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                    <polyline points="22,6 12,13 2,6"/>
                </svg>
                {{ __('Email') }}
            </label>
            <x-text-input id="email" 
                          class="input-field" 
                          type="email" 
                          name="email" 
                          :value="old('email')" 
                          required 
                          autofocus
                          placeholder="your.email@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Buttons -->
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mt-6">
            <button type="submit" class="reset-button">
                <svg class="button-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                    <polyline points="22,6 12,13 2,6"/>
                </svg>
                {{ __('Email Password Reset Link') }}
            </button>

            <a href="{{ route('login') }}" class="back-button">
                <svg class="button-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="19" y1="12" x2="5" y2="12"/>
                    <polyline points="12 19 5 12 12 5"/>
                </svg>
                Back to Login
            </a>
        </div>
    </form>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap');

        /* Description Styling */
        .forgot-description {
            display: flex;
            align-items: flex-start;
            gap: 0.875rem;
            padding: 1rem 1.25rem;
            background: rgba(78, 205, 196, 0.08);
            border: 1px solid rgba(78, 205, 196, 0.2);
            border-radius: 12px;
            margin-bottom: 1.5rem;
        }

        .description-icon {
            width: 1.5rem;
            height: 1.5rem;
            min-width: 1.5rem;
            color: rgba(78, 205, 196, 0.9);
            margin-top: 0.125rem;
        }

        .forgot-description p {
            font-size: 0.875rem;
            line-height: 1.5;
            color: rgba(255, 255, 255, 0.75);
            font-family: 'Prompt', sans-serif;
            margin: 0;
        }

        /* Input Group Styling */
        .input-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .input-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.85);
            font-family: 'Prompt', sans-serif;
            transition: color 0.2s;
        }

        .input-icon {
            width: 1.125rem;
            height: 1.125rem;
            color: rgba(78, 205, 196, 0.8);
            transition: color 0.2s;
        }

        .input-field {
            width: 100%;
            padding: 0.75rem 1rem !important;
            background: rgba(0, 0, 0, 0.3) !important;
            border: 1px solid rgba(255, 255, 255, 0.15) !important;
            border-radius: 12px !important;
            color: #fff !important;
            font-size: 0.9375rem;
            font-family: 'Prompt', sans-serif;
            transition: all 0.3s ease;
        }

        .input-field::placeholder {
            color: rgba(168, 178, 209, 0.4);
        }

        .input-field:focus {
            background: rgba(0, 0, 0, 0.4) !important;
            border-color: rgba(78, 205, 196, 0.6) !important;
            box-shadow: 0 0 0 3px rgba(78, 205, 196, 0.1) !important;
            outline: none;
        }

        .input-field:hover:not(:focus) {
            border-color: rgba(255, 255, 255, 0.25) !important;
        }

        .input-group:focus-within .input-label {
            color: rgba(78, 205, 196, 0.95);
        }

        .input-group:focus-within .input-icon {
            color: rgba(78, 205, 196, 1);
        }

        /* Reset Button */
        .reset-button {
            flex: 1;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            padding: 0.875rem 1.5rem;
            background: linear-gradient(135deg, #4ecdc4 0%, #44a3a0 100%);
            border: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.875rem;
            color: #1a1a2e;
            font-family: 'Prompt', sans-serif;
            box-shadow: 0 4px 15px rgba(78, 205, 196, 0.3);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .button-icon {
            width: 1.125rem;
            height: 1.125rem;
            stroke-width: 2.5;
        }

        .reset-button:hover {
            background: linear-gradient(135deg, #44a3a0 0%, #ffd93d 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(78, 205, 196, 0.4);
        }

        .reset-button:active {
            transform: translateY(0);
        }

        /* Back Button */
        .back-button {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            padding: 0.875rem 1.5rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            font-weight: 500;
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.85);
            font-family: 'Prompt', sans-serif;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .back-button:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(78, 205, 196, 0.4);
            color: rgba(78, 205, 196, 0.95);
        }

        /* Responsive adjustments */
        @media (max-width: 640px) {
            .forgot-description {
                padding: 0.875rem 1rem;
                gap: 0.75rem;
            }

            .description-icon {
                width: 1.25rem;
                height: 1.25rem;
                min-width: 1.25rem;
            }

            .forgot-description p {
                font-size: 0.8125rem;
            }

            .input-label {
                font-size: 0.8125rem;
            }

            .input-field {
                padding: 0.625rem 0.875rem !important;
                font-size: 0.875rem;
            }

            .reset-button,
            .back-button {
                padding: 0.75rem 1.25rem;
                font-size: 0.8125rem;
            }
        }
    </style>
</x-guest-layout>