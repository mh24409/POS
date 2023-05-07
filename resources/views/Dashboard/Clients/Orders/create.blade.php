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
                                    @foreach ($category->products as $product)
                                        @if ($product->stock <= 0)

                                        @else
                                            <div class="card-body">
                                                <table class="table">
                                                    <tr>
                                                        <th>@lang('site.name')</th>
                                                        <th>@lang('site.stock')</th>
                                                        <th>@lang('site.price')</th>
                                                        <th>@lang('site.add')</th>
                                                    </tr>
                                                    <td>{{ $product->name }} </td>
                                                    <td>{{ $product->stock }} </td>
                                                    <td>{{ $product->sale_price }} </td>
                                                    <td> <button id="{{ 'product-' . $product->id }}"
                                                            data-name="{{ $product->name }}"
                                                            data-stock="{{ $product->stock }}"
                                                            data-id="{{ $product->id }}"
                                                            data-price="{{ $product->sale_price }}"
                                                            class="btn btn-success add-product-btn"> <i
                                                                class="fa fa-plus"></i></button>
                                                    </td>
                                                </table>
                                            </div>
                                        @endif

                                    @endforeach
                                </div>
                            </div>
                        @endforeach

                    </div>

                </div>
                <div class="col-md-6">
                    <form action="{{ route('dashboard.client.order.store', $client->id) }}" method="POST">
                        @csrf
                        <div class="box-body card-top-border-padding">
                            <table class="table">
                                <tr>
                                    <th>@lang('site.product')</th>
                                    <th>@lang('site.quantity')</th>
                                    <th>@lang('site.price')</th>
                                    <th>@lang('site.delete')</th>
                                </tr>
                                <tbody class="order-list">

                                </tbody>
                            </table>
                            <div>
                                <label> @lang('site.total')</label>
                                <span class="total-price">00.00</span>
                            </div>
                            <div> <button id="add-order-form-btn" style="width: 100%"
                                    class="btn btn-success">@lang('site.create_order') <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="box-body card-top-border-padding">
                        <div class="panel panel-info">
                            @foreach ($orders as $order)
                                <div class="panel-heading ">
                                    <a class=" d-block h-100 w-100" data-toggle="collapse"
                                        href="{{ '#order' . $order->id }}">
                                        {{ $order->created_at }}
                                    </a>
                                </div>
                                <div id="{{ 'order' . $order->id }}" class="collapse " data-parent="#accordion">
                                    @foreach ($order->products as $product)
                                        <div class="card-body">
                                            <table class="table">
                                                <tr>
                                                    <th>@lang('site.name')</th>
                                                    <th>@lang('site.price')</th>
                                                </tr>
                                                <td>{{ $product->name }} </td>
                                                <td>{{ $product->sale_price }} </td>
                                            </table>
                                        </div>
                                    @endforeach
                                    <div style="padding: 15px"> <label for="">@lang('site.total') : </label>
                                        {{ $order->total_price }} </div>

                                </div>
                            @endforeach


                        </div>
                    </div>
                </div>



        </section>
    </div>
@endsection
