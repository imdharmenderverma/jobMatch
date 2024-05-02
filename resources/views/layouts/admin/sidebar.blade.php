<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-primary">
                <li class="nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="d-flex justify-content-center">
                        <img src="{{ asset('assets/img/menuimgs/home.png') }}" class="baseMenuImg">
                        <img src="{{ asset('assets/img/menuimgs/home_live.png') }}" class="liveMenuImg">
                        <span class="mobileMenuCap">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('admin/app-users') ? 'active' : '' }}">
                    <a href="{{ route('admin.app-users.index') }}" class="d-flex justify-content-center">
                        <img src="{{ asset('assets/img/menuimgs/user.png') }}" class="baseMenuImg">
                        <img src="{{ asset('assets/img/menuimgs/user_live.png') }}" class="liveMenuImg">
                        <span class="mobileMenuCap">App User Management</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('admin/recruiter-users') ? 'active' : '' }}">
                    <a href="{{ route('admin.recruiter-users.index') }}" class="d-flex justify-content-center">
                        <img src="{{ asset('assets/img/menuimgs/bag.png') }}" class="baseMenuImg">
                        <img src="{{ asset('assets/img/menuimgs/bag_live.png') }}" class="liveMenuImg">
                        <span class="mobileMenuCap">Business List</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('admin/cms-index') ? 'active' : '' }}">
                    <a href="{{ route('admin.cms-index') }}" class="d-flex justify-content-center">
                        <img src="{{ asset('assets/img/menuimgs/list.png') }}" class="baseMenuImg">
                        <img src="{{ asset('assets/img/menuimgs/list_live.png') }}" class="liveMenuImg">
                        <span class="mobileMenuCap">CMS</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('admin/subscription') ? 'active' : '' }}">
					<a href="{{ route('admin.subscription') }}" class="d-flex justify-content-center">
						<img src="{{asset('assets/img/menuimgs/subscribe_live.png')}}" class="baseMenuImg">
						<img src="{{asset('assets/img/menuimgs/subscribe.png')}}" class="liveMenuImg">
						<span class="mobileMenuCap">Subscription</span>
					</a>
				</li>

                <li class="nav-item {{ request()->is('admin/faq') ? 'active' : '' }}">
                    <a href="{{ route('admin.faq.index') }}" class="d-flex justify-content-center">
                        <img src="{{ asset('assets/img/menuimgs/question.png') }}" class="baseMenuImg">
                        <img src="{{ asset('assets/img/menuimgs/question_live.png') }}" class="liveMenuImg">
                        <span class="mobileMenuCap">Faq</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('admin/skill') ? 'active' : '' }}">
                    <a href="{{ route('admin.skill.index') }}" class="d-flex justify-content-center">
                        <img src="{{ asset('assets/img/skills.png') }}" class="baseMenuImg">
                        <img src="{{ asset('assets/img/skills_active.png') }}" class="liveMenuImg">
                        <span class="mobileMenuCap">Skill</span>
                    </a>
                </li>

                <!-- <li class="nav-item {{ request()->is('admin/statement-skill') ? 'active' : '' }}">
     <a href="{{ route('admin.statement-skill.index') }}" class="d-flex justify-content-center">
      <img src="{{ asset('assets/img/menuimgs/list.png') }}" class="baseMenuImg">
      <img src="{{ asset('assets/img/menuimgs/list_live.png') }}" class="liveMenuImg">
      <span class="mobileMenuCap">Statement Skill</span>
     </a>
    </li> -->

                <li class="nav-item {{ request()->is('admin/statement') ? 'active' : '' }}">
                    <a href="{{ route('admin.statement.index') }}" class="d-flex justify-content-center">
                        <img src="{{ asset('assets/img/inquiry.png') }}" class="baseMenuImg">
                        <img src="{{ asset('assets/img/inquiry_active.png') }}" class="liveMenuImg">
                        <span class="mobileMenuCap">Statement</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('admin/industries') ? 'active' : '' }}">
                    <a href="{{ route('admin.industries.index') }}" class="d-flex justify-content-center">
                        <img src="{{ asset('assets/img/recruiter.png') }}" class="baseMenuImg">
                        <img src="{{ asset('assets/img/recruiter_active.png') }}" class="liveMenuImg">
                        <span class="mobileMenuCap">Industries</span>
                    </a>
                </li>


                <li class="nav-item {{ request()->is('admin/inbox') ? 'active' : '' }}">
                    <a href="{{ route('admin.inbox.index') }}" class="d-flex justify-content-center">
                        <img src="{{ asset('assets/img/inbox.png') }}" class="baseMenuImg">
                        <img src="{{ asset('assets/img/index_live.png') }}" class="liveMenuImg">
                        <span class="mobileMenuCap">inbox</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="sidebar-content-bottom">
        <ul class="nav nav-primary">
            <li class="nav-item" style="bottom: 0;">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <a href="{{ route('admin.logout') }}" class="d-flex justify-content-center"
                        onclick="event.preventDefault();
								this.closest('form').submit();">
                        <img src="{{ asset('assets/img/menuimgs/logout.png') }}" class="baseMenuImg">
                        <img src="{{ asset('assets/img/menuimgs/logout.png') }}" class="liveMenuImg">
                        <span class="mobileMenuCap">Logout</span>
                    </a>
                </form>
            </li>
        </ul>
    </div>
</div>
