<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Каталог рецептов</title>
    <meta http-equiv="refresh" content="0;url={{ route('home') }}">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-align: center;
            padding: 50px 20px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            margin: 0;
        }
        .logo {
            font-size: 4rem;
            margin-bottom: 1rem;
        }
        .title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }
        .subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-bottom: 2rem;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: white;
            color: #667eea;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: transform 0.2s;
        }
        .btn:hover {
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="logo">🍳</div>
    <h1 class="title">Каталог рецептов</h1>
    <p class="subtitle">Перенаправление на главную страницу...</p>
    <a href="{{ route('home') }}" class="btn">Перейти к рецептам</a>
</body>
</html>
