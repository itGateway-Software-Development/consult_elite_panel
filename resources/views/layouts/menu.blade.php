<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <img style="width: 35px;" src="{{ asset('logo.png') }}" alt="">
            <span class="demo menu-text fw-bolder ms-2" style="font-size: 20px;">{{ __('messages.panel_name') }}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ request()->is('admin') ? 'active' : '' }}">
            <a href="/" class="menu-link">
                <i class='menu-icon tf-icons bx bxs-dashboard'></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Layouts -->
        @can('user_management_access')
            <li
                class="menu-item {{ request()->is('admin/users') || request()->is('admin/users/*') || request()->is('admin/roles') || request()->is('admin/roles/*') || request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class='menu-icon tf-icons bx bxs-user-circle'></i>
                    <div data-i18n="Layouts">User Management</div>
                </a>

                <ul class="menu-sub">
                    @can('permission_access')
                        <li
                            class="menu-item {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active open' : '' }}">
                            <a href="{{ route('admin.permissions.index') }}" class="menu-link">
                                <div data-i18n="Without menu">Permission</div>
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li
                            class="menu-item {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active open' : '' }}">
                            <a href="{{ route('admin.roles.index') }}" class="menu-link">
                                <div data-i18n="Without menu">Roles</div>
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li
                            class="menu-item {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active open' : '' }}">
                            <a href="{{ route('admin.users.index') }}" class="menu-link">
                                <div data-i18n="Without menu">Users</div>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Setting</span>
        </li>

        {{-- content management  --}}
        @php
            $activity = Request::is('admin/content-management/*') ? 'active open' : '';
        @endphp
        <li class="menu-item {{ $activity }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-news"></i>
                <div data-i18n="Account Settings">Content Management</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('admin/content-management/success-rate') || request()->is('admin/content-management/success-rate/*') ? 'active open' : '' }}"">
                    <a href="{{route('admin.success-rate.index')}}" class="menu-link">
                        <div data-i18n="Account">Success Rate</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('admin/content-management/success-story') || request()->is('admin/content-management/success-story/*') ? 'active open' : '' }}"">
                    <a href="{{route('admin.success-story.index')}}" class="menu-link">
                        <div data-i18n="Account">Success Story</div>
                    </a>
                </li>
            </ul>
        </li>

        {{-- activity management  --}}
        @php
            $activity = Request::is('admin/activity-management/*') ? 'active open' : '';
        @endphp
        <li class="menu-item {{ $activity }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-globe"></i>
                <div data-i18n="Account Settings">Activity Management</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('admin/activity-management/blogs') || request()->is('admin/activity-management/blogs/*') ? 'active open' : '' }}"">
                    <a href="{{route('admin.blogs.index')}}" class="menu-link">
                        <div data-i18n="Account">Blog</div>
                    </a>
                </li>
            </ul>
        </li>


    </ul>
</aside>
