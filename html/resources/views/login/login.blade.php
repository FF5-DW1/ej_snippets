<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <main>
        <div>
            <form action="/login" method="POST">
                @csrf
                <div>
                    <label for="email">Email:
                        <input type="email" name="email" id="email">
                    </label>
                </div>
                <div>
                    <label for="password">Password:
                        <input type="password" name="password" id="password">
                    </label>
                </div>

                <div>
                    <input type="submit" value="Login">
                </div>
            </form>
        </div>
    </main>
</body>
</html>