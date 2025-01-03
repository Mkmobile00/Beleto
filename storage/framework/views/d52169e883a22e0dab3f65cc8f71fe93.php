
<?php $__env->startSection('title', 'Add City'); ?>
<?php $__env->startSection('main'); ?>
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Add City</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('admin.home')); ?></a></li>
                                <li class="breadcrumb-item active">
                                    Add City
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <?php if(isset($city)): ?>
                        <?php echo e(Form::open(['url' => route('city.update', $city->id), 'files' => true, 'class' => 'form form-horizontal'])); ?>

                        <?php echo method_field('patch'); ?>
                    <?php else: ?>
                        <?php echo e(Form::open(['url' => route('city.store'), 'files' => true, 'class' => 'form form-horizontal'])); ?>

                        <?php echo method_field('post'); ?>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">City Details</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                       
                                        <div class="col-md-6 form-group mt-2">
                                            <label for="title">Title</label>
                                            <input type="text" name="title" id="title" class="form-control"
                                                value="<?php echo e(old('title', @$city->title)); ?>" required>
                                            <?php $__errorArgs = ['title'];
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
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <?php $__currentLoopData = $cities_status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($status->value); ?>"
                                                        <?php echo e(@$city->status->value == $status->value ? 'selected' : ''); ?>>
                                                        <?php echo e($status->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php $__errorArgs = ['status'];
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


                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">
                                                <?php if(isset($city)): ?>
                                                    Update
                                                <?php else: ?>
                                                    Add
                                                <?php endif; ?>
                                            </button>
                                        </div>

                                    </div>
                                </div>
                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>
                </div>

        </div>
        </section>
    </div>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function() {
            // CKEDITOR.replace('summary');
            // CKEDITOR.replace('description');
            $('#lfm').filemanager('image');
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nextcinemas\nextcinemas\resources\views/admin/cities/form.blade.php ENDPATH**/ ?>