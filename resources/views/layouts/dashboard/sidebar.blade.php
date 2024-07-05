<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">

        <img src="{{ $settings->image_url ?? "" }}" alt="Logo" class="brand-image img-circle elevation-3"
        style="opacity: .8">
        <span class="brand-text font-weight-light">{{ $settings->web_name ?? "Eslam Soft" }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">
                    @if (request()->is('admin*'))
                        {{ auth()->guard('admin')->user()->name }}
                    @elseif (request()->is('moderator*'))
                        {{ auth()->guard('moderator')->user()->name }}
                    @else
                        {{ auth()->guard('student')->user()->name }}
                    @endif
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        @if (request()->is('admin*'))
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                    <li class="nav-item has-treeview menu-open m-1  ">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ (request()->is('admin/dashboard*')) ?'active':'' }}">
                            <ion-icon name="home-outline"></ion-icon>
                            <p>
                                {{ __("general.home") }}
                                {{-- <i class="right fas fa-angle-left"></i> --}}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview menu-open m-1">
                        <a href="{{ route('admin.section') }}" class="nav-link {{ (request()->is('admin/section*')) ?'active':'' }}">
                            <ion-icon name="book-outline"></ion-icon>
                            <p>
                                {{ __("section.sections") }}
                                {{-- <i class="right fas fa-angle-left"></i> --}}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview menu-open m-1">
                        <a href="{{ route('admin.moderator') }}" class="nav-link {{ (request()->is('admin/moderator*')) ?'active':'' }}">
                            <ion-icon name="person-outline"></ion-icon>
                            <p>
                                {{ __("general.moderators") }}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview menu-open m-1">
                        <a href="{{ route('admin.student') }}" class="nav-link {{ (request()->is('admin/student*')) ?'active':'' }}">
                            <ion-icon name="people-outline"></ion-icon>
                            <p>
                                {{ __("general.students") }}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview menu-open m-1">
                        <a href="{{ route('admin.rate') }}" class="nav-link {{ (request()->is('admin/rate*')) ?'active':'' }}">
                            <ion-icon name="people-outline"></ion-icon>
                            <p>
                                {{ __("rates.rates") }}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview menu-open m-1">
                        <a href="" class="nav-link {{ (request()->is('admin/attendance*')) ?'active':'' }}">
                            <ion-icon name="people-outline"></ion-icon>
                            <p>
                                {{ __("attendance.attendance") }}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview menu-open m-1">
                        <a href="{{ route('admin.final_graduated') }}" class="nav-link {{ (request()->is('admin/final-graduated*')) ?'active':'' }}">
                            <ion-icon name="people-outline"></ion-icon>
                            <p>
                                {{ __("graduated.graduates") }} 
                            </p>
                        </a>
                    </li>







                    <li class="nav-item has-treeview menu-open m-1">
                        <a href="{{ route('admin.settings') }}" class="nav-link {{ (request()->is('admin/settings*')) ?'active':'' }}">
                            {{-- <i class="nav-icon fas fa-tachometer-alt"></i> --}}
                            <ion-icon name="settings-outline"></ion-icon>
                            <p>
                                {{ __("settings.settings") }}
                                {{-- <i class="right fas fa-angle-left"></i> --}}
                            </p>
                        </a>
                    </li>




                    <li class="nav-item has-treeview menu-open m-1">
                        <a href="{{ route('admin.login_settings.index') }}" class="nav-link {{ (request()->is('admin/login_settings*')) ?'active':'' }}">
                            <ion-icon name="reader-outline"></ion-icon>
                            <p>
                                {{ __("settings.login_settings") }}
                            </p>
                        </a>
                    </li>

                </ul>
            </nav>
        @elseif (request()->is('moderator*'))
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
    
                    <li class="nav-item has-treeview menu-open m-1">
                        <a href="{{ route('moderator.dashboard') }}" class="nav-link {{ (request()->is('moderator/dashboard*')) ?'active':'' }}">
                            <ion-icon name="home-outline"></ion-icon>
                            <p>
                                {{ __("general.home") }}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview menu-open m-1">
                        <a href="{{ route('moderator.graduated') }}" class="nav-link {{ (request()->is('moderator/graduated*')) ?'active':'' }}">
                            <ion-icon name="battery-full-outline"></ion-icon>
                            <p>
                                {{ __("graduated.graduates") }}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview menu-open m-1">
                        <a href="{{ route('moderator.students') }}" class="nav-link {{ (request()->is('moderator/student*')) ?'active':'' }}">
                            <ion-icon name="people-outline"></ion-icon>
                            <p>
                                {{ __("general.students") }}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview menu-open m-1">
                        <a href="{{ route('moderator.attendance.show') }}" class="nav-link {{ (request()->is('moderator/attendance*')) ?'active':'' }}">
                            <ion-icon name="reader-outline"></ion-icon>
                            <p>
                                {{ __("attendance.attendance") }}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview menu-open m-1">
                        <a href="{{ route('moderator.settings.index') }}" class="nav-link {{ (request()->is('moderator/settings*')) ?'active':'' }}">
                            <ion-icon name="reader-outline"></ion-icon>
                            <p>
                                {{ __("settings.login_settings") }}
                            </p>
                        </a>
                    </li>




                </ul>
            </nav>
        @else
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item has-treeview menu-open m-1">
                        <a href="{{ route('student.dashboard') }}" class="nav-link {{ (request()->is('student/dashboard*')) ?'active':'' }}">
                            <ion-icon name="home-outline"></ion-icon>
                            <p>
                                {{ __("general.home") }}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview menu-open m-1">
                        <a href="{{ route('student.section') }}" class="nav-link {{ (request()->is('student/section*')) ?'active':'' }}">
                            <ion-icon name="book-outline"></ion-icon>
                            <p>
                                {{ __("section.sections") }}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview menu-open m-1">
                        <a href="{{ route('student.rates') }}" class="nav-link {{ (request()->is('student/rates*')) ?'active':'' }}">
                            <ion-icon name="star-half-outline"></ion-icon>
                            <p>
                                {{ __("rates.rates") }}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview menu-open m-1">
                        <a href="{{ route('student.settings.index') }}" class="nav-link {{ (request()->is('student/settings*')) ?'active':'' }}">
                            <ion-icon name="reader-outline"></ion-icon>
                            <p>
                                {{ __("settings.login_settings") }}
                            </p>
                        </a>
                    </li>

                    <?php $student =  App\Models\FinalGraduated::where('student_id' , auth()->guard('student')->user()->id)->first(); ?>
                    @if (isset($student))
                    <li class="nav-item has-treeview menu-open m-1">
                        <a href="{{ route('student.final_rate') }}" class="nav-link {{ (request()->is('student/finalRates*')) ?'active':'' }}">
                            <ion-icon name="star-half-outline"></ion-icon>
                            <p>
                                {{ __("rates.finalrate") }}
                            </p>
                        </a>
                    </li>
                    @endif





                </ul>
            </nav>
        @endif
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
