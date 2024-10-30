<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $this->renderSection('title') ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#222">
    <link rel="icon" href="img/favicon.ico" sizes="any">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css" integrity="sha256-mUZM63G8m73Mcidfrv5E+Y61y7a12O5mW4ezU3bxqW4=" crossorigin="anonymous">
    <script type="module" src="js/util.js"></script>
</head>
<body>
    <?= $this->renderSection('navbar') ?>
    <?= $this->renderSection('projects') ?>
</body>
</html>