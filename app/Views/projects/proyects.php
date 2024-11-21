<!DOCTYPE html>
<html>

<head>
    <title>Proyectos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/crowdfunding/public/css/crearInversion.css">
    <link rel="stylesheet" href="/crowdfunding/public/css/listProjets.css"> 
    <script src="/crowdfunding/public/js/modalCrearInversion.js"></script>
    <script src="/crowdfunding/public/js/modalDetallesProyecto.js"></script>
    <script src="/crowdfunding/public/js/alertasYMensajesProjets.js"></script>

<link rel="stylesheet" href="css/styles.css">
  <link rel="icon" type="image/ico" href="img/favicon.ico"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css" 
  integrity="sha256-mUZM63G8m73Mcidfrv5E+Y61y7a12O5mW4ezU3bxqW4=" 
  crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" 
  integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" 
  crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
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
        <li class="nav-item"><a href="<?= base_url() ?>" class="nav-link">IMPULSA</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>" role="button"><i class="fas fa-bars"></i></a></li>
            <li class="nav-item"><a href="#" class="nav-link">Proyectos</a></li>
            <li class="nav-item"><a href="<?= base_url('investments/list') ?>"class="nav-link">Inversiones</a></li>
            <li class="nav-item"><a href="<?= base_url('projects/myList') ?>"class="nav-link">Mis proyectos</a></li>
        </ul>
    </ul>
    <!-- Botones derechos -->
    <ul class="navbar-nav ml-auto">
        <!-- Usuario -->
        <li><h3 style="line-height: .6;"><?= session('userSessionName') ?></h3></li>
            <li><a style="padding-left: 5px" href="<?= base_url('logout') ?>">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="16" height="16" fill="var(--text1)" ><path d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z"/></svg>
        </a></li>
    </ul>
</nav>

</section>
        <div class="container">
                <h3 id="titulo">Proyectos para Invertir</h3>
                  <!-- Aquí se mostrarán los mensajes -->
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
            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Buscar proyectos...">
                <button onclick="
                if (document.getElementById('searchInput').value.trim() !== '') { window.location.href='<?= base_url('projects/filter/') ?>' + document.getElementById('searchInput').value; } 
                else { alert('Por favor, ingrese un término de búsqueda.'); }">
                    <i class="fas fa-search"></i>
                </button>
                <button class="reset-button" onclick="window.location.href='<?= base_url('projects/list') ?>'">
                    <i class="fas fa-redo-alt"></i>
                </button>
            </div>
        </div>

        <table id= "tablaProyectos" class="table table-striped table-bordered">
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
                <?php if(isset($projects)) foreach ($projects as $projectInv): ?>
                    <tr>
                        <td><?= $projectInv['id_projects'] ?></td>
                        <td><?= $projectInv['name'] ?></td>
                        <td><?= $projectInv['category'] ?></td>
                        <td><?= $projectInv['impact'] ?></td>
                        <td><?= $projectInv['status'] ?></td>
                        <td><?= $projectInv['budget'] ?></td>
                        <td><?= $projectInv['end_date'] ?></td>
                        <td>
                            <div class="button-group">
                                <button class="btn-action btn btn-primary btn-sm" onclick="openInvestmentModal(<?= $projectInv['id_projects'] ?>)"> <i class="fas fa-edit"></i> Invertir</button>
                                <button class="btn-action" onclick="location.href='<?= base_url('proyects/detail/' . $projectInv['id_projects']) ?>'">Detalles</button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal CREAR INVERSION -->
    <div id="modal" class="modal">
            <div class="modal-content">
                <span class="close-button" onclick="closeModal()">&times;</span>
                <h2>Realizar inversión</h2>
                <!-- Por ejemplo, usando ID 1 -->
                <input type="hidden" id="current_user_id" value="1"> <!-- Cuando esta la session correcta cambiar por: value="?<php echo session()->get('user_id'); ?>"-->
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
                        <input type="number" id="amount" name="amount" placeholder="Ingresar monto" required>
                    </div>
                    <div class="form-group button-group">
                        <button type="submit" value="data">Aceptar</button>
                        <button type="button" onclick="closeModal()">Cancelar</button>
                    </div>
                </form>
            </div>
    </div>
</body>