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
        <div>
            Mostrando Snippet {{ $snippet->title }}
            <div class="panel">
                <div class="title">{{ $snippet->title}}</div>
                <div class="description">{{ $snippet->description}}</div>
                <div class="code">
                    <pre>{{ $snippet->code }}</pre>
                </div>

                <div class="footer">

                    <a href="{{ route('snippet.like', ['slug' => $snippet->slug]) }}" 
                        @if ($liked)
                            class="liked"
                        @else
                            class="like"
                        @endif
                        >❤️</a>

                        <span class="badge">{{ $snippet->likes()->count() }} </span>
                    
                </div>
            </div>



            @auth
                <hr>
                <div>

                    <div>
                        Comentarios:

                        <div>
                            

                            @foreach ($snippet->comentarios as $comentario)
                                <div style="border: 1px solid #666; border-radius:5px; margin-bottom: .6rem;">
                                    <div class="header" style="background-color: #CCCCFF; padding:.4rem">
                                        <small style="font-weight: bold;">{{ $comentario->usuario->name }}</small>
                                    </div>
                                    <div style="padding:.4rem">
                                        {{ $comentario->comment }}
                                    </div>
                                    <div style="text-align: right; padding-right: .4rem;">
                                        
                                        <form action="/comments/delete/{{ $comentario->id }}" method="POST">
                                            <input type="hidden" name="_method" value="delete">
                                            @csrf
                                            <a href="#" onclick="this.parentElement.submit()">Borrar</a>
                                        </form>

                                        <small style="font-size: .7rem">
                                            {{ $comentario->created_at->locale('es')->diffForHumans() }}
                                        </small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div>
                                    
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="/comment" method="post">
                            @csrf
                            <input type="hidden" name="snippet_slug" value="{{ $snippet->slug }}">
                            <div>
                                <label for="comment">
                                    Añadir comentario
                                    <textarea name="comment" id="comment" rows="10" style="width: 100%;"></textarea>
                                </label>
                            </div>
                            
                            <div style="text-align: right;">
                                <input type="submit" value="Comentar" style="border: 1px solid green; background-color: lightgreen; color:darkgreen; padding: .4rem 1rem; border-radius: 4px;">
                            </div>
                        </form>
                        <hr><br>
                    </div>
    


                </div>
            @endauth
        </div>
    </main>

</body>
</html>