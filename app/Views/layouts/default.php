<!DOCTYPE html>
<html lang="en">
<head>
	<title><?= $this->renderSection('page_title') ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="theme-color" content="#222">
	<link rel="icon" type="image/ico" href="<?= base_url('img/favicon.ico') ?>"/>
	<!-- CSS -->
	<link rel="stylesheet" href="<?= base_url('css/dark-theme.css') ?>">
	<link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
	<!-- JS INIT -->
	<!--  <script type="module" src="<?= base_url('js/util.js') ?>"></script> -->
	<script src="https://kit.fontawesome.com/a2f79b8376.js"></script>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	<?= $this->renderSection('css_js-init') ?>
</head>
<body>
	<?= $this->renderSection('content') ?>
	
	<!-- JS END -->
	<script src="<?= base_url('js/sidebar.js') ?>"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	<?= $this->renderSection('js-end') ?>
</body>
</html>