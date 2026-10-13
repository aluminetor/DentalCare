<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión | DentalCare</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: #f1f5f9;
            font-family: Arial, sans-serif;
            color: #1e293b;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            padding: 32px;
            background: white;
            border-radius: 14px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        }

        .brand {
            text-align: center;
            margin-bottom: 28px;
        }

        .brand h1 {
            margin: 0 0 8px;
            color: #0f766e;
        }

        .brand p {
            margin: 0;
            color: #64748b;
        }

        .field {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
            font-size: 15px;
        }

        input:focus {
            outline: 2px solid #99f6e4;
            border-color: #0f766e;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
        }

        .remember label {
            margin: 0;
            font-weight: normal;
        }

        button {
            width: 100%;
            padding: 13px;
            border: 0;
            border-radius: 7px;
            background: #0f766e;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #115e59;
        }

        .error {
            margin-top: 6px;
            color: #b91c1c;
            font-size: 14px;
        }

        .general-error {
            padding: 12px;
            margin-bottom: 18px;
            border-radius: 7px;
            background: #fef2f2;
            color: #b91c1c;
        }
    </style>
</head>
<body>
    <main class="login-card">
        <header class="brand">
            <h1>DentalCare</h1>
            <p>Gestión de atención odontológica</p>
        </header>

        @if ($errors->any())
            <div class="general-error" role="alert">
                Revisa los datos ingresados e inténtalo nuevamente.
            </div>
        @endif

        <form method="POST" action="{{ route('login.store') }}">
            @csrf

            <div class="field">
                <label for="email">Correo electrónico</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    autocomplete="username"
                    required
                    autofocus
                >

                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="password">Contraseña</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    autocomplete="current-password"
                    required
                >

                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="remember">
                <input id="remember" type="checkbox" name="remember" value="1">
                <label for="remember">Recordar mi sesión</label>
            </div>

            <button type="submit">Iniciar sesión</button>
        </form>
    </main>
</body>
</html>