<?php $__env->startSection('title', '| Create New Post'); ?>

<?php $__env->startSection('stylesheets'); ?>

    <?php echo Html::style('css/parsley.css'); ?>


    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'link code',
            menubar: false
        });
    </script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Create New Post</h1>
            <hr>
            <?php echo Form::open(array('route' => 'posts.store', 'data-parsley-validate' => '', 'files' => true)); ?>

            <?php echo e(Form::label('title', 'Title:')); ?>

            <?php echo e(Form::text('title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255'))); ?>


            <?php echo e(Form::label('slug', 'Slug:')); ?>

            <?php echo e(Form::text('slug', null, array('class' => 'form-control', 'required' => '', 'minlength' => '5', 'maxlength' => '255') )); ?>


            <?php echo e(Form::label('category_id', 'Category:')); ?>

            <select class="form-control" name="category_id">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value='<?php echo e($category->id); ?>'><?php echo e($category->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </select>


            <?php echo e(Form::label('tags', 'Tags:')); ?>

            <select class="form-control select2-multi" name="tags[]" multiple="multiple">
                <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value='<?php echo e($tag->id); ?>'><?php echo e($tag->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </select>

            <?php echo e(Form::label('featured_img', 'Upload a Featured Image')); ?>

            <?php echo e(Form::file('featured_img')); ?>


            <?php echo e(Form::label('body', "Post Body:")); ?>

            <?php echo e(Form::textarea('body', null, array('class' => 'form-control'))); ?>


            <?php echo e(Form::submit('Create Post', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px;'))); ?>

            <?php echo Form::close(); ?>

        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>

    <?php echo Html::script('js/parsley.min.js'); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>