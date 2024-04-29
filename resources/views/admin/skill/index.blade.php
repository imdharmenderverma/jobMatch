@extends('layouts.admin-master')
@section('page-css')
<style>
    .select2-container--default .select2-results>.select2-results__options {
        max-height: 145px;
    }
</style>
@endsection
@section('content')
<div class="main-panel">
    <div class="content">
        <div class="pageBreadcrum"><span><a href="{{ route('admin.dashboard') }}">Home</a></span> / Skill Management</div>
        <div class="faqWrapper p-4 mt-5 mb-4">
            <div class="row">
                <div class="col-md-2 d-flex align-items-center firstFilter">
                    <h2 class="text-white font-weight-bold">Skill List</h2>
                </div>
                <div class="col-md-5"></div>
                <div class="col-md-3 searchBM" style="margin-left: 81px;">
                    <div class="input-icon">
                        <input type="text" style="height: 41px !important;" class="form-control search-skill search-industry search-statement" placeholder="Search">
                        <span class="input-icon-addon">
                            <i class="fa fa-search" style="color: #ff8c13;"></i>
                        </span>
                    </div>
                </div>
                <div class="add-btn state-btn">
                    <a href="javascript:void(0)" class="anchorBtn add-btn-modal skill-btn addskillBtn">Add Skill</a>
                </div>

                <div class="col-md-12">
                    <div class="tab-content mt-2 mb-3 float-left w-100" id="pills-tabContent">
                        <div class="tab-pane fade active show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12 table-responsive user-list-tbl state-table">
                                            <table class="table mt-3 text-center text-white tableMobile skill-table ">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" style="width: 45px;">Sr No.</th>
                                                        <th scope="col">Skill</th>
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

            <div class="modal" id="add-skill-modal" tabindex="-1" data-backdrop="static" role="dialog" data-keyboard="false">
                <div class="modal-dialog skill-modal">
                    <div class="bg edit-skill-main">
                        <div class="modal-content">
                            <div class="modal-header modalHeader pb-0">
                                <div class="row">
                                    <div class="col-md-5" id="edit-close m-0">Add Skill </div>
                                    <button type="button" class="close my-close" data-dismiss="modal" aria-label="Close">
                                        <span class="close-btn" aria-hidden="true">
                                            &times;
                                        </span>
                                    </button>
                                </div>
                            </div>
                            <form id="skill-form" method="POST">
                                <input type="hidden" id="id" name="id">
                                <div class="modal-body">
                                    <div class="row pr-3 pl-3">
                                        <div class="col-md-12 pl-0 pr-0">
                                            <div class="form-group create-acc-select multi-skill">
                                                <select class="form-control cus-select2" name="industry_id[]" id="industry_id" multiple>
                                                    @foreach ($industries as $data)
                                                    <optgroup label="{{$data->title}}">
                                                        @foreach($data->childrens as $child)
                                                        <option value="{{$child->id}}">{{$child->title}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger parsley-required industry-error" id="industry-error">{{ $errors->first('industry_id[]') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-12 pl-0 pr-0">
                                            <div class="form-group">
                                                <input type="text" class="form-control skill-input new-skill-input" name="title" id="title" placeholder="Enter Skill Name">
                                                <span class="text-danger parsley-required title-error-skil" id="title-error">{{ $errors->first('title') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-action m-3">
                                               <button id="myButton" class="button save-btn" >Save</button>
                                                {{-- <input type="submit" name="submit" class="  button" id="myButton" value="Save"> --}}
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
    var storeSkill = `{{ route('admin.skill.store') }}`;
    var skills = `{{ route('admin.skill.index') }}`;
</script>
<script src="{{ asset('assets/js/admin/business/skill.js') }}"></script>
@endsection