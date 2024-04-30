<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.header')
    @yield('page-css')
</head>
@php
    $id = '';
    if (request()->is('recruiter/jobs')) {
        $id = 'cms_um';
    }
@endphp

<style>
    .button-post {
        background: #fd7212;
        color: #fff;
        font-size: 14px !important;
        text-align: center;
        padding: 5px !important;
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

    .button-post.loading {
        background-color: #fd7212;
        padding-right: 40px;
    }

    .button-post.loading:after {
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

    @keyframes spin {
        to {
            transform: rotate(359deg);
        }
    }

    @keyframes grow {
        to {
            width: 14px;
            height: 14px;
            margin-top: -8px;
            right: 13px;
        }
    }
</style>

<body class="font-opensans" id="{{ $id }}">
    <div class="wrapper">
        @include('layouts.inner-header')
        @include('layouts.front.sidebar')
        @yield('content')

        <div class="modal font-opensans" id="jobDetails" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="bg">
                    <div class="modal-content">
                        <div class="modal-header modalHeader pb-0">
                            <div class="row">
                                <div class="col-md-8">
                                    <h4 class="modal-title card-title font-4188ab" id="job_title_view"></h4>
                                    <span class="modalSubTitle modalSubTitleGreen" id="job_work_view"></span>
                                    <span class="modalSubTitle modalSubTitleGreenLight" id="location_view"></span>
                                </div>
                                <div class="col-md-4 pull-right text-right">
                                    <div class="jobStatusIcon" id="status_view">

                                    </div>
                                    <button type="button" class="close my-close" data-dismiss="modal"
                                        aria-label="Close">
                                        <span class="close-btn" id="close_btn" aria-hidden="true">
                                            &times;
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body p-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="jobDetailPopDate ml-4 mr-4">
                                        <div class="jobDetailPopDateTitle" id="start_date_format"></div>
                                        <div class="jobDetailPopDateSubTitle"> <span id="post_date_format"></span><span
                                                id="end_date_format"></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="main-div-scroll-bar">
                                        <div class="jobPopDesc min-height-cus-class">
                                            <p class="jobPopTitleBo">Job Description</p>
                                            <div class="jobPopDescBox" id="description-view">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="jobPopDesc min-height-cus-class">
                                        <p class="jobPopTitleBox">Requirements</p>
                                        <div class="jobPopDescBox">
                                            <ul id="requirement-view">

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="jobPopDesc min-height-cus-class">
                                        <p class="jobPopTitleBox">Questions</p>
                                        <div class="jobPopDescBox">
                                            <ul id="question-view">

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row availableApplicantsWrapper">
                                <div class="col-md-6 pl-1">
                                    <div class="availableApplicants"></div>
                                </div>
                                <div class="col-md-6 pull-right text-right">
                                    <div class="availableFilter form-group">
                                        <span>Filter By:</span>
                                        <select class="form-control">
                                            <option value="Most Compatible">Most Compatible</option>
                                            <option value="Newest - Oldest">Newest - Oldest</option>
                                            <option value="Oldest - Newest">Oldest - Newest</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row availableCandidates">

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="suitableApplicants">Suitable Candidates</div>
                                </div>
                            </div>
                            <div class="row suitableCandidates">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- resume -->
        <div class="modal font-opensans" id="jobDetailsResume" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="bg">
                    <div class="modal-content">
                        <div class="modal-header modalHeader pb-0">
                            <div class="row">
                                <div class="col-md-5">View Resume</div>
                                <button type="button" class="close my-close" data-dismiss="modal" aria-label="Close">
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

        <div class="modal font-opensans" id="jobDetailsCoverLetter" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="bg">
                    <div class="modal-content">
                        <div class="modal-header modalHeader pb-0">
                            <div class="row">
                                <div class="col-md-5">View cover letter</div>
                                <button type="button" class="close my-close" data-dismiss="modal"
                                    aria-label="Close">
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

        <div class="modal font-opensans" id="jobDetailsPortfolio" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="bg">
                    <div class="modal-content">
                        <div class="modal-header modalHeader pb-0">
                            <div class="row">
                                <div class="col-md-5">View Portfolio</div>
                                <button type="button" class="close my-close" data-dismiss="modal"
                                    aria-label="Close">
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

        <div class="modal font-opensans" id="jobDetailsVideo" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="bg">
                    <div class="modal-content">
                        <div class="modal-header modalHeader pb-0">
                            <div class="row">
                                <div class="col-md-5">View Video</div>
                                <button type="button" class="close my-close" data-dismiss="modal"
                                    aria-label="Close">
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


        <div class="modal modal-overflow" id="addNewJob" tabindex="-1" data-backdrop="static" role="dialog"
            data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog job-modal">
                <form id="job-form" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id" value="">
                    <input type="hidden" name="latitude" id="latitude" value="">
                    <input type="hidden" name="longitude" id="longitude" value="">
                    <div class="bg">
                        <div class="modal-content">
                            <div class="modal-header modalHeader pb-0 remove-pb position-relative">
                                <button type="button" class="close my-close my-close-new" data-dismiss="modal"
                                    aria-label="Clxose">
                                    <span class="close-btn" aria-hidden="true">
                                        &times;
                                    </span>
                                </button>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group create-acc-select sizing-add-job custom-align-left">
                                            <input type="text" class="form-control" id="role_name"
                                                name="role_name" placeholder="Role Name:" maxlength="25">
                                            <span class="text-danger parsley-required" id="role-name-error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group create-acc-select sizing-add-job">
                                            <input type="text" class="form-control" id="company_name"
                                                name="company_name" placeholder="Company Name:" maxlength="25">
                                            <span class="text-danger parsley-required" id="company-name-error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button id="myButton" class="button-post save-btn mb-1">Post Job</button>
                                        {{-- <button id="" class="button-post save-btn">Back</button> --}}
                                        <button type="button" class="button-post save-btn"
                                            data-dismiss="modal" aria-label="Clxose" style="background: #0d8282">
                                            Back
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-body modal-tabl-cus">
                                <div class="row pr-3 pl-3">

                                    <div class="col-md-4 pl-0 pr-0">
                                        <div class="form-group sizing-add-job work-exp-pad">
                                            <input type="text" class="form-control   sizing-add-job"
                                                name="experience" id="experience" maxlength="50"
                                                placeholder="Work Experience">
                                            <span class="text-danger parsley-required" id="experience-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-4 pl-0 pr-0">
                                        <div class="form-group sizing-add-job">
                                            <input type="hidden" id="state" name="address_state"
                                                class="address_state">
                                            <input type="text" class="form-control" id="location"
                                                name="location" placeholder="Location:" maxlength="100">
                                            <span class="text-danger form-text parsley-required"
                                                id="location-error"></span>
                                        </div>

                                        <div class="">
                                            <div style="display:none;" id="divAddLocation"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 pl-0 pr-0">
                                        <div class="form-group sizing-add-job">
                                            <input type="text" class="form-control" id="start_date"
                                                name="start_date" autocomplete="off" placeholder="Start Date:"
                                                maxlength="25" onkeydown="return false;">
                                            <span class="text-danger parsley-required" id="start-date-error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pr-3 pl-3">
                                    <div class="col-md-4 pl-0 pr-0">
                                        <div class="form-group create-acc-select sizing-add-job">
                                            <select class="form-control" name="type_of_work" id="type_of_work">
                                                <option value="">Type of Work</option>
                                                @foreach ($workTypes as $type)
                                                    <option value="{{ $type['id'] }}">{{ $type['name'] }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger parsley-required" id="type-of-work-error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 pl-0 pr-0">
                                        <div class="form-group create-acc-select sizing-add-job">

                                            <select class="form-control" id="industry" name="industry"
                                                maxlength="25">
                                                @foreach ($industries as $data)
                                                    <optgroup label="{{ $data->title }}">
                                                        @foreach ($data->childrens as $child)
                                                            <option value="{{ $child->id }}">{{ $child->title }}
                                                            </option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>
                                            <span class="text-danger parsley-required" id="industry-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-4 pl-0 pr-0">
                                        <div class="form-group sizing-add-job">
                                            <input type="text" class="form-control" id="end_date"
                                                name="end_date" autocomplete="off" placeholder="Closing Date:"
                                                maxlength="25" onkeydown="return false;">
                                            <span class="text-danger parsley-required close-error"
                                                id="end-date-error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pr-3 pl-3">
                                    <div class="col-md-4 pl-0 pr-0">
                                        <div class="form-group sizing-add-job">
                                            <textarea style="height: 225px !important; resize: none;" class="form-control" id="description" name="description"
                                                placeholder="Job Description" maxlength="300"></textarea>
                                            <span class="text-danger parsley-required" id="description-error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 pl-0 pr-0">
                                        <div class="form-group sizing-add-job">
                                            <textarea style="height: 225px !important; resize: none;" class="form-control" id="requirement" name="requirement"
                                                placeholder="Requirements" maxlength="300"></textarea>
                                            <span class="text-danger parsley-required" id="requirement-error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 pl-0 pr-0">
                                        <div class="form-group sizing-add-job">
                                            <input type="text" class="form-control" maxlength="50"
                                                id="salary_range" name="salary_range" placeholder="Salary Range:">
                                            <span class="text-danger parsley-required" id="salary-range-error"></span>
                                        </div>
                                        <div class="addQuestion cus-addquestion">
                                            <div class="main-div-add-question-scroll-bar">
                                                <div class="questionTitle">Questions</div>
                                                <div class="row question-div question-box">
                                                    <div class="col-md-8 row1 main-row " data-id="1">
                                                        <input type="text"
                                                            class="form-control questionBox job-question"
                                                            name="question_1[]" id="question-1-1"
                                                            placeholder="Question" maxlength="300">
                                                        <span class="text-danger" id="question-1-1-error"></span>
                                                    </div>
                                                    <div class="col-md-4 addQesWrapper row1">
                                                        <div class="addQes">+</div>
                                                    </div>

                                                    <div class="col-md-8 row2 main-row" data-id="2">
                                                        <input type="text"
                                                            class="form-control questionBox job-question"
                                                            name="question_1[]" id="question-1-2"
                                                            placeholder="Question">
                                                        <span class="text-danger" id="question-1-2-error"></span>
                                                    </div>
                                                    <div class="col-md-4 addQesWrapper row2">
                                                        <div class="removeQes" data-id="2">-</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pr-3 pl-3">
                                    <div class="col-md-12 pl-0 pr-0 ">
                                        <div
                                            class="form-group create-acc-select job-skill multi-select-design sizing-add-job cus-clas-height-skill skill-want-design position-relative">


                                            <select class="form-control" multiple id="skill_id" name="skill_id[]">

                                            </select>
                                            <button class="btn addnew-button" type="button" id="add_skill">Add Skill
                                                +</button>
                                            <span class="text-danger parsley-required" id="skill-id-error"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal" id="jobNotes">
            <div class="modal-dialog">
                <div class="bg">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="notesTitle">Your Notes</div>
                            <div class="notesDetails">Lorem Ipsum is simply dummy text of the printing and typesetting
                                industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                when an unknown printer took a galley of type and scrambled. Lorem Ipsum is simply dummy
                                text of the printing and typesetting industry. Lorem Ipsum has been the industry's
                                standard dummy text ever since the 1500s, when an unknown printer took a galley of type
                                and scrambled.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="job-completed-1" tabindex="0" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="bg">
                    <div class="modal-content cus-modal-fulfilled">
                        <div class="modal-header modalHeader pb-0 p-3 d-flex">
                            <div class="modal-left-div-header">
                                <h4 class="modal-title card-title font-4188ab font-opensans">Have you fulfilled this
                                    job position?</h4>
                                <span class="modalSubTitle font-opensans"><i class="fas fa-lock"></i>Your response
                                    won't be shared with anyone on Job Matched.</span>
                            </div>

                            <div class="right-div-close-btn-header">
                                <button type="button" class="close my-close" data-dismiss="modal"
                                    aria-label="Close">
                                    <span class="close-btn" aria-hidden="true">
                                        &times;
                                    </span>
                                </button>
                            </div>
                        </div>
                        <form method="post" id="job-fulfill">
                            <div class="modal-body">
                                <input type="hidden" name="job_full_id" id="job_full_id">
                                <div class="form-group cms_help">
                                    <div class="termsCheckWrapper">
                                        <div class="col-auto">
                                            <label class="colorinput d-flex justify-content-start align-items-center">
                                                <input name="fulfill_status" type="radio" value="1"
                                                    class="colorinput-input fulfill_status" checked>
                                                <span class="colorinput-color bg-primary"></span>
                                                <span class="ml-3 text-white font-opensans mobileDisplayFont">Yes,
                                                    found
                                                    someone on Job Matched</a></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="termsCheckWrapper">
                                        <div class="col-auto">
                                            <label class="colorinput d-flex justify-content-start align-items-center">
                                                <input name="fulfill_status" type="radio" value="2"
                                                    class="colorinput-input fulfill_status">
                                                <span class="colorinput-color bg-primary"></span>
                                                <span class="ml-3 text-white font-opensans">Yes, found someone on
                                                    elsewhere</a></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="termsCheckWrapper">
                                        <div class="col-auto">
                                            <label class="colorinput d-flex justify-content-start align-items-center">
                                                <input name="fulfill_status" type="radio" value="3"
                                                    class="colorinput-input fulfill_status">
                                                <span class="colorinput-color bg-primary"></span>
                                                <span class="ml-3 text-white font-opensans">No, I haven't found anyone
                                                    yet.</a></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="termsCheckWrapper">
                                        <div class="col-auto">
                                            <label class="colorinput d-flex justify-content-start align-items-center">
                                                <input name="fulfill_status" type="radio" value="4"
                                                    class="colorinput-input fulfill_status">
                                                <span class="colorinput-color bg-primary"></span>
                                                <span class="ml-3 text-white font-opensans">Job withdrawn.</a></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-action m-3">
                                            <button type="submit" id="myButton2"
                                                class="btn btn-f4d94a submitBtn popupSubmitBtn">Next</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="job-completed-2" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="bg">
                    <div class="modal-content cus-modal-award">
                        <div class="modal-header modalHeader pb-0 d-flex">
                            <div class="modal-left-div-header">
                                <h4 class="modal-title card-title font-4188ab font-opensans">Award Job</h4>
                                <span class="modalSubTitle font-opensans"><i class="fas fa-lock"></i>Your response
                                    won't be shared with anyone on Job Matched.</span>
                            </div>
                            <div class="right-div-close-btn-header">
                                <button type="button" class="close my-close" data-dismiss="modal"
                                    aria-label="Close">
                                    <span class="close-btn" aria-hidden="true">
                                        &times;
                                    </span>
                                </button>
                            </div>
                        </div>
                        <form method="post" id="job-award">
                            <div class="modal-body">
                                <div class="form-group cms_help completePopup">

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-action m-3">
                                            <button type="submit" id="myButton3"
                                                class="btn btn-f4d94a submitBtn popupSubmitBtn">Done</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="applicantDetails">
            <div class="modal-dialog">
                <div class="bg">
                    <div class="modal-content">
                        <div class="modal-header modalHeader pb-0">
                            <div class="row">
                                <div class="col-md-7 posTop">
                                    <img src="" class="userDetailImg" width="100">
                                    <div class="userHeaderData">
                                        <h4 class="modal-title card-title font-4188ab user-name ml-0"></h4>
                                        <span class="addNotesBtn">Add Notes</span>
                                        <span class="modalSubTitle modalSubTitleWhite user-email mb-2"></span>
                                        <span class="action-button"></span>
                                    </div>
                                </div>
                                <div class="col-md-5 pull-right text-right positionTopHeader view-user-details">
                                </div>
                            </div>
                        </div>

                        <div class="modal-body">
                            <div class="row pt-2 pl-4 pr-4 pb-2">
                                <div class="col-md-6">
                                    <div class="jobDetailPopDate">
                                        <div class="jobDetailPopDateTitle user-job-work"></div>
                                        <div class="jobDetailPopDateTitle">Salary expectation: <span
                                                class="user-job-salary"></span></div>
                                    </div>
                                </div>
                                <div class="col-md-6 pull-right text-right">
                                    <div class="jobDetailPopDate">
                                        <div class="jobDetailPopDateTitle">Date of Birth: <span
                                                class="user-dob"></span></div>
                                        <div class="jobDetailPopDateTitle" style="margin-bottom: 20px">Application
                                            Date: <span class="user-application-date"></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row pt-2 pl-4 pr-4 pb-2">
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="jobPopDesc">
                                                <p class="jobPopTitleBox">Executive Summary</p>
                                                <div class="jobPopDescBox user-summary"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
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
                                        <div class="col-md-3">
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
                                        <div class="col-md-12 marginTop10">
                                            <div class="jobPopDesc">
                                                <p class="jobPopTitleBox">Questions</p>
                                                <div class="jobPopDescBox">
                                                    <b>Question 1</b><br>
                                                    Lorem Ipsum is simply dummy text of the printing and typesetting
                                                    industry. Lorem Ipsum has been the industry's standard dummy text
                                                    ever since the 1500s, when an unknown printer took a galley of type
                                                    and scrambled.<br>
                                                    <b>Question 1</b><br>
                                                    Lorem Ipsum is simply dummy text of the printing and typesetting
                                                    industry. Lorem Ipsum has been the industry's standard dummy text
                                                    ever since the 1500s, when an unknown printer took a galley of type
                                                    and scrambled.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 applicantDetailRight">
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

        <div class="modal fade" id="modelWindow" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-md modal-dialog-centered address-modal">
                <div class="modal-content">
                    <div class="modal-header modalHeader pb-0">
                        <button type="button" class="close my-close" data-dismiss="modal" aria-label="Close">
                            <span class="close-btn" aria-hidden="true">
                                ×
                            </span>
                        </button>
                        <h5 class="title addNewJobHTitle"></h5>
                    </div>
                    <div class="modal-body">
                        <p id="addText" style="word-wrap: break-word;" class="readmore-content"></p>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footer')
        @yield('page-js')
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('#image').bind('change', function() {
        var filename = $("#image").val();
        if (/^\s*$/.test(filename)) {
            $(".bg-choose-main").removeClass('active');
            $("#noFile").text("No file chosen...");
        } else {
            $(".bg-choose-main").addClass('active');
            $("#noFile").text(filename.replace("C:\\fakepath\\", ""));
        }
    });



    // Add a click event listener to the close button
    $(".my-close").on("click", function() {
        $('.job-completed').prop('checked', false);
    });
</script>


</html>
