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
        <div class="row align-items-center d-flex justify-content-center mobileFlex" style="padding-top:7%;">
            <div class="col-md-2"></div>
            <div class="col-md-4 formWrapper mb-4" style="padding: 20px 20px;">
                <form method="POST" id="forgot-form" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-group">
                        <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" autofocus autocomplete="off" placeholder="Email" required data-parsley-type="email" data-parsley-required-message="{{ __('messages.custom.email_messages') }}" data-parsley-type-message="{{ __('messages.custom.email_type_messages') }}" data-parsley-trigger="keyup" data-parsley-errors-container="#email_error"/>
                        <span id='email_error'></span>
                        <span id='email_invalid_error' class="text-danger"></span>
                    </div>
                    <div class="form-group ">
                        <button class="btn btn-primary btn-block" id="submit">Submit</button>
                    </div>
                    <div class="forgotpwd form-group backtologin pb-0"><a href="{{ route('login') }}">Back to Login</a></div>
                </form>
            </div>
            <div class="col-md-4 mb-4">
                <div class="landingLogo"><img src="{{ asset('assets/img/logo.png') }}" width="80%"></div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
@endsection
@section('page-js')
<script>
    var emailURL = `{{ route('password.email') }}`;
</script>
<script src="{{ asset('assets/js/admin/business/forgot-password.js') }}"></script>
@endsection