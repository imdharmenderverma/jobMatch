@extends('layouts.admin-master')
@section('page-css')
@endsection
@section('content')
<div class="main-panel">
    <div class="content">
        <div class="pageBreadcrum"><span><a href="{{ route('admin.dashboard') }}">Home</a></span> / Statement Skill Management</div>
        <div class="faqWrapper p-4 mt-5">
            <div class="row">
                <div class="col-md-3 d-flex align-items-center firstFilter">
                    <h2 class="text-white font-weight-bold">Statement Skill List</h2>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-3 searchBM">
                    <div class="input-icon">
                        <input type="text" class="form-control search-statement-skill" placeholder="Search">
                        <span class="input-icon-addon">
                            <i class="fa fa-search" style="color: #ff8c13;"></i>
                        </span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="add-btn">
                        <a href="javascript:void(0)" class="anchorBtn add-btn-modal">Add</a>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="tab-content mt-2 mb-3 float-left w-100" id="pills-tabContent">
                        <div class="tab-pane fade active show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12 table-responsive">
                                            <table class="table mt-3 text-center text-white tableMobile statement-skill-table ">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Id</th>
                                                        <th scope="col">Title</th>
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

            <div class="modal" id="add-statement-skill-modal" tabindex="-1" data-backdrop="static" role="dialog" data-keyboard="false">
                <div class="modal-dialog">
                    <div class="bg">
                        <div class="modal-content">
                            <div class="modal-header modalHeader pb-0">
                            </div>
                            <form id="skill-form" method="POST">
                                <input type="hidden" id="id" name="id">
                                <div class="modal-body">
                                    <div class="row pr-3 pl-3">
                                        <div class="col-md-12 pl-0 pr-0">
                                            <div class="form-group">
                                                <input type="text" class="form-control skill-input" name="title" id="title" placeholder="Enter Title">
                                                <span class="text-danger parsley-required title-error-skil" id="title-error">{{ $errors->first('title') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-action m-3">
                                                <input type="submit" name="submit" class="save-btn border-0" value="Save">
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
    var storeStatementSkill = `{{ route('admin.statement-skill.store') }}`;
    var statementSkill = `{{ route('admin.statement-skill.index') }}`;
</script>
<script src="{{ asset('assets/js/admin/business/statement-skill.js') }}"></script>
@endsection