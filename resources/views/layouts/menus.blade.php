<div class="nk-sidebar nk-sidebar-fixed is-light " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-menu-trigger">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
        </div>
        <div class="nk-sidebar-brand">
            <a href="#" class="logo-link nk-sidebar-logo">
                <img class="logo-light logo-img" style="width: 80px;" src="{{ asset("be/images/2.png") }}" srcset="{{ asset("be/images/2.png") }} 2x" alt="logo">
                <img class="logo-dark logo-img" style="width: 80px;" src="{{ asset("be/images/2.png") }}" srcset="{{ asset("be/images/2.png") }} 2x" alt="logo-dark">
            </a>
        </div>
    </div>
    <div class="nk-sidebar-element nk-sidebar-body">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">MAIN MENU</h6>
                    </li>

                    <li class="nk-menu-item">
                        <a href="{{ route("dashboard.index") }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-dashlite"></em></span>
                            <span class="nk-menu-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nk-menu-item">
                        <a href="{{ route("consultations.index") }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-calendar"></em></span>
                            <span class="nk-menu-text">Consultations</span>
                        </a>
                    </li>

                    <li class="nk-menu-item">
                        <a href="{{ route("projects.index") }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-tranx"></em></span>
                            <span class="nk-menu-text">Research Projects</span>
                        </a>
                    </li>

                    <li class="nk-menu-item">
                        <a href="{{ route("templates.index") }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-file-docs"></em></span>
                            <span class="nk-menu-text">Templates</span>
                        </a>
                    </li>
                    @if (auth()->user()->is_admin)
                    <li class="nk-menu-item">
                        <a href="{{ route('teachers.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-user"></em></span>
                            <span class="nk-menu-text">Teachers</span>
                        </a>
                    </li>

                    <li class="nk-menu-item">
                        <a href="{{ route("students.index") }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-users"></em></span>
                            <span class="nk-menu-text">Students</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
