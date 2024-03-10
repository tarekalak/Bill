@extends('layouts.master')

@section('css')
    <!-- Add your CSS code here -->
@endsection

@section('title')
    {{ trans('page_trans.new_bill') }}
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">{{ trans('page_trans.new_bill') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                    <li class="breadcrumb-item active">{{ trans('page_trans.new_bill') }}</li>
                    <li class="breadcrumb-item"><a href="{{ route('bill.index') }}" class="default-color">{{ trans('page_trans.bills') }}</a></li>
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
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="container">

                        <form action="{{ route('bill.store') }}" method="POST">
                            @csrf
                            <div class="row">

                                {{-- Customer --}}
                                <div class="col">
                                    <label for="customer_id">{{ trans('page_trans.customers') }}</label>
                                    <select name="customer_id" id="customer_id" class="customers form-control">
                                        <option value=" ">{{ trans('page_trans.customers') }}</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Date --}}
                                <div class="col">
                                    <label for="date">{{ trans('page_trans.date') }}</label>
                                    <input type="datetime-local" class="form-control mb-3" id="date" name="date" value="{{ now()->format('Y-m-d\TH:i') }}" placeholder="{{ trans('page_trans.date') }}">
                                </div>
                            </div>

                            <div class="row mt-5">
                                {{-- Product select --}}
                                <div class="col-md-3 mb-3">
                                    <label for="product_id">{{ trans('page_trans.products') }}</label>
                                    <select required class="products form-control" name="product_id[]" id="product_0">
                                        <option>{{ trans('main_trans.product') }}</option>
                                        @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->product_name }} - {{ $product->product_company }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Product quantity --}}
                                <div class="col-md-3 mb-3">
                                    <label for="quantity">{{ trans('page_trans.quantity') }}</label>
                                    <input required oninput="calculateProduct()" type="number" name="quantity[]" class="form-control quantity" placeholder="{{ trans('page_trans.quantity') }}">
                                </div>

                                {{-- Product price --}}
                                <div class="col-md-3 mb-3">
                                    <label for="product_price">{{ trans('page_trans.price') }}</label>
                                    <input required oninput="calculateProduct()" type="number" name="product_price[]" class="form-control product_price" placeholder="{{ trans('page_trans.price') }}">
                                </div>

                                {{-- Total --}}
                                <div class="col-md-2 mb-3">
                                    <label for="total">{{ trans('page_trans.Total_amount') }}</label>
                                    <input readonly oninput="calculateProduct()" type="number" name="total[]" class="total form-control" placeholder="{{ trans('page_trans.Total_amount') }}">
                                </div>

                                {{-- Remove button --}}
                                <div class="col-md-1">
                                    <button class="btn btn-danger remove_item_btn mt-3  fa fa-minus"></button>
                                </div>
                            </div>

                            <div id="show_item"></div>

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <button class="btn btn-primary add_item_btn mt-3  fa fa-plus"></button>
                                </div>
                            </div>

                            <div class="m-5">
                                <hr>
                            </div>

                            <div class="row">
                                {{-- Price before --}}
                                <div class="col-3">
                                    <label for="price_before">{{ trans('page_trans.price_before') }}</label>
                                    <input type="number" class="form-control" readonly id="price_before">
                                </div>

                                <div class="col-1">
                                    <br><br>
                                    <i class="fa fa-arrow-right fa-lg"></i>
                                </div>

                                {{-- Discount --}}
                                <div class="col-3">
                                    <label for="discount">{{ trans('page_trans.discount') }}</label>
                                    <input oninput="discountFun()" type="number" class="form-control mb-3" id="discount" name="discount" placeholder="{{ trans('page_trans.discount') }}">
                                </div>

                                <div class="col-1">
                                    <br><br>
                                    <i class="fa fa-arrow-right fa-lg"></i>
                                </div>

                                {{-- Price after --}}
                                <div class="col-3">
                                    <label for="price_after">{{ trans('page_trans.price_after') }}</label>
                                    <input type="text" class="form-control" readonly id="price_after">
                                </div>
                            </div>

                            <input type="submit" value="{{ trans('page_trans.add') }}" class="btn btn-primary" id="add_btn">
                            <a href="{{ route('bill.index') }}" class="btn btn-secondary">{{ trans('page_trans.back') }}</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection

@section('js')
    <script>
        let i=0;
        $(document).ready(function() {
            var product='#product_'+i;
            $(product).select2();
            $('#customer_id').select2();
        });

        $(document).ready(function(){
            $(".add_item_btn").click(function(e){
                e.preventDefault();
                i++;
                $("#show_item").append(`
                    <div class="row mt-5">
                        <div class="col-md-3 mb-3">
                            <select required class="products form-control" id="product_`+i+`" name="product_id[]">
                                <option>{{ trans('main_trans.product') }}</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->product_name }} - {{ $product->product_company }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">

                            <input required oninput="calculateProduct()" type="number" name="quantity[]" class="form-control quantity" placeholder="{{ trans('page_trans.quantity') }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <input required oninput="calculateProduct()" type="number" name="product_price[]" class="form-control product_price" placeholder="{{ trans('page_trans.price') }}">
                        </div>
                        <div class="col-md-2 mb-3">
                            <input readonly oninput="calculateProduct()" type="number" id="total" class="total form-control" placeholder="{{ trans('page_trans.Total_amount') }}">
                        </div>
                        <div class="col-md-1">
                            <button class="btn btn-danger remove_item_btn fa fa-minus"></button>
                        </div>
                    </div>
                `);
                var product='#product_'+i;
                $(product).select2();

                calculateProduct();
            });
        });

        $(document).on('click','.remove_item_btn',function(e){
            e.preventDefault();
            let row_item = $(this).parent().parent();
            $(row_item).remove();
            calculateProduct();
        });


        function discountFun(){
            var discount=document.getElementById('discount').value;
            price_before=document.getElementById('price_before').value;
            document.getElementById('price_after').value=(price_before - price_before*discount/100);
        }

        function calculateProduct() {
            var products = document.querySelectorAll('.products');
            var quantity = document.querySelectorAll('.quantity');
            var total = document.querySelectorAll('.total');
            var product_price = document.querySelectorAll('.product_price');
            var totalProduct = 0;

            products.forEach(function(product, index) {
                var productValue = product.value;

                var quantity_num = parseFloat(quantity[index].value);
                var product_price_num = parseFloat(product_price[index].value);
                total[index].value = quantity_num * product_price_num;

                if (!isNaN(quantity_num) && !isNaN(product_price_num)) {
                    totalProduct += (quantity_num * product_price_num);
                    document.getElementById("price_before").value = totalProduct;
                    discountFun();
                }
            });
        }

        $(document).on('change', '.products', function() {
            var productId = $(this).val();
            var productPriceInput = $(this).parent().next().next().find('.product_price');

            $.ajax({
                url: '{{ URL::to("bill/getprice") }}/' + productId,
                method: 'GET',
                dataType: 'json',
                data: {productId: productId},
                success: function(response) {
                    productPriceInput.val(response);
                    calculateProduct();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    </script>
@endsection
