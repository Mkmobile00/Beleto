<section id="footer">
    <div class="container">
        <!-- <div class="row">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="footer__items">
                    <span>Download App</span>
                    <img src="<?php echo e(asset('frontend/assets/img/download/play_store.png')); ?>" />
                    <img src="<?php echo e(asset('frontend/assets/img/download/app_store.png')); ?>" />
                </div>
                <div class="footer__items">
                    <span class="me-4"><a href="">About Us</a></span>
                    <span class="me-4"><a href="">Help Center</a></span>
                    <span class="me-4"><a href="">Privacy Policy</a></span>
                    <span class="me-4"><a href="">Terms and Use</a></span>
                </div>
                <div class="footer__items">
                    <div>
                        <span>Get in touch with us</span>
                        <div class="social-icons">
                            <i class="fab fa-facebook" title="facebook"></i>
                            <i class="fab fa-instagram" title="instagram"></i>
                            <i class="fab fa-twitter" title="twitter"></i>
                            <i class="fab fa-youtube" title="youtube"></i>
                        </div>
                    </div>

                </div>
            </div>
        </div> -->
        
    </div>
    <div class="generalinfo">
        <div class="container-fluid">
            <div class="row">
                <div class="w-80">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="footer-items">
                            <div class="footer-logo">
                                <a href="<?php echo e(route('home')); ?>">
                                    <img
                                        src="<?php echo e(@$logo->website_logo); ?>"
                                        style="width: auto"
                                        height="65px"
                                    />
                                </a>
                            </div>
                            <h4><?php echo e(@$systemSetting->site_name); ?></h4>
                            <div class="footer__items">
                                <span>Download App</span>
                                
                                        <a href="<?php echo e(@$systemSetting->android_link); ?>" target="_blank">
                                <img
                                    src="<?php echo e(asset('frontend/assets/img/download/play_store.png')); ?>"/>
                            </a>
                            <a href="<?php echo e(@$systemSetting->apple_link); ?>" target="_blank">
                                <img
                                    src="<?php echo e(asset('frontend/assets/img/download/app_store.png')); ?>"/>
                        </a>
                            </div>
                            
                        </div>
                        <?php if(count($footerPages) > 0): ?>
                    <div class="footer-items d-flex flex-wrap page-list">
                            <?php $__currentLoopData = $footerPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a
                                            href="<?php echo e(route('page.details',$page->slug)); ?>"
                                            ><?php echo e($page->name); ?></a
                                        >
                                    </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                        </div>
                        <?php endif; ?>
                    
                        
                        <div class="footer-items">
                            

                            <div class="footer__items mt-3">
                                <div>
                                    <span>Get in touch with us</span>
                                    <div class="social-icons">
                                        <a href="<?php echo e(@$systemSetting->fb_link); ?>" target="_blank">
                                            <i
                                            class="fab fa-facebook"
                                            title="facebook"
                                            >
                                        </i>
                                        </a>
                                        <a href="<?php echo e(@$systemSetting->insta_link); ?>" target="_blank">
                                        <i
                                            class="fab fa-instagram"
                                            title="instagram"
                                        ></i>
                                        </a>
                                        <a href="<?php echo e(@$systemSetting->twitter_link); ?>" target="_blank">
                                        <i
                                            class="fab fa-twitter"
                                            title="twitter"
                                        ></i>
                                        </a>
                                        <a href="<?php echo e(@$systemSetting->youtube_link); ?>" target="_blank">
                                        <i
                                            class="fab fa-youtube"
                                            title="youtube"
                                        ></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer style="padding: 10px; font-size: 16px; border-top: 1px solid #272727;">
        <div class="container-fluid">
          <div class="d-flex flex-wrap justify-content-between align-items-center">
            <p style="margin: 0">Copyright &copy; 2024 Kantipur Cinemas All Rights Reserved</p>
            <p style="margin: 0">Website Powered By <strong>
                <a href="https://nectardigit.com/" target="_blank">NectarDigit</a></strong></p>
          </div>
        </div>
    </footer>

</section>
<?php /**PATH C:\xampp\htdocs\nextcinemas\nextcinemas\resources\views/frontend/includes/bottomnav.blade.php ENDPATH**/ ?>