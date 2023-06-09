<!-- Page Sidebar Start-->
<style>
    .simplebar-mask {
        top: 7rem;
    }
</style>
<div class="sidebar-wrapper">
    <div id="sidebarEffect"></div>
    <div>
        <div class="logo-wrapper logo-wrapper-center">
            <a href="{{ route('dashboard') }}" data-bs-original-title="" title="">
                <img class="img-fluid for-white" src="{{ asset('/logo.png') }}" alt="logo">
            </a>

        </div>
        <div class="logo-icon-wrapper">
            <a href="#">
                <img class="img-fluid main-logo main-white" src="{{ asset('assets/images/logo/logo.png') }}"
                    alt="logo">
                <img class="img-fluid main-logo main-dark" src="{{ asset('assets/images/logo/logo-white.png') }}"
                    alt="logo">
            </a>
        </div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow">
                <i data-feather="arrow-left"></i>
            </div>

            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn"></li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{ route('dashboard') }}">
                            <i class="ri-home-line"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-list-check"></i>
                            <span>Product</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ route('products.index') }}">Prodcts</a>
                            </li>
                            <li>
                                <a href="{{ route('tank.index') }}">Tanks</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-list-check"></i>
                            <span>Stock</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ route('stock.index') }}">Add Stock</a>
                            </li>
                            <li>
                                <a href="{{ route('tankWiseStock') }}">Tank Wise Stock </a>
                            </li>
                            <li>
                                <a href="{{ route('lowStockAlert') }}">Low Stock Alert</a>
                            </li>
                            {{-- <li>
                                <a href="{{ route('currentStock') }}">Current Stock</a>
                            </li> --}}

                        </ul>
                    </li>



                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{ route('vehicle.index') }}">
                            <i class="ri-list-check"></i>
                            <span>Vehicle</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{ route('pos.index') }}">
                            <i class="ri-list-check"></i>
                            <span>Pos</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-list-check"></i>
                            <span>Sell</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ route('sellingHistory') }}">All</a>
                            </li>
                            <li>
                                <a href="{{ route('nabilSell') }}">Nabil Paribahan</a>
                            </li>
                            <li>
                                <a href="{{ route('otherSell') }}">Others</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-list-check"></i>
                            <span>Settings</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ route('roles.index') }}">Roles</a>
                            </li>
                            <li>
                                <a href="{{ route('users.index') }}">Users</a>
                            </li>
                            <li>
                                <a href="{{ route('vat') }}">Vat</a>
                            </li>
                            <li>
                                <a href="{{ route('group.index') }}">Group</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

            <div class="right-arrow" id="right-arrow">
                <i data-feather="arrow-right"></i>
            </div>
        </nav>
    </div>
</div>
<!-- Page Sidebar Ends-->
