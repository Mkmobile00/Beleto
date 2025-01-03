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
                            style="width: 100%; border-radius: 2px;"
                        />
                        <div class="stream_btn text-center">
                            <a href="">Streaming Now</a>
                        </div>

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
                                <button><a href="{{route('movieDetails',[$movie['slug'],$movie['type']])}}">Watch Movie</a></button>
                                <button><a href="{{route('customer.subscription')}}">Subscribe Now</a></button>
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
                                            @foreach ($movie->writer as $key=>$writer)
                                                {{ $writer->name }} 
                                                @if($key < count($movie->writer)-1)
                                                ,
                                                @endif
                                            @endforeach
                                        </p>
                                    </div>
                                    @if($movie->director)
                                    <div  class="d-flex flex-wrap">
                                        <h4>Director : </h4>
                                        <p>
                                            @foreach ($movie->director as $key=>$director)
                                            {{ $director->name }} 
                                            @if($key < count($movie->director)-1)
                                                ,
                                                @endif
                                            @endforeach
                                        </p>
                                    </div>
                                    @endif

                                    @if($movie->cinematographer)
                                    <div  class="d-flex flex-wrap">
                                        <h4>Director Of Photography : </h4>
                                        <p>
                                            @foreach ($movie->cinematographer as $key=>$director)
                                            {{ $director->name }} 
                                            @if($key < count($movie->cinematographer)-1)
                                            ,
                                            @endif
                                            @endforeach
                                        </p>
                                    </div>
                                    @endif
                                    @if($movie->editor)
                                    <div  class="d-flex flex-wrap">
                                        <h4>Editor : </h4>
                                        <p>
                                            @foreach ($movie->editor as $key=>$director)
                                            {{ $director->name }} 
                                            @if($key < count($movie->editor)-1)
                                            ,
                                            @endif
                                            @endforeach
                                        </p>
                                    </div>
                                    @endif
                                    @if($movie->music)
                                    <div  class="d-flex flex-wrap">
                                        <h4>Music : </h4>
                                        <p>
                                            @foreach ($movie->music as $key=>$director)
                                            {{ $director->name }} 
                                            @if($key < count($movie->music)-1)
                                            ,
                                            @endif
                                            @endforeach
                                        </p>
                                    </div>
                                    @endif
                                    @if($movie->producer)
                                    <div  class="d-flex flex-wrap">
                                        <h4>Producer : </h4>
                                        <p>
                                            @foreach ($movie->producer as $key=>$director)
                                            {{ $director->name }} 
                                            @if($key < count($movie->producer)-1)
                                            ,
                                            @endif
                                            @endforeach
                                        </p>
                                    </div>
                                    @endif

                                    
                                    {{-- <div class="d-flex flex-wrap">
                                        <h4>Audio Languange : </h4>
                                        <p>
                                            @foreach ($movie->language as $language)
                                                {{ $language->title }} 
                                            @endforeach
                                        </p>
                                    </div> --}}
                                   
                                    <div  class="d-flex flex-wrap">
                                        <h4>Cast : </h4>
                                        <p>
                                            @foreach ($movie->actor as $key=>$actor)
                                                {{ $actor->name }}
                                            @if($key < count($movie->actor)-1)
                                            ,
                                            @endif 
                                            @endforeach
                                        </p>
                                    </div>
                                    <div class="d-flex flex-wrap">
                                        <h4>Genre : </h4>
                                        <p>
                                        @foreach ($movie->genre as $key=>$genre)
                                             {{ $genre->title }} 
                                             @if($key < count($movie->genre)-1)
                                             ,
                                             @endif 
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
