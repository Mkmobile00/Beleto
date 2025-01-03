<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    {{-- <a href="index3.html" class="brand-link">
        <img src="{{@$logo->website_logo}}" alt="{{@$setting->site_name}}" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">{{@$setting->site_name}}</span>
    </a> --}}

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ @$logo->website_logo }}" class="img-circle elevation-2" alt="{{ @$setting->site_name }}">
            </div>
            <div class="info">
                <a href="{{ route('dashboard') }}" class="d-block">{{ @$setting->site_name ?? '' }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
                @if (Auth::user()->can('View Dashboard'))
                    <li class="nav-item ">
                        <a href="{{ route('dashboard') }}"
                            class="nav-link {{ request()->route()->uri === 'nd-admin/dashboard' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-microchip"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>

                    </li>
                @endif

                <!-- <li
                    class="nav-item {{ request()->route()->uri === 'nd-admin/movie/create' || request()->route()->uri === 'nd-admin/movie' || request()->route()->uri === 'nd-admin/movie/{movie}/edit' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file-video"></i>
                        <p>
                            Movie
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (Auth::user()->can('Create Movie'))
                        <li class="nav-item">
                            <a href="{{ route('movie.create') }}"
                                class="nav-link {{ request()->route()->uri === 'nd-admin/movie/create' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>New Movie</p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->can('View Movie'))
                        <li class="nav-item">
                            <a href="{{ route('movie.index') }}"
                                class="nav-link {{ request()->route()->uri === 'nd-admin/movie' || request()->route()->uri === 'nd-admin/movie/{movie}/edit' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Movie</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li> -->

                <!-- <li
                    class="nav-item {{ request()->route()->uri === 'nd-admin/webseries/episode/{id}/create' || request()->route()->uri === 'nd-admin/webseries/create' || request()->route()->uri === 'nd-admin/webseries' || request()->route()->uri === 'nd-admin/webseries/{webseries}/edit' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-compact-disc"></i>
                        <p>
                            Web Series
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (Auth::user()->can('Create WebSeries'))
                        <li class="nav-item">
                            <a href="{{ route('webseries.create') }}"
                                class="nav-link {{ request()->route()->uri === 'nd-admin/webseries/create' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>New Web Series</p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->can('View WebSeries'))
                        <li class="nav-item">
                            <a href="{{ route('webseries.index') }}"
                                class="nav-link {{ request()->route()->uri === 'nd-admin/webseries' || request()->route()->uri === 'nd-admin/webseries/{webseries}/edit' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Web Series</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li> -->




                <li
                    class="nav-item {{ request()->route()->uri === 'nd-admin/user' || request()->route()->uri === 'nd-admin/user/create' || request()->route()->uri === 'nd-admin/user/{user}/edit' || request()->route()->uri === 'nd-admin/role' || request()->route()->uri === 'nd-admin/permission' || request()->route()->uri === 'nd-admin/role/{role}/edit' || request()->route()->uri === 'nd-admin/permission/{permission}/edit'  ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            User Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">


                            <li
                                class="nav-item {{ request()->route()->uri === 'nd-admin/role' || request()->route()->uri === 'nd-admin/permission' || request()->route()->uri === 'nd-admin/role/{role}/edit' || request()->route()->uri === 'nd-admin/permission/{permission}/edit' ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-user-tag"></i>
                                    <p>
                                        Roles/Permissions
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @if (Auth::user()->can('View Role'))
                                    <li class="nav-item">
                                        <a href="{{ route('role.index') }}"
                                            class="nav-link {{ request()->route()->uri === 'nd-admin/role' || request()->route()->uri === 'nd-admin/role/{role}/edit' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>All Roles</p>
                                        </a>
                                    </li>
                                    @endif
                                    @if (Auth::user()->can('View Permission'))
                                    <li class="nav-item">
                                        <a href="{{ route('permission.index') }}"
                                            class="nav-link {{ request()->route()->uri === 'nd-admin/permission' || request()->route()->uri === 'nd-admin/permission/{permission}/edit' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Permission</p>
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                            </li>
                        @if (Auth::user()->can('View User'))
                            <li
                                class="nav-item {{ request()->route()->uri === 'nd-admin/user' || request()->route()->uri === 'nd-admin/user/create' || request()->route()->uri === 'nd-admin/user/{user}/edit' ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        User
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @if (Auth::user()->can('View User'))
                                        <li class="nav-item">
                                            <a href="{{ route('user.index') }}"
                                                class="nav-link {{ request()->route()->uri === 'nd-admin/user' ? 'active' : '' }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>All User</p>
                                            </a>
                                        </li>
                                    @endif
                                    @if (Auth::user()->can('Create User'))
                                    <li class="nav-item">
                                        <a href="{{ route('user.create') }}"
                                            class="nav-link {{ request()->route()->uri === 'nd-admin/user/create' || request()->route()->uri === 'nd-admin/user/{user}/edit' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Add User</p>
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                    </ul>
                </li>

                <li
                    class="nav-item {{ request()->route()->uri === 'nd-admin/menu' || request()->route()->uri === 'nd-admin/post/create' || request()->route()->uri === 'nd-admin/post' || request()->route()->uri === 'nd-admin/post-category' || request()->route()->uri === 'nd-admin/post/{post}/edit' || request()->route()->uri === 'nd-admin/post-category/{post_category}/edit' || request()->route()->uri === 'nd-admin/featuredsection/create' || request()->route()->uri === 'nd-admin/featuredsection' || request()->route()->uri === 'nd-admin/language-selection/create' || request()->route()->uri === 'nd-admin/language-selection' || request()->route()->uri === 'nd-admin/language-selection/{language_selection}/edit' || request()->route()->uri === 'nd-admin/slider/create' || request()->route()->uri === 'nd-admin/slider' || request()->route()->uri === 'nd-admin/slider/{slider}/edit' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>
                            Website Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (Auth::user()->can('Create Slider'))
                        <li
                            class="nav-item {{ request()->route()->uri === 'nd-admin/slider/create' || request()->route()->uri === 'nd-admin/slider' || request()->route()->uri === 'nd-admin/slider/{slider}/edit' ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-sliders-h"></i>
                                <p>
                                    Sliders
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if (Auth::user()->can('Create Slider'))
                                <li class="nav-item">
                                    <a href="{{ route('slider.create') }}"
                                        class="nav-link {{ request()->route()->uri === 'nd-admin/slider/create' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>New Sliders</p>
                                    </a>
                                </li>
                                @endif
                                @if (Auth::user()->can('View Slider'))
                                <li class="nav-item">
                                    <a href="{{ route('slider.index') }}"
                                        class="nav-link {{ request()->route()->uri === 'nd-admin/slider' || request()->route()->uri === 'nd-admin/slider/{slider}/edit' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Sliders</p>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        @endif

                        <li
                            class="nav-item {{ request()->route()->uri === 'nd-admin/language-selection/create' || request()->route()->uri === 'nd-admin/language-selection' || request()->route()->uri === 'nd-admin/language-selection/{language_selection}/edit' ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-language"></i>
                                <p>
                                    Language
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if (Auth::user()->can('Create Language'))
                                <li class="nav-item">
                                    <a href="{{ route('language-selection.create') }}"
                                        class="nav-link {{ request()->route()->uri === 'nd-admin/language-selection/create' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>New Language</p>
                                    </a>
                                </li>
                                @endif
                                @if (Auth::user()->can('View Language'))
                                <li class="nav-item">
                                    <a href="{{ route('language-selection.index') }}"
                                        class="nav-link {{ request()->route()->uri === 'nd-admin/language-selection' || request()->route()->uri === 'nd-admin/language-selection/{language_selection}/edit' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Language</p>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>

                        <!-- <li
                            class="nav-item {{ request()->route()->uri === 'nd-admin/featuredsection/create' || request()->route()->uri === 'nd-admin/featuredsection' ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-puzzle-piece"></i>
                                <p>
                                    Featured Section
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if (Auth::user()->can('Create Featured'))
                                <li class="nav-item">
                                    <a href="{{ route('featuredsection.create') }}"
                                        class="nav-link {{ request()->route()->uri === 'nd-admin/featuredsection/create' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>New Featured Section</p>
                                    </a>
                                </li>
                                @endif
                                @if (Auth::user()->can('View Featured'))
                                <li class="nav-item">
                                    <a href="{{ route('featuredsection.index') }}"
                                        class="nav-link {{ request()->route()->uri === 'nd-admin/featuredsection' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Featured Section</p>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li> -->

                        <li
                            class="nav-item {{ request()->route()->uri === 'nd-admin/post/create' || request()->route()->uri === 'nd-admin/post' || request()->route()->uri === 'nd-admin/post-category' || request()->route()->uri === 'nd-admin/post/{post}/edit' || request()->route()->uri === 'nd-admin/post-category/{post_category}/edit' ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-mail-bulk"></i>
                                <p>
                                    Post
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if (Auth::user()->can('Create Post'))
                                <li class="nav-item">
                                    <a href="{{ route('post.create') }}"
                                        class="nav-link {{ request()->route()->uri === 'nd-admin/post/create' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>New Post</p>
                                    </a>
                                </li>
                                @endif
                                @if (Auth::user()->can('View Post'))
                                <li class="nav-item">
                                    <a href="{{ route('post.index') }}"
                                        class="nav-link {{ request()->route()->uri === 'nd-admin/post' || request()->route()->uri === 'nd-admin/post/{post}/edit' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Post</p>
                                    </a>
                                </li>
                                @endif
                                @if (Auth::user()->can('View Post Category'))
                                <li class="nav-item">
                                    <a href="{{ route('post-category.index') }}"
                                        class="nav-link {{ request()->route()->uri === 'nd-admin/post-category' || request()->route()->uri === 'nd-admin/post-category/{post_category}/edit' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Category</p>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>

                        @if (Auth::user()->can('View Menu'))
                            <li class="nav-item ">

                                <a href="{{ route('menu.index') }}"
                                    class="nav-link {{ request()->route()->uri === 'nd-admin/menu' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-microchip"></i>
                                    <p>
                                        Menu
                                    </p>
                                </a>

                            </li>
                        @endif


                    </ul>
                </li>

                <!-- <li
                    class="nav-item {{ request()->route()->uri === 'nd-admin/audio-quality' || request()->route()->uri === 'nd-admin/audio-quality/{audio_quality}/edit' || request()->route()->uri === 'nd-admin/video-quality' || request()->route()->uri === 'nd-admin/video-quality/{video_quality}/edit' || request()->route()->uri === 'nd-admin/category/create' || request()->route()->uri === 'nd-admin/category' || request()->route()->uri === 'nd-admin/category/{category}/edit' || request()->route()->uri === 'nd-admin/genre/create' || request()->route()->uri === 'nd-admin/genre' || request()->route()->uri === 'nd-admin/genre/{genre}/edit' || request()->route()->uri === 'nd-admin/star/create' || request()->route()->uri === 'nd-admin/star' || request()->route()->uri === 'nd-admin/star/{star}/edit' || request()->route()->uri === 'nd-admin/country/create' || request()->route()->uri === 'nd-admin/country' || request()->route()->uri === 'nd-admin/country/{country}/edit' || request()->route()->uri === 'nd-admin/video-type' || request()->route()->uri === 'nd-admin/video-type/{video_type}/edit' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-video"></i>
                        <p>
                            Movie/Video Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        @if (Auth::user()->can('View Video Type'))
                        <li
                            class="nav-item {{ request()->route()->uri === 'nd-admin/video-type' || request()->route()->uri === 'nd-admin/video-type/{video_type}/edit' ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-video"></i>
                                <p>
                                    Video Type
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if (Auth::user()->can('View Video Type'))
                                <li class="nav-item">
                                    <a href="{{ route('video-type.index') }}"
                                        class="nav-link {{ request()->route()->uri === 'nd-admin/video-type' || request()->route()->uri === 'nd-admin/video-type/{video_type}/edit' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Video Type</p>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        @endif

                        <li
                            class="nav-item {{ request()->route()->uri === 'nd-admin/country/create' || request()->route()->uri === 'nd-admin/country' || request()->route()->uri === 'nd-admin/country/{country}/edit' ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-globe"></i>
                                <p>
                                    Country
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if (Auth::user()->can('Add Country'))
                                <li class="nav-item">
                                    <a href="{{ route('country.create') }}"
                                        class="nav-link {{ request()->route()->uri === 'nd-admin/country/create' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>New Country</p>
                                    </a>
                                </li>
                                @endif
                                @if (Auth::user()->can('View Country'))
                                <li class="nav-item">
                                    <a href="{{ route('country.index') }}"
                                        class="nav-link {{ request()->route()->uri === 'nd-admin/country' || request()->route()->uri === 'nd-admin/country/{country}/edit' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Country</p>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>

                        <li
                            class="nav-item {{ request()->route()->uri === 'nd-admin/star/create' || request()->route()->uri === 'nd-admin/star' || request()->route()->uri === 'nd-admin/star/{star}/edit' ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-star"></i>
                                <p>
                                    Star/Casts
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if (Auth::user()->can('Add Start'))
                                <li class="nav-item">
                                    <a href="{{ route('star.create') }}"
                                        class="nav-link {{ request()->route()->uri === 'nd-admin/star/create' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>New Star</p>
                                    </a>
                                </li>
                                @endif
                                @if (Auth::user()->can('View Star'))
                                <li class="nav-item">
                                    <a href="{{ route('star.index') }}"
                                        class="nav-link {{ request()->route()->uri === 'nd-admin/star' || request()->route()->uri === 'nd-admin/star/{star}/edit' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Star</p>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>

                        <li
                            class="nav-item {{ request()->route()->uri === 'nd-admin/genre/create' || request()->route()->uri === 'nd-admin/genre' || request()->route()->uri === 'nd-admin/genre/{genre}/edit' ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-text-width"></i>
                                <p>
                                    Genre
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if (Auth::user()->can('Add Genre'))
                                <li class="nav-item">
                                    <a href="{{ route('genre.create') }}"
                                        class="nav-link {{ request()->route()->uri === 'nd-admin/genre/create' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>New Genre</p>
                                    </a>
                                </li>
                                @endif
                                @if (Auth::user()->can('View Genre'))
                                <li class="nav-item">
                                    <a href="{{ route('genre.index') }}"
                                        class="nav-link {{ request()->route()->uri === 'nd-admin/genre' || request()->route()->uri === 'nd-admin/genre/{genre}/edit' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Genre</p>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>

                        <li
                            class="nav-item {{ request()->route()->uri === 'nd-admin/category/create' || request()->route()->uri === 'nd-admin/category' || request()->route()->uri === 'nd-admin/category/{category}/edit' ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-list"></i>
                                <p>
                                    Movie Category
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if (Auth::user()->can('Create Movie Category'))
                                <li class="nav-item">
                                    <a href="{{ route('category.create') }}"
                                        class="nav-link {{ request()->route()->uri === 'nd-admin/category/create' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>New Category</p>
                                    </a>
                                </li>
                                @endif
                                @if (Auth::user()->can('View Movie Category'))
                                <li class="nav-item">
                                    <a href="{{ route('category.index') }}"
                                        class="nav-link {{ request()->route()->uri === 'nd-admin/category' || request()->route()->uri === 'nd-admin/category/{category}/edit' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Category</p>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        @if (Auth::user()->can('View Video Quality'))
                        <li class="nav-item">
                            <a href="{{ route('video-quality.index') }}"
                                class="nav-link {{ request()->route()->uri === 'nd-admin/video-quality' || request()->route()->uri === 'nd-admin/video-quality/{video_quality}/edit' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Video Quality</p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->can('View Audio Quality'))
                        <li class="nav-item">
                            <a href="{{ route('audio-quality.index') }}"
                                class="nav-link {{ request()->route()->uri === 'nd-admin/audio-quality' || request()->route()->uri === 'nd-admin/audio-quality/{audio_quality}/edit' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Audio Quality</p>
                            </a>
                        </li>
                        @endif

                    </ul>
                </li> -->

                <!-- <li
                    class="nav-item {{ request()->route()->uri === 'nd-admin/subscription/create' || request()->route()->uri === 'nd-admin/subscription' || request()->route()->uri === 'nd-admin/period' || request()->route()->uri === 'nd-admin/period/{period}/edit' || request()->route()->uri === 'nd-admin/plan-content/{plan_content}/edit' || request()->route()->uri === 'nd-admin/plan' || request()->route()->uri === 'nd-admin/plan/create' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-compact-disc"></i>
                        <p>
                            Subscription Mng
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li
                            class="nav-item {{ request()->route()->uri === 'nd-admin/plan-content/{plan_content}/edit' || request()->route()->uri === 'nd-admin/plan' || request()->route()->uri === 'nd-admin/plan/create' ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-lightbulb"></i>
                                <p>
                                    Plan
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if (Auth::user()->can('View Plan Content'))
                                <li class="nav-item">
                                    <a href="{{ route('plan-content.index') }}"
                                        class="nav-link {{ request()->route()->uri === 'nd-admin/plan-content/{plan_content}/edit' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Plan Content</p>
                                    </a>
                                </li>
                                @endif
                                @if (Auth::user()->can('Create Plan'))
                                <li class="nav-item">
                                    <a href="{{ route('plan.create') }}"
                                        class="nav-link {{ request()->route()->uri === 'nd-admin/plan/create' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>New Plan</p>
                                    </a>
                                </li>
                                @endif
                                @if (Auth::user()->can('View Plan'))
                                <li class="nav-item">
                                    <a href="{{ route('plan.index') }}"
                                        class="nav-link {{ request()->route()->uri === 'nd-admin/plan' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Plan</p>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        <li
                            class="nav-item {{ request()->route()->uri === 'nd-admin/period' || request()->route()->uri === 'nd-admin/period/{period}/edit' ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-calendar-times"></i>
                                <p>
                                    Period
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if (Auth::user()->can('View Period'))
                                <li class="nav-item">
                                    <a href="{{ route('period.index') }}"
                                        class="nav-link {{ request()->route()->uri === 'nd-admin/period' || request()->route()->uri === 'nd-admin/period/{period}/edit' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Period</p>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        <li
                            class="nav-item {{ request()->route()->uri === 'nd-admin/subscription/create' || request()->route()->uri === 'nd-admin/subscription' ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-box-open"></i>
                                <p>
                                    Subscription
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if (Auth::user()->can('Create Subscription'))
                                <li class="nav-item">
                                    <a href="{{ route('subscription.create') }}"
                                        class="nav-link {{ request()->route()->uri === 'nd-admin/subscription/create' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>New Subscription</p>
                                    </a>
                                </li>
                                @endif
                                @if (Auth::user()->can('View Subscription'))
                                <li class="nav-item">
                                    <a href="{{ route('subscription.index') }}"
                                        class="nav-link {{ request()->route()->uri === 'nd-admin/subscription' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Subscription</p>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                    </ul>
                </li> -->

                <li
                    class="nav-item {{ request()->route()->uri === 'nd-admin/startupadd/create' || request()->route()->uri === 'nd-admin/startupadd/list' || request()->route()->uri === 'nd-admin/startupadd/show/{id}' || request()->route()->uri === 'nd-admin/pushnotification' || request()->route()->uri === 'nd-admin/pushnotification/create' || request()->route()->uri === 'nd-admin/pushnotification/{pushnotification}/edit' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-bullhorn"></i>
                        <p>
                            Marketing
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (Auth::user()->can('View Push Notification'))
                        <li
                            class="nav-item {{ request()->route()->uri === 'nd-admin/pushnotification' || request()->route()->uri === 'nd-admin/pushnotification/create' || request()->route()->uri === 'nd-admin/pushnotification/{pushnotification}/edit' ? 'menu-open' : '' }}">
                            <a href="{{ route('pushnotification.index') }}"
                                class="nav-link {{ request()->route()->uri === 'nd-admin/pushnotification' || request()->route()->uri === 'nd-admin/pushnotification/create' || request()->route()->uri === 'nd-admin/pushnotification/{pushnotification}/edit' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-envelope-open-text"></i>
                                <p>
                                    Push Notification
                                </p>
                            </a>

                        </li>
                        @endif

                            <li
                                class="nav-item {{ request()->route()->uri === 'nd-admin/startupadd/create' || request()->route()->uri === 'nd-admin/startupadd/list' || request()->route()->uri === 'nd-admin/startupadd/show/{id}' ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Startup Add
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @if (Auth::user()->can('Create Startup Add'))
                                    <li class="nav-item">
                                        <a href="{{ route('startupadd.create') }}"
                                            class="nav-link {{ request()->route()->uri === 'nd-admin/startupadd/create' || request()->route()->uri === 'nd-admin/startupadd/show/{id}' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Add StartupAdd</p>
                                        </a>
                                    </li>
                                    @endif
                                    @if (Auth::user()->can('View Startup Add'))
                                    <li class="nav-item">
                                        <a href="{{ route('startupadd.index') }}"
                                            class="nav-link {{ request()->route()->uri === 'nd-admin/startupadd/list' || request()->route()->uri === 'nd-admin/startupadd/show/{id}' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>All StartupAdd</p>
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                            </li>

                    </ul>
                </li>

                <!-- <li
                    class="nav-item {{ request()->route()->uri === 'nd-admin/alltransaction' || request()->route()->uri === 'nd-admin/customer/create' || request()->route()->uri === 'nd-admin/customer/list' || request()->route()->uri === 'nd-admin/customer/show/{id}' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Reports
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (Auth::user()->can('View Customer'))
                            <li
                                class="nav-item {{ request()->route()->uri === 'nd-admin/customer/create' || request()->route()->uri === 'nd-admin/customer/list' || request()->route()->uri === 'nd-admin/customer/show/{id}' ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Customer
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @if (Auth::user()->can('Create Customer'))
                                    <li class="nav-item">
                                        <a href="{{ route('customer.create') }}"
                                            class="nav-link {{ request()->route()->uri === 'nd-admin/customer/create' || request()->route()->uri === 'nd-admin/customer/show/{id}' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Add Customer</p>
                                        </a>
                                    </li>
                                    @endif
                                    @if (Auth::user()->can('View Customer'))
                                    <li class="nav-item">
                                        <a href="{{ route('customer.list') }}"
                                            class="nav-link {{ request()->route()->uri === 'nd-admin/customer/list' || request()->route()->uri === 'nd-admin/customer/show/{id}' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>All Customer</p>
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                            <li
                                class="nav-item {{ request()->route()->uri === 'nd-admin/alltransaction' ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Transaction
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @if (Auth::user()->can('View Transaction'))
                                    <li class="nav-item">
                                        <a href="{{ route('alltransaction.view') }}"
                                            class="nav-link {{ request()->route()->uri === 'nd-admin/alltransaction' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>All Transaction</p>
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                            </li>

                    </ul>
                </li> -->












                {{-- <li class="nav-item {{ (request()->route()->uri==='nd-admin/tvseries/episode/{id}/create' || request()->route()->uri==='nd-admin/tvseries/episode/{id}' || request()->route()->uri==='nd-admin/tvseries/episode/{id}/edit' || request()->route()->uri==='nd-admin/tvseries/create' || request()->route()->uri==='nd-admin/tvseries' || request()->route()->uri==='nd-admin/tvseries/{tvseries}/edit') ? 'menu-open' :'' }}">
                <!-- <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-tv"></i>
                    <p>
                        Tv Series
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">

                    <li class="nav-item">
                        <a href="{{ route('tvseries.create') }}" class="nav-link {{ (request()->route()->uri==='nd-admin/tvseries/create') ? 'active' :'' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>New Tv Series</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('tvseries.index') }}" class="nav-link {{ (request()->route()->uri==='nd-admin/tvseries' || request()->route()->uri==='nd-admin/tvseries/{tvseries}/edit') ? 'active' :'' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Tv Series</p>
                        </a>
                    </li>
                </ul> -->
            </li> --}}

                <!-- <li
                    class="nav-item {{ request()->route()->uri === 'nd-admin/stremming/episode/{id}/create' || request()->route()->uri === 'nd-admin/stremming/create' || request()->route()->uri === 'nd-admin/stremming' || request()->route()->uri === 'nd-admin/stremming/{stremming}/edit' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-compact-disc"></i>
                        <p>
                            Stremming
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (Auth::user()->can('Create Stremming'))
                        <li class="nav-item">
                            <a href="{{ route('stremming.create') }}"
                                class="nav-link {{ request()->route()->uri === 'nd-admin/stremming/create' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>New Stremming</p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->can('View Stremming'))
                        <li class="nav-item">
                            <a href="{{ route('stremming.index') }}"
                                class="nav-link {{ request()->route()->uri === 'nd-admin/stremming' || request()->route()->uri === 'nd-admin/stremming/{stremming}/edit' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Stremming</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li> -->

                {{-- @dd(request()->route()->uri) --}}




                    <li
                        class="nav-item {{ request()->route()->uri === 'nd-admin/websitelogo-setting/{websitelogo_setting}/edit' || request()->route()->uri === 'nd-admin/system-setting/{system_setting}/edit' || request()->route()->uri === 'nd-admin/device' || request()->route()->uri === 'nd-admin/audio-quality' || request()->route()->uri === 'nd-admin/audio-quality/{audio_quality}/edit' || request()->route()->uri === 'nd-admin/system-setting/create' || request()->route()->uri === 'nd-admin/theme-option/create' || request()->route()->uri === 'nd-admin/android-setting/create' || request()->route()->uri === 'nd-admin/email-setting/create' || request()->route()->uri === 'nd-admin/websitelogo-setting/create' || request()->route()->uri === 'nd-admin/footer-setting/create' || request()->route()->uri === 'nd-admin/seosocial-setting/{seosocial_setting}/edit' || request()->route()->uri === 'nd-admin/video-quality' ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tools"></i>
                            <p>
                                Settings
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (Auth::user()->can('View Device'))
                            <li class="nav-item">
                                <a href="{{ route('device.index') }}"
                                    class="nav-link {{ request()->route()->uri === 'nd-admin/device' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Device</p>
                                </a>
                            </li>
                            @endif
                            @if (Auth::user()->can('View System Setting'))
                            <li class="nav-item">
                                <a href="{{ route('system-setting.index') }}"
                                    class="nav-link {{ request()->route()->uri === 'nd-admin/system-setting/{system_setting}/edit' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>System Setting</p>
                                </a>
                            </li>
                            @endif
                            {{-- <li class="nav-item">
                        <a href="{{ route('theme-option.index') }}" class="nav-link {{ (request()->route()->uri==='nd-admin/theme-option/create') ? 'active' :'' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Theme Option</p>
                        </a>
                    </li> --}}
                            {{-- <li class="nav-item">
                        <a href="{{ route('android-setting.index') }}" class="nav-link {{ (request()->route()->uri==='nd-admin/android-setting/create') ? 'active' :'' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Android Setting</p>
                        </a>
                    </li> --}}
                            @if (Auth::user()->can('View Email Setting'))
                            <li class="nav-item">
                                <a href="{{ route('email-setting.index') }}"
                                    class="nav-link {{ request()->route()->uri === 'nd-admin/email-setting/create' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Email Setting</p>
                                </a>
                            </li>
                            @endif
                            @if (Auth::user()->can('View Logo'))
                            <li class="nav-item">
                                <a href="{{ route('websitelogo-setting.index') }}"
                                    class="nav-link {{ request()->route()->uri === 'nd-admin/websitelogo-setting/{websitelogo_setting}/edit' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Logo & Favicon</p>
                                </a>
                            </li>
                            @endif
                            {{-- <li class="nav-item">
                        <a href="{{ route('footer-setting.index') }}" class="nav-link {{ (request()->route()->uri==='nd-admin/footer-setting/create') ? 'active' :'' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Footer Content</p>
                        </a>
                    </li> --}}
                            @if (Auth::user()->can('View Seo'))
                            <li class="nav-item">
                                <a href="{{ route('seosocial-setting.index') }}"
                                    class="nav-link {{ request()->route()->uri === 'nd-admin/seosocial-setting/{seosocial_setting}/edit' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Seo & Socials</p>
                                </a>
                            </li>
                            @endif
                            {{-- <li class="nav-item">
                        <a href="{{ route('permission.index') }}" class="nav-link {{ (request()->route()->uri==='nd-admin/permission'  || request()->route()->uri==='nd-admin/permission/{permission}/edit') ? 'active' :'' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Ads & Banner</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('permission.index') }}" class="nav-link {{ (request()->route()->uri==='nd-admin/permission'  || request()->route()->uri==='nd-admin/permission/{permission}/edit') ? 'active' :'' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Mobile Adds Setting</p>
                        </a>
                    </li> --}}

                            {{-- <li class="nav-item">
                        <a href="{{ route('currency.index') }}" class="nav-link {{ (request()->route()->uri==='nd-admin/audio-quality' || request()->route()->uri==='nd-admin/audio-quality/{audio_quality}/edit') ? 'active' :'' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Currency</p>
                        </a>
                    </li> --}}
                            {{-- <li class="nav-item">
                        <a href="{{ route('permission.index') }}" class="nav-link {{ (request()->route()->uri==='nd-admin/permission'  || request()->route()->uri==='nd-admin/permission/{permission}/edit') ? 'active' :'' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Player Options</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('permission.index') }}" class="nav-link {{ (request()->route()->uri==='nd-admin/permission'  || request()->route()->uri==='nd-admin/permission/{permission}/edit') ? 'active' :'' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Copyright & Privacy</p>
                        </a>
                    </li> --}}
                        </ul>
                    </li>
                    <li class="nav-item {{ request()->route()->uri === 'nd-admin/city/episode/{id}/create' || request()->route()->uri === 'nd-admin/city/create' || request()->route()->uri === 'nd-admin/city' || request()->route()->uri === 'nd-admin/city/{city}/edit' ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-city"></i>
                            <p>
                                City
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (Auth::user()->can('Create WebSeries'))
                            <li class="nav-item">
                                <a href="{{ route('city.create') }}"
                                    class="nav-link {{ request()->route()->uri === 'nd-admin/city/create' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>New City</p>
                                </a>
                            </li>
                            @endif
                            @if (Auth::user()->can('View WebSeries'))
                            <li class="nav-item">
                                <a href="{{ route('city.index') }}"
                                    class="nav-link {{ request()->route()->uri === 'nd-admin/city' || request()->route()->uri === 'nd-admin/city/{city}/edit' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All City</p>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </li>
                    <li class="nav-item {{ request()->route()->uri === 'nd-admin/cinemas/episode/{id}/create' || request()->route()->uri === 'nd-admin/cinemas/create' || request()->route()->uri === 'nd-admin/cinemas' || request()->route()->uri === 'nd-admin/cinemas/{cinema}/edit' ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-film"></i>
                            <p>
                                Cinemas Section
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (Auth::user()->can('Create WebSeries'))
                            <li class="nav-item">
                                <a href="{{ route('cinemas.create') }}"
                                    class="nav-link {{ request()->route()->uri === 'nd-admin/cinemas/create' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>New Cinemas</p>
                                </a>
                            </li>
                            @endif
                            @if (Auth::user()->can('View WebSeries'))
                            <li class="nav-item">
                                <a href="{{ route('cinemas.index') }}"
                                    class="nav-link {{ request()->route()->uri === 'nd-admin/cinemas' || request()->route()->uri === 'nd-admin/cinemas/{cinema}/edit' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Cinemas</p>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </li>

                    <li class="nav-item {{ request()->route()->uri === 'nd-admin/cinemasbranch/episode/{id}/create' || request()->route()->uri === 'nd-admin/cinemasbranch/create' || request()->route()->uri === 'nd-admin/cinemasbranch' || request()->route()->uri === 'nd-admin/cinemasbranch/{cinemasbranch}/edit' ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-building"></i>
                            <p>
                                Cinemas Branch
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (Auth::user()->can('Create WebSeries'))
                            <li class="nav-item">
                                <a href="{{ route('cinemasbranch.create') }}"
                                    class="nav-link {{ request()->route()->uri === 'nd-admin/cinemasbranch/create' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>New Branch</p>
                                </a>
                            </li>
                            @endif
                            @if (Auth::user()->can('View WebSeries'))
                            <li class="nav-item">
                                <a href="{{ route('cinemasbranch.index') }}"
                                    class="nav-link {{ request()->route()->uri === 'nd-admin/cinemasbranch' || request()->route()->uri === 'nd-admin/cinemasbranch/{cinemasbranch}/edit' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Branch</p>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </li>

                    <li class="nav-item {{ request()->route()->uri === 'nd-admin/movietheater/episode/{id}/create' || request()->route()->uri === 'nd-admin/movietheater/create' || request()->route()->uri === 'nd-admin/movietheater' || request()->route()->uri === 'nd-admin/movietheater/{movietheater}/edit' ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-record-vinyl"></i>
                            <p>
                                Movie Theater
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (Auth::user()->can('Create WebSeries'))
                            <li class="nav-item">
                                <a href="{{ route('movietheater.create') }}"
                                    class="nav-link {{ request()->route()->uri === 'nd-admin/movietheater/create' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>New Movie Theater</p>
                                </a>
                            </li>
                            @endif
                            @if (Auth::user()->can('View WebSeries'))
                            <li class="nav-item">
                                <a href="{{ route('movietheater.index') }}"
                                    class="nav-link {{ request()->route()->uri === 'nd-admin/movietheater' || request()->route()->uri === 'nd-admin/movietheater/{movietheater}/edit' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Movie Theater</p>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </li>

                    <li class="nav-item {{ request()->route()->uri === 'nd-admin/shows/episode/{id}/create' || request()->route()->uri === 'nd-admin/shows/create' || request()->route()->uri === 'nd-admin/shows' || request()->route()->uri === 'nd-admin/shows/{shows}/edit' ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-record-vinyl"></i>
                            <p>
                                Shows Theater
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (Auth::user()->can('Create WebSeries'))
                            <li class="nav-item">
                                <a href="{{ route('shows.create') }}"
                                    class="nav-link {{ request()->route()->uri === 'nd-admin/shows/create' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>New Shows Theater</p>
                                </a>
                            </li>
                            @endif
                            @if (Auth::user()->can('View WebSeries'))
                            <li class="nav-item">
                                <a href="{{ route('shows.index') }}"
                                    class="nav-link {{ request()->route()->uri === 'nd-admin/shows' || request()->route()->uri === 'nd-admin/shows/{shows}/edit' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Shows Theater</p>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </li>




            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
