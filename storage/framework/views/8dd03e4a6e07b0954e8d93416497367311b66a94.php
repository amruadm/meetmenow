<?php $__env->startSection('title', '| All Categories'); ?>

<?php $__env->startSection('content'); ?>

	<div class="row">
		<div class="col-md-8">
			<h1>Categories</h1>
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
					</tr>
				</thead>

				<tbody>
					<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<th><?php echo e($category->id); ?></th>
						<td><?php echo e($category->name); ?></td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>
		</div> <!-- end of .col-md-8 -->

		<div class="col-md-3">
			<div class="well">
				<?php echo Form::open(['route' => 'categories.store', 'method' => 'POST']); ?>

					<h2>New Category</h2>
					<?php echo e(Form::label('name', 'Name:')); ?>

					<?php echo e(Form::text('name', null, ['class' => 'form-control'])); ?>


					<?php echo e(Form::submit('Create New Category', ['class' => 'btn btn-primary btn-block btn-h1-spacing'])); ?>

				
				<?php echo Form::close(); ?>

			</div>
		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>