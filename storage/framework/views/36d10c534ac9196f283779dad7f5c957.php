
<?php $__env->startSection('title', 'Featured Section'); ?>
<?php $__env->startSection('main'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Featured Section</h1>
                    </div>
                   
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#"><?php echo e(__('admin.home')); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo e(__('admin.home')); ?></li>
                        </ol>
                    </div>
                    <a href="<?php echo e(route('featuredsection.create')); ?>" class="btn btn-sm btn-success ml-auto">Add Featured Section</a>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                  
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Featured Section List
                                </h3>

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
                                            <th>Type</th>
                                            
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tablecontents">
                                        
                                        <?php $__currentLoopData = $featuredSections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="row1" data-id="<?php echo e($data->id); ?>">
                                                <td><?php echo e($key+1); ?></td>
                                                <td><?php echo e($data->title); ?></td>
                                                <td>
                                                    <span class="badge badge-success"><?php echo e(count($data->items)); ?></span>
                                                    <span class="badge badge-info"><?php echo e(@$data->type->name); ?></span>
                                                    <a href="<?php echo e(route('featuredsection.addItem',$data->id)); ?>" class="btn btn-sm btn-primary">Add Items</a>
                                                </td>
                                                
                                                <td>
                                                    <span class="badge badge-<?php echo e($data->status->value=='1' ? 'success' :'danger'); ?>"><?php echo e($data->status->name); ?></span>
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-success" href="<?php echo e(route('featuredsection.edit',$data->id)); ?>">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="javascript:;" class="btn btn-sm  icon btn-rounded btn-danger btn-style delete-visitor" data-id="<?php echo e($data->id); ?>">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <?php echo e(Form::open(['url'=>route('featuredsection.destroy',$data->id),'class'=>'delete-form'])); ?>

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
        let clicked=confirm('Are You Sure Want To Delete Featured Section');

        if(clicked)
        {
            $(this).parent().find('form').submit();
        }
        });

        $(function() {
            $("#tablecontents").sortable({
                items: "tr",
                cursor: 'move',
                opacity: 0.6,
                update: function() {
                    sendOrderToServer();
                }
            });

            function sendOrderToServer() {
                var order = [];
                // var token = $('meta[name="csrf-token"]').attr('content');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('tr.row1').each(function(index, element) {
                    order.push({
                        id: $(this).attr('data-id'),
                        position: index + 1
                    });

                });
                console.log('order', order)
                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: "<?php echo e(route('featuredsection.updatePosition')); ?>",
                    data: {
                        order: order,
                    },
                    success: function(response) {
                        if (response.error) {
                            toastr.error(response.msg);
                            return false;
                        }
                        toastr.success(response.msg);
                    }
                });
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nextcinemas\resources\views/admin/featuredsection/index.blade.php ENDPATH**/ ?>