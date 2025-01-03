<section id="footer">
    <div class="container">
      <div class="row">
          <div class="col-sm-6">
            <span>Download App</span>
            <img src="assets/img/download/play_store.png" />
            <img src="assets/img/download/app_store.png" />
          </div>
          <div class="col-sm-6">
            <div class="float-end">
              <span class="float-right">Get in touch with us</span>
              <div class="social-icons">
                <i class="fab fa-facebook"></i>
                <i class="fab fa-instagram"></i>
                <i class="fab fa-twitter"></i>
                <i class="fab fa-youtube"></i>
              </div>
            </div>

          </div>
      </div>
    </div>
    <div class="generalinfo">
      <div class="container">
        <div class="row">
          <div class="d-flex justify-content-between flex-wrap">
            <div class="footer-items">
              <div class="footer-logo">
                  <a href="#">
                      <img src="assets/img/logo-footer.jpg" style="width: 100%;" />
                  </a>
              </div>
              <h4>Kantipur Cinemas Pvt. Ltd.</h4>
              <ul class="footer-address">
                  <li><strong><i class="fa-solid fa-location-dot"></i> Address:</strong> Kathmandu, Nepal</li>
                  <li><strong><i class="fa-solid fa-envelope-circle-check"></i> Email:</strong> kantipurcinemas@gmail.com</li>
                  <li><strong><i class="fa-solid fa-mobile-retro"></i> Phone:</strong> 9802356113</li>
              </ul>
            </div>
            <div class="footer-items">
              <span>Actor Movies</span>
                <li>
                  <a href="">Salman Khan Movies</a>
                </li>
                <li>
                  <a href="">Salman Khan Movies</a>
                </li>
                <li>
                  <a href="">Salman Khan Movies</a>
                </li>
                <li>
                  <a href="">Salman Khan Movies</a>
                </li>
                <li>
                  <a href="">Salman Khan Movies</a>
                </li>
                <li>
                  <a href="">Salman Khan Movies</a>
                </li>
                <li>
                  <a href="">Salman Khan Movies</a>
                </li>
                <li>
                  <a href="">Salman Khan Movies</a>
                </li>
            </div>
            <div class="footer-items">
              <span>Actor Movies</span>
                <li>
                  <a href="">Salman Khan Movies</a>
                </li>
                <li>
                  <a href="">Salman Khan Movies</a>
                </li>
                <li>
                  <a href="">Salman Khan Movies</a>
                </li>
                <li>
                  <a href="">Salman Khan Movies</a>
                </li>
                <li>
                  <a href="">Salman Khan Movies</a>
                </li>
                <li>
                  <a href="">Salman Khan Movies</a>
                </li>
            </div>
            <div class="footer-items">
                <span>Actor Movies</span>
                <li>
                  <a href="">Salman Khan Movies</a>
                </li>
                <li>
                  <a href="">Salman Khan Movies</a>
                </li>
                <li>
                  <a href="">Salman Khan Movies</a>
                </li>
                <li>
                  <a href="">Salman Khan Movies</a>
                </li>
                <li>
                  <a href="">Salman Khan Movies</a>
                </li>
                <li>
                  <a href="">Salman Khan Movies</a>
                </li><li>
                  <a href="">Salman Khan Movies</a>
                </li>
                <li>
                  <a href="">Salman Khan Movies</a>
                </li><li>
                  <a href="">Salman Khan Movies</a>
                </li>
                <li>
                  <a href="">Salman Khan Movies</a>
                </li>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>

    
    <script src="assets/js/bootstrap.bundle.min.js"  crossorigin="anonymous"></script>
    <script src="assets/js/custom.js"  crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
  <script src="assets/slider/slick/slick.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript">
    $(document).on('ready', function() {
         
      $(".center").slick({
        dots: false,
        infinite: false,
        centerMode: false,
        slidesToShow: 5,
        slidesToScroll: 3
      });    
      $(".movies").slick({
        dots: false,
        infinite: false,
        centerMode: false,
        slidesToShow: 6,
        slidesToScroll: 3
      });  
      $(".web-series").slick({
        dots: false,
        infinite: false,
        centerMode: false,
        slidesToShow: 6,
        slidesToScroll: 3
      });  
    });


    
</script>
     <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
  var swiper = new Swiper(".mySwiper", {
    slidesPerView: 1,
    centeredSlides: true,
    spaceBetween: 30,
    pagination: {
      el: ".swiper-pagination",
      type: "fraction",
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    autoplay: {
    delay: 4000,
    disableOnInteraction: false,
},
  });

  var appendNumber = 4;
  var prependNumber = 1;
  document
    .querySelector(".prepend-2-slides")
    .addEventListener("click", function (e) {
      e.preventDefault();
      swiper.prependSlide([
        '<div class="swiper-slide">Slide ' + --prependNumber + "</div>",
        '<div class="swiper-slide">Slide ' + --prependNumber + "</div>",
      ]);
    });
  document
    .querySelector(".prepend-slide")
    .addEventListener("click", function (e) {
      e.preventDefault();
      swiper.prependSlide(
        '<div class="swiper-slide">Slide ' + --prependNumber + "</div>"
      );
    });
  document
    .querySelector(".append-slide")
    .addEventListener("click", function (e) {
      e.preventDefault();
      swiper.appendSlide(
        '<div class="swiper-slide">Slide ' + ++appendNumber + "</div>"
      );
    });
  document
    .querySelector(".append-2-slides")
    .addEventListener("click", function (e) {
      e.preventDefault();
      swiper.appendSlide([
        '<div class="swiper-slide">Slide ' + ++appendNumber + "</div>",
        '<div class="swiper-slide">Slide ' + ++appendNumber + "</div>",
      ]);
    });
</script>


  </body>
</html>