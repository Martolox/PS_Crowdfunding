<!DOCTYPE html>
<html lang="es">
<head>
    <title>Impulsa : Sitio de Crowdfunding</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#222">
    <!-- Bootstrap CSS -->

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" type="image/ico" href="img/favicon.ico"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css" 
          integrity="sha256-mUZM63G8m73Mcidfrv5E+Y61y7a12O5mW4ezU3bxqW4=" 
          crossorigin="anonymous">


		  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
			<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

			<style>
			.modal-dialog {
				max-width: 600px;
				width: 100%;
			}

			.modal-content {
				padding: 15px;
			}

			.form-control {
				width: 100%;
			}
			</style>

    <script type="module" src="js/util.js"></script>
</head>
<body>

<!-- NAVBAR -->

<section id="navbar">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Botones izquierdos -->
    <ul class="navbar-nav">
        <li class="nav-item"><a href="#" class="nav-link">IMPULSA</a></li>
        <li class="nav-item"><a class="nav-link" href="#" role="button"><i class="fas fa-bars"></i></a></li>
        <li class="nav-item"><a href="#projectModal" class="nav-link" data-toggle="modal" data-target="#projectModal">Proyectos</a></li>
        <li class="nav-item"><a href="#" class="nav-link">Inversiones</a></li>
        <li class="nav-item"><a href="#" class="nav-link">Mis Proyectos</a></li>
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
</section>

<!-- BANNER -->

<section id="banner">
    <div class="inner">
        <h2>Bienvenidos a Impulsa!</h2>
        <p>Conectamos emprendedores visionarios con una comunidad global de inversores que buscan apoyar ideas</p>        
    </div>
</section>

<!-- HERO -->

<section id="hero" class="surface2">
    <h2>
        <i>"Con <strong>IMPULSA</strong> despegan proyectos con el potencial de transformar industrias"</i>
    </h2>
    <p>Ingresa para comenzar</p>
    <ul>
        <li>
            <a href="register">
                <button class="btn rad-shadow">Registrarme</button>
            </a>
        </li>
        <li>
            <a href="login">
                <button class="btn rad-shadow">Tengo cuenta</button>
            </a>  
        </li>
    </ul>
</section>

<!-- GALLERY -->

<main id="gallery">
    <section>
        <div class="container">
            <img class="rad-shadow" src="https://picsum.photos/350/200?random=1" alt="Imagen 1">
            <img class="rad-shadow" src="https://picsum.photos/350/200?random=2" alt="Imagen 2">
            <img class="rad-shadow" src="https://picsum.photos/350/200?random=3" alt="Imagen 3">
            <img class="rad-shadow" src="https://picsum.photos/350/200?random=4" alt="Imagen 4">
        </div>




    </section>

	
<div class="container">
    <h3>Mis Proyectos</h3>
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
                        <!-- Botón de edición -->
                        <a href="<?= base_url('projects/edit/' . $project['id_projects']) ?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        
                        <!-- Botón de cambio de estado -->
						<?php if ($project['status'] == 'CARGA'): ?>
							<!-- Botón para activar el proyecto -->
							<a href="<?= base_url('ProjectsController/changeStatus/' . $project['id_projects'] . '/ACTIVO') ?>" class="btn btn-warning btn-sm">
								<i class="fas fa-toggle-off"></i> Activar
							</a>
						<?php elseif ($project['status'] == 'ACTIVO'): ?>
							<!-- Botón para finalizar el proyecto -->
							<a href="<?= base_url('ProjectsController/changeStatus/' . $project['id_projects'] . '/FINALIZADO') ?>" class="btn btn-warning btn-sm">
								<i class="fas fa-toggle-off"></i> Finalizar
							</a>
							<!-- Botón para cancelar el proyecto -->
							<a href="<?= base_url('ProjectsController/changeStatus/' . $project['id_projects'] . '/CANCELADO') ?>" class="btn btn-danger btn-sm">
								<i class="fas fa-times-circle"></i> Cancelar
							</a>
						<?php elseif ($project['status'] == 'FINALIZADO'): ?>
							<!-- Proyecto finalizado - sin acciones adicionales -->
							<span class="badge badge-success">Finalizado</span>
						<?php elseif ($project['status'] == 'CANCELADO'): ?>
							<!-- Proyecto cancelado - sin acciones adicionales -->
							<span class="badge badge-danger">Cancelado</span>
						<?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="container">
    <h3>Proyectos para Invertir</h3>
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
            <?php foreach ($projectsInv as $projectInv): ?>
                <tr>
                    <td><?= $projectInv['id_projects'] ?></td>
                    <td><?= $projectInv['name'] ?></td>
					<td><?= $projectInv['category'] ?></td>
                    <td><?= $projectInv['impact'] ?></td>
                    <td><?= $projectInv['status'] ?></td>
					<td><?= $projectInv['budget'] ?></td>
					<td><?= $projectInv['end_date'] ?></td>
                    <td>
                        <!-- Botón de edición -->
                        <a href="<?= base_url('projects/invertir/' . $project['id_projects']) ?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Invertir
                        </a>
                        
                        
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

    <section>
        <div class="text">
            <h1 class="text1">
                <span class="swatch brand rad-shadow"></span>
                Interacción y Colaboración
            </h1>
            <br>
            <h1 class="text1">
                <span class="swatch text1 rad-shadow"></span>
                Análisis y Reportes
            </h1>
            <p class="text1">Paneles de control para que los emprendedores puedan monitorear el progreso de sus campañas y los inversores puedan seguir sus inversiones.</p>
            <h1 class="text2">
                <span class="swatch text2 rad-shadow"></span>
                Seguridad y Cumplimiento
            </h1>
            <p class="text2">Implementación de medidas de seguridad avanzadas para proteger los datos y las transacciones de los usuarios, cumpliendo con las normativas legales vigentes.</p>
        </div>
    </section>
</main>

<!-- FOOTER -->

<section id="footer" class="surface1">
    <p>Except as otherwise noted, the content of this page is licensed under the Creative Commons Attribution 4.0 License, and code samples are licensed under the Apache 2.0 License. For details, see the SCV Developers Site Policies. Impulsa es una marca registrada de UNRN y/o sus afiliados.<br><br>
    Last updated 2024-11-01 UTC.</p>
</section>

<div class="modal fade" id="projectModal" tabindex="-1" role="dialog" aria-labelledby="projectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="<?= base_url('ProjectsController/save_project') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="projectModalLabel">Proyecto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
				<div class="modal-body">
   					 <input type="hidden" name="project_id" value="<?= isset($projecto) ? $projecto->id_projects : '' ?>">
		
						<table class="table table-bordered">
							<tbody>
								<!-- Nombre -->
								<tr>
									<td><label for="name">Nombre</label></td>
									<td>
										<input type="text" class="form-control" id="name" name="name" required value="<?= isset($projecto) ? $projecto->name : '' ?>">
									</td>
								</tr>

								<!-- Categoría -->
								<tr>
									<td><label for="category">Categoría</label></td>
									<td>
										<select class="form-control" id="category" name="category">
											<option value="TECNOLOGIA" <?= isset($projecto) && $projecto->category == 'TECNOLOGIA' ? 'selected' : '' ?>>Tecnolog&iacute;a</option>
											<option value="PETROLEO" <?= isset($projecto) && $projecto->category == 'PETROLEO' ? 'selected' : '' ?>>Petr&oacute;leo</option>
											<option value="INMOBILIARIO" <?= isset($projecto) && $projecto->category == 'INMOBILIADIO' ? 'selected' : '' ?>>Inmobiliario</option>
											<option value="OTROS" <?= isset($projecto) && $projecto->category == 'OTROS' ? 'selected' : '' ?>>Otros</option>
										</select>

									</td>
								</tr>

								<!-- Impacto -->
								<tr>
									<td><label for="impact">Impacto</label></td>
									<td>
										<select class="form-control" id="impact" name="impact">
											<option value="ALTO" <?= isset($projecto) && $projecto->category == 'ALTO' ? 'selected' : '' ?>>Alto</option>
											<option value="MEDIO" <?= isset($projecto) && $projecto->category == 'MEDIO' ? 'selected' : '' ?>>Medio</option>
											<option value="BAJO" <?= isset($projecto) && $projecto->category == 'BAJO' ? 'selected' : '' ?>>Bajo</option>
											
										</select>
									</td>
								</tr>

								<!-- Presupuesto -->
								<tr>
									<td><label for="budget">Presupuesto</label></td>
									<td>
										<input type="number" class="form-control" id="budget" name="budget" required value="<?= isset($projecto) ? $projecto->budget : '' ?>">
									</td>
								</tr>

								<!-- Estado -->
								<tr>
									<td><label for="status">Estado</label></td>
									<td>
										<select class="form-control" id="status" name="status">
											<option value="CARGA" <?= isset($projecto) && $projecto->status == 'CARGA' ? 'selected' : '' ?>>Carga</option>
											<option value="ACTIVO" <?= isset($projecto) && $projecto->status == 'ACTIVO' ? 'selected' : '' ?>>Activo</option>
											<option value="CANCELADO" <?= isset($projecto) && $projecto->status == 'CANCELADO' ? 'selected' : '' ?>>Cancelado</option>
											<option value="FINALIZADO" <?= isset($projecto) && $projecto->status == 'FINALIZADO' ? 'selected' : '' ?>>Finalizado</option>
										</select>
									</td>
								</tr>

								<!-- Fecha de Fin -->
								<tr>
									<td><label for="end_date">Fecha de Fin</label></td>
									<td>
										<input type="date" class="form-control" id="end_date" name="end_date" required value="<?= isset($projecto) ? $projecto->end_date : '' ?>">
									</td>
								</tr>

								<!-- Plan de Recompensas -->
								<tr>
									<td><label for="reward_plan">Plan de Recompensas</label></td>
									<td>
										<textarea class="form-control" id="reward_plan" name="reward_plan" rows="3"><?= isset($projecto) ? $projecto->reward_plan : '' ?></textarea>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Scripts de Bootstrap y dependencias -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" 
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" 
        crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>


		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</body>
</html>
