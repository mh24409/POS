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
                <form action="{{ route('dashboard.clients.update',$client->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">@lang('site.name')</label>
                            <input type="name" name="name" value="{{ $client->name }}" class="form-control" id="name">
                        </div>

                        <div class="form-group">
                            <label for="phone">@lang('site.phone')</label>
                            <input type="number" name="phone" value="{{ $client->phone }}" class="form-control" id="phone"
                                >
                        </div>
                        <div class="form-group">
                            <label for="address">@lang('site.address')</label>
                            <input type="text" name="address" value="{{ $client->address }}" class="form-control"
                                id="address">
                        </div>
                        <button type="submit" class="btn btn-primary"> <i class="fa fa-plus"></i> @lang('site.edit')</button>
                </form>
            </div>
        </section>
    </div>
@endsection
