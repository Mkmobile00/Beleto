<div id="unBilledShipmentLoop">
    
    <div class="row">
        <div class="col-md-3">
            <select name="days" id="days"  class="form-control remainingdays">
                <option value="">Filter by Remaining Days</option>
                <?php $__currentLoopData = filterDays(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$dataValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($dataValue); ?>" <?php echo e(@$days==$dataValue ? 'selected':''); ?>><?php echo e($key); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <table class="table table-striped table-valign-middle table-sm captionShow">
        <caption><?php echo e(@$title); ?></caption>
        <thead>
            <tr>
                <th>SN</th>
                <th>Customer</th>
                
                <th>Subscription</th>
                <th>Total Days</th>
                <th>Left Days</th>
                
                <th>From/To</th>
                <th>Expired On</th>
            </tr>
        </thead>
        <div>
            <tbody>
                <?php $__currentLoopData = $allSubscription; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($key+1); ?></td>
                        <td>
                            <a href="<?php echo e(route('customer.show',$data['customer_id'])); ?>" target="_blank"><?php echo e($data['customer']); ?></a>
                        </td>
                        
                        
                        <td>
                            <a href="<?php echo e(route('subscription.index')); ?>" target="_blank"><?php echo e($data['subscription_id']); ?></a>
                        </td>

                       
                        <td>
                            <span class="badge badge-success"> <?php echo e($data['total_days']); ?></span>
                           
                        </td>
                        <td>
                            <span class="badge badge-<?php echo e((int)$data['left_days'] > 0 ?'success':'danger'); ?>"><?php echo e($data['left_days']); ?></span>
                            
                        </td>
                        
                        <td><?php echo e($data['from']); ?> / <?php echo e($data['to']); ?></td>
                        <td><?php echo e($data['to']); ?></td>
                        
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            <tfoot class="text-right mt-2">
                <tr>
                    <td colspan="9">
                        <ul class="pagination">
                            <?php $__currentLoopData = $allSubscription->links('pagination::bootstrap-4')->elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(is_string($element)): ?>
                                    <li class="page-item disabled"><span class="page-link"><?php echo e($element); ?></span></li>
                                <?php endif; ?>

                                <?php if(is_array($element)): ?>
                                    <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li
                                            class="page-item <?php echo e($page == $allSubscription->currentPage() ? 'active' : ''); ?>">
                                            <a class="page-link unbilled-link"
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


    </table>
</div>
<?php /**PATH C:\laragon\www\nextcinemas\resources\views/admin/dashboardcustomersubscriptiontable.blade.php ENDPATH**/ ?>