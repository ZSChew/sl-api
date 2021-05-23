<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required',
            'value' => 'required'
        ]);
        
        $product = Product::create($request->all());

        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($key)
    {
        $param = $_GET;
        if(!empty($param["timestamp"])){
            $product = Product::where([['key', '=' , $key],['created_at', '=' , $param["timestamp"]]])->first();
        }
        else{
            $product = Product::where('key', $key)->orderBy('created_at', 'desc')->first();
        }

        if($product == null){
            return response()->json("Item Not Found",404);
        }

        return response()->json($product->value, 201);
    }
}
