
<?php $__env->startSection('title', 'Device Management'); ?>
<?php $__env->startSection('main'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Device Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#"><?php echo e(__('admin.home')); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo e(__('admin.home')); ?></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Add Device</h3>
                            </div>
                            <div class="card-body">
                                <?php echo e(Form::open(['url'=>route('device.store'),'class'=>'form form-horizontal'])); ?>

                                <div class="row">
                                    
                                    <div class="col-md-12 form-group mt-2">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" id="title" class="form-control" value="<?php echo e(old('title',@$seoSocial->title)); ?>" required>
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

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control" required>
                                           <option value="1">Active</option>
                                           <option value="0">In-Active</option>
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
                                        <button type="submit"
                                            class="btn btn-primary"><i class="fas fa-plus"></i>  Add</button>
                                    </div>
                                </div>
                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Device list</h3>

                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right"
                                            placeholder="Search">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $devices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($key+1); ?></td>
                                                <td><?php echo e($data->title); ?></td>
                                                <td>
                                                    <span class="badge badge-<?php echo e($data->status=='1' ? 'success':'danger'); ?>"><?php echo e($data->status=='1' ? 'Active':'In Active'); ?></span>
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-success" href="<?php echo e(route('device.edit',$data->id)); ?>">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="javascript:;" class="btn btn-sm  icon btn-rounded btn-danger btn-style delete-visitor" data-id="<?php echo e($data->id); ?>">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <?php echo e(Form::open(['url'=>route('device.destroy',$data->id),'class'=>'delete-form'])); ?>

                                                        <?php echo method_field('delete'); ?>
                                                    <?php echo e(Form::close()); ?>


                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).on('click','.delete-visitor',function(e){

        e.preventDefault();
        let clicked=confirm('Are You Sure Want To Delete Device');

        if(clicked)
        {
            $(this).parent().find('form').submit();
        }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nextcinemas\resources\views/admin/setting/device/index.blade.php ENDPATH**/ ?>