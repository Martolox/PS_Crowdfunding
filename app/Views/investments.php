<!DOCTYPE html>
<html>
<head>
  <title>Iinversiones</title>
  <script src="/crowdfunding/public/js/modal_modificar.js"></script>
  <link rel="stylesheet" href="/crowdfunding/public/css/modalInvesmentsUpdate.css">
  <link rel="stylesheet" href="/crowdfunding/public/css/listInvesments.css">
  <script src="/crowdfunding/public/js/alertasYMensajesInversiones.js."></script>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

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

<!-- NAVBAR -->
<section id="navbar">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Botones izquierdos -->
    <ul class="navbar-nav">
        <li class="nav-item"><a href="#" class="nav-link">IMPULSA</a></li>
        <li class="nav-item"><a class="nav-link" href="#" role="button"><i class="fas fa-bars"></i></a></li>
        <li class="nav-item"><a href="<?= base_url('/projects/list') ?>"class="nav-link">Proyectos</a></li>
        <li class="nav-item"><a href="#" class="nav-link">Inversiones</a></li>
        <li class="nav-item"><a href="<?= base_url('projects/myList') ?>"class="nav-link">Mis proyectos</a></li>
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
    </ul>
</nav>
</section>
 
  <div class="data-table-container">
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
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Invertido</th>
                    <th>Fecha inversión</th>
                    <th>Proyecto</th>
                    <th>Fecha finalización</th>
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
                        <td> 
                            <a href="<?= base_url('investments/eliminarInversion/' . $inv_pro['id_investments']) ?>">
                                <button class="btn-action">Cancelar</button>
                            </a>
                            <button class="btn-action" onclick="openModal(<?= $inv_pro['id_investments'] ?>, <?= $inv_pro['amount'] ?>)">Modificar</button>
                            <button class="btn-action">Detalles</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal UPDATE-->
    <div id="modal" class="modal">
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
                    <input type="number" id="monto_viejo" name="monto_viejo" placeholder="Enter amount" required readonly>
                </div>
                <div class="form-group">
                    <label for="monto_nuevo">Nuevo monto</label>
                    <input type="number" id="monto_nuevo" name="monto_nuevo" placeholder="Enter new amount" required>
                </div>
                <div class="form-group button-group">
                    <button type="submit" value="data">Aceptar</button>
                    <button type="button" onclick="closeModal()">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</body>