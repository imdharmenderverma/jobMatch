@extends('layouts.front-master')
@section('page-css')
<style type="text/css">
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

    .datepicker.datepicker-dropdown.dropdown-menu.datepicker-orient-left {
        background-color: #69bbbe;
        padding: 11px;
        padding-right: 0;
    }
    .add-btn-modal{
        background: #0d8282;
    color: #fff !important;
    }
</style>
@endsection
@section('content')
<div class="main-panel">
    <div class="content">
    <div class="pageBreadcrum"><span><a href="{{ route('recruiter.dashboard') }}">Home</a></span> / Job Listing</div>
        <div class="row">
            <div class="pageTitleInner col-md-6">Your Job Listings</div>
            <div class="col-md-6" id="editJobBtns">
                <a href="javascript:void(0)" class="anchorBtn add-btn-modal">Add Job
                    Listing</a>
            </div>
        </div>
        <div id="job-listing">
            @include('recruiter.job-pagination-index')
        </div>
    </div>
</div>
@endsection
@section('page-js')
<script>
        var jobPostPagination = `{{ route('recruiter.jobPostPagination') }}`;
    </script>
<script src="{{ asset('assets/js/admin/recruiter/dashboard.js') }}"></script>
@endsection