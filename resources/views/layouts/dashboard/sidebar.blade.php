<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">

        <img src="{{ $settings->image_url }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
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
                    <li class="nav-item has-treeview menu-open m-1">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ (request()->is('admin/dashboard*')) ?'active':'' }}">
                            <ion-icon name="home-outline"></ion-icon>
                            <p>
                                الرئيسية
                                {{-- <i class="right fas fa-angle-left"></i> --}}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview menu-open m-1">
                        <a href="{{ route('admin.section') }}" class="nav-link {{ (request()->is('admin/section*')) ?'active':'' }}">
                            <ion-icon name="book-outline"></ion-icon>
                            <p>
                                الاقسام
                                {{-- <i class="right fas fa-angle-left"></i> --}}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview menu-open m-1">
                        <a href="{{ route('admin.moderator') }}" class="nav-link {{ (request()->is('admin/moderator*')) ?'active':'' }}">
                            <ion-icon name="person-outline"></ion-icon>
                            <p>
                                المشرفين
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview menu-open m-1">
                        <a href="{{ route('admin.student') }}" class="nav-link {{ (request()->is('admin/student*')) ?'active':'' }}">
                            <ion-icon name="people-outline"></ion-icon>
                            <p>
                                الطلاب
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview menu-open m-1">
                        <a href="{{ route('admin.rate') }}" class="nav-link {{ (request()->is('admin/rate*')) ?'active':'' }}">
                            <ion-icon name="people-outline"></ion-icon>
                            <p>
                                التقييمات
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview menu-open m-1">
                        <a href="" class="nav-link {{ (request()->is('admin/attendance*')) ?'active':'' }}">
                            <ion-icon name="people-outline"></ion-icon>
                            <p>
                                 قائمة الحضور والغياب 
                            </p>
                        </a>
                    </li>







                    <li class="nav-item has-treeview menu-open m-1">
                        <a href="{{ route('admin.settings') }}" class="nav-link {{ (request()->is('admin/settings*')) ?'active':'' }}">
                            {{-- <i class="nav-icon fas fa-tachometer-alt"></i> --}}
                            <ion-icon name="settings-outline"></ion-icon>
                            <p>
                                الاعدادت
                                {{-- <i class="right fas fa-angle-left"></i> --}}
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
                        <a href="{{ route('moderator.dashboard') }}" class="nav-link {{ (request()->is('admin/dashboard*')) ?'active':'' }}">
                            <ion-icon name="home-outline"></ion-icon>
                            <p>
                                الرئيسية
                                {{-- <i class="right fas fa-angle-left"></i> --}}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview menu-open m-1">
                        <a href="{{ route('moderator.section') }}" class="nav-link {{ (request()->is('admin/section*')) ?'active':'' }}">
                            <ion-icon name="book-outline"></ion-icon>
                            <p>
                                القسم
                                {{-- <i class="right fas fa-angle-left"></i> --}}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview menu-open m-1">
                        <a href="{{ route('moderator.students') }}" class="nav-link {{ (request()->is('admin/student*')) ?'active':'' }}">
                            <ion-icon name="people-outline"></ion-icon>
                            <p>
                                الطلاب
                                {{-- <i class="right fas fa-angle-left"></i> --}}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview menu-open m-1">
                        <a href="{{ route('moderator.attendance.show') }}" class="nav-link {{ (request()->is('admin/student*')) ?'active':'' }}">
                            <ion-icon name="reader-outline"></ion-icon>
                            <p>
                                جدول الحضور والغياب
                                {{-- <i class="right fas fa-angle-left"></i> --}}
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
                        <a href="{{ route('student.dashboard') }}" class="nav-link {{ (request()->is('admin/dashboard*')) ?'active':'' }}">
                            <ion-icon name="home-outline"></ion-icon>
                            <p>
                                الرئيسية
                                {{-- <i class="right fas fa-angle-left"></i> --}}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview menu-open m-1">
                        <a href="{{ route('student.section') }}" class="nav-link {{ (request()->is('admin/section*')) ?'active':'' }}">
                            <ion-icon name="book-outline"></ion-icon>
                            <p>
                                الاقسام
                                {{-- <i class="right fas fa-angle-left"></i> --}}
                            </p>
                        </a>
                    </li>






                </ul>
            </nav>
        @endif
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
