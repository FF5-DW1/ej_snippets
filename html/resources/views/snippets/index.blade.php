@extends('layouts.main')

@section('content')
    <main>
        <a href="{{ route('snippet.new') }}" class="btn green">
            Crear nuevo snippet
        </a>
    </main>

    <main>
        <div class="container">

            @foreach ($snippets as $snippet)
                <div class="panel">
                    <div class="title">
                        <a href="{{ route('snippet.show', ['slug' => $snippet->slug]) }}">
                            {{ $snippet->title }}
                        </a>
                    </div>
                    <div class="description">{{ $snippet->description }}</div>
                    <div class="code">
                        <pre>{{ $snippet->code }}</pre>

                    </div>
                </div>
            @endforeach
        </div>
    </main>
@endsection
