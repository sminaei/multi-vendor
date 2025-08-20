@extends('back.layout.auth-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page title here')
@section('content')
    <div class="login-box bg-white box-shadow border-radius-10">
        <div class="login-title">
            <h2 class="text-center text-primary">Seller Login</h2>
        </div>
        <form action="{{route('seller.login-handler')}}" method="post">
            @csrf
            <x-alert.form-alert/>
            @if(\Illuminate\Support\Facades\Session::get('fail'))
                <div class="alert alert-danger">
                    {{ \Illuminate\Support\Facades\Session::get('fail')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if(\Illuminate\Support\Facades\Session::get('success'))
                <div class="alert alert-success">
                    {{ \Illuminate\Support\Facades\Session::get('success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if(Session::get('info'))
                <div class="alert alert-info">
                    {{ \Illuminate\Support\Facades\Session::get('info')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="input-group custom">
                <input
                    type="text"
                    class="form-control form-control-lg"
                    placeholder="Email/Username"
                    name="login_id"
                    value="{{old('login_id')}}"
                />
                <div class="input-group-append custom">
                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                </div>
            </div>
            @error('error_id')
            <div class="d-block text-danger" style="margin-top: -25px;margin-bottom: 15px">
                {{ $message}}
            </div>
            @enderror()
            <div class="input-group custom">
                <input
                    type="password"
                    class="form-control form-control-lg"
                    placeholder="**********"
                    name="password"
                />
                <div class="input-group-append custom">
                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                </div>
            </div>
            @error('error_id')
            <div class="d-block text-danger" style="margin-top: -25px;margin-bottom: 15px">
                {{ $message}}
            </div>
            @enderror()
            <div class="row pb-30">
                <div class="col-6">
                    <div class="custom-control custom-checkbox">
                        <input
                            type="checkbox"
                            class="custom-control-input"
                            id="customCheck1"
                        />
                        <label class="custom-control-label" for="customCheck1">Remember</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="forgot-password">
                        <a href="{{ route('admin.forgot-password') }}">Forgot Password</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="input-group mb-0">
                        <input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">

                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

