<!-- MESSAGE -->

<?php if (session()->has('success')): ?>
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		<?= session('success') ?>
		<button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
<?php endif; ?>

<?php if (session()->has('error')): ?>
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<?= session('error') ?>
		<button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
<?php endif; ?>  