<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:bills|bill create|role-edit|bill delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:bill create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:role-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:bill delete'], ['only' => ['destroy']]);
    }
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company.company');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'logo' => 'required',
        ]);
        // return $request->logo;
        $company    ['name'] = $request->name;
        $company    ['phone'] =$request->phone;
        $company    ['email'] = $request->email;
        $company    ['logo'] = $this->saveImage($request->logo);
        Company::create($company);
        return redirect()->back()->with('success','updated');

    }

    /**
     * Display the specified resource.
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        $company=Company::select('*')->where(['id'=>1])->first();
        return view('company.edit',['company'=>$company]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'location_ar' => 'required',
            'location_en' => 'required',
        ]);
        // return $request->logo;
        $company    ['name_ar'] = $request->name_ar;
        $company    ['name_en'] = $request->name_en;
        $company    ['phone'] =$request->phone;
        $company    ['email'] = $request->email;
        $company    ['location_en'] = $request->location_en;
        $company    ['location_ar'] = $request->location_ar;
        if($request->logo){
        $company    ['logo'] = $this->saveImage($request->logo);
        }
        Company::where(['id'=>1])->update($company);
        return redirect()->back()->with('success','updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        //
    }
    public function saveImage($imageFromReuqest) {
        $image_to_save=$imageFromReuqest;
        $extinsion=strtolower($image_to_save->getClientOriginalExtension());
        $image_name=time().rand(1,10000).".".$extinsion;
        $image_to_save->move(public_path('company'),$image_name);
        return $image_name;
    }
}
