
    <div id="movieTypeData">
        <table class="table table-striped table-valign-middle table-sm captionShow">
            <caption><?php echo e(@$title); ?></caption>
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Title</th>
                    <th>Poster</th>
                    <th>Type</th>
                    <th>View</th>
                </tr>
            </thead>
            <div>
                <tbody>
                    <?php $__currentLoopData = $allMoviesData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($key + 1); ?></td>
                            <td>
                                <a href="<?php echo e($data['path']); ?>"
                                    target="_blank"><?php echo e(@$data['title']); ?></a>
                            </td>
                            <td>
                                <img src=" <?php echo e(@$data['poster']); ?>" height="100px" alt="">
                            </td>
                            <td>
                                <span class="badge badge-success"> <?php echo e($data['type']); ?></span>
                            </td>
                            <td>
                                <a href="<?php echo e(route('getVideoPerformance',[$data['id'],$data['type']])); ?>" target="_blank">View</a>
                            </td>

                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>

            </div>
        </table>
        <tfoot class="text-right mt-2">
            <tr>
                <td colspan="9">
                    <ul class="pagination">
                        <?php $__currentLoopData = $allMoviesData->links('pagination::bootstrap-4')->elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(is_string($element)): ?>
                                <li class="page-item disabled"><span class="page-link"><?php echo e($element); ?></span></li>
                            <?php endif; ?>

                            <?php if(is_array($element)): ?>
                                <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li
                                        class="page-item <?php echo e($page == $allMoviesData->currentPage() ? 'active' : ''); ?>">
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
<?php /**PATH C:\xampp\htdocs\nextcinemas\nextcinemas\resources\views/admin/getmoviedata.blade.php ENDPATH**/ ?>