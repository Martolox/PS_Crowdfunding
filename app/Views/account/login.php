<!DOCTYPE html>
<html>
<head>
    <title>Ingresar</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= base_url('css/login.css') ?>">
    <link rel="icon" type="image/ico" href="<?= base_url('img/favicon.ico') ?>"/>
</head>
<body>

<!-- LOGIN -->

<section id="login">
	<div class="column">
		<h2>
			<img src="<?= base_url('img/png/target.png') ?>">
			<div class="text">Accede a tu cuenta</div>	
		</h2>
		<form autocomplete="off" action="<?= base_url('authenticate') ?>" method="post">
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
				<div class="buttons">
					<button type="submit" value="login">Ingresar</button>
					<a href="<?= base_url('register') ?>" class="button">Registrarme</a>
				</div>
			</div>

			<!-- ERRORS -->
			<div class="error-message">
				<ul class="list">
					<?php
					if(isset($errors))
					foreach ($errors as $e) 
						echo '<li>'.$e.'</li>';
					?>
				</ul>
			</div>

		</form>
	</div>
</section>
</body>
</html>