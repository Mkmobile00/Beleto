<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Movie Card</title>


<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    body{
        overflow: hidden;
    }
    .movie-card-wrapper {
        position: relative;
        border-radius: 10px;
        overflow: hidden;
        margin: 100px 0;
    }
    .movie-card-wrapper::after{
        position: absolute;
        height: 100%;
        width: 100%;
        background-color: white;
        border: 12px solid #fff;
        content: " ";
        position: absolute;
        top: 0;
        left: 0;
        z-index: -1;
        border-radius: 10px;
    }
    .movie-card {
        position: relative;
        background-color: #f0f0f0;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
        height: 300px;
        overflow: hidden;
        margin-right: 5px;
        margin-left: 5px;

    }

    .movie-card-wrapper:hover {
        border-radius: inherit;
        transform: scale3d(1.2,1.2,1) translate3d(15px,0,0) perspective(500px);
        position: relative;
        transform: scale3d(1.2,1.2,1) translateZ(0) perspective(500px);
        transition: transform .25s cubic-bezier(.33,.04,.63,.93);
        transition-delay: .4s;
        z-index: 99999;
    }
    .movie-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .movie-content {
        position: absolute;
        bottom: 0;
        background-color: white;
        padding: 6px;
        color: #333;
        opacity: 0;
        width: 100%;
        background: #fff;
        border-radius: 50px;
        bottom: 0;
        display: block;
        filter: blur(20px);
        left: -1px;
        opacity: 0;
        padding: 10px 4px 5px;
        position: absolute;
        right: -1px;
        text-align: left;
        transform: scale3d(.01,.01,0) translateZ(0) perspective(500px);
        transition: opacity .25s ease-in,bottom .25s cubic-bezier(.33,.04,.63,.93),transform .25s ease-in,bottom .25s cubic-bezier(.33,.04,.63,.93),filter .25s ease-in,bottom .25s cubic-bezier(.33,.04,.63,.93),background-color .25s ease-in,bottom .25s cubic-bezier(.33,.04,.63,.93),border-radius .25s ease-in,bottom .25s cubic-bezier(.33,.04,.63,.93);
    }

    .movie-card:hover .movie-content {
        opacity: 1;
        transform: translateY(0);
        background-color: #fff;
        border-radius: 0;
        filter: inherit;
        opacity: .99;
        transform: scaleX(1) translateZ(0) perspective(0);
        transition: opacity .25s ease-in,bottom .25s cubic-bezier(.33,.04,.63,.93),transform .25s ease-in,bottom .25s cubic-bezier(.33,.04,.63,.93),filter .25s ease-in,bottom .25s cubic-bezier(.33,.04,.63,.93),background-color .25s ease-in,bottom .25s cubic-bezier(.33,.04,.63,.93),border-radius .25s ease-in,bottom .25s cubic-bezier(.33,.04,.63,.93);
        transition-delay: .4s;
        z-index: 2;
    }

    .movie-title {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 4px;
    }

    .movie-details {
        margin-bottom: 6px;
    }

    .movie-details span {
        margin-right: 10px;
    }

    .btn {
        padding: 8px 16px;
        background-color: dodgerblue;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn:hover {
        background-color: #007bff;
    }

    .btn i {
        margin-right: 5px;
    }

    

</style>
</head>
<body>

    <div class="slick-carousel">
        <div class="movie-card-wrapper">
            <div class="movie-card">
                <img src="https://images.pexels.com/photos/13020492/pexels-photo-13020492.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Movie Poster" class="movie-image">
                <div class="movie-content">
                    <div class="movie-title">Movie Name</div>
                    <div class="movie-details">
                        <span>2h 30min</span>
                        <span> Action, Adventure</span>
                    </div>
                    <button class="btn"><i class="fas fa-play"></i>Watch</button>
                    <button class="btn"><i class="fas fa-share"></i> Share</button>
                </div>
            </div>
        </div>
        <div class="movie-card-wrapper">
            <div class="movie-card">
                <img src="https://images.pexels.com/photos/18771871/pexels-photo-18771871/free-photo-of-town-with-beach-on-amalfi-coast.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Movie Poster" class="movie-image">
                <div class="movie-content">
                    <div class="movie-title">Movie Name</div>
                    <div class="movie-details">
                        <span>Duration: 2h 30min</span>
                        <span>Action, Adventure</span>
                    </div>
                    <button class="btn"><i class="fas fa-play"></i> Watch</button>
                    <button class="btn"><i class="fas fa-share"></i> Share</button>
                </div>
            </div>
        </div>

        <div class="movie-card-wrapper">
            <div class="movie-card">
                <img src="https://images.pexels.com/photos/14747091/pexels-photo-14747091.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Movie Poster" class="movie-image">
                <div class="movie-content">
                    <div class="movie-title">Movie Name</div>
                    <div class="movie-details">
                        <span>Duration: 2h 30min</span>
                        <span>Action, Adventure</span>
                    </div>
                    <button class="btn"><i class="fas fa-play"></i>Watch</button>
                    <button class="btn"><i class="fas fa-share"></i> Share</button>
                </div>
            </div>
        </div>
        <div class="movie-card-wrapper">
            <div class="movie-card">
                <img src="https://images.pexels.com/photos/19988406/pexels-photo-19988406/free-photo-of-woman-standing-with-arms-raised-on-grassland.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Movie Poster" class="movie-image">
                <div class="movie-content">
                    <div class="movie-title">Movie Name</div>
                    <div class="movie-details">
                        <span>Duration: 2h 30min</span>
                        <span>Action, Adventure</span>
                    </div>
                    <button class="btn"><i class="fas fa-play"></i>Watch</button>
                    <button class="btn"><i class="fas fa-share"></i> Share</button>
                </div>
            </div>
        </div>
        <div class="movie-card-wrapper">
            <div class="movie-card">
                <img src="https://images.pexels.com/photos/13020492/pexels-photo-13020492.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Movie Poster" class="movie-image">
                <div class="movie-content">
                    <div class="movie-title">Movie Name</div>
                    <div class="movie-details">
                        <span>Duration: 2h 30min</span>
                        <span>Action, Adventure</span>
                    </div>
                    <button class="btn"><i class="fas fa-play"></i>Watch</button>
                    <button class="btn"><i class="fas fa-share"></i> Share</button>
                </div>
            </div>
        </div>
        <div class="movie-card-wrapper">
            <div class="movie-card">
                <img src="https://images.pexels.com/photos/18771871/pexels-photo-18771871/free-photo-of-town-with-beach-on-amalfi-coast.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Movie Poster" class="movie-image">
                <div class="movie-content">
                    <div class="movie-title">Movie Name</div>
                    <div class="movie-details">
                        <span>Duration: 2h 30min</span>
                        <span>Action, Adventure</span>
                    </div>
                    <button class="btn"><i class="fas fa-play"></i>Watch</button>
                    <button class="btn"><i class="fas fa-share"></i> Share</button>
                </div>
            </div>
        </div>
        <div class="movie-card-wrapper">
            <div class="movie-card">
                <img src="https://images.pexels.com/photos/14747091/pexels-photo-14747091.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Movie Poster" class="movie-image">
                <div class="movie-content">
                    <div class="movie-title">Movie Name</div>
                    <div class="movie-details">
                        <span>Duration: 2h 30min</span>
                        <span>Action, Adventure</span>
                    </div>
                    <button class="btn"><i class="fas fa-play"></i>Watch</button>
                    <button class="btn"><i class="fas fa-share"></i> Share</button>
                </div>
            </div>
        </div>

        <div class="movie-card-wrapper">
            <div class="movie-card">
                <img src="https://images.pexels.com/photos/19988406/pexels-photo-19988406/free-photo-of-woman-standing-with-arms-raised-on-grassland.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Movie Poster" class="movie-image">
                <div class="movie-content">
                    <div class="movie-title">Movie Name</div>
                    <div class="movie-details">
                        <span>Duration: 2h 30min</span>
                        <span>Action, Adventure</span>
                    </div>
                    <button class="btn"><i class="fas fa-play"></i>Watch</button>
                    <button class="btn"><i class="fas fa-share"></i> Share</button>
                </div>
            </div>
        </div>
    </div>


</body>
</html>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.slick-carousel').slick({
            Infinity: false,
            slidesToShow: 6,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 2000,
            arrows: true,
            dots: false,
            prevArrow: '<button type="button" class="slick-prev" style="z-index: 999; color: white;"><i class="fas fa-chevron-left"></i></button>',
            nextArrow: '<button type="button" class="slick-next" style="z-index: 999; color: white; margin-right: 50px"><i class="fas fa-chevron-right"></i></button>',
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    });
</script>