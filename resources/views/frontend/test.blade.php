@include('frontend.includes.header')
{{-- @include('frontend.includes.topnav') --}}
<h3>{{$data->name}}</h3>
{!!$data->content!!}
{{-- @include('frontend.includes.bottomnav') --}}
@include('frontend.includes.footer')
 
   