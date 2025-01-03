<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://vjs.zencdn.net/8.10.0/video-js.css" rel="stylesheet" />
</head>
<body>
 
    <video id="my-video" class="video-js play_video" controls preload="auto" poster="" data-setup="{}">
        <source
            src="{{ route('video.playlist','fTMBErlXI6.m383') }}"
            type="application/x-mpegURL" />
       
        
    </video>
    <script src="https://unpkg.com/video.js/dist/video.js"></script>
    <script src="https://unpkg.com/@videojs/http-streaming/dist/videojs-http-streaming.js"></script>
    <script>
        var player=videojs('my-video');
    </script>
</body>
</html>