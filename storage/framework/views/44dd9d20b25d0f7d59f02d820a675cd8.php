 <?php $__env->startSection('contents'); ?>

<div class="detail_page">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="d-flex justify-content-between">
                    <div class="col-4">
                        <img
                            src="<?php echo e(@$movie->poster); ?>"
                            alt="img"
                            style="width: 100%"
                        />
                    </div>
                    <div class="col-7">
                        <div class="text-white">
                            <h3><?php echo e(@$movie->title); ?></h3>
                            <p><?php $__currentLoopData = $movie->genre; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('genreDetails', $genre->slug)); ?>"> <?php echo e($genre->title); ?>

                                </a>,
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php echo e(@$movie->release_date); ?> . <?php echo e(@$movie->run_time); ?></p>
                            <div class="review_star">
                                <div class="stars">
                                    <?php for($i=0;$i<(int)$movie->rating;$i++): ?>
                                        <i class="fas fa-star outline"></i>
                                    <?php endfor; ?>
                                </div>
                                (<?php echo e((int)$movie->rating); ?> / 5)
                            </div>
                            <div class="detail_page_btn">
                                <button><a href="<?php echo e(route('movieDetailsStremmingSoon',$movie->slug)); ?>">Watch Trailer</a></button>
                                <button><a href="<?php echo e(route('customer.subscription')); ?>">Subscribe Now</a></button>
                            </div>
                            <div>
                                <h3>Summary</h3>
                                <?php echo $movie->summary; ?>

                            </div>
                            <div class="description">
                                <h3>Description</h3>
                                <?php echo $movie->description; ?>

                                <div class="characters">
                                    <div class="d-flex flex-wrap">
                                        <h4>Writer : </h4>
                                        <p>
                                            <?php $__currentLoopData = $movie->writer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $writer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php echo e($writer->name); ?> 
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </p>
                                    </div>
                                    <div  class="d-flex flex-wrap">
                                        <h4>Director : </h4>
                                        <p>
                                            <?php $__currentLoopData = $movie->director; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $director): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo e($director->name); ?> 
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </p>
                                    </div>
                                    <div  class="d-flex flex-wrap">
                                        <h4>Cast : </h4>
                                        <p>
                                            <?php $__currentLoopData = $movie->actor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $actor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php echo e($actor->name); ?> 
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </p>
                                    </div>
                                    <div class="d-flex flex-wrap">
                                        <h4>Audio Languange : </h4>
                                        <p>
                                            <?php $__currentLoopData = $movie->language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php echo e($language->title); ?> 
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </p>
                                    </div>
                                    <div class="d-flex flex-wrap">
                                        <h4>Genre : </h4>
                                        <p>
                                        <?php $__currentLoopData = $movie->genre; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                             <?php echo e($genre->title); ?> 
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
         $(document).on('click','#addPremiumContent',function(){
            $('#addPremiumContentForm').submit();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.includes.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nextcinemas\resources\views/frontend/detailpagestremming.blade.php ENDPATH**/ ?>