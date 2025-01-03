<div class="container-fluid" id="updateForm">


    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <?php echo e(Form::open(['url' => route('shows.setDatesData', $show->id), 'files' => true, 'class' => 'form form-horizontal', 'id' => 'timeSlotForm'])); ?>

                <?php echo method_field('post'); ?>
                <div class="card-header">
                    <h3 class="card-title">Set Shows Time</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 form-group mt-2">
                            <label for="shows_number">Select Show Date</label>
                            <input name='date_range' class="form-control" id='cal' required readonly
                                data-toggle="tooltip" data-placement="top" title="Select a date range" />
                            <span class="text-danger" hidden id="date_rangeError"></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <label for="shows_number">Total Shows</label>
                            <input name='shows_number' type="number" class="form-control" id='shows_number'
                                placeholder="Enter Total Shows For Per Day" oninput="setShowsCount(this)" required />
                            <span class="text-danger" hidden id="shows_numberError"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <label for="shows_number">Set Time</label>
                            <div id="timeZoneHtml">

                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" id="setShowsForm">
                            Set
                        </button>
                    </div>
                </div>
                <?php echo e(Form::close()); ?>

            </div>
        </div>
        <?php if($presentTheaterDates && count($presentTheaterDates) > 0): ?>
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Update Shows Time</h3>
                    </div>
                    <div class="card-body">
                        <h3>Dates/Time</h3>
                        <br>
                        <?php $__currentLoopData = $presentTheaterDates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="badge badge-danger"><?php echo e(@$date['date']); ?></span>
                            <a href="javascript:;" style="border-radius:50%" data-showDatesId="<?php echo e(@$date['id']); ?>"
                                class="btn btn-sm btn-danger btn-style icon btn-rounded delete-show-date">
                                <i class="fas fa-trash"></i>
                            </a>
                            <br>
                            <?php $__currentLoopData = @$date['timeSlot']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="badge badge-dark"><?php echo e(@$time['start_time']); ?></span>
                                <span class="badge badge-dark"><?php echo e(@$time['end_time']); ?></span>
                                <a href="javascript:;" style="border-radius:50%"
                                    class="btn btn-sm btn-danger btn-style icon btn-rounded ">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <br>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <br>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\nextcinemas\nextcinemas\resources\views/admin/shows/updateview.blade.php ENDPATH**/ ?>