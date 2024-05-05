@extends('layouts.front-master')
@section('page-css')
    <style>
        .table td,
        .table th {
            padding: 0 8px !important;
        }

        @media only screen and (max-width: 768px) {

            .table td,
            .table th {
                padding: 0 20px !important;
            }
        }

        th.dow {
            font-size: 12px;
            width: 32px;
            padding-top: 5px;
            padding-bottom: 5px;
        }

        td.day {
            font-size: 12px;
        }

        th.datepicker-switch {
            text-align: center;
        }

        .datepicker.datepicker-dropdown.dropdown-menu.datepicker-orient-left.datepicker-orient-top {
            background-color: #69bbbe;
            padding: 11px;
            padding-right: 0;
        }

        .parsley-required {
            font-size: 14px;
        }

        .cms-index-recuirter .faqQuestion {
            font-size: 20px;
            border-radius: 10px !important;
        }

        .cms-index-recuirter .faqWrapper {
            border-radius: 10px !important;
        }

        .cms-index-recuirter .faqWrapperInnerEven {
            border-radius: 10px;
        }

        .cms-index-recuirter .faqWrapperInnerEven .faqAnswer p {
            font-size: 17px;
            line-height: 1.5;
            margin: 0;
        }

        /* new css for subscription Start */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .subscriptions {
            display: flex;
            gap: 34px;
            justify-content: center;
        }

        .subscription-card {
            max-width: 426px;
            width: 100%;
            border: 1px solid #ccc;
            overflow: hidden;
            padding: 18px;
            background-color: #aad6d6;
            border-radius: 15px 15px 12px 12px;
            box-sizing: border-box;
            height: fit-content;
        }

        .subscription-card .img-wrp {
            max-width: 100%;
            width: 100%;
            position: relative;
        }

        .subscription-card img {
            width: 100%;
            height: 274px;
            object-fit: cover;
            border-radius: 12px;
        }

        .subscription-details {
            max-width: 331px;
            width: 100%;
            margin: 0 auto;
        }

        .subscription-details .short-d {
            margin-top: 51px;
            margin-bottom: 15px;
            font-size: 12px;
            font-weight: 300;
            color: #3a8081;
        }

        .price {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #44aaae;
            border-radius: 12px;
            padding-left: 15px;
            max-width: calc(100% - 24px);
            width: 100%;
            margin: 0 auto;
            box-shadow: 0px 2px 6px -2px #707070;
            position: absolute;
            bottom: -30px;
            right: 0;
            left: 0;
        }

        .price>p {
            font-size: 16px;
            color: #fff;
            font-weight: 500;
        }

        .price p {
            margin: 0;
        }

        .price .price-plan {
            display: flex;
            position: relative;
        }

        .price .price-plan .monthly {
            margin-right: -10px;
            z-index: 1;
        }

        .price .price-plan .monthly,
        .price .price-plan .yearly {
            border-radius: 12px;
            padding: 15px 18px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #eef3f0;
        }

        .price .price-plan .monthly p:first-child {
            font-size: 18px;
            font-weight: 500;
            color: #fd7212;
        }

        .price .price-plan .monthly p:nth-child(2) {
            font-size: 7px;
            font-weight: 500;
            color: #fd7212;
        }

        .price .price-plan .yearly {
            padding-left: 30px;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        .price .price-plan .yearly p:nth-child(1) {
            font-size: 13px;
            font-weight: 500;
            color: #3a8081;
        }

        .price .price-plan .yearly p:nth-child(2),
        .price .price-plan .yearly p:nth-child(3) {
            font-size: 7px;
            font-weight: 500;
            color: #3a8081;
        }

        .points {
            list-style-type: none;
            padding: 15px;
            margin: 0;
            border: 1px solid #44aaae;
            border-radius: 12px;
        }

        .points ul {
            margin: 0;
            padding: 0;
        }

        .points li {
            margin-bottom: 14px;
            display: flex;
            align-items: start;
            color: #fff;
            font-size: 11px;
            font-weight: 500;
        }

        .points li .pointer-icon {
            width: 14px;
            height: 18px;
            object-fit: fill;
            margin-right: 14px;
            margin-top: -2px;
        }

        .view-btn {
            display: flex;
            justify-content: end;
        }

        button.view-more {
            border-radius: 5px;
            border: 0;
            padding: 6px 12px;
            font-size: 7px;
            color: #fd7212;
            box-shadow: 0px 2px 6px -2px #707070;
            cursor: pointer;
        }

        .subscribe-button {
            background-color: #fd7212;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 19px;
            border-radius: 12px;
            cursor: pointer;
            display: block;
            width: 100%;
            margin-top: 16px;
        }

        .recommend-tab {
            position: absolute;
            right: 10px;
            top: 12px;
            background-color: #fd7212;
            border-radius: 12px;
        }

        .recommend-tab p {
            margin: 0;
            font-size: 6px;
            font-weight: 500;
            color: #fff;
            padding: 5px 12px;
        }

        @media screen and (max-width: 767px) {
            .subscriptions {
                flex-direction: column;
            }

            .price .price-plan .monthly,
            .price .price-plan .yearly {
                padding: 8px 18px;
            }
        }

        .price .price-plan .monthly.active {
            background-color: #fff;
            color: #fff;
        }

        .price .price-plan .yearly.active {
            background-color: #fff;
        }

        .switch {
            position: absolute;
            top: 0;
            left: 0;
            width: calc(100% / 2);
            height: 100%;
            background-color: #ccc;
            border-radius: 20px;
            transition: left 0.3s ease-in-out;
        }

        .subscription-card.slick-slide {
            margin-left: 10px;
            margin-right: 10px;
        }

        .free {
            background-color: #fff;
            border-radius: 12px;
        }

        .free p {
            padding: 15px 30px;
            font-size: 24px;
            font-weight: 500;
            color: #fd7212;
        }

        /* new css for subscription End */
    </style>
@endsection
@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="pageBreadcrum"><span>Home</span> / Subscription</div>

            {{-- <div class="row">
                <div class="col-md-4 cms-index-recuirter">
                    <div class="faqWrapper mt-4">
                        <div class="faqQuestion pt-4 pb-3 pl-3 font-weight-bold"> testing</div>
                        <div class="faqWrapperInnerEven">
                            <div class="faqAnswer mt-4">test description</div>
                        </div>
                    </div>

                </div>
                <div class="col-md-4 cms-index-recuirter">
                    <div class="faqWrapper mt-4">
                        <div class="img_sub">
                            <img src="{{ asset('assets/img/subscription/plan-1.png') }}" alt="" srcset="">
                        </div>
                        <div class="faqQuestion pt-4 pb-3 pl-3 font-weight-bold"> testing</div>
                        <div class="faqWrapperInnerEven">
                            <div class="faqAnswer mt-4">test description</div>
                        </div>
                    </div>

                </div>
                <div class="col-md-4 cms-index-recuirter">
                    <div class="faqWrapper mt-4">
                        <div class="faqQuestion pt-4 pb-3 pl-3 font-weight-bold"> testing</div>
                        <div class="faqWrapperInnerEven">
                            <div class="faqAnswer mt-4">test description</div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="subscriptions">
                        @if ($subsPlanLists->isNotEmpty())
                            @foreach ($subsPlanLists as $subsPlanList)
                                <div class="subscription-card">
                                    <div class="img-wrp">
                                        <img src="{{ asset('assets/img/subscription/Mask Group 111.png') }}"
                                            alt="Subscription Image" />
                                        <div class="price">
                                            <p>Basic</p>
                                            <div class="price-plan">
                                                <div class="monthly" onclick="togglePrice('monthly')">
                                                    <p>$69.95</p>
                                                    <p>per month</p>
                                                </div>
                                                <div class="yearly" onclick="togglePrice('yearly')">
                                                    <p>$69.95</p>
                                                    <p>per year</p>
                                                    <p>10% savings</p>
                                                </div>
                                                <div class="switch"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="subscription-details">
                                        <p class="short-d">
                                            Basic Plan is recommended for small businesses or infrequent
                                            job posting.
                                        </p>
                                        <div class="points">
                                            <ul>
                                                <li>
                                                    <img src="{{ asset('assets/img/subscription/pointer.svg') }}"
                                                        alt="" class="pointer-icon" />Post up to 2
                                                    active job ads at a time.
                                                </li>
                                                <li>
                                                    <img src="{{ asset('assets/img/subscription/pointer.svg') }}"
                                                        alt="" class="pointer-icon" />Post up to 2
                                                    active job ads at a time.
                                                </li>
                                                <li>
                                                    <img src="{{ asset('assets/img/subscription/pointer.svg') }}"
                                                        alt="" class="pointer-icon" />Post up to 2
                                                    active job ads at a time.
                                                </li>
                                                <li>
                                                    <img src="{{ asset('assets/img/subscription/pointer.svg') }}"
                                                        alt="" class="pointer-icon" />Post up to 2
                                                    active job ads at a time. Post up to 2
                                                    active job ads at a time
                                                </li>
                                            </ul>
                                            {{-- <div class="view-btn">
                                            <button class="view-more">View More</button>
                                        </div> --}}
                                        </div>
                                        <button class="subscribe-button">Select</button>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        {{-- <div class="subscription-card">
                            <div class="img-wrp">
                                <div class="recommend-tab">
                                    <p>Recommended</p>
                                </div>
                                <img src="{{ asset('assets/img/subscription/Mask Group 111.png') }}"
                                    alt="Subscription Image" />
                                <div class="price">
                                    <p>Basic</p>
                                    <div class="price-plan">
                                        <div class="monthly" onclick="togglePrice('monthly')">
                                            <p>$69.95</p>
                                            <p>per month</p>
                                        </div>
                                        <div class="yearly" onclick="togglePrice('yearly')">
                                            <p>$69.95</p>
                                            <p>per year</p>
                                            <p>10% savings</p>
                                        </div>
                                        <div class="switch"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="subscription-details">
                                <p class="short-d">
                                    Basic Plan is recommended for small businesses or infrequent
                                    job posting.
                                </p>
                                <div class="points">
                                    <ul>
                                        <li>
                                            <img src="{{ asset('assets/img/subscription/pointer.svg') }}" alt=""
                                                class="pointer-icon" />Post up to 2
                                            active job ads at a time.
                                        </li>
                                        <li>
                                            <img src="{{ asset('assets/img/subscription/pointer.svg') }}" alt=""
                                                class="pointer-icon" />Post up to 2
                                            active job ads at a time.
                                        </li>
                                        <li>
                                            <img src="{{ asset('assets/img/subscription/pointer.svg') }}" alt=""
                                                class="pointer-icon" />Post up to 2
                                            active job ads at a time.
                                        </li>
                                        <li>
                                            <img src="{{ asset('assets/img/subscription/pointer.svg') }}" alt=""
                                                class="pointer-icon" />Post up to 2
                                            active job ads at a time. Post up to 2
                                            active job ads at a time
                                        </li>
                                    </ul>
                                    <div class="view-btn">
                                        <button class="view-more">View More</button>
                                    </div>
                                </div>
                                <button class="subscribe-button">Select</button>
                            </div>
                        </div>
                        <div class="subscription-card">
                            <div class="img-wrp">
                                <div class="recommend-tab">
                                    <p>Recommended</p>
                                </div>
                                <img src="{{ asset('assets/img/subscription/Mask Group 111.png') }}"
                                    alt="Subscription Image" />
                                <div class="price">
                                    <p>Basic</p>
                                    <div class="free">
                                        <p>Free</p>
                                    </div>
                                </div>
                            </div>
                            <div class="subscription-details">
                                <p class="short-d">
                                    Basic Plan is recommended for small businesses or infrequent
                                    job posting.
                                </p>
                                <div class="points">
                                    <ul>
                                        <li>
                                            <img src="{{ asset('assets/img/subscription/pointer.svg') }}" alt=""
                                                class="pointer-icon" />Post up to 2
                                            active job ads at a time.
                                        </li>
                                        <li>
                                            <img src="{{ asset('assets/img/subscription/pointer.svg') }}" alt=""
                                                class="pointer-icon" />Post up to 2
                                            active job ads at a time.
                                        </li>
                                        <li>
                                            <img src="{{ asset('assets/img/subscription/pointer.svg') }}" alt=""
                                                class="pointer-icon" />Post up to 2
                                            active job ads at a time.
                                        </li>
                                    </ul>
                                </div>
                                <button class="subscribe-button">Select</button>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
