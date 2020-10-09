<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        img {
            width: 400px;
        }
    </style>
</head>
<body>
    <h1>
        {{ $product->title }}
        <img src="{{ env('APP_URL') }}storage/{{ $product->images->path }}" alt="">
    </h1>
    <form action={{ route('products.update', ['product' => $product->id]) }} method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <input type="text" placeholder="title" name="title" value={{ $product->title }}>
        <input type="file" name="image">
        <button type="submit">Enviar arquivo</button>
    </form>
</body>
</html>
