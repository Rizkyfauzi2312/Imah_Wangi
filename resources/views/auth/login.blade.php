@extends('layouts.main')

@section('title', 'Login - Imah Wangi')

@section('content')
<div class="auth-container">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="auth-card">
                    <!-- Header -->
                    <div class="auth-header text-center mb-4">
                        <div class="auth-icon mb-3">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <h2>Welcome Back</h2>
                        <p class="text-muted">Sign in to your Valoria account</p>
                    </div>

                    <!-- Form -->
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label-valoria">
                                <i class="fas fa-envelope me-2"></i>Email Address
                            </label>
                            <input id="email" 
                                   type="email" 
                                   class="form-control form-control-valoria @error('email') is-invalid @enderror" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   required 
                                   autocomplete="email" 
                                   autofocus
                                   placeholder="Enter your email">
                            @error('email')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label-valoria">
                                <i class="fas fa-lock me-2"></i>Password
                            </label>
                            <div class="password-input-wrapper">
                                <input id="password" 
                                       type="password" 
                                       class="form-control form-control-valoria @error('password') is-invalid @enderror" 
                                       name="password" 
                                       required 
                                       autocomplete="current-password"
                                       placeholder="Enter your password">
                                <button type="button" class="password-toggle" onclick="togglePassword()">
                                    <i class="fas fa-eye" id="toggleIcon"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       name="remember" 
                                       id="remember" 
                                       {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    Remember me
                                </label>
                            </div>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="auth-link">
                                    Forgot password?
                                </a>
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-gold w-100 mb-3">
                            <i class="fas fa-sign-in-alt me-2"></i>Sign In
                        </button>

                        <!-- Divider -->
                        <div class="auth-divider">
                            <span>or</span>
                        </div>

                        <!-- Register Link -->
                        <div class="text-center mt-3">
                            <p class="mb-0">Don't have an account? 
                                <a href="{{ route('register') }}" class="auth-link-gold">
                                    Create Account
                                </a>
                            </p>
                        </div>
                    </form>
                </div>

                <!-- Back to Home -->
                <div class="text-center mt-3">
                    <a href="{{ route('home') }}" class="auth-link">
                        <i class="fas fa-arrow-left me-2"></i>Back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.auth-container {
    min-height: calc(100vh - 200px);
    display: flex;
    align-items: center;
    background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
}

.auth-card {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(212, 175, 55, 0.2);
    border-radius: 16px;
    padding: 40px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
}

.auth-header h2 {
    color: var(--color-gold);
    font-weight: 700;
    margin-bottom: 10px;
}

.auth-icon {
    font-size: 4rem;
    color: var(--color-gold);
    opacity: 0.8;
}

.password-input-wrapper {
    position: relative;
}

.password-toggle {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: var(--color-gold);
    cursor: pointer;
    padding: 5px 10px;
    transition: all 0.3s ease;
}

.password-toggle:hover {
    color: #fff;
}

.auth-link {
    color: var(--color-gold);
    text-decoration: none;
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.auth-link:hover {
    color: #fff;
    text-decoration: underline;
}

.auth-link-gold {
    color: var(--color-gold);
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.auth-link-gold:hover {
    color: #fff;
}

.auth-divider {
    text-align: center;
    margin: 20px 0;
    position: relative;
}

.auth-divider::before {
    content: '';
    position: absolute;
    left: 0;
    top: 50%;
    width: 45%;
    height: 1px;
    background: rgba(212, 175, 55, 0.3);
}

.auth-divider::after {
    content: '';
    position: absolute;
    right: 0;
    top: 50%;
    width: 45%;
    height: 1px;
    background: rgba(212, 175, 55, 0.3);
}

.auth-divider span {
    color: rgba(255, 255, 255, 0.5);
    font-size: 0.9rem;
}

.form-check-input:checked {
    background-color: var(--color-gold);
    border-color: var(--color-gold);
}
</style>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}
</script>
@endsection
