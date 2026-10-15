<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Pegawai</title>

    <!-- ✅ BOOTSTRAP CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- ✅ GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-blue: #0052FF;
            --neon-green: #B9FF00;
            --dark-bg: #0A0E27;
            --darker-bg: #050816;
            --text-white: #ffffff;
            --text-gray: #8B92B0;
            --card-dark: #131833;
            --gradient-purple: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--darker-bg);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            color: var(--text-white);
            -webkit-font-smoothing: antialiased;
        }

        /* ===== HEADER NAVBAR ===== */
        header {
            background-color: var(--dark-bg);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 2px solid rgba(102, 126, 234, 0.3);
        }

        .navbar {
            padding: 1.2rem 0;
        }

        .navbar-brand {
            font-weight: 900;
            font-size: 1.8rem;
            color: var(--text-white) !important;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: all 0.3s ease;
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .brand-icon {
            width: 40px;
            height: 40px;
            background: var(--gradient-purple);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .navbar-brand:hover {
            transform: translateY(-2px);
            color: var(--neon-green) !important;
        }

        .navbar-brand:hover .brand-icon {
            transform: rotate(10deg);
        }

        .navbar-toggler {
            border: 2px solid rgba(102, 126, 234, 0.5);
            padding: 0.5rem;
            background-color: rgba(102, 126, 234, 0.1);
            border-radius: 8px;
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.3);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='%23667eea' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        .navbar-nav {
            gap: 0.3rem;
        }

        .nav-link {
            color: var(--text-gray) !important;
            font-weight: 600;
            font-size: 0.95rem;
            padding: 0.7rem 1.2rem !important;
            border-radius: 10px;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background: var(--gradient-purple);
            transition: width 0.3s ease;
        }

        .nav-link:hover {
            color: var(--text-white) !important;
            background-color: rgba(102, 126, 234, 0.15);
        }

        .nav-link:hover::before {
            width: 60%;
        }

        .nav-link.active {
            background: var(--gradient-purple);
            color: white !important;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .nav-link.active::before {
            display: none;
        }

        .nav-link.btn-link {
            background: var(--gradient-purple);
            color: white !important;
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .nav-link.btn-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(102, 126, 234, 0.5);
        }

        /* ===== MAIN CONTENT ===== */
        main {
            flex: 1;
            max-width: 100%;
            width: 100%;
            padding: 0;
            background-color: var(--darker-bg);
        }

        /* For pages that need container */
        .content-container {
            max-width: 1400px;
            width: 100%;
            margin: 3rem auto;
            padding: 3rem;
            background-color: var(--dark-bg);
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
            position: relative;
        }

        /* Neon accent border */
        .content-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: var(--gradient-purple);
            background-size: 200% 100%;
            animation: gradientShift 3s ease infinite;
        }

        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        /* ===== FOOTER ===== */
        footer {
            background-color: var(--dark-bg);
            color: var(--text-gray);
            text-align: center;
            padding: 2rem 0;
            margin-top: auto;
            border-top: 2px solid rgba(102, 126, 234, 0.3);
            position: relative;
        }

        footer::before {
            content: '';
            position: absolute;
            top: -2px;
            left: 0;
            width: 30%;
            height: 2px;
            background: var(--gradient-purple);
            animation: slideRight 3s ease infinite;
        }

        @keyframes slideRight {
            0%, 100% { left: 0; }
            50% { left: 70%; }
        }

        footer p {
            margin: 0;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        footer p span {
            background: var(--gradient-purple);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 800;
        }

        /* ===== SCROLLBAR ===== */
        ::-webkit-scrollbar {
            width: 12px;
        }

        ::-webkit-scrollbar-track {
            background: var(--darker-bg);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--gradient-purple);
            border-radius: 6px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #764ba2 0%, #f093fb 100%);
        }

        /* ===== SCROLL TO TOP BUTTON ===== */
        .scroll-top {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 55px;
            height: 55px;
            background: var(--gradient-purple);
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: none;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 20px rgba(102, 126, 234, 0.5);
            transition: all 0.3s ease;
            z-index: 999;
            font-weight: 900;
            font-size: 1.5rem;
        }

        .scroll-top:hover {
            transform: translateY(-5px) scale(1.1);
            box-shadow: 0 6px 30px rgba(102, 126, 234, 0.7);
        }

        .scroll-top.show {
            display: flex;
        }

        /* ===== DECORATIVE ELEMENTS ===== */
        .glow-effect {
            position: fixed;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            pointer-events: none;
            animation: float 10s ease-in-out infinite;
            z-index: 0;
        }

        .glow-effect-1 {
            top: 10%;
            right: 5%;
            background: radial-gradient(circle, rgba(102, 126, 234, 0.15) 0%, transparent 70%);
            animation-delay: 0s;
        }

        .glow-effect-2 {
            bottom: 10%;
            left: 5%;
            background: radial-gradient(circle, rgba(240, 147, 251, 0.15) 0%, transparent 70%);
            animation-delay: 2s;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(30px, 30px) scale(1.1); }
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 992px) {
            .content-container {
                margin: 2rem;
                padding: 2.5rem;
            }

            .navbar-nav {
                gap: 0.25rem;
                margin-top: 1rem;
            }

            .nav-link {
                padding: 0.7rem 1rem !important;
            }
        }

        @media (max-width: 768px) {
            .content-container {
                margin: 1.5rem;
                padding: 2rem 1.5rem;
            }

            .navbar {
                padding: 1rem 0;
            }

            .navbar-brand {
                font-size: 1.5rem;
            }

            .brand-icon {
                width: 35px;
                height: 35px;
                font-size: 1.1rem;
            }

            .scroll-top {
                bottom: 1.5rem;
                right: 1.5rem;
                width: 50px;
                height: 50px;
            }

            .glow-effect {
                width: 250px;
                height: 250px;
            }
        }

        @media (max-width: 576px) {
            .content-container {
                margin: 1rem;
                padding: 1.5rem 1rem;
            }
        }

        /* ===== UTILITY CLASSES ===== */
        .text-gradient {
            background: var(--gradient-purple);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .bg-primary-gradient {
            background: var(--gradient-purple) !important;
        }

        .border-gradient {
            border: 2px solid;
            border-image: linear-gradient(135deg, #667eea 0%, #f093fb 100%) 1;
        }
    </style>
</head>
<body>
    <!-- Decorative glow effects -->
    <div class="glow-effect glow-effect-1"></div>
    <div class="glow-effect glow-effect-2"></div>

    <!-- ===== HEADER NAVBAR ===== -->
    <header>
        <nav class="navbar navbar-expand-lg container">
            <a class="navbar-brand" href="#">
                <span class="brand-icon">⚡</span>
                <span>App Pegawai</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    @auth
                        {{-- ADMIN & HR --}}
                        @if(auth()->user()->isAdmin() || auth()->user()->isHr())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('employees.index') }}">Employees</a>
                            </li>

                            @if(auth()->user()->isAdmin())
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('departments.index') }}">Departments</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('positions.index') }}">Positions</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('leave_types.index') }}">Leave Types</a>
                                </li>
                            @endif

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('attendances.index') }}">Attendance</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('salaries.index') }}">Salaries</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('overtimes.index') }}">Overtime</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('leaves.index') }}">Leaves</a>
                            </li>
                        @endif

                        {{-- MENU PEGAWAI --}}
                        @if(auth()->user()->isEmployee())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('employee.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('profile.edit') }}">Profile</a>
                            </li>
                        @endif

                        {{-- Logout --}}
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link" style="text-decoration: none;">
                                    Logout
                                </button>
                            </form>
                        </li>
                    @else
                        {{-- belum login --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>
    </header>

    <!-- ===== MAIN CONTENT ===== -->
    <main>
        @yield('content')
    </main>

    <!-- ===== FOOTER ===== -->
    <footer>
        <p>&copy; {{ date('Y') }} <span>App Pegawai</span> - Modern Employee Management System</p>
    </footer>

    <!-- ===== SCROLL TO TOP BUTTON ===== -->
    <button class="scroll-top" id="scrollTop">
        ↑
    </button>

    <!-- ✅ BOOTSTRAP JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Scroll to top button
        const scrollTopBtn = document.getElementById('scrollTop');
        
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                scrollTopBtn.classList.add('show');
            } else {
                scrollTopBtn.classList.remove('show');
            }
        });
        
        scrollTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Active nav link
        const currentPath = window.location.pathname;
        document.querySelectorAll('.nav-link').forEach(link => {    
            if (link.getAttribute('href') === currentPath) {
                link.classList.add('active');
            }
        });
    </script>
</body>
</html>