@extends('layouts.master')
@section('css')

@section('title')
     {{ trans('page_trans.new_product') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('page_trans.new_product') }}</h4>
        </div>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item active">{{ trans('page_trans.new_product') }}</li>
                <li class="breadcrumb-item"><a href="{{ route('product.index') }}" class="default-color">{{ trans('page_trans.products') }}</a></li>
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
        <form action="{{ route('product.store') }}" method="post">
            @csrf
            <label for="customerName"> {{ trans('page_trans.product_name') }}</label>
            <input class="form-control border border-1 mb-1" type="text" name="product_name" id="product_name" placeholder="{{ trans('page_trans.product_name') }}" value="{{ old('product_name') }}">
            <label for="customerName">{{ trans('page_trans.company') }}</label>
            <input class="form-control border border-1 mb-1" type="text" name="product_company" id="product_company" placeholder="{{ trans('page_trans.company') }} " value="{{ old('product_company') }}">
            <label for="customerName">{{ trans('page_trans.details') }}</label>
            <input class="form-control border border-1 mb-1" type="text" name="note" id="note" placeholder="{{ trans('page_trans.details') }}" value="{{ old('note') }}">
            <label for="customerName">{{ trans('page_trans.price') }}</label>
            <input class="form-control border border-1 mb-1" type="text" name="product_price" id="product_price" placeholder="{{ trans('page_trans.price') }}" value="{{ old('product_price') }}">



                <div  style="margin-top:20px; margin-right: 20px; text-align: right ">
                    <button type="submit" class="btn btn-primary m-1">{{ trans('page_trans.add') }}</button>
                    <a href="{{ route('product.index') }}" class="btn btn-danger">{{ trans('page_trans.back') }}</a>
                </div>
            </div>
        </form>
    </div>

                    </div>
<!-- row closed -->
@endsection
@section('js')

@endsection
