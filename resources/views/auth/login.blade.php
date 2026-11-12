
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Manajemen Kos & Properti</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: #f3f4f6;
            font-family: Arial, sans-serif;
        }

        nav {
            background: #ffffff;
            padding: 15px 30px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .navbar-container {
            max-width: 1140px;
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .navbar-brand {
            font-size: 22px;
            font-weight: bold;
            color: #2563eb;
            text-decoration: none;
        }

        .navbar-link {
            color: #374151;
            text-decoration: none;
            margin-left: 20px;
        }

        .navbar-link:hover {
            color: #2563eb;
        }

        .login-section {
            padding: 50px 15px;
        }

        .container {
            max-width: 1140px;
            margin: 0 auto;
        }

        .login-row {
            display: flex;
            justify-content: center;
        }

        .login-column {
            width: 100%;
            max-width: 400px;
        }

        .form-card {
            padding: 30px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-top: 0;
            margin-bottom: 24px;
            padding-bottom: 12px;
            border-bottom: 1px solid #e5e7eb;
            color: #1f2937;
            font-size: 22px;
        }

        .mb-3 {
            margin-bottom: 18px;
        }

        .mb-4 {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: #374151;
            font-weight: 600;
        }

        .form-control {
            display: block;
            width: 100%;
            padding: 11px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 15px;
        }

        .form-control:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-check-input {
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .form-check-label {
            color: #374151;
        }

        .btn-primary-custom {
            display: block;
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 6px;
            background: #2563eb;
            color: #ffffff;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-primary-custom:hover {
            background: #1d4ed8;
        }

        .alert {
            padding: 10px 12px;
            margin-bottom: 16px;
            border-radius: 6px;
            font-size: 14px;
        }

        .alert-danger {
            background: #fee2e2;
            color: #b91c1c;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
        }

        @media (max-width: 480px) {
            nav {
                padding: 15px;
            }

            .navbar-container {
                flex-wrap: wrap;
                gap: 12px;
            }

            .navbar-link {
                margin-left: 0;
                margin-right: 12px;
            }

            .form-card {
                padding: 22px;
            }
        }
    </style>
</head>
<body>
    <nav>
        <div class="navbar-container">
            <a href="{{ route('penjaga.index') }}" class="navbar-brand">Sistem Manajemen Kos &amp; Properti</a>

            <div>
                <a href="{{ route('penjaga.index') }}" class="navbar-link">Data Penjaga</a>
                <a href="{{ route('login') }}" class="navbar-link">Login</a>
            </div>
        </div>
    </nav>

    <section class="login-section">
        <div class="container">
            <div class="login-row">
                <div class="login-column">
                    <div class="form-card">

                        <h2>Login Pengelola Kos</h2>

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @error('username')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror

                       <form action="{{ route('login.process') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="username" class="form-label">
                                    Username
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    id="username"
                                    name="username"
                                    value="{{ old('username') }}"
                                    required
                                    autofocus
                                >
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    Password
                                </label>

                                <input
                                    type="password"
                                    class="form-control"
                                    id="password"
                                    name="password"
                                    required
                                >
                            </div>

                            <div class="form-check mb-4">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="remember"
                                    name="remember"
                                    value="1"
                                >

                                <label for="remember" class="form-check-label">
                                    Ingat saya
                                </label>
                            </div>

                            <button
                                type="submit"
                                class="btn-primary-custom"
                            >
                                Masuk
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
</html>
