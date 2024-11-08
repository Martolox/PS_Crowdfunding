<!DOCTYPE html>
<html>
<head>
  <title>Investment Form</title>
  <script src="/crowdfunding/public/js/modal_modificar.js"></script>
  <!-- CREATE -->
  <!--<style>
   .form-container {
  max-width: 400px;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.form-group {
  margin-bottom: 15px;
}

.form-group label {
  display: block;
  margin-bottom: 5px;
}

.form-group input {
  width: 100%;
  padding: 8px;
  box-sizing: border-box;
}

.button-group {
  display: flex;
  justify-content: space-between;
}

.button-group button {
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.button-group button[type="submit"] {
  background-color: #4CAF50;
  color: white;
}

.button-group button[type="button"] {
  background-color: #f44336;
  color: white;
}

  </style> -->
  <style>
	/* Estilos generales */
	body {
		font-family: Arial, sans-serif;
		margin: 0;
		padding: 0;
	}

	/* Estilos para la tabla */
	.data-table-container {
		max-width: 80%;
		margin: 20px auto;
	}

	table {
		width: 100%;
		border-collapse: collapse;
	}

	th, td {
		padding: 10px;
		text-align: left;
		border-bottom: 1px solid #ddd;
	}

	th {
		background-color: #f2f2f2;
	}

	/* Estilos para los botones */
	.btn-action {
		background-color: #4CAF50;
		color: white;
		padding: 5px 10px;
		border: none;
		border-radius: 4px;
		cursor: pointer;
		margin-right: 5px;
	}

	.btn-action:hover {
		background-color: #45a049;
	}

	/* Estilos para el modal */
	.modal {
		display: none;
		position: fixed;
		z-index: 1;
		left: 0;
		top: 0;
		width: 100%;
		height: 100%;
		overflow: auto;
		background-color: rgba(0, 0, 0, 0.4);
	}

	.modal-content {
		background-color: #fefefe;
		margin: 15% auto;
		padding: 20px;
		border: 1px solid #888;
		width: 30%;
	}

	.close-button {
		color: #aaa;
		float: right;
		font-size: 28px;
		font-weight: bold;
	}

	.close-button:hover,
	.close-button:focus {
		color: black;
		text-decoration: none;
		cursor: pointer;
	}

	.form-group {
		margin-bottom: 15px;
	}

	.form-group label {
		display: block;
		margin-bottom: 5px;
	}

	.form-group input {
		width: 100%;
		padding: 8px;
		box-sizing: border-box;
	}

	.button-group {
		display: flex;
		justify-content: space-between;
	}

	.button-group button {
		padding: 10px 20px;
		border: none;
		border-radius: 5px;
		cursor: pointer;
	}

	.button-group button[type="submit"] {
		background-color: #4CAF50;
		color: white;
	}

	.button-group button[type="button"] {
		background-color: #f44336;
		color: white;
	}
	</style>

	<style> 
	/* Estilos generales */
	body {
		font-family: Arial, sans-serif;
		margin: 0;
		padding: 0;
	}

/* Estilos para la tabla */
.data-table-container {
    max-width: 80%; /* Ajusta este valor para reducir el ancho de la tabla */
    margin: 20px auto; /* Centra la tabla horizontalmente y deja margen superior e inferior */
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #f2f2f2;
}

/* Estilos para los botones */
.btn-action {
    background-color: #4CAF50;
    color: white;
    padding: 5px 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-right: 5px;
}

.btn-action:hover {
    background-color: #45a049;
}</style> 

</head>

<body>

  <!-- Aquí va el menú superior -->

  <div class="data-table-container">
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
            <tbody>
                <?php foreach ($investments_proyects as $inv_pro) { ?>
                <tr>
                    <td><?= $inv_pro['id_investments'] ?></td>
                    <td><?= $inv_pro['amount'] ?></td>
                    <td><?= $inv_pro['investment_date'] ?></td>
                    <td><?= $inv_pro['project_name'] ?></td>
                    <td><?= $inv_pro['project_end_date'] ?></td>
                    <td>
                        <button class="btn-action">Eliminar</button>
                        <button class="btn-action" onclick="openModal(<?= $inv_pro['id_investments'] ?>, <?= $inv_pro['amount'] ?>)">Modificar</button>
                        <button class="btn-action">Detalles</button>
                      </td>
                </tr>
                <?php } ?>
                <!-- Agrega más filas aquí -->
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

<!-- CREATE --><!--
<div class="form-container">
  <h2>Realizar inversión</h2>
  <form action="http://localhost/crowdfunding/public/investments/create" method="post">
    <div class="form-group">
      <label for="id_username">Id usuario:</label>
      <input type="text" id="id_username" name="id_username" required>
    </div>
    <div class="form-group">
      <label for="id_project">Id proyecto:</label>
      <input type="text" id="id_project" name="id_project" required>
    </div>
	<div class="form-group">
      <label for="amount">Monto:</label>
      <input type="number" id="amount" name="amount" placeholder="Ingresar monto" required>
    </div>
    <div class="form-group button-group">
      <button type="submit" value="data">Aceptar</button>
      <button type="button" onclick="window.close()">Cancelar</button>
    </div>
  </form>
</div>

  </div> -->

	
</body>