@extends('layouts.admin-master')

@section('content')
    <style>
        .circles-decimals,
        .circles-integer {
            font-size: 17px;
            vertical-align: middle;
            display: none;
        }

        .firstProgress .progress.progress-sm {
            height: 2px !important;
        }

        .firstProgress .bg-info {
            background-color: #fd7213 !important;
        }

        .circles-integer {
            display: none;
        }

        ::-webkit-scrollbar {
            width: 8px;
            height: 10px;
        }

        ::-webkit-scrollbar-thumb {
            border-radius: 8px;
            background: #f1f1f1;
        }
    </style>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <div class="main-panel">
        <div class="content">

            <div class="pageBreadcrum"><span><a href="{{ route('admin.dashboard') }}">Home</a></span> / Dashboard</div>

            <div class="row mt-5" id="dashboardStats">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row d-flex justify-content-center align-items-center">
                                        <div class="col-8 col-stats">
                                            <div class="numbers">
                                                <h4 class="card-title text-white font-weight-bold">
                                                    {{ $data['getPeopleMatched'] }}%</h4>
                                                <p class="card-category">People Matched</p>
                                            </div>
                                        </div>
                                        <div class="col-4 pl-0">
                                            <img src="{{ asset('assets/img/db/dbicon1.png') }}" width="100%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="numbers">
                                                <h4 class="card-title text-white font-weight-bold text-center">
                                                    {{ $data['getAppUserCount'] }}</h4>
                                                <p class="card-category text-center">Number of Users</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <h4 class="card-title text-white font-weight-bold text-center" id="totalsalary">
                                                    $0</h4>

                                            <p class="card-category text-center">Average Salary</p>

                                            <div class="custom-dd">
                                                <select name="type_of_work" id="type_of_work" class=" font-weight-bold selectpicker averageSalaryCount" style="color: ##81c5c7;font-szie:15px" onchange="loadSalary()">
                                                    <option class=" font-weight-bold" style="color: ##81c5c7; font-size: 12px;" value="1">Full Time</option>
                                                    <option class=" font-weight-bold" style="color: ##81c5c7; font-size: 12px;" value="2">Part Time</option>
                                                    <option class=" font-weight-bold" style="color: ##81c5c7; font-size: 12px;" value="3">Casual</option>
                                                    <option class=" font-weight-bold" style="color: ##81c5c7; font-size: 12px;" value="4">Apprentice</option>
                                                    <option class=" font-weight-bold" style="color: ##81c5c7; font-size: 12px;" value="5">Assisted</option>
                                                    <option class=" font-weight-bold" style="color: ##81c5c7; font-size: 12px;" value="6">Intern</option>
                                                </select>
                                                <i class="dd-arrow" id="id_toggle"  style="cursor: pointer;"><img src="{{asset('assets/img/dd-arrow.svg')}}"/></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row d-flex justify-content-center align-items-center">
                                        <div class="col-8 col-stats">
                                            <div class="numbers">
                                                <h4 class="card-title text-white font-weight-bold">
                                                    {{ $data['getAverageTimeFile'] }} Days</h4>
                                                <p class="card-category">Average time to fill rates</p>
                                            </div>
                                        </div>
                                        <div class="col-4 pl-0">
                                            <img src="{{ asset('assets/img/db/dbicon2.png') }}" width="100%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="numbers">
                                                <h4 class="card-title text-white font-weight-bold text-center">45,321</h4>
                                                <p class="card-category text-center">Total Revenue</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row d-flex justify-content-center align-items-center">
                                        <div class="col-8 col-stats">
                                            <div class="numbers">
                                                <h4 class="card-title text-white font-weight-bold">
                                                    {{ $data['getSavedJob'] }}%</h4>
                                                <p class="card-category">Saved jobs</p>
                                            </div>
                                        </div>
                                        <div class="col-4 pl-0">
                                            <img src="{{ asset('assets/img/db/dbicon1.png') }}" width="100%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row d-flex justify-content-center align-items-center">
                                        <div class="col-8 col-stats">
                                            <div class="numbers">
                                                <h4 class="card-title text-white font-weight-bold">
                                                    {{ $data['getAverageTimeFile'] }} Days</h4>
                                                <p class="card-category">Average time jobs are vacant</p>
                                            </div>
                                        </div>
                                        <div class="col-4 pl-0">
                                            <img src="{{ asset('assets/img/db/dbicon2.png') }}" width="100%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="numbers">
                                                <h4 class="card-title text-white font-weight-bold text-center">
                                                    {{-- {{ $data['getNumberOfApplicantsJob'] }} Applicants --}}
                                                    @if($data['getNumberOfApplicantsJob'] == 1)
                                                        {{ $data['getNumberOfApplicantsJob'] }} Applicant
                                                    @else
                                                        {{ $data['getNumberOfApplicantsJob'] }} Applicants
                                                    @endif
                                                    </h4>
                                                <p class="card-category text-center">Number of Applicants per job</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card p-2">
                                <div class="card-title text-white font-weight-bold ml-2">Revenue</div>
                                <div class="card-body p-0">
                                    <div class="chart-container">
                                        <canvas id="doughnutChart" style="width: 50%; height: 50%;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 marginTop">
                            <div class="card p-2">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card-title text-white font-weight-bold ml-2">Total Subscriptions</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="dropdown sub-dropdown text-right mr-2 mt-1">
                                            <button class="btn btn-link text-white dropdown-toggle" type="button"
                                                id="dd1" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"
                                                style="padding: 5px 20px; border: 1px solid #fff !important; border-radius: 5px;">
                                                Weekly <i data-feather="more-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">

                                                <a class="dropdown-item" href="#">Weekly</a>
                                                <a class="dropdown-item" href="#">Monthly</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body p-0">
                                    <div class="chart-container">
                                        <canvas id="lineChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 marginTop">
                    <div class="card p-2 firstProgress">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-title text-white font-weight-bold ml-2">User Locations</div>
                            </div>
                            <div class="col-md-6">
                                <div class="dropdown sub-dropdown text-right mr-2 mt-1">
                                    <button class="btn btn-link text-white dropdown-toggle" type="button" id="dd1"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                        style="padding: 5px 20px; border: 1px solid #fff !important; border-radius: 5px;">
                                        <span id="user_location_button_text">Weekly</span><i data-feather="more-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                        <a id="weekly" class="dropdown-item" onclick="userLocationAjax('week')">Weekly</a>
                                        <a id="monthly" class="dropdown-item" onclick="userLocationAjax('month')">Monthly</a>
                                        <a id="annually" class="dropdown-item" onclick="userLocationAjax('year')">Annually</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="numbers ml-2 mt-2">
                            <h3 class="card-title text-white font-weight-bold mb-0" id="user_location_total_user"></h3>
                            <h4 class="card-category mt-0" style="font-size: 15px !important;">Top visit by State</h4>
                        </div>
                        <div style="height: 224px; overflow-y: scroll; overflow-x: hidden;">
                            <div class="row mt-2 pl-2 pr-2">
                                <div class="col-md-4 text-left font-weight-bold">QLD</div>
                                <div class="col-md-4 text-center" id="qld_total_user"></div>
                                <div class="col-md-4 text-right"><span id="qld_user_per"></span>%<i
                                        class="fas fa-arrow-up" id="qld_up_arrow" style="color: #2adda6;"></i><i
                                        class="fas fa-arrow-down" id="qld_down_arrow" style="color: #f9365c;"></i></div>
                            </div>
                            <div class="progress progress-sm mt-1 ml-2 mr-2">
                                <div class="progress-bar bg-info" id="qld_progress_bar" role="progressbar"
                                    aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                            <div class="row mt-3 pl-2 pr-2">
                                <div class="col-md-4 text-left font-weight-bold">NSW</div>
                                <div class="col-md-4 text-center" id="nsw_total_user"></div>
                                <div class="col-md-4 text-right"><span id="nsw_user_per"></span>%<i
                                        class="fas fa-arrow-up" id="nsw_up_arrow" style="color: #2adda6;"></i><i
                                        class="fas fa-arrow-down" id="nsw_down_arrow" style="color: #f9365c;"></i></div>
                            </div>
                            <div class="progress progress-sm mt-1 ml-2 mr-2">
                                <div class="progress-bar bg-info" id="nsw_progress_bar" role="progressbar"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                            <div class="row mt-3 pl-2 pr-2">
                                <div class="col-md-4 text-left font-weight-bold">WA</div>
                                <div class="col-md-4 text-center" id="wa_total_user"></div>
                                <div class="col-md-4 text-right"><span id="wa_user_per"></span>%<i
                                        class="fas fa-arrow-up" id="wa_up_arrow" style="color: #2adda6;"><i
                                            class="fas fa-arrow-down" id="wa_down_arrow" style="color: #f9365c;"></i></i>
                                </div>
                            </div>
                            <div class="progress progress-sm mt-1 ml-2 mr-2">
                                <div class="progress-bar bg-info" id="wa_progress_bar" role="progressbar"
                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                            <div class="row mt-3 pl-2 pr-2">
                                <div class="col-md-4 text-left font-weight-bold">VIC</div>
                                <div class="col-md-4 text-center" id="vic_total_user"></div>
                                <div class="col-md-4 text-right"><span id="vic_user_per"></span>%<i
                                        class="fas fa-arrow-up" id="vic_up_arrow" style="color: #2adda6;"></i><i
                                        class="fas fa-arrow-down" id="vic_down_arrow" style="color: #f9365c;"></i></div>
                            </div>
                            <div class="progress progress-sm mt-1 ml-2 mr-2">
                                <div class="progress-bar bg-info" id="vic_progress_bar" role="progressbar"
                                    aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="row mt-2 pl-2 pr-2">
                                <div class="col-md-4 text-left font-weight-bold">TAS</div>
                                <div class="col-md-4 text-center" id="tas_total_user"></div>
                                <div class="col-md-4 text-right"><span id="tas_user_per"></span>%<i
                                        class="fas fa-arrow-up" id="tas_up_arrow" style="color: #2adda6;"></i><i
                                        class="fas fa-arrow-down" id="tas_down_arrow" style="color: #f9365c;"></i></div>
                            </div>
                            <div class="progress progress-sm mt-1 ml-2 mr-2">
                                <div class="progress-bar bg-info" id="tas_progress_bar" role="progressbar"
                                    aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="row mt-2 pl-2 pr-2">
                                <div class="col-md-4 text-left font-weight-bold">SA</div>
                                <div class="col-md-4 text-center" id="sa_total_user"></div>
                                <div class="col-md-4 text-right"><span id="sa_user_per"></span>%<i
                                        class="fas fa-arrow-up" id="sa_up_arrow" style="color: #2adda6;"></i><i
                                        class="fas fa-arrow-down" id="sa_down_arrow" style="color: #f9365c;"></i></div>
                            </div>
                            <div class="progress progress-sm mt-1 ml-2 mr-2">
                                <div class="progress-bar bg-info" id="sa_progress_bar" role="progressbar"
                                    aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="row mt-2 pl-2 pr-2">
                                <div class="col-md-4 text-left font-weight-bold">ACT</div>
                                <div class="col-md-4 text-center" id="act_total_user"></div>
                                <div class="col-md-4 text-right"><span id="act_user_per"></span>%<i
                                        class="fas fa-arrow-up" id="act_up_arrow" style="color: #2adda6;"></i><i
                                        class="fas fa-arrow-down" id="act_down_arrow" style="color: #f9365c;"></i></div>
                            </div>
                            <div class="progress progress-sm mt-1 ml-2 mr-2">
                                <div class="progress-bar bg-info" id="act_progress_bar" role="progressbar"
                                    aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="row mt-2 pl-2 pr-2">
                                <div class="col-md-4 text-left font-weight-bold">NT</div>
                                <div class="col-md-4 text-center" id="nt_total_user"></div>
                                <div class="col-md-4 text-right"><span id="nt_user_per"></span>%<i
                                        class="fas fa-arrow-up" id="nt_up_arrow" style="color: #2adda6;"></i><i
                                        class="fas fa-arrow-down" id="nt_down_arrow" style="color: #f9365c;"></i></div>
                            </div>
                            <div class="progress progress-sm mt-1 ml-2 mr-2 mb-4">
                                <div class="progress-bar bg-info" id="nt_progress_bar" role="progressbar"
                                    aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card p-2">
                        <div class="card-title text-white font-weight-bold ml-2">User Information</div>

                        <div class="row mt-3 pr-2 pl-2">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="numbers">
                                            <h4 class="card-title text-white font-weight-bold"
                                                style="font-size: 17px !important;">{{ $data['averageFemaleCount'] }}%
                                            </h4>
                                            <p class="card-category font-weight-bold"
                                                style="color: #81c5c7; font-size: 16px;">Women</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 p-0">
                                        <div id="circles-1"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="numbers">
                                            <h4 class="card-title text-white font-weight-bold"
                                                style="font-size: 17px !important;">{{ $data['averageMaleCount'] }}%</h4>
                                            <p class="card-category font-weight-bold"
                                                style="color: #81c5c7; font-size: 16px;">Men</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 p-0">
                                        <div id="circles-2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-title text-white font-weight-bold ml-2 mt-3">Average Age</div>

                        <div class="row text-center">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <div class="card-title text-white font-weight-bold mt-3 mb-3"
                                    style="background: #81c5c7; border-radius: 100px; padding: 5px;">
                                    {{ $data['totalAge'] }} Years Old</div>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-js')
    <script>
        var feMaleCount = "{{ $data['averageFemaleCount'] }}"
        var maleCount = "{{ $data['averageMaleCount'] }}";
        var ajax = "{{ route('admin.user-location-ajax') }}";
        var avgSalary = "{{ url('admin/get-salary-range') }}";
    </script>
    <script src="{{ asset('assets/js/admin/dashboard/admin-dashboard.js') }}?time={{ time()}}"></script>
    <script src="{{ asset('assets/js/admin/bootstrap-select.min.js') }}"></script>

@endsection

