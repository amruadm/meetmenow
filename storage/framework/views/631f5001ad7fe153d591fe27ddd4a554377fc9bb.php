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
            <h1>Добавить место</h1>
            <hr>
            <?php echo Form::open(array('route' => 'places.store', 'data-parsley-validate' => '')); ?>

            <?php echo e(Form::label('title', 'Название:')); ?>

            <?php echo e(Form::text('title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255'))); ?>


            <?php echo e(Form::label('whatsapp', 'WhatsApp:')); ?>

            <?php echo e(Form::text('whatsapp', null, array('class' => 'form-control', 'maxlength' => '255'))); ?>


            <?php echo e(Form::label('telegram', 'Telegram:')); ?>

            <?php echo e(Form::text('telegram', null, array('class' => 'form-control', 'maxlength' => '255'))); ?>


            <?php echo e(Form::label('description', "Описание:")); ?>

            <?php echo e(Form::textarea('description', null, array('class' => 'form-control'))); ?>


            <?php echo e(Form::submit('Create Post', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px;'))); ?>

            <?php echo Form::close(); ?>

        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>

    <?php echo Html::script('js/parsley.min.js'); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>