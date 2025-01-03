<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        {{-- <li class="nav-item d-none d-sm-inline-block">
            <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li> --}}
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        {{-- <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li> --}}

        <!-- Messages Dropdown Menu -->
        {{-- <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
                <span class="badge badge-danger navbar-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Brad Diesel
                                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">Call me whenever you can...</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                John Pierce
                                <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">I got your message bro</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Nora Silvester
                                <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">The subject goes here</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
        </li> --}}
        <!-- Notifications Dropdown Menu -->
        {{-- <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> 8 friend requests
                    <span class="float-right text-muted text-sm">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li> --}}
        {{-- @dd(session()->get('lang')) --}}
        {{-- <li class="nav-item dropdown c-name">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"
                role="button">
                @if (session()->get('lang') == 'np')
                    <img src="{{ asset(languageData('np', 'image')) }}" class="d-inline" alt="Flag">
                    <span class="c-names" style="vertical-align: middle;">
                        {{ languageData('np', 'name') }}
                    </span>
                @elseif(session()->get('lang') == 'en')
                    <img src="{{ asset(languageData('en', 'image')) }}" class="d-inline" alt="Flag">
                    <span class="c-names" style="vertical-align: middle;">
                        {{ languageData('en', 'name') }}
                    </span>
                @else
                    <img src="{{ asset(languageData('en', 'image')) }}" class="d-inline" alt="Flag">
                    <span class="c-names" style="vertical-align: middle;">
                        {{ languageData('en', 'name') }}
                    </span>
                @endif


            </a>
            <div class="dropdown-menu dropdown-menu-right company-dropdown">
                @foreach (languageData() as $lang)
                    <a href="{{ route('change.language', $lang['code']) }}" class="dropdown-item  badge bg-primary">
                        <img src="{{ asset(@$lang['image']) }}" class="d-inline" alt="Flag">
                        {{ @$lang['name'] }}
                    </a>
                @endforeach
            </div>
        </li> --}}
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

        <li class="nav-item dropdown c-name">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"
                role="button">
                <div class="user-nav d-sm-flex d-none"><span
                        class="user-name fw-bolder">{{ auth()->user()->name }}</span>
                        {{-- <span
                        class="user-status">{{ implode(',',auth()->user()->roles->pluck('name')->toArray()) }}</span> --}}
                </div><span class="avatar"><img class="round" src="{{ auth()->user()->photo ?? @$logo->website_logo }}"
                        alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right company-dropdown">
                <a class="dropdown-item" href="{{ route('user.edit', auth()->user()->id) }}"><i class="me-50"
                        data-feather="user"></i> Profile</a>

                <div class="dropdown-divider"></div>
                    <a href="javascript:;" class="dropdown-item" id="resetPassword">
                        <i class="me-50"
                        data-feather="user"></i> Reset Password
                    </a>
                <div class="dropdown-divider"></div>


                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="dropdown-item" href="#">
                        <i class="me-50" data-feather="power"></i>
                        Logout</button>
                </form>
            </div>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#"
                role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li> --}}
    </ul>
</nav>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Update Password</h5>
            <button type="button" class="btn-close" data-dismiss="modal">
                X
            </button>
        </div>
        <form action="javascript:;" method="post" id="update-adminPassword">
            @method('put')
        <div class="modal-body">
            <div class="form-group">
                <label for="current_password">Current Password</label>
                <input type="password" name="current_password" id="current_password" class="form-control" required>
                <span class="current_password text-danger"></span>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="form-control" >
                <span class="password text-danger"></span>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="form-control" required>
                <span class="password_confirmation text-danger"></span>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" id="updatePasswordBtn" class="btn btn-primary">Update Now</button>
        </div>
    </form>
      </div>
    </div>
  </div>
