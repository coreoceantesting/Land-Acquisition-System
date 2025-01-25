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
                    <a class="nav-link menu-link" href="{{ route('dashboard') }}" >
                        <i class="ri-dashboard-2-line"></i>
                        <span data-key="t-dashboards">Dashboard</span>
                    </a>
                </li>

                @canany(['wards.view', 'districts.view', 'districts.create', 'districts.edit','districts.delete', 'talukas.view', 'talukas.create' , 'talukas.edit' , 'talukas.delete' ,'villages.view', 'villages.create' , 'villages.edit' , 'villages.delete' , 'sr_nos.view', 'sr_nos.create', 'sr_nos.edit','sr_nos.delete', 'land_acquisitions.view', 'land_acquisitions.create', 'land_acquisitions.edit','land_acquisitions.delete','bundles.view', 'years.view'])
    <li class="nav-item">
        <a class="nav-link menu-link" href="#sidebarMasters" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarMasters">
            <i class="ri-layout-3-line"></i>
            <span data-key="t-layouts">Masters</span>
        </a>
        <div class="collapse menu-dropdown" id="sidebarMasters">
            <ul class="nav nav-sm flex-column">
                @can('wards.view')
                    <li class="nav-item">
                        <a href="{{ route('wards.index') }}" class="nav-link" data-key="t-horizontal">Wards</a>
                    </li>
                @endcan

                @canany(['districts.view', 'districts.create', 'districts.edit','districts.delete'])
                    <li class="nav-item">
                        <a href="{{ route('districts.index') }}" class="nav-link" data-key="t-horizontal">Districts</a>
                    </li>
                @endcan
                @can(['talukas.view', 'talukas.create' , 'talukas.edit' , 'talukas.delete'])
                    <li class="nav-item">
                        <a href="{{ route('talukas.index') }}" class="nav-link" data-key="t-horizontal">Talukas</a>
                    </li>
                @endcan
                @can(['villages.view', 'villages.create' , 'villages.edit' , 'villages.delete'])
                    <li class="nav-item">
                        <a href="{{ route('villages.index') }}" class="nav-link" data-key="t-horizontal">Villages</a>
                    </li>
                @endcan
                @can('sr_nos.view')
                    <li class="nav-item">
                        <a href="{{ route('sr_nos.index') }}" class="nav-link" data-key="t-horizontal">Sr.no</a>
                    </li>
                @endcan
                @can(['land_acquisitions.view', 'land_acquisitions.create', 'land_acquisitions.edit','land_acquisitions.delete'])
                    <li class="nav-item">
                        <a href="{{ route('land_acquisitions.index') }}" class="nav-link" data-key="t-horizontal">Land Acquisition</a>
                    </li>
                @endcan
                @can('bundles.view')
                    <li class="nav-item">
                        <a href="{{ route('bundles.index') }}" class="nav-link" data-key="t-horizontal">Bundle</a>
                    </li>
                @endcan
                @can('years.view')
                    <li class="nav-item">
                        <a href="{{ route('years.index') }}" class="nav-link" data-key="t-horizontal">Year</a>
                    </li>
                @endcan
            </ul>
        </div>
    </li>
@endcan
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLandAcquisition" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLandAcquisition">
                        <i class="ri-layout-3-line"></i>
                        <span data-key="t-layouts"> Land Acquisition</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLandAcquisition">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('acquisition_assistant.create') }}" class="nav-link" data-key="t-horizontal">Form</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('acquisition_assistant.index') }}" class="nav-link" data-key="t-horizontal">Index</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a href="{{ route('acquisition_assistant.create') }}" class="nav-link" data-key="t-horizontal">Form</a>
                            </li> --}}
                        </ul>
                    </div>
                </li>


                @canany(['users.view', 'roles.view'])
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="bx bx-user-circle"></i>
                        <span data-key="t-layouts">User Management</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts">
                        <ul class="nav nav-sm flex-column">
                            @can('users.view')
                                <li class="nav-item">
                                    <a href="{{ route('users.index') }}" class="nav-link" data-key="t-horizontal">Users</a>
                                </li>
                            @endcan
                            @can('roles.view')
                                <li class="nav-item">
                                    <a href="{{ route('roles.index') }}" class="nav-link" data-key="t-horizontal">Roles</a>
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
