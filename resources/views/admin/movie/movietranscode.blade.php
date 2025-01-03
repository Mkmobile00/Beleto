@extends('admin.app')
@section('title', 'Movie Transcode')
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


<script>
    procressTranscode=()=>{
        const idValue="{{$movie->id}}";
        $.ajax({
            url:"{{route('movie.transcodeActionPerforme')}}",
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
