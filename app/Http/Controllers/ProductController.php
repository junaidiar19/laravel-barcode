<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $params = request()->except('_except');

        $products = Product::filter($params)->with('category')->get();

        $kode = mt_rand(1111, 9999);

        return view('product.index', compact('categories', 'products', 'kode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::create([
            'kode' => $request->kode,
            'name' => $request->name,
            'qty' => $request->qty,
            'category_id' => $request->category_id
        ]);

        session()->flash('success', 'Product has been added');
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->update([
            'kode' => $request->kode,
            'name' => $request->name,
            'qty' => $request->qty,
            'category_id' => $request->category_id
        ]);

        session()->flash('success', 'Product has been updated');
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        session()->flash('success', 'Product has been deleted');
        return redirect()->back();
    }

    // get product by kode
    public function getProduct(Request $request)
    {
        $product = Product::with('category')->where('kode', $request->kode)->first();

        if($product) {
            return response()->json([
                'status' => 'success',
                'data' => $product
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found',
                'data' => []
            ]);
        }
    }
}
