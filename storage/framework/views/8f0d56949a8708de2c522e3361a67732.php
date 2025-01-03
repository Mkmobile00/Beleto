
<?php $__env->startSection('title', 'System Setting '); ?>
<?php $__env->startSection('main'); ?>
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>System Setting</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('admin.home')); ?></a></li>
                            <li class="breadcrumb-item active">
                                THEME OPTIONS
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <?php if(isset($systemSetting)): ?>
                    <?php echo e(Form::open(['url' => route('system-setting.update', $systemSetting->id), 'files' => true, 'class' => 'form form-horizontal'])); ?>

                    <?php echo method_field('put'); ?>
                <?php else: ?>
                    <?php echo e(Form::open(['url' => route('system-setting.store'), 'files' => true, 'class' => 'form form-horizontal'])); ?>

                <?php endif; ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">THEME OPTIONS</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="theme">Theme</label>
                                        <select name="theme" id="theme" class="form-control ">
                                            <option value="default" <?php echo e(old('theme',@$systemSetting->theme)=='default' ? 'selected':''); ?>>default</option>
                                        </select>
                                        <?php $__errorArgs = ['theme'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    


                                    <div class="col-md-6 form-group mt-2">
                                        <label for="purchase_code">Purchase Code</label>
                                        <input type="text" name="purchase_code" id="purchase_code" class="form-control "
                                            value="<?php echo e(old('purchase_code',@$systemSetting->purchase_code)); ?>">
                                        <?php $__errorArgs = ['purchase_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="time_zone">TimeZone</label>
                                        <select name="time_zone" id="time_zone" class="form-control select2">
                                            <?php $__currentLoopData = $timeZone; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$zone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($zone); ?>" <?php echo e((old('time_zone', @$systemSetting->time_zone) == @$zone ? 'selected' : '')); ?>><?php echo e($key); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        Server Time: <?php echo e(@$serverTime); ?>

                                        <?php $__errorArgs = ['time_zone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="site_name">Site Name</label>
                                        <input type="text" name="site_name" id="site_name" class="form-control "
                                            value="<?php echo e(old('site_name',@$systemSetting->site_name)); ?>">
                                        <?php $__errorArgs = ['site_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="site_url">Site URL</label>
                                        <input type="url" name="site_url" id="site_url" class="form-control "
                                            value="<?php echo e(old('site_url',@$systemSetting->site_url)); ?>">
                                        <?php $__errorArgs = ['site_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="system_email">System Email</label>
                                        <input type="email" name="system_email" id="system_email" class="form-control "
                                            value="<?php echo e(old('system_email',@$systemSetting->system_email)); ?>">
                                        <?php $__errorArgs = ['system_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="bussiness_address">Business Address</label>
                                        <input type="text" name="bussiness_address" id="bussiness_address" class="form-control "
                                            value="<?php echo e(old('bussiness_address',@$systemSetting->bussiness_address)); ?>">
                                        <?php $__errorArgs = ['bussiness_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="bussiness_phone">Business Phone</label>
                                        <input type="number" name="bussiness_phone" id="bussiness_phone" class="form-control " data-parsley-length="[10, 14]"
                                            value="<?php echo e(old('bussiness_phone',@$systemSetting->bussiness_phone)); ?>">
                                        <?php $__errorArgs = ['bussiness_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="contact_email">Contact Email</label>
                                        <input type="email" name="contact_email" id="contact_email" class="form-control "
                                            value="<?php echo e(old('contact_email',@$systemSetting->contact_email)); ?>">
                                        <?php $__errorArgs = ['contact_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>



                                    <div class="col-md-6 form-group mt-2">
                                        <label for="fb_link">Fb Link</label>
                                        <input type="url" name="fb_link" id="fb_link" class="form-control "
                                            value="<?php echo e(old('fb_link',@$systemSetting->fb_link)); ?>">
                                        <?php $__errorArgs = ['fb_link'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="insta_link">Insta Link</label>
                                        <input type="url" name="insta_link" id="insta_link" class="form-control "
                                            value="<?php echo e(old('insta_link',@$systemSetting->insta_link)); ?>">
                                        <?php $__errorArgs = ['insta_link'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="twitter_link">Twitter Link</label>
                                        <input type="url" name="twitter_link" id="twitter_link" class="form-control "
                                            value="<?php echo e(old('twitter_link',@$systemSetting->twitter_link)); ?>">
                                        <?php $__errorArgs = ['twitter_link'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="youtube_link">Youtube Link</label>
                                        <input type="url" name="youtube_link" id="youtube_link" class="form-control "
                                            value="<?php echo e(old('youtube_link',@$systemSetting->youtube_link)); ?>">
                                        <?php $__errorArgs = ['youtube_link'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="android_link">Android Link</label>
                                        <input type="url" name="android_link" id="android_link" class="form-control "
                                            value="<?php echo e(old('android_link',@$systemSetting->android_link)); ?>">
                                        <?php $__errorArgs = ['android_link'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="apple_link">Apple Link</label>
                                        <input type="url" name="apple_link" id="apple_link" class="form-control "
                                            value="<?php echo e(old('apple_link',@$systemSetting->apple_link)); ?>">
                                        <?php $__errorArgs = ['apple_link'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="registration_enable">Registration Enable</label>
                                        <select name="registration_enable" id="registration_enable" class="form-control ">
                                            <?php $__currentLoopData = formStatus(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($status['value']); ?>" <?php echo e(old('registration_enable') != null || @$systemSetting->registration_enable != null ? (old('registration_enable', @$systemSetting->registration_enable) == $status['value'] ? 'selected' : '') : ''); ?>><?php echo e($status['title']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['registration_enable'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="frontend_login">Front-End Login</label>
                                        <select name="frontend_login" id="frontend_login" class="form-control ">
                                            <?php $__currentLoopData = formStatus(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($status['value']); ?>"<?php echo e(old('frontend_login') != null || @$systemSetting->frontend_login != null ? (old('frontend_login', @$systemSetting->frontend_login) == $status['value'] ? 'selected' : '') : ''); ?>><?php echo e($status['title']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['frontend_login'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="blog_enable">Blog Enable</label>
                                        <select name="blog_enable" id="blog_enable" class="form-control ">
                                            <?php $__currentLoopData = formStatus(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($status['value']); ?>"<?php echo e(old('blog_enable') != null || @$systemSetting->blog_enable != null ? (old('blog_enable', @$systemSetting->blog_enable) == $status['value'] ? 'selected' : '') : ''); ?>><?php echo e($status['title']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['blog_enable'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="show_country_to_main">Show Country To Main Menu</label>
                                        <select name="show_country_to_main" id="show_country_to_main" class="form-control ">
                                            <?php $__currentLoopData = formStatus(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($status['value']); ?>" <?php echo e(old('show_country_to_main') != null || @$systemSetting->show_country_to_main != null ? (old('show_country_to_main', @$systemSetting->show_country_to_main) == $status['value'] ? 'selected' : '') : ''); ?>><?php echo e($status['title']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['show_country_to_main'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="show_genre_to_main">Show Genre To Main Menu</label>
                                        <select name="show_genre_to_main" id="show_genre_to_main" class="form-control ">
                                            <?php $__currentLoopData = formStatus(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($status['value']); ?>" <?php echo e(old('show_genre_to_main') != null || @$systemSetting->show_genre_to_main != null ? (old('show_genre_to_main', @$systemSetting->show_genre_to_main) == $status['value'] ? 'selected' : '') : ''); ?>><?php echo e($status['title']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['show_genre_to_main'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="show_release_to_main">Show Release To Main Menu</label>
                                        <select name="show_release_to_main" id="show_release_to_main" class="form-control ">
                                            <?php $__currentLoopData = formStatus(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($status['value']); ?>" <?php echo e(old('show_release_to_main') != null || @$systemSetting->show_release_to_main != null ? (old('show_release_to_main', @$systemSetting->show_release_to_main) == $status['value'] ? 'selected' : '') : ''); ?>><?php echo e($status['title']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['show_release_to_main'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="show_contact_to_main">Show Contact To Main Menu</label>
                                        <select name="show_contact_to_main" id="show_contact_to_main" class="form-control ">
                                            <?php $__currentLoopData = formStatus(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($status['value']); ?>" <?php echo e(old('show_contact_to_main') != null || @$systemSetting->show_contact_to_main != null ? (old('show_contact_to_main', @$systemSetting->show_contact_to_main) == $status['value'] ? 'selected' : '') : ''); ?>><?php echo e($status['title']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['show_contact_to_main'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="show_contact_to_footer">Show Contact To Footer Menu</label>
                                        <select name="show_contact_to_footer" id="show_contact_to_footer" class="form-control ">
                                            <?php $__currentLoopData = formStatus(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($status['value']); ?>" <?php echo e(old('show_contact_to_footer') != null || @$systemSetting->show_contact_to_footer != null ? (old('show_contact_to_footer', @$systemSetting->show_contact_to_footer) == $status['value'] ? 'selected' : '') : ''); ?>><?php echo e($status['title']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['show_contact_to_footer'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="show_actordirwr_image_to_main">Show Actor,Director & Writer Image To Movie Page</label>
                                        <select name="show_actordirwr_image_to_main" id="show_actordirwr_image_to_main" class="form-control ">
                                            <?php $__currentLoopData = formStatus(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($status['value']); ?>" <?php echo e(old('show_actordirwr_image_to_main') != null || @$systemSetting->show_actordirwr_image_to_main != null ? (old('show_actordirwr_image_to_main', @$systemSetting->show_actordirwr_image_to_main) == $status['value'] ? 'selected' : '') : ''); ?>><?php echo e($status['title']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['show_actordirwr_image_to_main'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="show_azlist_to_main">Show AZ List To Main Menu</label>
                                        <select name="show_azlist_to_main" id="show_azlist_to_main" class="form-control ">
                                            <?php $__currentLoopData = formStatus(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($status['value']); ?>" <?php echo e(old('show_azlist_to_main') != null || @$systemSetting->show_azlist_to_main != null ? (old('show_azlist_to_main', @$systemSetting->show_azlist_to_main) == $status['value'] ? 'selected' : '') : ''); ?>><?php echo e($status['title']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['show_azlist_to_main'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="show_azlist_to_footer">Show AZ List To Footer Menu</label>
                                        <select name="show_azlist_to_footer" id="show_azlist_to_footer" class="form-control ">
                                            <?php $__currentLoopData = formStatus(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($status['value']); ?>" <?php echo e(old('show_azlist_to_footer') != null || @$systemSetting->show_azlist_to_footer != null ? (old('show_azlist_to_footer', @$systemSetting->show_azlist_to_footer) == $status['value'] ? 'selected' : '') : ''); ?>><?php echo e($status['title']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['show_azlist_to_footer'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="enable_movie_report">Enable Movie Report</label>
                                        <select name="enable_movie_report" id="enable_movie_report" class="form-control ">
                                            <?php $__currentLoopData = formStatus(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($status['value']); ?>" <?php echo e(old('enable_movie_report') != null || @$systemSetting->enable_movie_report != null ? (old('enable_movie_report', @$systemSetting->enable_movie_report) == $status['value'] ? 'selected' : '') : ''); ?>><?php echo e($status['title']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['enable_movie_report'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="movie_report_send_to">Movie Report Send To(Email)</label>
                                        <input type="email" name="movie_report_send_to" id="movie_report_send_to" class="form-control "
                                            value="<?php echo e(old('movie_report_send_to',@$systemSetting->movie_report_send_to)); ?>">
                                        <?php $__errorArgs = ['movie_report_send_to'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="movie_report_attention_text">Movie Report Attention Text</label>
                                        <textarea name="movie_report_attention_text" id="movie_report_attention_text" class="form-control " cols="30" rows="3">
                                            <?php echo e(old('movie_report_attention_text',@$systemSetting->movie_report_attention_text)); ?>

                                        </textarea>
                                        
                                        <?php $__errorArgs = ['movie_report_attention_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="enable_movie_request">Enable Movie Request</label>
                                        <select name="enable_movie_request" id="enable_movie_request" class="form-control ">
                                            <?php $__currentLoopData = formStatus(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($status['value']); ?>" <?php echo e(old('enable_movie_request') != null || @$systemSetting->enable_movie_request != null ? (old('enable_movie_request', @$systemSetting->enable_movie_request) == $status['value'] ? 'selected' : '') : ''); ?>><?php echo e($status['title']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['enable_movie_request'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="movie_request_send_to">Movie Request Send To(Email)</label>
                                        <input type="email" name="movie_request_send_to" id="movie_request_send_to" class="form-control "
                                            value="<?php echo e(old('movie_request_send_to',@$systemSetting->movie_request_send_to)); ?>">
                                        <?php $__errorArgs = ['movie_request_send_to'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="enable_google_captcha">Enable Google Recaptcha</label>
                                        <select name="enable_google_captcha" id="enable_google_captcha" class="form-control ">
                                            <?php $__currentLoopData = formStatus(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($status['value']); ?>" <?php echo e(old('enable_google_captcha') != null || @$systemSetting->enable_google_captcha != null ? (old('enable_google_captcha', @$systemSetting->enable_google_captcha) == $status['value'] ? 'selected' : '') : ''); ?>><?php echo e($status['title']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['enable_google_captcha'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="google_captcha_sitekey">Recaptcha Site Key</label>
                                        <input type="text" name="google_captcha_sitekey" id="google_captcha_sitekey" class="form-control "
                                            value="<?php echo e(old('google_captcha_sitekey',@$systemSetting->google_captcha_sitekey)); ?>">
                                        <?php $__errorArgs = ['google_captcha_sitekey'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="google_captcha_secretkey">Recaptcha Secret Key</label>
                                        <input type="text" name="google_captcha_secretkey" id="google_captcha_secretkey" class="form-control "
                                            value="<?php echo e(old('google_captcha_secretkey',@$systemSetting->google_captcha_secretkey)); ?>">
                                        <?php $__errorArgs = ['google_captcha_secretkey'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit"
                        class="btn btn-primary">Save Changes</button>
                </div>
                </form>

            </div>
        </section>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

     <script>

        
        $(document).ready(function(){
          $('#logo').filemanager('image');
        });
      </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nextcinemas\resources\views/admin/setting/systemsetting/form.blade.php ENDPATH**/ ?>