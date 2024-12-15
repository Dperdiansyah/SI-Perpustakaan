<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('/dashboard'); ?>" class="brand-link">
        <img src="<?= base_url('assets/admin/dist/img/AdminLTELogo.png'); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">Perputakaan SMA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('assets/admin/dist/img/user2-160x160.jpg'); ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= session()->get('name'); ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="<?= base_url('/dashboard'); ?>" class="nav-link <?= (uri_string() == 'dashboard') ? 'active' : ''; ?>
">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                
                <!-- Master Data -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>Master<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- Buku -->
                        <li class="nav-item">
                            <a href="<?= base_url('/books'); ?>" class="nav-link <?= (strpos(uri_string(), 'books') === 0) ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Buku</p>
                            </a>
                        </li>
                        <!-- Rak -->
                        <li class="nav-item">
                            <a href="<?= base_url('/racks'); ?>" class="nav-link <?= (strpos(uri_string(), 'racks') === 0) ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Rak Buku</p>
                            </a>
                        </li> 
                        <!-- Kategori Buku -->
                        <li class="nav-item <?= (strpos(uri_string(), 'categories') === 0) ? 'menu-open' : ''; ?>">
                            <a href="<?= base_url('/categories'); ?>" class="nav-link <?= (strpos(uri_string(), 'categories') === 0) ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kategori Buku</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Transaksi -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-exchange-alt"></i>
                        <p>Transaksi<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- Peminjaman -->
                        <li class="nav-item">
                            <a href="<?= base_url('/borrowings'); ?>" class="nav-link <?= (strpos(uri_string(), 'borrowings') === 0) ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Peminjaman</p>
                            </a>
                        </li>
                        <!-- Pengembalian -->
                        <li class="nav-item">
                            <a href="<?= base_url('/returns'); ?>" class="nav-link <?= (strpos(uri_string(), 'returns') === 0) ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pengembalian</p>
                            </a>
                        </li>
                        <!-- Denda -->
                        <li class="nav-item">
                            <a href="<?= base_url('/penalty'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Denda</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Pengaturan User -->
                <li class="nav-item ">
                    <a href="<?= base_url('/user'); ?>" class="nav-link <?= (strpos(uri_string(), 'user') === 0) ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>Pengaturan Akun</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
