@extends('master')
@section('title', 'Login')
@section('content')

<style>
    /* Variables */
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
        --neon-glow: 0 0 20px rgba(102, 126, 234, 0.5);
        --card-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        --floating-animation: float 6s ease-in-out infinite;
    }

    /* Container */
    .login-container {
        min-height: 100vh;
        display: flex;
        position: relative;
        overflow: hidden;
        background: #0a0a14;
    }

    /* Animated Background Particles */
    .particles {
        position: absolute;
        width: 100%;
        height: 100%;
        z-index: 1;
    }

    .particle {
        position: absolute;
        background: rgba(102, 126, 234, 0.1);
        border-radius: 50%;
        animation: particleFloat 15s linear infinite;
    }

    @keyframes particleFloat {
        0% {
            transform: translateY(100vh) rotate(0deg);
            opacity: 0;
        }
        10% {
            opacity: 0.5;
        }
        90% {
            opacity: 0.5;
        }
        100% {
            transform: translateY(-100px) rotate(360deg);
            opacity: 0;
        }
    }

    /* Left Side - Interactive Hero */
    .login-left {
        flex: 1;
        background: var(--primary-gradient);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 4rem;
        position: relative;
        overflow: hidden;
        z-index: 2;
    }

    .login-left::before {
        content: '';
        position: absolute;
        width: 300%;
        height: 300%;
        background: 
            radial-gradient(circle at 20% 30%, rgba(255, 255, 255, 0.15) 0%, transparent 40%),
            radial-gradient(circle at 80% 70%, rgba(255, 255, 255, 0.1) 0%, transparent 40%);
        animation: rotateGradient 20s linear infinite;
    }

    @keyframes rotateGradient {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .hero-content {
        position: relative;
        z-index: 3;
        text-align: center;
        max-width: 500px;
    }

    .logo-container {
        width: 100px;
        height: 100px;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 2.5rem;
        position: relative;
        animation: var(--floating-animation);
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        border: 2px solid rgba(255, 255, 255, 0.2);
    }

    .logo-container::after {
        content: '';
        position: absolute;
        inset: -5px;
        background: var(--primary-gradient);
        border-radius: 30px;
        z-index: -1;
        filter: blur(15px);
        opacity: 0.5;
    }

    .logo-icon {
        font-size: 3rem;
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        filter: drop-shadow(0 0 10px rgba(255, 255, 255, 0.5));
    }

    .hero-title {
        font-size: 3.2rem;
        font-weight: 900;
        color: white;
        margin-bottom: 1rem;
        text-shadow: 0 2px 30px rgba(0, 0, 0, 0.3);
        background: linear-gradient(45deg, #ffffff, #f093fb);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: titleGlow 2s ease-in-out infinite alternate;
    }

    @keyframes titleGlow {
        from {
            filter: drop-shadow(0 0 5px rgba(255, 255, 255, 0.3));
        }
        to {
            filter: drop-shadow(0 0 20px rgba(255, 255, 255, 0.5));
        }
    }

    .hero-subtitle {
        font-size: 1.2rem;
        color: rgba(255, 255, 255, 0.9);
        font-weight: 400;
        line-height: 1.6;
        margin-bottom: 3rem;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
        margin-top: 3rem;
    }

    .feature-card {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 16px;
        padding: 1.5rem;
        text-align: center;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .feature-card:hover {
        background: rgba(255, 255, 255, 0.15);
        transform: translateY(-5px);
        border-color: rgba(255, 255, 255, 0.3);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .feature-icon {
        font-size: 2rem;
        margin-bottom: 1rem;
        display: block;
    }

    .feature-text {
        color: white;
        font-weight: 600;
        font-size: 0.9rem;
        opacity: 0.9;
    }

    /* Right Side - Glassmorphism Form */
    .login-right {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 4rem;
        position: relative;
        z-index: 2;
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 24px;
        padding: 3rem;
        max-width: 480px;
        width: 100%;
        margin: 0 auto;
        box-shadow: var(--card-shadow);
        position: relative;
        overflow: hidden;
    }

    .glass-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.5), transparent);
    }

    .form-header {
        margin-bottom: 2.5rem;
        text-align: center;
    }

    .form-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: white;
        margin-bottom: 0.5rem;
        position: relative;
        display: inline-block;
    }

    .form-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 4px;
        background: var(--primary-gradient);
        border-radius: 2px;
    }

    .form-subtitle {
        color: rgba(255, 255, 255, 0.7);
        font-size: 1rem;
        margin-top: 1.5rem;
    }

    /* Input Fields */
    .input-group {
        position: relative;
        margin-bottom: 2rem;
    }

    .input-group label {
        position: absolute;
        top: -10px;
        left: 15px;
        background: #0a0a14;
        padding: 0 10px;
        color: rgba(102, 126, 234, 0.9);
        font-size: 0.85rem;
        font-weight: 600;
        z-index: 2;
    }

    .input-group input {
        width: 100%;
        padding: 1.2rem 1.5rem;
        background: rgba(255, 255, 255, 0.05);
        border: 2px solid rgba(102, 126, 234, 0.2);
        border-radius: 12px;
        color: white;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .input-group input:focus {
        outline: none;
        border-color: rgba(102, 126, 234, 0.8);
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
        background: rgba(255, 255, 255, 0.08);
    }

    .input-group input::placeholder {
        color: rgba(255, 255, 255, 0.3);
    }

    .password-toggle {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: rgba(255, 255, 255, 0.5);
        font-size: 1.2rem;
        transition: color 0.3s ease;
    }

    .password-toggle:hover {
        color: rgba(102, 126, 234, 0.9);
    }

    /* Checkbox Custom */
    .checkbox-container {
        display: flex;
        align-items: center;
        margin-bottom: 2rem;
        gap: 0.8rem;
    }

    .custom-checkbox {
        width: 20px;
        height: 20px;
        border: 2px solid rgba(102, 126, 234, 0.5);
        border-radius: 6px;
        position: relative;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .custom-checkbox.checked {
        background: var(--primary-gradient);
        border-color: transparent;
    }

    .custom-checkbox.checked::after {
        content: '✓';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-size: 12px;
        font-weight: bold;
    }

    .checkbox-label {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.9rem;
        cursor: pointer;
    }

    .forgot-link {
        color: rgba(102, 126, 234, 0.9);
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        margin-left: auto;
    }

    .forgot-link:hover {
        color: #f093fb;
        text-shadow: 0 0 10px rgba(240, 147, 251, 0.5);
    }

    /* Submit Button */
    .submit-btn {
        width: 100%;
        padding: 1.2rem;
        background: var(--primary-gradient);
        border: none;
        border-radius: 12px;
        color: white;
        font-size: 1.1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
    }

    .submit-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: 0.5s;
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 40px rgba(102, 126, 234, 0.6);
    }

    .submit-btn:hover::before {
        left: 100%;
    }

    /* Register Link */
    .register-section {
        text-align: center;
        margin-top: 2.5rem;
        padding-top: 2rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .register-text {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.95rem;
    }

    .register-link {
        color: rgba(102, 126, 234, 0.9);
        font-weight: 700;
        text-decoration: none;
        margin-left: 5px;
        position: relative;
        transition: all 0.3s ease;
    }

    .register-link::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: var(--primary-gradient);
        transition: width 0.3s ease;
    }

    .register-link:hover {
        color: #f093fb;
    }

    .register-link:hover::after {
        width: 100%;
    }

    /* Alert Styling */
    .alert-container {
        position: fixed;
        top: 2rem;
        right: 2rem;
        z-index: 1000;
        max-width: 400px;
    }

    .alert {
        background: rgba(255, 71, 87, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 71, 87, 0.3);
        border-radius: 12px;
        padding: 1.2rem 1.5rem;
        color: #ff6b81;
        font-weight: 600;
        margin-bottom: 1rem;
        animation: slideInRight 0.5s ease;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .login-container {
            flex-direction: column;
        }

        .login-left, .login-right {
            padding: 3rem 2rem;
        }

        .features-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    @media (max-width: 768px) {
        .glass-card {
            padding: 2rem;
        }

        .hero-title {
            font-size: 2.5rem;
        }

        .features-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .feature-card {
            padding: 1rem;
        }
    }

    @media (max-width: 480px) {
        .login-left, .login-right {
            padding: 2rem 1rem;
        }

        .glass-card {
            padding: 1.5rem;
        }

        .form-title {
            font-size: 2rem;
        }

        .features-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Floating Animation */
    @keyframes float {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-20px);
        }
    }
</style>

<div class="login-container">
    <!-- Animated Background Particles -->
    <div class="particles" id="particles"></div>

    <!-- Left Side - Interactive Hero -->
    <div class="login-left">
        <div class="hero-content">
            <div class="logo-container">
                <div class="logo-icon">⚡</div>
            </div>
            
            <h1 class="hero-title">Employee Portal</h1>
            <p class="hero-subtitle">Access your workspace with enhanced security and seamless experience</p>
            
            <div class="features-grid">
                <div class="feature-card" data-tooltip="Real-time notifications">
                    <div class="feature-icon">🔔</div>
                    <div class="feature-text">Live Updates</div>
                </div>
                <div class="feature-card" data-tooltip="Secure data encryption">
                    <div class="feature-icon">🔒</div>
                    <div class="feature-text">Advanced Security</div>
                </div>
                <div class="feature-card" data-tooltip="Access anywhere, anytime">
                    <div class="feature-icon">☁️</div>
                    <div class="feature-text">Cloud Sync</div>
                </div>
                <div class="feature-card" data-tooltip="Smart analytics dashboard">
                    <div class="feature-icon">📊</div>
                    <div class="feature-text">Analytics</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Side - Glassmorphism Form -->
    <div class="login-right">
        <div class="glass-card">
            <div class="form-header">
                <h2 class="form-title">Welcome Back</h2>
                <p class="form-subtitle">Sign in to continue to your employee dashboard</p>
            </div>

            @if ($errors->any())
                <div class="alert" role="alert">
                    <span>⚠️</span>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf

                <div class="input-group">
                    <label for="email">Email Address</label>
                    <input id="email"
                           type="email"
                           name="email"
                           value="{{ old('email') }}"
                           placeholder="employee@company.com"
                           required
                           autofocus>
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <input id="password"
                           type="password"
                           name="password"
                           placeholder="Enter your password"
                           required>
                    <span class="password-toggle" onclick="togglePassword()">👁️</span>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="checkbox-container">
                        <div class="custom-checkbox" id="rememberCheckbox"></div>
                        <label class="checkbox-label" for="rememberCheckbox">Remember me</label>
                        <input type="checkbox" name="remember" id="remember" style="display: none;">
                    </div>
                    <a href="#" class="forgot-link">Forgot Password?</a>
                </div>

                <button type="submit" class="submit-btn">
                    <span>Sign In</span>
                    <span style="margin-left: 10px;">→</span>
                </button>

                <div class="register-section">
                    <p class="register-text">
                        New employee?
                        <a href="{{ route('register') }}" class="register-link">Create Account</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Particle System
function createParticles() {
    const particlesContainer = document.getElementById('particles');
    const particleCount = 50;

    for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        
        const size = Math.random() * 10 + 5;
        const posX = Math.random() * 100;
        const duration = Math.random() * 20 + 15;
        const delay = Math.random() * 5;
        
        particle.style.width = `${size}px`;
        particle.style.height = `${size}px`;
        particle.style.left = `${posX}%`;
        particle.style.animationDelay = `${delay}s`;
        particle.style.animationDuration = `${duration}s`;
        
        particlesContainer.appendChild(particle);
    }
}

// Password Toggle
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const icon = document.querySelector('.password-toggle');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.textContent = '🙈';
    } else {
        passwordInput.type = 'password';
        icon.textContent = '👁️';
    }
}

// Custom Checkbox
const checkbox = document.getElementById('rememberCheckbox');
const hiddenCheckbox = document.getElementById('remember');

checkbox.addEventListener('click', () => {
    checkbox.classList.toggle('checked');
    hiddenCheckbox.checked = checkbox.classList.contains('checked');
});

// Form Validation
const loginForm = document.getElementById('loginForm');
loginForm.addEventListener('submit', (e) => {
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    
    if (!email || !password) {
        e.preventDefault();
        showAlert('Please fill in all fields', 'error');
    }
});

// Tooltip for Feature Cards
const featureCards = document.querySelectorAll('.feature-card');
featureCards.forEach(card => {
    const tooltip = card.getAttribute('data-tooltip');
    if (tooltip) {
        card.addEventListener('mouseenter', () => {
            const tooltipEl = document.createElement('div');
            tooltipEl.className = 'tooltip';
            tooltipEl.textContent = tooltip;
            tooltipEl.style.cssText = `
                position: absolute;
                background: rgba(0, 0, 0, 0.8);
                color: white;
                padding: 8px 12px;
                border-radius: 6px;
                font-size: 0.8rem;
                white-space: nowrap;
                z-index: 1000;
                pointer-events: none;
                transform: translateY(-100%);
                margin-top: -10px;
            `;
            card.appendChild(tooltipEl);
        });
        
        card.addEventListener('mouseleave', () => {
            const tooltipEl = card.querySelector('.tooltip');
            if (tooltipEl) tooltipEl.remove();
        });
    }
});

// Initialize particles when page loads
document.addEventListener('DOMContentLoaded', () => {
    createParticles();
    
    // Add floating animation to feature cards
    featureCards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.2}s`;
        card.style.animation = 'float 6s ease-in-out infinite';
    });
});
</script>

@endsection