@extends('layouts.dashboard.app')

@section('content')
    <div class="content-wrapper">

        <section class="content-header ">
            <h1>
                @lang('site.products')
            </h1>
            <ol class="breadcrumb  ">
                <li><a href="{{ route('dashboard.index') }}">@lang('site.dashboard')</a></li>
                <li> <a href="{{ route('dashboard.products.index') }}">@lang('site.products')</a> </li>
                <li class="active"> @lang('site.create') @lang('site.product')</li>

            </ol>


            <div class="row" style="padding: 0px 10px 0px 10px">
                @include('partials._errors')
                <form action="{{ route('dashboard.products.store') }}" method="POST">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="category">@lang('site.categories')</label>
                            <select name="category_id" class="form-control">
                                <option>@lang('site.categories')</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}> {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @foreach (config('translatable.locales') as $locale)
                            <div class="form-group">
                                <label for="name">@lang('site.'.$locale.'.name')</label>
                                <input type="name" name="{{ $locale }}[name]" value="{{ old($locale . '.name') }}"
                                    class="form-control" id="name"
                                    placeholder="@lang('site.enter') @lang('site.'.$locale.'.name')">
                            </div>
                            <div class="form-group">
                                <label for="description">@lang('site.'.$locale.'.description')</label>
                                <textarea type="description" name="{{ $locale }}[description]"
                                    class="form-control ckeditor"
                                    id="description">{{ old($locale . '.description') }}</textarea>
                            </div>
                        @endforeach
                        <div class="form-group">
                            <label for="purchase_price">@lang('site.purchase_price')</label>
                            <input type="number" step="0.01" name="purchase_price" value="{{ old('purchase_price') }}"
                                class="form-control" id="purchase_price"
                                placeholder="@lang('site.enter') @lang('site.purchase_price')">
                        </div>
                        <div class="form-group">
                            <label for="sale_price">@lang('site.sale_price')</label>
                            <input type="number" step="0.01" name="sale_price" value="{{ old('sale_price') }}" class="form-control"
                                id="sale_price" placeholder="@lang('site.enter') @lang('site.sale_price')">
                        </div>
                        <div class="form-group">
                            <label for="stock">@lang('site.stock')</label>
                            <input type="number" name="stock" value="{{ old('stock') }}" class="form-control" id="stock"
                                placeholder="@lang('site.enter') @lang('site.stock')">
                        </div>



                        <button type="submit" class="btn btn-primary"> <i class="fa fa-plus"></i> @lang('site.add')</button>
                </form>
            </div>
        </section>
    </div>
@endsection
