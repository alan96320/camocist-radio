<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">
        <img class="navbar-brand-full" src="{{ asset('img/frontend/logo-background.png') }}" width="160" height="60" alt="">
        <img class="navbar-brand-minimized" src="{{ asset('img/frontend/logo-background.png') }}" width="30" height="30" alt="">
    </a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show" style="background-color:#2f353a;border:none;border-radius:0px;min-width:44px;padding:17px 0;">
        <span class="navbar-toggler-icon"></span>
    </button>

    <ul class="nav navbar-nav d-md-down-none">
        <li class="nav-item px-3">
            <a class="nav-link" href="{{ route('frontend.index') }}"><i class="icon-home"></i></a>
        </li>

        <li class="nav-item px-3">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">@lang('navs.frontend.dashboard')</a>
        </li>

        <li class="nav-item px-3">
            <a class="nav-link" href="{{ route('admin.categories.index') }}">@lang('navs.frontend.categories')</a>
        </li>

        <li class="nav-item px-3">
            <a class="nav-link" href="{{ route('admin.posts.index') }}">@lang('navs.frontend.posts')</a>
        </li>

        <li class="nav-item px-3">
            <a class="nav-link" href="{{ route('admin.news.index') }}">@lang('navs.frontend.news')</a>
        </li>

    </ul>

    <ul class="nav navbar-nav ml-auto">

        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <img src="{{ $logged_in_user->picture }}" class="img-avatar" alt="{{ $logged_in_user->email }}">
            <span class="d-md-down-none">{{ $logged_in_user->first_name }}</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{ url('admin/auth/user/'.$logged_in_user->id) }}">
              <i class="fa fa-user"></i> Profile
            </a>
            <a class="dropdown-item" href="{{ route('frontend.auth.logout') }}">
                <i class="fas fa-lock"></i> @lang('navs.general.logout')
            </a>
          </div>
        </li>
    </ul>
</header>
