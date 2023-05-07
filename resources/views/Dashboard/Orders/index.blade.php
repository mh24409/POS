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
                <li class="active"> @lang('site.create') @lang('site.orders')</li>

            </ol>


            <div class="row" style="padding: 0px 10px 0px 10px">
                @include('partials._errors')
                <div class="col-md-8">

                    <div class="box-body card-top-border-padding">
                        <form action="">
                            <div class="col-md-6"> <input type="text" name="search" placeholder="@lang('site.search')"
                                    class="form-control"></div>

                            <div class="col-md-4">
                                <button class="btn btn-info btn-sm" type="submit">
                                    <i class="fa fa-search"></i> @lang('site.search')</button>

                            </div>
                        </form>
                        <table class="table table-bordered">
                            <tr>
                                <th>@lang('site.name')</th>
                                <th>@lang('site.price')</th>
                                <th>@lang('site.date')</th>
                                <th>@lang('site.action')</th>
                            </tr>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->client->name }}</td>
                                    <td>{{ number_format($order->total_price, 2) }}</td>
                                    <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                    <td> <a href="{{ route('dashboard.client.order.edit', ['client' => $order->client->id, 'order' => $order->id]) }}"
                                            class="btn btn-info btn-sm">@lang('site.edit') </a>
                                        <button data-method="get"
                                            data-url="{{ route('dashboard.orders.products', $order) }}"
                                            class="btn btn-info btn-sm order-products">@lang('site.show') </button>
                                        <form style="display: inline-block"
                                            action="{{ route('dashboard.orders.destroy', $order) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                @lang('site.delete')</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        </table>
                    </div>

                </div>
                <div class="col-md-4">

                    <div class="box-body card-top-border-padding">
                        <h3> @lang('site.reset') </h3>
                        <div id="order-product-list">

                        </div>

                    </div>
                </div>


        </section>
    </div>
@endsection
 