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
<section>
	<div id="projectDetails">
		<div class="titleContainer">
			<h1 id="projectName"><?= esc($project['name']) ?></h1>
		</div>
		<div class="grid">
			<div class="grid-item">
				<div class="grid-item">
					<p class="gridLabel">Categoría:</p>
					<p class="gridText"><?= esc($project['category']) ?></p>
				</div>
				<div class="grid-item">
					<p class="gridLabel">Estado:</p>
					<p id="projectStatus" class="gridText"><?= esc($project['status']) ?></p>
				</div>
				<div class="grid-item">
					<p class="gridLabel">Fecha de finalización:</p>
					<p class="gridText"><?= date('d/m/Y', strtotime($project['end_date'])) ?></p>
				</div>

				<!-- Estrellas -->
				<div class="grid-item">
					<p class="gridLabel">Puntuación:</p>
					<div>
						<p>Texto de prueba</p>
					</div>
					<div class="rate">
						<input type="radio" id="star5" name="rate" value="5" />
						<label for="star5" title="text">5 stars</label>
						<input type="radio" id="star4" name="rate" value="4" />
						<label for="star4" title="text">4 stars</label>
						<input type="radio" id="star3" name="rate" value="3" />
						<label for="star3" title="text">3 stars</label>
						<input type="radio" id="star2" name="rate" value="2" />
						<label for="star2" title="text">2 stars</label>
						<input type="radio" id="star1" name="rate" value="1" />
						<label for="star1" title="text">1 star</label>
					</div>
				
				</div>
			</div>
			<img id="projectImage" src="<?= base_url(esc($project['img_name'])) ?>" alt="Imagen de <?= esc($project['name']) ?>">
			<div class="grid-item">
				<p class="gridLabel">Presupuesto:</p>
				<p id="projectBudget" class="gridText">$ <?= number_format($project['budget'], 2, ',', '.') ?></p>
			</div>
			<div class="grid-item">
				<p class="gridLabel">Monto recaudado:</p>
				<p class="gridText">$ <?= number_format($project['total_investment'], 2, ',', '.') ?></p>
			</div>
		</div>
		<div>
			<p class="gridLabel">Impacto:</p>
			<p id="projectImpact" class="gridText"><?= esc($project['impact']) ?></p>
		</div>
		<div>
			<p class="gridLabel">Plan de recompensa:</p>
			<p id="projectRewardPlan" class="gridText"><?= esc($project['reward_plan']) ?></p>
		</div>
	</div>
</section>

<!-- Listado de actualizaciones -->
<section>
	<div id="projectUpdates">
		<h2 class="updatesTitle">Actualizaciones del proyecto</h2>
		<?php if (!empty($updates)): ?>
			<ul>
				<?php foreach ($updates as $update): ?>
					<li>
						<div class="flex justify-between items-center">
							<h3 class="updVersion">Versión <?= esc($update['version']) ?></h3>
							<p class="updDate"><?= date('d/m/Y H:i:s', strtotime($update['change_date'])) ?></p>
						</div>
						<p class="text-gray-700 mt-2"><?= esc($update['description']) ?></p>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php else: ?>
			<p class="noUpdates">No hay actualizaciones registradas para este proyecto.</p>
		<?php endif; ?>
	</div>
</section>

<!-- Project Comments -->
<section id="s-content">
	<div class="comments-wrap">
		<div id="comments" class="row">
			<div class="col-full">
				<?php if(count($comments)!= 0) {
					if (count($comments) == 1) echo '<h3 class="h2">1 Comentario</h3>';
					else echo '<h3 class="h2">'.count($comments).' Comentarios</h3>';
				}
				?>
				<!-- START commentlist -->
				<ol class="commentlist">
					<?php foreach ($comments as $c) { 
						$comment_date = new DateTime($c['comment_date']);?>
					<li class="depth-1 comment">
						<div class="comment__avatar">
							<img class="avatar" src="<?= base_url($c['img_name']) ?>" alt="" width="50" height="50">
						</div>
						<div class="comment__content">
							<div class="comment__info">
								<div class="comment__author"><?=$c['username']?></div>
								<div class="comment__meta">
									<div class="comment__time"><?= $comment_date->format('d/m/Y') ?></div>
								</div>
							</div>

							<div class="comment__text">
							<p><?=$c['comment']?></p>
							</div>
						</div>
					</li>
					<?php }; ?>

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
						<input type="hidden" name="id_projects" value="<?=$project['id_projects']?>" />
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