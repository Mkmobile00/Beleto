<script src="{{ asset('frontend/assets/js/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>
<script src="{{ asset('frontend/assets/js/custom.js') }}" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{ asset('frontend/assets/slider/slick/slick.js') }}" type="text/javascript" charset="utf-8"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="https://unpkg.com/video.js/dist/video.js"></script>
    <script src="https://unpkg.com/@videojs/http-streaming/dist/videojs-http-streaming.js"></script>
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=65f6d00556117f0013cb6991&product=sop' async='async'></script>
    <script>
        var player=videojs('my-video');

    </script>
<script>
    @if(session()->get('success'))
        toastr.success("{{ session()->get('success') }}");
    @endif
    @if(session()->get('error'))
        toastr.error("{{session()->get('error')}}");
    @endif
</script>

<script>
    function generateUserID() {
      // Check if the userID exists in local storage
        var userID = localStorage.getItem('userID');

        // If it doesn't exist, generate a new one and store it
        if (!userID) {
            userID = generateUUID();
            localStorage.setItem('userID', userID);
        }

        return userID;
    }

  function generateUUID() {
      // Generate a UUID (Universally Unique Identifier)
      return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
          var r = Math.random() * 16 | 0,
              v = c == 'x' ? r : (r & 0x3 | 0x8);
          return v.toString(16);
      });
  }

  // Usage
  var userID = generateUserID();
  // alert(userID);
  setUniqueKeyMain();
  function setUniqueKeyMain(){
  // alert(userID);
  }
</script>
<script type="text/javascript">
  $(document).on('click','.removeWishlist',function(){
    const wishlistId=$(this).data('id');
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
    $.ajax({
        url:"{{route('removeFromWishList')}}",
        type:"post",
        data:{
          id:wishlistId
        },
        success:function(response){
          if(response.login){
            toastr.error(response.msg);
            window.location.href=response.url
          }
          if(response.error){
            toastr.error(response.msg);
            return false;
          }
          $('#updateWishList').replaceWith(response);
          toastr.success('Remove Successfully !!');
        }
    });
  });
    $(document).on('ready', function() {

        $(".center").slick({
        dots: false,
        infinite: false,
        centerMode: false,
        slidesToShow: 4,
        slidesToScroll: 3,
        responsive: [{
          breakpoint: 800,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 2,
          },
        },
        {
          breakpoint: 500,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          },
        },
      ],
      });
      $(".movies").slick({
        dots: false,
        infinite: false,
        centerMode: false,
        slidesToShow: 4,
        slidesToScroll: 3,
        responsive: [
        {
          breakpoint: 1300,
          settings: {
            slidesToShow: 6,
            slidesToScroll: 2,
          },
        },
        {
          breakpoint: 1100,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 2,
          },
        },
        {
          breakpoint: 800,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
          },
        },

        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          },
        },
      ],
      });
      $(".web-series").slick({
        dots: false,
        infinite: false,
        centerMode: false,
        slidesToShow: 4,
        slidesToScroll: 3,
        responsive: [{
          breakpoint: 800,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 2,
          },
        },
        {
          breakpoint: 500,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          },
        },
      ],
      });
    });
</script>
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>

    $(document).on('change','#selectCurrency',function(){
        $('#currencySetForm').submit();
    });

    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        centeredSlides: true,
        spaceBetween: 30,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
    });

    var swiperContainer = document.querySelector('.mySwiper');

    swiperContainer.addEventListener('mouseenter', function() {
        swiper.autoplay.stop();
    });

    swiperContainer.addEventListener('mouseleave', function() {
        swiper.autoplay.start();
    });

    var appendNumber = 4;
    var prependNumber = 1;
    document
        .querySelector(".prepend-2-slides")
        .addEventListener("click", function(e) {
            e.preventDefault();
            swiper.prependSlide([
                '<div class="swiper-slide">Slide ' + --prependNumber + "</div>",
                '<div class="swiper-slide">Slide ' + --prependNumber + "</div>",
            ]);
        });
    document
        .querySelector(".prepend-slide")
        .addEventListener("click", function(e) {
            e.preventDefault();
            swiper.prependSlide(
                '<div class="swiper-slide">Slide ' + --prependNumber + "</div>"
            );
        });
    document
        .querySelector(".append-slide")
        .addEventListener("click", function(e) {
            e.preventDefault();
            swiper.appendSlide(
                '<div class="swiper-slide">Slide ' + ++appendNumber + "</div>"
            );
        });
    document
        .querySelector(".append-2-slides")
        .addEventListener("click", function(e) {
            e.preventDefault();
            swiper.appendSlide([
                '<div class="swiper-slide">Slide ' + ++appendNumber + "</div>",
                '<div class="swiper-slide">Slide ' + ++appendNumber + "</div>",
            ]);
        });
</script>
<script>
    $(document).ready(function() {

      // subscription highlights
    //   function highlightSelection(selectedOption) {
    //     $('#premium4K').removeClass('highlight');
    //     $('#MobileOnly').removeClass('highlight');
    //     $(selectedOption).addClass('highlight');
    //   }

    //   $('.mobileOnly').on('click', function() {
    //     highlightSelection('#MobileOnly');
    //   });

    //   $('.premium4K').on('click', function() {
    //     highlightSelection('#premium4K');
    //   });


    //   $(".premium4K, .mobileOnly").click(function() {
    //     $(".tick_on_cirlce").removeClass("active");
    //     $(this).find(".tick_on_cirlce").addClass("active");
    //   });


      // apply code modal open
      $('#codeModal').on('show.bs.modal', function() {
        if ($('#subscriptionModal').hasClass('show')) {
          $('#subscriptionModal').modal('hide');
        }
      });


      // search box modal open
      $("#search_icon").on('click', function() {
        $("#searchModal").modal('show');
      })



      // box shadow active
      $('.content__wrapper').click(function() {
        let attribuetValue=$(this).attr('data-attributevalue');
        $('.content__wrapper').removeClass('box-shadow-active');
        $(this).addClass('box-shadow-active');
        $(`.sumitPlan`).removeClass('highlight');
        $(`.planCheck${attribuetValue}`).addClass('highlight');
        $('.sumitSubscription').removeClass('active');
        $(`.sumit${attribuetValue}`).addClass("active");
        $('#subscription_id').val(attribuetValue);
      });



      $('.wishlist-icon').click(function(){
        $('.wishlist').addClass('open');
      });

      $('.wishlist_close').click(function(){
        $('.wishlist').removeClass('open');
      });


    });


    $(document).ready(function(){
        $('.toggle-icon').click(function(){
            $(this).closest('.upper-links').find('.dropdown-menu').toggle();
        });
    });


  </script>

@stack('scripts')
</body>

</html>
