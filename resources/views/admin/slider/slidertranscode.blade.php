@extends('admin.app')
@section('title', 'Slider Transcode')
@push('style')
    
@endpush
@section('main')
<div class="wrapper">
    <div class="content-wrapper">
        <div id="transcoding-progress">Transcoding In progress Plz Wait....</div>
    </div>

</div>
@endsection

@push('scripts')

{{-- <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    Pusher.logToConsole = true;
    var pusher = new Pusher('0ce6f9a8e3b444cfa296', {
    cluster: 'ap2'
    });
    var channel = pusher.subscribe('slider-channel');
    channel.bind('App\\Events\\TranscodingProgressEvent', function(data) {
        alert('ok');
        console.log('transcode percentage',data);
    });
    
</script> --}}

<script>
    procressTranscode=()=>{
        const idValue="{{$slider->id}}";
        $.ajax({
            url:"{{route('slider.transcodeActionPerforme')}}",
            type:"get",
            data:{
                id:idValue
            },
            success:function(response){
                if(response.error){
                    swal({
                    title: "Error",
                    html:true,
                    text:response.msg,
                    icon: "error",
                    customClass: {
                        content: 'error-text'
                    }
                });
                return false;
                }
                swal({
                    title: "Success",
                    html:true,
                    text:response.msg,
                    icon: "success",
                    customClass: {
                        content: 'error-text'
                    }
                });
                window.location.href=response.url;
            }
        });
    }
    procressTranscode();

</script>
@endpush
