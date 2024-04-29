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

    #cms_faq .faqWrapperInnerOdd:nth-child(even) {
        background: #44aaae;
        border-radius: 20px;
    }

    .cus-width-change-faq {
        min-width: 765px;
        max-width: 765px;
    }

    
.button-faq {
    background: #fd7212;
    color: #fff;
    font-size: 18px;
    text-align: center;
    padding: 15px;
    border-radius: 10px;
    width: 100%;
    border: none;
    min-width: 115px;
    display: inline-block;
    border: 0;
    outline: 0;
    line-height: 1.4;
    font-family: "Lucida Grande", "Lucida Sans Unicode", Tahoma, Sans-Serif;
    cursor: pointer;
    /* Important part */
    position: relative;
    transition: padding-right .3s ease-out;
}

.button-faq.loading {
    background-color: #fd7212;
    padding-right: 40px;
}

.button-faq.loading:after {
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
@endsection
@section('content')
<div class="main-panel" id="cms_faq">
    <div class="content">
        <div class="pageBreadcrum font-roboto"><span>Home</span> / Frequently Asked Questions</div>

        <div class="row">
            <div class="col-md-7 mt-5">
                <div class="faqWrapper faq-data">
                @if($getBusinessFaqData)
                    @foreach($getBusinessFaqData as $data)
                    <div class="faqWrapperInnerOdd cus-width-change-faq">
                        <div class="faqQuestion font-900 font-roboto">{{$data->question}}</div>
                        <div class="faqAnswer mt-3 font-roboto">{{$data->answer}}</div>
                    </div>
                    @endforeach
                @else
                <div class="container">
                    <div class="justify-content-center align-items-center" style="min-height: 50vh;">
                        <div class="col-md-12">
                            <div class="card card-dark bg-secondary-gradient">
                                <div class="card-body skew-shadow rightsideBox">
                                    <div class="row">
                                        <div class="col-12 pr-0 text-center">
                                            <h3 class="fw-bold mb-1 dashboardRightBoxesTitle"> No Data Found</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                </div>
            </div>

            <div class="col-md-5 mt-4">
                <div class="row">
                    <div class="pageTitleInner col-md-12" style="margin-left: 15px; margin-bottom: 15px;">Need more Help?</div>
                </div>
                <form id="inboxForm" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" name="question" id="question" placeholder="Subject">
                        <span class="text-danger parsley-required question-error-skil ml-0 mt-0" id="question-error">{{ $errors->first('question') }}</span>
                    
                    </div>

                    <div class="form-group">
                        <textarea class="form-control" name="answer" id="answer" placeholder="Details" rows="8"></textarea>
                        <span class="text-danger parsley-required answer-error-skil mt-0 ml-0" id="answer-error">{{ $errors->first('answer') }}</span>
                    </div>

                    <div class="form-group">
                       <button id="myButton6" class="button-faq  save-btn" >Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-js')
<script>
    var storeInbox = `{{ route('recruiter.inbox-store') }}`;
</script>
<script src="{{ asset('assets/js/admin/recruiter/inbox.js') }}"></script>
@endsection