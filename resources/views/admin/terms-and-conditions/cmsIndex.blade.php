@extends('layouts.admin-master')
@section('page-css')
<style>
    .error {
        color: red;
    }
</style>
@endsection
@section('content')
        
        <div class="main-panel" id="cms_terms">
            <div class="content">
                <div class="pageBreadcrum"><span>Home</span> / Terms and Conditions</div>

                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-pills nav-secondary pannelCMS float-right" id="pills-tab" role="tablist">
                            <li class="nav-item submenu">
                                <a class="nav-link active show firstPannel" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">User</a>
                            </li>
                            <li class="nav-item submenu">
                                <a class="nav-link secondPannel" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Business</a>
                            </li>
                        </ul>
                        <div class="tab-content mt-2 float-left w-100" id="pills-tabContent">
                            <div class="tab-pane fade active show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <div class="row">
                                    <div class="col-md-12">
                                        @foreach($getUserCmsData as $data)
                                        <div class="faqWrapper mb-4">
                                            <div class="faqQuestion pt-4 pb-3 pl-3 font-weight-bold">                                                
                                                {{$data->cms_title}}</div>
                                            <div class="faqWrapperInnerEven">
                                                <div class="faqAnswer mt-4 term-space-p">{!! $data->description !!}</div>
                                                <div class="row">
                                                    <div class="col-md-12 text-right">
                                                        <div class="form-group">
                                                            @if($data->type == "privacy_policy")
                                                                <a href="{{ route('admin.privacy-policy') }}?type={{ $data->cms_type }}"> <button class="btn btn-primary btn-block font-900 w-25">Edit</button></a>
                                                            @else
                                                                <a href="{{ route('admin.terms-of-use') }}?type={{ $data->cms_type }}"> <button class="btn btn-primary btn-block font-900 w-25">Edit</button></a>
                                                            @endif    
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <div class="row">
                                    <div class="col-md-12">
                                        @foreach($getbuisnessCmsData as $data)
                                        <div class="faqWrapper mb-4">
                                            <div class="faqQuestion pt-4 pb-3 pl-3 font-weight-bold">{{$data->cms_title}}</div>
                                            <div class="faqWrapperInnerEven">
                                                <div class="faqAnswer mt-4 term-space-p">{!! $data->description !!}</div>
                                                <div class="row">
                                                    <div class="col-md-12 text-right">
                                                        <div class="form-group">
                                                            @if($data->type == "privacy_policy")
                                                                <a href="{{ route('admin.privacy-policy') }}?type={{ $data->cms_type }}"> <button class="btn btn-primary btn-block font-900 w-25">Edit</button></a>
                                                            @else
                                                                <a href="{{ route('admin.terms-of-use') }}?type={{ $data->cms_type }}"> <button class="btn btn-primary btn-block font-900 w-25">Edit</button></a>
                                                            @endif 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection