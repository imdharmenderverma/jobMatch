<div class="row">
    @forelse ($jobs as $job)
    <div class="col-md-4">
        <div class="card card-dark bg-secondary-gradient">
            <div class="card-body skew-shadow">
                <div class="row">
                    <div class="col-7 jobWrapper pr-0">
                        <div class="jobTitle viewJobs" data-title="{{ $job['role_name'] }}" data-id="{{ $job['id'] }}">
                            {!! $job['role_name'] !!}</div>
                        <div class="jobDesc">{{ $job['type_of_work_name'] }}</div>
                        <div class="jobShortDesc readMore">{!! $job['location'] !!}</div>
                        <div class="jobApplicants">{{ $job['apply_user_count'] }} Applicants</div>
                        <div class="jobViewApplicans viewJobs" data-title="{{ $job['title'] }}"
                            data-id="{{ $job['id'] }}">View Applicants</div>
                        <div class="jobMarkComplete">
                            <label class="switch">
                                <input type="checkbox" class="job-completed" data-id="{{ $job['id'] }}">
                                <span class="slider round"></span>
                            </label>
                            <span class="markComplete">Mark as complete</span>
                        </div>
                    </div>
                    <div class="col-5 jobData">
                        <div class="jobAward">Award Job<i class="fa fa-check jobTitleCheck-icon"></i></div>
                        <div class="jobDate">Posted: {{ $job['start_date'] }}</div>
                        <div class="jobDate">Closing date: <br> {{ $job['end_date'] }}</div>
                        <div class="jobEdit"><img src="{{ asset('assets/img/editjob.png') }}" data-id="{{ $job['id'] }}"
                                class="edit-job" data-title="{{ $job['title'] }}" style="width: 20px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="container">
        <div class="justify-content-center align-items-center" style="min-height: 50vh;">
            <div class="col-md-12">
                <div class="card card-dark bg-secondary-gradient">
                    <div class="card-body skew-shadow rightsideBox">
                        <div class="row">
                            <div class="col-12 pr-0 text-center">
                                <h3 class="fw-bold mb-1 dashboardRightBoxesTitle"> No Data Found</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforelse
    <div class="col-md-12">
    {!! $jobs->links() !!}
    </div>
</div>