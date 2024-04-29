@extends('layouts.admin-master')
@section('page-css')
@endsection
@section('content')
<style>
.custom-scroll{
	height:437px;
	overflow:auto;
	{{-- margin:5px; --}}
}
.custom-scroll::-webkit-scrollbar {
  width: 5px;
}

/* Track */
.custom-scroll::-webkit-scrollbar-track {
  background: #f1f1f1; 
}
 
/* Handle */
.custom-scroll::-webkit-scrollbar-thumb {
  background: #ff8c13 ; 
}

/* Handle on hover */
.custom-scroll::-webkit-scrollbar-thumb:hover {
  background: #81c5c7; 
}
</style>
<div class="main-panel">
	<div class="content">
		<div class="pageBreadcrum"><span><a href="{{ route('admin.dashboard') }}">Home</a></span> / Inbox</div>
		<div class="row mt-5">
			<div class="col-md-4">
				<ul class="nav nav-pills nav-secondary pannelCMS float-right" id="pills-tab" role="tablist">
					<li class="nav-item submenu m-0">
						<a class="nav-link  show  active firstPannel" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">User</a>
					</li>
					<li class="nav-item submenu m-0">
						<a class="nav-link   secondPannel " id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Business</a>
					</li>
				</ul>

				<div class="tab-content mt-2 mb-3 float-left w-100" id="pills-tabContent">
					<div class="tab-pane fade active show faqWrapper" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
						<div class="custom-scroll">
						<table class="table mt-3 text-white inbox-tbl-padding">
								@if(count($getHelp) > 0)
							<tbody>
								@foreach($getHelp as $getHelp)
								@if($getHelp->appUserData != null)

								<tr class="user_data " data-user_id="{{$getHelp->id}}"  data-name="{{$getHelp->appUserData->first_name}}" data-email="{{$getHelp->appUserData->email}}">
									<td class="font-weight-bold user-hover">@if($getHelp->flag_status == '0')<div class="orange-dot business-orange-dot{{$getHelp->id}}"></div>@else @endif{{$getHelp->appUserData->first_name}} {{$getHelp->appUserData->last_name}}</td>
									<td class="text-right user-hover">{{$getHelp->created_at->format('d-m-Y')}}</td>
								</tr>
								@endif
								@endforeach
								@else
								<tr>
									<td colspan="2" class="dataFound">{{ __('messages.custom.no_data_found') }}</td>
								</tr>
								@endif
							</tbody>
						</table>
						</div>
					</div>
					<div class="tab-pane fade   faqWrapper" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
							<div class="custom-scroll">
							<table class="table mt-3 text-white inbox-tbl-padding">
							<tbody>
								@if(count($data) > 0)
								@foreach($data as $recruterData)
								@if($recruterData->recruiter != null)
								<tr class="user_data " data-id="{{$recruterData->id}}" data-name="{{$recruterData->recruiter->business_name}}" data-email="{{$recruterData->recruiter->email}}">
									<td class="font-weight-bold user-hover">@if($recruterData->flag_status == '0')<div class="orange-dot user-orange-dot{{$recruterData->id}}"></div>@else @endif{{$recruterData->recruiter->business_name}}</td>
									<td class="text-right user-hover">{{$recruterData->created_at->format('d-m-Y')}}</td>
								</tr>
								@endif
								@endforeach
								@else
								<tr>
									<td colspan="2" class="dataFound">{{ __('messages.custom.no_data_found') }}</td>
								</tr>
								@endif
							</tbody>
						</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-8 cmsFaq new-cmsfaq read-only">
				<form action="" method="post">
					<div class="form-group">
						<input type="text" class="form-control form-white" id="name" placeholder="Name" style="background: #AAD6D6;" readonly>
					</div>
					<div class="form-group">
						<input type="email" class="form-control form-white" id="email" placeholder="Email" style="background: #AAD6D6;" readonly>
					</div>
					<div class="form-group">
						<input type="text" class="form-control form-white" id="date" placeholder="Date" style="background: #AAD6D6;" readonly>
					</div>
					<div class="form-group">
						<textarea class="form-control form-white" id="answer" placeholder="Answer" rows="10" style="background: #AAD6D6;" readonly></textarea>
					</div>
					<div class="form-group">
						<button  type="button"class="button btn btn-primary btn-block inbox-btn font-900 w-50 float-right read-btn mark-as-read mark_as_read" id="myButton">Mark as Read</button>
					<input type="hidden" id="id" class="helps_id">
					<input type="hidden" id="helps_user_id" class="helps_user_id">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@section('page-js')
<script>
var flagUpdate = `{{ route('admin.flag-update') }}`;
</script>
<script src="{{ asset('assets/js/admin/business/inbox.js') }}"></script>
@endsection