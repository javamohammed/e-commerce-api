<?php

namespace App\Http\Controllers;

use App\Model\Product;
use Illuminate\Http\Request;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ResourceProduct;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Response;
use App\Exceptions\ProductNotBelongsToUser;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('index', 'show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return ProductCollection::collection(Product::paginate(10));
       // return Product::all();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        //
        $product = new Product();
        $product->name = $request->name;
        $product->detail = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->discount = $request->discount;
        $product->save();

        return response([
            'data' => new ResourceProduct($product)
        ],Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
        return new ResourceProduct( $product);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
        $this->ProductUserCheck($product);
        $request['detail'] = $request['description'];
        unset( $request['description']);
        $product->update( $request->all());
        return response(['data' => 'The product has updated with success!!'], Response::HTTP_UPGRADE_REQUIRED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
        $this->ProductUserCheck($product);
        $product->delete();
        return response(['data' => 'The product has deleted with success!!'],Response::HTTP_NOT_FOUND);
    }

    public function ProductUserCheck(Product $product)
    {
        //
        if(auth()->user()->id != $product->user_id){
           // dd($product->user_id);
            throw new ProductNotBelongsToUser;
        }
    }
}
