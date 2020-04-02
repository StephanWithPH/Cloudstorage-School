<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ action('HomeController@loadHomePage') }}">
        <img src="{{ asset('img/logo.png') }}" height="30" class="d-inline-block align-top" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ action('HomeController@loadHomePage') }}">{{ __('language.home') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">{{ __('language.pricing') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">{{ __('language.features') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">{{ __('language.aboutus') }}</a>
            </li>
{{--            <li class="nav-item dropdown">--}}
{{--                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                    Dropdown link--}}
{{--                </a>--}}
{{--                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">--}}
{{--                    <a class="dropdown-item" href="#">Action</a>--}}
{{--                    <a class="dropdown-item" href="#">Another action</a>--}}
{{--                    <a class="dropdown-item" href="#">Something else here</a>--}}
{{--                </div>--}}
{{--            </li>--}}
        </ul>
        <ul class="navbar-nav ml-auto">
            @if(\Illuminate\Support\Facades\Auth::check())
                @if(\Illuminate\Support\Facades\Auth::user()->is_admin)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="adminTopbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ __('language.admin') }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="adminTopbarDropdown">
                            <a class="dropdown-item" href="{{ action('AdminController@loadAdminStatisticsPage') }}">{{ __('language.adminstatistics') }}</a>
                            <a class="dropdown-item" href="{{ action('AdminController@loadAdminUsersPage') }}">{{ __('language.adminusers') }}</a>
                        </div>
                    </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link" href="{{ action('DashboardController@loadSharedFilesPage') }}">{{ __('language.shared') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ action('DashboardController@loadFilesPage') }}">{{ __('language.files') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ action('Auth\LoginController@logout') }}">{{ __('language.logout') }}</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('language.login') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-primary text-white" href="{{ route('register') }}">{{ __('language.signup') }}</a>
                </li>
            @endif
        </ul>
    </div>
</nav>
