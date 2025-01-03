<?php $__env->startSection('title', 'Add Cinemas Branch'); ?>
<?php $__env->startSection('main'); ?>
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Add Cinemas Branch</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('admin.home')); ?></a></li>
                                <li class="breadcrumb-item active">
                                    Add Cinemas Branch
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <?php if(isset($cinemasbranch)): ?>
                        <?php echo e(Form::open(['url' => route('cinemasbranch.update', $cinemasbranch->id), 'files' => true, 'class' => 'form form-horizontal'])); ?>

                        <?php echo method_field('patch'); ?>
                    <?php else: ?>
                        <?php echo e(Form::open(['url' => route('cinemasbranch.store'), 'files' => true, 'class' => 'form form-horizontal'])); ?>

                        <?php echo method_field('post'); ?>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Cinemas Branch Details</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 form-group mt-2">
                                            <label for="branch_id">Cinemas Branch Code:</label>
                                            <input type="text" name="branch_id" id="branch_id"
                                                class="form-control"
                                                value="<?php echo e(@$branch_id ?? @$cinemasbranch->branch_id); ?>"
                                                required readonly>
                                            <?php $__errorArgs = ['branch_id'];
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
                                            <label for="title">Title</label>
                                            <input type="text" name="title" id="title" class="form-control"
                                                value="<?php echo e(old('title', @$cinemasbranch->title)); ?>" required>
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
                                            <label for="summary">Summary</label>
                                            <textarea name="summary" id="summary" class="form-control" cols="30" rows="10"><?php echo e(old('summary', @$cinemasbranch->summary)); ?></textarea>
                                            <?php $__errorArgs = ['summary'];
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
                                            <label for="description">Description</label>
                                            <textarea name="description" id="description" class="form-control" cols="30" rows="10"><?php echo e(old('description', @$cinemasbranch->description)); ?></textarea>
                                            <?php $__errorArgs = ['description'];
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
                                            <label for="cinemas_id">Cinemas </label>
                                            <select name="cinemas_id" id="cinemas_id" class="form-control" required>
                                                <option value="">------Select Cinema------</option>
                                                <?php $__currentLoopData = $cinemas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cinema): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($cinema->id); ?>" <?php echo e(@$cinemasbranch->cinemas_id == $cinema->id ? 'selected' : ''); ?>>
                                                        <?php echo e($cinema->title); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php $__errorArgs = ['cinemas_id'];
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
                                            <label for="image">Image</label>
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <a id="lfm" data-input="thumbnail1" data-preview="holder"
                                                        class="btn btn-primary">
                                                        <i class="fa fa-picture-o"></i> Choose
                                                    </a>
                                                </span>
                                                <input id="thumbnail1" class="form-control" type="text" name="image"
                                                    value="<?php echo e(old('image', @$cinemasbranch->image)); ?>">
                                            </div>
                                            <img id="holder" style="margin-top:15px;max-height:100px;">

                                            <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                            <?php if(isset($cinemasbranch)): ?>
                                                <div class="col-md-4">
                                                    <img src="<?php echo e(asset(@$cinemasbranch->image)); ?>" alt="Img"
                                                        class="img img-fluid img-thumbnail" style="width:100px; height:auto;">
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="col-md-6 form-group mt-2" hidden id="cinemasBranchCityHtml">

                                        </div>

                                        <div class="col-md-6 form-group mt-2">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <?php $__currentLoopData = $cinemas_status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($status->value); ?>"
                                                        <?php echo e(@$cinemasbranch->status->value == $status->value ? 'selected' : ''); ?>>
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
                                            <button type="submit" class="btn btn-primary" id="saveForm">
                                                <?php if(isset($cinemasbranch)): ?>
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
        var allCityData = <?php echo json_encode($citiesData, 15, 512) ?>;
        var cinemasCityArray=<?php echo json_encode($cinemasCityArray, 15, 512) ?>;

        $(document).on('change', '#cinemas_id', function() {
            let cinemaId = $(this).val();
            let checkArrayData=cinemasCityArray[cinemaId];
            let formSelectedData=[];
            <?php if(isset($cinemasbranch)): ?>
                 formSelectedData="<?php echo e(@$cinemasbranch->cities->pluck('city_id') ?? []); ?>";
            <?php endif; ?>
            console.log('Sumit Data',formSelectedData);
            if (!cinemaId || !checkArrayData) {
                $('#cinemasBranchCityHtml').html('');
                $('#cinemasBranchCityHtml').attr('hidden', true);
                toastr.error("SomeData Is Missing Plz Set All Data Before Create Cinemas Branch !!");
                $('#saveForm').attr('disabled',true);
                return false;
            }
            $('#saveForm').removeAttr('disabled');
            var cityHtml = '';
            cityHtml += '<label for="cities">City </label>';
            cityHtml += '<select name="cities[]" id="cities" class="form-control select2" required multiple>';
            $.each(allCityData, function(index, value) {
                if(checkArrayData.includes(value.id)){
                    cityHtml += `<option value="${value.id}" ${formSelectedData.includes(value.id) ? "selected":""}>${value.title}</option>`;
                }
            });
            cityHtml += '</select>';
            cityHtml += '<?php $__errorArgs = ['cities'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>';
            cityHtml += '<span class="text-danger"><?php echo e($message); ?></span>';
            cityHtml += '<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>';
            $('#cinemasBranchCityHtml').html(cityHtml);
            $('#cinemasBranchCityHtml').removeAttr('hidden');
            reloadSelect2();
        });

        <?php if(isset($cinemasbranch)): ?>
            $('#cinemas_id').change();
        <?php endif; ?>
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nextcinemas\nextcinemas\resources\views/admin/cinemasbranch/form.blade.php ENDPATH**/ ?>