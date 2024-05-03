@extends('layouts.admin-master')
@section('page-css')
@endsection
@section('content')
    <style>
        .faqWrapper {
            background: #aad6d6;
            border-radius: 10px;
        }
    </style>
    <div class="main-panel">
        <div class="content">
            <div class="pageBreadcrum"><span><a href="{{ route('admin.dashboard') }}">Home</a></span> / Subscription
                Management</div>
            <div class="faqWrapper p-4 mt-5 p-4 mb-4">
                <div class="row">
                    <div class="col-md-2 d-flex align-items-center firstFilter">
                        <h2 class="text-white font-weight-bold">Subscription List</h2>
                    </div>
                    <div class="col-md-5"></div>
                    <div class="col-md-3 searchBM">
                        {{-- <div class="input-icon">
                            <input type="text" class="form-control search-statement" placeholder="Search"
                                style="border: none">
                            <span class="input-icon-addon">
                                <i class="fa fa-search" style="color: #ff8c13;"></i>
                            </span>
                        </div> --}}
                    </div>
                    <div class="col-md-2 add-btn state-btn">
                        {{-- <button type="button"></button> --}}
                        <a href="javascript:void(0)" class="anchorBtn add-btn-modal m-0 addskillBtn" data-bs-toggle="modal"
                            data-bs-target="#add-subscription-modal">Add a Plan</a>
                    </div>

                    <div class="col-md-12">
                        <div class="tab-content mt-2 mb-3 float-left w-100" id="">
                            <div class="tab-pane fade active show" id="" role="tabpanel"
                                aria-labelledby="pills-home-tab">
                                <div class="row">
                                    <div class="col-md-12 state">
                                        <div class="row">
                                            <div class="col-md-12 table-responsive state-table user-list-tbl">
                                                <table
                                                    class="table mt-3 text-center text-white tableMobile statement-table ">
                                                    <thead>
                                                        <tr style="color: #3a8081;">
                                                            <th scope="col">S.No.</th>
                                                            <th scope="col">Plan Name</th>
                                                            <th scope="col">Plan Price</th>
                                                            <th scope="col">Description</th>
                                                            <th scope="col">Status</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if ($subscriptionLists->isNotEmpty())
                                                            @foreach ($subscriptionLists as $subscriptionList)
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>{{ $subscriptionList->plan_name }}</td>
                                                                    <td>{{ $subscriptionList->price }}</td>
                                                                    <td>{{ Str::words($subscriptionList->description, $words = 8, '...') }}
                                                                    </td>
                                                                    <td>
                                                                        <label class="switch">
                                                                            <input type="checkbox" class="recruiter-status"
                                                                                data-id="57" data-val="0">
                                                                            <span class="slider round"></span>
                                                                        </label>
                                                                    </td>
                                                                    <td>
                                                                        <div class="img-div">
                                                                            <img src="http://127.0.0.1:8000/assets/img/editjob.png"
                                                                                data-id="{{ $subscriptionList->id }}"
                                                                                class="jobDelete edit-subscription action-icon"
                                                                                {{-- data-bs-target="#Update-subscription-modal" --}}
                                                                                style="cursor: pointer">

                                                                            <img src="http://127.0.0.1:8000/assets/img/deletejob.png"
                                                                                data-id="1"
                                                                                class="jobDelete delete-statement action-icon"
                                                                                onclick="deleteSubscription({{ $subscriptionList->id }})"
                                                                                style="cursor: pointer">
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            <tr>
                                                                <td colspan="6">No Record Found</td>
                                                            </tr>
                                                        @endif
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

                {{-- Model Add SubScription Start --}}
                <div class="modal" id="add-subscription-modal" tabindex="-1" data-backdrop="static" role="dialog"
                    data-keyboard="false">
                    <div class="modal-dialog">
                        <div class="bg">
                            <div class="modal-content">
                                <div class="modal-header modalHeader pb-0">
                                    <div class="row">
                                        <div class="col-md-5" id="edit-close">Add Subscription</div>
                                        <button type="button" class="close my-close" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                                            <span class="close-btn" aria-hidden="true">
                                                &times;
                                            </span>
                                        </button>
                                    </div>
                                </div>
                                <form id="subscription-form" name="subscription-form">
                                    @csrf
                                    {{-- <input type="hidden" id="id" name="id"> --}}
                                    <div class="modal-body">
                                        <div class="row pr-3 pl-3">
                                            <div class="col-md-12 pl-0 pr-0">
                                                <div class="form-group">
                                                    <input type="text" class="form-control skill-input" name="plan_name"
                                                        id="plan_name" placeholder="Enter Plan Name">
                                                    <p></p>
                                                    {{-- <span class="text-danger parsley-required title-error-statement"
                                                        id="plan-error">{{ $errors->first('title') }}</span> --}}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row pr-3 pl-3">
                                            <div class="col-md-12 pl-0 pr-0">
                                                <div class="form-group type-title-space">
                                                    <span class="typeTitle">Plan Type :</span>
                                                    <div class="titleTypeWrapper ml-3">
                                                        <input class="business" type="radio" name="plan_type"
                                                            id="monthly" value="monthly" required checked
                                                            data-parsley-required-message="Please Select Type"
                                                            data-parsley-errors-container='#type_error'>

                                                        <label for="monthly "></label>
                                                        <span class="ml-1">Monthly </span>

                                                        <input class="lifestyle ml-3" type="radio" name="plan_type"
                                                            id="yearly" value="yearly">
                                                        <label for="yearly"></label><span class="ml-1">Yearly</span>
                                                    </div>
                                                    <p></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row pr-3 pl-3">
                                            <div class="col-md-12 pl-0 pr-0">
                                                <div class="form-group">
                                                    <input type="Integer" class="form-control skill-input"
                                                        name="plan_price" id="plan_price" placeholder="Enter Plan Price">
                                                    <p></p>
                                                    {{-- <span class="text-danger parsley-required title-error-statement"
                                                        id="plan_price-error">{{ $errors->first('plan_price') }}</span> --}}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row pr-3 pl-3">
                                            <div class="col-md-12 pl-0 pr-0">
                                                <div class="form-group">
                                                    <textarea class="form-control" name="plan_description" id="plan_description" placeholder="Description"
                                                        rows="4"></textarea>
                                                    <p></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-action m-3">
                                                    <button type="button" class="button save-btn"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-action m-3">
                                                    {{-- <button id="myButton" class="button save-btn">Cancel</button> --}}
                                                    {{-- <button type="button" class="button save-btn"
                                                        data-bs-dismiss="modal">Close</button> --}}
                                                    <button type="submit" class="postJobBtn save-btn border-0">Add
                                                        Plan</button>
                                                    {{-- <input type="submit" name="submit"
                                                        class="postJobBtn save-btn border-0" value="Add Plan"> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Model Add SubScription End --}}

                {{-- Model Update SubScription Start --}}
                <div class="modal" id="Update-subscription-modal" tabindex="-1" data-backdrop="static" role="dialog"
                    data-keyboard="false">
                    <div class="modal-dialog">
                        <div class="bg">
                            <div class="modal-content">
                                <div class="modal-header modalHeader pb-0">
                                    <div class="row">
                                        <div class="col-md-5" id="edit-close">Update Subscription</div>
                                        <button type="button" class="close my-close" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                                            <span class="close-btn" aria-hidden="true">
                                                &times;
                                            </span>
                                        </button>
                                    </div>
                                </div>
                                <form id="updateSubscription-form" method="PUT" action="{{'update-subscription'}}">
                                    @csrf
                                    <input type="hidden" id="subs_id" name="subs_id">
                                    <div class="modal-body">
                                        <div class="row pr-3 pl-3">
                                            <div class="col-md-12 pl-0 pr-0">
                                                <div class="form-group">
                                                    <input type="text" class="form-control skill-input"
                                                        name="get_plan_name" id="get_plan_name" placeholder="Enter Plan Name"
                                                        >
                                                    <p></p>
                                                    {{-- <span class="text-danger parsley-required title-error-statement"
                                                        id="title-error">{{ $errors->first('title') }}</span> --}}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row pr-3 pl-3">
                                            <div class="col-md-12 pl-0 pr-0">
                                                <div class="form-group type-title-space">

                                                    <span class="typeTitle">Plan Type :</span>

                                                    <div class="titleTypeWrapper ml-3">
                                                        <input class="business" type="radio" name="plan_type"
                                                            id="monthly" value="1" placeholder="Address" required
                                                            checked data-parsley-required-message="Please Select Type"
                                                            data-parsley-errors-container='#type_error'><label
                                                            for="monthly "></label><span class="ml-1">Monthly </span>

                                                        <input class="lifestyle ml-3" type="radio"
                                                            name="plan_type" id="yearly" value="2"><label
                                                            for="yearly"></label><span class="ml-1">Yearly</span>
                                                    </div>
                                                    <p></p>

                                                    {{-- <span id="type_error" class="text-danger"></span> --}}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row pr-3 pl-3">
                                            <div class="col-md-12 pl-0 pr-0">
                                                <div class="form-group">
                                                    <input type="Integer" class="form-control skill-input"
                                                        name="get_plan_price" id="get_plan_price" placeholder="Enter Plan Price">
                                                    <p></p>
                                                    {{-- <span class="text-danger parsley-required title-error-statement"
                                                        id="title-error">{{ $errors->first('title') }}</span> --}}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row pr-3 pl-3">
                                            <div class="col-md-12 pl-0 pr-0">
                                                <div class="form-group">
                                                    <textarea class="form-control" name="get_plan_description" id="get_plan_description" placeholder="Description"
                                                        rows="4"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-action m-3">
                                                    {{-- <button id="myButton" class="button save-btn">Cancel</button> --}}
                                                    <button type="button" class="button save-btn"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-action m-3">
                                                    {{-- <button id="myButton" class="button save-btn">Cancel</button> --}}
                                                    {{-- <button type="button" class="button save-btn"
                                                        data-bs-dismiss="modal">Close</button> --}}
                                                    <input type="submit" name="submit"
                                                        class="postJobBtn save-btn border-0" value="Update">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Model Update SubScription End --}}
            </div>
        </div>
    </div>
@endsection

@section('page-js')
    <script>
        var storeSubscribe = `{{ route('admin.subscribe.store') }}`;
        var Subscribe = `{{ route('admin.subscription') }}`;
        var subscribeDelete = `{{ route('admin.subscribe.delete') }}`
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/js/admin/business/subscribe.js') }}"></script>
@endsection
