@extends('layouts.master')

@section('content')
    <style type="text/css">
        @media (max-width:600px) {
            .mobileFlex {
                display: flex !important;
                flex-direction: column-reverse;
            }
        }
    </style>
<div class="container wrapper align-items-center d-flex justify-content-center">
    <div class="right">
        <div class="rightBox termsWrapper">
            <h1 class="font-458baf whiteTitle ml-4 mr-4 mb-3">{{$getBusinessCmsData->cms_title}}</h1>
            
            <div class="termsInner">
                <p class="main-font-1d8082">{!! isset($getBusinessCmsData->description) ? $getBusinessCmsData->description : '' !!}</p>
            </div>
            
        </div>
    </div>
</div>
@endsection
