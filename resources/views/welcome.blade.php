<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'URL Shortener') }}</title>
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            color: #17202a;
            background: #f6f7f9;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        main {
            width: min(560px, calc(100% - 32px));
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 32px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
        }

        h1 {
            margin: 0 0 12px;
            font-size: 32px;
            line-height: 1.2;
        }

        p {
            margin: 0 0 24px;
            color: #4b5563;
            line-height: 1.6;
        }

        nav {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        a {
            display: inline-block;
            padding: 10px 16px;
            border-radius: 6px;
            background: #111827;
            color: #ffffff;
            text-decoration: none;
            font-weight: 600;
        }

        a.secondary {
            background: #e5e7eb;
            color: #111827;
        }
    </style>
</head>
<body>
    <main>
        <h1>URL Shortener</h1>
        <p>
            A simple application for creating short links and viewing basic visit statistics.
        </p>

        <nav>
            @auth
                <a href="{{ url('/cabinet') }}">Cabinet</a>
            @else
                <a href="{{ url('/cabinet/login') }}">Login</a>
                <a class="secondary" href="{{ url('/cabinet/register') }}">Register</a>
            @endauth
        </nav>
    </main>
</body>
</html>
