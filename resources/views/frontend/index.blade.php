@extends('frontend.includes.main')
@push('styles')
@endpush
@section('contents')

    <section id="main-slider">
        <div #swiperRef="" class="swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach ($sliders as $slider)
                    <div class="swiper-slide" >
                        @if($slider->type=='video')
                        <video id="my-video" class="video-js play_video" controls preload="auto" poster="" data-setup="{}" autoplay muted style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); max-width: 100%; height: auto; min-width: 100%; min-height: 100%; width: auto;">
                            <source
                                src="{{ route('video.playlist',$slider->transcode.'.m383') }}"
                                type="application/x-mpegURL" />
                        </video>
                        @else
                            <img src="{{ $slider->path }}" alt="...">
                        @endif
                        @if ($slider->movie_id !=null)
                            <div class="video_play_list_btn">
                                <a href="{{route('customer.addWishList',[$slider->movie_id,$slider->item_type])}}" class="{{$slider->is_wish ? 'wishlistActive':''}}">{{$slider->is_wish ? 'Remove From My List':'Add to My List'}} <i class="fa fa-plus"></i></a>
                                <a href="{{route('movieDetails',[$slider->movie_slug,$slider->item_type])}}">Play Now</a>
                            </div>
                        @endif
                    </div>

                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>


        </div>
    </section>

    {{-- <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="ads-below-slider">
                    <img src="{{ asset('frontend/assets/img/slider/ads2.jpg') }}" width="100%" />
                </div>
            </div>
        </div>
    </div> --}}
    {{-- <section id="trending-movies">
        <div class="container">
            <div class="row">
                <div class="main-title">
                    <h3>Hot & New</h3>
                    <div class="main-btns">
                        <a href="{{route('hotnewdetails')}}" class="btns">View All <i class="fa-solid fa-chevron-right"></i></a>
                    </div>
                </div>
                <div class="center slider" id="mb_0">
                    @foreach ($hotAndNew as $data)
                    <div class="movie-card-wrapper">
                        <div class="movie-card">
                            <a href="{{route('movieDetails',[$data['slug'],$data['type']])}}">
                                <img src="{{ $data['thumbnail'] }}" alt="256x144" class="movie-image">
                            </a>
                            <div class="movie-content">
                                <div class="movie-title">{{ @$data['title'] }}</div>
                                <div class="data-details">
                                    <span>{{ @$data['run_time'] }}</span>
                                    @isset($data['genre'])
                                        <span>
                                            @foreach ($data['genre'] as $genre)
                                                {{ $genre['title'] }},
                                            @endforeach
                                        </span>
                                    @endisset
                                </div>
                                <button type="button" class="btn btn-light"><i
                                        class="fa-regular fa-circle-play"></i>
                                    <a href="{{route('movieDetails',[$data['slug'],$data['type']])}}"> Watch </a></button>
                                <button type="button" class="btn btn-link-a"><i
                                        class="fa-solid fa-share-nodes"></i> <a href="#">Share</a></button>
                            </div>

                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section> --}}
    @foreach ($finalData as $data)
    @if($data['layout']=='SLIDER')
        <section id="trending-movies">
            <div class="container">
                <div class="row">
                    <div class="main-title">
                        <h3>{{ @$data['title'] }}</h3>
                        <div class="main-btns">
                            <a href="{{route('collectiondetails',[$data['slug'],$data['filter_type']])}}" class="btns">View All <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                    </div>
                    <div class="center slider" id="mb_0">
                        @foreach ($data['movies'] as $data)
                        <div class="movie-card-wrapper">
                            <div class="movie-card">
                                {{-- <a href="{{route('movieDetails',[$data['slug'],$data['type']])}}">
                                    <img src="{{ $data['thumbnail'] }}">
                                </a>  --}}
                                <a href="{{route('movieDetailsPage',[$data['slug'],$data['type']])}}">
                                    <img src="{{ @$movie['poster'] }}">
                                </a>
                                <div class="movie-content">
                                    <div class="movie-title">{{ @$data['title'] }}</div>
                                    <div class="data-details">
                                        <span>{{ @$data['run_time'] }}</span>
                                        @isset($data['genre'])
                                            <span>
                                                @foreach ($data['genre'] as $genre)
                                                    {{ $genre['title'] }},
                                                @endforeach
                                            </span>
                                        @endisset
                                    </div>
                                    <button type="button" class="btn btn-light"><i
                                            class="fa-regular fa-circle-play"></i>
                                        <a href="{{route('movieDetailsPage',[$data['slug'],$data['type']])}}"> Watch </a></button>
                                        <button class="btn btn-link-a hover-me">
                                            <i class="fa-solid fa-share-nodes"></i>
                                            <a href="javascript:[void]" class="share-hover" title="hoverthisshare">Share</a>
                                        </button>
                                        <span class="all-share-items">
                                            <div class="sharethis-inline-share-buttons shareItem"></div>
                                        </span>

                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @else
        <section id="movies">
            <div class="container">
                <div class="row">
                    <div class="main-title">
                        <h3>{{ @$data['title'] }}</h3>
                        <div class="main-btns">
                            <a href="{{route('collectiondetails',[$data['slug'],$data['filter_type']])}}" class="btns">View All <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                    </div>
                    <div class="movies slider">
                        @foreach ($data['movies'] as $movie)
                            <div class="movie-card-wrapper">
                                <div class="movie-card">
                                    {{-- <a href="{{route('movieDetails',[$movie['slug'],$movie['type']])}}">
                                        <img src="{{ @$movie['poster'] }}">
                                     </a> --}}
                                    <a href="{{route('movieDetailsPage',[$movie['slug'],$movie['type']])}}">
                                        <img src="{{ @$movie['poster'] }}">
                                    </a>
                                    <div class="movie-content">
                                        <div class="movie-title">{{ @$movie['title'] }}</div>
                                        <div class="movie-details">
                                            <span>{{ @$movie['run_time'] }}</span>
                                            @isset($movie['genre'])
                                                <span>
                                                    @foreach ($movie['genre'] as $genre)
                                                        {{ $genre['title'] }},
                                                    @endforeach
                                                </span>
                                            @endisset
                                        </div>
                                        <button type="button" class="btn btn-light"><i
                                                class="fa-regular fa-circle-play"></i>
                                            <a href="{{route('movieDetailsPage',[$movie['slug'],$movie['type']])}}"> Watch </a></button>
                                            <button class="btn btn-link-a hover-me">
                                                <i class="fa-solid fa-share-nodes"></i>
                                                <a href="javascript:[void]" class="share-hover" title="hoverthisshare">Share</a>
                                            </button>
                                            <span class="all-share-items">
                                                <div class="sharethis-inline-share-buttons shareItem"></div>
                                            </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>

        </section>
    @endif

   

    @endforeach
    @if(count($stremmings) > 0)
    <section id="stremming">
        <div class="container">
            <div class="row">
                <div class="main-title">
                    <h3>Stremming Soon</h3>
                    <div class="main-btns">
                        {{-- <a href="{{route('collectiondetails',[$data['slug'],$data['filter_type']])}}" class="btns">View All <i class="fa-solid fa-chevron-right"></i></a> --}}
                    </div>
                </div>
                <div class="movies slider">
                    @foreach ($stremmings as $movie)
                        <div class="movie-card-wrapper">
                            <div class="movie-card">
                                {{-- <a href="{{route('movieDetails',[$movie['slug'],$movie['type']])}}">
                                    <img src="{{ @$movie['poster'] }}">
                                 </a> --}}
                                <a href="{{route('stremmingsoon',[$movie->slug,'0'])}}">
                                    <img src="{{ @$movie['poster'] }}">
                                </a>
                                <div class="movie-content">
                                    <div class="movie-title">{{ @$movie['title'] }}</div>
                                    <div class="movie-details">
                                        <span>{{ @$movie['run_time'] }}</span>
                                        @isset($movie['genre'])
                                            <span>
                                                @foreach ($movie['genre'] as $genre)
                                                    {{ $genre['title'] }},
                                                @endforeach
                                            </span>
                                        @endisset
                                    </div>
                                    <button type="button" class="btn btn-light"><i
                                            class="fa-regular fa-circle-play"></i>
                                        <a href="{{route('stremmingsoon',[$movie->slug,'0'])}}"> Watch </a></button>
                                        <button class="btn btn-link-a hover-me">
                                            <i class="fa-solid fa-share-nodes"></i>
                                            <a href="javascript:[void]" class="share-hover" title="hoverthisshare">Share</a>
                                        </button>
                                        <span class="all-share-items">
                                            <div class="sharethis-inline-share-buttons shareItem"></div>
                                        </span>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>

    </section>
    @endif
    {{-- <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="ads-top">
                    <img src="{{ asset('frontend/assets/img/slider/ads.jpg') }}" width="100%" alt="164x246" />
                </div>
            </div>
        </div>
    </div> --}}
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('.all-share-items').hide();
        $('.hover-me').click(function() {
            $(this).siblings('.all-share-items').toggle();
        });
    });
</script>
@endpush
