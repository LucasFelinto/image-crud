<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = new Product();

        return view('products.index', [
            'products' => $products->all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $product = new Product();
        $product->title = $request->title;
        $product->save();

        $image = new Image();
        $image->product_id = $product->id;
        $image->path = $request->file('image')->store('produto');
        $image->save();
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', [
            'product' => $product
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product, Request $request, Image $image)
    {
        return view('products.show', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image, Product $product)
    {
        Storage::disk('public')->delete($product->images->path);
        $product->title = $request->title;
        $product->save();
        Image::where('id', $product->images->id)->update(['path' => $request->file('image')->store('produto')]);
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        Storage::disk('public')->delete($product->images->path);
        $product->images()->delete();
        $product->delete();
        return redirect()->route('products.index');
    }
}
