    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="sidebar-sticky pt-3">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link <?= $title == 'Dashboard' ? 'active' : '' ?>" href='../../../domains/dashboard/pages/dashboard.php'>
                        <span data-feather="home"></span>
                        Dashboard <span class="sr-only">(current)</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= $title == 'Products' ? 'active' : '' ?>" href='../../../domains/products/pages/products.php'>
                        <span data-feather="shopping-cart"></span>
                        Products
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $title == 'Orders' ? 'active' : '' ?>" href='../../../domains/invoices/pages/index.php'>
                        <span data-feather="shopping-cart"></span>
                        Orders
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $title == 'Customers' ? 'active' : '' ?>" href='../../../domains/customers/pages/index.php'>
                        <span data-feather="users"></span>
                        Customers
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $title == 'Vendors' ? 'active' : '' ?>" href='../../../domains/vendors/pages/index.php'>
                        <span data-feather="users"></span>
                        Vendors
                    </a>
                </li>
            </ul>
        </div>
    </nav>