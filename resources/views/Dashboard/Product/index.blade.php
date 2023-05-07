@extends('layouts.dashboard.app')

@section('content')
    <div class="content-wrapper">

        <section class="content-header ">
            <h1>
                @lang('site.products')
            </h1>
            <ol class="breadcrumb  ">
                <li><a href="#">@lang('site.dashboard')</a></li>
                <li class="active"> @lang('site.products')</li>
            </ol>

            <form action="" id="filterForm" method="post">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="col-md-4"> <input type="text" name="name" id="name" placeholder="@lang('site.name')"
                        class="form-control"></div>
                <div class="col-md-4"> <input type="text" name="desc" id="desc" placeholder="@lang('site.description')"
                        class="form-control"></div>
                <div class="col-md-4">
                    <select class="form-control" id="category" name="category_id">
                        <option value="">@lang('site.categories')</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}> {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button id="filtebtn">submit</button>
            </form>

            <div class="row" style="padding-top: 20px">
                <form action="" method="GET">
                    <div class="col-md-4"> <input type="text" name="search" placeholder="@lang('site.search')"
                            class="form-control"></div>
                    <div class="col-md-4">
                        <select class="form-control" name="category_id">
                            <option value="">@lang('site.categories')</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}> {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <button id="" class="btn btn-info btn-sm filter-btn" type="submit">
                            <i class="fa fa-search"></i> @lang('site.search')</button>
                        @if (auth()->user()->hasPermission('products_create'))
                            <a class="btn btn-info btn-sm" href="{{ route('dashboard.products.create') }}">
                                <i class="fa fa-plus"></i> @lang('site.create')</a>
                        @else
                            <a class="btn btn-info btn-sm disabled" href="{{ route('dashboard.products.create') }}">
                                <i class="fa fa-plus"></i> @lang('site.create')</a>
                        @endif
                    </div>
                </form>
            </div>
        </section>
        <div class="row " style="padding-top: 10px">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"> @lang('site.list') @lang('site.products')</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>@lang('site.name')</th>
                                <th>@lang('site.description')</th>
                                <th>@lang('site.purchase_price')</th>
                                <th>@lang('site.sale_price')</th>
                                <th>@lang('site.profit_percent')%</th>
                                <th>@lang('site.stock')</th>
                                <th>@lang('site.action')</th>
                            </tr>

                            <tbody class="filter-data">
                                @foreach ($products as $index => $products)

                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $products->name }}</td>
                                        <td>{!! $products->description !!}</td>
                                        <td>{{ $products->purchase_price }}</td>
                                        <td>{{ $products->sale_price }}</td>
                                        <td>{{ $products->profit_percent }} %</td>
                                        <td>{{ $products->stock }}</td>
                                        <td>
                                            @if (auth()->user()->hasPermission('categories_delete'))
                                                <form style="display: inline-block"
                                                    action="{{ route('dashboard.products.destroy', $products->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button type="submit"
                                                        class="btn delete btn-danger">@lang('site.delete')</button>
                                                </form>
                                            @else
                                                <button type="submit"
                                                    class="btn btn-danger disabled">@lang('site.delete')</button>

                                            @endif
                                            @if (auth()->user()->hasPermission('categories_update'))
                                                <a href="{{ route('dashboard.products.edit', $products->id) }}"
                                                    class="btn btn-warning">@lang('site.update')</a>
                                            @else
                                                <a href="{{ route('dashboard.products.edit', $products->id) }}"
                                                    class="btn btn-warning disabled">@lang('site.update')</a>
                                            @endif

                                        </td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.box -->

            </div>
        </div>
    </div>
@endsection
