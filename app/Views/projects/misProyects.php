<!DOCTYPE html>
<html>

<head>
    <title>Proyectos</title>

    <link rel="stylesheet" href="/crowdfunding/public/css/crearProyecto.css">
    <script src="/crowdfunding/public/js/modalCrearProyecto.js"></script>
    <link rel="stylesheet" href="/crowdfunding/public/css/listProjets.css">
    <script src="/crowdfunding/public/js/alertasYMensajesProjets.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    
</head>

<body>
    <?php if (session()->getFlashdata('message') || session()->getFlashdata('error')): ?>
        <input type="hidden" id="alertMessage" value="<?= session()->getFlashdata('message') ?>">
        <input type="hidden" id="alertError" value="<?= session()->getFlashdata('error') ?>">
    <?php endif; ?>

    <!-- NAVBAR -->
    <section id="navbar">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <!-- Botones izquierdos -->
        <ul class="navbar-nav">
            <li class="nav-item"><a href="#" class="nav-link">IMPULSA</a></li>
                <li class="nav-item"><a class="nav-link" href="#" role="button"><i class="fas fa-bars"></i></a></li>
                <li class="nav-item"><a href="<?= base_url('/projects/list') ?>"class="nav-link">Proyectos</a></li>
                <li class="nav-item"><a href="<?= base_url('investments/list') ?>"class="nav-link">Inversiones</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Mis proyectos</a></li>
            </ul>
        </ul>
        <!-- Botones derechos -->
        <ul class="navbar-nav ml-auto">
            <form id="theme-switcher" class="form-inline">
                <div class="form-check form-check-inline">
                    <input checked type="radio" id="dark" name="theme" value="dark" class="form-check-input">
                    <label for="dark" class="form-check-label">Dark</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" id="light" name="theme" value="light" class="form-check-input">
                    <label for="light" class="form-check-label">Light</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" id="dim" name="theme" value="dim" class="form-check-input">
                    <label for="dim" class="form-check-label">Dim</label>
                </div>
            </form>
            <!-- Barra de búsqueda -->
            <li class="nav-item"><a class="nav-link" href="#" role="button"><i class="fas fa-search"></i></a></li>
        </ul>
    </nav>
    <div class="container">
        <h3 id="tituloMisProyectos">Mis Proyectos</h3>
        <div class="search-container">
                <input type="text" id="searchInput" placeholder="Buscar proyectos...">
                <button onclick="
                if (document.getElementById('searchInput').value.trim() !== '') { window.location.href='<?= base_url('projects/filterMylist/') ?>' + document.getElementById('searchInput').value; }
                else { alert('Por favor, ingrese un término de búsqueda.'); }">
                    <i class="fas fa-search"></i>
                </button>
                 <button class="reset-button" onclick="window.location.href='<?= base_url('projects/myList') ?>'">
                <i class="fas fa-redo-alt"></i>
                 </button>
        </div>

        <table class="table table-striped table-bordered">
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
                <?php foreach ($projects as $project): ?>
                    <tr>
                        <td><?= $project['id_projects'] ?></td>
                        <td><?= $project['name'] ?></td>
                        <td><?= $project['category'] ?></td>
                        <td><?= $project['impact'] ?></td>
                        <td><?= $project['status'] ?></td>
                        <td><?= $project['budget'] ?></td>
                        <td><?= $project['end_date'] ?></td>
                        <td>
                           
                        <?php if ($project['status'] == 'EN PROCESO'): ?>
                            <!-- Botón para activar el proyecto -->
                            <a href="<?= base_url('ProjectsController/changeStatus/' . $project['id_projects'] . '/PUBLICADO') ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-toggle-off"></i> Publicar
                            </a>
                       
                            <!-- Botón de edición -->
                            <a href="<?= base_url('projects/edit/' . $project['id_projects']) ?>" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                        <?php elseif ($project['status'] == 'PUBLICADO'): ?>
                            <!-- Botón para cancelar el proyecto -->
                            <button  onclick="showCancelModal(<?= $project['id_projects']; ?>, '<?= addslashes($project['name']); ?>', '<?= base_url('projectsController/cancel_project/' . $project['id_projects']); ?>')" 
                                class="btn btn-danger btn-sm">
                                <i class="fas fa-times-circle"></i> Cancelar
                            </button>
                           
                            <a href="<?= base_url('projects/edit/' . $project['id_projects']) ?>" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                             <!-- Botón para finalizar si end_date <= hoy -->
                            <?php if (strtotime($project['end_date']) <= strtotime(date('Y-m-d'))): ?>
                                <a href="<?= base_url('projectsController/final_project/' . $project['id_projects'] ) ?>" class="btn btn-success btn-sm">
                                    <i class="fas fa-check-circle"></i> Finalizar
                                </a>
                            <?php endif; ?>
                        <?php elseif ($project['status'] == 'CANCELADO'): ?>
                            <!-- Proyecto cancelado - sin acciones adicionales -->
                            <span class="badge badge-danger"> <i class="fas fa-ban"></i> Proyecto Cancelado</span>
                        <?php elseif ($project['status'] == 'FINALIZADO'): ?>
                            <!-- Proyecto finalizado - sin acciones adicionales -->
                            <span class="badge badge-success"> <i class="fas fa-check-circle"></i> Proyecto Finalizado</span>
                        <?php endif; ?>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button onclick="openProjectModal()" class="btn btn-primary create-project-btn">
            <i class="fas fa-plus"></i> Crear Proyecto
        </button>
    </div>

    <!-- Modal CREAR PROYECTO-->
    <div id="projectModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 id="modalTitle">Proyecto</h2>
            <form action="<?= base_url('ProjectsController/save_project') ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="project_id" id="project_id">
                
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
                        <option value="OTROS">Otros</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="impact">Impacto</label>
                    <select id="impact" name="impact">
                        <option value="ALTO">Alto</option>
                        <option value="MEDIO">Medio</option>
                        <option value="BAJO">Bajo</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="budget">Presupuesto</label>
                    <input type="number" id="budget" name="budget" required>
                </div>

                <div class="form-group">
                    <label for="status">Estado</label>
                    <select id="status" name="status">
                        <option value="EN PROCESO">En Proceso</option>
                        <option value="PUBLICADO">Publicado</option>
                    </select>
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
                    <input type="file" id="project_image" name="project_image" accept="image/*">
                </div>

                <div class="form-actions">
                    <button type="button" onclick="closeProjectModal()" class="btn btn-secondary">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div id="cancelModal" class="modal">
        <div class="modal-content">
            <h2>Confirmar Cancelación</h2>
            <p id="modal-text">¿Estás seguro de que deseas cancelar este proyecto?</p>
            <div class="modal-buttons">
                <button id='confirmButton' onclick="confirmCancel()">Confirmar</button>
                <button onclick="closeModal()">Cancelar</button>
            </div>
        </div>
    </div>

    <form id="cancelForm"  method="POST" style="display:none;">
        <input type="hidden" name="id_project" id="cancelProjectId">
    </form>
                                         



</body>

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
</script>


