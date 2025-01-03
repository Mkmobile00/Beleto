<section id="footer">
    <div class="container">
        <!-- <div class="row">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="footer__items">
                    <span>Download App</span>
                    <img src="{{asset('frontend/assets/img/download/play_store.png')}}" />
                    <img src="{{asset('frontend/assets/img/download/app_store.png')}}" />
                </div>
                <div class="footer__items">
                    <span class="me-4"><a href="">About Us</a></span>
                    <span class="me-4"><a href="">Help Center</a></span>
                    <span class="me-4"><a href="">Privacy Policy</a></span>
                    <span class="me-4"><a href="">Terms and Use</a></span>
                </div>
                <div class="footer__items">
                    <div>
                        <span>Get in touch with us</span>
                        <div class="social-icons">
                            <i class="fab fa-facebook" title="facebook"></i>
                            <i class="fab fa-instagram" title="instagram"></i>
                            <i class="fab fa-twitter" title="twitter"></i>
                            <i class="fab fa-youtube" title="youtube"></i>
                        </div>
                    </div>

                </div>
            </div>
        </div> -->
        {{-- @if(count($pages) > 0)
            <div class="footer__items footer-border-bottom text-center">
                @foreach($pages as $page)
                    <span class="me-4"><a href="{{route('page.details',$page->slug)}}">{{$page->name}}</a></span>
                @endforeach
            </div>
        @endif --}}
    </div>
    <div class="generalinfo">
        <div class="container-fluid">
            <div class="row">
                <div class="w-80">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="footer-items">
                            <div class="footer-logo">
                                <a href="{{route('home')}}">
                                    <img
                                        src="{{@$logo->website_logo}}"
                                        style="width: auto"
                                        height="65px"
                                    />
                                </a>
                            </div>
                            <h4>{{@$systemSetting->site_name}}</h4>
                            <div class="footer__items">
                                <span>Download App</span>
                                
                                        <a href="{{@$systemSetting->android_link}}" target="_blank">
                                <img
                                    src="{{asset('frontend/assets/img/download/play_store.png')}}"/>
                            </a>
                            <a href="{{@$systemSetting->apple_link}}" target="_blank">
                                <img
                                    src="{{asset('frontend/assets/img/download/app_store.png')}}"/>
                        </a>
                            </div>
                            {{-- <ul class="footer-address">
                                <li>
                                    <strong>
                                        <i class="fa-solid fa-location-dot"></i>
                                        Address : 
                                    </strong>
                                    {{$systemSetting->bussiness_address}}
                                </li>
                                <li>
                                    <strong
                                        ><i
                                            class="fa-solid fa-envelope-circle-check"
                                        ></i>
                                        Info Email : </strong
                                    >
                                    {{$systemSetting->system_email}}
                                </li>
                                <li>
                                    <strong
                                        ><i class="fa-solid fa-mobile-retro"></i>
                                        Content Email : </strong
                                    >
                                    {{$systemSetting->system_email}}
                                </li>
                                <li>
                                    <strong
                                        ><i class="fa-solid fa-mobile-retro"></i>
                                        Market Email : </strong
                                    >
                                    {{$systemSetting->system_email}}
                                </li>
                            </ul> --}}
                        </div>
                        @if(count($footerPages) > 0)
                    <div class="footer-items d-flex flex-wrap page-list">
                            @foreach($footerPages as $page)
                                    <li>
                                        <a
                                            href="{{route('page.details',$page->slug)}}"
                                            >{{$page->name}}</a
                                        >
                                    </li>
                            @endforeach
                            
                        </div>
                        @endif
                    
                        {{-- <div class="footer-items">
                            <span>Actor/Actress Movies</span>
                            @foreach ($actors as $actor)
                            <li>
                                <a
                                    href="{{route('castDetails',$actor->name)}}"
                                    >{{$actor->name}}</a
                                >
                            </li>
                            @endforeach
                        </div>
                        <div class="footer-items">
                            <span>Director Movies</span>
                            @foreach ($directors as $director)
                            <li>
                                <a
                                    href="{{route('castDetails',$director->name)}}"
                                    >{{$director->name}}</a
                                >
                            </li>
                            @endforeach
                        </div>
                        <!-- <div class="footer-items">
                            <span>Writer Movies</span>
                            @foreach ($writers as $writer)
                            <li>
                                <a href="{{route('castDetails',$writer->name)}}">{{$writer->name}}</a>
                            </li>
                            @endforeach
                        </div>
                        <div class="footer-items">
                            <span>Genre</span>
                            @foreach ($genres as $genre)
                            <li>
                                <a href="{{route('genreDetails',$genre->slug)}}">{{$genre->title}}</a>
                            </li>
                            @endforeach
                        </div>
                        <div class="footer-items">
                            <span>Tv Series</span>
                            @foreach ($tvSeries as $tvSerie)
                            <li>
                                <a href="{{route('movieDetails',[$tvSerie->slug,$tvSerie->type])}}">{{$tvSerie->title}}</a>
                            </li>
                            @endforeach
                        </div>
                        <div class="footer-items">
                            <span>Web Series</span>
                            @foreach ($webSeries as $webSerie)
                            <li>
                                <a href="{{route('movieDetails',[$webSerie->slug,$webSerie->type])}}">{{$webSerie->title}}</a>
                            </li>
                            @endforeach
                        </div> --> --}}
                        <div class="footer-items">
                            {{-- <div class="footer__items">
                                <span>Download App</span>
                                <img
                                    src="{{@$systemSetting->android_link}}"
                                />
                                <img
                                    src="{{@$systemSetting->apple_link}}"
                                />
                            </div> --}}

                            <div class="footer__items mt-3">
                                <div>
                                    <span>Get in touch with us</span>
                                    <div class="social-icons">
                                        <a href="{{@$systemSetting->fb_link}}" target="_blank">
                                            <i
                                            class="fab fa-facebook"
                                            title="facebook"
                                            >
                                        </i>
                                        </a>
                                        <a href="{{@$systemSetting->insta_link}}" target="_blank">
                                        <i
                                            class="fab fa-instagram"
                                            title="instagram"
                                        ></i>
                                        </a>
                                        <a href="{{@$systemSetting->twitter_link}}" target="_blank">
                                        <i
                                            class="fab fa-twitter"
                                            title="twitter"
                                        ></i>
                                        </a>
                                        <a href="{{@$systemSetting->youtube_link}}" target="_blank">
                                        <i
                                            class="fab fa-youtube"
                                            title="youtube"
                                        ></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer style="padding: 10px; font-size: 16px; border-top: 1px solid #272727;">
        <div class="container-fluid">
          <div class="d-flex flex-wrap justify-content-between align-items-center">
            <p style="margin: 0">Copyright &copy; 2024 Kantipur Cinemas All Rights Reserved</p>
            <p style="margin: 0">Website Powered By <strong>
                <a href="https://nectardigit.com/" target="_blank">NectarDigit</a></strong></p>
          </div>
        </div>
    </footer>

</section>
