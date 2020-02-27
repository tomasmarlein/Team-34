<nav class="navbar navbar-expand-md shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="/">VZW Keizer Karel Olen</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsNav">
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="collapsNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    @auth
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
                        <a class="nav-link" href="/aanvraagverantwoordelijke"><i class="fas fa-signature"></i> Vereniging aanvragen</a>
                    </li>
                @endguest
                @auth
                        @if(auth()->user()->rolId==1)
                        <li class="nav-item">
                            <a class="nav-link" href="/home"><i class="fas fa-user-shield"></i> Adminpaneel</a>
                        </li>
                        @endif
                            @if(auth()->user()->rolId==3)
                            <li class="nav-item">
                            </li>
                            @endif
                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle" href="#!" data-toggle="dropdown">
                            {{ auth()->user()->voornaam }}  {{ auth()->user()->naam }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="/user/password"><i class="fas fa-key"></i> Wijzig wachtwoord</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/logout"><i class="fas fa-sign-out-alt"></i> Log uit</a>
                            @if(auth()->user()->rolId==1)
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/admin/evenementen"><i class="fas fa-calendar-week"></i> Evenementen</a>
                                <a class="dropdown-item" href="/inaanvraag"><i class="fas fa-pencil-alt"></i></i> Verenigingen in aanvraag</a>
                                <a class="dropdown-item" href="/admin/verenigingen"><i class="fab fa-vuejs"></i> Verenigingen</a>
                                <a class="dropdown-item" href="/admin/kernleden"><i class="fas fa-users"></i> Kernleden</a>
                                <a class="dropdown-item" href="/admin/Admin"><i class="fas fa-user"></i> Administrators</a>
                                <a class="dropdown-item" href="/admin/verantwoordelijke"><i class="far fa-user"></i> Verantwoordelijken</a>
                                <a class="dropdown-item" href="/admin/vrijwilligers"><i class="fas fa-hands-helping"></i> Vrijwilligers</a>
                                <a class="dropdown-item" href="/admin/tijdsregistratie"><i class="fas fa-user-clock"></i>Tijdsregistratie</a>
                                <a class="dropdown-item" href="/admin/tshirt"><i class="fas fa-tshirt"></i></i>T-shirts</a>
                            @endif
                            @if(auth()->user()->rolId==2)
                            @endif
                            @if(auth()->user()->rolId==3)
                                <a class="dropdown-item" href="/verantwoordelijke/verenigingen"><i class="fab fa-vuejs"></i> Vereniging</a>
                            @endif
                        </div>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
