<div id="print-area">
    <table class="table table-bordered">
        <tr>
            <th>@lang('site.name')</th>
            <th>@lang('site.quantity')</th>
            <th>@lang('site.price')</th>
        </tr>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->pivot->quantity }}</td>
                <td>{{ $product->pivot->quantity * $product->sale_price }}</td>
            </tr>
        @endforeach

    </table>

    <div>
        <h3>@lang('site.total') {{ $order->total_price }}</h3>
    </div>



</div>
<button id="add-order-form-btn" style="width: 100%" class="btn print-btn btn-success">@lang('site.print')<i
        class="fa fa-plus"></i>
</button>
