<?php $__env->startSection('title', '| Yesss'); ?>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

<script>
    tinymce.init({
        selector: 'textarea',
        plugins: 'link code',
        menubar: false
    });
</script>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-8">
            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="post">
                    <h3><?php echo e($post->title); ?></h3>
                    <p><?php echo $post->body; ?></p>
                    <?php if(Auth::check()): ?>
                        <a href="<?php echo e(url('posts/'.$post->id)); ?>" class="btn btn-primary">Редактировать</a>
                    <?php endif; ?>
                </div>

                <hr>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="col-md-3 col-md-offset-1">
            <h2>Расписание</h2>
            <em>ПРИЕМ ГРАЖДАН</em>
            <p>По рабочим дням:<br />
                С 10:00 до 17:00 <br />
                Обед с 13:00 до 14:00</p> <br />
            <u>Выходные:</u><br />
            <p>Суббота, Воскресенье</p><br />
        </div>
    </div> <!-- end of header .row -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>