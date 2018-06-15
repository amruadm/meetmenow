<?php $__env->startSection('title', '| Homepage'); ?>



<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">

        </div>
        <div id="googleMap" style="width:100%;height:400px;"></div>

        <div class="col-md-12">
            <div id="map" style="width: 600px; height: 400px"></div>
        </div>

        <div class="col-md-3">
            <p>Телефон: +7(423) 226-88-50</p>
            <h2>Расписание</h2>
            <em>ПРИЕМ ГРАЖДАН</em>
            <p>По рабочим дням:<br />
                С 10:00 до 17:00 <br />
                Обед с 13:00 до 14:00</p> <br />
            <u>Выходные:</u><br />
            <p>Суббота, Воскресенье</p><br />
            <?php if(Auth::check()): ?>
                <div>
                    <?php echo Form::open(['route' => 'calendars.store', 'method' => 'POST', 'hidden' => 'hidden']); ?>

                    <h2>New calendar</h2>

                    <?php echo e(Form::label('year', "Year:")); ?>orm::label('day', "Day:")
                    <?php echo e(Form::text('year', null, ['class' => 'form-control'])); ?>


                    <?php echo e(Form::label('month', "Month:")); ?>

                    <?php echo e(Form::text('month', null, ['class' => 'form-control'])); ?>


                    <?php echo e(Form::text('day', null, ['class' => 'form-control'])); ?>


                    <?php echo e(Form::label('busy', "Busy:")); ?>

                    <?php echo e(Form::text('busy', null, ['class' => 'form-control'])); ?>


                    <?php echo e(Form::submit('Create New calendar', ['class' => 'btn btn-primary btn-block btn-h1-spacing bad'])); ?>


                    <?php echo Form::close(); ?>



                    <form action="<?php echo e(url('/')); ?>" method="POST" hidden="hidden">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                            <label name="year2">year:</label>
                            <input id="year2" name="year2" class="form-control">
                        </div>

                        <div class="form-group">
                            <label name="month2">Тема:</label>
                            <input id="month2" name="month2" class="form-control">
                        </div>

                        <div class="form-group">
                            <label name="day2">Сообщение:</label>
                            <input  id="day2" name="day2" class="day2">
                        </div>

                        <div class="form-group">
                            <label name="busy2">Сообщение:</label>
                            <input  id="busy2" name="busy2" class="busy2">
                        </div>

                        <input type="submit" value="Send Message" class="nice">
                    </form>

                </div>

            <?php endif; ?>

        </div>
        <div class="col-md-5">
            <div class="jumbotron">
                <h3>Добро Пожаловать!</h3>

                <p class="lead">На сайте вы можете получить информацию об предоставляемых услугах</p>
                <!--  <p><a class="btn btn-primary btn-lg" href="#" role="button">Popular Post</a></p>-->
            </div>
        </div>
        <div class="col-md-3 col-md-offset-1">


        </div>
    </div> <!-- end of header .row -->

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


    </div>
    <button onclick="myFunction()">Try it</button>

    <script>
        function myFunction() {
            window.open("https://www.instagram.com/explore/tags/Зума/", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
        }
    </script>
    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript">
    </script>

    <script type="" src="<?php echo e(asset('js/yandexmap.js')); ?>">
    </script>
    <script src="<?php echo e(asset('js/googlemap.js')); ?>" >
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDeF9T6rl9y9rEVFcqRr3pU6CJEaRmqpQ&libraries=places"
            async defer></script>
    





<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>