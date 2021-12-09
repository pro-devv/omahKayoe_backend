<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                @hasrole('super-admin')
                    <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                    </li>
                    <li class="{{ Request::segment(1) == 'banner' ? 'active' : '' }}">
                        <a href="{{ route('banner.index') }}"><i class="menu-icon ti-image"></i>Banner </a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon ti-shopping-cart"></i>Produk</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="ti-pencil-alt"></i><a href="ui-badges.html">Tambah Produk</a></li>
                            <li><i class="ti-check-box"></i><a href="ui-tabs.html">Kategori Produk</a></li>
                            <li><i class="ti-comment-alt"></i><a href="ui-tabs.html">Ulasan</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i>Blog</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="ti-pencil-alt"></i><a href="ui-badges.html">Tambah Blog</a></li>
                            <li><i class="ti-check-box"></i><a href="ui-tabs.html">Kategori Blog</a></li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="index.html"><i class="menu-icon ti-stats-up"></i>Data Transaksi </a>
                    </li>
                    <li class="">
                        <a href="index.html"><i class="menu-icon ti-user"></i>Data Admin </a>
                    </li>
                @else
                    <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                    </li>
                    <li class="{{ Request::segment(1) == 'banner' ? 'active' : '' }}">
                        <a href="{{ route('banner.index') }}"><i class="menu-icon ti-image"></i>Banner </a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon ti-shopping-cart"></i>Produk</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="ti-pencil-alt"></i><a href="ui-badges.html">Tambah Produk</a></li>
                            <li><i class="ti-check-box"></i><a href="ui-tabs.html">Kategori Produk</a></li>
                            <li><i class="ti-comment-alt"></i><a href="ui-tabs.html">Ulasan</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i>Blog</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="ti-pencil-alt"></i><a href="ui-badges.html">Tambah Blog</a></li>
                            <li><i class="ti-check-box"></i><a href="ui-tabs.html">Kategori Blog</a></li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="index.html"><i class="menu-icon ti-stats-up"></i>Data Transaksi </a>
                    </li>
                @endrole

            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
