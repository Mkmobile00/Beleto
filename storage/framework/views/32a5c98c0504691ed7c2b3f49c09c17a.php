<section id="menu-logo">
    <div id="top-bar-nav">
        <div class="container-fluid">
            <div class="row">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="logo-column">
                        <div class="logo">
                            <a href="<?php echo e(route('home')); ?>" title="Kantipur Cinemas">
                                <img src="<?php echo e(asset('frontend/assets/img/logo.jpg')); ?>" />
                            </a>
                        </div>
                    </div>
                    
                    
                    <div class="mid-column">
                        <div class="header-top-left">
                            <ul class="ott-nav">
                                <li class="upper-links"><a class="links" href="<?php echo e(route('home')); ?>">Home</a></li>
                                <?php $__currentLoopData = $topMenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="upper-links <?php echo e($menu['subcat'] && count($menu['subcat']) > 0 ? 'dropdown':''); ?>">
                                    <a class="links" href="<?php echo e(route('category.details',[$menu['slug'],$menu['type']])); ?>"><?php echo e($menu['title']); ?>

                                        <?php if($menu['subcat'] && count($menu['subcat']) > 0): ?>
                                            <i class="fa-solid fa-chevron-down"></i>
                                        <?php endif; ?>
                                    </a>
                                    <?php if($menu['subcat'] && count($menu['subcat']) > 0): ?>
                                        <ul class="dropdown-menu">
                                            <?php $__currentLoopData = $menu['subcat']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subMenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="profile-li">
                                                    <a class="profile-links"
                                                        href="<?php echo e(route('category.details',[$subMenu['slug'],$subMenu['type']])); ?>"><?php echo e($subMenu['title']); ?>

                                                    </a>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    <?php endif; ?>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $headerPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="upper-links <?php echo e($menu['subcat'] && count($menu['subcat']) > 0 ? 'dropdown':''); ?>">
                                        <a class="links" href="<?php echo e(route('page.details',$page->slug)); ?>"><?php echo e($page->name); ?>

                                            <?php if($page->children && count($page->children) > 0): ?>
                                                <i class="fa-solid fa-chevron-down"></i>
                                            <?php endif; ?>
                                        </a>
                                        <?php if($page->children && count($page->children) > 0): ?>
                                            <ul class="dropdown-menu">
                                                <?php $__currentLoopData = $page->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subMenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li class="profile-li">
                                                        <a class="profile-links"
                                                            href="<?php echo e(route('page.details',$subMenu->slug)); ?>"><?php echo e($subMenu->name); ?>

                                                        </a>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                    <div class="right-column">
                        <div class="header-top-right d-flex align-items-center flex-wrap">
                            <span class="search-kantipur">
                                <a class="links" href="#" id="search_icon"><i class="fa-solid fa-magnifying-glass"></i></a>
                            </span>
                            <span class="login-button">
                                <?php if(isset($customer)): ?>
                                    <?php if($customer): ?>
                                    <a class="links" href="<?php echo e(route('customer.dashboard')); ?>"><?php echo e(@($customer->customerDetail->first_name.' '.@$customer->customerDetail->last_name) ?? @$customer->email); ?> </a>
                                    <a href="<?php echo e(route('customer.logout')); ?>" class="links">Logout</a>
                                    <form action="<?php echo e(route('setCustomerCurrency')); ?>" method="post" id="currencySetForm" style="display:inline; border: 1px solid #fff;">
                                        <?php echo csrf_field(); ?>
                                        <select name="currency_id" id="selectCurrency">
                                            <?php $__currentLoopData = $currencyTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($type['id']); ?>" <?php echo e(@$customer->cutomerDefaultCurrency->currency_id==$type['id'] ? 'selected':''); ?>><?php echo e($type['text']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </form>
                                    <?php else: ?>
                                        <a class="links" href="<?php echo e(route('customer.login')); ?>">Login </a>
                                        <a class="links" href="<?php echo e(route('customer.register')); ?>">Register </a>
                                    <?php endif; ?>
                                <?php else: ?>
                                <a class="links" href="<?php echo e(route('customer.login')); ?>">Login </a>
                                <a class="links" href="<?php echo e(route('customer.register')); ?>">Register </a>
                                <?php endif; ?>

                            </span>

                            <span class="subscribe-button">
                                <a class="links" href="<?php echo e(route('customer.subscription')); ?>"><i class="fa-solid fa-crown"></i> Subscribe</a>
                            </span>
                            <span class="myside-button" >
                                <a data-bs-toggle="modal" style="padding: 0; font-size: 18px;" href="#exampleModalToggle" role="button"><i
                                        class="fa-solid fa-bars-staggered"></i></a>
                                <div class="modal fade" id="exampleModalToggle" aria-hidden="true"
                                    aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content bg-color">
                                            <div class="modal-header d-flex justify-content-between align-items-center">
                                                <h1 class="modal-title fs-5 text-white">Kantipur Cinemas </h1>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-close"></i></button>
                                              </div>
                                            <div class="modal-body">
                                                We are Kantipur Cinemas, Nepal’s largest OTT platform, dedicated to
                                                delivering premium, high-quality Nepali-originated movies, web
                                                series, and authentic short films to Nepali audiences worldwide
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </span>

                            <?php if($customer): ?>
                                <span class="wishlist-icon">
                                    <i class="fas fa-shopping-cart"></i>
                                    <div class="count">
                                        <span><?php echo e(count($customer->wishList)); ?></span>
                                    </div>
                                </span>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <h2 style="margin:0px;"><span class="smallnav menu" onclick="openNav()">☰ Kantipur Cinemas</span></h2>
                </div>
            </div>
        </div>
    </div>
    <!-- sidebar  -->
    <div id="mySidenav" class="sidenav">
        <div class="container" style="background-color: #0f0617;">
          <span class="sidenav-heading">Kantipur Cinemas</span>
          <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        </div>
        <ul class="d-flex flex-column">
            <li class="upper-links"><a class="links" href="<?php echo e(route('home')); ?>">Home</a></li>
            <?php $__currentLoopData = $topMenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="upper-links <?php echo e($menu['subcat'] && count($menu['subcat']) > 0 ? 'dropdown':''); ?>">
                <div class="d-flex justify-content-between align-items-center">
                    <a class="links" href="<?php echo e(route('category.details',[$menu['slug'],$menu['type']])); ?>"><?php echo e($menu['title']); ?>

                    </a>
                    <?php if($menu['subcat'] && count($menu['subcat']) > 0): ?>
                        <i class="fa-solid fa-chevron-down toggle-icon p-1"></i>
                    <?php endif; ?>
                </div>
                <?php if($menu['subcat'] && count($menu['subcat']) > 0): ?>
                    <ul class="dropdown-menu">
                        <?php $__currentLoopData = $menu['subcat']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subMenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="profile-li">
                                <a class="profile-links"
                                    href="<?php echo e(route('category.details',[$subMenu['slug'],$subMenu['type']])); ?>"><?php echo e($subMenu['title']); ?>

                                </a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php endif; ?>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php $__currentLoopData = $headerPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="upper-links <?php echo e($menu['subcat'] && count($menu['subcat']) > 0 ? 'dropdown':''); ?>">
                    <div class="d-flex justify-content-between align-items-center">
                        <a class="links" href="<?php echo e(route('page.details',$page->slug)); ?>"><?php echo e($page->name); ?>


                        </a>
                        <?php if($page->children && count($page->children) > 0): ?>
                                <i class="fa-solid fa-chevron-down toggle-icon p-1"></i>
                            <?php endif; ?>
                    </div>
                    <?php if($page->children && count($page->children) > 0): ?>
                        <ul class="dropdown-menu">
                            <?php $__currentLoopData = $page->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subMenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="profile-li">
                                    <a class="profile-links"
                                        href="<?php echo e(route('page.details',$subMenu->slug)); ?>"><?php echo e($subMenu->name); ?>

                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      </div>

      <!-- modal for search  -->
        <div class="modal fade" id="searchModal" aria-hidden="true" aria-labelledby="searchModalLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content bg-color">
            <div class="modal-header d-flex justify-content-between align-items-center">
              <h1 class="modal-title fs-5 text-white">Search</h1>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-close"></i></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('customer.search')); ?>">
                <input type="text" placeholder="Search Here..." class="form-control" name="searchItem" style="padding: 10px;" required>
                <div class="text-end">
                    <button type="submit" class="btn btn-outline-secondary">Search</button>
                </div>
                </form>
            </div>
          </div>
        </div>
      </div>

</section>

<?php if($customer): ?>
<div class="wishlist-container">
    <div class="wishlist">
        <span class="wishlist_close">
            <i class="fas fa-times"></i>
        </span>
        <div class="container-fluid mt-3">

            <div class="col" id="updateWishList">
                <?php $__currentLoopData = userWishList($customer); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                <div class="d-flex justify-content-between border-bottom mb-3">
                    <div class="wishlist_img">
                        <img src="<?php echo e(@$data['image']); ?>" alt="img" style="width: 100%">
                        <div class="overlay_close"><i class="fa fa-close removeWishlist" data-id="<?php echo e($data['id']); ?>"></i></div>
                    </div>
                    <div class="ms-4">
                        <p style="margin: 0;"><strong><?php echo e(@$data['title']); ?></strong></p>
                        <span><?php echo e(@$data['rating']); ?></span>

                        <div class="description">
                            <a href="<?php echo e(route('movieDetailsPage',[@$data['slug'],@$data['type']])); ?>">View</a>
                        </div>
                    </div>
                </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>



<?php /**PATH C:\laragon\www\nextcinemas\resources\views/frontend/includes/topnav.blade.php ENDPATH**/ ?>