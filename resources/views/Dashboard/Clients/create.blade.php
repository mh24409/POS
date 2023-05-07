@extends('layouts.dashboard.app')

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
                <form action="{{ route('dashboard.clients.store') }}" method="POST">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">@lang('site.name')</label>
                            <input type="name" name="name" value="{{ old('name') }}" class="form-control" id="name"
                                placeholder="@lang('site.enter') @lang('site.name')">
                        </div>

                        <div class="form-group">
                            <label for="phone">@lang('site.phone')</label>
                            <input type="number" name="phone" value="{{ old('phone') }}" class="form-control" id="phone"
                                placeholder="@lang('site.enter') @lang('site.phone')">
                        </div>
                        <div class="form-group">
                            <label for="address">@lang('site.address')</label>
                            <input type="text" name="address" value="{{ old('address') }}" class="form-control"
                                id="address" placeholder="@lang('site.enter') @lang('site.address')">
                        </div>
                        <button type="submit" class="btn btn-primary"> <i class="fa fa-plus"></i> @lang('site.add')</button>
                </form>
            </div>
        </section>
    </div>
@endsection
