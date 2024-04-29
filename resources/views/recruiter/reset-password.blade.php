@extends('layouts.master')

@section('content')
    <style type="text/css">
        
        @media (max-width:600px) {
            .mobileFlex {
                display: flex !important;
                flex-direction: column-reverse;
            }
        }
    </style>
    <div class="container landing wrapper align-items-center d-flex justify-content-center">
        <div class="row align-items-center d-flex justify-content-center mobileFlex">
            <div class="col-md-2"></div>
            <div class="col-md-4 formWrapper mb-4" style="padding: 20px 20px;">
                <form method="POST" id="form-reset" action="{{ route('recruiter.save-reset-password') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $data->token }}">
                    <!-- <div class="form-group"> -->
                        <x-input id="email" class="form-control" type="hidden" name="email"
                            value="{{ $data->email }}" required autofocus autocomplete="username" placeholder="Email"
                            data-parsley-type="email"
                            data-parsley-required-message="{{ __('messages.custom.email_messages') }}"
                            data-parsley-type-message="{{ __('messages.custom.email_type_messages') }}"
                            data-parsley-trigger="keyup" data-parsley-errors-container="#email_error" />
                        <span id='email_error'></span>
                    <!-- </div> -->
                    <div class="form-group">
                        <div class="position-relative">
                            <!-- <x-input id="password" class="form-control" type="password" name="password" required
                                autocomplete="new-password" placeholder="New Password"
                                data-parsley-pattern="^(?=.*\d)(?=.*[@#$%&!])(?=.*[a-z])(?=.*[A-Z]).{4,}$"
                                data-parsley-length="[6,32]"
                                data-parsley-required-message="{{ __('messages.custom.new_password_required_messages') }}"
                                data-parsley-length-message="{{ __('messages.custom.password_length_messages') }}"
                                data-parsley-pattern-message="{{ __('messages.custom.password_pattern_messages') }}"
                                data-parsley-trigger="keyup" data-parsley-errors-container="#password_error" /> -->

                                <x-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" placeholder="New Password"  data-parsley-required-message="{{ __('messages.custom.new_password_required_messages') }}" data-parsley-trigger="keyup" data-parsley-errors-container="#password_error" />
                                <div class="cus-innertoggle-eye">
                                            <img src="{{ asset('assets/img/eye.png') }}" alt="" class="eye-btn eye-show" id="eye-btn">
                                            <img src="{{ asset('assets/img/slash-eye.png') }}" alt="" class=" eye-btn slash-eye-show" id="eye-btn">
                                            </div>
                        </div>
                        <span id='password_error'></span>
                    </div>
                    <div class="form-group">
                        <div class="position-relative">
                            <!-- <x-input id="password_confirmation" class="form-control" type="password"
                                name="password_confirmation" required autocomplete="new-password"
                                placeholder="Confirm New Password"
                                data-parsley-pattern="^(?=.*\d)(?=.*[@#$%&!])(?=.*[a-z])(?=.*[A-Z]).{6,}$"
                                parsley-equalto="#password"
                                data-parsley-required-message="{{ __('messages.custom.confirm_password_required_messages') }}"
                                data-parsley-pattern-message="{{ __('messages.custom.password_pattern_messages') }}"
                                data-parsley-trigger="keyup" data-parsley-errors-container="#confirm_password_error" /> -->
                                <x-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm New Password" data-parsley-equalto="#password" data-parsley-equalto-message="Passwords are not matching" data-parsley-required-message="{{ __('messages.custom.confirm_password_required_messages') }}" -parsley-trigger="keyup" data-parsley-errors-container="#confirm_password_error" />
                                <div class="cus-innertoggle-eye">
                                            <img src="{{ asset('assets/img/eye.png') }}" alt="" class="eye-btn eye-show-2" id="eye-btn-2">
                                            <img src="{{ asset('assets/img/slash-eye.png') }}" alt="" class=" eye-btn slash-eye-show-2" id="eye-btn-2">
                                            </div>
                        </div>
                        <span id='confirm_password_error'></span>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" id="submit" class="btn btn-primary btn-block">Confirm</button>
                    </div>
                </form>
            </div>
            <div class="col-md-4 text-center mb-4">
                <div class="landingLogo"><img src="{{ asset('assets/img/logo.png') }}" width="80%"></div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
@endsection
@section('page-js')
    <script>
        var resetURL = `{{ route('recruiter.save-reset-password') }}`;
        var loginURL = `{{ route('recruiter.login') }}`;
    </script>
    <script src="{{ asset('assets/js/admin/recruiter/reset-password.js') }}"></script>
@endsection
