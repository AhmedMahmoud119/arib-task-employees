<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            Arib
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                Dashboard
            </a>
        </li>

        <li class="c-sidebar-nav-item">
            <a href="{{ route("users.index") }}"
                class="c-sidebar-nav-link {{ request()->is("users") || request()->is("users/*") ? "c-active" : "" }}">
                <i class="fa-fw fas fa-ellipsis-h c-sidebar-nav-icon">

                </i>
                Employees
            </a>
        </li>



        <li class="c-sidebar-nav-item">
            <a href="{{ route("tasks.index") }}"
                class="c-sidebar-nav-link {{ request()->is("admin/tasks") || request()->is("admin/tasks/*") ? "c-active" : "" }}">
                <i class="fa-fw fas fa-ellipsis-h c-sidebar-nav-icon">

                </i>
                Tasks
            </a>
        </li>

        <li class="c-sidebar-nav-item">
            <a href="{{ route("departments.index") }}"
                class="c-sidebar-nav-link {{ request()->is("admin/departments") || request()->is("admin/departments/*") ? "c-active" : "" }}">
                <i class="fa-fw fas fa-ellipsis-h c-sidebar-nav-icon">

                </i>
                Departments
            </a>
        </li>

        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link"
                onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                logout
            </a>
        </li>
    </ul>

</div>
