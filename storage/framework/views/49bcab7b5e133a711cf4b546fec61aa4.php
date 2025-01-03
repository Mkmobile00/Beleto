
<?php $__env->startSection('title', 'Post Category Management'); ?>
<?php $__env->startSection('main'); ?>
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Post Category Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('admin.home')); ?></a></li>
                            <li class="breadcrumb-item active">
                                Post Category Management
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <?php if(isset($post)): ?>
                <?php echo e(Form::open(['url' => route('post.update', $post->id), 'files' => true, 'class' => 'form form-horizontal'])); ?>

                <?php echo method_field('patch'); ?>
                <?php else: ?>
                <?php echo e(Form::open(['url' => route('post.store'), 'files' => true, 'class' => 'form form-horizontal'])); ?>

                <?php echo method_field('post'); ?>
                <?php endif; ?>
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Theme Options</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 form-group mt-2">
                                        <label for="title">Post Title</label>
                                        <input type="text" name="title" id="title" class="form-control" value="<?php echo e(old('title',@$post->title)); ?>" required>
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
                                        <label for="content">Content</label>
                                        <textarea name="content" id="content" class="form-control" cols="30" rows="10" required>
                                            <?php echo e(old('content',@$post->content)); ?>

                                        </textarea>
                                        <?php $__errorArgs = ['content'];
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

                                   
                                    <?php if(isset($post)): ?>
                                        <?php if($post->is_file=='1'): ?>
                                            <div class="col-md-12" id="imageFile">
                                                <label for="image" class="form-label">Icon Image:</label>
                                                <div class="input-group">
                                                    <span class="input-group-btn">
                                                        <a id="lfm1111" data-input="thumbnail11" data-preview="holder"
                                                            class="btn btn-primary">
                                                            <i class="fa fa-picture-o"></i> Choose
                                                        </a>
                                                    </span>
                                                    <input id="thumbnail11" class="form-control" type="text" name="thumbnail" required
                                                        value="<?php echo e(old('thumbnail', @$post->thumbnail)); ?>">
                                                </div>
                                                <img id="holder" style="margin-top:15px;max-height:100px;" src="<?php echo e(@$post->thumbnail); ?>">
                                            </div>

                                        <?php else: ?>
                                            <div class="col-md-12" id="imageFile">
                                                <label for="image" class="form-label">Link:</label>
                                                <div class="input-group">
                                                    <input id="thumbnail11" class="form-control" type="text" name="thumbnail" required
                                                        value="<?php echo e(old('thumbnail', @$post->thumbnail)); ?>">
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php else: ?>
                                    <div class="col-md-12" id="imageFile">
                                        <label for="image" class="form-label">Icon Image:</label>
                                        <div class="input-group">


                                            <span class="input-group-btn">
                                                <a id="lfm1111" data-input="thumbnail11" data-preview="holder"
                                                    class="btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> Choose
                                                </a>
                                            </span>
                                            <input id="thumbnail11" class="form-control" type="text" name="thumbnail" required
                                                value="<?php echo e(old('thumbnail', @$data->thumbnail)); ?>">
                                        </div>
                                        <img id="holder" style="margin-top:15px;max-height:100px;">
                                    </div>
                                   
                                    <?php endif; ?>
                                    <?php $__errorArgs = ['thumbnail'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <p class="btn btn-white" id="thumb_link" href="#"><span class="btn-label"><i class="fa fa-link"></i></span> Link</p>
                                    <p class="btn btn-white" id="thumb_file" href="#"><span class="btn-label"><i class="fa fa-file"></i></span> File</p>

                                    <input type="text" name="is_file" value="1" hidden id="file_type">
                                    <div class="col-md-12 form-group mt-2">
                                        <label for="title">Category</label>
                                        <?php $__currentLoopData = $postCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <br>
                                            <input type="checkbox" name="post_cat[]" value="<?php echo e($cat->id); ?>" <?php if(isset($post)): ?>
                                            <?php echo e(in_array($cat->id,$post->postCategory->pluck('id')->toArray()) ? 'checked':''); ?>

                                            <?php endif; ?>> <?php echo e($cat->name); ?> 
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                        <label for="title">Published</label>
                                        <select name="status" id="status" class="form-control" required>
                                            <?php $__currentLoopData = $postStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                               <option value="<?php echo e($status->value); ?>"><?php echo e($status->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
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

                                    <h3 class="text-center">SEO Configuration Management</h3>
                                    <hr>
                                    <div class="col-md-12 form-group mt-2">
                                        <label for="meta_title">SEO meta_title</label>
                                        <input type="text" name="meta_title" id="meta_title" class="form-control" value="<?php echo e(old('meta_title',@$post->meta_title)); ?>" required>
                                        <?php $__errorArgs = ['meta_title'];
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
                                        <label for="meta_keyword">Focus Keyword</label>
                                        <input type="text" name="meta_keyword" id="meta_keyword" class="form-control" value="<?php echo e(old('meta_keyword',@$post->meta_keyword)); ?>" required>
                                        <?php $__errorArgs = ['meta_keyword'];
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
                                        <label for="meta_description">Meta Description</label>
                                        <textarea name="meta_description" id="meta_description" class="form-control" cols="30" rows="10">
                                            <?php echo e(old('meta_description',@$post->meta_description)); ?>

                                        </textarea>
                                        <?php $__errorArgs = ['meta_description'];
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
                                            class="btn btn-primary">
                                            <?php if(isset($post)): ?>
                                                Update
                                            <?php else: ?>
                                                Add
                                            <?php endif; ?>
                                        </button>
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

const replaceImageData = () => {
    let html = '';
    html += '<div class="col-md-12" id="imageFile">';
    html += '<label for="image" class="form-label">Icon Image:</label>';
    html += '<div class="input-group">';
    html += '<span class="input-group-btn">';
    html += '<a id="lfm1111" data-input="thumbnail11" data-preview="holder" class="btn btn-primary"><i class="fa fa-picture-o"></i> Choose</a>';
    html += '</span>';
    html += '<input id="thumbnail11" required class="form-control" type="text" name="thumbnail" value="<?php echo e(old("thumbnail", @$data->thumbnail)); ?>">';
    html += '</div>';
    html += '</div>';
    return html;
};
const replaceFileData = () => {
    let file= '';
    file+= '<div class="col-md-12" id="imageFile">';
    file+= '<label for="image" class="form-label">Link:</label>';
    file+= '<div class="input-group">';
    file+= '<input id="thumbnail11" required class="form-control" type="url" name="thumbnail" value="<?php echo e(old("thumbnail", @$data->thumbnail)); ?>">';
    file+= '</div>';
    file+= '</div>';
    return file;
};

$(document).ready(function () {
    CKEDITOR.replace('content');
    CKEDITOR.replace('meta_description');
    $('#lfm1111').filemanager('image');

    $(document).on('click', '#thumb_link', function () {
        $('#imageFile').replaceWith(replaceFileData('link'));
        $('#file_type').val('0');
    });

    $(document).on('click', '#thumb_file', function () {
        $('#imageFile').replaceWith(replaceImageData('image'));
        $('#file_type').val('1');
        $('#lfm1111').filemanager('image');

    });
});


</script>
    
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nextcinemas\resources\views/admin/post/form.blade.php ENDPATH**/ ?>