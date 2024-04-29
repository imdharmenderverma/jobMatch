@extends('layouts.master')

@section('content')
<style type="text/css">
    body {
        font-family: 'Open Sans', sans-serif;
    }

    .btn-primary {
        height: 60px !important;
        font-size: 16px;
        font-weight:900 !important;
    }
    .btn-primary:hover {
    background: #44AAAE !important;
    color: #fff !important;
    border: 1px solid #44AAAE !important;
}

    @media (max-width:600px) {
        .mobileFlex {
            display: flex !important;
            flex-direction: column-reverse;
        }
    }

</style>
<div class="container-fluid landing wrapper align-items-center d-flex justify-content-center">
    <div class="row align-items-center d-flex justify-content-center mobileFlex" style="padding-top: 7%;">
        <div class="col-md-2"></div>
        <div class="col-md-4 mb-4">
            <form method="POST" id="form-login" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" autofocus autocomplete="email" placeholder="User" required data-parsley-required-message="{{ __('messages.custom.email_messages') }}" data-parsley-pattern="/^[^\s@]+@[^\s@]+\.[^\s@]+|[0-9]{10,14}$/" data-parsley-pattern-message="{{ __('messages.custom.email_type_messages') }}"
                    data-parsley-type="email" data-parsley-type-message="{{ __('messages.custom.email_type_messages') }}" data-parsley-errors-container="#email_error" />
                    <span id='email_error' style="color:red"></span>
                </div>
                <div class="form-group">
                    <div class="position-relative">
                        <x-input id="password" class="form-control toggle-password" type="password" name="password" autocomplete="current-password" data-toggle="password" placeholder="Password" required data-parsley-required-message="{{ __('messages.custom.password_required_messages') }}" data-parsley-trigger="keyup" name="password" autocomplete="current-password" data-parsley-errors-container="#password_error" />
                        <div class="cus-innertoggle-eye">
                            <img src="{{ asset('assets/img/eye.png') }}" alt="" class="eye-btn eye-show" id="eye-btn">
                            <img src="{{ asset('assets/img/slash-eye.png') }}" alt="" class=" eye-btn slash-eye-show" id="eye-btn">
                        </div>
                    </div>
                    <span id='password_error' style="color:red"></span>
                </div>
                <div class="forgotpwd form-group"><a href="{{ route('password.request') }}">Forgot Password?</a></div>
                <div class="form-group">
                    <button type="submit" id="myButton" class="btn btn-primary btn-block ">Login</button>
                </div>

            </form>
        </div>
        <div class="col-md-4 mb-4 text-left">
            <div class="landingLogo"><img src="{{ asset('assets/img/logo.png') }}" width="80%"></div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
@endsection
@section('page-js')
<script>
    var loginURL = `{{ route('login') }}`;
</script>
<script src="{{ asset('assets/js/admin/business/login.js') }}"></script>
@endsection
