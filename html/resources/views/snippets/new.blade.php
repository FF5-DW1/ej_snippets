@extends('layouts.main')

@section('title', 'Create new snippet')


@section('content')


    <main class="">
        <div class="container">

            <div class="panel">
                <div class="title">
                    Nuevo snippet
                </div>
                <form action="{{ route('snippet.save') }}" method="POST">
                    @csrf

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div>
                        <label for="title">Titulo
                            <input type="text" name="title" value="{{ old('title') }}">
                        </label>
                    </div>
                    <div>
                        <label for="description">Descripcion
                            <textarea name="description" id="description" rows="10">{{ old('description') }}</textarea>
                        </label>
                    </div>
                    <div>
                        <label for="code">Snippet
                            <textarea name="code" id="code" rows="10">{{ old('code') }}</textarea>
                        </label>
                    </div>
                    <div>
                        <input type="submit" value="Crear snippet">
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
