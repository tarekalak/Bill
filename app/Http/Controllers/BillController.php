<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Bill_details;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

use function Laravel\Prompts\select;

class BillController extends Controller
{


    function __construct()
    {
        $this->middleware(['permission:bills|bill create|role-edit|bill delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:bill create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:role-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:bill delete'], ['only' => ['destroy']]);
    }



    /**
     * Display a listing of the resource.
     */
    public function __invoke(Request $request)
    {

        if($request->bill_date_start == null && $request->bill_date_end!=null){
            $bills=Bill::with('bill_details')->select("*")->whereDate('date','<=',$request->bill_date_end)->paginate(0);
        }
       elseif($request->bill_date_end == null && $request->bill_date_start!=null){
            $bills=Bill::with('bill_details')->select('*')->whereDate('date','>=',$request->bill_date_start)->paginate(0);
        }
        elseif($request->bill_date_start!=null && $request->bill_date_end!=null){
            $bills=Bill::with('bill_details')->select('*')->whereDate('date','>=',$request->bill_date_start)->whereDate('date','<=',$request->bill_date_end)->paginate(0);
        }
        else{
            return redirect(route('bill.index'));
         }

        return view('bills.index',['bills'=>$bills]);
    }


     public function index()
    {
        $bills = Bill::with('users')
    ->with('customers')
    ->with('bill_details')
    ->whereDate('date', '=', date('Y-m-d'))
    ->orderBy('date', 'DESC')
    ->paginate(5);
        $company=Company::select('*')->where(['id'=>1])->first();
        return view('bills.index',['bills'=>$bills,'company'=>$company]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products=Product::all();
        $customers=Customer::all();
        return view('bills.create',['products'=>$products,'customers'=>$customers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        foreach($request->quantity as $i){

    }
        $data    ['customer_name'] = $request->customer_name;
        $data    ['user_name'] =    Auth::user()->name;
        $data    ['discount'] = ($request->discount) ? $request->discount : 0 ;
        $data    ['date'] = ($request->date) ? $request->date :date('Y/m/d H:m:s');

        $bill= Bill::create($data);
        foreach($request->quantity as $i=>$key){
        $info['product_id']= $request->product_id[$i];
        $info['quantity']= $request->quantity[$i];
        $info['product_price']=($request->product_price[$i]) ? $request->product_price[$i] : Product::where(['id'=>$request->product_id[$i]])->value('product_price')* $info['quantity'];
        $info['bill_id']= $bill->id;
        Bill_details::create($info);
        }

        return redirect()->route('bill.index');
    }

    function show($id) {
        $bill=Bill::with('bill_details')->select('*')->where(['id'=>$id])->first();
        $company=Company::select('*')->where(['id'=>1])->first();
        $lang=LaravelLocalization::setLocale();
        if($lang=='ar'){
            $company['location']=$company['location_ar'];
            $company['name']=$company['name_ar'];
        }
        else{
            $company['location']=$company['location_en'];
            $company['name']=$company['name_en'];
        }

        return view('bills.show',['bill'=>$bill,'company'=>$company]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $products=Product::all();
        $customers=Customer::all();
        $bill=Bill::with('bill_details')->select('*')->where(['id'=>$id])->first();
        return view('bills.edit',['bill'=>$bill,'products'=>$products,'customers'=>$customers]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data    ['customer_name'] = $request->customer_name;
        $data    ['user_name'] =    Auth::user()->name;
        $data    ['discount'] = ($request->discount) ? $request->discount : 0 ;
        $data    ['date'] = ($request->date) ? $request->date :date('Y/m/d H:m:s');
        if(!$request->quantity){
            return redirect()->back()->with('null','The bill cannot be empty');
        }
        Bill::where(['id'=>$id])->update($data);
        Bill_details::where(['bill_id'=>$id])->delete();
        foreach($request->quantity as $i=>$key){
        $info['product_id']= $request->product_id[$i];
        $info['quantity']= $request->quantity[$i];
        $info['product_price']=($request->product_price[$i]) ? $request->product_price[$i] : Product::where(['id'=>$request->product_id[$i]])->value('product_price')* $info['quantity'];
        $info['bill_id']= $id;

        Bill_details::create($info);

        }
        Bill::where(['id'=>$id])->update($data);
        return redirect()->route('bill.index');

        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Bill::where(['id'=>$id])->delete();
        return redirect()->route('bill.index');
    }

    public function getprice($id){
        $product_price= Product::where(['id'=>$id])->value('product_price');
        return json_encode($product_price);

 }

}

