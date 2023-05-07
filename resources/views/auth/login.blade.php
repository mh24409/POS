@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-svg d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card card-style">
                        <div class="d-flex justify-content-center">
                            <img src="{{ asset('dashboard_files/img/logo.png') }}"
                                style="width: 150px ; height: 150px;display: inline-block" alt="">
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-group row">

                                    <div class="col-md-12">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required placeholder="Enter Email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">

                                    <div class="col-md-12">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Enter Password" name="password" required
                                            autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="form-group">
                                    <div class="col-md-12 d-flex justify-content-center ">
                                        <button type="submit" class="btn btn-dark">
                                            {{ __('Login') }}
                                        </button>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 d-flex justify-content-center ">
                                        @if (Route::has('password.request'))
                                            <a style="color: black" class="btn btn-link"
                                                href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
