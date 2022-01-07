<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                @if (Auth::user()->hasRole('super-admin'))
                    <li class="{{ request()->routeIs('dashboard' ? 'active' : '') }}">
                        <a href="{{ route('dashboard') }}"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                    </li>
                    <li class=" {{ Request::segment(2) == 'banner' ? 'active' : '' }} ">
                        <a href="{{ route('banner.index') }}"><i class="menu-icon ti-image"></i>Banner </a>
                    </li>
                    <li class=" {{ Request::segment(2) == 'banner' ? 'active' : '' }} ">
                        <a href="{{ route('about.index') }}"><i class="menu-icon ti-image"></i>Tentang Desa</a>
                    </li>
                    <li class=" {{ Request::segment(2) == 'product' ? 'active' : ' ' }} ">
                        <a href="{{ route('product.index') }}"><i class="menu-icon ti-package"></i>Product</a>
                    </li>
                    <li class="{{ Request::segment(2) == 'category-product' ? 'active' : '' }}">
                        <a href="{{ route('category-product.index') }}"><i class="menu-icon ti-notepad"></i>Kategori Produk</a>
                    </li>
                    <li class="{{ Request::segment(2) == 'blog' ? 'active' : '' }}">
                        <a href="{{ route('blog.index') }}"><i class="menu-icon ti-book"></i>Blog/Artikel</a>
                    </li>
                    <li class="{{ Request::segment(2) == 'category-blog' ? 'active' : '' }}">
                        <a href="{{ route('category-blog.index') }}"><i class="menu-icon ti-notepad"></i>Kategori Blog/Artikel</a>
                    </li>
                    <li class="{{ Request::segment(2) == 'transaksi' ? 'active' : '' }}">
                        <a href="{{ route('transaksi') }}"><i class="menu-icon ti-shopping-cart"></i>Transaksi</a>
                    </li>
                    <li class="{{ Request()->routeIs('user.index') ? 'active' : '' }}">
                        <a href="{{ route('user.index') }}"><i class="menu-icon ti-user"></i>Data Admin </a>
                    </li>
                @else
                    <li class="{{ request()->routeIs('dashboard' ? 'active' : '') }}">
                        <a href="{{ route('dashboard') }}"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                    </li>
                    <li class=" {{ Request::segment(2) == 'banner' ? 'active' : '' }} ">
                        <a href="{{ route('banner.index') }}"><i class="menu-icon ti-image"></i>Banner </a>
                    </li>
                    <li class=" {{ Request::segment(2) == 'product' ? 'active' : ' ' }} ">
                        <a href="{{ route('product.index') }}"><i class="menu-icon ti-package"></i>Product</a>
                    </li>
                    <li class="{{ Request::segment(2) == 'category-product' ? 'active' : '' }}">
                        <a href="{{ route('category-product.index') }}"><i class="menu-icon ti-notepad"></i>Kategori Produk</a>
                    </li>
                    <li class="{{ Request::segment(2) == 'blog' ? 'active' : '' }}">
                        <a href="{{ route('blog.index') }}"><i class="menu-icon ti-book"></i>Blog/Artikel</a>
                    </li>
                    <li class="{{ Request::segment(2) == 'category-blog' ? 'active' : '' }}">
                        <a href="{{ route('category-blog.index') }}"><i class="menu-icon ti-notepad"></i>Kategori Blog/Artikel</a>
                    </li>
                    <li class="{{ Request::segment(2) == 'transaksi' ? 'active' : '' }}">
                        <a href="{{ route('transaksi') }}"><i class="menu-icon ti-shopping-cart"></i>Transaksi</a>
                    </li>
                @endif



            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
