<?= $this->extend('layouts/default') ?>
<?= $this->section('page_title') ?>Mis Comentarios<?= $this->endSection() ?>
<?= $this->section('css_js-init') ?>
	<link rel="stylesheet" href="<?= base_url('css/tables.css') ?>">
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="<?= base_url('js/modalCrearProyecto.js') ?>"></script>
	<script src="<?= base_url('js/alertasYMensajesProjets.js') ?>"></script>
<?= $this->endSection() ?>

<!-- My Comments -->

<?= $this->section('content') ?>
<?= $this->include('messages/alert') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('messages/message') ?>
<?= $this->include('layouts/sidebar') ?>



<div class="container">
    <h1>Mis Comentarios</h1>

    <?php if (empty($comments)): ?>
        <p>No tienes comentarios.</p>
    <?php else: ?>
        <ul class="list-group">
            <?php foreach ($comments as $comment): ?>

                <li class="list-group-item list-group-item-info">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-gray-800">Comentario <?= esc($comment['id']) ?></h3>
                            <p class="text-sm text-gray-500"><?= date('d/m/Y H:i:s', strtotime($comment['comment_date'])) ?></p>
                        </div>
                        <p class="text-gray-700 mt-2"><?= esc($comment['comment']) ?></p>
                    
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>
<?= $this->include('layouts/footer') ?>
<?= $this->endSection() ?>