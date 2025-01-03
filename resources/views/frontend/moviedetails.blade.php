@extends('frontend.includes.main')
@push('styles')
    <link href="https://vjs.zencdn.net/8.10.0/video-js.css" rel="stylesheet" />
    <style>
        #episode_poster img {
            width: 223px;
            height: 125px;
            object-fit: cover;
        }
    
    .video-js .vjs-tech {
      position: relative !important;
    }
    
    </style>
@endpush

@section('contents')


    <section id="details_content">
        <div class="container-fluid text-white">
            <div class="row m-0 mt-1">
                <div class="col-12">
                    <div class="d-flex flex-wrap">
                        <div class="col-8" id="video__content">
                            <div>
                                <div class="video_container" style="height: auto">
                                    @isset($customer)
                                        @if($movie->premium_status && !$movie->premium_payment)
                                            <iframe src="https://www.youtube.com/embed/{{$movie->youtube_trailer}}" class="play_video"
                                                title="{{$movie->title}}" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                allowfullscreen>
                                            </iframe>
                                        @else
                                        {{-- @dd($movie) --}}
                                            @if(checkCustomerSusbcription($customer) && @$movie->movie_path || @$episodeData->video_path)
                                            <video id="my-video" class="video-js play_video" controls preload="auto" poster="" data-setup="{}" autoplay muted>
                                                <source src="{{@$movie->movie_path  ?? @$episodeData->video_path}}" type="video/mp4" />
                                            </video>
                                            
                                            @else
                                                <iframe src="https://www.youtube.com/embed/{{$movie->youtube_trailer}}" class="play_videoyoutube"
                                                    title="{{$movie->title}}" frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                    allowfullscreen>
                                                </iframe>
                                            @endif
                                            {{-- @if(checkCustomerSusbcription($customer) && $movie->transcode !=null)
                                                <video id="my-video" class="video-js play_video" controls preload="auto" poster="" data-setup="{}" autoplay muted>
                                                    <source
                                                        src="{{ route('video.playlist',$movie->transcode.'.m383') }}"
                                                        type="application/x-mpegURL" />
                                                </video>
                                            @else
                                                <iframe src="https://www.youtube.com/embed/{{$movie->youtube_trailer}}" class="play_videoyoutube"
                                                    title="{{$movie->title}}" frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                    allowfullscreen>
                                                </iframe>
                                            @endif --}}
                                        @endif
                                    @else
                                        <iframe src="https://www.youtube.com/embed/{{$movie->youtube_trailer}}" class="play_videoyoutube"
                                            title="{{$movie->title}}" frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            allowfullscreen>
                                        </iframe>
                                    @endisset
                                </div>
                                <div class="d-flex justify-content-between align-items-center video_content p-2">
                                    <h4 style="margin: 0; padding: 0;">Subscribe to Premium Watch latest Movies ad free</h4>
                                    @if($movie->premium_status && !$movie->premium_payment)
                                    <form action="{{route('customer.addPremiumContent')}}" id="addPremiumContentForm" method="post">
                                        @csrf
                                        <input type="text" name="premium_content_id" value="{{@$movie->premium_details['id']}}" hidden>
                                        <input type="text" name="type" value="{{@$movie->type}}" hidden>
                                        <input type="text" name="movieId" value="{{@$movie->id}}" hidden>
                                        <input type="text" name="amount" value="{{@$movie->premium_details['price']}}" hidden>
                                        <a href="javascript:;" type="submit" class="btn btn-subscribe" id="addPremiumContent"><i class="fas fa-crown"></i>Buy Now</a>
                                    </form>
                                    @endif
                                    @isset($customer)
                                    @if(!checkCustomerSusbcription($customer))
                                    <a href="{{route('customer.subscription')}}" class="btn btn-subscribe"><i class="fas fa-crown"></i>Subscribe</a>
                                    @endif
                                    @else
                                    <a href="{{route('customer.subscription')}}" class="btn btn-subscribe"><i class="fas fa-crown"></i>Subscribe</a>
                                    @endisset

                                </div>
                            </div>
                            <div class="container">
                                <div class="name text-white">
                                    <h1>{{ $episodeData->title ?? $movie->title }}</h1>
                                </div>
                                <ul class="detail-genre text-white">
                                    <li>{{ $movie->run_time }}</li>
                                    <li>{{ $movie->release_date }}</li>
                                    <li>{{ $movie->type == '1' ? 'Movies' : ($movie->type == '2' ? 'Tv Series' : 'Web Series') }}
                                    </li>
                                </ul>

                                <div class="details_btns mt-4 mb-4">
                                    <a href="javascript:;" id="getTrailer"><i class="fa fa-play"></i>Trailer</a>
                                    <a href=""><i class="fa fa-share"></i>Share</a>
                                    {{-- <a href=""><i class="fa fa-video"></i>Watchlist</a> --}}
                                </div>
                                {{-- @dd($movie->language) --}}
                                <div class="description mb-4">
                                    <div class="d-flex flex-wrap">
                                        <p> Languange:
                                            @foreach ($movie->language as $language)
                                                <a href="{{ route('languageDetails', $language->title) }}">
                                                    {{ $language->title }} </a>
                                            @endforeach
                                        </p>
                                        <p> Genre:
                                            @foreach ($movie->genre as $genre)
                                                <a href="{{ route('genreDetails', $genre->slug) }}"> {{ $genre->title }}
                                                </a>
                                            @endforeach
                                        </p>
                                    </div>
                                    <div class="content">
                                        <p>{!! $episodeData->title ?? $movie->summary !!}</p>
                                    </div>
                                    <div>

                                        <div class="accordion">
                                            <a class="accordion-header mb-2" style="cursor: pointer; display: inline;">View Director and Cast</a>
                                            <div class="accordion-content">
                                                <p>
                                                    Director:
                                                    @foreach ($movie->director as $director)
                                                        <a href="{{ route('castDetails', $director->name) }}">
                                                            {{ $director->name }} </a>
                                                    @endforeach
                                                    <br>
                                                    Actor/Actress:
                                                    @foreach ($movie->actor as $actor)
                                                        <a href="{{ route('castDetails', $actor->name) }}">
                                                            {{ $actor->name }} </a>
                                                    @endforeach
                                                    <br>
                                                    Writer:
                                                    @foreach ($movie->writer as $writer)
                                                        <a href="{{ route('castDetails', $writer->name) }}">
                                                            {{ $writer->name }} </a>
                                                    @endforeach
                                                </p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($movie->type != '1')
                            @isset($movie->episodes)
                                <div class="col-4" id="side__content">
                                    <div class="container">
                                        <div class="row">
                                            <div class="details main-title mt-2">
                                                <h3>Episodes</h3>
                                            </div>
                                            <div>
                                                @foreach ($movie->episodes as $key => $episode)
                                                    @isset($episodeData)
                                                        @if ($episode->id != $episodeData->id)
                                                            <div id="episode_poster">
                                                                <div class="detail-movie-card-wrapper">
                                                                    <div class="detail-movie-card">
                                                                        <div class="d-flex">
                                                                            <a
                                                                                href="{{ route('episodesDetails', [$movie->slug, $episode->slug, $movie->type]) }}">
                                                                                <img src="{{ $episode->poster }}" alt="223x125" width="100%">
                                                                            </a>
                                                                            <div class="pt-0 p-4">
                                                                                <span
                                                                                    class="movie-title"><strong>{{ $episode->title }}</strong></span><br>
                                                                                <span
                                                                                    class="movie-title">E{{ $key + 1 }}</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="detail-movie-content">
                                                                            <button type="button" class="btn btn-light"><i
                                                                                    class="fa-regular fa-circle-play"></i> <a
                                                                                    href="{{ route('episodesDetails', [$movie->slug, $episode->slug, $movie->type]) }}">
                                                                                    Watch </a></button>
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
                                                            </div>
                                                        @endif
                                                    @else
                                                        <div id="episode_poster">
                                                            <div class="detail-movie-card-wrapper">
                                                                <div class="detail-movie-card">
                                                                    <div class="d-flex">
                                                                        <a
                                                                            href="{{ route('episodesDetails', [$movie->slug, $episode->slug, $movie->type]) }}">
                                                                            <img src="{{ $episode->poster }}" alt="223x125">
                                                                        </a>
                                                                        <div class="pt-0 p-4">
                                                                            <span
                                                                                class="movie-title"><strong>{{ $episode->title }}</strong></span><br>
                                                                            <span class="movie-title">E{{ $key + 1 }}</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="detail-movie-content">
                                                                        <button type="button" class="btn btn-light"><i
                                                                                class="fa-regular fa-circle-play"></i> <a
                                                                                href="{{ route('episodesDetails', [$movie->slug, $episode->slug, $movie->type]) }}">
                                                                                Watch </a></button>
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
                                                        </div>
                                                    @endisset
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endisset
                        @endif
                    </div>
                </div>
            </div>


        </div>
    </section>

    {{-- @dd($movie->toArray()) --}}
    <section id="related-videos">
        <div class="container">
            <div class="row">
                <div class="main-title">
                    <h3>Related Videos</h3>
                </div>
                <div class="center slider" id="mb_0">
                    @foreach ($movie->related_movie as $relatedMovies)
                        {{-- @dd($relatedMovies) --}}
                        <div class="movie-card-wrapper">
                            <div class="movie-card">
                            <a href="{{ route('movieDetails', [$relatedMovies['slug'], $relatedMovies['type']]) }}">
                                <img src="{{ $relatedMovies['poster'] }}" class="movie-image">
                            </a>

                            <div class="movie-content">
                                <div class="movie-title">{{ @$relatedMovies['title'] }}</div>
                                <div class="data-details">
                                    <span>{{ @$relatedMovies['run_time'] }}</span>
                                    @isset($relatedMovies['genre'])
                                        <span>
                                            @foreach ($relatedMovies['genre'] as $genre)
                                                {{ $genre['title'] }},
                                            @endforeach
                                        </span>
                                    @endisset
                                </div>
                                <button type="button" class="btn btn-light"><i
                                        class="fa-regular fa-circle-play"></i>
                                    <a href="{{route('movieDetails',[$relatedMovies['slug'],$relatedMovies['type']])}}"> Watch </a></button>
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

    {{-- @isset($tvSeriess)
    <section id="web-series">
        <div class="container">
            <div class="row">
                <div class="main-title">
                    <h3>Tv Series</h3>
                    <div class="main-btns">
                        <a href="#" class="btns">View All <i class="fa-solid fa-chevron-right"></i></a>
                    </div>
                </div>
                <div class="web-series slider">
                    @foreach ($tvSeriess as $series)

                        <div class="movie-card-wrapper">
                            <div class="movie-card">
                                <a href="{{ route('movieDetails', [$series->slug, $series->type]) }}">
                                    <img src="{{ $series->poster }}">
                                </a>
                                <div class="movie-content">
                                    <div class="movie-title">{{ $series->title }}</div>
                                    <div class="movie-details">
                                        <span>{{ $series->run_time }}</span>
                                        <span>
                                            @foreach ($series->genre as $genre)
                                                <a href=""> {{ $genre->title }} </a>
                                            @endforeach
                                        </span>
                                    </div>
                                    <button type="button" class="btn btn-light"><i
                                            class="fa-regular fa-circle-play"></i> <a
                                            href="{{ route('movieDetails', [$series->slug, $series->type]) }}"> Watch
                                        </a></button>
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
    @endisset --}}
    @isset($webSeriess)
    <section id="web-series">
        <div class="container">
            <div class="row">
                <div class="main-title">
                    <h3>Web Series</h3>
                    <div class="main-btns">
                        <a href="{{route('category.details',['webseries','3'])}}" class="btns">View All <i class="fa-solid fa-chevron-right"></i></a>
                    </div>
                </div>

                <div class="web-series slider">
                    @foreach ($webSeriess as $series)
                        {{-- @dd($series->genre) --}}
                        <div class="movie-card-wrapper">
                            <div class="movie-card">
                                <a href="{{ route('movieDetails', [$series->slug, $series->type]) }}">
                                    <img src="{{ $series->poster }}">
                                </a>
                                <div class="movie-content">
                                    <div class="movie-title">{{ $series->title }}</div>
                                    <div class="movie-details">
                                        <span>{{ $series->run_time }}</span>
                                        <span>
                                            @foreach ($series->genre as $genre)
                                                <a href=""> {{ $genre->title }} </a>
                                            @endforeach
                                        </span>
                                    </div>
                                    <button type="button" class="btn btn-light"><i
                                            class="fa-regular fa-circle-play"></i> <a
                                            href="{{ route('movieDetails', [$series->slug, $series->type]) }}"> Watch
                                        </a></button>
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
    @endisset

    <section id="details_aboout">
        <div class="container">
            <div class="row">
                <div class="main-title">
                    <h3>Details</h3>
                </div>
                <div class="container">
                    <div class="info_movies p-3 text-white">
                        <div class="d-flex">
                            <div class="col-sm-2">
                                <span><strong>Movie Release Date</strong></span>
                            </div>
                            <div class="d-flex flex-wrap">
                                <p>{{ $movie->release_date }}</p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="col-sm-2">
                                <span><strong>Genre</strong></span>
                            </div>
                            <div class="d-flex flex-wrap">
                                @foreach ($movie->genre as $genre)
                                    <p> {{ $genre->title }} </p>
                                @endforeach
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="col-sm-2">
                                <span><strong>Audio Languange</strong></span>
                            </div>
                            <div class="d-flex flex-wrap">
                                @foreach ($movie->language as $language)
                                    <p> {{ $language->title }} </p>
                                @endforeach
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="col-sm-2">
                                <span><strong>Cast</strong></span>
                            </div>
                            <div class="d-flex flex-wrap">
                                @foreach ($movie->actor as $actor)
                                    <p>{{ $actor->name }} </p>
                                @endforeach

                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="col-sm-2">
                                <span><strong>Director</strong></span>
                            </div>
                            <div class="d-flex flex-wrap">
                                @foreach ($movie->director as $director)
                                    <p>{{ $director->name }} </p>
                                @endforeach
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="col-sm-2">
                                <span><strong>Writer</strong></span>
                            </div>
                            <div class="d-flex flex-wrap">
                                @foreach ($movie->writer as $writer)
                                    <p>{{ $writer->name }} </p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="ms-0 me-0 m-4">
                        <div class="keypoints">
                            <h3>Keypoints about {{ $movie->title }}</h3>
                            <div>
                                {!! $movie->summary !!}
                            </div>
                        </div>
                    </div>

                    <div class="tale_about">
                        <div class="accordion">
                            <p class="accordion-header d-flex justify-content-between align-items-center mb-2">
                                <strong>{{ $movie->title }}</strong> <i class="fa fa-chevron-up"></i>
                            </p>
                            <div class="accordion-content">
                                {!! $movie->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://vjs.zencdn.net/8.10.0/video.min.js"></script>
    <script>
       document.addEventListener('contextmenu', function (e) {
    e.preventDefault();
});

// Disable Keyboard Shortcuts
document.addEventListener('keydown', function (e) {
    // Disable F12 key
    if (e.key === 'F12') {
        e.preventDefault();
    }

    // Disable Ctrl+Shift+I (Inspect Element)
    if (e.ctrlKey && e.shiftKey && e.key === 'I') {
        e.preventDefault();
    }

    // Disable Ctrl+Shift+J (Console)
    if (e.ctrlKey && e.shiftKey && e.key === 'J') {
        e.preventDefault();
    }

    // Disable Ctrl+U (View Source)
    if (e.ctrlKey && e.key === 'U') {
        e.preventDefault();
    }

    // Disable Ctrl+Shift+C (Inspect Element)
    if (e.ctrlKey && e.shiftKey && e.key === 'C') {
        e.preventDefault();
    }
});

// Disable Mouse Middle-Click
document.addEventListener('mousedown', function (e) {
    if (e.button === 1) {  // Middle click
        e.preventDefault();
    }
});
        $(document).on('click','#addPremiumContent',function(){
            $('#addPremiumContentForm').submit();
        });
        function generateTrailer(title,url){
            let html=`<iframe src="https://www.youtube.com/embed/${url}" class="play_video"
                        title="${title}" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>`;
                    return html;
        }
        $(document).on('click','#getTrailer',function(){
            const trailerUrl="{{$movie->youtube_trailer}}" ?? null;
            const title="{{$movie->title}}" ?? null;
            if(!trailerUrl){
                return false;
            }
            $('.video_container').html(generateTrailer(title,trailerUrl));
        });
    </script>
    {{-- <script>
        var player = videojs('my-video');
        var options = {};

        var player = videojs('my-player', options, function onPlayerReady() {
        videojs.log('Your player is ready!');

        // In this context, `this` is the player that was created by Video.js.
        this.play();

        // How about an event listener?
        this.on('ended', function() {
            videojs.log('Awww...over so soon?!');
        });
        });
    </script> --}}
    <script>
        $(document).ready(function() {
            $(".accordion-header").click(function() {
                $(this).toggleClass("active");
                $(this).next(".accordion-content").slideToggle("fast");
                $(this).find('.fa').toggleClass('fa-chevron-down fa-chevron-up');
            });


            $('.all-share-items').hide();
            $('.hover-me').click(function() {
                $(this).siblings('.all-share-items').toggle();
            });
        });



</script>
@endpush
