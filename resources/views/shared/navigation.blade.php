<nav class="navbar navbar-expand-md shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="/">VZW Keizer Karel Olen</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contact-us">Contact</a>
                    @auth
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/documentatie">Documentatie</a>
                </li>
                @endauth
            </ul>
            {{--  Admin navigation  --}}
            {{--  Auth navigation  --}}
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="/login"><i class="fas fa-sign-in-alt"></i> Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/aanvraag"><i class="fas fa-signature"></i> Register</a>
                    </li>
                @endguest
                @auth
                        @if(auth()->user()->rolId==1)
                        <li class="nav-item">
                            <a class="nav-link" href="/home"><i class="fas fa-user-shield"></i> adminpaneel</a>
                        </li>
                        @endif
                            @if(auth()->user()->rolId==3)
                            <li class="nav-item">
                                <a class="nav-link" href="#!"><i class="fas fa-users"></i> vereniging</a>
                            </li>
                            @endif
                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle" href="#!" data-toggle="dropdown">
                            {{ auth()->user()->naam }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="/user/profile"><i class="fas fa-user-cog"></i> Update Profile</a>
                            <a class="dropdown-item" href="/user/password"><i class="fas fa-key"></i> New Password</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
                            @if(auth()->user()->rolId==1)
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/admin/evenementen"><i class="fas fa-calendar-week"></i> Evenementen</a>
                                <a class="dropdown-item" href="/admin/verenigingen"><i class="fab fa-vuejs"></i> Verenigingen</a>
                                <a class="dropdown-item" href="/admin/kernleden"><i class="far fa-user"></i> Kernleden</a>
                                <a class="dropdown-item" href="/admin/verantwoordelijke"><i class="far fa-user"></i> Verantwoordelijke</a>
                                <a class="dropdown-item" href="/admin/vrijwilligers"><i class="fas fa-hands-helping"></i> Vrijwilligers</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-user-clock"></i>Tijdsregistratie</a>
                            @endif
                            @if(auth()->user()->rolId==2)
                            @endif
                            @if(auth()->user()->rolId==3)
                                <a class="dropdown-item" href="#!"><i class="fab fa-vuejs"></i> Vereniging</a>
                            @endif
                        </div>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
