@extends('layouts.master')

@section('title')
 {{trans('page_trans.details')}}
@endsection

@section('content')
<div class="container">
<div class="row">
    <div class="col-lg-12 margin-tb mb-4">
        <div>
            <h2>{{trans('page_trans.details')}}</h2>
        </div>
    </div>
</div>



<div class="col-xs-12 mb-3">
    <div class="form-group">
        <strong>{{ trans('page_trans.name') }} :</strong>
        {{ $user->name }}
    </div>
</div>
<div class="col-xs-12 mb-3">
    <div class="form-group">
        <strong>{{ trans('page_trans.email') }} :</strong>
        {{ $user->email }}
    </div>
</div>
<div class="col-xs-12 mb-3">
    <div class="form-group">
        <strong>{{ trans('main_trans.role') }} : </strong>
        @if(!empty($user->getRoleNames()))
        @foreach($user->getRoleNames() as $v)
        <label class="badge badge-secondary text-dark">{{ $v }}</label>
        @endforeach
        @endif
    </div>
</div>
<div class="float-center">
    <a class="btn btn-primary" href="{{ route('users.index') }}">{{ trans('page_trans.back') }}</a>
</div>
</div>
@endsection
