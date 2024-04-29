@extends('layouts.admin-master')
@section('page-css')
@endsection
@section('content')
<div class="main-panel" id="cms_faq">
    <div class="content">
        <div class="pageBreadcrum"><span>Home</span> / Frequently Asked Questions</div>

        <div class="row">
            <div class="col-md-8">
                <ul class="nav nav-pills nav-secondary pannelCMS float-right" id="pills-tab" role="tablist">
                    <li class="nav-item submenu">
                        <a class="nav-link active show firstPannel" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">User</a>
                    </li>
                    <li class="nav-item submenu">
                        <a class="nav-link secondPannel" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Business</a>
                    </li>
                </ul>
                <div class="tab-content mt-2 mb-3 float-left faq-content1" id="pills-tabContent">
                    <div class="tab-pane fade active show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="faqWrapper faqList">
                                    @if($getUserFaqData)
                                    @foreach($getUserFaqData as $data)

                                    <div class="faqWrapperInnerOdd user_data cus-width-change-faq" data-id="{{ $data->id }}">
                                        <div class="d-flex justify-content-between "> 
                                        <div class="faqQuestion font-900">{{ $data->question }}</div>
                                            <div class="text-right flex-65">
                                            <!-- edit  -->
                                            <a onclick="faqList(this)" class="edit-faq" data-id="{{ $data->id }}" data-question="{{ $data->question }}" data-answer="{{ $data->answer }}"><img src="{{asset('assets/img/editjob.png') }}" data-id="'.$data->id.'" data-question="'.$data->question.'" data-answer="'.$data->answer.'" class="jobEdit edit-faq action-icon"></a>
                                            <!-- delete -->
                                            <a class="delete-faq-btn edit-skill action-icon" data-id="{{ $data->id }}" data-title="{{ $data->title }}">
                                                <img src="{{ asset('assets/img/deletejob.png') }}" class="icon delete-faq jobDelete">
                                            </a>
                                        </div>
                                     
                                    </div>
                                       
                                        <div class="faqAnswer mt-4">{{ $data->answer }}</div>
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="container">
                                        <div class="justify-content-center align-items-center" style="min-height: 50vh;">
                                            <div class="col-md-12">
                                                <div class="card card-dark bg-secondary-gradient">
                                                    <div class="card-body skew-shadow rightsideBox">
                                                        <div class="row">
                                                            <div class="col-12 pr-0 text-center">
                                                                <h3 class="fw-bold mb-1 dashboardRightBoxesTitle">No data available</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="faqWrapper faqList">
                                    @if($getBusinessFaqData)
                                    @foreach($getBusinessFaqData as $data)
                                    <div class="faqWrapperInnerOdd user_data cus-width-change-faq" data-id="{{ $data->id }}">
                                    <div class="d-flex justify-content-between "> 
                                        <div class="faqQuestion font-900">{{ $data->question }}</div>
                                        <div class="text-right flex-65">
                                            <!-- edit  -->
                                            <a onclick="faqList(this)" class="edit-faq" data-id="{{ $data->id }}" data-question="{{ $data->question }}" data-answer="{{ $data->answer }}"><img src="{{asset('assets/img/editjob.png') }}" data-id="'.$data->id.'" data-question="'.$data->question.'" data-answer="'.$data->answer.'" class="jobEdit edit-faq action-icon"></a>
                                            <!-- delete -->
                                            <a class="delete-faq-btn edit-skill action-icon" data-id="{{ $data->id }}" data-title="{{ $data->title }}">
                                                <img src="{{ asset('assets/img/deletejob.png') }}" class="icon delete-faq jobDelete">
                                            </a>
                                        </div>
                                        </div>
                                        <div class="faqAnswer mt-4">{{ $data->answer }}</div>
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="container">
                                        <div class="justify-content-center align-items-center" style="min-height: 50vh;">
                                            <div class="col-md-12">
                                                <div class="card card-dark bg-secondary-gradient">
                                                    <div class="card-body skew-shadow rightsideBox">
                                                        <div class="row">
                                                            <div class="col-12 pr-0 text-center">
                                                                <h3 class="fw-bold mb-1 dashboardRightBoxesTitle"> No data available</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 cmsFaq mt-87  new-cmsFaq" style=" display: grid;">
                <form id="data-form" method="POST">
                    <input type="hidden" id="faq_type" name="faq_type" value="1">
                    <input type="hidden" name="faq_id" id="faq_id" value="">
                    <div class="form-group">
                        <input type="text" class="form-control" id="question" name="question" placeholder="Question">
                        <span class="text-danger parsley-required title-error-skil mt-0 ml-0" id="question-error">{{ $errors->first('question') }}</span>
                    </div>
                    <div class="form-group">
                        <textarea style="background: #AAD6D6" class="form-control" name="answer" id="answer" placeholder="Answer" rows="5"></textarea>
                        <span class="text-danger parsley-required title-error-skil mt-0 ml-0" id="answer-error">{{ $errors->first('answer') }}</span>
                    </div>
                    <div class="form-group">

                        <button type="submit" name="submit" class="button save-btn btn btn-primary btn-block font-900" id="myButton">Submit</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-js')
<script>
    function faqList(element) {
        var id = element.getAttribute("data-id");
        var question = element.getAttribute("data-question");
        var answer = element.getAttribute("data-answer");
        $('#faq_id').val(id);
        $('#question').val(question);
        $('#answer').val(answer);
    }
</script>
<script>
    var storeFaq = `{{ route('admin.faq.store') }}`;
    var faq = `{{ route('admin.faq.index') }}`;
    var userFaq = "{{route('admin.faq-data')}}";
</script>
<script src="{{ asset('assets/js/admin/business/faq.js') }}"></script>
@endsection