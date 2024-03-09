@extends('layouts.master')

@section('title')
{{ trans('main_trans.users') }}
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-4">
        <div >
            <h2>{{ trans('main_trans.users') }}
        <div class="float-end">
            <a class="btn btn-outline-primary mt-3" href="{{ route('users.create') }}"> {{ trans('page_trans.add') }} {{ trans('main_trans.user') }}</a>
        </div>
            </h2>
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success my-2">
  <p>{{ $message }}</p>
</div>
@endif


<table class="table table-bordered table-hover table-striped">
 <tr>
   <th>{{ trans('page_Trans.name') }}</th>
   <th>{{ trans('page_trans.email') }}</th>
   <th>{{ trans('main_trans.role') }}</th>
   <th width="280px"></th>
 </tr>
 @foreach ($data as $key => $user)
  <tr>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>
      @if(!empty($user->getRoleNames()))
        @foreach($user->getRoleNames() as $v)
           <label class="badge badge-secondary text-dark">{{ $v }}</label>
        @endforeach
      @endif
    </td>
    <td>
        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
            <a class="btn btn-outline-info" href="{{ route('users.show', $user->id) }}"><i class="fa fa-plus"></i></a>
            @can('user-edit')
            <a class="btn btn-outline-success" href="{{ route('users.edit', $user->id) }}"><i class="fa fa-pencil"></i></a>
            @endcan


            @csrf
            @method('DELETE')
            @can('user-delete')
                <button type="submit" class="btn btn-outline-danger"><i class="fa fa-trash"></i></button>
            @endcan
        </form>
    </td>
  </tr>
 @endforeach
</table>
@endsection
