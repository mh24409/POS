@extends('layouts.dashboard.app')

@section('content')
    <div class="content-wrapper">

        <section class="content-header ">
            <h1>
                @lang('site.categories')
            </h1>
            <ol class="breadcrumb  ">
                <li><a href="#">@lang('site.dashboard')</a></li>
                <li class="active"> @lang('site.categories')</li>
            </ol>

            <div class="row" style="padding-top: 20px">
                <form action="">
                    <div class="col-md-4"> <input type="text" name="search" placeholder="@lang('site.search')"
                            class="form-control"></div>

                    <div class="col-md-4">
                        <button class="btn btn-info btn-sm" type="submit">
                            <i class="fa fa-search"></i> @lang('site.search')</button>
                        @if (auth()->user()->hasPermission('categories_create'))
                            <a class="btn btn-info btn-sm" href="{{ route('dashboard.categories.create') }}">
                                <i class="fa fa-plus"></i> @lang('site.create')</a>
                        @else
                            <a class="btn btn-info btn-sm disabled" href="{{ route('dashboard.categories.create') }}">
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
                        <h3 class="box-title"> @lang('site.list') @lang('site.categories')</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>@lang('site.name')</th>
                                <th>@lang('site.products')</th>
                                <th>@lang('site.related_products')</th>
                                <th>@lang('site.action')</th>
                            </tr>
                            @foreach ($categories as $index => $category)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->products->count() }}</td>
                                    <td><a href="{{ route('dashboard.products.index', ['category_id' => $category->id]) }}"
                                            class="btn btn-info btn-sm">@lang('site.related_products')</a></td>

                                    <td>
                                        @if (auth()->user()->hasPermission('categories_delete'))
                                            <form style="display: inline-block"
                                                action="{{ route('dashboard.categories.destroy', $category->id) }}"
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
                                            <a href="{{ route('dashboard.categories.edit', $category->id) }}"
                                                class="btn btn-warning">@lang('site.update')</a>
                                        @else
                                            <a href="{{ route('dashboard.categories.edit', $category->id) }}"
                                                class="btn btn-warning disabled">@lang('site.update')</a>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                </div>
                <!-- /.box -->

            </div>
        </div>
    </div>
@endsection
