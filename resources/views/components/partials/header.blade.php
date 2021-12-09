<header id="header" class="header">
    <div class="top-left">
        <div class="navbar-header">
            <a class="navbar-brand" href="./"><img src="{{ asset('backend/images/logo.png') }}" alt="Logo"></a>
            {{-- <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a> --}}
            <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
        </div>
    </div>
    <div class="top-right">
        <div class="header-menu">
            <div class="header-left">
            </div>

            <div class="user-area dropdown float-right">
                <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{-- <img class="user-avatar rounded-circle" src="{{ asset('backend/images/admin.jpg') }}" alt="User Avatar"> --}}
                    <strong>{{ Auth::user()->name }}</strong>
                </a>

                <div class="user-menu dropdown-menu">
                     <!-- Authentication -->
                     <a class="nav-link" href="#" data-toggle="modal" data-target="#mediumModal"><i class="fa fa-power-off"></i>Logout</a>
                </div>
            </div>

        </div>
    </div>
</header>
