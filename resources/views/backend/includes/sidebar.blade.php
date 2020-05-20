<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">
                @lang('menus.backend.sidebar.general')
            </li>
            <li class="nav-item">
                <a class="nav-link {{ active_class(Active::checkUriPattern('admin/dashboard')) }}" href="{{ route('admin.dashboard') }}">
                    <i class="nav-icon icon-speedometer"></i> @lang('menus.backend.sidebar.dashboard')
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ active_class(Active::checkUriPattern('admin.categories.index')) }}" href="{{ route('admin.categories.index') }}">
                    <i class="nav-icon icon-options"></i> @lang('menus.backend.sidebar.categories')
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ active_class(Active::checkUriPattern('admin.posts.index')) }}" href="{{ route('admin.posts.index') }}">
                    <i class="nav-icon icon-docs"></i> @lang('menus.backend.sidebar.posts')
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ active_class(Active::checkUriPattern('admin.news.index')) }}" href="{{ route('admin.news.index') }}">
                    <i class="nav-icon icon-envelope"></i> @lang('menus.backend.sidebar.news')
                </a>
            </li>

            <li class="nav-title">
                @lang('menus.backend.sidebar.system')
            </li>

            @if ($logged_in_user->isAdmin())
                <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/auth*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/auth*')) }}" href="#">
                        <i class="nav-icon icon-user"></i> @lang('menus.backend.access.title')

                        @if ($pending_approval > 0)
                            <span class="badge badge-danger">{{ $pending_approval }}</span>
                        @endif
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/user*')) }}" href="{{ route('admin.auth.user.index') }}">
                                @lang('labels.backend.access.users.management')

                                @if ($pending_approval > 0)
                                    <span class="badge badge-danger">{{ $pending_approval }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/role*')) }}" href="{{ route('admin.auth.role.index') }}">
                                @lang('labels.backend.access.roles.management')
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            <li class="divider"></li>

            <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'open') }}">
                <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/log-viewer*')) }}" href="#">
                    <i class="nav-icon icon-list"></i> @lang('menus.backend.log-viewer.main')
                </a>

                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link {{ active_class(Active::checkUriPattern('admin/log-viewer')) }}" href="{{ route('log-viewer::dashboard') }}">
                            @lang('menus.backend.log-viewer.dashboard')
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ active_class(Active::checkUriPattern('admin/log-viewer/logs*')) }}" href="{{ route('log-viewer::logs.list') }}">
                            @lang('menus.backend.log-viewer.logs')
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ active_class(Active::checkUriPattern('admin/timebelt')) }}" href="{{ route('admin.timebelt') }}">
                    <i class="nav-icon icon-clock"></i> Time-Belt Banner
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ active_class(Active::checkUriPattern('admin/logo_setting')) }}" href="{{ route('admin.logo_setting') }}">
                    <i class="nav-icon icon-list"></i> Logo Setting
                </a>
            </li>
        </ul>
    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div><!--sidebar-->
