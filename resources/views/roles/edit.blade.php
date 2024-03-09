@extends('layouts.master')

@section('title')
{{ trans('page_trans.edit') }} {{ trans('main_trans.role') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div>
                <h2>{{ trans('page_trans.edit') }} {{ trans('main_trans.role') }}
                </h2>
            </div>
        </div>
    </div>

    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('role.update',$role->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ trans('page_trans.role_name') }} :</strong>
                    <input type="text" name="name" class="form-control border border-1" value="{{ $role->name }}" placeholder="{{ trans('page_trans.role_name') }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ trans('page_trans.permission') }} :</strong>
                    <br/>
                    @foreach ($permission as $value)
                    <label>
                        <input type="checkbox" @if (in_array($value->id, $rolePermissions)) checked @endif name="permission[]"
                            value="{{ $value->name }}" class="name">
                        {{ $value->name }}</label>
                    <br />
                @endforeach
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 ">
                    <button type="submit" class="btn btn-success">{{ trans('page_trans.edit') }}</button>
                    <a class="btn btn-secondary" href="{{ route('role.index') }}"> {{ trans('page_trans.back') }}</a>
                </div>
            </div>
        </form>
        <div class="float-end">
        </div>
        @endsection
