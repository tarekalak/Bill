<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu title -->


                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{ trans('main_trans.bills') }}</li>

                    <!-- Home Page -->
                    <li>
                        <a href="{{ route('dashboard') }}"><i class="fa fa-home"></i><span class="right-nav-text"> {{ trans('main_trans.dashbord') }}</span> </a>
                    </li>
                    <!--customer-->
                    @can('customers')

                    <li>
                        <a href="{{ route('customer.index') }}"><i class="fa fa-user"></i><span class="right-nav-text">{{ trans('main_trans.customers') }}</span> </a>
                    </li>
                    @endcan
                    <!-- product -->

                    @can('products')
                    <li>
                        <a href="{{ route("product.index") }}"><i class="fa fa-shopping-bag"></i><span class="right-nav-text">{{ trans('main_trans.product') }}</span></a>
                    </li>

                    @endcan

                    {{-- bill --}}

                    @can('bills')
                    <li>
                        <a href="{{ route('bill.index') }}"><i class="fa fa-file"></i></i><span class="right--text">{{ trans('main_trans.bills') }}</span></a>
                    </li>


                    @endcan


                     @canany(['users', 'roles', 'company'])
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#calendar-menu">
                            <div class="pull-left"><i class="fa fa-gear"></i><span
                                class="right-nav-text">{{ trans('main_trans.setting') }}</span></div>
                                <div class="pull-right"><i class="ti-plus"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="calendar-menu" class="collapse" data-parent="#sidebarnav">
                                @can('users')

                                <li> <a href="{{ route("users.index") }}">{{ trans('main_trans.users') }}</a> </li>
                                @endcan

                                @can('roles')
                                <li> <a href="{{ route("role.index") }}">{{ trans('main_trans.role') }}</a> </li>
                                @endcan

                                @can('company')
                                <li> <a href="{{ route("company.edit",1) }}">{{ trans('main_trans.company') }}</a> </li>
                                @endcan
                            </ul>
                        </li>
                        @endcanany

                    {{-- Add new user --}}

                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
