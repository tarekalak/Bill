@extends('layouts.master')

@section('title')
{{ trans('page_trans.details') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div>
                <h2>{{ trans('page_trans.details') }}
                </h2>
            </div>
        </div>
    </div>



    <div class="col-xs-12 mb-3">
        <div class="form-group">
            <strong>{{ trans('page_trans.name') }} : </strong>
            {{ $role->name }}
        </div>
    </div>
    <div class="col-xs-12 mb-3">
            <div class="form-group">
                <strong>{{ trans('page_trans.permission') }} : </strong>
                @if (!empty($rolePermissions))
                @foreach ($rolePermissions as $v)
                 <p>{{ $v->name }}</p>
                @endforeach
                @endif
            </div>
        </div>

        <div class="float-end">
            <a class="btn btn-primary" href="{{ route('role.index') }}">{{ trans('page_trans.back') }}</a>
        </div>
        @endsection
