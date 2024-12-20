<!-- INVESTMENT DETAIL -->
<?= $this->section('content') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar') ?>
<?= $this->endSection() ?>
<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" href="<?= base_url('css/detail-investment.css') ?>">
<section id="inv-details">
    <div id="investmentDetails" class="bg-white rounded-lg shadow-xl p-8 m-4 max-w-xl w-full">
        <div class="inner-container">
            <!-- Título con ID de Inversión -->
            <h1 id="investmentID" class="text-3xl font-bold mb-4 text-center text-gray-800">
                ID de Inversión: <?= esc($investment['id_investments']) ?>
            </h1>

            <!-- Fecha de inversión y Estado -->
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <p class="text-sm font-semibold text-gray-600">Fecha de Inversión:</p>
                    <p id="investmentDate" class="text-lg text-gray-800">
                        <?= date('d/m/Y H:i:s', strtotime($investment['investment_date'])) ?>
                    </p>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-600">Estado:</p>
                    <p id="investmentStatus" class="text-lg text-gray-800"><?= esc($investment['status']) ?></p>
                </div>
            </div>

            <!-- Nombre del Proyecto y Creador -->
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div class="section-content">
                    <p class="section-header">Título del Proyecto:</p>
                    <p><?= esc($investment['project_name']) ?></p>
                </div>
                <div class="section-content">
                    <p class="section-header">Creador del Proyecto:</p>
                    <p><?= esc($investment['creator_name']) ?></p>
                </div>
            </div>

            <!-- Monto Invertido y Categoría -->
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div class="section-content">
                    <p class="section-header">Monto Invertido:</p>
                    <p><?= number_format($investment['amount'], 2, ',', '.') ?> €</p>
                </div>
                <div class="section-content">
                    <p class="section-header">Categoría:</p>
                    <p><?= esc($investment['category']) ?></p>
                </div>
            </div>

            <!-- Fecha de Finalización -->
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div class="section-content">
                    <p class="section-header">Fecha de Finalización:</p>
                    <p><?= date('d/m/Y', strtotime($investment['end_date'])) ?></p>
                </div>
            </div>

            <!-- Plan de Recompensas -->
            <div id="rewardPlanContainer">
                <p class="section-header">Plan de Recompensas:</p>
                <p id="projectRewardPlan"><?= esc($investment['reward_plan']) ?></p>
            </div>
        </div>
    </div>
</section>
<?= $this->include('layouts/footer') ?>
<?= $this->endSection() ?>
