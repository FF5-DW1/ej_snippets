<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
</head>

<body>

    <header>
        <div>
            <h1>Snippati</h1>
        </div>
        <div>
            @auth
                <a href="/profile" class="avatar" title="Perfil de {{ Auth::user()->name }}">
                    {{ Auth::user()->name[0] }}
                </a>
            @endauth
        </div>
    </header>

    @yield('content')

</body>

</html>
