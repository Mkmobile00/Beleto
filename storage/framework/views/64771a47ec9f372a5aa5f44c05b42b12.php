<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kantipur Cinemas</title>
    <link href="<?php echo e(asset('frontend/assets/css/bootstrap.min.css')); ?>" rel="stylesheet" crossorigin="anonymous">
    <link href="<?php echo e(asset('frontend/assets/css/style.css?v=').time()); ?>" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('frontend/assets/slider/slick/slick.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('frontend/assets/slider/slick/slick-theme.css')); ?>">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="https://vjs.zencdn.net/8.10.0/video-js.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/responsive.css')); ?>">
    <?php echo $__env->make('frontend.metatag', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldPushContent('styles'); ?>
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-Q3JQXV84BE"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-Q3JQXV84BE');
</script>
</head>

<body>
   
<?php /**PATH C:\laragon\www\nextcinemas\resources\views/frontend/includes/header.blade.php ENDPATH**/ ?>