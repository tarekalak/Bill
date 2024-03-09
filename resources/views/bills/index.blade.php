@extends('layouts.master')
@section('css')

@section('title')
    {{ trans('page_trans.bills') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('page_trans.bills') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item active"> {{ trans('main_trans.bills') }}</li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="default-color">{{ trans('main_trans.dashbord') }}</a></li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">

                @if($errors->any())
                <div class="alert alert-danger">
                <h4 class="card-title mg-b-0"><a class="btn btn-outline-primary btn-block " href="{{ route('bill.create') }}">{{ trans('page_trans.new_bill') }}</a></h4>
                    <ul>
                        @foreach ($errors->all as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{ route('searchBill') }}" method="get">
                    <div class="row">
                        <div class="col-1"><br>
                            <p>{{ trans('page_trans.from') }}</p>
                        </div>
                        <div class="col-4">
                            <input type="date" class="form-control" name="bill_date_start" id="start" >
                        </div>
                        <div class="col-1"><br>
                            <p>{{ trans('page_trans.to') }}</p>
                        </div>
                        <div class="col-4">
                            <input type="date" class="form-control" name="bill_date_end">
                        </div>
                        <button  type="submit" class="btn btn-primary fa fa-search"></button>
                    </div>
                </form>


<!-- row -->

                <div class="d-flex justify-content-between">
                  @can('bill create')
                  <h4 class="card-title mg-b-0"><a class="btn btn-outline-primary btn-block" href="{{ route('bill.create') }}">{{ trans('page_trans.new_bill') }}</a></h4>
                  @endcan
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-xl-3 mg-t-20 mg-sm-t-0">


            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-md-nowrap" id="example1">
                        <thead>
                            <tr>
                                <th class="th border-bottom-0">{{ trans('page_trans.code') }}</th>
                                <th class="th border-bottom-0">{{ trans('page_trans.customer') }}</th>
                                <th class="th border-bottom-0">{{ trans('page_trans.date') }}</th>
                                <th class="th border-bottom-0">{{ trans('page_trans.discount') }}</th>
                                <th class="th border-bottom-0">{{ trans('page_trans.Total_amount') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bills as $bill)
                            <tr>
                                <td>{{$bill->id}}</td>

                                @if($bill->customer_name==null)
                                <td>{{ trans('page_trans.cash') }}</td>
                                @else
                                <td>{{$bill->customer_name}}</td>
                                @endif

                                <td>{{$bill->date}}</td>
                                <td>{{$bill->discount}}</td>
                                <td>@php
                                        $total_amount=0;
                                        foreach ($bill->bill_details as $value) {
                                            $total_amount+=$value->product_price*$value->quantity;
                                        }
                                        echo number_format($total_amount - $total_amount*$bill->discount/100 );
                                    @endphp
                                </td>
                                <td style="text-align: right">


                                            <form action="{{ route('bill.destroy',$bill->id) }}"  method="post">
                                                @csrf
                                                @method('DELETE')
                                                @can('bill show')
                                                <a href="{{ route('bill.show',$bill->id) }}" class="btn btn-info "><i class="fa fa-plus"></i></a>
                                                @endcan
                                                @can('bill edit')
                                                <a href="{{ route('bill.edit',$bill->id) }}" class="btn btn-success "><i class="fa fa-pencil"></i></a>
                                                @endcan
                                                @can('bill delete')
                                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> </button>
                                                @endcan
                                            </form>


                                    </td>

                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->

<script>
    function printDiv(key) {
        var printContents = document.getElementById("print_"+key).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML=originalContents;
        location.reload();

    }

</script>
@endsection
@section('js')

@endsection
