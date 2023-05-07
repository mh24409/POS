@extends('layouts.dashboard.app')

<style>
    .card-top-border-padding {
        padding: 10px;
        border-top: blue solid 2px;
        background-color: white;
    }

</style>
@section('content')
    <div class="content-wrapper">

        <section class="content-header ">
            <h1>
                @lang('site.clients')
            </h1>
            <ol class="breadcrumb  ">
                <li><a href="{{ route('dashboard.index') }}">@lang('site.dashboard')</a></li>
                <li> <a href="{{ route('dashboard.clients.index') }}">@lang('site.clients')</a> </li>
                <li class="active"> @lang('site.create') @lang('site.cleint')</li>

            </ol>


            <div class="row" style="padding: 0px 10px 0px 10px">
                @include('partials._errors')
                <div class="col-md-6">

                    <div class="box-body card-top-border-padding">
                        <label> @lang('site.categories')</label>
                        @foreach ($categories as $category)
                            <div class="panel panel-info">
                                <div class="panel-heading ">

                                    <a class=" d-block h-100 w-100" data-toggle="collapse"
                                        href="{{ '#cat' . $category->id }}">
                                        {{ $category->name }}
                                    </a>

                                </div>
                                <div id="{{ 'cat' . $category->id }}" class="collapse " data-parent="#accordion">

                                    {{-- @if ($product->stock <= 0)
                                        @else --}}
                                    <div class="card-body">
                                        <table class="table">
                                            <tr>
                                                <th>@lang('site.name')</th>
                                                <th>@lang('site.stock')</th>
                                                <th>@lang('site.price')</th>
                                                <th>@lang('site.add')</th>
                                            </tr>
                                            @foreach ($category->products as $product)
                                                @foreach ($order->products as $orderProduct)
                                                    <tr>
                                                        <td>{{ $product->name }} </td>
                                                        <td class="stock-{{ $product->id }}"
                                                            data-stock="{{ $product->stock }}">
                                                            {{ $product->stock }} </td>
                                                        <td>{{ $product->sale_price }} </td>
                                                        @if ($orderProduct->id == $product->id or $product->stock == 0)
                                                            <td> <button id="{{ 'product-' . $product->id }}"
                                                                    data-name="{{ $product->name }}"
                                                                    data-id="{{ $product->id }}"
                                                                    data-stock="{{ $product->stock + $orderProduct->pivot->quantity }}"
                                                                    data-price="{{ $product->sale_price }}"
                                                                    class="btn btn-default hidden add-product-btn">
                                                                    <i class="fa fa-plus"></i></button>
                                                            </td>
                                                        @else
                                                            <td> <button id="{{ 'product-' . $product->id }}"
                                                                    data-name="{{ $product->name }}"
                                                                    data-id="{{ $product->id }}"
                                                                    data-stock="{{ $product->stock }}"
                                                                    data-price="{{ $product->sale_price }}"
                                                                    class="btn btn-success add-product-btn">
                                                                    <i class="fa fa-plus"></i></button>
                                                            </td>
                                                        @endif

                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        </table>
                                    </div>
                                    {{-- @endif --}}

                                </div>
                            </div>
                        @endforeach

                    </div>

                </div>
                <div class="col-md-6">
                    <form
                        action="{{ route('dashboard.client.order.update', ['client' => $order->client->id, 'order' => $order->id]) }}"
                        method="post">
                        @csrf
                        @method('PUT')
                        <div class="box-body card-top-border-padding">
                            <table class="table">
                                <tr>
                                    <th>@lang('site.product')</th>
                                    <th>@lang('site.quantity')</th>
                                    <th>@lang('site.price')</th>
                                    <th>@lang('site.delete')</th>
                                </tr>
                                <tbody class="order-list">
                                    @foreach ($order->products as $product)
                                        @foreach ($category->products as $mainProduct)
                                            @if ($mainProduct->id == $product->id)
                                                <tr>
                                                    <td>{{ $product->name }}</td>
                                                    <td><input type="number"
                                                            name="products[{{ $product->id }}][quantity]"
                                                            data-price="{{ $product->price }}"
                                                            class="form-control input-sm product-quantity"
                                                            id="product-quantity-{{ $product->id }}" min="1"
                                                            max="<?php
                                                            if ($mainProduct->id == $product->id) {
                                                                $newstock = $mainProduct->stock + $product->pivot->quantity;
                                                                echo $newstock;
                                                            }
                                                            ?>"
                                                            value="{{ $product->pivot->quantity }}">
                                                    </td>

                                                    <td><input type="double" class="form-control input-sm product-price1"
                                                            min="0"
                                                            value={{ $product->sale_price * $product->pivot->quantity }}>
                                                    </td>
                                                    <td class="product-price" hidden>{{ $product->sale_price }}</td>
                                                    <td><button class="btn btn-danger btn-sm remove-product-btn"
                                                            data-id="{{ $product->id }}"><span
                                                                class="fa fa-trash"></span></button></td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>

                            <div>
                                <label> @lang('site.total')</label>
                                <span class="total-price">{{ $order->total_price }}</span>
                            </div>
                            <div> <button type="submit" style="width: 100%"
                                    class="btn btn-success">@lang('site.create_order') <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>


        </section>
    </div>
@endsection
