<div class="topbar-main">
    <div class="container-fluid">

        <!-- Logo container-->
        <div class="logo">
            <!-- Text Logo -->
            <!--<a href="index.html" class="logo">-->
            <!--Upcube-->
            <!--</a>-->
            <!-- Image Logo -->
            <a href="Login" class="logo">
                <img src="assets/images/logo-sm.png" alt="" height="22" class="logo-small">
                <img src="assets/images/logo.png" alt="" height="24" class="logo-large">
            </a>

        </div>
        <!-- End Logo container-->


        <div class="menu-extras topbar-custom">

            <!-- Search input -->
            <div class="search-wrap" id="search-wrap">
                <div class="search-bar">
                    <input class="search-input" type="search" placeholder="Search" />
                    <a href="#" class="close-search toggle-search" data-target="#search-wrap">
                        <i class="mdi mdi-close-circle"></i>
                    </a>
                </div>
            </div>

            <ul class="list-inline float-right mb-0">
                <!-- Search -->
                <li class="list-inline-item dropdown notification-list">
                    <a class="nav-link waves-effect toggle-search" href="#"  data-target="#search-wrap">
                        <i class="mdi mdi-magnify noti-icon"></i>
                    </a>
                </li>

                <!-- User-->
                <li class="list-inline-item dropdown notification-list">

                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        <a class="dropdown-item" href="#"><span class="badge badge-success pull-right m-t-5">5</span><i class="dripicons-gear text-muted"></i> Settings</a>
                        <a class="dropdown-item" href="Logout"><i class="dripicons-exit text-muted"></i> Logout</a>
                    </div>
                </li>
                <li class="menu-item list-inline-item">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle nav-link">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </li>

            </ul>
        </div>
        <!-- end menu-extras -->

        <div class="clearfix"></div>

    </div> <!-- end container -->
</div>
<!-- end topbar-main -->

<!-- MENU Start -->
<div class="navbar-custom">
    <div class="container-fluid">
        <div id="navigation">
            <!-- Navigation Menu-->
            <ul class="navigation-menu">

                <li class="has-submenu">
                    <a href="Dashboard"><i class="ti-home"></i>Dashboard</a>
                </li>

                <li class="has-submenu">
                    <a href="Sales-report"><i class="ti-archive"></i>Sales Report</a>
                </li>

                <li class="has-submenu">
                    <a href="Logout"><i class="ti-lock"></i>Logout</a>
                </li>

            </ul>
            <!-- End navigation menu -->
        </div> <!-- end #navigation -->
    </div> <!-- end container -->
</div> <!-- end navbar-custom -->