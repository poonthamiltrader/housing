<!-- /.modal -->
<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ url('dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('/public/assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('/public/assets/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ url('dashboard') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('/public/assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('/public/assets/images/logo-light.png') }}" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                        href="{{ url('dashboard') }}">
                        <i class="ri-home-4-line"></i>
                        <span data-key="t-widgets">{{ __('pages.dashboard') }}</span>
                    </a>
                </li>
                <!-- end Dashboard Menu Masters -->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('state.*') || request()->routeIs('city.*') || request()->routeIs('area.*') || request()->routeIs('amenities.*') || request()->routeIs('category.*') || request()->routeIs('subcategory.*') || request()->routeIs('propertytypes.*') ? 'active' : '' }}"
                        href="#sidebarApps" data-bs-toggle="collapse" role="button"
                        aria-expanded="{{ request()->routeIs('state') || request()->routeIs('city') || request()->routeIs('area') || request()->routeIs('amenities') || request()->routeIs('category') || request()->routeIs('subcategory') || request()->routeIs('propertytypes') ? 'true' : 'false' }}"
                        aria-controls="sidebarApps">
                        <i class="ri-apps-2-line"></i>
                        <span data-key="t-apps">
                            {{ __('pages.masters') }}
                        </span>
                    </a>
                    <div class="collapse menu-dropdown {{ request()->routeIs('state.*') || request()->routeIs('city.*') || request()->routeIs('area.*') || request()->routeIs('amenities.*') || request()->routeIs('category.*') || request()->routeIs('subcategory.*') || request()->routeIs('propertytypes.*') ? 'show' : '' }}"
                        id="sidebarApps">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ url('state') }}"
                                    class="nav-link {{ request()->routeIs('state.*') ? 'active' : '' }}">
                                    {{ __('pages.states') }}
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ url('city') }}"
                                    class="nav-link {{ request()->routeIs('city.*') ? 'active' : '' }}">
                                    {{ __('pages.cities') }}
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ url('area') }}"
                                    class="nav-link {{ request()->routeIs('area.*') ? 'active' : '' }}">
                                    {{ __('pages.areas') }}
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ url('amenities') }}"
                                    class="nav-link {{ request()->routeIs('amenities.*') ? 'active' : '' }}">
                                    {{ __('pages.amenities') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('category') }}"
                                    class="nav-link {{ request()->routeIs('category.*') ? 'active' : '' }}">
                                    {{ __('pages.category') }}
                                </a>

                            </li>
                            <li class="nav-item">
                                <a href="{{ url('subcategory') }}"
                                    class="nav-link {{ request()->routeIs('subcategory.*') ? 'active' : '' }}">
                                    {{ __('pages.subcategory') }}
                                </a>

                            </li>
                            <li class="nav-item">
                                <a href="{{ url('propertytypes') }}"
                                    class="nav-link {{ request()->routeIs('propertytypes.*') ? 'active' : '' }}">
                                    {{ __('pages.propertytypes') }}
                                </a>

                            </li>

                        </ul>
                    </div>
                </li>


                <li class="nav-item">
                    <a href="{{ url('property') }}"
                        class="nav-link menu-link {{ request()->routeIs('property.*') ? 'active' : '' }}">
                        <i class="ri-map-pin-line"></i>
                        <span data-key="t-Buyer">
                            {{ __('pages.property') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('buyer.*') ? 'active' : '' }}"
                        href="{{ url('buyer') }}">
                        <i class=" ri-user-follow-fill"></i>
                        <span data-key="t-Buyer">
                            {{ __('pages.buyer') }}
                        </span> <span class="badge badge-pill bg-danger" data-key=""></span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('seller.*') ? 'active' : '' }}"
                        href="{{ url('seller') }}">
                        <i class="ri-admin-fill"></i>
                        <span data-key="t-Selelr">
                            {{ __('pages.seller') }}
                        </span> <span class="badge badge-pill bg-danger" data-key=""></span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('advertisement.*') ? 'active' : '' }}"
                        href="{{ url('advertisement') }}">
                        <i class="ri-advertisement-fill"></i>
                        <span data-key="t-authentication">
                            {{ __('pages.advertisement') }}
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('package.*') ? 'active' : '' }}"
                        href="{{ url('package') }}">
                        <i class="ri-currency-fill"></i>
                        <span data-key="t-authentication">
                            {{ __('pages.package') }}
                        </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('projects.*') ? 'active' : '' }}"
                        href="{{ url('projects') }}">
                        <i class="ri-contacts-book-fill"></i>
                        <span data-key="t-authentication">
                            {{ __('pages.projects') }}
                        </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('settings.*') ? 'active' : '' }}"
                        href="{{ url('settings') }}">
                        <i class="ri-settings-fill"></i>
                        <span data-key="t-authentication">
                            {{ __('pages.settings') }}
                        </span>
                    </a>
                </li>

            </ul>
        </div>
    </div>

</div>
