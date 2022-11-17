<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route('admin.home') }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('user_management_access')
        <li class="c-sidebar-nav-dropdown {{ request()->is(" admin/permissions*") ? "c-show" : "" }} {{ request()->
            is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }} {{
            request()->is("admin/teams*") ? "c-show" : "" }}">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                </i>
                {{ trans('cruds.userManagement.title') }}
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                @can('permission_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.permissions.index') }}" class="c-sidebar-nav-link {{ request()->is("
                        admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.permission.title') }}
                    </a>
                </li>
                @endcan
                @can('role_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.roles.index') }}" class="c-sidebar-nav-link {{ request()->is("
                        admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.role.title') }}
                    </a>
                </li>
                @endcan
                @can('user_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.users.index') }}" class="c-sidebar-nav-link {{ request()->is("
                        admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.user.title') }}
                    </a>
                </li>
                @endcan
                @can('team_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.teams.index') }}" class="c-sidebar-nav-link {{ request()->is("
                        admin/teams") || request()->is("admin/teams/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.team.title') }}
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan
        @can('manage_access')
        <li class="c-sidebar-nav-dropdown {{ request()->is(" admin/services*") ? "c-show" : "" }} {{ request()->
            is("admin/service-schedules*") ? "c-show" : "" }} {{ request()->is("admin/service-providers*") ? "c-show" :
            "" }} {{ request()->is("admin/service-provider-schedules*") ? "c-show" : "" }} {{
            request()->is("admin/clients*") ? "c-show" : "" }}">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="fa-fw fas fa-edit c-sidebar-nav-icon">

                </i>
                {{ trans('cruds.manage.title') }}
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                @can('service_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.services.index') }}" class="c-sidebar-nav-link {{ request()->is("
                        admin/services") || request()->is("admin/services/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-clipboard-list c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.service.title') }}
                    </a>
                </li>
                @endcan
                @can('service_schedule_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.service-schedules.index') }}" class="c-sidebar-nav-link {{ request()->is("
                        admin/service-schedules") || request()->is("admin/service-schedules/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-calendar-alt c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.serviceSchedule.title') }}
                    </a>
                </li>
                @endcan
                @can('service_provider_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.service-providers.index') }}" class="c-sidebar-nav-link {{ request()->is("
                        admin/service-providers") || request()->is("admin/service-providers/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.serviceProvider.title') }}
                    </a>
                </li>
                @endcan
                @can('service_provider_schedule_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.service-provider-schedules.index') }}"
                        class="c-sidebar-nav-link {{ request()->is(" admin/service-provider-schedules") ||
                        request()->is("admin/service-provider-schedules/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-calendar-alt c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.serviceProviderSchedule.title') }}
                    </a>
                </li>
                @endcan
                @can('client_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.clients.index') }}" class="c-sidebar-nav-link {{ request()->is("
                        admin/clients") || request()->is("admin/clients/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.client.title') }}
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan
        @can('report_access')
        <li class="c-sidebar-nav-dropdown {{ request()->is(" admin/booking-details*") ? "c-show" : "" }} {{ request()->
            is("admin/payment-transactions*") ? "c-show" : "" }}">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="fa-fw fas fa-chart-bar c-sidebar-nav-icon">

                </i>
                {{ trans('cruds.report.title') }}
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                @can('booking_detail_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.booking-details.index') }}" class="c-sidebar-nav-link {{ request()->is("
                        admin/booking-details") || request()->is("admin/booking-details/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-book c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.bookingDetail.title') }}
                    </a>
                </li>
                @endcan
                @can('payment_transaction_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.payment-transactions.index') }}"
                        class="c-sidebar-nav-link {{ request()->is(" admin/payment-transactions") ||
                        request()->is("admin/payment-transactions/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-money-bill-alt c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.paymentTransaction.title') }}
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan
        @if(\Illuminate\Support\Facades\Schema::hasColumn('teams', 'owner_id') && \App\Models\Team::where('owner_id',
        auth()->user()->id)->exists())
        <li class="c-sidebar-nav-item">
            <a class="{{ request()->is(" admin/team-members") || request()->is("admin/team-members/*") ? "c-active" : ""
                }} c-sidebar-nav-link" href="{{ route('admin.team-members.index') }}">
                <i class="c-sidebar-nav-icon fa-fw fa fa-users">
                </i>
                <span>{{ trans("global.team-members") }}</span>
            </a>
        </li>
        @endif
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
        @can('profile_password_edit')
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}"
                href="{{ route('profile.password.edit') }}">
                <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                </i>
                {{ trans('global.change_password') }}
            </a>
        </li>
        @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link"
                onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>