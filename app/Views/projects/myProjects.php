<?= $this->extend('layouts/default') ?>
<?= $this->section('page_title') ?>Mis Proyectos<?= $this->endSection() ?>
<?= $this->section('css_js-init') ?>
	<link rel="stylesheet" href="<?= base_url('css/tables.css') ?>">
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="<?= base_url('js/modalCrearProyecto.js') ?>"></script>
	<script src="<?= base_url('js/alertasYMensajesProjets.js') ?>"></script>
<?= $this->endSection() ?>

<!-- MY PROJECTS -->

<?= $this->section('content') ?>

<!-- Alerts -->
<?php if (session()->getFlashdata('message') || session()->getFlashdata('error')): ?>
	<input type="hidden" id="alertMessage" value="<?= session()->getFlashdata('message') ?>">
	<input type="hidden" id="alertError" value="<?= session()->getFlashdata('error') ?>">
<?php endif; ?>
<?= $this->include('layouts/navbar') ?>

<!-- Messages -->
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
<?= $this->include('layouts/sidebar') ?>

<!-- Projects Search -->
<section id="proj-search">
	<h3>Mis Proyectos</h3>
	<div class="search-container">
		<input type="text" id="searchInput" placeholder="Buscar proyectos...">
		<button onclick="
			if (document.getElementById('searchInput').value.trim() !== '') { window.location.href='<?= base_url('projects/filterMylist/') ?>' + document.getElementById('searchInput').value; } 
			else { alert('Por favor, ingrese un término de búsqueda.'); }">
				<i class="fa-solid fa-magnifying-glass"></i>
		</button>
		<button class="reset-button" onclick="window.location.href='<?= base_url('projects/myList') ?>'">
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
	<?php foreach ($projects as $project): ?>
		<tr>
			<td><?= $project['id_projects'] ?></td>
			<td><?= $project['name'] ?></td>
			<td><?= $project['category'] ?></td>
			<td><?= $project['impact'] ?></td>
			<td><?= $project['status'] ?></td>
			<td><?= $project['budget'] ?></td>
			<td><?= $project['end_date'] ?></td>
			<td><div class="button-group">			   
				<?php if ($project['status'] == 'EN PROCESO'): ?>
					
					<!-- Activar proyecto -->
					<a href="<?= base_url('ProjectsController/changeStatus/' . $project['id_projects'] . '/PUBLICADO') ?>" class="btn btn-warning btn-sm">
						<i class="fa-solid fa-toggle-on"></i>Publicar
					</a>			   
					
					<!-- Editar proyecto -->
					<button onclick="editProject(<?= $project['id_projects'] ?>)" class="btn btn-primary btn-sm">
						<i class="fa-solid fa-pen-to-square"></i>Editar
					</button>
				<?php elseif ($project['status'] == 'PUBLICADO'): ?>
					
					<!-- Cancelar proyecto -->
					<button  onclick="showCancelModal(<?= $project['id_projects']; ?>, '<?= addslashes($project['name']); ?>', '<?= base_url('projectsController/cancel_project/' . $project['id_projects']); ?>')" 
								class="btn btn-danger btn-sm">
						<i class="fa-solid fa-circle-xmark"></i>Cancelar
					</button>

					<!-- Editar proyecto -->	   
					<button onclick="editProject(<?= $project['id_projects'] ?>)" class="btn btn-primary btn-sm">
						<i class="fa-solid fa-pen-to-square"></i>Editar
					</button>

					 <!-- Finalizar si end_date <= hoy -->
					<?php if (strtotime($project['end_date']) <= strtotime(date('Y-m-d'))): ?>
						<a href="<?= base_url('projectsController/final_project/' . $project['id_projects'] ) ?>" class="btn btn-success btn-sm">
							<i class="fa-solid fa-circle-xmark"></i></svg>Finalizar
						</a>
					<?php endif; ?>
				<?php elseif ($project['status'] == 'CANCELADO'): ?>

				<!-- Proyecto cancelado - sin acciones adicionales -->
				<span class="badge badge-danger">
					<i class="fa-solid fa-ban"></i>Proyecto<br>Cancelado
					</span>
				<?php elseif ($project['status'] == 'FINALIZADO'): ?>

				<!-- Proyecto finalizado - sin acciones adicionales -->
				<span class="badge badge-success" style="background-color: #28a745; color: white; font-size: 1rem; padding: 10px; display: inline-flex; align-items: center;" >
					<i class="fa-solid fa-medal"></i></svg>Proyecto<br>Finalizado
				</span>
				<?php endif; ?>
			</div></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<button onclick="openProjectModal()" class="btn btn-primary create-project-btn" width="20" height="20" fill="var(--text1)">
	<i class="fa-solid fa-plus"></i>Crear Proyecto
</button>
</section>

<!-- Modal Create Project -->
<section id="projectModal" class="modal">
	<div class="modal-content">
		<span class="close">&times;</span>
		<h2 id="modalTitle">Proyecto</h2>
		<form action="<?= base_url('ProjectsController/save_project') ?>" method="post" enctype="multipart/form-data" id="formModalProject">
			<input type="hidden" name="project_id" id="project_id">
            <input type="hidden" name="status" id="status">
				
			<div class="form-group">
				<label for="name">Nombre</label>
				<input type="text" id="name" name="name" required>
			</div>

			<div class="form-group">
				<label for="category">Categoría</label>
				<select id="category" name="category">
					<option value="TECNOLOGIA">Tecnología</option>
					<option value="PETROLEO">Petróleo</option>
					<option value="INMOBILIARIO">Inmobiliario</option>
                    <option value="Negocios">Negocios</option>
                    <option value="Arte y Diseño">Arte y Diseño</option>
                    <option value="Bien Social">Bien Social</option>
                    <option value="Entretenimiento">Entretenimiento</option>
                    <option value="Cultura">Cultura</option>
                    <option value="sports">Sports</option>
					<option value="OTROS">Otros</option>
				</select>
			</div>

			<div class="form-group">
				<label for="impact">Impacto</label>
                <textarea id="impact" name="impact" rows="3"></textarea>
				
			</div>

			<div class="form-group">
				<label for="budget">Presupuesto</label>
				<input type="number" id="budget" name="budget" min="1" step="1" required>
			</div>

			<div class="form-group">
				<label for="end_date">Fecha de Fin</label>
				<input type="date" id="end_date" name="end_date" required>
			</div>

			<div class="form-group">
				<label for="reward_plan">Plan de Recompensas</label>
				<textarea id="reward_plan" name="reward_plan" rows="3"></textarea>
			</div>

			<div class="form-group">
				<label for="project_image">Imagen del Proyecto</label>
				<!-- Imagen previa del proyecto -->
				<img 
					id="projectImage" 
					src="" 
					alt="Imagen del proyecto" 
					class="w-64 h-64 object-cover rounded-lg mb-6" 
					hidden=true> <!-- Ocultar por defecto -->
				<!-- Input para subir nueva imagen -->
				<input type="file" id="project_image" name="project_image" accept="image/*">
			</div>

			<div class="form-actions">
				<button type="button" onclick="closeProjectModal()" class="btn btn-secondary">Cancelar</button>
				<button type="submit" class="btn btn-primary">Guardar</button>
			</div>
		</form>
	</div>
</section>

<!-- Modal Cancel Project -->
<div id="cancelModal" class="modal">
	<div class="modal-content">
		<h2>Confirmar Cancelación</h2>
		<p id="modal-text">¿Estás seguro de que deseas cancelar este proyecto?</p>
		<div class="button-group">
			<button id='confirmButton' onclick="confirmCancel()">Confirmar</button>
			<button onclick="closeModal()">Cancelar</button>
		</div>
	</div>
</div>

<form id="cancelForm"  method="POST" style="display:none;">
	<input type="hidden" name="id_project" id="cancelProjectId">
</form>
<?= $this->include('layouts/footer') ?>
<?= $this->endSection() ?>

<!-- SCRIPTS -->

<?= $this->section('js-init') ?>
<script>
function showCancelModal(id, name, url) {
	// Mostrar el modal
	document.getElementById('cancelModal').style.display = 'block';
	// Cambiar el texto del modal
	document.getElementById('modal-text').textContent = `¿Estás seguro de que deseas cancelar el proyecto "${name}"?`;
    // Asignar la acción del formulario con la URL correcta
	document.getElementById('cancelForm').action = url;
	// Guardar el ID del proyecto en un campo oculto
	document.getElementById('cancelProjectId').value = id;
}

function closeModal() {
	// Ocultar el modal
	document.getElementById('cancelModal').style.display = 'none';
}

function confirmCancel() {
	// Enviar el formulario para cancelar el proyecto
	document.getElementById('cancelForm').submit();
}

function editProject(projectId) {
	// Realizar una petición AJAX para obtener los datos del proyecto
	fetch(`<?= base_url('projectsController/getProject/') ?>${projectId}`)
		.then(response => response.json())
		.then(data => {
			// Cargar los datos al formulario del modal
		   // Mostrar el modal
		   openProjectModal();
			document.getElementById('modalTitle').innerText = 'Editar Proyecto';
			document.getElementById('project_id').value = data.id_projects;
			document.getElementById('name').value = data.name;
			document.getElementById('category').value = data.category;
			document.getElementById('impact').value = data.impact;
			document.getElementById('budget').value = data.budget;
			document.getElementById('status').value = data.status;
			document.getElementById('end_date').value = data.end_date;
			document.getElementById('reward_plan').value = data.reward_plan;
			// Configurar la imagen del proyecto
			const projectImageElement = document.getElementById('projectImage');
			if (data.img_name && data.img_name.trim() !== '') {
				projectImageElement.src = `<?= base_url('/') ?>${data.img_name}`;
				projectImageElement.hidden = false; // Mostrar la imagen
			} else {
				projectImageElement.hidden = true; // Ocultar si no hay imagen
			}	
		})
		.catch(error => console.error('Error al cargar los datos del proyecto:', error));
}
</script>
<?= $this->endSection() ?>