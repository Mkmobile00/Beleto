<section id="menu-logo">
    <div id="top-bar-nav">
        <div class="container-fluid">
            <div class="row">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="logo-column">
                        <div class="logo">
                            <a href="{{route('home')}}" title="Kantipur Cinemas">
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
                    <div class="mid-column">
                        <div class="header-top-left">
                            <ul class="ott-nav">
                                <li class="upper-links"><a class="links" href="{{route('home')}}">Home</a></li>
                                @foreach ($topMenus as $menu)
                                <li class="upper-links {{$menu['subcat'] && count($menu['subcat']) > 0 ? 'dropdown':''}}">
                                    <a class="links" href="{{route('category.details',[$menu['slug'],$menu['type']])}}">{{$menu['title']}}
                                        @if($menu['subcat'] && count($menu['subcat']) > 0)
                                            <i class="fa-solid fa-chevron-down"></i>
                                        @endif
                                    </a>
                                    @if($menu['subcat'] && count($menu['subcat']) > 0)
                                        <ul class="dropdown-menu">
                                            @foreach ($menu['subcat'] as $subMenu)
                                                <li class="profile-li">
                                                    <a class="profile-links"
                                                        href="{{route('category.details',[$subMenu['slug'],$subMenu['type']])}}">{{$subMenu['title']}}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                                @endforeach
                                @foreach ($headerPages as $page)
                                    <li class="upper-links {{$menu['subcat'] && count($menu['subcat']) > 0 ? 'dropdown':''}}">
                                        <a class="links" href="{{route('page.details',$page->slug)}}">{{$page->name}}
                                            @if($page->children && count($page->children) > 0)
                                                <i class="fa-solid fa-chevron-down"></i>
                                            @endif
                                        </a>
                                        @if($page->children && count($page->children) > 0)
                                            <ul class="dropdown-menu">
                                                @foreach ($page->children as $subMenu)
                                                    <li class="profile-li">
                                                        <a class="profile-links"
                                                            href="{{route('page.details',$subMenu->slug)}}">{{$subMenu->name}}
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
                    <div class="right-column">
                        <div class="header-top-right d-flex align-items-center flex-wrap">
                            <span class="search-kantipur">
                                <a class="links" href="#" id="search_icon"><i class="fa-solid fa-magnifying-glass"></i></a>
                            </span>
                            <span class="login-button">
                                @isset($customer)
                                    @if($customer)
                                    <a class="links" href="{{route('customer.dashboard')}}">{{@($customer->customerDetail->first_name.' '.@$customer->customerDetail->last_name) ?? @$customer->email}} </a>
                                    <a href="{{route('customer.logout')}}" class="links">Logout</a>
                                    <form action="{{route('setCustomerCurrency')}}" method="post" id="currencySetForm" style="display:inline; border: 1px solid #fff;">
                                        @csrf
                                        <select name="currency_id" id="selectCurrency">
                                            @foreach ($currencyTypes as $type)
                                            <option value="{{$type['id']}}" {{@$customer->cutomerDefaultCurrency->currency_id==$type['id'] ? 'selected':''}}>{{$type['text']}}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                    @else
                                        <a class="links" href="{{route('customer.login')}}">Login </a>
                                        <a class="links" href="{{route('customer.register')}}">Register </a>
                                    @endif
                                @else
                                <a class="links" href="{{route('customer.login')}}">Login </a>
                                <a class="links" href="{{route('customer.register')}}">Register </a>
                                @endisset

                            </span>

                            <span class="subscribe-button">
                                <a class="links" href="{{route('customer.subscription')}}"><i class="fa-solid fa-crown"></i> Subscribe</a>
                            </span>
                            <span class="myside-button" >
                                <a data-bs-toggle="modal" style="padding: 0; font-size: 18px;" href="#exampleModalToggle" role="button"><i
                                        class="fa-solid fa-bars-staggered"></i></a>
                                <div class="modal fade" id="exampleModalToggle" aria-hidden="true"
                                    aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content bg-color">
                                            <div class="modal-header d-flex justify-content-between align-items-center">
                                                <h1 class="modal-title fs-5 text-white">Kantipur Cinemas </h1>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-close"></i></button>
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

                            @if($customer)
                                <span class="wishlist-icon">
                                    <i class="fas fa-shopping-cart"></i>
                                    <div class="count">
                                        <span>{{count($customer->wishList)}}</span>
                                    </div>
                                </span>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <h2 style="margin:0px;"><span class="smallnav menu" onclick="openNav()">☰ Kantipur Cinemas</span></h2>
                </div>
            </div>
        </div>
    </div>
    <!-- sidebar  -->
    <div id="mySidenav" class="sidenav">
        <div class="container" style="background-color: #0f0617;">
          <span class="sidenav-heading">Kantipur Cinemas</span>
          <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        </div>
        <ul class="d-flex flex-column">
            <li class="upper-links"><a class="links" href="{{route('home')}}">Home</a></li>
            @foreach ($topMenus as $menu)
            <li class="upper-links {{$menu['subcat'] && count($menu['subcat']) > 0 ? 'dropdown':''}}">
                <div class="d-flex justify-content-between align-items-center">
                    <a class="links" href="{{route('category.details',[$menu['slug'],$menu['type']])}}">{{$menu['title']}}
                    </a>
                    @if($menu['subcat'] && count($menu['subcat']) > 0)
                        <i class="fa-solid fa-chevron-down toggle-icon p-1"></i>
                    @endif
                </div>
                @if($menu['subcat'] && count($menu['subcat']) > 0)
                    <ul class="dropdown-menu">
                        @foreach ($menu['subcat'] as $subMenu)
                            <li class="profile-li">
                                <a class="profile-links"
                                    href="{{route('category.details',[$subMenu['slug'],$subMenu['type']])}}">{{$subMenu['title']}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
            @endforeach
            @foreach ($headerPages as $page)
                <li class="upper-links {{$menu['subcat'] && count($menu['subcat']) > 0 ? 'dropdown':''}}">
                    <div class="d-flex justify-content-between align-items-center">
                        <a class="links" href="{{route('page.details',$page->slug)}}">{{$page->name}}

                        </a>
                        @if($page->children && count($page->children) > 0)
                                <i class="fa-solid fa-chevron-down toggle-icon p-1"></i>
                            @endif
                    </div>
                    @if($page->children && count($page->children) > 0)
                        <ul class="dropdown-menu">
                            @foreach ($page->children as $subMenu)
                                <li class="profile-li">
                                    <a class="profile-links"
                                        href="{{route('page.details',$subMenu->slug)}}">{{$subMenu->name}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
      </div>

      <!-- modal for search  -->
        <div class="modal fade" id="searchModal" aria-hidden="true" aria-labelledby="searchModalLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content bg-color">
            <div class="modal-header d-flex justify-content-between align-items-center">
              <h1 class="modal-title fs-5 text-white">Search</h1>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-close"></i></button>
            </div>
            <div class="modal-body">
                <form action="{{route('customer.search')}}">
                <input type="text" placeholder="Search Here..." class="form-control" name="searchItem" style="padding: 10px;" required>
                <div class="text-end">
                    <button type="submit" class="btn btn-outline-secondary">Search</button>
                </div>
                </form>
            </div>
          </div>
        </div>
      </div>

</section>

@if($customer)
<div class="wishlist-container">
    <div class="wishlist">
        <span class="wishlist_close">
            <i class="fas fa-times"></i>
        </span>
        <div class="container-fluid mt-3">

            <div class="col" id="updateWishList">
                @foreach (userWishList($customer) as $data)
                {{-- @dd($data) --}}
                <div class="d-flex justify-content-between border-bottom mb-3">
                    <div class="wishlist_img">
                        <img src="{{@$data['image']}}" alt="img" style="width: 100%">
                        <div class="overlay_close"><i class="fa fa-close removeWishlist" data-id="{{$data['id']}}"></i></div>
                    </div>
                    <div class="ms-4">
                        <p style="margin: 0;"><strong>{{@$data['title']}}</strong></p>
                        <span>{{@$data['rating']}}</span>

                        <div class="description">
                            <a href="{{route('movieDetailsPage',[@$data['slug'],@$data['type']])}}">View</a>
                        </div>
                    </div>
                </div>

                @endforeach
            </div>
        </div>
    </div>
</div>
@endif



