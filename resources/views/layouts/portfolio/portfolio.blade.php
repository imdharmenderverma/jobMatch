@if(count($experienceShowData) > 0)
@foreach ($experienceShowData as $data)
<div class="main-porfolio">

    <div class="d-flex w-100 justify-content-between">
        @php
        $i=1;
        @endphp

        <div class="left-profile">
            <div>
                <p><span class="profile-bold">Company Name :- </span><span class="com-name">{{$data->company}}</span></p>
            </div>
        </div>
        <div class="right-profile">
            <div>
                <p><span class="profile-bold">Industry Name :- </span><span class="com-name">{{$data->industry}}</span></p>
            </div>
        </div>
    </div>

    <div class="port-title">
        <p>Portfolio</p>
    </div>
    @foreach ($data->userPortfolio as $k => $portfolio)
    <div class="w-100 p-2">
        <div class="card card-collapse-profile">
            <div class="card-title collapse-bg-color p-1 text-white">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseExample{{$portfolio->id}}" aria-expanded="true" aria-controls="collapseOne">
                    <h3>{{$portfolio->title}} </h3>
                </button>
            </div>
            <div class="accordion-collapse collapse card-body text-collapse-dec" id="collapseExample{{$portfolio->id}}">
                {{$portfolio->description}}
            </div>
        </div>
    </div>
    @endforeach
</div>
@endforeach
@else
<div style="display:flex; align-items: center;">
    <h4>No Portfolio Available</h4>
</div>
@endif