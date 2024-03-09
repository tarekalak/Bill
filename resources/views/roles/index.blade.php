@extends('layouts.master')
@section('title')
{{ trans('main_trans.role') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div>
                <h2>{{ trans('main_trans.role') }}
                    <div class="float-end mt">
                        @can('role-create')
                            <a class="btn mt-2 btn-primary " href="{{ route('role.create') }}">{{trans('page_trans.add')}} {{trans('main_trans.role')}}</a>
                        @endcan
                    </div>
                </h2>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-striped table-hover">
        <tr>
            <th>{{trans('page_trans.name')}}</th>
            <th width="280px"></th>
        </tr>
        @foreach ($roles as $key => $role)
            <tr>
                <td>{{ $role->name }}</td>
                <td>
                    <form action="{{ route('role.destroy', $role->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('role.show', $role->id) }}"><i class="fa fa-plus"></i></a>
                        @can('role-edit')
                            <a class="btn btn-success" href="{{ route('role.edit', $role->id) }}"><i class="fa fa-pencil"></i></a>
                        @endcan


                        @csrf
                        @method('DELETE')
                        @can('role-delete')
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        @endcan
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $roles->render() !!}
@endsection
