<div class="sidebar sidebar-style-2">
	<div class="sidebar-wrapper scrollbar scrollbar-inner">
		<div class="sidebar-content">
			<ul class="nav nav-primary">
				<li class="nav-item {{ request()->is('recruiter/dashboard') ? 'active' : '' }}">
					<a href="{{ route('recruiter.dashboard') }}" class="d-flex justify-content-center">
						<img src="{{asset('assets/img/menuimgs/home.png')}}" class="baseMenuImg">
						<img src="{{asset('assets/img/menuimgs/home_live.png')}}" class="liveMenuImg">
						<span class="mobileMenuCap">Dashboard</span>
					</a>
				</li>
				<li class="nav-item {{ request()->is('recruiter/jobs') ? 'active' : '' }}">
					<a href="{{ route('recruiter.jobs.index') }}" class="d-flex justify-content-center">
						<img src="{{asset('assets/img/menuimgs/user.png')}}" class="baseMenuImg">
						<img src="{{asset('assets/img/menuimgs/user_live.png')}}" class="liveMenuImg">
						<span class="mobileMenuCap">Job Listing</span>
					</a>
				</li>

				<li class="nav-item {{ request()->is('recruiter/jobPost') ? 'active' : '' }}">
					<a href="{{ route('recruiter.jobPost') }}" class="d-flex justify-content-center">
						<img src="{{asset('assets/img/menuimgs/bag.png')}}" class="baseMenuImg">
						<img src="{{asset('assets/img/menuimgs/bag_live.png')}}" class="liveMenuImg">
						<span class="mobileMenuCap">Job Listings</span>
					</a>
				</li>

				<li class="nav-item {{ request()->is('recruiter/cms-index') ? 'active' : '' }}">
					<a href="{{ route('recruiter.cms-index') }}" class="d-flex justify-content-center">
						<img src="{{asset('assets/img/menuimgs/list.png')}}" class="baseMenuImg">
						<img src="{{asset('assets/img/menuimgs/list_live.png')}}" class="liveMenuImg">
						<span class="mobileMenuCap">Static Content</span>
					</a>
				</li>

				<li class="nav-item {{ request()->is('recruiter/subscription') ? 'active' : '' }}">
					<a href="{{ route('recruiter.subscription') }}" class="d-flex justify-content-center">
						<img src="{{asset('assets/img/menuimgs/subscribe_live.png')}}" class="baseMenuImg">
						<img src="{{asset('assets/img/menuimgs/subscribe.png')}}" class="liveMenuImg">
						<span class="mobileMenuCap">Static Content</span>
					</a>
				</li>
				<li class="nav-item {{ request()->is('recruiter/faq-data') ? 'active' : '' }}">
					<a href="{{ route('recruiter.faq-data') }}">
						<img src="{{asset('assets/img/menuimgs/question.png')}}" class="baseMenuImg">
						<img src="{{asset('assets/img/menuimgs/question_live.png')}}" class="liveMenuImg">
						<span class="mobileMenuCap">Faq</span>
					</a>
				</li>
				<!-- 
				<li class="nav-item {{ request()->is('recruiter/inbox') ? 'active' : '' }}">
					<a href="{{ route('recruiter.inbox') }}" class="d-flex justify-content-center">
						<img src="{{asset('assets/img/inbox.png')}}" class="baseMenuImg">
						<img src="{{asset('assets/img/index_live.png')}}" class="liveMenuImg">
						<span class="mobileMenuCap">inbox</span>
					</a>
				</li> -->

				<li class="nav-item cus-nav-item-logout" style="bottom: 0;">
					<form method="POST" action="{{ route('recruiter.logout') }}"> @csrf

						<a href="{{ route('recruiter.logout') }}" class="d-flex justify-content-center" onclick="event.preventDefault();
								this.closest('form').submit();">
							<img src="{{asset('assets/img/menuimgs/logout.png')}}" class="baseMenuImg">
							<img src="{{asset('assets/img/menuimgs/logout.png')}}" class="liveMenuImg">
							<span class="mobileMenuCap">Logout</span>
						</a>
					</form>
				</li>
			</ul>
		</div>
	</div>
</div>