<?php
require 'db.php';

header('Content-Type: application/json');

try {
    $stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM pcs WHERE status = ?");
    $stmt->execute(['available']);
    $count = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($count);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
