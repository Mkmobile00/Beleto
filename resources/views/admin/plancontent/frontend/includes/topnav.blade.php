<section id="menu-logo">
    <div id="top-bar-nav">
        <div class="container-fluid">
            <div class="row">
                <div class="d-flex">
                    <div class="col-sm-1">
                        <div class="logo">
                            <a href="#" title="Kantipur Cinemas">
                                <img src="{{ asset('frontend/assets/img/logo.jpg') }}" />
                            </a>
                        </div>
                    </div>
                    {{-- @dd($topMenus) --}}
                    {{-- @foreach ($topMenus as $menu)
                    @foreach ($menu['subcat'] as $subMenu)
                                        @dd($subMenu)
                                        @endforeach
                    @endforeach --}}
                    <div class="col-sm-7">
                        <div class="header-top-left">
                            <ul class="ott-nav">
                                <li class="upper-links"><a class="links" href="{{route('home')}}">Home</a></li>
                                @foreach ($topMenus as $menu)
                                <li class="upper-links {{$menu['subcat'] && count($menu['subcat']) > 0 ? 'dropdown':''}}">
                                    <a class="links" href="#">{{$menu['title']}} 
                                        @if($menu['subcat'] && count($menu['subcat']) > 0)
                                            <i class="fa-solid fa-chevron-down"></i>
                                        @endif
                                    </a>
                                    @if($menu['subcat'] && count($menu['subcat']) > 0)
                                        <ul class="dropdown-menu">
                                            @foreach ($menu['subcat'] as $subMenu)
                                                <li class="profile-li">
                                                    <a class="profile-links"
                                                        href="http://yazilife.com/">{{$subMenu['title']}}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="header-top-right">
                            <span class="search-kantipur">
                                <a class="links" href="#"><i class="fa-solid fa-magnifying-glass"></i> </a>
                            </span>
                            <span class="login-button">
                                <a class="links" href="#">Login </a>
                            </span>
                            <span class="register-button">
                                <a class="links" href="#">Register </a>
                            </span>
                            <span class="subscribe-button">
                                <a class="links" href="#"><i class="fa-solid fa-crown"></i> Subscribe</a>
                            </span>
                            <span class="myside-button">
                                <a data-bs-toggle="modal" href="#exampleModalToggle" role="button"><i
                                        class="fa-solid fa-bars-staggered"></i></a>
                                <div class="modal fade" id="exampleModalToggle" aria-hidden="true"
                                    aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Kantipur
                                                    Cinemas</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                We are Kantipur Cinemas, Nepal’s largest OTT platform, dedicated to
                                                delivering premium, high-quality Nepali-originated movies, web
                                                series, and authentic short films to Nepali audiences worldwide
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <h2 style="margin:0px;"><span class="smallnav menu" onclick="openNav()">☰ Kantipur
                            Cinemas</span></h2>

                </div>


            </div>
        </div>
    </div>
    <div id="mySidenav" class="sidenav">
        <div class="container" style="background-color: #2874f0; padding-top: 10px;">
            <span class="sidenav-heading">Home</span>
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        </div>
        <a href="#">Link</a>
        <a href="#">Link</a>
        <a href="#">Link</a>
        <a href="#">Link</a>
    </div>
</section>