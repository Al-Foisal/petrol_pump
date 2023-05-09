<!-- Page Header Start-->
<div class="page-header">
    <div class="header-wrapper m-0">
        <div class="header-logo-wrapper p-0">
            <div class="logo-wrapper">
                <a href="index.html">
                    <img class="img-fluid main-logo" src="{{ asset('assets/images/logo/1.png') }}" alt="logo">
                    <img class="img-fluid white-logo" src="{{ asset('assets/images/logo/1-white.png') }}" alt="logo">
                </a>
            </div>
            <div class="toggle-sidebar">
                <i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i>
                <a href="index.html">
                    <img src="{{ asset('assets/images/logo/1.png') }}" class="img-fluid" alt="">
                </a>
            </div>
        </div>

        <div class="nav-right col-6 pull-right right-header p-0">
            <ul class="nav-menus">
                <li>
                    <a href="{{ route('pos.index') }}" class="btn header-pos-button">POS</a>
                </li>
                <li>
                    <div class="mode">
                        <i class="ri-moon-line"></i>
                    </div>
                </li>
                <li class="profile-nav onhover-dropdown pe-0 me-0">
                    <div class="media profile-media">
                        <img class="user-profile rounded-circle" src="{{ asset('assets/images/users/4.jpg') }}" alt="">
                        <div class="user-name-hide media-body">
                            <span>Emay Walter</span>
                            <p class="mb-0 font-roboto">Admin<i class="middle ri-arrow-down-s-line"></i></p>
                        </div>
                    </div>
                    <ul class="profile-dropdown onhover-show-div">
                        
                        <li>
                            <a data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                               href="javascript:void(0)">
                                <i data-feather="log-out"></i>
                                <span>Log out</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Page Header Ends-->
