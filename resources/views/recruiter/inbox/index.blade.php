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
</style>
@endsection
@section('content')
<div class="main-panel">
    <div class="content">
        <div class="pageBreadcrum"><span><a href="{{ route('admin.dashboard') }}">Home</a></span> / Inbox</div>
        <div class="row mt-5">

            <div class="col-md-12 cmsFaq">
                <form id="inboxForm" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" placeholder="Name" style="background: #AAD6D6;">
                        <span class="text-danger parsley-required name-error-name" id="name-error">{{ $errors->first('name') }}</span>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="email" placeholder="Email" style="background: #AAD6D6;">
                        <span class="text-danger parsley-required email-error-skil" id="email-error">{{ $errors->first('email') }}</span>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" style="background: #AAD6D6;" id="start_date" name="start_date" placeholder="Start Date" autocomplete="off" onkeydown="return false;">
                        <span class="text-danger parsley-required" id="start-date-error"></span>
                    </div>

                    <div class="form-group">
                        <input type="digits" class="form-control" name="phone" id="phone" placeholder="Phone Number" data-parsley-required data-parsley-trigger="keyup" data-parsley-type="digits" minlength="10" data-parsley-required-message='Please Enter Phone Number' maxlength="10" oninput="this.value=this.value.slice(0,this.maxLength)" data-parsley-type-message="Please Enter Valid Phone Number" data-parsley-length-message="The Phone Number must be at least 10" data-parsley-errors-container="#phone_error" style="background: #AAD6D6;">
                        <span id="phone_error" class="text-danger"></span>
                    </div>

                    <div class="form-group">
                        <textarea class="form-control" id="answer" placeholder="Answer" rows="10" style="background: #AAD6D6;"></textarea>
                        <span class="text-danger parsley-required answer-error-skil" id="answer-error">{{ $errors->first('answer') }}</span>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-primary btn-block font-900 w-50 float-right save-btn" value="Save">
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