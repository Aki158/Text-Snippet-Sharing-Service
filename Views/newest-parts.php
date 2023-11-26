<?php

$page = $_GET['page'] ?? null;
$perpage = $_GET['perpage'] ?? null;
if (!$page) {
    die("No page provided for part lookup.");
}
if (!$perpage) {
    die("No perpage provided for part lookup.");
}
?>
<?php for($i = 0;$i < $page;$i++): ?>
    <h4><?= htmlspecialchars($i+1) ?>ページ目</h4>
    <?php for($j = 0;$j < $perpage;$j++): ?>
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($part[$i][$j]['name']) ?></h5>
                <h6 class="card-subtitle mb-2 text-muted"><?= htmlspecialchars($part[$i][$j]['type']) ?> - <?= htmlspecialchars($part[$i][$j]['brand']) ?></h6>
                <p class="card-text">
                    <strong>Model:</strong> <?= htmlspecialchars($part[$i][$j]['model_number']) ?><br />
                    <strong>Release Date:</strong> <?= htmlspecialchars($part[$i][$j]['release_date']) ?><br />
                    <strong>Description:</strong> <?= htmlspecialchars($part[$i][$j]['description']) ?><br />
                    <strong>Performance Score:</strong> <?= htmlspecialchars($part[$i][$j]['performance_score']) ?><br />
                    <strong>Market Price:</strong> $<?= htmlspecialchars($part[$i][$j]['market_price']) ?><br />
                    <strong>RSM:</strong> $<?= htmlspecialchars($part[$i][$j]['rsm']) ?><br />
                    <strong>Power Consumption:</strong> <?= htmlspecialchars($part[$i][$j]['power_consumptionw']) ?>W<br />
                    <strong>Dimensions:</strong> <?= htmlspecialchars($part[$i][$j]['lengthm']) ?>m x <?= htmlspecialchars($part[$i][$j]['widthm']) ?>m x <?= htmlspecialchars($part[$i][$j]['heightm']) ?>m<br />
                    <strong>Lifespan:</strong> <?= htmlspecialchars($part[$i][$j]['lifespan']) ?> years<br />
                </p>
                <p class="card-text"><small class="text-muted">Last updated on <?= htmlspecialchars($part[$i][$j]['updated_at']) ?></small></p>
            </div>
        </div>
    <?php endfor; ?>
<?php endfor; ?>