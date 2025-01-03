@extends('frontend.includes.main')

@section('contents')
 <!-- Swiper -->
 <style>
    .my-video-dimensions {
        width: 100% !important;
        height: auto;
    }

    .video-js .vjs-tech {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: auto;
    }
</style>
<section id="main-slider">
    {{--<!-- Swiper --> --}}
    <div #swiperRef="" class="swiper mySwiper">
        <div class="swiper-wrapper" style="width: 100%;">
            @foreach ($sliders as $slider)
                <div class="swiper-slide" >
                    @if($slider->type=='video')
                    <video id="my-video" class="video-js play_video" controls preload="auto" poster="" data-setup="{}" autoplay muted>
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

    <section id="movies">

        <div class="container">
            <div class="row">
                <div class="main-title">
                    <h3>{{@$mainCategory}}</h3>
                    <div class="main-btns">
                        {{-- <a href="{{route('collectiondetails',[$data['slug'],$data['filter_type']])}}" class="btns">View All <i class="fa-solid fa-chevron-right"></i></a> --}}
                    </div>
                </div>
                <div class="movies slider">
                    @foreach ($movies as $movie)
                        <div class="movie-card-wrapper">
                            <div class="movie-card">
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

        {{-- <div class="container">

            <div class="row">
                <div class="main-title">
                    <h3>{{@$mainCategory}}</h3>
                    <div class="main-btns">
                    </div>
                </div>



                <div class="d-flex flex-wrap justify-content-center" style="gap: 20px">
                    @foreach ($movies as $movie)
                        <div class="movie-card-wrapper">
                            <div class="movie-card">
                                <a href="{{route('movieDetails',[$movie['slug'],$movie['type']])}}">
                                    <img src="{{ @$movie['poster'] }}">
                                </a>
                                <a href="{{route('movieDetails',[$movie['slug'],$movie['type']])}}">
                                    <img src="{{$movie->poster}}">
                                </a>
                                <div class="movie-content">
                                    <div class="movie-title">{{$movie->title}}</div>
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
                                    <button type="button" class="btn btn-light"><i class="fa-regular fa-circle-play"></i> <a
                                            href="{{route('movieDetails',[$movie['slug'],$movie['type']])}}"> Watch </a></button>
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
        </div> --}}

    </section>




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
