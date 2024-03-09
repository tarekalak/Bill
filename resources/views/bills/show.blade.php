@extends('layouts.master')
@section('css')

@section('title')
{{ trans('page_trans.bill_details') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('page_trans.bill_details') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item active">{{ trans('page_trans.bill_details') }}</li>
                <li class="breadcrumb-item"><a href="{{ route('bill.index') }}" class="default-color">{{ trans('page_trans.bills') }}</a></li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <div id="print">
                            <div class="container">
                                <div class="row">
                                    <div class="col-8 mt-4 ">
                                            <ul class="list-unstyled float-end">
                                                <li class="m-2"  style="font-size: 30px; color: red;">{{ $company->name}}</li>
                                                <li class="m-2" ><b> {{ trans('page_trans.location') }}  : </b>{{ $company->location }}</li>
                                                <li class="m-2" ><b>{{ trans('page_trans.phone') }}  :</b> {{ $company->phone }}</li>
                                                <li class="m-2" ><b>{{ trans('page_trans.email') }}  :</b> {{ $company->email }}</li>
                                                <li class="m-2" ><b>{{ trans('page_trans.code') }}  :</b> {{ $bill->id }}</li>
                                            </ul>
                                    </div>


                                    <div class="col-4 ">
                                        <img class="w-50 t m-5" src="{{ asset('company/'.App\Models\Company::where(['id'=>1])->value('logo'))}}" alt="">
                                    </div>
                                </div>

                      <div class="row text-center">
                        <h3 class="text-uppercase text-center mt-3" style="font-size: 40px;">{{ trans('page_trans.bills') }}</h3>
                      </div>

                      <div class="row mx-3">
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">{{ trans('page_trans.code') }}</th>
                              <th scope="col">{{ trans('page_trans.products') }}</th>
                              <th scope="col">{{ trans('page_trans.quantity') }}</th>
                              <th scope="col">{{ trans('page_trans.price') }}</th>
                              <th scope="col">{{ trans('page_trans.Total_amount') }}</th>
                            </tr>
                          </thead>
                          <tbody>
                            @php
                                $total=0;
                            @endphp
                            @foreach ($bill->bill_Details as $item)
                            <tr>
                              <td>{{ $item->product_id }}</td>
                              <td>{{ App\Models\Product::where(['id'=>$item->product_id])->value('product_name') }}</td>
                              <td>{{ $item->quantity}}</td>
                              <td><i class="fas fa-dollar-sign"></i>{{number_format( $item->product_price) }}</td>
                              <td><i class="fas fa-dollar-sign"></i>{{number_format( $item->product_price*$item->quantity) }}</td>
                              @php
                                  $total=$total+$item->product_price*$item->quantity;
                              @endphp
                            </tr>
                            @endforeach
                          </tbody>
                        </table>

                      </div>
                      <div class="row">
                        <div class="col-xl-8">
                          <ul class="list-unstyled float-end me-0">
                            <li><span class="me-3 float-start">{{ trans('page_trans.Total_amount') }}:</span><i class="fas fa-dollar-sign"></i>  @php echo number_format($total)   @endphp
                            </li>
                            <li> <span class="me-5">{{ trans('page_trans.discount') }}:</span><i class="fas fa-dollar-sign"></i>{{ $bill->discount }}%</li>

                          </ul>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-xl-8" style="margin-left:60px">
                          <p class="float-end"
                            style="font-size: 30px; color: red; font-weight: 400;font-family: Arial, Helvetica, sans-serif;">
                            Total:
                            <span><i class="fas fa-dollar-sign"></i> @php echo number_format($total - $total*$bill->discount/100 ) @endphp</span></p>
                        </div>

                      </div>

                      <div class="row mt-2 mb-5">
                        <p class="fw-bold">{{ trans('page_trans.date') }}: <span class="text-muted">{{ $bill->date }}</span></p>
                      </div>
                    </div>
                </div>
                <div class="containt row">
                  @can('bill delete')
                  <div class="col-1"><form action="{{ route('bill.destroy',$bill->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-lg fa fa-trash"></button>
                  </form>
              </div>
              @endcan

                <div class="col-1 ">
                  <button class="btn btn-warning btn-lg fa fa-print" onclick="printDiv()"></button>
                </div>
              </div>



            </div>
            <div class="card-footer bg-black"></div>
        </div>
        <a href="{{ route('bill.index') }}" class="btn btn-secondary">{{ trans('page_trans.back') }}</a>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
<script>
        function printDiv() {
        var printContents = document.getElementById("print").innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML=originalContents;
        location.reload();

    }
</script>

@endsection
