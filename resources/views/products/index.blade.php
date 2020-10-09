<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .container {
            display: flex;
        }
        .card {
            border: solid;
        }

        img {
            width: 400px;
        }
    </style>
</head>
<body>
    <a href={{ route('products.create') }}>Add image</a>
    <div class="container">
        @foreach ($products as $product)
            <div class="card">
                <h1>{{$product->title}}</h1>
                <div class="card__img">
                    <img src="{{ env('APP_URL') }}storage/{{ $product->images->path }}" alt="">
                </div>
                <a href={{ route('products.edit', ['product' => $product->id]) }}>Edit</a>
                <form action={{ route('products.destroy', ['product'=> $product->id]) }} method="POST">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="product" value={{ $product->id }}>
                    <button type="submit">Delete</button>
                </form>
            </div>
        @endforeach
    </div>

</body>
</html>
