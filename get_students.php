<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Include database configuration
require_once 'config.php';

try {
    // Use the PDO connection from config.php
    $stmt = $pdo->query('SELECT * FROM students ORDER BY created_at DESC');
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'success' => true, 
        'data' => $students,
        'message' => 'Students retrieved successfully'
    ]);
} catch(PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false, 
        'error' => 'Database error: ' . $e->getMessage()
    ]);
}
?>