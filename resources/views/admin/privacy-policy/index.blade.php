@extends('layouts.admin-master')
@section('page-css')
@endsection
@section('content')
<style>
    .error {
        color: red;
    }

    
</style>
<div class="main-panel">
    <div class="content">
        <div class="pageBreadcrum"><span><a href="{{ route('admin.dashboard') }}">Home</a></span> / Privacy Policy</div>
        <div class="faqWrapper">
        <div class="faqQuestion pt-4 pb-3 pl-3 mt-5 font-weight-bold d-flex align-items-center firstFilter">Privacy Policy</div>
        <div class="faqWrapperInnerEven">
            <div class="row">
                <div class="w-100 col-md-12" id="response_id">
                    <form id="formEdit" class="form-horizontal" method="POST">
                        @csrf
                        @method('put')
                        <div>
                            <input type="hidden" name="type" id="type-edit" value="{{$privacyDetails ? $privacyDetails->type : 'privacy_policy'}}">
                            <input type="hidden" name="user_type" id="user-type" value="{{  request()->get('type') ? request()->get('type') : '1'}}">
                            
                                <div class="mb-4">
                                    <textarea name="description" id="description" name="description" data-msg="Description" class="form-control validate_field description" rows="6" cols="50" placeholder="Enter Description" required> {{ isset($privacyDetails->description) ? $privacyDetails->description : '' }} </textarea>
                                    <span class="form-text error" id="Description_error"></span>
                                </div>
                            <div style="text-align: right">
                                <button type="submit" id="myButton" class="button btn btn-primary mr-2 update-btn w-25">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
@section('page-js')
<script src="{{ asset('assets/js/admin/privacy-policy.js') }}" type="text/javascript"></script>
<script>
    var csrfToken = "{{ csrf_token() }}"
    var updatePrivacyPolicy = "{{ route('admin.privacy-policy-update') }}";
    var cmsIndexUrl = "{{ route('admin.cms-index') }}";
    CKEDITOR.replace('description');
</script>
@endsection