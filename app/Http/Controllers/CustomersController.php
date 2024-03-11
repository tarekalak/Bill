<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomersController extends Controller
{


       function __construct()
    {
        $this->middleware(['permission:customers|customer create|customer update|customer delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:customer create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:customer edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:customer delete'], ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers=Customer::select('*')->orderby('id')->paginate(5);
        return view('customer.index',['customers'=>$customers]);
    }
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'customer_name' => 'required',
            'phone' => 'required|max:255|unique:customers',
            'customer_location' => 'required',
            'email' => 'required|max:255|unique:customers',
        ],[
            'customer_name.required'=>'ادخل الاسم',
            'phone.required'=>'ادخل رقم الهاتف',
            'phone.unique'=>' رقم الهاتف موجود مسبقاً',
            'customer_location.required'=>'ادخل الموقع',
            'email.required'=>'ادخل البريد الإلكتروني',
            'email.unique'=>'البريد الإلكتروني موجود مسبقاً',
        ]);

        $data    ['customer_name'] = $request->customer_name;
        $data    ['phone'] =    $request->phone;
        $data    ['location'] = $request->customer_location;
        $data    ['email'] = $request->email;
        $data    ['created_at'] = date('Y/m/d H:m:s');
        Customer::create($data);
        return redirect()->route('customer.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer=Customer::select('*')->where(['id'=>$id])->first();
        return view('customer.edit',['customer'=>$customer]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
             $request->validate([
            'customer_name' => 'required',
            'phone' => 'required',
            'location' => 'required',
            'email' => 'required',
        ],[
            'customer_name.required'=>'ادخل الاسم',
            'phone.required'=>'ادخل رقم الهاتف',
            'location.required'=>'ادخل الموقع',
            'email.required'=>'ادخل البريد الإلكتروني',
        ]);

        $data    ['customer_name'] = $request->customer_name;
        $data    ['phone'] =    $request->phone;
        $data    ['location'] = $request->location;
        $data    ['email'] = $request->email;
        $data    ['updated_at'] = date('Y/m/d H:m:s');
        Customer::where(['id'=>$id])->update($data);
        return redirect(route('customer.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Customer::where(['id'=>$id])->delete();
        return redirect()->route('customer.index');
    }
}
