@extends('layouts.master')

@section('content')
    <style>
        .eye-btn {
            position: absolute;
            right: 16px !important;
            top: 40px !important;
        }

        @media (max-width:600px) {
            .mobileFlex {
                display: flex !important;
                flex-direction: column-reverse;
            }
        }


        .btn-primary {
            background: #fff !important;
            border-color: #fff !important;
            border-radius: 10px;
            color: #ff8c13;
            font-weight: 900;
            font-size: 20px;
            display: inline-block;
            border: 0;
            outline: 0;
            line-height: 1.4;
            font-family: "Lucida Grande", "Lucida Sans Unicode", Tahoma, Sans-Serif;
            cursor: pointer;
            position: relative;
            transition: padding-right .3s ease-out;
            text-align: center;
        }



        .btn-primary.loading {
            background-color: #fd7212;
            padding-right: 40px;
        }

        .btn-primary.loading:after {
            content: "";
            position: absolute;
            border-radius: 100%;
            right: 6px;
            top: 50%;
            width: 0px;
            height: 0px;
            margin-top: -2px;
            border: 2px solid rgba(255, 255, 255, 0.5);
            border-left-color: #FFF;
            border-top-color: #FFF;
            animation: spin .6s infinite linear, grow .3s forwards ease-out;
        }
    </style>

    <div class="container align-items-center d-flex justify-content-center wrapper">
        <div class="right">
            <div class="rightBox error-space">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <h1 class="font-458baf pageTitle">Set Your Password</h1>
                        <form method="POST" id="form-register" action="{{ route('register') }}">
                            <div class="row mt-3 formWrapper">
                                <div class="col-md-12">
                                    <div class="form-group login-input-size position-relative cus-toggle-eye">
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="New Password" required
                                            data-parsley-required-message="{{ __('messages.custom.new_password_required_messages') }}"
                                            data-parsley-trigger="keyup" data-parsley-errors-container="#password_error">
                                        <div class="cus-innertoggle-eye">
                                            <img src="{{ asset('assets/img/eye.png') }}" alt=""
                                                class="eye-btn eye-show" id="eye-btn">
                                            <img src="{{ asset('assets/img/slash-eye.png') }}" alt=""
                                                class=" eye-btn slash-eye-show" id="eye-btn">
                                        </div>
                                        <span id='password_error'></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group login-input-size position-relative">
                                        <input type="password" class="form-control" id="password_confirmation"
                                            name="password_confirmation" placeholder="Confirm New Password" required
                                            autocomplete="new-password" placeholder="Confirm Password"
                                            data-parsley-equalto="#password"
                                            data-parsley-equalto-message="Passwords are not matching"
                                            data-parsley-required-message="{{ __('messages.custom.confirm_password_required_messages') }}"
                                            data-parsley-trigger="keyup"
                                            data-parsley-errors-container="#confirm_password_error">
                                        <div class="cus-innertoggle-eye">
                                            <img src="{{ asset('assets/img/eye.png') }}" alt=""
                                                class="eye-btn eye-show-2" id="eye-btn-2">
                                            <img src="{{ asset('assets/img/slash-eye.png') }}" alt=""
                                                class=" eye-btn slash-eye-show-2" id="eye-btn-2">
                                        </div>
                                        <span class="text-danger" id='confirm_password_error'></span>
                                    </div>
                                </div>
                                <div class="col-md-12 fullLengthbtn mt-4">
                                    <button class="btn btn-primary btn-block fullLengthbtnInner" type="submit"
                                        id="myButtonReset">Confirm</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-js')
    <script>
        var registerURL = `{{ route('save-register-v2') }}`;
        var nextURL = `{{ route('register-v3') }}`;
        var redirectURL = `{{ route('register') }}`;
    </script>
    <script src="{{ asset('assets/js/admin/business/register.js') }}"></script>
@endsection
