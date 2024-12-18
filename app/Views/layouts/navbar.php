<!-- NAVBAR -->

<section id="navbar">
<nav class="navbar">
	<!-- Left buttons -->
	<ul class="navbar-nav">
		<li><a href="<?= base_url('') ?>" class="nav-link">IMPULSA</a></li>
		<li><a href="<?= base_url('') ?>" class="nav-link"role="button">
			<i class="fa-solid fa-bars"></i>
		</a></li>
		<?php if (session()->has('userSessionName')): ?>
			<li><a href="<?= base_url('projects/list') ?>" class="nav-link">Proyectos</a></li>
			<li><a href="<?= base_url('investments/list') ?>" class="nav-link">Inversiones</a></li>
			<li><a href="<?= base_url('projects/myList') ?>" class="nav-link">Mis Proyectos</a></li>
		<?php endif; ?>
	</ul>
	<!-- Right buttons -->
	<ul class="navbar-nav ms-auto">
		<form id="theme-switcher">
			
			<div class="radio-container">
				<input checked type="radio" id="dark" name="theme" value="dark" class="custom-radio">
				<label for="dark">
					<i class="unchecked fa-regular fa-moon"></i>
					<i class="checked fa-solid fa-moon"></i>
				</label>
			</div>
			
			<div class="radio-container">
				<input type="radio" id="light" name="theme" value="light" class="custom-radio">
				<label for="light">
					<i class="unchecked fa-regular fa-sun"></i>
					<i class="checked fa-solid fa-sun"></i>
				</label>
			</div>
			
			<div class="radio-container">
				<input type="radio" id="dim" name="theme" value="dim" class="custom-radio">
				<label for="dim">
					<i class="unchecked fa-regular fa-circle"></i>
					<i class="checked fa-solid fa-circle-half-stroke"></i>
				</label>
			</div>
		</form>

		<!-- Usuario -->
		<li><a href="#sidebar" class="user-profile">
			<h3 class="btn"><?= session('userSessionName') ?></h3>
		</a></li>

		<!-- Messages Dropdown Menu -->
		<li class="nav-item dropdown">
			<a class="nav-link" data-bs-toggle="dropdown" href="#" aria-expanded="false">
				<i class="far fa-comments"></i>
				<span class="bg-danger">3</span>
			</a>

<!-- ELIMINAR Y AGREGAR COMENTARIOS PROPIOS -->
			<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
				<a href="#" class="dropdown-item">

					<!-- Message Start -->
					<div class="d-flex">
						<div class="flex-shrink-0">
							<img src="<?= base_url('uploads/user-10.jpg')?>" alt="User Avatar" class="img-size-50 img-circle me-3">
						</div>
						<div class="flex-grow-1">
							<h3 class="dropdown-item-title">
								Brad Diesel
								<span class="float-end fs-7 text-danger"><i class="fas fa-star"></i></span>
							</h3>
							<p class="fs-7">Call me whenever you can...</p>
							<p class="fs-7 text-muted"><i class="far fa-clock me-1"></i> 4 Hours Ago</p>
						</div>
					</div>

					<!-- Message End -->

				</a>
				<div class="dropdown-divider"></div>
				<a href="#" class="dropdown-item">

					<!-- Message Start -->
 
					<div class="d-flex">
						<div class="flex-shrink-0">
							<img src="<?= base_url('uploads/profile.png')?>" alt="User Avatar" class="img-size-50 img-circle me-3">
						</div>
						<div class="flex-grow-1">
							<h3 class="dropdown-item-title">
								John Pierce
								<span class="float-end fs-7 text-muted"><i class="fas fa-star"></i></span>
							</h3>
							<p class="fs-7">I got your message bro</p>
							<p class="fs-7 text-muted"><i class="far fa-clock me-1"></i> 4 Hours Ago</p>
						</div>
					</div>

				<!-- Message End -->

				</a>
				<div class="dropdown-divider"></div>
				<a href="#" class="dropdown-item">

					<!-- Message Start -->

					<div class="d-flex">
						<div class="flex-shrink-0">
							<img src="<?= base_url('uploads/user-10.jpg')?>" alt="User Avatar" class="img-size-50 img-circle me-3">
						</div>
						<div class="flex-grow-1">
							<h3 class="dropdown-item-title">
								Nora Silvester
								<span class="float-end fs-7 text-warning"><i class="fas fa-star"></i></span>
							</h3>
							<p class="fs-7">The subject goes here</p>
							<p class="fs-7 text-muted"><i class="far fa-clock me-1"></i> 4 Hours Ago</p>
						</div>
					</div>

					<!-- Message End -->
 
				</a>
				<div class="dropdown-divider"></div>
				<a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
			</div>
		</li>

		<!-- Notifications Dropdown Menu -->
		<li id="notificationBell" class="nav-item dropdown">
			<a class="nav-link" data-bs-toggle="dropdown" href="#">
				<i class="far fa-bell"></i>
				<span class="navbar-badge badge bg-warning" id="notificationCount"></span>
			</a>

			<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end" id="notificationDropdown">
				<span class="dropdown-item dropdown-header">Cargando notificaciones...</span>
				<div class="dropdown-divider"></div>
			</div>
		</li>

		<!-- Logout Icon -->
 		<li><a href="<?= base_url('logout') ?>">
			<i class="fa-solid fa-arrow-right-from-bracket logout"></i>
		</a></li>
		
	</ul>
</nav>
</section>