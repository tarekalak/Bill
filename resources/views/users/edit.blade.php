@extends('layouts.master')

@section('title')
{{ trans('page_trans.edit') }} {{ trans('main_trans.users') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6 margin-tb mb-4">
            <div >
                <h2>{{ trans('page_trans.edit') }} {{ trans('main_trans.users') }}

                </h2>
            </div>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item active">{{ trans('page_trans.edit') }} {{ trans('main_trans.users') }}</li>
                <li class="breadcrumb-item"><a href="{{ route('users.index') }}" class="default-color">{{ trans('main_trans.users') }}</a></li>
            </ol>
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

    <form action="{{ route('users.update',$user->id) }}" method="POST">
        @csrf
        @method("PUT")

            <div class=" mb-3">
                <div class="form-group">
                    <strong>{{ trans('page_trans.name') }}</strong>
                    <input type="text" name="name" class="form-control border boreder-1 mt-1" placeholder="{{ trans('page_trans.name') }}" value="{{ $user->name }}">
                </div>
            </div>
            <div class=" mb-3">
                <div class="form-group">
                    <strong>{{ trans('page_trans.email') }} :</strong>
                    <input type="email" name="email" class="form-control border boreder-1 mt-1" placeholder="{{ trans('page_trans.email') }}" value="{{ $user->email }}">
                </div>
            </div>
            <div class=" mb-3">
                <div class="form-group">
                    <strong>{{ trans('page_trans.password') }} :</strong>
                    <input type="password" name="password" class="form-control border boreder-1 mt-1" placeholder="{{ trans('page_trans.password') }}">
                </div>
            </div>
            <div class=" mb-3">
                <div class="form-group">
                    <strong>{{ trans('page_trans.confirm')}} {{ trans('page_trans.password') }}</strong>
                    <input type="password" name="confirm-password" class="form-control border boreder-1 mt-1" placeholder="{{ trans('page_trans.confirm')}} {{ trans('page_trans.password') }}">
                </div>
            </div>
            <div class=" mb-3">
                <div class="form-group">
                    <strong>{{ trans('main_trans.role') }}:</strong>
                    <select class="form-control multiple border boreder-1 mt-1" multiple name="roles[]">
                        @foreach ($roles as $role)
                            <option value="{{ $role }}">{{ $role }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class=" my-3 text-start">
                <button type="submit" class="btn btn-primary">{{ trans('page_trans.edit') }}</button>
                    <a class="btn btn-secondary" href="{{ route('users.index') }}">{{ trans('page_trans.back') }}</a>
            </div>
    </form>

@endsection
