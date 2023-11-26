<?php
$types = ["RAM","SSD","CPU","GPU"];
?>
<?php for($i = 0;$i < count($types);$i++): ?>
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($part[$i]['name']) ?></h5>
            <h6 class="card-subtitle mb-2 text-muted"><?= htmlspecialchars($part[$i]['type']) ?> - <?= htmlspecialchars($part[$i]['brand']) ?></h6>
            <p class="card-text">
                <strong>Model:</strong> <?= htmlspecialchars($part[$i]['model_number']) ?><br />
                <strong>Release Date:</strong> <?= htmlspecialchars($part[$i]['release_date']) ?><br />
                <strong>Description:</strong> <?= htmlspecialchars($part[$i]['description']) ?><br />
                <strong>Performance Score:</strong> <?= htmlspecialchars($part[$i]['performance_score']) ?><br />
                <strong>Market Price:</strong> $<?= htmlspecialchars($part[$i]['market_price']) ?><br />
                <strong>RSM:</strong> $<?= htmlspecialchars($part[$i]['rsm']) ?><br />
                <strong>Power Consumption:</strong> <?= htmlspecialchars($part[$i]['power_consumptionw']) ?>W<br />
                <strong>Dimensions:</strong> <?= htmlspecialchars($part[$i]['lengthm']) ?>m x <?= htmlspecialchars($part[$i]['widthm']) ?>m x <?= htmlspecialchars($part[$i]['heightm']) ?>m<br />
                <strong>Lifespan:</strong> <?= htmlspecialchars($part[$i]['lifespan']) ?> years<br />
            </p>
            <p class="card-text"><small class="text-muted">Last updated on <?= htmlspecialchars($part[$i]['updated_at']) ?></small></p>
        </div>
    </div>
<?php endfor; ?>