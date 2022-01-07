<header id="header" class="header">
    <div class="top-left">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <strong> Administrator</strong></a>
            <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
        </div>
    </div>
    <div class="top-right">
        <div class="header-menu">
            <div class="header-left">
            </div>

            <div class="user-area dropdown float-right">
                <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                    <svg width="30" height="30" viewBox="0 0 145 145" fill="none" xmlns="http://www.w3.org/2000/svg" >
                        <circle cx="72.5" cy="72.5" r="72.5" fill="#B5B8BD"/>
                        <mask id="mask0_1460_4369" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="145" height="145">
                        <circle cx="72.5" cy="72.5" r="72.5" fill="#FF9292"/>
                        </mask>
                        <g mask="url(#mask0_1460_4369)">
                        <path d="M138.227 148.116C138.425 112.426 109.656 83.3434 73.9826 83.1457C38.2928 82.9479 9.21042 111.717 9.0127 147.391L138.227 148.116Z" fill="#5E5E5D"/>
                        </g>
                        <path d="M73.3186 83.7473C57.7696 83.7473 44.4883 86.1988 44.4883 96.0048C44.4883 105.814 57.6867 108.352 73.3186 108.352C88.8675 108.352 102.149 105.904 102.149 96.0949C102.149 86.2853 88.954 83.7473 73.3186 83.7473Z" fill="#1E1313"/>
                        <path opacity="0.4" d="M73.3186 74.4068C83.9105 74.4068 92.397 65.9167 92.397 55.3284C92.397 44.7401 83.9105 36.25 73.3186 36.25C62.7303 36.25 54.2402 44.7401 54.2402 55.3284C54.2402 65.9167 62.7303 74.4068 73.3186 74.4068Z" fill="#1E1313"/>
                    </svg>
                    <strong>{{ Auth::user()->name }}</strong>
                </a>

                <div class="user-menu dropdown-menu">
                     <!-- Authentication -->
                    <a href="{{ route('edit.profil',Auth::user()->id) }}" class="nav-link">
                        <i class="ti-pencil-alt2"></i>Edit Profil
                    </a>
                     <form method="POST" action="{{ route('logout') }}">
                        @csrf
                    <a class="nav-link" href="route('logout')"
                    onclick="event.preventDefault();
                                    this.closest('form').submit();"><i class="fa fa-power-off"></i>Keluar</a>
                    </form>
                </div>
            </div>

        </div>
    </div>
</header>
