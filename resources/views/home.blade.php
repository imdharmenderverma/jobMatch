@extends('layouts.master')

@section('content')
    <style type="text/css">
        .btn-primary.color-orange {
    color: #ff8c13 !important;
}

.btn-primary.color-orange:hover {
    color: #fff !important;
}
        @media (max-width:600px) {
            .mobileFlex {
                display: flex !important;
                flex-direction: column-reverse;
            }
        }
    </style>

    <body id="landing">
        <div class="container landing wrapper align-items-center d-flex justify-content-center">
            <div class="row align-items-center d-flex justify-content-center mobileFlex">
                <div class="col-md-2"></div>
                <div class="col-md-4 mb-4">
                    <div class="form-group">
                        <a href="{{ route('register') }}" class="btn btn-primary btn-block color-orange">Sign up</a>
                    </div>
                    <div class="form-group">
                        <a href="{{ route('recruiter.login') }}" class="btn btn-primary btn-block color-orange">Login</a>
                    </div>
                </div>
                <div class="col-md-4 text-left mb-4">
                    <div class="landingLogo"><img src="assets/img/logo.png" width="60%"></div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    @endsection
