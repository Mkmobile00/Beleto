
<?php $__env->startSection('main'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3><?php echo e(count(@$totalMovies)); ?></h3>

                                <p>Movies</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="<?php echo e(route('movie.index')); ?>" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3><?php echo e(count(@$totalTvSeries)); ?></h3>

                                <p>Tv Series</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="<?php echo e(route('tvseries.index')); ?>" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3><?php echo e(count(@$totalWebSeries)); ?></h3>

                                <p>Web Series</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="<?php echo e(route('webseries.index')); ?>" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3><?php echo e(count(@$totalCustomers)); ?></h3>

                                <p>Customers</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="<?php echo e(route('customer.list')); ?>" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title text-capitalize">Payment History</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <canvas id="latestChartDeliveredStatus"></canvas>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title text-capitalize">Customer Device</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <canvas id="latestChartCustomerDevice"></canvas>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>


                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title text-capitalize">Top 5 Must Watch Videos</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">

                                <table class="table table-striped table-valign-middle table-sm captionShow">
                                    <caption><?php echo e(@$title); ?></caption>
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Title</th>
                                            <th>Poster</th>
                                            <th>Type</th>
                                            <th>Views</th>
                                        </tr>
                                    </thead>
                                    <div>
                                        <tbody>
                                            <?php $__currentLoopData = $topFiveVideos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($key + 1); ?></td>
                                                    <td>
                                                        <a href="<?php echo e(@$data['path']); ?>"
                                                            target="_blank"><?php echo e(@$data['title']); ?></a>
                                                    </td>

                                                    <td>
                                                        <img src=" <?php echo e(@$data['poster']); ?>" height="100px"
                                                            alt="">
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-success"> <?php echo e($data['type']); ?></span>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-info"> <?php echo e($data['views']); ?></span>
                                                    </td>

                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </div>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title text-capitalize">Video Performance</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body" >
                                <div class="row">
                                    <div class="col-md-3">
                                        <select name="days" id="days" class="form-control movietype">
                                            <option value="">Select Type</option>
                                            <?php $__currentLoopData = $videoType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dataValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($dataValue->value); ?>" <?php echo e(@$type==$dataValue->value ? 'selected':''); ?>><?php echo e($dataValue->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div id="movieTypeData">
                                    Processing...
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>


                </div>
                <div class="card card-danger">
                    <div class="card-header border-0">
                        <h3 class="card-title">Customer Subscription</h3>


                    </div>

                    <div class="card-body">
                        <div class="row">



                            
                            <div class="col-12">
                                <div id="unBilledShipmentLoop">
                                    Processing...
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Main row -->
                

                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        loadUnBilledSectionData();

        function loadUnBilledSectionData(daysValue) {
            $.ajax({
                url: "<?php echo e(route('getCustomerSubscription')); ?>",
                type: "get",
                data: {
                    checkValue: 2,
                    daysValue: daysValue
                },
                success: function(response) {
                    $('#unBilledShipmentLoop').replaceWith(response);
                    paginateUnBilledData();
                    // filterSubscriptionDaya();
                }
            });
        }
        fetchVideoTypeData();
        function fetchVideoTypeData() {
            $.ajax({
                url: "<?php echo e(route('getMovieType')); ?>",
                type: "get",
                data: {
                    type: 10
                },
                success: function(response) {
                    $('#movieTypeData').replaceWith(response);
                    movieTypePaginate();
                }
            });
        }

        function paginateUnBilledData() {
            $('.unbilled-link').click(function(event) {
                event.preventDefault();
                var url = $(this).attr('href');
                $.ajax({
                    url: url,
                    type: "get",
                    data: {

                    },
                    success: function(response) {
                        $("#unBilledShipmentLoop").replaceWith(response);
                        paginateUnBilledData();
                    }
                });
            })
        }
        function movieTypePaginate() {
            $('.movie-type').click(function(event) {
                event.preventDefault();
                var url = $(this).attr('href');
                $.ajax({
                    url: url,
                    type: "get",
                    data: {

                    },
                    success: function(response) {
                        $("#movieTypeData").replaceWith(response);
                        movieTypePaginate();

                    }
                });
            })
        }



        $(document).on('change', '.remainingdays', function() {
            let daysValue = $(this).val();
            loadUnBilledSectionData(daysValue);
        });

        function getMovieType(type) {
            $.ajax({
                url: "<?php echo e(route('getMovieType')); ?>",
                type: "get",
                data: {
                    type: type
                },
                success: function(response) {
                    $('#movieTypeData').replaceWith(response);
                    movieTypePaginate();
                    // filterSubscriptionDaya();
                }
            });
        }

        $(document).on('change', '.movietype', function() {
            let typeValue = $(this).val();
            getMovieType(typeValue);
        });



        let statusLabelsDelivered = <?php echo json_encode(@$paymentOptions, 15, 512) ?>;
        let shipmentStatusDataDelivered = <?php echo e(json_encode(@$paymentHistory)); ?>;
        const latests = document.getElementById('latestChartDeliveredStatus').getContext('2d');
        const latestCharts = new Chart(latests, {
            type: 'pie',
            data: {
                labels: statusLabelsDelivered,
                datasets: [{
                    label: ['Shipment Status'],
                    data: shipmentStatusDataDelivered,
                    backgroundColor: <?php echo json_encode(@$colors, 15, 512) ?>,
                    borderColor: <?php echo json_encode(@$colors, 15, 512) ?>,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },

            }
        });

        let customerDevice = <?php echo json_encode(@$loginDevice, 15, 512) ?>;
        let customerDeviceData = <?php echo e(json_encode(@$loginDeviceData)); ?>;
        const latests1 = document.getElementById('latestChartCustomerDevice').getContext('2d');
        const latestCharts1 = new Chart(latests1, {
            type: 'pie',
            data: {
                labels: customerDevice,
                datasets: [{
                    label: ['Shipment Status'],
                    data: customerDeviceData,
                    backgroundColor: <?php echo json_encode(@$colors, 15, 512) ?>,
                    borderColor: <?php echo json_encode(@$colors, 15, 512) ?>,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },

            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nextcinemas\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>