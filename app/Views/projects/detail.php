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