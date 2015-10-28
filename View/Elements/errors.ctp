<!-- hiển thị thông báo lỗi -->
	<?php if (isset($errors)): ?>
	<div class="alert alert-danger">
		<?php foreach ($errors as $error): ?>
			<?php echo $error[0]; ?> <br>
		<?php endforeach ?>
	</div>
	<?php endif ?>