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
</style>
@endsection
@section('content')
<div class="main-panel">
    <div class="content">
        <div class="pageBreadcrum"><span><a href="{{ route('admin.dashboard') }}">Home</a></span> / Dashboard</div>
        <div class="pageTitleInner">Your Job Listings</div>
        <div class="row">

            <div class="col-md-9" id="jobWrapperOuter">
                <div class="row">
                    @if($data['jobs']['data'])
                    @foreach ($data['jobs']['data'] as $job)
                    <div class="col-md-6">
                        <div class="card card-dark bg-secondary-gradient">
                            <div class="card-body skew-shadow">
                                <div class="row">
                                    <div class="col-7 jobWrapper">
                                        <div class="jobTitle viewJobs joblisttitle" data-title="{{ $job['role_name'] }}" data-id="{{ $job['id'] }}">{!! $job['role_name'] !!}</div>
                                        <div class="jobDesc">{{ $job['type_of_work_name'] }}</div>
                                        <div class="jobShortDesc readMore">{!!$job['location']!!}</div>
                                        <div class="jobApplicants">{{ $job['apply_user_count'] }} Applicants</div>
                                        <div class="jobViewApplicans viewJobs" data-title="{{ $job['title'] }}" data-id="{{ $job['id'] }}">View Applicants</div>
                                        <div class="jobMarkComplete">
                                            <label class="switch">
                                                <input type="checkbox" class="job-completed" data-id="{{ $job['id'] }}">
                                                <span class="slider round"></span>
                                            </label>
                                            <span class="markComplete">Mark as complete</span>
                                        </div>
                                    </div>
                                    <div class="col-5 jobData">
                                        <div class="jobAward">Award Job<i class="fa fa-check jobTitleCheck-icon"></i></div>
                                        <div class="jobDate">Posted: {{ $job['start_date'] }}</div>
                                        <div class="jobDate">Closing date: {{ $job['end_date'] }}</div>
                                        <div class="jobEdit"><img src="{{ asset('assets/img/editjob.png') }}" data-id="{{ $job['id'] }}" class="edit-job" data-title="{{ $job['title'] }}" style="width: 20px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                                <h3 class="fw-bold mb-1 dashboardRightBoxesTitle">Your data will appear here</h3>
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
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-dark bg-secondary-gradient">
                            <div class="card-body skew-shadow rightsideBox">
                                <div class="row">
                                    <div class="col-12 pr-0">
                                        {{-- <h3 class="fw-bold mb-1 dashboardRightBoxesTitle">{{$data['jobs']['total']}}  Listings</h3> --}}
                                        <div class="text-small fw-bold op-8 dashboardRightBoxes">Current active job
                                            listing</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-dark bg-secondary-gradient">
                            <div class="card-body skew-shadow rightsideBox">
                                <div class="row">
                                    <div class="col-12 pr-0" id="dashGraph">
                                        <h3 class="fw-bold mb-1 dashboardRightBoxesTitle">{{$data['jobs']['total']}}  Days</h3>
                                        <div class="text-small fw-bold op-8 dashboardRightBoxes">Average time to fill
                                            roles</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-dark bg-secondary-gradient">
                            <div class="card-body skew-shadow rightsideBox">
                                <div class="row">
                                    <div class="col-12 pr-0">
                                        <h3 class="fw-bold mb-1 dashboardRightBoxesTitle">{{$data['total_matched_users']}} Applicants</h3>
                                        <div class="text-small fw-bold op-8 dashboardRightBoxes">Number of applicants
                                            per job</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-dark bg-secondary-gradient">
                            <div class="card-body skew-shadow rightsideBox">
                                <div class="row">
                                    <div class="col-12 pr-0" id="dashGraph">
                                        <h3 class="fw-bold mb-1 dashboardRightBoxesTitle">{{$data['average_time_jobs_vacant']}}</h3>
                                        <div class="text-small fw-bold op-8 dashboardRightBoxes">Average time jobs are
                                            vacant</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-js')
<script src="{{ asset('assets/js/admin/recruiter/dashboard.js') }}"></script>

@endsection