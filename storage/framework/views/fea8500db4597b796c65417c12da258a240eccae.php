<?php $__env->startSection('title', '| View Post'); ?>
<link rel="stylesheet" href=<?php echo e(asset('css/chessboard-0.3.0.css')); ?> />

<?php $__env->startSection('content'); ?>

    <?php echo $data; ?>

    <div class="row">
        <div class="col-md-8">
            <h1 class="title"><?php echo e($post->title); ?></h1>
            <img id="view_image"></img>
            <div id="board" style="width: 400px"></div>
            <p>Status: <span id="status"></span></p>
            <p>FEN: <span id="fen"></span></p>
            <p>PGN: <span id="pgn"></span></p>
            <input type="button" id="startBtn" value="Start" />
            <input type="button" id="startPlay" value="Играть" />
            <input type="button" id="clearBtn" value="Clear" />
            <p class="lead"><?php echo $post->body; ?></p>

            <hr>

            <div class="tags">
                <?php $__currentLoopData = $post->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="label label-default"><?php echo e($tag->name); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div id="backend-comments" style="margin-top: 50px;">
                <h3>Comments <small><?php echo e($post->comments()->count()); ?> total</small></h3>

                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Comment</th>
                        <th width="70px"></th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php $__currentLoopData = $post->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($comment->name); ?></td>
                            <td><?php echo e($comment->email); ?></td>
                            <td><?php echo e($comment->comment); ?></td>
                            <td>
                                <a href="<?php echo e(route('comments.edit', $comment->id)); ?>" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="<?php echo e(route('comments.delete', $comment->id)); ?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-4">
            <div class="well">
                <dl class="dl-horizontal">
                    <label>Url:</label>
                    <p><a href="<?php echo e(route('blog.single', $post->slug)); ?>"><?php echo e(route('blog.single', $post->slug)); ?></a></p>
                </dl>

                <dl class="dl-horizontal">
                    <label>Category:</label>
                    <p><?php echo e($post->category->name); ?></p>
                </dl>

                <dl class="dl-horizontal">
                    <label>Created At:</label>
                    <p><?php echo e(date('M j, Y h:ia', strtotime($post->created_at))); ?></p>
                </dl>

                <dl class="dl-horizontal">
                    <label>Last Updated:</label>
                    <p><?php echo e(date('M j, Y h:ia', strtotime($post->updated_at))); ?></p>
                </dl>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <?php echo Html::linkRoute('posts.edit', 'Edit', array($post->id), array('class' => 'btn btn-primary btn-block')); ?>

                    </div>
                    <div class="col-sm-6">
                        <?php echo Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'DELETE']); ?>


                        <?php echo Form::submit('Delete', ['class' => 'btn btn-danger btn-block']); ?>


                        <?php echo Form::close(); ?>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <?php echo e(Html::linkRoute('posts.index', '<< See All Posts', array(), ['class' => 'btn btn-default btn-block btn-h1-spacing'])); ?>

                    </div>
                </div>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<script>
    console.log("dva");

    var data = "<?php echo $data; ?>";

    console.log(data);
</script>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('js/chessboard-0.3.0.js')); ?>"></script>
    <script src="<?php echo e(asset('js/chess.js')); ?>"></script>
    <script>
        //var image_path="<?php echo e(URL::asset('assets/upload_images/')); ?>/";
       // document.getElementById('view_image').src=image_path;


        var board = ChessBoard('board', {
            draggable: true,
            dropOffBoard: 'trash',
            sparePieces: true
        }, data);

        var ones = 1;
        $('#startPlay').on('click', function () {
           var
               game = new Chess(),
               statusEl = $('#status'),
               fenEl = $('#fen'),
               pgnEl = $('#pgn');

// do not pick up pieces if the game is over
// only pick up pieces for the side to move
           var onDragStart = function(source, piece, position, orientation) {
               if (game.game_over() === true ||
                   (game.turn() === 'w' && piece.search(/^b/) !== -1) ||
                   (game.turn() === 'b' && piece.search(/^w/) !== -1)) {
                   return false;
               }
           };

           var onDrop = function(source, target) {
               console.log("SOURCE" + source);
               console.log("TARGET" + target);
               // see if the move is legal
               var move = game.move({
                   from: source,
                   to: target,
                   promotion: 'q' // NOTE: always promote to a queen for example simplicity
               });

               // illegal move
               if (move === null) return 'snapback';

               updateStatus();
           };

// update the board position after the piece snap
// for castling, en passant, pawn promotion
           var onSnapEnd = function() {
               board.position(game.fen());
           };

           var updateStatus = function() {
               var status = '';

               var moveColor = 'White';
               if (game.turn() === 'b') {
                   moveColor = 'Black';
               }

               // checkmate?
               if (game.in_checkmate() === true) {
                   status = 'Game over, ' + moveColor + ' is in checkmate.';
               }

               // draw?
               else if (game.in_draw() === true) {
                   status = 'Game over, drawn position';
               }

               // game still on
               else {
                   status = moveColor + ' to move';

                   // check?
                   if (game.in_check() === true) {
                       status += ', ' + moveColor + ' is in check';
                   }
               }

               statusEl.html(status);
               fenEl.html(game.fen());
               pgnEl.html(game.pgn());
           };

           var cfg = {
               draggable: true,
               onDragStart: onDragStart,
               onDrop: onDrop
           };
           board = ChessBoard('board', cfg, data);

            console.log("ONE" + ones);
           if(ones == 1) {
               board.position({
                   g2: 'bK',
                   d4: 'wK',
                   a8: 'wR'
               });
               ones++;
           }

           updateStatus();
       });

        $('#startBtn').on('click', board.start);
        $('#clearBtn').on('click', board.clear);
        var one = 554;
        $('.title').text(one);
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>