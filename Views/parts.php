<?php
use Database\MySQLWrapper;

// URLクエリパラメータを通じてIDが提供されたかどうかをチェックします。
$id = $_GET['id'] ?? null;
if (!$id) {
    die("No ID provided for part lookup.");
}

// データベース接続を初期化します。
$db = new MySQLWrapper();

try {
    // IDで部品を取得するステートメントを準備します。
    $stmt = $db->prepare("SELECT * FROM computer_parts WHERE id = ?");
    // i' は整数であることを示します。
    $stmt->bind_param('i', $id);
    $stmt->execute();

    $result = $stmt->get_result();
    $part = $result->fetch_assoc();
} catch (Exception $e) {
    die("Error fetching part by ID: " . $e->getMessage());
}

if (!$part) {
    print("No part found with ID: $id");
    exit;
}

?>
<div class="card" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title"><?= htmlspecialchars($part['name']) ?></h5>
        <h6 class="card-subtitle mb-2 text-muted"><?= htmlspecialchars($part['type']) ?> - <?= htmlspecialchars($part['brand']) ?></h6>
        <p class="card-text">
            <strong>Model:</strong> <?= htmlspecialchars($part['model_number']) ?><br />
            <strong>Release Date:</strong> <?= htmlspecialchars($part['release_date']) ?><br />
            <strong>Description:</strong> <?= htmlspecialchars($part['description']) ?><br />
            <strong>Performance Score:</strong> <?= htmlspecialchars($part['performance_score']) ?><br />
            <strong>Market Price:</strong> $<?= htmlspecialchars($part['market_price']) ?><br />
            <strong>RSM:</strong> $<?= htmlspecialchars($part['rsm']) ?><br />
            <strong>Power Consumption:</strong> <?= htmlspecialchars($part['power_consumptionw']) ?>W<br />
            <strong>Dimensions:</strong> <?= htmlspecialchars($part['lengthm']) ?>m x <?= htmlspecialchars($part['widthm']) ?>m x <?= htmlspecialchars($part['heightm']) ?>m<br />
            <strong>Lifespan:</strong> <?= htmlspecialchars($part['lifespan']) ?> years<br />
        </p>
        <p class="card-text"><small class="text-muted">Last updated on <?= htmlspecialchars($part['updated_at']) ?></small></p>
    </div>
</div>