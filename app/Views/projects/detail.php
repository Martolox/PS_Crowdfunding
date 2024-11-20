<body>
    <?php if (session()->getFlashdata('message') || session()->getFlashdata('error')): ?>
        <input type="hidden" id="alertMessage" value="<?= session()->getFlashdata('message') ?>">
        <input type="hidden" id="alertError" value="<?= session()->getFlashdata('error') ?>">
    <?php endif; ?>

    <!-- NAVBAR -->
<section id="navbar">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Botones izquierdos -->
    <ul class="navbar-nav">
        <li class="nav-item"><a href="<?= base_url() ?>" class="nav-link">IMPULSA</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>" role="button"><i class="fas fa-bars"></i></a></li>
            <li class="nav-item"><a href="#" class="nav-link">Proyectos</a></li>
            <li class="nav-item"><a href="<?= base_url('investments/list') ?>"class="nav-link">Inversiones</a></li>
            <li class="nav-item"><a href="<?= base_url('projects/myList') ?>"class="nav-link">Mis proyectos</a></li>
        </ul>
    </ul>
    <!-- Botones derechos -->
    <ul class="navbar-nav ml-auto">
        <form id="theme-switcher" class="form-inline">
            <div class="form-check form-check-inline">
                <input checked type="radio" id="dark" name="theme" value="dark" class="form-check-input">
                <label for="dark" class="form-check-label">Dark</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" id="light" name="theme" value="light" class="form-check-input">
                <label for="light" class="form-check-label">Light</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" id="dim" name="theme" value="dim" class="form-check-input">
                <label for="dim" class="form-check-label">Dim</label>
            </div>
        </form>
        <!-- Usuario -->
        <li><h3><?= session('userSessionName') ?></h3></li>
        <li><a href="<?= base_url('logout') ?>">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="16" height="16" fill="var(--text1)" ><path d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z"/></svg>
        </a></li>
    </ul>
</nav>

<!-- PROJECT DETAILS -->

<section class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div id="projectDetails" class="bg-white rounded-lg shadow-xl p-8 m-4 max-w-xl w-full">
        <h1 id="projectName" class="text-3xl font-bold mb-4 text-center text-gray-800"><?= esc($project['title']) ?></h1>
        <img id="projectImage" src="<?= base_url('uploads/' . esc($project['img_name'])) ?>" alt="Imagen de <?= esc($project['title']) ?>" class="w-full h-64 object-cover rounded-lg mb-6">
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <p class="text-sm font-semibold text-gray-600">Categoría:</p>
                <p id="projectCategory" class="text-lg text-gray-800"><?= esc($project['id_categories']) ?></p>
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
</section>