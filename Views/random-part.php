<?php
use Database\MySQLWrapper;

// データベース接続を初期化します
$db = new MySQLWrapper();

try {
    // ユーザー入力が関与しないので、SQLインジェクションから保護する必要がないことに注意してください。
    // 代わりに$db->query()を使うこともできますが、一貫性を保つためにprepareを使うことにします。
    $stmt = $db->prepare("SELECT * FROM computer_parts ORDER BY RAND() LIMIT 1");
    $stmt->execute();
    $result = $stmt->get_result();
    $part = $result->fetch_assoc();
} catch (Exception $e) {
    die("Error fetching random part: " . $e->getMessage());
}

if (!$part) {
    echo "No part found!";
    exit;
}

// パーツをBootstrapカードに表示します。
// htmlspecialcharsは、htmlタグで使用される'<'や'>'のような特殊文字をテキストとしてレンダリングするためによく使用されます。
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