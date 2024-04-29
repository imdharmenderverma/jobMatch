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
            <h1 class="font-458baf whiteTitle ml-4 mr-4 mb-3">Privacy Policy</h1>
            
            <div class="termsInner">
                <p class="main-font-1d8082">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                <p class="main-font-1d8082">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
            </div>
            
        </div>
    </div>
</div>
@endsection
