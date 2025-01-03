@extends('frontend.includes.main') @section('contents')

<section id="term_condition">
    <div class="container-fluid p-5">
        <div class="row">
            <div class="term-title main-title mt-5">
                <h3>{{$page->name}}</h3>
            </div>
        </div>
        <div class="term-content">
            <div class="d-flex flex-wrap">
                @if($page->banner_image)
                <div class="col-sm-6">
                    <img
                        src="{{$page->banner_image}}"
                        alt="img"
                    />
                </div>
                @endif
                <div class="col-sm-{{$page->banner_image ? '6' :'12'}} ps-{{$page->banner_image ? '5' :'12'}}">{!!$page->content!!}</div>
            </div>
        </div>
    </div>
</section>

@endsection
