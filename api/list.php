<?php
require 'db.php';

header('Content-Type: application/json');

try {
    $stmt = $pdo->query("SELECT * FROM pcs");
    $pcs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($pcs);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
