<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('brand_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.brands.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/brands") || request()->is("admin/brands/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-bold c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.brand.title') }}
                </a>
            </li>
        @endcan
        @can('medicines_category_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.medicines-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/medicines-categories") || request()->is("admin/medicines-categories/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-th-list c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.medicinesCategory.title') }}
                </a>
            </li>
        @endcan
        @can('medicine_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.medicines.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/medicines") || request()->is("admin/medicines/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-hospital c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.medicine.title') }}
                </a>
            </li>
        @endcan
        @can('pharmacy_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.pharmacies.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/pharmacies") || request()->is("admin/pharmacies/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-hospital-alt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.pharmacy.title') }}
                </a>
            </li>
        @endcan
        @can('customer_detail_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.customer-details.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/customer-details") || request()->is("admin/customer-details/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.customerDetail.title') }}
                </a>
            </li>
        @endcan
        @can('order_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.orders.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/orders") || request()->is("admin/orders/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-sitemap c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.order.title') }}
                </a>
            </li>
        @endcan
        @can('covid_post_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.covid-posts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/covid-posts") || request()->is("admin/covid-posts/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-file-code c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.covidPost.title') }}
                </a>
            </li>
        @endcan
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('pharmacy_medicine_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.pharmacy-medicines.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/pharmacy-medicines") || request()->is("admin/pharmacy-medicines/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-briefcase-medical c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.pharmacyMedicine.title') }}
                </a>
            </li>
        @endcan
        @can('pharmacy_order_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.pharmacy-orders.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/pharmacy-orders") || request()->is("admin/pharmacy-orders/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.pharmacyOrder.title') }}
                </a>
            </li>
        @endcan
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>