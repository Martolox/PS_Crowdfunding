<!DOCTYPE html>
<html>
<head>
	<title>Registrarse</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?= base_url('css/login.css') ?>">
	<link rel="icon" type="image/ico" href="<?= base_url('img/favicon.ico') ?>"/>
</head>
<body>

<!-- REGISTER -->

<section id="login">
	<div class="column">
		<h2>
			<img src="<?= base_url('img/png/target.png') ?>">
			<div class="text">Registrate en Impulsa</div>	
		</h2>
		<form autocomplete="off" action="<?= base_url('users/new') ?>" method="post">
			<div class="segment">
				<div class="field">
					<div class="text-input">
						<img src="<?= base_url('img/icons/user-solid.svg') ?>">
						<input type="text" name="username" placeholder="Nombre de usuario">
					</div>
				</div>
				<div class="field">
					<div class="text-input">
						<img src="<?= base_url('img/icons/lock-solid.svg') ?>">
						<input type="password" name="password" placeholder="Contraseña">
					</div>
				</div>
				<div class="field">
					<div class="text-input">
						<img src="<?= base_url('img/icons/envelope-solid.svg') ?>">
						<input type="text" name="email" placeholder="Dirección de correo">
					</div>
				</div>
				<div class="buttons">
					<a href="<?= base_url('login') ?>" class="button">Ya tengo cuenta</a>
					<button type="submit" value="register">Ingresar</button>
				</div>
			</div>
		</form>
	</div>
</section>
</body>
</html>