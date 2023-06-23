<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listado de snippets</title>
    <link rel="stylesheet" href="@vite('resources/css/app.css')">
</head>
<body>
    
    <header>
        @auth
            ESTOY LOGADO 
            {{Auth::user()->email}}
        @endauth
    </header>

    <main>
        <a href="{{route('snippet.new')}}">
            Crear nuevo snippet
        </a>
    </main>

    <main>
        <div class="container">

                @foreach ($snippets as $snippet)
                

                    <div class="panel">
                        <div class="title">
                            <a href="{{ route('snippet.show', ['slug'=>$snippet->slug]) }}">
                                {{ $snippet->title}}
                            </a>
                        </div>
                        <div class="description">{{ $snippet->description}}</div>
                        <div class="code">
                            <pre>{{ $snippet->code}}</pre>
                        
                        </div>
                    </div>
                @endforeach
        </div>
    </main>
</body>
</html>