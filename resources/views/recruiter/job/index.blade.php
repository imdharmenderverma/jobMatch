@extends('layouts.front-master')
@section('page-css')
    <style type="text/css">
        .pannelCMS.nav-pills.nav-secondary .nav-link.active {
            background: #69bbbe !important;
            color: #ff8c13 !important;
            border-radius: none !important;
            border: 1px solid #69bbbe;
            margin-left: 18px;
           
        }

        .pannelCMS.nav-pills>li>.nav-link {
            background: #c1e0df !important;
            color: #ff8c13 !important;
            border-radius: none !important;
            padding: 12px 30px;
            margin: 0;
            height: 50px;
            border: 1px solid #69bbbe;
            font-weight: 600;
        }

        .pannelCMS .nav-item:hover {
            border-left: none !important;
        }

        .pannelCMS .firstPannel {
            border-top-left-radius: 10px !important;
            border-bottom-left-radius: 10px !important;
        }

        .pannelCMS .secondPannel {
            border-top-right-radius: 10px !important;
            border-bottom-right-radius: 10px !important;
        }

        #cms_um .faqWrapper {
            background: #aad6d6;
            border-radius: 10px;
            margin-left: 50px
        }

        #cms_um .faqWrapper .selectBG {
            background: #69bbbe;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }

        #cms_um .faqWrapper .form-control {
            background: #aad6d6 !important;
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
            border: 1px solid #69bbbe;
            border-top-left-radius: 0px;
            border-bottom-left-radius: 0px;
            height: 50px !important;
            font-size: 13px;
            color: #ff8c13;
        }

        #cms_um .selectLable {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 50px;
            color: #ff8c13 !important;
            font-weight: 700 !important;
            font-size: 13px !important;
        }

        #cms_um .table th {
            color: #3a8081;
            font-weight: 400
        }

        #cms_um .searchBM .form-control {
            background: #69bbbe !important;
            border-radius: 10px;
            border: 1px solid #69bbbe;
            height: 50px !important;
            font-weight: 600;
            font-size: 16px;
            color: #fff;
        }

        .viewJobs {
            background: #ff8c13 !important;
            color: #fff !important;
            padding: 10px 25px;
            border-radius: 10px;
            cursor: pointer;
            min-width: 104px !important;

        }

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
            <div class="pageBreadcrum"><span><a href="{{ route('recruiter.dashboard') }}">Home</a></span> / Job Listing</div>
            <div class="row">
                <div class="pageTitleInner col-md-6">Your Job Management</div>
                <div class="col-md-6" id="editJobBtns">

                    <a href="javascript:void(0)" class="anchorBtn add-btn-modal" style="background: #aad6d6;">Add Job
                        Listing</a>
                    <a href="javascript:void(0)" class="anchorBtn download-csv" data-toggle="modal"
                        style="width: 135px; text-align: center;">Export</a>
                </div>
            </div>
            <div class="faqWrapper p-4 mt-5 col-md-12">
                <div class="row">
                    <div class="col-md-3 d-flex align-items-center firstFilter">
                        <h2 class="text-white font-weight-bold">Job Ads</h2>
                    </div>
                    <div class="col-md-3 searchBM">
                        <div class="input-icon">
                            <input type="text" class="form-control search-job" placeholder="Search">
                            <span class="input-icon-addon">
                                <i class="fa fa-search" style="color: #ff8c13;"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-3 thirdFilter">
                        <div class="row">
                            <div class="col-md-6 selectBG">
                                <label class="selectLable">Location</label>
                            </div>
                            <div class="col-md-6 p-0">
                                <select class="form-control form-control cus-op-left" id="job_location">
                                    <option value="">All</option>
                                    <option value="Australian Capital Territory">ACT</option>
                                    <option value="New South Wales">NSW</option>
                                    <option value="Northern Territory">NT</option>
                                    <option value="South Australia">SA</option>
                                    <option value="Victoria">VIC</option>
                                    <option value="Queensland QLD">QLD</option>
                                    <option value="Tasmania">TAS</option>
                                    <option value="Western Australia">WA</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3  align-items-center forthFilter">
                        <div class="row">
                            <ul class="nav nav-pills nav-secondary pannelCMS float-right" id="pills-tab" role="tablist">
                            <li class="nav-item submenu m-0">
                                <a class="nav-link active show firstPannel" id="pills-home-tab" data-id="1"
                                    data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home"
                                    aria-selected="true">A-Z</a>
                            </li>
                            <li class="nav-item submenu m-0">
                                <a class="nav-link secondPannel" id="pills-profile-tab" data-id="2" data-toggle="pill"
                                    href="#pills-profile" role="tab" aria-controls="pills-profile"
                                    aria-selected="false">Most recent</a>
                            </li>
                        </ul>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="tab-pane fade active show" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab">
                            <div class="tab-pane fade active show" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home-tab">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12 table-responsive user-list-tbl p-0">
                                                <table class="table mt-3 text-center text-white tableMobile job-table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Role Name</th>
                                                            <th scope="col">Company</th>
                                                            <th scope="col">State</th>
                                                            <th scope="col">Job Type</th>
                                                            <th scope="col">Applicants</th>
                                                            <th scope="col">Matches</th>
                                                            <th  class="min-width-85">Date Posted</th>
                                                            <th scope="col">Hide</th>
                                                            <th scope="col" class="min-width-85">Delete</th>
                                                            <th scope="col" class="min-width-85"></th>
                                                        </tr>
                                                    </thead>

                                                </table>
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
    </div>
@endsection
@section('page-js')
@endsection
