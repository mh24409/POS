@extends('layouts.dashboard.app')

@section('content')
    <div class="content-wrapper">

        <section class="content-header ">
            <h1>
                @lang('site.users')
            </h1>
            <ol class="breadcrumb  ">
                <li><a href="{{ route('dashboard.index') }}">@lang('site.dashboard')</a></li>
                <li> <a href="{{ route('dashboard.users.index') }}">@lang('site.users')</a> </li>
                <li class="active"> @lang('site.create') @lang('site.user')</li>

            </ol>


            <div class="row" style="padding: 0px 10px 0px 10px">
                @include('partials._errors')
                <form action="{{ route('dashboard.users.store') }}" method="POST">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">@lang('site.name')</label>
                            <input type="name" name="name" value="{{ old('name') }}" class="form-control" id="name"
                                placeholder="@lang('site.enter') @lang('site.name')">
                        </div>
                        <div class="form-group">
                            <label for="email">@lang('site.email')</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email"
                                placeholder="@lang('site.enter') @lang('site.email')">
                        </div>
                        <div class="form-group">
                            <label for="password">@lang('site.password')</label>
                            <input type="password" name="password" value="{{ old('password') }}" class="form-control"
                                id="password" placeholder="@lang('site.enter') @lang('site.password')">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">@lang('site.password_confirmation')</label>
                            <input type="password" class="form-control" name="password_confirmation"
                                id="password_confirmation" value="{{ old('password_confirmation') }}"
                                placeholder="@lang('site.enter') @lang('site.password_confirmation')">
                        </div>

                        <?php
                        
                        $models = ['users', 'categories', 'products','orders'];
                        $cruds = ['create', 'read', 'update', 'delete'];
                        
                        ?>
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                @foreach ($models as $index => $model)
                                    <li class=" {{ $index == 0 ? 'active' : '' }}"><a href="#{{ $model }}"
                                            data-toggle="tab">@lang('site.'.$model)</a></li>

                                @endforeach
                            </ul>
                            <div class="tab-content">
                                @foreach ($models as $index => $model)

                                    <div class="tab-pane {{ $index == 0 ? 'active' : '' }}" id="{{ $model }}">
                                        @foreach ($cruds as $crud)
                                            <label style="padding: 10px">
                                                @lang('site.'.$crud)
                                                <input type="checkbox" name="permission[]"
                                                    value="{{ $model . '_' . $crud }}" class="pull-right">
                                            </label>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary"> <i class="fa fa-plus"></i> @lang('site.add')</button>
                </form>
            </div>
        </section>
    </div>
@endsection
