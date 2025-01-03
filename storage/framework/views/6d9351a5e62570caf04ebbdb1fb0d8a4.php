<?php $__env->startSection('title', 'Add Movie Theater'); ?>
<?php $__env->startSection('main'); ?>
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Add Movie Theater</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('admin.home')); ?></a></li>
                                <li class="breadcrumb-item active">
                                    Add Movie Theater
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <?php if(isset($movietheater)): ?>
                        <?php echo e(Form::open(['url' => route('movietheater.update', $movietheater->id), 'files' => true, 'class' => 'form form-horizontal'])); ?>

                        <?php echo method_field('patch'); ?>
                    <?php else: ?>
                        <?php echo e(Form::open(['url' => route('movietheater.store'), 'files' => true, 'class' => 'form form-horizontal'])); ?>

                        <?php echo method_field('post'); ?>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Movie Theater Details</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 form-group mt-2">
                                            <label for="theater_unique_id">Movie Theater Code:</label>
                                            <input type="text" name="theater_unique_id" id="theater_unique_id"
                                                class="form-control"
                                                value="<?php echo e(@$theater_unique_id ?? @$movietheater->theater_unique_id); ?>"
                                                required readonly>
                                            <?php $__errorArgs = ['theater_unique_id'];
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
                                                value="<?php echo e(old('title', @$movietheater->title)); ?>" required>
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
                                            <label for="screen_id">Screen Id</label>
                                            <input type="text" name="screen_id" id="screen_id" class="form-control"
                                                value="<?php echo e(old('screen_id', @$movietheater->screen_id)); ?>">
                                            <?php $__errorArgs = ['screen_id'];
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
                                            <label for="seat_capacity">Seat Capacity</label>
                                            <input type="text" name="seat_capacity" id="seat_capacity"
                                                class="form-control"
                                                value="<?php echo e(old('seat_capacity', @$movietheater->seat_capacity)); ?>">
                                            <?php $__errorArgs = ['seat_capacity'];
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
                                            <textarea name="summary" id="summary" class="form-control" cols="30" rows="10"><?php echo e(old('summary', @$movietheater->summary)); ?></textarea>
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
                                            <textarea name="description" id="description" class="form-control" cols="30" rows="10"><?php echo e(old('description', @$movietheater->description)); ?></textarea>
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
                                                    <option value="<?php echo e($cinema->id); ?>"
                                                        <?php echo e(@$movietheater->cinemas_id == $cinema->id ? 'selected' : ''); ?>>
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
                                                    value="<?php echo e(old('image', @$movietheater->image)); ?>">
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

                                            <?php if(isset($movietheater)): ?>
                                                <div class="col-md-4">
                                                    <img src="<?php echo e(asset(@$movietheater->image)); ?>" alt="Img"
                                                        class="img img-fluid img-thumbnail" style="width:100px; height:auto;">
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="col-md-6 form-group mt-2" hidden id="cinemasBranchHtml">

                                        </div>



                                        <div class="col-md-6 form-group mt-2">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <?php $__currentLoopData = $cinemas_status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($status->value); ?>"
                                                        <?php echo e(@$movietheater->status->value == $status->value ? 'selected' : ''); ?>>
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

                                        <div class="col-md-6 form-group mt-2" hidden id="cinemasBranchCitiesHtml">

                                        </div>


                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary" id="saveForm">
                                                <?php if(isset($movietheater)): ?>
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
        let cinemasBranchArrayData = <?php echo json_encode($cinemasBranchArrayData, 15, 512) ?>;
        let cinemasBranchData = <?php echo json_encode($cinemasBranches, 15, 512) ?>;
        let citiesData = <?php echo json_encode($cities, 15, 512) ?>;
        let citiesArrayData = <?php echo json_encode($cinemasBranchCityArrayData, 15, 512) ?>;
        $(document).on('change', '#cinemas_id', function() {
            $('#cinemasBranchCitiesHtml').html('');
            $('#cinemasBranchCitiesHtml').attr('hidden', true);
            let selectedCinemasId = $(this).val();
            let filterCinemasData = cinemasBranchArrayData[selectedCinemasId];
            let formCinemasBranchId = "<?php echo e(@$movietheater->cinemas_branch_id ?? null); ?>"
            if (!selectedCinemasId || !filterCinemasData) {
                $('#cinemasBranchHtml').html('');
                $('#cinemasBranchHtml').attr('hidden', true);
                toastr.error("SomeData Is Missing Plz Set All Data Before Create Movie Theater !!");
                $('#saveForm').attr('disabled', true);
                return false;
            }
            $('#saveForm').removeAttr('disabled');
            var cinemasBranchHtml = '';
            cinemasBranchHtml += '<label for="cinemas_branch_id">Cinemas Branch </label>';
            cinemasBranchHtml +=
                '<select name="cinemas_branch_id" id="cinemas_branch_id" class="form-control" required>';
            cinemasBranchHtml += '<option value="">-----Select Cinemas Branch-----</option>';
            $.each(cinemasBranchData, function(index, value) {
                if (filterCinemasData.includes(value.id)) {
                    cinemasBranchHtml +=
                        `<option value="${value.id}" ${formCinemasBranchId==(value.id) ? "selected":""}>${value.title}</option>`;
                }
            });
            cinemasBranchHtml += '</select>';
            cinemasBranchHtml += '<?php $__errorArgs = ['cinemas_branch_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>';
            cinemasBranchHtml += '<span class="text-danger"><?php echo e($message); ?></span>';
            cinemasBranchHtml += '<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>';
            $('#cinemasBranchHtml').html(cinemasBranchHtml);
            $('#cinemasBranchHtml').removeAttr('hidden');
        });

        $(document).on('change', '#cinemas_branch_id', function() {
            let selectedCinemasBranchId = $(this).val();
            let filterCinemasBranchCitiesData = citiesArrayData[selectedCinemasBranchId];
            let formCityId = "<?php echo e(@$movietheater->city_id ?? null); ?>"
            if (!selectedCinemasBranchId || !filterCinemasBranchCitiesData) {
                $('#cinemasBranchCitiesHtml').html('');
                $('#cinemasBranchCitiesHtml').attr('hidden', true);
                toastr.error("SomeData Is Missing Plz Set All Data Before Create Movie Theater !!");
                const saveFormButton = document.getElementById('saveForm');
                $('#saveForm').attr('disabled', true);
                return false;
            }
            $('#saveForm').removeAttr('disabled');
            var cinemasBranchCitiesHtml = '';
            cinemasBranchCitiesHtml += '<label for="city_id">City </label>';
            cinemasBranchCitiesHtml +=
                '<select name="city_id" id="city_id" class="form-control" required>';
            cinemasBranchCitiesHtml += '<option value="">-----Select City-----</option>';
            $.each(citiesData, function(index, value) {
                if (filterCinemasBranchCitiesData.includes(value.id)) {
                    cinemasBranchCitiesHtml +=
                        `<option value="${value.id}" ${formCityId==(value.id) ? "selected":""}>${value.title}</option>`;
                }
            });
            cinemasBranchCitiesHtml += '</select>';
            cinemasBranchCitiesHtml += '<?php $__errorArgs = ['city_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>';
            cinemasBranchCitiesHtml += '<span class="text-danger"><?php echo e($message); ?></span>';
            cinemasBranchCitiesHtml += '<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>';
            $('#cinemasBranchCitiesHtml').html(cinemasBranchCitiesHtml);
            $('#cinemasBranchCitiesHtml').removeAttr('hidden');
        });

        <?php if(isset($movietheater)): ?>
            $('#cinemas_id').change();
            $('#cinemas_branch_id').change();
        <?php endif; ?>
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nextcinemas\nextcinemas\resources\views/admin/movietheater/form.blade.php ENDPATH**/ ?>