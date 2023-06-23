<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nuevo snippet</title>
</head>
<body>
    
    <main>

        <div>
            <form action="{{ route('snippet.save') }}" method="POST">
                @csrf
                <div>
                    <label for="title">Titulo
                        <input type="text" name="title">
                    </label>
                </div>
                <div>
                    <label for="description">Descripcion
                        <textarea name="description" id="description" cols="30" rows="10"></textarea>
                    </label>
                </div>
                <div>
                    <label for="code">Snippet
                        <textarea name="code" id="code" cols="30" rows="10"></textarea>
                    </label>
                </div>
                <div>
                    <input type="submit" value="Crear snippet">
                </div>
            </form>
        </div>
    </main>
</body>
</html>