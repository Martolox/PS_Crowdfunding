ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
<!DOCTYPE html>
<html>
<head>
	<title>Registrarse</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/login.css">
	<link rel="icon" type="image/ico" href="img/favicon.ico"/>
</head>
<body>
	<div class="modal fade" id="investmentModal" tabindex="-1" aria-labelledby="investmentModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="investmentModalLabel">Nueva Inversión</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<!-- Formulario de inversión -->
					<?= form_open(base_url('investments/save')) ?>
						<input type="hidden" name="id_projects" value="<?= esc($id_project) ?>">
						<input type="hidden" name="id_users" value="<?= esc($id_user) ?>">

						<div class="mb-3">
							<label for="investmentAmount" class="form-label">Monto a invertir</label>
							<input type="number" class="form-control" id="investmentAmount" name="amount" min="1" step="0.01" placeholder="Ingrese el monto" required>
						</div>
						<button type="submit" class="btn btn-success">Aceptar</button>
					<?= form_close() ?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>