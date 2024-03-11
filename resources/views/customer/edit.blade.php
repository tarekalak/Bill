@extends('layouts.master')
@section('css')

@section('title')
   {{ trans('page_trans.edit')}} {{ trans('main_trans.customers') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('page_trans.edit')}} {{ trans('page_trans.customer') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ route('customer.index') }}" class="default-color">{{ trans('page_trans.customers') }}</a></li>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <li class="breadcrumb-item active">{{ trans('page_trans.edit')}} {{ trans('page_trans.customer') }} </li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="container" style="margin: 30px">
        <form action="{{ route('customer.update',$customer->id) }}" method="post">
            @csrf
            @method('PUT')
            <label for="customerName">{{ trans('page_trans.cust_name') }}</label>
            <input class="form-control border border-1 mb-1" type="text" name="customer_name" id="customer_name" placeholder="{{ trans('page_trans.cust_name') }}" value="{{ $customer->customer_name }}">
            <label for="customerName">{{ trans('page_trans.phone') }}</label>
            <input class="form-control border border-1 mb-1" type="text" name="phone" id="phone" placeholder="{{ trans('page_trans.phone') }}" value="{{ $customer->phone }}">
            <label for="customerName">{{ trans('page_trans.location') }}</label>
            <input class="form-control border border-1 mb-1" type="text" name="location" id="location" placeholder="{{ trans('page_trans.location') }}" value="{{ $customer->location }}">
            <label for="customerName">{{ trans('page_trans.email') }}</label>
            <input class="form-control border border-1 mb-1" type="text" name="email" id="email" placeholder="{{ trans('page_trans.email') }}" value="{{ $customer->email }}">



                <div  style="margin-top:20px; margin-right: 20px; text-align: right ">
                    <button type="submit" class="btn btn-primary m-1">{{ trans('page_trans.edit') }}</button>
                    <a href="{{ route('customer.index') }}" class="btn btn-danger">{{ trans('page_trans.back') }}</a>
                </div>
            </div>
        </form>
    </div>

                    </div>
<!-- row closed -->
@endsection
@section('js')

@endsection
