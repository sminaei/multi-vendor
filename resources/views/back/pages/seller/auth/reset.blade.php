@extends('back.layout.auth-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Reset Password')
@section('content')
    <div class="login-box bg-white box-shadow border-radius-10">
        <div class="login-title">
            <h2 class="text-center text-primary">Reset Password</h2>
        </div>
        <h6 class="mb-20">Enter your new password, confirm and submit</h6>
        <form action="{{ route('seller.reset-password-handler') }}" method="post">
            @csrf
            <input type="hidden" name="token" value="{{ request()->token }}">
            <div class="input-group custom">
                <input
                    type="password"
                    name="new_password"
                    value="{{ old('new_password') }}"
                    class="form-control form-control-lg"
                    placeholder="New Password"
                />
                <div class="input-group-append custom">
										<span class="input-group-text"
                                        ><i class="dw dw-padlock1"></i
                                            ></span>
                </div>
            </div>
            @error('new_password')
            <span class="text-danger">
                {{ $message }}
            </span>
            @enderror
            <div class="input-group custom">
                <input
                    type="password"
                    name="confirm_new_password"
                    value="{{ old('confirm_new_password') }}"
                    class="form-control form-control-lg"
                    placeholder="Confirm New Password"
                />

                <div class="input-group-append custom">
										<span class="input-group-text"
                                        ><i class="dw dw-padlock1"></i
                                            ></span>
                </div>
            </div>
            @error('confirm_new_password')
            <span class="text-danger">
                {{ $message }}
            </span>
            @enderror
            <div class="row align-items-center">
                <div class="col-5">
                    <div class="input-group mb-0">
                        <a
                            class="btn btn-primary btn-lg btn-block"
                            href="index.html"
                        >Submit</a
                        >
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

