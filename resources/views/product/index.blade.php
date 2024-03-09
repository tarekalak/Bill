@extends('layouts.master')
@section('css')

@section('title')
    {{ trans('page_trans.products') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('page_trans.products') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item active"> {{ trans('page_trans.products') }}</li>
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
                <div class="d-flex justify-content-between">
                  @can('product create')
                  <h4 class="card-title mg-b-0"><a class="btn btn-outline-primary btn-block" href="{{ route('product.create') }}">{{ trans('page_trans.new_product') }}</a></h4>
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
                                <th class="th border-bottom-0">{{ trans('page_trans.product_name') }}</th>
                                <th class="th border-bottom-0">{{ trans('page_trans.company') }}</th>
                                <th class="th border-bottom-0">{{ trans('page_trans.details') }}</th>
                                <th class="th border-bottom-0">{{ trans('page_trans.price') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td>{{$product->product_name}}</td>
                                <td>{{$product->product_company}}</td>
                                <td>{{$product->note}}</td>
                                <td>{{$product->product_price}}</td>
                                <td style="text-align: right">
                                    <div class="row">
                                        @can('product edit')
                                        <div class="col-2">
                                            <form action="{{ route('product.edit',$product->id) }}" >

                                                <button type="submit" class="btn btn-success"><i class="fa fa-pencil"></i></button>
                                            </form>
                                        </div>
                                        @endcan
                                        @can('product delete')
                                        <div class="col-2">
                                            <form action="{{ route('product.destroy',$product->id) }}"  method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> </button>
                                            </form></td>
                                        </div>
                                        @endcan
                                    </div>
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
@endsection
@section('js')

@endsection
