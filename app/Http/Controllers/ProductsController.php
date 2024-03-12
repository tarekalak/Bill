<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{

    function __construct()
    {
        $this->middleware(['permission:products|product create|product update|product delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:product create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:product edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:product delete'], ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products=Product::select('*')->orderby('id')->paginate(5);
        return view('Product.index',['products'=>$products]);
    }
    public function create()
    {
        return view('Product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'product_name' => 'required',
            'product_company' => 'required',
            'product_price' => 'required',
        ],[
            'product_name.required'=>' ادخل الاسم المنتج',
            'product_company.required'=>' ادخل الشركة المصنعة للمنتج',
            'product_price.required'=>'ادخل سعر المنتج',
        ]);


        $data    ['product_name'] = $request->product_name;
        $data    ['product_company'] =$request->product_company;
        $data    ['note'] = $request->note;
        $data    ['product_price'] = $request->product_price;
        $data    ['created_at'] = date('Y/m/d H:m:s');
        Product::create($data);
        return redirect()->route('product.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product=Product::select('*')->where(['id'=>$id])->first();
        return view('Product.edit',['product'=>$product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'product_name' => 'required',
            'product_company' => 'required',
            'product_price' => 'required',
        ],[
            'product_name.required'=>' ادخل الاسم المنتج',
            'product_company.required'=>' ادخل الشركة المصنعة للمنتج',
            'product_price.required'=>'ادخل سعر المنتج',
        ]);

        $data    ['product_name'] = $request->product_name;
        $data    ['product_company'] =$request->product_company;
        $data    ['note'] = $request->note;
        $data    ['product_price'] = $request->product_price;
        $data    ['updated_at'] = date('Y/m/d H:m:s');
        Product::where(['id'=>$id])->update($data);
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::where(['id'=>$id])->delete();
        return redirect()->route('bill.index');
    }
}
