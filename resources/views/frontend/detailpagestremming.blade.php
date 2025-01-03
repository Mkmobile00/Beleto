@extends('frontend.includes.main') @section('contents')

<div class="detail_page">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="d-flex justify-content-between">
                    <div class="col-4">
                        <img
                            src="{{@$movie->poster}}"
                            alt="img"
                            style="width: 100%"
                        />
                    </div>
                    <div class="col-7">
                        <div class="text-white">
                            <h3>{{@$movie->title}}</h3>
                            <p>@foreach ($movie->genre as $genre)
                                <a href="{{ route('genreDetails', $genre->slug) }}"> {{ $genre->title }}
                                </a>,
                            @endforeach {{ @$movie->release_date }} . {{ @$movie->run_time }}</p>
                            <div class="review_star">
                                <div class="stars">
                                    @for($i=0;$i<(int)$movie->rating;$i++)
                                        <i class="fas fa-star outline"></i>
                                    @endfor
                                </div>
                                ({{(int)$movie->rating}} / 5)
                            </div>
                            <div class="detail_page_btn">
                                <button><a href="{{route('movieDetailsStremmingSoon',$movie->slug)}}">Watch Trailer</a></button>
                                <button><a href="{{route('customer.subscription')}}">Subscribe Now</a></button>
                            </div>
                            <div>
                                <h3>Summary</h3>
                                {!!$movie->summary!!}
                            </div>
                            <div class="description">
                                <h3>Description</h3>
                                {!!$movie->description!!}
                                <div class="characters">
                                    <div class="d-flex flex-wrap">
                                        <h4>Writer : </h4>
                                        <p>
                                            @foreach ($movie->writer as $writer)
                                                {{ $writer->name }} 
                                            @endforeach
                                        </p>
                                    </div>
                                    <div  class="d-flex flex-wrap">
                                        <h4>Director : </h4>
                                        <p>
                                            @foreach ($movie->director as $director)
                                            {{ $director->name }} 
                                            @endforeach
                                        </p>
                                    </div>
                                    <div  class="d-flex flex-wrap">
                                        <h4>Cast : </h4>
                                        <p>
                                            @foreach ($movie->actor as $actor)
                                                {{ $actor->name }} 
                                            @endforeach
                                        </p>
                                    </div>
                                    <div class="d-flex flex-wrap">
                                        <h4>Audio Languange : </h4>
                                        <p>
                                            @foreach ($movie->language as $language)
                                                {{ $language->title }} 
                                            @endforeach
                                        </p>
                                    </div>
                                    <div class="d-flex flex-wrap">
                                        <h4>Genre : </h4>
                                        <p>
                                        @foreach ($movie->genre as $genre)
                                             {{ $genre->title }} 
                                        @endforeach
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script>
         $(document).on('click','#addPremiumContent',function(){
            $('#addPremiumContentForm').submit();
        });
    </script>
@endpush
