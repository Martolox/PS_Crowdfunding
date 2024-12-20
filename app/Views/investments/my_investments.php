<?= $this->extend('layouts/default') ?>
<?= $this->section('page_title') ?>Inversiones<?= $this->endSection() ?>
<?= $this->section('css_js-init') ?>
	<link rel="stylesheet" href="<?= base_url('css/tables.css') ?>">
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="<?= base_url('js/modal_modificar.js') ?>"></script>
<?= $this->endSection() ?>

<!-- INDEX -->

<?= $this->section('content') ?>
<?= $this->include('messages/alert') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('messages/message') ?>
<?= $this->include('layouts/sidebar') ?>

<!-- Investments Title -->
<section id="proj-search">
	<h3>Inversiones</h3>
</section>

<!-- Investments Table -->
<section id="tbl-container">
<table id="proj-table">
	<thead>
		<tr>
			<th>Id</th>
			<th>Invertido</th>
			<th>Fecha inversión</th>
			<th>Proyecto</th>
			<th>Fecha finalización</th>
			<th>Estado</th>
			<th>Operaciones</th>
		</tr>
	</thead>
	<?php if (session()->getFlashdata('message') || session()->getFlashdata('error')): ?>
		<input type="hidden" id="alertMessage" value="<?= session()->getFlashdata('message') ?>">
		<input type="hidden" id="alertError" value="<?= session()->getFlashdata('error') ?>">
	<?php endif; ?>

	<?php foreach ($investments_proyects as $inv_pro): ?>
		<tr>
			<td><?= $inv_pro['id_investments'] ?></td>
			<td><?= $inv_pro['amount'] ?></td>
			<td><?= $inv_pro['investment_date'] ?></td>
			<td><?= $inv_pro['project_name'] ?></td>
			<td><?= $inv_pro['project_end_date'] ?></td>
			<td><?= $inv_pro['status'] ?></td>
			<td>
			<div class="button-group">
			<?php if ($inv_pro['status'] != 'finalized'): ?>
				<a href="<?= base_url('investments/eliminarInversion/' . $inv_pro['id_investments']) ?>">
					<button class="btn-action">Cancelar</button>
				</a>
			<?php endif;?>
				<button class="btn-action" onclick="openModal(<?= $inv_pro['id_investments'] ?>, <?= $inv_pro['amount'] ?>)">Modificar</button>
				<button class="btn-action" onclick="location.href='<?= base_url('investments/detail/' . $inv_pro['id_investments']) ?>'">Detalles</button>
			</div>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
</section>

<!-- Modal Update-->
<section id="modal" class="modal">
	<div class="modal-content">
		<span class="close-button" onclick="closeModal()">&times;</span>
		<h2>Cambiar monto</h2>
		<form action="http://localhost/crowdfunding/public/investments/update" method="post">
			<div class="form-group">
				<label for="id_inversion">Id inversión</label>
				<input type="number" id="id_inversion" name="id_inversion" placeholder="Enter id" required readonly>
			</div>
			<div class="form-group">
				<label for="monto_viejo">Invertido</label>
				<input type="number" id="monto_viejo" name="monto_viejo" placeholder="Enter amount" min="1" step="1" required readonly>
			</div>
			<div class="form-group">
				<label for="monto_nuevo">Nuevo monto</label>
				<input type="number" id="monto_nuevo" name="monto_nuevo" placeholder="Enter new amount" min="1" step="1" required>
			</div>
			<div class="form-group button-group">
				<button type="submit" value="data">Aceptar</button>
				<button type="button" onclick="closeModal()">Cancelar</button>
			</div>
		</form>
	</div>
</section>
<?= $this->include('layouts/footer') ?>
<?= $this->endSection() ?>