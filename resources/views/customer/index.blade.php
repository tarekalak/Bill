@extends('layouts.master')
@section('css')

@section('title')
   {{trans('page_trans.customers')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('page_trans.customers')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item active">{{trans('page_trans.customers')}}</li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="default-color">{{trans('main_trans.dashbord')}} </a></li>
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
                    @can('customer create')
                    <h4 class="card-title mg-b-0"><a class="btn btn-outline-primary btn-block" href="{{ route('customer.create') }}">{{trans('page_trans.new_customer')}}</a></h4>
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
                                <th class="th border-bottom-0">{{trans('page_trans.cust_name')}}</th>
                                <th class="th border-bottom-0">{{trans('page_trans.phone')}}</th>
                                <th class="th border-bottom-0"> {{trans('page_trans.location')}}</th>
                                <th class="th border-bottom-0"> {{trans('page_trans.email')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $info)
                            <tr>
                                <td>{{$info->customer_name}}</td>
                                <td>{{$info->phone}}</td>
                                <td>{{$info->location}}</td>
                                <td>{{$info->email}}</td>
                                <td style="text-align: right">
                                    <div class="row">
                                        @can('customer edit')
                                        <div class="col-2 mx-1">
                                            <form action="{{ route('customer.edit',$info->id) }}">

                                                <button type="submit" class="btn btn-success" ><i class="fa fa-pencil"></i></button>
                                            </form>
                                        </div>
                                        @endcan
                                        @can('customer delete')
                                        <div class="col-2 mx-1">
                                            <form action="{{ route('customer.destroy',$info->id) }}"  method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                            </form></td>
                                        </div>
                                        @endcan
                                    </div></td>
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
