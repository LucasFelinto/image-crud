<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Hello World</h1>
    <form action={{ route('products.store') }} method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" placeholder="title" name="title">
        <input type="file" name="image">
        <button type="submit">Enviar arquivo</button>
    </form>
</body>
</html>
