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
    </style>
@endsection
@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="pageBreadcrum"><span>Home</span> / Subscription</div>

            <div class="row">
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
            </div>
        </div>
    </div>
@endsection
