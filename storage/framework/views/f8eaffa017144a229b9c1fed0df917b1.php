
<?php $__env->startSection('title', 'Menu'); ?>
<?php $__env->startPush('styles'); ?>
    <style>
  .menu-handle {
            display: block;
            margin-bottom: 5px;
            padding: 6px 4px 6px 12px;
            color: #333;
            font-weight: bold;
            border: 1px solid #ccc;
            background: #fafafa;
            background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: linear-gradient(top, #fafafa 0%, #eee 100%);
            -webkit-border-radius: 3px;
            border-radius: 3px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            cursor: move;
        }

        .menu-handle:hover {
            background: #fff;
        }

        .placeholder {
            margin-bottom: 10px;
            background: #D7F8FD
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('main'); ?>
    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Menu List <a href="<?php echo e(route('menu.create')); ?>" class="btn btn-primary">Add New Menu</a></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Menu List</li>
                    </ol>
                </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="card-title">Manage Menu</h2>
                                    <div class="card-tools">
                                        <a href="<?php echo e(route('menu.index')); ?>" type="button" class="btn btn-tool"></a>
                                    </div>
                                </div>
                                <div class="card-body card-format">
                                    <h3>Header Menu</h3>
                                    <?php if($menu_items->count() > 0): ?>
                                        <ol class="sortable">
                                            <?php $__currentLoopData = $menu_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($item->parent_id == null): ?>
                                                    <li id="menuItem_<?php echo e($item->id); ?>">
                                                        <div class="menu-handle d-flex justify-content-between">
                                                            <span>
                                                                <?php echo e($item->name); ?>

                                                            </span>
                                                            <?php
                                                                $child_menus = \App\Models\Menu::orderBy('position', 'asc')->where('parent_id', $item->id)->get();
                                                            ?>

                                                            <div class="menu-options btn-group">
                                                                <a href="<?php echo e(route('menu.edit', $item->id)); ?>" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletionservice<?php echo e($item->id); ?>" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                                                                <!-- Modal -->
                                                                    <div class="modal fade text-left" id="deletionservice<?php echo e($item->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                                </div>
                                                                                <div class="modal-body text-center">
                                                                                    <form action="<?php echo e(route('menu.destroy', $item->id)); ?>" method="POST" style="display:inline-block;">
                                                                                        <?php echo csrf_field(); ?>
                                                                                        <?php echo method_field("POST"); ?>
                                                                                        <label for="reason">Are you sure you want to delete??</label><br>
                                                                                        <input type="hidden" name="_method" value="DELETE" />
                                                                                        <button type="submit" class="btn btn-danger" title="Delete">Confirm Delete</button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    ";
                                                                    </div>
                                                            </div>
                                                        </div>

                                                        <ol class="sortable">
                                                            <?php $__currentLoopData = $child_menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <li id="menuItem_<?php echo e($menu->id); ?>">
                                                                        <div class="menu-handle d-flex justify-content-between">
                                                                            <span>
                                                                                <?php echo e($menu->name); ?>

                                                                            </span>

                                                                            <div class="menu-options btn-group">
                                                                                <a href="<?php echo e(route('menu.edit', $menu->id)); ?>" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletionservice<?php echo e($menu->id); ?>" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                                                                                <!-- Modal -->
                                                                                    <div class="modal fade text-left" id="deletionservice<?php echo e($menu->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                        <div class="modal-dialog" role="document">
                                                                                            <div class="modal-content">
                                                                                                <div class="modal-header">
                                                                                                <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                    <span aria-hidden="true">&times;</span>
                                                                                                </button>
                                                                                                </div>
                                                                                                <div class="modal-body text-center">
                                                                                                    <form action="<?php echo e(route('menu.destroy', $menu->id)); ?>" method="POST" style="display:inline-block;">
                                                                                                        <?php echo csrf_field(); ?>
                                                                                                        <?php echo method_field("POST"); ?>
                                                                                                        <label for="reason">Are you sure you want to delete??</label><br>
                                                                                                        <input type="hidden" name="_method" value="DELETE" />
                                                                                                        <button type="submit" class="btn btn-danger" title="Delete">Confirm Delete</button>
                                                                                                    </form>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    ";
                                                                                    </div>
                                                                            </div>
                                                                        </div>
                                                                        <?php
                                                                        $sub_child_menus = \App\Models\Menu::orderBy('position', 'asc')->where('parent_id', $menu->id)->get();
                                                                        ?>

                                                                    <ol class="sortable">
                                                                        <?php $__currentLoopData = $sub_child_menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <li id="menuItem_<?php echo e($menu1->id); ?>">
                                                                                <div class="menu-handle d-flex justify-content-between">
                                                                                    <span>
                                                                                        <?php echo e($menu1->name); ?>

                                                                                    </span>

                                                                                    <div class="menu-options btn-group">
                                                                                        <a href="<?php echo e(route('menu.edit', $menu1->id)); ?>" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                                                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletionservice<?php echo e($menu->id); ?>" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                                                                                        <!-- Modal -->
                                                                                            <div class="modal fade text-left" id="deletionservice<?php echo e($menu1->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                                <div class="modal-dialog" role="document">
                                                                                                    <div class="modal-content">
                                                                                                        <div class="modal-header">
                                                                                                        <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                            <span aria-hidden="true">&times;</span>
                                                                                                        </button>
                                                                                                        </div>
                                                                                                        <div class="modal-body text-center">
                                                                                                            <form action="<?php echo e(route('menu.destroy', $menu1->id)); ?>" method="POST" style="display:inline-block;">
                                                                                                                <?php echo csrf_field(); ?>
                                                                                                                <?php echo method_field("POST"); ?>
                                                                                                                <label for="reason">Are you sure you want to delete??</label><br>
                                                                                                                <input type="hidden" name="_method" value="DELETE" />
                                                                                                                <button type="submit" class="btn btn-danger" title="Delete">Confirm Delete</button>
                                                                                                            </form>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            ";
                                                                                            </div>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </ol>
                                                                    </li>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </ol>
                                                        
                                                        
                                                    </li>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <div class="form-group mt-4">
                                                <button type="button" class="btn btn-success btn-sm btn-flat" id="serialize"><i
                                                        class="fa fa-save"></i>
                                                    Update Menu
                                                </button>
                                            </div>
                                        </ol>
                                    <?php else: ?>
                                        <p class="text-center">Menu Not Found in Database</p>
                                    <?php endif; ?>
                                </div>
                                <div class="card-body card-format">
                                    <h3>Footer Menu</h3>
                                    <?php if($menu_footer->count() > 0): ?>
                                        <ol class="sortable">
                                            <?php $__currentLoopData = $menu_footer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($item->parent_id == null): ?>
                                                    <li id="menuItem_<?php echo e($item->id); ?>">
                                                        <div class="menu-handle d-flex justify-content-between">
                                                            <span>
                                                                <?php echo e($item->name); ?>

                                                            </span>
                                                            <?php
                                                                $child_menus = \App\Models\Menu::orderBy('position', 'asc')->where('parent_id', $item->id)->get();
                                                            ?>

                                                            <div class="menu-options btn-group">
                                                                <a href="<?php echo e(route('menu.edit', $item->id)); ?>" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletionservice<?php echo e($item->id); ?>" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                                                                <!-- Modal -->
                                                                    <div class="modal fade text-left" id="deletionservice<?php echo e($item->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                                </div>
                                                                                <div class="modal-body text-center">
                                                                                    <form action="<?php echo e(route('menu.destroy', $item->id)); ?>" method="POST" style="display:inline-block;">
                                                                                        <?php echo csrf_field(); ?>
                                                                                        <?php echo method_field("POST"); ?>
                                                                                        <label for="reason">Are you sure you want to delete??</label><br>
                                                                                        <input type="hidden" name="_method" value="DELETE" />
                                                                                        <button type="submit" class="btn btn-danger" title="Delete">Confirm Delete</button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    ";
                                                                    </div>
                                                            </div>
                                                        </div>

                                                        <ol class="sortable">
                                                            <?php $__currentLoopData = $child_menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <li id="menuItem_<?php echo e($menu->id); ?>">
                                                                        <div class="menu-handle d-flex justify-content-between">
                                                                            <span>
                                                                                <?php echo e($menu->name); ?>

                                                                            </span>

                                                                            <div class="menu-options btn-group">
                                                                                <a href="<?php echo e(route('menu.edit', $menu->id)); ?>" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletionservice<?php echo e($menu->id); ?>" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                                                                                <!-- Modal -->
                                                                                    <div class="modal fade text-left" id="deletionservice<?php echo e($menu->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                        <div class="modal-dialog" role="document">
                                                                                            <div class="modal-content">
                                                                                                <div class="modal-header">
                                                                                                <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                    <span aria-hidden="true">&times;</span>
                                                                                                </button>
                                                                                                </div>
                                                                                                <div class="modal-body text-center">
                                                                                                    <form action="<?php echo e(route('menu.destroy', $menu->id)); ?>" method="POST" style="display:inline-block;">
                                                                                                        <?php echo csrf_field(); ?>
                                                                                                        <?php echo method_field("POST"); ?>
                                                                                                        <label for="reason">Are you sure you want to delete??</label><br>
                                                                                                        <input type="hidden" name="_method" value="DELETE" />
                                                                                                        <button type="submit" class="btn btn-danger" title="Delete">Confirm Delete</button>
                                                                                                    </form>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    ";
                                                                                    </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </ol>
                                                        
                                                        
                                                    </li>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <div class="form-group mt-4">
                                                <button type="button" class="btn btn-success btn-sm btn-flat" id="serializeone"><i
                                                        class="fa fa-save"></i>
                                                    Update Menu
                                                </button>
                                            </div>
                                        </ol>
                                    <?php else: ?>
                                        <p class="text-center">Menu Not Found in Database</p>
                                    <?php endif; ?>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
    <!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>

    <script>

        $('ol.sortable').nestedSortable({
            forcePlaceholderSize: true,
            placeholder: 'placeholder',
            handle: 'div.menu-handle',
            helper: 'clone',
            items: 'li',
            opacity: .6,
            maxLevels: 1,
            revert: 250,
            tabSize: 25,
            tolerance: 'pointer',
            toleranceElement: '> div',
        });

        $("#serialize").click(function(e) {
            e.preventDefault();
            $(this).prop("disabled", true);
            $(this).html(
                    `<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Updating...`
                );
            var serialized = $('ol.sortable').nestedSortable('serialize');
            // console.log(serialized);
            $.ajax({
                url: "<?php echo e(route('updateMenuOrder')); ?>",
                method: "POST",
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    sort: serialized
                },
                success: function(res) {
                    toastr.options.closeButton = true
                    toastr.success('Menu Order Successfuly', "Success !");
                    $('#serialize').prop("disabled", false);
                    $('#serialize').html(`<i class="fa fa-save"></i> Update Menu`);
                }
            });
        });

        $("#serializeone").click(function(e) {
            e.preventDefault();
            $(this).prop("disabled", true);
            $(this).html(
                    `<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Updating...`
                );
            var serializeoned = $('ol.sortable').nestedSortable('serializeone');
            // console.log(serializeoned);
            $.ajax({
                url: "<?php echo e(route('updateMenuOrder')); ?>",
                method: "POST",
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    sort: serializeoned
                },
                success: function(res) {
                    toastr.options.closeButton = true
                    toastr.success('Menu Order Successfuly', "Success !");
                    $('#serializeone').prop("disabled", false);
                    $('#serializeone').html(`<i class="fa fa-save"></i> Update Menu`);
                }
            });
        });

        function show_alert() {
            if (!confirm("Do you really want to do this?")) {
                return false;
            }
            this.form.submit();
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nextcinemas\resources\views/admin/menu/index.blade.php ENDPATH**/ ?>