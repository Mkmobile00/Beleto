
<?php $__env->startPush('styles'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('contents'); ?>

    <section id="main-slider">
        <div #swiperRef="" class="swiper mySwiper">
            <div class="swiper-wrapper">
                <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="swiper-slide" >
                        <?php if($slider->type=='video'): ?>
                        <video id="my-video" class="video-js play_video" controls preload="auto" poster="" data-setup="{}" autoplay muted style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); max-width: 100%; height: auto; min-width: 100%; min-height: 100%; width: auto;">
                            <source
                                src="<?php echo e(route('video.playlist',$slider->transcode.'.m383')); ?>"
                                type="application/x-mpegURL" />
                        </video>
                        <?php else: ?>
                            <img src="<?php echo e($slider->path); ?>" alt="...">
                        <?php endif; ?>
                        <?php if($slider->movie_id !=null): ?>
                            <div class="video_play_list_btn">
                                <a href="<?php echo e(route('customer.addWishList',[$slider->movie_id,$slider->item_type])); ?>" class="<?php echo e($slider->is_wish ? 'wishlistActive':''); ?>"><?php echo e($slider->is_wish ? 'Remove From My List':'Add to My List'); ?> <i class="fa fa-plus"></i></a>
                                <a href="<?php echo e(route('movieDetails',[$slider->movie_slug,$slider->item_type])); ?>">Play Now</a>
                            </div>
                        <?php endif; ?>
                    </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>


        </div>
    </section>

    
    
    <?php $__currentLoopData = $finalData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($data['layout']=='SLIDER'): ?>
        <section id="trending-movies">
            <div class="container">
                <div class="row">
                    <div class="main-title">
                        <h3><?php echo e(@$data['title']); ?></h3>
                        <div class="main-btns">
                            <a href="<?php echo e(route('collectiondetails',[$data['slug'],$data['filter_type']])); ?>" class="btns">View All <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                    </div>
                    <div class="center slider" id="mb_0">
                        <?php $__currentLoopData = $data['movies']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="movie-card-wrapper">
                            <div class="movie-card">
                                
                                <a href="<?php echo e(route('movieDetailsPage',[$data['slug'],$data['type']])); ?>">
                                    <img src="<?php echo e(@$movie['poster']); ?>">
                                </a>
                                <div class="movie-content">
                                    <div class="movie-title"><?php echo e(@$data['title']); ?></div>
                                    <div class="data-details">
                                        <span><?php echo e(@$data['run_time']); ?></span>
                                        <?php if(isset($data['genre'])): ?>
                                            <span>
                                                <?php $__currentLoopData = $data['genre']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php echo e($genre['title']); ?>,
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <button type="button" class="btn btn-light"><i
                                            class="fa-regular fa-circle-play"></i>
                                        <a href="<?php echo e(route('movieDetailsPage',[$data['slug'],$data['type']])); ?>"> Watch </a></button>
                                        <button class="btn btn-link-a hover-me">
                                            <i class="fa-solid fa-share-nodes"></i>
                                            <a href="javascript:[void]" class="share-hover" title="hoverthisshare">Share</a>
                                        </button>
                                        <span class="all-share-items">
                                            <div class="sharethis-inline-share-buttons shareItem"></div>
                                        </span>

                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </section>
    <?php else: ?>
        <section id="movies">
            <div class="container">
                <div class="row">
                    <div class="main-title">
                        <h3><?php echo e(@$data['title']); ?></h3>
                        <div class="main-btns">
                            <a href="<?php echo e(route('collectiondetails',[$data['slug'],$data['filter_type']])); ?>" class="btns">View All <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                    </div>
                    <div class="movies slider">
                        <?php $__currentLoopData = $data['movies']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="movie-card-wrapper">
                                <div class="movie-card">
                                    
                                    <a href="<?php echo e(route('movieDetailsPage',[$movie['slug'],$movie['type']])); ?>">
                                        <img src="<?php echo e(@$movie['poster']); ?>">
                                    </a>
                                    <div class="movie-content">
                                        <div class="movie-title"><?php echo e(@$movie['title']); ?></div>
                                        <div class="movie-details">
                                            <span><?php echo e(@$movie['run_time']); ?></span>
                                            <?php if(isset($movie['genre'])): ?>
                                                <span>
                                                    <?php $__currentLoopData = $movie['genre']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php echo e($genre['title']); ?>,
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <button type="button" class="btn btn-light"><i
                                                class="fa-regular fa-circle-play"></i>
                                            <a href="<?php echo e(route('movieDetailsPage',[$movie['slug'],$movie['type']])); ?>"> Watch </a></button>
                                            <button class="btn btn-link-a hover-me">
                                                <i class="fa-solid fa-share-nodes"></i>
                                                <a href="javascript:[void]" class="share-hover" title="hoverthisshare">Share</a>
                                            </button>
                                            <span class="all-share-items">
                                                <div class="sharethis-inline-share-buttons shareItem"></div>
                                            </span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                </div>
            </div>

        </section>
    <?php endif; ?>

   

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php if(count($stremmings) > 0): ?>
    <section id="stremming">
        <div class="container">
            <div class="row">
                <div class="main-title">
                    <h3>Stremming Soon</h3>
                    <div class="main-btns">
                        
                    </div>
                </div>
                <div class="movies slider">
                    <?php $__currentLoopData = $stremmings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="movie-card-wrapper">
                            <div class="movie-card">
                                
                                <a href="<?php echo e(route('stremmingsoon',[$movie->slug,'0'])); ?>">
                                    <img src="<?php echo e(@$movie['poster']); ?>">
                                </a>
                                <div class="movie-content">
                                    <div class="movie-title"><?php echo e(@$movie['title']); ?></div>
                                    <div class="movie-details">
                                        <span><?php echo e(@$movie['run_time']); ?></span>
                                        <?php if(isset($movie['genre'])): ?>
                                            <span>
                                                <?php $__currentLoopData = $movie['genre']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php echo e($genre['title']); ?>,
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <button type="button" class="btn btn-light"><i
                                            class="fa-regular fa-circle-play"></i>
                                        <a href="<?php echo e(route('stremmingsoon',[$movie->slug,'0'])); ?>"> Watch </a></button>
                                        <button class="btn btn-link-a hover-me">
                                            <i class="fa-solid fa-share-nodes"></i>
                                            <a href="javascript:[void]" class="share-hover" title="hoverthisshare">Share</a>
                                        </button>
                                        <span class="all-share-items">
                                            <div class="sharethis-inline-share-buttons shareItem"></div>
                                        </span>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

            </div>
        </div>

    </section>
    <?php endif; ?>
    
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
    $(document).ready(function() {
        $('.all-share-items').hide();
        $('.hover-me').click(function() {
            $(this).siblings('.all-share-items').toggle();
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.includes.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nextcinemas\nextcinemas\resources\views/frontend/index.blade.php ENDPATH**/ ?>