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
        <div class="pageBreadcrum"><span><a href="{{ route('admin.dashboard') }}">Home</a></span> / Statements Management</div>
        <div class="faqWrapper p-4 mt-5 p-4 mb-4">
            <div class="row">
                <div class="col-md-2 d-flex align-items-center firstFilter">
                    <h2 class="text-white font-weight-bold">Statements List</h2>
                </div>
                <div class="col-md-5"></div>
                <div class="col-md-3 searchBM">
                    <div class="input-icon">
                        <input type="text" class="form-control search-statement" placeholder="Search"  style="border: none">
                        <span class="input-icon-addon">
                            <i class="fa fa-search" style="color: #ff8c13;"></i>
                        </span>
                    </div>
                </div>
                <div class="col-md-2 add-btn state-btn">
                    <a href="javascript:void(0)" class="anchorBtn add-btn-modal m-0 addskillBtn">Add a Statement</a>
                </div>

                <div class="col-md-12">
                    <div class="tab-content mt-2 mb-3 float-left w-100" id="pills-tabContent">
                        <div class="tab-pane fade active show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="row">
                                <div class="col-md-12 state">
                                    <div class="row">
                                        <div class="col-md-12 table-responsive state-table user-list-tbl">
                                            <table class="table mt-3 text-center text-white tableMobile statement-table ">
                                                <thead>
                                                    <tr style="color: #3a8081;">
                                                        <th scope="col">Item</th>
                                                        <th scope="col">Statement Skill Name</th>
                                                        <th scope="col">Soft Skill Type</th>
                                                        <th scope="col">Title</th>
                                                        <th scope="col">Page Number</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal" id="add-statement-modal" tabindex="-1" data-backdrop="static" role="dialog" data-keyboard="false">
                <div class="modal-dialog">
                    <div class="bg">
                        <div class="modal-content">
                            <div class="modal-header modalHeader pb-0">
                                <div class="row">
                                    <div class="col-md-5" id="edit-close">Add Statement</div>
                                    <button type="button" class="close my-close" data-dismiss="modal" aria-label="Close">
                                        <span class="close-btn" aria-hidden="true">
                                            &times;
                                        </span>
                                    </button>
                                </div>
                            </div>
                            <form id="statement-form" method="POST">
                                @csrf
                                <input type="hidden" id="id" name="id">
                                <div class="modal-body">

                                    <div class="col-md-12 pl-0 pr-0">
                                        <div class="form-group create-acc-select">
                                            <select class="form-control cus-select2" name="statement_skill_id" id="statement_skill_id">
                                                <option value="">Select Statement Skill</option>
                                                @foreach ($statementSkill as $skill)
                                                <option value="{{ $skill->id }}">{{ $skill->title }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger parsley-required statement-error-statement" id="statement-error">{{ $errors->first('page_number') }}</span>
                                        </div>
                                    </div>

                                    <div class="row pr-3 pl-3">
                                        <div class="col-md-12 pl-0 pr-0">
                                            <div class="form-group">
                                                <input type="text" class="form-control skill-input" name="title" id="title" placeholder="Enter Title">
                                                <span class="text-danger parsley-required title-error-statement" id="title-error">{{ $errors->first('title') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row pr-3 pl-3">
                                        <div class="col-md-12 pl-0 pr-0">
                                            <div class="form-group type-title-space">

                                                <span class="typeTitle">Type :</span>

                                                <div class="titleTypeWrapper ml-3">
                                                    <input class="business" type="radio" name="soft_skill_type" id="business" value="1" placeholder="Address" required checked data-parsley-required-message="Please Select Type" data-parsley-errors-container='#type_error'><label for="business "></label><span class="ml-1">Professional </span>

                                                    <input class="lifestyle ml-3" type="radio" name="soft_skill_type" id="lifestyle" value="2"><label for="lifestyle"></label><span  class="ml-1">Lifestyle</span>
                                                </div>

                                                <span id="type_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row pr-3 pl-3">
                                        <div class="col-md-12 pl-0 pr-0">
                                            <div class="form-group create-acc-select">
                                                <select class="form-control" name="page_number" id="page_number">
                                                    <option value="">Select</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                                <span class="text-danger parsley-required category-error-statement" id="category-error">{{ $errors->first('page_number') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-action m-3">
                                               <button id="myButton" class="button save-btn">Save</button>
                                                {{-- <input type="submit" name="submit" class="postJobBtn save-btn border-0" value="Save"> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
    var storeStatement = `{{ route('admin.statement.store') }}`;
    var statements = `{{ route('admin.statement.index') }}`;
</script>
<script src="{{ asset('assets/js/admin/business/statement.js') }}"></script>
@endsection
