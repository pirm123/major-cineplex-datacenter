<x-guest-layout>
    <div class="auth-toggle">
        <span>{{ __('auth.have_account') }}
            <a href="{{ route('login') }}"><span>{{ __('auth.go_login') }}</span></a>
        </span>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div class="input-group">
            <label for="name" class="input-label">
                <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
                {{ __('auth.name') }}
            </label>
            <x-text-input id="name" 
                          class="input-field" 
                          type="text" 
                          name="name"
                          :value="old('name')" 
                          required 
                          autofocus 
                          autocomplete="name"
                          placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="input-group">
            <label for="email" class="input-label">
                <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                    <polyline points="22,6 12,13 2,6"/>
                </svg>
                {{ __('auth.email') }}
            </label>
            <x-text-input id="email" 
                          class="input-field" 
                          type="email" 
                          name="email"
                          :value="old('email')" 
                          required 
                          autocomplete="username"
                          placeholder="your.email@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="input-group">
            <label for="password" class="input-label">
                <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
                {{ __('auth.password') }}
            </label>
            <x-text-input id="password" 
                          class="input-field"
                          type="password"
                          name="password"
                          required 
                          autocomplete="new-password"
                          placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="input-group">
            <label for="password_confirmation" class="input-label">
                <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    <polyline points="9 11 12 14 15 11"/>
                </svg>
                {{ __('auth.password_confirmation') }}
            </label>
            <x-text-input id="password_confirmation" 
                          class="input-field"
                          type="password"
                          name="password_confirmation" 
                          required 
                          autocomplete="new-password"
                          placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Register Button -->
        <div class="mt-6">
            <button type="submit" class="register-button">
                <svg class="button-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="8.5" cy="7" r="4"/>
                    <line x1="20" y1="8" x2="20" y2="14"/>
                    <line x1="23" y1="11" x2="17" y2="11"/>
                </svg>
                {{ __('auth.register_button') }}
            </button>
        </div>
    </form>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap');

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

        /* Register Button */
        .register-button {
            width: 100%;
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
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #1a1a2e;
            font-family: 'Prompt', sans-serif;
            box-shadow: 0 4px 15px rgba(78, 205, 196, 0.3);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .button-icon {
            width: 1.25rem;
            height: 1.25rem;
            stroke-width: 2.5;
        }

        .register-button:hover {
            background: linear-gradient(135deg, #44a3a0 0%, #ffd93d 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(78, 205, 196, 0.4);
        }

        .register-button:active {
            transform: translateY(0);
        }

        /* Responsive adjustments */
        @media (max-width: 640px) {
            .input-label {
                font-size: 0.8125rem;
            }

            .input-field {
                padding: 0.625rem 0.875rem !important;
                font-size: 0.875rem;
            }

            .register-button {
                padding: 0.75rem 1.25rem;
                font-size: 0.8125rem;
            }
        }
    </style>
</x-guest-layout>