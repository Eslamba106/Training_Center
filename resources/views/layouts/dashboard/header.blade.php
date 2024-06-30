<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="@yield('home_route')" class="nav-link">{{ __("general.home") }} </a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="@yield('logout_route')" class="nav-link">{{ __("general.logout") }} </a>
    </li>

  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">

    <!-- Notifications Dropdown Menu -->

    <li class="nav-item dropdown">

        <a class="btn btn-light btn-sm dropdown-toggle" data-toggle="dropdown" href="#">
            {{-- <i class="far fa-bell"></i> --}}
            <span class="badge badge-success navbar-badge">{{ __('general.lang') }}
            </span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header">{{ __('general.lang') }}</span>
            {{-- <span class="dropdown-header">{{ __('dashboard/general.lang') }}</span> --}}
            <div class="dropdown-divider"></div>
            {{-- <a href="{{ route('langConvert' , 'ar') }}" class="dropdown-item"> --}}
            <a href="{{ route('lang', 'ar') }}" class="dropdown-item">
                {{ __('general.arabic') }}
                <span class="float-right text-muted text-sm">
                    <img src="{{ URL::asset('images/flags/SA.png') }}" alt="">

                </span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="{{ route('lang', 'en') }}" class="dropdown-item">
                {{ __('general.english') }}
                <span class="float-right text-muted text-sm">
                    <img src="{{ URL::asset('images/flags/US.png') }}" alt="">

                </span>
            </a>
        </div>
    </li>
</ul>
</nav>