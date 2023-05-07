@extends('layouts.dashboard.app')

@section('content')
    <div class="content-wrapper">

        <section class="content-header ">
            <h1>
                @lang('site.categories')
            </h1>
            <ol class="breadcrumb  ">
                <li><a href="{{ route('dashboard.index') }}">@lang('site.dashboard')</a></li>
                <li> <a href="{{ route('dashboard.categories.index') }}">@lang('site.categories')</a> </li>
                <li class="active"> @lang('site.create') @lang('site.category')</li>

            </ol>


            <div class="row" style="padding: 0px 10px 0px 10px">
                @include('partials._errors')
                <form action="{{ route('dashboard.categories.store') }}" method="POST">
                    @csrf
                    <div class="box-body">
                        @foreach (config('translatable.locales') as $locale)
                            <div class="form-group">
                                <label for="name">@lang('site.'.$locale.'.name')</label>
                                <input type="name" name="{{$locale}}[name]" value="{{ old($locale . '.name') }}"
                                    class="form-control" id="name"
                                    placeholder="@lang('site.enter') @lang('site.'.$locale.'.name')">
                            </div>
                        @endforeach



                        <button type="submit" class="btn btn-primary"> <i class="fa fa-plus"></i> @lang('site.add')</button>
                </form>
            </div>
        </section>
    </div>
@endsection
