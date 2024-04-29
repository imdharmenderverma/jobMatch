@extends('layouts.admin-master')
@section('page-css')
@endsection
@section('content')
<div class="main-panel">
    <div class="content">
        <div class="pageBreadcrum"><span><a href="{{ route('admin.dashboard') }}">Home</a></span> / Industry Management</div>
        <div class="faqWrapper p-4 mt-5 mb-4">
            <div class="row">
                <div class="col-md-2 d-flex align-items-center firstFilter">
                    <h2 class="text-white font-weight-bold m-0">Industry List</h2>
                </div>
                <div class="col-md-5"></div>
                <div class="col-md-3 searchBM" style="margin-left: 50px;">
                    <div class="input-icon">
                        <input type="text" style="height: 41px !important;" class="search-statement form-control search-industry " placeholder="Search">
                        <span class="input-icon-addon">
                            <i class="fa fa-search" style="color: #ff8c13;"></i>
                        </span>
                    </div>
                </div>
                <div class="add-btn state-btn">
                    <a href="javascript:void(0)" class="anchorBtn add-btn-modal industry-btn addskillBtn">Add Industry</a>
                </div>

                <div class="col-md-12 p-0">
                    <div class="tab-content mt-2 mb-3 float-left w-100" id="pills-tabContent">
                        <div class="tab-pane fade active show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12 table-responsive user-list-tbl">
                                            <table class="table mt-3 text-center text-white tableMobile industry-table ">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Sr No</th>
                                                        <th scope="col">Industry</th>
                                                        <th scope="col">Sub Industry</th>
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

            <div class="modal" id="add-industry-modal" tabindex="-1" data-backdrop="static" role="dialog" data-keyboard="false">
                <div class="modal-dialog">
                    <div class="bg">
                        <div class="modal-content">
                            <div class="modal-header modalHeader pb-0">
                                <div class="row">
                                    <div class="col-md-5" id="edit-close">Add Industry</div>
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
                                            <div class="form-group create-acc-select">
                                                <select class="form-control select2 cus-select2" name="parent_id" id="parent_id">
                                                    <option value="">Select Parent Industry</option>
                                                    @foreach ($parentIndustry as $industry)
                                                    <option value="{{ $industry->id }}">{{ $industry->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 pl-0 pr-0">
                                            <div class="form-group">
                                                <input type="text" class="form-control skill-input new-skill-input" name="title" id="title" placeholder="Enter Title">
                                                <span class="text-danger parsley-required title-error-skil" id="title-error">{{ $errors->first('title') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-action m-3">
                                                   <button id="myButton" class="button save-btn"> Save</button>
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
    var storeIndustry = `{{ route('admin.industries.store') }}`;
    var industries = `{{ route('admin.industries.index') }}`;
</script>
<script src="{{ asset('assets/js/admin/business/industries.js') }}"></script>
<script>
    $(document).ready(function() {
        $(".select2").select2({
            minimumResultsForSearch: Infinity,
            allowClear: true
        });

        $('.cus-select2').on('select2:open', function(e) {
            $("body").addClass('indus-select-2');
            $("body").append("<div class='select2-overlay'></div>");
        });
        $('.cus-select2').on('select2:close', function(e) {
            $("body").removeClass('indus-select-2');
            $(".select2-overlay").remove();
        });
    });
</script>
@endsection