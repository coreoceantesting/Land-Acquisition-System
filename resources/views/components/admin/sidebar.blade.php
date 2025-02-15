<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
            </span>
            <span class="logo-lg">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
            </span>
            <span class="logo-lg">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title">
                    <span data-key="t-menu">Menu</span>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="ri-dashboard-2-line"></i>
                        <span data-key="t-dashboards">Dashboard</span>
                    </a>
                </li>

                @canany(['wards.view', 'designations.view', 'districts.view', 'districts.create', 'districts.edit', 'districts.delete', 'talukas.view', 'talukas.create', 'talukas.edit', 'talukas.delete', 'villages.view', 'villages.create',
                    'villages.edit', 'villages.delete', 'sr_nos.view', 'sr_nos.create', 'sr_nos.edit', 'sr_nos.delete', 'land_acquisitions.view', 'land_acquisitions.create', 'land_acquisitions.edit', 'land_acquisitions.delete', 'bundles.view',
                    'years.view'])
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->routeIs('districts.index') || request()->routeIs('talukas.index') || request()->routeIs('villages.index') || request()->routeIs('sr_nos.index') || request()->routeIs('land_acquisitions.index') || request()->routeIs('designations.index') ? 'active' : 'collapsed' }}"
                            href="#sidebarMasters" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarMasters">
                            <i class="ri-layout-3-line"></i>
                            <span data-key="t-layouts">Masters</span>
                        </a>
                        <div class="collapse menu-dropdown {{ request()->routeIs('districts.index') || request()->routeIs('talukas.index') || request()->routeIs('villages.index') || request()->routeIs('sr_nos.index') || request()->routeIs('land_acquisitions.index') || request()->routeIs('designations.index') || request()->routeIs('bundles.index') || request()->routeIs('years.index') ? 'show' : '' }}"
                            id="sidebarMasters">
                            <ul class="nav nav-sm flex-column">
                                @can('wards.view')
                                    <li class="nav-item">
                                        <a href="{{ route('wards.index') }}" class="nav-link " data-key="t-horizontal">Wards</a>
                                    </li>
                                @endcan

                                @canany(['districts.view', 'districts.create', 'districts.edit', 'districts.delete'])
                                    <li class="nav-item">
                                        <a href="{{ route('districts.index') }}" class="nav-link {{ request()->routeIs('districts.index') ? 'active' : '' }}" data-key="t-horizontal">Districts</a>
                                    </li>
                                @endcan
                                @can(['talukas.view', 'talukas.create', 'talukas.edit', 'talukas.delete'])
                                    <li class="nav-item">
                                        <a href="{{ route('talukas.index') }}" class="nav-link {{ request()->routeIs('talukas.index') ? 'active' : '' }}" data-key="t-horizontal">Talukas</a>
                                    </li>
                                @endcan
                                @can(['villages.view', 'villages.create', 'villages.edit', 'villages.delete'])
                                    <li class="nav-item">
                                        <a href="{{ route('villages.index') }}" class="nav-link {{ request()->routeIs('villages.index') ? 'active' : '' }}" data-key="t-horizontal">Villages</a>
                                    </li>
                                @endcan
                                @can('sr_nos.view')
                                    <li class="nav-item">
                                        <a href="{{ route('sr_nos.index') }}" class="nav-link  {{ request()->routeIs('sr_nos.index') ? 'active' : '' }}" data-key="t-horizontal">Sr.no</a>
                                    </li>
                                @endcan
                                @can(['land_acquisitions.view', 'land_acquisitions.create', 'land_acquisitions.edit', 'land_acquisitions.delete'])
                                    <li class="nav-item">
                                        <a href="{{ route('land_acquisitions.index') }}" class="nav-link {{ request()->routeIs('land_acquisitions.index') ? 'active' : '' }}" data-key="t-horizontal">Land Acquisition</a>
                                    </li>
                                @endcan
                                @can('bundles.view')
                                    <li class="nav-item">
                                        <a href="{{ route('bundles.index') }}" class="nav-link {{ request()->routeIs('bundles.index') ? 'active' : '' }}" data-key="t-horizontal">Bundle</a>
                                    </li>
                                @endcan
                                @can('years.view')
                                    <li class="nav-item">
                                        <a href="{{ route('years.index') }}" class="nav-link {{ request()->routeIs('years.index') ? 'active' : '' }}" data-key="t-horizontal">Year</a>
                                    </li>
                                @endcan
                                @can('designations.view')
                                    <li class="nav-item">
                                        <a href="{{ route('designations.index') }}" class="nav-link {{ request()->routeIs('designations.index') ? 'active' : '' }}" data-key="t-horizontal">Designation</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcan

                @canany(['la_register.view', 'la_register.create', 'la_register.edit', 'la_register.delete'])
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ (request()->routeIs('acquisition_register.create') || request()->segment(1) == 'acquisition_register' || request()->routeIs('acquisition_register.record')) ? 'active' : 'collapsed' }}" href="#sidebarLandAcquisition1" data-bs-toggle="collapse"
                            role="button" aria-expanded="false" aria-controls="sidebarLandAcquisition1">
                            <i class="ri-layout-3-line"></i>
                            <span data-key="t-layouts">Land Acquisition Register</span>
                        </a>
                        <div class="collapse menu-dropdown {{ request()->routeIs('acquisition_register.create') || request()->segment(1) == 'acquisition_register' || request()->routeIs('acquisition_register.index') ? 'show' : '' }}" id="sidebarLandAcquisition1">
                            <ul class="nav nav-sm flex-column">
                                @can('la_register.create')
                                    <li class="nav-item">
                                        <a href="{{ route('acquisition_register.create') }}" class="nav-link {{ request()->routeIs('acquisition_register.create') ? 'active' : '' }}" data-key="t-horizontal">Register</a>
                                    </li>
                                @endcan
                                @can('la_register.view')
                                    <li class="nav-item">
                                        <a href="{{ route('acquisition_register.index') }}" class="nav-link {{ request()->routeIs('acquisition_register.index') ? 'active' : '' }}" data-key="t-horizontal">Registered List</a>
                                    </li>
                                @endcan

                            </ul>
                        </div>
                    </li>
                @endcanany

                @canany(['la_record.view', 'la_record.create', 'la_record.edit', 'la_record.delete'])
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->routeIs('acquisition_assistant.pending') || (request()->segment(1) == 'acquisition_assistant' && !request()->page_type) || request()->routeIs('acquisition_assistant.create') || request()->routeIs('acquisition_assistant.approved') || request()->routeIs('acquisition_assistant.rejected') || request()->routeIs('acquisition_assistant.land_acquisition') || request()->routeIs('acquisition_assistant.complete_reco_auth') ? 'active' : 'collapsed' }}"
                            href="#sidebarLandAcquisition" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLandAcquisition">
                            <i class="ri-layout-3-line"></i>
                            <span data-key="t-layouts">L.A. Record</span>
                        </a>
                        <div class="collapse menu-dropdown {{ request()->routeIs('acquisition_assistant.pending') || (request()->segment(1) == 'acquisition_assistant' && !request()->page_type) || request()->routeIs('acquisition_assistant.create') || request()->routeIs('acquisition_assistant.approved') || request()->routeIs('acquisition_assistant.rejected') ? 'show' : '' }}"
                            id="sidebarLandAcquisition">
                            <ul class="nav nav-sm flex-column">

                                @can('la_record.create')
                                    <li class="nav-item">
                                        <a href="{{ route('acquisition_assistant.create') }}" class="nav-link {{ request()->routeIs('acquisition_assistant.create') ? 'active' : '' }}" data-key="t-horizontal">Fill Record</a>
                                    </li>
                                @endcan
                                @can('la_record.pending-list')
                                    <li class="nav-item">
                                        <a href="{{ route('acquisition_assistant.pending') }}" class="nav-link {{ request()->routeIs('acquisition_assistant.pending') ? 'active' : '' }}" data-key="t-horizontal">Pending Records</a>
                                    </li>
                                @endcan
                                @can('la_record.approved-list')
                                    <li class="nav-item">
                                        <a href="{{ route('acquisition_assistant.approved') }}" class="nav-link  {{ request()->routeIs('acquisition_assistant.approved') ? 'active' : '' }}" data-key="t-horizontal">Approved Records</a>
                                    </li>
                                @endcan
                                @can('la_record.rejected-list')
                                    <li class="nav-item">
                                        <a href="{{ route('acquisition_assistant.rejected') }}" class="nav-link  {{ request()->routeIs('acquisition_assistant.rejected') ? 'active' : '' }}" data-key="t-horizontal">Recorrection Records</a>
                                    </li>
                                @endcan

                            </ul>
                        </div>
                    </li>
                @endcanany

                @canany(['record_auth.in_process', 'record_auth.completed'])
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->routeIs('acquisition_assistant.land_acquisition') || request()->page_type || request()->routeIs('acquisition_assistant.complete_reco_auth') ? 'active' : 'collapsed' }}" href="#sidebarLandAcquisition5"
                            data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLandAcquisition5">
                            <i class="ri-layout-3-line"></i>
                            <span data-key="t-layouts">Record Authorization</span>
                        </a>
                        <div class="collapse menu-dropdown {{ request()->routeIs('acquisition_assistant.land_acquisition') || request()->page_type || request()->routeIs('acquisition_assistant.complete_reco_auth') ? 'show' : '' }}" id="sidebarLandAcquisition5">
                            <ul class="nav nav-sm flex-column">

                                @can('record_auth.in_process')
                                    <li class="nav-item">
                                        <a href="{{ route('acquisition_assistant.land_acquisition') }}" class="nav-link  {{ request()->routeIs('acquisition_assistant.land_acquisition') ? 'active' : '' }}" data-key="t-horizontal">In Process</a>
                                    </li>
                                @endcan
                                @can('record_auth.completed')
                                    <li class="nav-item">
                                        <a href="{{ route('acquisition_assistant.complete_reco_auth') }}" class="nav-link  {{ request()->routeIs('acquisition_assistant.complete_reco_auth') ? 'active' : '' }}" data-key="t-horizontal">Completed</a>
                                    </li>
                                @endcan

                            </ul>
                        </div>
                    </li>
                @endcanany

                @canany(['users.view', 'roles.view'])
                    <li class="nav-item">
                        <a class="nav-link menu-link {{request()->routeIs('users.index') || request()->routeIs('roles.index') ? 'active' : 'collapsed' }}" href="#sidebarLayouts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                            <i class="bx bx-user-circle"></i>
                            <span data-key="t-layouts">User Management</span>
                        </a>
                        <div class="collapse menu-dropdown {{ request()->routeIs('users.index') || request()->routeIs('roles.index') ? 'show' : '' }}" id="sidebarLayouts">
                            <ul class="nav nav-sm flex-column">
                                @can('users.view')
                                    <li class="nav-item ">
                                        <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}" data-key="t-horizontal">Users</a>
                                    </li>
                                @endcan
                                @can('roles.view')
                                    <li class="nav-item ">
                                        <a href="{{ route('roles.index') }}" class="nav-link {{request()->routeIs('roles.index') ? 'active' : '' }}" data-key="t-horizontal">Roles</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcan

            </ul>
        </div>
    </div>

    <div class="sidebar-background"></div>
</div>


<div class="vertical-overlay"></div>
