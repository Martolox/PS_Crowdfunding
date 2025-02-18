<?= $this->extend('layouts/default') ?>
<?= $this->section('page_title') ?>Proyectos<?= $this->endSection() ?>
<?= $this->section('css_js-init') ?>
	<link rel="stylesheet" href="<?= base_url('css/tables.css') ?>">
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="<?= base_url('js/modalCrearInversion.js') ?>"></script>
	<script src="<?= base_url('js/modalDetallesProyecto.js') ?>"></script>
	<script src="<?= base_url('js/alertasYMensajesProjets.js') ?>"></script>
<?= $this->endSection() ?>

<!-- PROJECTS -->
<?= $this->section('content') ?>
<?= $this->include('messages/alert') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar') ?>

<!-- Projects Search -->
<section id="proj-search">
	<h3>Proyectos para Invertir</h3>
	<div class="search-container">
		<input type="text" id="searchInput" placeholder="Buscar proyectos...">
		<button onclick="
			if (document.getElementById('searchInput').value.trim() !== '') { window.location.href='<?= base_url('projects/filter/') ?>' + document.getElementById('searchInput').value; } 
			else { alert('Por favor, ingrese un término de búsqueda.'); }">
				<i class="fa-solid fa-magnifying-glass"></i>
		</button>
		<button class="reset-button" onclick="window.location.href='<?= base_url('projects/list') ?>'">
			<i class="fa-solid fa-arrow-rotate-right"></i>
		</button>
	</div>
</section>

<!-- Projects Table -->
<section id="tbl-container">
<table id="proj-table">
	<thead>
		<tr>
			<th>ID</th>
			<th>Nombre</th>
			<th>Categoria</th>
			<th>Impacto</th>
			<th>Estado</th>
			<th>Fondo</th>
			<th>Fecha Cierre</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
	<?php if(isset($projects)) foreach ($projects as $p): ?>
		<tr>
			<td><?= $p['id_projects'] ?></td>
			<td><?= $p['name'] ?></td>
			<td><?= $p['category'] ?></td>
			<td><?= $p['impact'] ?></td>
			<td><?= $p['status'] ?></td>
			<td><?= $p['budget'] ?></td>
			<td><?= $p['end_date'] ?></td>
			<td>
			<div class="button-group">
				<button class="btn-action" onclick="openInvestmentModal(<?= session('userSessionID')?>, <?=$p['id_projects'] ?>)">
				<i class="fa-solid fa-pen-to-square"></i>
				Invertir
				</button>
				<button class="btn-action" onclick="location.href='<?= base_url('projects/detail/' . $p['id_projects']) ?>'">Detalles</button>
			</div>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
</section>

<!-- Modal Create Inversion -->
<section id="modal" class="modal">
	<div class="modal-content">
		<span class="close-button" onclick="closeModal()">&times;</span>
		<h2>Realizar inversión</h2>
		<input type="hidden" id="current_user_id" value="<?= session('userSessionID') ?>">
		<form action="<?= base_url()?>investments/create" method="post">
			<div class="form-group">
				<label for="id_username">Id usuario:</label>
				<input type="text" id="id_username" name="id_username" required readonly>
			</div>
			<div class="form-group">
				<label for="id_project">Id proyecto:</label>
				<input type="text" id="id_project" name="id_project" required readonly>
			</div>
			<div class="form-group">
				<label for="amount">Monto:</label>
				<input type="number" id="amount" name="amount" placeholder="Ingresar monto" min="1" step="1" required>
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