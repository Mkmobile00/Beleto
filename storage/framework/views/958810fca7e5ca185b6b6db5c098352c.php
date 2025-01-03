
<?php $__env->startSection('title', 'All Customer'); ?>
<?php $__env->startSection('main'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Customer List</h1>
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
                    <div class="col-12 col-sm-6 col-md-2">
                        <div class="info-box mb-3 ">
                            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>
                            <div class="info-box-content ">
                                <span class="info-box-text">Total</span>
                                <a href="<?php echo e(route('customer.list')); ?>">
                                    <span class="info-box-number"><?php echo e(@$totalUser); ?>

                                        <span class="badge badge-success">Selected</span>
                                    </span>
                                    
                                </a>
                            </div>

                        </div>

                    </div>
                    <div class="col-12 col-sm-6 col-md-2">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Verified</span>
                                <a href="<?php echo e(route('customer.verifiedlist')); ?>">
                                    <span class="info-box-number"><?php echo e(@$verifiedUser); ?></span>
                                </a>
                            </div>

                        </div>

                    </div>
                    <div class="col-12 col-sm-6 col-md-2">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Active</span>
                                <a href="<?php echo e(route('customer.activelist')); ?>">
                                    <span class="info-box-number">
                                        <?php echo e(@$activeUser); ?>

                                    </span>
                                </a>
                            </div>

                        </div>

                    </div>

                    <div class="col-12 col-sm-6 col-md-2">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">InActive</span>
                                <a href="<?php echo e(route('customer.inactivelist')); ?>">
                                    <span class="info-box-number"><?php echo e(@$inactiveUser); ?></span>
                                </a>
                            </div>

                        </div>

                    </div>


                    <div class="clearfix hidden-md-up"></div>
                    <div class="col-12 col-sm-6 col-md-2">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Blocked</span>
                                <a href="<?php echo e(route('customer.blockedlist')); ?>">
                                    <span class="info-box-number"><?php echo e(@$blockedUser); ?></span>
                                </a>
                            </div>

                        </div>

                    </div>

                    <div class="col-12 col-sm-6 col-md-2">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-light elevation-1"><i class="fas fa-box-open"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Subscription</span>
                                <a href="<?php echo e(route('customer.subscriptionuserlist')); ?>">
                                    <span class="info-box-number"><?php echo e(@$totalCustomerSubscription); ?></span>
                                </a>
                            </div>

                        </div>

                    </div>

                </div>
                <div class="row">
                    
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Customer List
                                   
                                </h3>

                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right"
                                            onkeyup="searchCustomer(this)" placeholder="Search">

                                        
                                    </div>
                                </div>
                            </div>
                           
                            
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0" id="searchCustomer">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Email/Phone</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Joined Date</th>
                                            <th>Add Subscription</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($key + 1); ?></td>
                                                <td><?php echo e(@$data->email); ?><?php echo e(@$data->phone ? '/ ' . $data->phone : ''); ?>

                                                    <span class="badge badge-<?php echo e($data->email_verified_at ? 'success':'danger'); ?>" title="<?php echo e($data->email_verified_at ? 'Verified User':'UnVerified User'); ?>">
                                                        <i class="fas fa-<?php echo e($data->email_verified_at ? 'check':'times'); ?>"></i>
                                                    </span>
                                                </td>
                                                <td><?php echo e(@$data->customerDetail->first_name . ' ' . @$data->customerDetail->last_name); ?>

                                                </td>
                                                <td>
                                                    <span
                                                        class="badge badge-<?php echo e(@$data->status->value == '1' ? 'success' : 'danger'); ?>"><?php echo e(@$data->status->name); ?></span>
                                                </td>
                                                <td><?php echo e($data->created_at->formatLocalized('%d %B, %Y')); ?>

                                                    <?php echo e($data->created_at->format('H:i:s A')); ?></td>
                                                <td>
                                                    <a href="<?php echo e(route('setcustomercustome.susbcription', $data->id)); ?>">
                                                        <span class="badge badge-primary">Add
                                                            <i class="fas fa-plus"></i>
                                                        </span>

                                                    </a>
                                                    <?php $__currentLoopData = $data->subscription; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <a href="<?php echo e(route('subscription.edit',$subdata->subscription->id)); ?>" target="_blank">
                                                        <span class="badge badge-info" title="<?php echo e(@$subdata->subscription->title); ?>">
                                                            <?php echo e(substr($subdata->subscription->title, 0, 1)); ?>

                                                        </span>
                                                    </a>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-info"
                                                        href="<?php echo e(route('customer.show', $data->id)); ?>">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a class="btn btn-sm btn-primary"
                                                        href="<?php echo e(route('customer.edit', $data->id)); ?>">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="javascript:;"
                                                        class="btn btn-sm  icon btn-rounded btn-danger btn-style delete-visitor"
                                                        data-id="<?php echo e($data->id); ?>">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <?php echo e(Form::open(['url' => route('customer.destroy', $data->id), 'class' => 'delete-form'])); ?>

                                                    <?php echo method_field('delete'); ?>
                                                    <?php echo e(Form::close()); ?>

                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                                <tfoot class="text-right mt-2">
                                    <tr>
                                        <td colspan="9">
                                            <ul class="pagination">
                                                <?php $__currentLoopData = $customers->links('pagination::bootstrap-4')->elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(is_string($element)): ?>
                                                        <li class="page-item disabled"><span
                                                                class="page-link"><?php echo e($element); ?></span></li>
                                                    <?php endif; ?>

                                                    <?php if(is_array($element)): ?>
                                                        <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <li
                                                                class="page-item <?php echo e($page == $customers->currentPage() ? 'active' : ''); ?>">
                                                                <a class="page-link movie-type"
                                                                    href="<?php echo e($url); ?>"><?php echo e($page); ?></a>
                                                            </li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </td>
                                    </tr>
                                </tfoot>
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
        $(document).on('change','#filterData',function(){
            let paymentType=$(this).val();
           $('#filterform').submit();
        });
        $(document).on('click', '.delete-visitor', function(e) {

            e.preventDefault();
            let clicked = confirm('Are You Sure Want To Delete User');

            if (clicked) {
                $(this).parent().find('form').submit();
            }
        });

        function searchCustomer(data) {
            const searchValue = data.value;
            $.ajax({
                url: "<?php echo e(route('search.customer')); ?>",
                type: "get",
                data: {
                    searchValue: searchValue,
                },
                success: function(response) {
                    $('#searchCustomer').replaceWith(response);
                }
            });
        }

        $(document).on('click', '.searchDataPaginate', function() {
            event.preventDefault();
            var url = $(this).attr('href');
            $.ajax({
                url: url,
                type: "get",
                data: {

                },
                success: function(response) {
                    $('#searchCustomer').replaceWith(response);

                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nextcinemas\resources\views/admin/customer/index.blade.php ENDPATH**/ ?>