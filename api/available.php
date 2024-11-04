<?php
require 'db.php';

header('Content-Type: application/json');

try {
    $stmt = $pdo->prepare("SELECT * FROM pcs WHERE status = ?");
    $stmt->execute(['available']);
    $availablePCs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($availablePCs);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
