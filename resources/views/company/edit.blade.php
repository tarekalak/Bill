@extends('layouts.master')
@section('css')

@section('title')
    {{ trans('page_trans.company_info') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('page_trans.company_info') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item active">{{ trans('page_trans.company_info') }}</li>
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
    <div class="col-md-12 mb-30">
        @if ($message = Session::get('success'))
            <div class="alert alert-success my-2">
                <p>{{ $message }}</p>
            </div>
@endif
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
        <div class="card card-statistics h-100">
            <div class="card-body">

                <form action="{{ route('company.update',1)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
               <div class="row mb-5">
                   <div class="col-6">
                       <div class="form-group">
                        {{-- name --}}
                        <div class="mt-4 row">
                            <div class="col-6">
                                <label for="">{{ trans('page_trans.name_in_ar') }}</label>
                                <input name="name_ar" type="text" class="form-control border border-1" value="{{ $company->name_ar }}">
                            </div>
                            <div class="col-6">
                                <label for="">{{ trans('page_trans.name_in_en') }}</label>
                                <input name="name_en" type="text" class="form-control border border-1" value="{{ $company->name_en }}">
                            </div>
                        </div>
                        {{-- phone --}}
                        <div class="mt-4">
                            <label for="">{{ trans('page_trans.phone') }}</label>
                            <input name="phone" type="text" class="form-control border border-1" value="{{ $company->phone }}">
                        </div>
                        {{-- email --}}
                        <div class="mt-4">
                            <label for="">{{ trans('page_trans.email') }}</label>
                            <input name="email" type="text" class="form-control border border-1" value="{{ $company->email }}">
                        </div>
                        {{-- location --}}
                        <div class="mt-4">
                            <div class="row">
                                <div class="col-6">
                                    <label for="">{{ trans('page_trans.location_in_ar') }}</label>
                                    <input name="location_ar" type="text" class="form-control border border-1" value="{{ $company->location_ar }}">
                                </div>

                                <div class="col-6">
                                    <label for="">{{ trans('page_trans.location_in_en') }}</label>
                                    <input name="location_en" type="text" class="form-control border border-1" value="{{ $company->location_en }}">
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class=" w-100 h-100 d-flex float-center justify-content-center">
                            {{-- @if (has($company->image))
                                <img src="{{ asset('companyImage'+$company->image) }}" alt="">
                            @else

                            @endif --}}
                            <div class="align-self-center ">
                                <img class="w-50 " id="showLogo" src="{{ asset('company/'.$company->logo) }}" alt="">
                            </div>
                        </div>
                        <div class="m-3">
                            <input type="file" name="logo" id="logo">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">{{ trans('page_trans.edit') }}</button>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">{{ trans('page_trans.back') }}</a>
            </form>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
<script>
function previewImage(input) {
    var preview = document.getElementById('showLogo');
    console.log(preview);
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            preview.style.display = 'block';
            preview.setAttribute('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.style.display = null;
        preview.setAttribute('src', '#');
    }
}

// Event listener to call the previewImage function when the file input changes
document.getElementById('logo').addEventListener('change', function() {
    previewImage(this);
});
</script>
@endsection
