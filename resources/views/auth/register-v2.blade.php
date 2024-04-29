@extends('layouts.master')

@section('content')
    <style type="text/css">
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
    <div id="terms">
        <div class="container wrapper align-items-center d-flex justify-content-center">
            <div class="right">
                <div class="rightBox termsWrapper error-space">

                    <h1 class="font-458baf whiteTitle ml-4 mr-4 mb-3">{{ $getBusinessCmsData->cms_title }}</h1>

                    <div class="termsInner">
                        <p class="main-font-1d8082">{!! isset($getBusinessCmsData->description) ? $getBusinessCmsData->description : '' !!}</p>
                    </div>

                    <form method="POST" id="form-register">
                        <div class="row" style="padding: 0 50px;">
                            <div class="col-md-8">
                                <div class="termsCheckWrapper term-con-termsCheckWrapper">
                                    <div class="col-auto  float-left term-error">
                                        <label class="colorinput d-flex align-items-center">
                                            <input type="checkbox" name="term" id="term" value="1"
                                                class="colorinput-input" required
                                                data-parsley-required-message="Please accept terms & conditions"
                                                data-parsley-errors-container='#term_error'>
                                            <span class="colorinput-color bg-primary"></span>
                                            <span class="ml-2 text-white">I accept the <a>Terms & Conditions</a></span>

                                        </label>
                                        <div> <span id="term_error"></span></div>

                                    </div>

                                    <div class="col-auto term-error">
                                        <label class="colorinput d-flex align-items-center">
                                            <input type="checkbox" name="privacy" id="privacy" value="1"
                                                class="colorinput-input" required
                                                data-parsley-required-message="Please accept privacy policy"
                                                data-parsley-errors-container='#privacy_error'>
                                            <span class="colorinput-color bg-primary bg-primary2"></span>
                                            <span class="ml-2 text-white">I accept the <a
                                                    href="{{ route('privacy-policy-register') }}">Privacy
                                                    Policy</a></span>

                                        </label>
                                        <div> <span id="privacy_error"></span></div>
                                    </div>
                                </div>
                                <input type="hidden" value="1" class="state">
                            </div>
                            <div class="col-md-3 offset-md-1 fullLengthbtn "><button
                                    class="btn btn-primary btn-block fullLengthbtnInner register-terms-button"
                                    type="submit" id="myButtonTermOfUse">Next</button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-js')
    <script>
        var registerURL = `{{ route('save-register-v3') }}`;
        var nextURL = `{{ route('recruiter.login') }}`;
        var redirectURL = `{{ route('register') }}`;
    </script>
    <script src="{{ asset('assets/js/admin/business/register.js') }}"></script>
@endsection
