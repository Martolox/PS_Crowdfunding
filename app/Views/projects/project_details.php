<?= $this->extend('layouts/default') ?>
<?= $this->section('page_title') ?>Detalles del Proyecto<?= $this->endSection() ?>
<?= $this->section('css_js-init') ?>
	<link rel="stylesheet" href="<?= base_url('css/project-details.css') ?>">
<?= $this->endSection() ?>

<!-- PROJECT DETAILS -->
<?= $this->section('content') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('messages/message') ?>
<?= $this->include('layouts/sidebar') ?>

<!-- Project Details -->
<section id="proj-details">
<div id="projectDetails" class="bg-white rounded-lg shadow-xl p-8 m-4 max-w-xl w-full">
	<div class="inner-container">
		<h1 id="projectName" class="text-3xl font-bold mb-4 text-center text-gray-800"><?= esc($project['name']) ?></h1>
			
		<br>
		<img id="projectImage" src="<?= base_url(esc($project['img_name'])) ?>" alt="Imagen de <?= esc($project['name']) ?>" class="w-64 h-64 object-cover rounded-lg mb-6">
			
		<div class="grid grid-cols-2 gap-4 mb-6">
			<div>
				<p class="text-sm font-semibold text-gray-600">Categoría:</p>
				<p id="projectCategory" class="text-lg text-gray-800"><?= esc($project['category']) ?></p>
			</div>
			<div>
				<p class="text-sm font-semibold text-gray-600">Estado:</p>
				<p id="projectStatus" class="text-lg text-gray-800"><?= esc($project['status']) ?></p>
			</div>
			<div>
				<p class="text-sm font-semibold text-gray-600">Presupuesto:</p>
				<p id="projectBudget" class="text-lg text-gray-800"><?= number_format($project['budget'], 2, ',', '.') ?> €</p>
			</div>
			<div>
				<p class="text-sm font-semibold text-gray-600">Recaudado:</p>
				<p id="projectTotalInvestment" class="text-lg text-gray-800"><?= number_format($project['total_investment'], 2, ',', '.') ?> €</p>
			</div>
			<div>
				<p class="text-sm font-semibold text-gray-600">Fecha de finalización:</p>
				<p id="projectEndDate" class="text-lg text-gray-800"><?= date('d/m/Y', strtotime($project['end_date'])) ?></p>
			</div>
		</div>
		<div class="mb-6">
			<p class="text-sm font-semibold text-gray-600">Impacto:</p>
			<p id="projectImpact" class="text-lg text-gray-800"><?= esc($project['impact']) ?></p>
		</div>
		<div>
			<p class="text-sm font-semibold text-gray-600">Plan de recompensa:</p>
			<p id="projectRewardPlan" class="text-lg text-gray-800"><?= esc($project['reward_plan']) ?></p>
		</div>
	</div>
</div>
</section>

<!-- Project Comments -->
<section id="s-content">
	<div class="comments-wrap">
		<div id="comments" class="row">
			<div class="col-full">
				<h3 class="h2">5 Comentarios</h3>
				<!-- START commentlist -->
				<ol class="commentlist">
					<li class="depth-1 comment">
						<div class="comment__avatar">
							<img class="avatar" src="<?= base_url('uploads/user-4.jpg') ?>" alt="" width="50" height="50">
						</div>
						<div class="comment__content">
							<div class="comment__info">
								<div class="comment__author">Itachi Uchiha</div>
								<div class="comment__meta">
									<div class="comment__time">Jun 15, 2018</div>
								</div>
							</div>

							<div class="comment__text">
							<p>Adhuc quaerendum est ne, vis ut harum tantas noluisse, id suas iisque mei. Nec te inani ponderum vulputate,
							facilisi expetenda has et. Iudico dictas scriptorem an vim, ei alia mentitum est, ne has voluptua praesent.</p>
							</div>

						</div>

					</li>

					<li class="thread-alt depth-1 comment">
						<div class="comment__avatar">
							<img class="avatar" src="<?= base_url('uploads/profile.png') ?>" alt="" width="50" height="50">
						</div>

						<div class="comment__content">
							<div class="comment__info">
								<div class="comment__author">John Doe</div>
								<div class="comment__meta">
									<div class="comment__time">Jun 15, 2018</div>
								</div>
							</div>

							<div class="comment__text">
							<p>Sumo euismod dissentiunt ne sit, ad eos iudico qualisque adversarium, tota falli et mei. Esse euismod
							urbanitas ut sed, et duo scaevola pericula splendide. Primis veritus contentiones nec ad, nec et
							tantas semper delicatissimi.</p>
							</div>
						</div>
					</li>
					<li class="depth-1 comment">
						<div class="comment__avatar">
							<img class="avatar" src="<?= base_url('uploads/user-10.jpg') ?>" alt="" width="50" height="50">
						</div>
						<div class="comment__content">
							<div class="comment__info">
								<div class="comment__author">Shikamaru Nara</div>
								<div class="comment__meta">
									<div class="comment__time">Jun 15, 2018</div>
								</div>
							</div>
							<div class="comment__text">
								<p>Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem.</p>
							</div>
						</div>
					</li>
				</ol>
				<!-- END commentlist -->           
			</div>
		</div>
		<?php if ($project['show_form']): ?>
		<div class="row comment-respond">
			<div id="respond" class="col-full">
				<h3 class="h2">Agregar Comentario</h3>
				<form name="contactForm" id="contactForm" method="post" action="<?= base_url('comments/create') ?>" autocomplete="off">
					<fieldset>
						<!-- Pasar la URL actual -->
						<?php
							$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
						?>
						<input type="hidden" name="url" value="<?=$actual_link?>" />
						<input type="hidden" name="id_project" value="<?=$project['id_projects']?>" />
						<div>
							<textarea name="cMessage" id="cMessage" class="full-width" placeholder="Escribe tu Mensaje*"></textarea>
						</div>
						<input name="submit" id="submit" class="btn--primary" value="Enviar" type="submit">
					</fieldset>
				</form>
			</div>
		</div>
		<?php endif; ?>
	</div>
</section>

<?= $this->include('layouts/footer') ?>
<?= $this->endSection() ?>