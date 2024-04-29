@extends('layouts.admin-master')
@section('page-css')
@endsection
@section('content')


<div class="main-panel">
    <div class="content">
        <div class="pageBreadcrum"><span><a href="{{ route('admin.dashboard') }}">Home</a></span> / User Management</div>
        <div class="faqWrapper p-4 mt-5">
            <div class="row">
                <div class="col-md-2 d-flex align-items-center firstFilter">
                    <h2 class="text-white font-weight-bold">User List</h2>
                </div>
                <div class="col-md-3 searchBM">
                    <div class="input-icon">
                        <input type="text" class="form-control search-user" placeholder="Search">
                        <span class="input-icon-addon">
                            <i class="fa fa-search" style="color: #ff8c13;"></i>
                        </span>
                    </div>
                </div>
                <div class="col-md-2 SecondFilter fifthFilter">
                    <div class="row">
                        <div class="col-md-6 selectBG">
                            <label class="selectLable">Industry</label>
                        </div>
                        <div class="col-md-6 pl-0">
                            <select class="form-control form-control industry-type" id="defaultSelect">
                                <option value="">All</option>
                                @foreach($industries as $industry)
                                <option value="{{$industry->id}}">{{$industry->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-2 thirdFilter">
                    <div class="row">
                        <div class="col-md-6 selectBG">
                            <label class="selectLable">Location</label>
                        </div>
                        <div class="col-md-6 p-0">
                            <select class="form-control form-control cus-op-left" id="defaultSelect">
                                <option value="">All</option>
                              <option  value="Australian Capital Territory">ACT</option>
                                <option  value="New South Wales">NSW</option>
                                <option  value="Northern Territory">NT</option>
                                <option  value="South Australia">SA</option>
                                <option  value="Victoria">VIC</option>
                                <option  value="Queensland QLD">QLD</option>
                                <option  value="Tasmania">TAS</option>
                                <option  value="Western Australia">WA</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 forthFilter">
                    <ul class="nav nav-pills nav-secondary pannelCMS float-right" id="pills-tab" role="tablist">
                        <li class="nav-item submenu m-0">
                            <a style="padding: 12px 50px" class="nav-link active show firstPannel" data-id="1" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">A-Z</a>
                        </li>
                        <li class="nav-item submenu m-0">
                            <a class="nav-link secondPannel" data-id="2" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Most recent</a>
                        </li>
                    </ul>
                </div>


                <div class="col-md-12">
                    <div class="tab-content mt-2 float-left w-100" id="pills-tabContent">
                        <div class="tab-pane fade active show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12 table-responsive user-list-tbl p-0">
                                            <table class="table mt-3 text-center text-white tableMobile user-table user-listtable">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Location</th>
                                                        <th scope="col">Matches</th>
                                                        <th scope="col">Industry</th>
                                                        <th scope="col">Gender</th>
                                                        <th scope="col">Age</th>
                                                        <th scope="col">Block</th>
                                                        <th scope="col">Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
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

    <div class="modal font-opensans" id="userViewResume" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="bg">
                <div class="modal-content">
                    <div class="modal-header modalHeader pb-0 modal-head-relative">
                        <div class="row">
                            <div class="col-md-5">View Resume</div>
                            <button type="button" class="close my-close" data-dismiss="modal" id="resumeClose" value="" aria-label="Close">
                                <span class="close-btn" aria-hidden="true">
                                    &times;
                                </span>
                            </button>
                        </div>

                    </div>
                    <div class="modal-body">
                        <div class="row pr-3 pl-3">
                            <div class="show-resume">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- cover letter -->

    <div class="modal font-opensans" id="userDetailsCoverLetter" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="bg">
                <div class="modal-content">
                    <div class="modal-header modalHeader pb-0">
                        <div class="row">
                            <div class="col-md-5">View cover letter</div>
                            <button type="button" class="close my-close" id="coverLetterClose" value="" data-dismiss="modal" aria-label="Close">
                                <span class="close-btn" aria-hidden="true">
                                    &times;
                                </span>
                            </button>

                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row pr-3 pl-3">
                            <div class="show-cover-letter">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- portfolio -->

    <div class="modal font-opensans" id="userDetailsPortfolio" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="bg">
                <div class="modal-content">
                    <div class="modal-header modalHeader pb-0">
                        <div class="row">
                            <div class="col-md-5">View Portfolio</div>
                            <button type="button" class="close my-close" id="portfolioClose" value="" data-dismiss="modal" aria-label="Close">
                                <span class="close-btn" aria-hidden="true">
                                    &times;
                                </span>
                            </button>

                        </div>
                    </div>
                    <div class="modal-body scrollable-modal">

                        <div class="show-portfolio">


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- video -->

    <div class="modal font-opensans" id="userDetailsVideo" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="bg">
                <div class="modal-content">
                    <div class="modal-header modalHeader pb-0">
                        <div class="row">
                            <div class="col-md-5">View Video</div>
                            <button type="button" class="close my-close" id="videoClose" value="" data-dismiss="modal" aria-label="Close">
                                <span class="close-btn" aria-hidden="true">
                                    &times;
                                </span>
                            </button>

                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row pr-3 pl-3">
                            <div class="show-video">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="applicantViewDetails" class="applicantViewDetails" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog cus-ad-modal custom-appuser-dialog">
            <div class="bg">
                <div class="modal-content">
                    <div class="modal-header modalHeader pb-0">
                        <div class="row">
                            <div class="col-md-12 posTop">
                                <div class="profile-header1">
                                    <input type="hidden" value="" id="profailID">
                                    <img src="" class="userDetailImg" width="100">
                                    <div class="userHeaderData">
                                        <h4 class="modal-title card-title font-4188ab user-name"></h4>
                                        <span class="modalSubTitle modalSubTitleGreenLight user-location"></span>
                                        <span class="modalSubTitle modalSubTitleWhite user-email mb-2"></span>
                                        <span class="action-button"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 pull-right text-right positionTopHeader view-user-details">
                                
                            </div>
                            <button type="button" class="close my-close cus-btn-close"  value="" data-dismiss="modal" aria-label="Close">
                                <span class="close-btn" aria-hidden="true">
                                    &times;
                                </span>
                            </button>
                        </div>
                    </div>

                    <div class="modal-body">
                        <div class="row pt-2 pl-4 pr-4 ">
                            <div class="col-md-6">
                                <div class="jobDetailPopDate">
                                <div class="job-upsection">
                                    <div class="jobPopTitleBox uptitle-modal">Type Of Work:</div>&nbsp;
                                    <span class="user-job-work"></span> 
                                </div>
                                    <div class="job-upsection">
                                    <div class="jobPopTitleBox uptitle-modal">Salary expectation: </div>&nbsp;
                                    <span class="user-job-salary"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 pull-right text-right">
                                <div class="jobDetailPopDate">
                                  <div class="job-upsection">
                                    <div class="jobPopTitleBox uptitle-modal">Date of Birth:</div>&nbsp;
                                     <span class="user-dob"></span>
                                     </div>

                                </div>
                            </div>
                        </div>
                        <div class="row  pl-4 pr-4 pb-2">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="jobPopDesc">
                                            <p class="jobPopTitleBox">Executive Summary</p>
                                            <div class="jobPopDescBox user-summary"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="jobPopDesc">
                                            <p class="jobPopTitleBox">Experience</p>
                                            <div class="jobPopDescBox">
                                                <ul class="user-experience">
                                                    <li>5 Years Experience</li>
                                                    <li>Lorem Ipsum</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="jobPopDesc">
                                            <p class="jobPopTitleBox">Education</p>
                                            <div class="jobPopDescBox">
                                                <ul class="user-education">

                                                </ul>
                                            </div>
                                            <p class="jobPopTitleBox" style="margin-top: 20px">Certification</p>
                                            <div class="jobPopDescBox">
                                                <ul class="user-certificate">

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 applicantDetailRight">
                                <div class="jobPopDesc">
                                    <p class="jobPopTitleBox">Skills</p>
                                    <div class="jobPopDescBox applicantSkills">
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
<script>
    var storeUser = `{{ route('admin.app-users.store') }}`;
    var users = `{{ route('admin.app-users.index') }}`;
    var viewUserProfile = `{{ route('admin.get-user-profile') }}`;
</script>
<script src="{{ asset('assets/js/admin/appUser/user.js') }}"></script>
@endsection