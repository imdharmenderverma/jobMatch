@extends('layouts.master')

@section('content')
<style type="text/css">
    @media (max-width:600px) {
        .mobileFlex {
            display: flex !important;
            flex-direction: column-reverse;
        }
    }

    li {
        list-style: none;
    }

    ul {
        padding-left: 0px;
    }

    .cust-drop-main-link {
        padding: 15px 15px;
        border-radius: 10px;
        color: #ffffffb3 !important;
        font-family: 'Lato';
        font-weight: 600;
        font-size: 16px;
        /* margin-bottom: 10px; */
        display: block;
        text-decoration: none;
        position: relative;
        background: #69bbbe;
    }

    .cust-drop-ul {
        color: #fff;
        font-family: 'Lato';
        font-weight: 600;
        font-size: 16px;
        border-radius: 10px;
        list-style-type: none;
        margin: 0px;
        position: relative;
        background: #69bbbe;
    }

    .cust-drop-main-link span {
        position: absolute;
        right: 16px;
        top: 0px;
        bottom: 0px;
        margin: auto;
        display: flex;
        align-items: center;
    }

    .cust-drop-main-link.selected .cust-drop-arrow {
        transform: rotate(180deg);
    }

    .cust-inner-drop-link.selected .cust-drop-arrow {
        transform: rotate(180deg);
    }

    .cust-inner-drop-link span {
        position: absolute;
        right: 16px;
    }

    .cust-drop-ul {
        display: none;
    }

    .inner-content-menu {
        padding: 0px 0px 0px 15px;
    }

    .cust-drop-arrow {
        height: 10px;
        width: 10px;
        object-fit: contain;
    }

    .cust-inner-drop-link {
        color: #fff !important;
        font-family: 'Lato';
        font-weight: 600;
        line-height: 33px;
        font-size: 14px;
        text-decoration: none;
        display: block;
        width: 100%;
    }

    .cust-inner-drop-main-link {
        color: #ffffff !important;
        font-family: 'Lato';
        font-weight: 400;
        line-height: 23px;
        font-size: 16px;
        width: 100%;
        display: block;
        background: #69bbbe;
        padding: 7px 15px;
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

    .nested-ul-main {
        height: 300px;
        overflow: auto;
        width: 100%;
        /* position: absolute;
        left: 0px;
        right: 0px; */
    }

    /* width */
    .nested-ul-main::-webkit-scrollbar {
        width: 3px;
    }

    /* Track */
    .nested-ul-main::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    .nested-ul-main::-webkit-scrollbar-thumb {
        background: #888;
    }

    /* Handle on hover */
    .nested-ul-main::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    .cust-menu-main {
        padding: 10px;
        color: #fff;
        border-radius: 10px;
        font-size: 18px;
        font-weight: 500;
        line-height: 1.5;
        /* position: absolute;
        left: 0px;
        right: 0px; */
    }

    .cust-drop-position {
        position: relative;
    }

    .create-account-form {
        position: relative;
    }

    @media only screen and (max-width: 768px){
        .titleTypeWrapper {
        display: inline-block !important;
        }
    }
    
</style>
<div class="container align-items-center d-flex justify-content-center wrapper register-main">
    <div class="right">
        <div class="rightBox error-space">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <h1 class="font-458baf pageTitle">Create Your Account</h1>
                    <form method="POST" id="form-register">
                        <div class="row mt-3 formWrapper create-account-form">
                            <div class="col-md-6 marginTOp">
                                <div class="form-group login-input-size">
                                    <input type="text" class="form-control" name="business_name" id="business_name" placeholder="Business Name" required data-parsley-required data-parsley-required-message="Please enter business name" autocomplete="business_name" data-parsley-pattern-message='Please add in correct name' data-parsley-trigger='keyup' :value="old('business_name')" data-parsley-errors-container="#business_name_error" maxlength="25">
                                    <span id="business_name_error" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group login-input-size">
                                    <input type="text" class="form-control" name="trading_name" id="trading_name" placeholder="Trading Name" required data-parsley-required data-parsley-required-message="Please enter trading name" autocomplete="trading_name" data-parsley-pattern-message='Please add in correct name' data-parsley-trigger='keyup' :value="old('trading_name')" data-parsley-errors-container="#trading_name_error" maxlength="25">
                                    <span id="trading_name_error" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group login-input-size">
                                    <input type="text" class="form-control" name="abn" id="abn" placeholder="ABN" required data-parsley-required data-parsley-required-message="Please enter ABN" autocomplete="abn" data-parsley-trigger='keyup' :value="old('abn')" data-parsley-errors-container="#abn_error" minlength="11" maxlength="11">
                                    <span id="abn_error" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group login-input-size">
                                    <x-input id="email" class="form-control" type="text" name="email" :value="old('email')" autocomplete="email" placeholder="Email" required data-parsley-required-message="{{ __('messages.custom.email_messages') }}" data-parsley-pattern="/^[^\s@]+@[^\s@]+\.[^\s@]+|[0-9]{10,14}$/" data-parsley-pattern-message="{{ __('messages.custom.email_type_messages') }}" data-parsley-trigger="keyup" data-parsley-errors-container="#email_error" maxlength="256" />
                                    <span id='email_error' class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group login-input-size">
                                    <input type="url" class="form-control" name="website" id="website" placeholder="Website" required data-parsley-required data-parsley-required-message="Please enter website" autocomplete="Website" data-parsley-trigger='keyup' :value="old('website')" data-parsley-type="url" data-parsley-type-message="Please enter valid url" data-parsley-errors-container="#website_error" maxlength="256">
                                    <span id="website_error" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group login-input-size">
                                    <input type="digits" class="form-control" name="phone_number" id="phone_number" placeholder="Phone Number" data-parsley-required data-parsley-trigger="keyup" data-parsley-type="digits" minlength="10" data-parsley-required-message='Please enter phone number' maxlength="10" oninput="this.value=this.value.slice(0,this.maxLength)" data-parsley-type-message="Please enter valid Phone number" data-parsley-length-message="The phone number must be at least 10 digits" data-parsley-errors-container="#phone_error">
                                    <span id="phone_error" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- <div class="cust-drop-position"> -->
                                <nav id="top-nav" class="cust-menu-main">
                                    <ul>
                                        <li class="cust-drop-li">
                                            <input type="hidden" name="industry_id" id="industry_id">
                                            <a href="#" class="cust-drop-main-link">
                                                <div class="add_name">Select Industry</div><span>
                                                    <img src="{{asset('assets/img/down-arrow-white.svg')}}" class="cust-drop-arrow" />
                                                </span>
                                            </a>
                                            <ul class="cust-drop-ul nested-ul-main">
                                                @foreach ($industry as $data)
                                                <li class="cust-drop-li cust-drop-li-mian">
                                                    <a href="#" class="cust-inner-drop-link cust-inner-drop-main-link ">{{ $data->title }}
                                                        <span>
                                                            <img src="{{asset('assets/img/down-arrow-white.svg')}}" class="cust-drop-arrow" />
                                                        </span>
                                                    </a>
                                                    <ul class="cust-drop-ul inner-content-menu">
                                                        @foreach ($data->childrens as $child)
                                                        <li class="cust-drop-li ml-3"><a href="#" data-parsley-required="true" data-parsley-required-message="Please select industry"   data-parsley-errors-container="#industry_error" class="cust-inner-drop-link cust-inner-drop-link1" value="{{ $child->id }}">{{ $child->title }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    </ul>
                                    <span id="industry_error" class="text-danger"></span>
                                </nav>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group login-input-size">
                                    <input type="hidden" id="state" name="address_state" class="state">
                                    <input type="text" class="form-control" id="location" name="address"
                                        placeholder="Address" required
                                        data-parsley-required-message="Please enter address"
                                        data-parsley-errors-container='#address_error'>
                                    <span id="address_error" class="text-danger"></span>
                                </div>
                                <div class="form-group login-input-size ml-3">
                                    <span class="typeTitle">Type:</span>
                                    <div class="titleTypeWrapper ml-2"><input class="business" type="radio"
                                            name="type" id="business" name="type" value="1"
                                            placeholder="Address" required
                                            data-parsley-required-message="Please select type"
                                            data-parsley-errors-container='#type_error'><label
                                            for="business"></label><span>Business</span></div>

                                    <div class="titleTypeWrapper"><input class="recruiter" type="radio"
                                            name="type" id="recruiter" value="2" name="type"><label
                                            for="recruiter"></label><span>Recruiter</span></div>
                                    <span id="type_error" class="text-danger"></span>
                                </div>
                                <button class="btn btn-primary btn-block floatRight" type="submit"
                                    id="myButtonV1">Next</button>
                            </div>
                            {{-- <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <div class="form-group login-input-size ml-3">
                                    <span class="typeTitle">Type:</span>
                                    <div class="titleTypeWrapper ml-2"><input class="business" type="radio" name="type" id="business" name="type" value="1" placeholder="Address" required data-parsley-required-message="Please select type" data-parsley-errors-container='#type_error'><label for="business"></label><span>Business</span></div>

                                    <div class="titleTypeWrapper"><input class="recruiter" type="radio" name="type" id="recruiter" value="2" name="type"><label for="recruiter"></label><span>Recruiter</span></div>
                                    <span id="type_error" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-6 text-right">
                                <button class="btn btn-primary btn-block floatRight" type="submit" id="myButtonV1">Next</button>
                            </div> --}}
                        </div>
                    </form>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-js')
<script>
    var registerURL = `{{ route('register-v1') }}`;
    var nextURL = `{{ route('register-v2') }}`;
    var redirectURL = `{{ route('register') }}`;
    $(function() {
        $('li.cust-drop-li > a').on('click', function(event) {
            event.preventDefault();
            $(this).toggleClass('selected');
            $(this).parent().find('ul').first().toggle(0);
            $(this).parent().siblings().find('ul').hide(0);
            $(this).parent().find('ul').parent().mouseleave(function() {
                var thisUI = $(this);
                $('html').click(function() {
                    thisUI.children(".cust-drop-ul").hide();
                    thisUI.children("a").removeClass('selected');
                    $('html').unbind('click');
                });
            });
            if ($(this).hasClass('cust-inner-drop-link1')) {
                $(this).append('<span class="icon_set"><i class="fa fa-check"></i></span>');
                $('li.cust-drop-li a.cust-inner-drop-link1').not(this).find('i.fa-check').remove();
                $(this).closest('.cust-drop-li-mian').siblings().find('ul.inner-content-menu').hide();
                var childValue = $(this).text().trim();
                var childId = $(this).attr('value');
                $('#industry_id').val(childId);
                $('.add_name').html(childValue);
                $('.cust-drop-main-link').removeClass('selected');
                $('.cust-drop-ul').hide();
            }
        });
    });
</script>
<script src="{{ asset('assets/js/admin/business/register.js') }}"></script>
@endsection