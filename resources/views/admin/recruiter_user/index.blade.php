@extends('layouts.admin-master')
@section('page-css')
@endsection
@section('content')
<div class="main-panel">
    <div class="content">
        <div class="pageBreadcrum"><span><a href="{{ route('admin.dashboard') }}">Home</a></span> / Business Management</div>
        <div class="faqWrapper p-4 mt-5 mb-4">
            <div class="row">
                <div class="col-md-2 d-flex align-items-center firstFilter">
                    <h2 class="text-white font-weight-bold">Business List</h2>
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
                        <div class="col-md-6 selectBG1">
                            <label class="selectLable">Industry</label>
                        </div>
                        <div class="col-md-6 pl-0">
                            <select class="form-control form-control industry-type" id="defaultSelect">
                                <option value="">All</option>
                                <?php
                                    // Extract titles and ids into separate arrays
                                    $titles = array_column($industries, 'title');
                                    $ids = array_column($industries, 'id');

                                    // Sort titles array alphabetically
                                    array_multisort($titles, SORT_ASC, $ids);

                                    // Loop through sorted titles and ids to create options
                                    foreach ($titles as $index => $title) {
                                        $id = $ids[$index];
                                        echo '<option value="' . $id . '">' . $title . '</option>';
                                    }
                                ?>
                                {{-- @foreach($industries->sortBy('title') as $industry)
                                    <option value="{{ $industry->id }}">{{ $industry->title }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-2 thirdFilter">
                    <div class="row">
                        <div class="col-md-6 selectBG1">
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
                            <a style="padding: 12px 50px;" class="nav-link active show firstPannel" data-id="1" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">A-Z</a>
                        </li>
                        <li class="nav-item submenu m-0">
                            <a class="nav-link secondPannel" id="pills-profile-tab" data-id="2" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Most recent</a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-12">
                    <div class="tab-content mt-2 mb-3 float-left w-100" id="pills-tabContent">
                        <div class="tab-pane fade active show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                                    <div class="row">
                                        <div class=" table-responsive user-list-tbl rec-user">
                                            <table class="table mt-3 text-center text-white tableMobile user-table bussiness-listtable">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Location</th>
                                                        <th scope="col">Industry</th>
                                                        <th scope="col">Total Job Listed</th>
                                                        <th scope="col">Active Jobs</th>
                                                        <th scope="col">Matches</th>
                                                        <th scope="col">Block</th>
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
</div>
@endsection
@section('page-js')
<script>
    var storeUser = `{{ route('admin.recruiter-users.store') }}`;
    var users = `{{ route('admin.recruiter-users.index') }}`;
    var statusRoute = `{{ route('admin.update-recruiter-status') }}`;
</script>
<script src="{{ asset('assets/js/admin/recruiter/user.js') }}"></script>
@endsection
