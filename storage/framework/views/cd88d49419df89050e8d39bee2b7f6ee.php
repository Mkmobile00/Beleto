<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        

        <!-- Messages Dropdown Menu -->
        
        <!-- Notifications Dropdown Menu -->
        
        
        
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

        <li class="nav-item dropdown c-name">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"
                role="button">
                <div class="user-nav d-sm-flex d-none"><span
                        class="user-name fw-bolder"><?php echo e(auth()->user()->name); ?></span>
                        
                </div><span class="avatar"><img class="round" src="<?php echo e(auth()->user()->photo ?? @$logo->website_logo); ?>"
                        alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right company-dropdown">
                <a class="dropdown-item" href="<?php echo e(route('user.edit', auth()->user()->id)); ?>"><i class="me-50"
                        data-feather="user"></i> Profile</a>

                <div class="dropdown-divider"></div>
                    <a href="javascript:;" class="dropdown-item" id="resetPassword">
                        <i class="me-50"
                        data-feather="user"></i> Reset Password
                    </a>
                <div class="dropdown-divider"></div>


                <form action="<?php echo e(route('logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button class="dropdown-item" href="#">
                        <i class="me-50" data-feather="power"></i>
                        Logout</button>
                </form>
            </div>
        </li>

        
    </ul>
</nav>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Update Password</h5>
            <button type="button" class="btn-close" data-dismiss="modal">
                X
            </button>
        </div>
        <form action="javascript:;" method="post" id="update-adminPassword">
            <?php echo method_field('put'); ?>
        <div class="modal-body">
            <div class="form-group">
                <label for="current_password">Current Password</label>
                <input type="password" name="current_password" id="current_password" class="form-control" required>
                <span class="current_password text-danger"></span>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="form-control" >
                <span class="password text-danger"></span>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="form-control" required>
                <span class="password_confirmation text-danger"></span>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" id="updatePasswordBtn" class="btn btn-primary">Update Now</button>
        </div>
    </form>
      </div>
    </div>
  </div>
<?php /**PATH C:\xampp\htdocs\nextcinemas\nextcinemas\resources\views/admin/layouts/navbar.blade.php ENDPATH**/ ?>