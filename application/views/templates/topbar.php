<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Search -->
            <form method="GET" action="<?= site_url() . "search/searchByHotel"; ?>" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input type="text" name="q" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- dropdown sort -->
                <li class="nav-item dropdown no-arrow">
                    <a class=" nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline small btn btn-outline-primary">Sort Hotel <i class="fas fa-fw fa-sort"></i></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?= base_url('sortfilter/nameasc'); ?>">
                            <i class="fas fa-sort-alpha-down"></i> Name Ascending (A - Z)
                        </a>
                        <a class="dropdown-item" href="<?= base_url('sortfilter/namedesc'); ?>">
                            <i class="fas fa-sort-alpha-down-alt"></i> Name Descending (Z - A)
                        </a>
                    </div>
                </li>

                <!-- dropdown filter -->
                <li class="nav-item dropdown no-arrow">
                    <a class=" nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline small btn btn-outline-primary">Filter Hotel <i class="fas fa-fw fa-filter"></i></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?= base_url('sortfilter/star5'); ?>">
                            <div class="text-warning">
                                <?php for ($i = 0; $i < 5; $i++) { ?>
                                    <i class="fas fa-fw fa-star"></i>
                                <?php }; ?>
                            </div>
                        </a>
                        <a class="dropdown-item" href="<?= base_url('sortfilter/star4'); ?>">
                            <div class="text-warning">
                                <?php for ($i = 0; $i < 4; $i++) { ?>
                                    <i class="fas fa-fw fa-star"></i>
                                <?php }; ?>
                            </div>
                        </a>
                        <a class="dropdown-item" href="<?= base_url('sortfilter/star3'); ?>">
                            <div class="text-warning">
                                <?php for ($i = 0; $i < 3; $i++) { ?>
                                    <i class="fas fa-fw fa-star"></i>
                                <?php }; ?>
                            </div>
                        </a>
                        <a class="dropdown-item" href="<?= base_url('sortfilter/star2'); ?>">
                            <div class="text-warning">
                                <?php for ($i = 0; $i < 2; $i++) { ?>
                                    <i class="fas fa-fw fa-star"></i>
                                <?php }; ?>
                            </div>
                        </a>
                        <a class="dropdown-item" href="<?= base_url('sortfilter/star1'); ?>">
                            <div class="text-warning">
                                <i class="fas fa-fw fa-star"></i>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url('sortfilter/priceless500'); ?>">
                            <i class="fas fa-tags"></i> Room Price < 500k </a> <a class="dropdown-item" href="<?= base_url('sortfilter/priceless1000'); ?>">
                                <i class="fas fa-tags"></i> Room Price < 1000k </a> <a class="dropdown-item" href="<?= base_url('sortfilter/pricemore1000'); ?>">
                                    <i class="fas fa-tags"></i> Room Price > 1000k
                        </a>
                </li>

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['name']; ?></span>
                        <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/') . $user['image']; ?>">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->