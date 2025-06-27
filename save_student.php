<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Include database configuration
require_once 'config.php';

try {
    // Get form data
    $data = json_decode(file_get_contents('php://input'), true) ?: $_POST;
    
    $name = trim($data['name'] ?? '');
    $email = trim($data['email'] ?? '');
    $phone = trim($data['phone'] ?? '');
    $address = trim($data['address'] ?? '');

    // Validate input
    if (empty($name) || empty($email) || empty($phone) || empty($address)) {
        throw new Exception('All fields are required');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Invalid email format');
    }

    // Prepare SQL statement
    $stmt = $pdo->prepare('INSERT INTO students (name, email, phone, address) VALUES (:name, :email, :phone, :address)');
    
    // Execute with parameters
    $stmt->execute([
        ':name' => $name,
        ':email' => $email,
        ':phone' => $phone,
        ':address' => $address
    ]);

    // Return success response
    echo json_encode([
        'success' => true,
        'message' => 'Student added successfully',
        'id' => $pdo->lastInsertId()
    ]);

} catch(Exception $e) {
    // Set appropriate HTTP status code
    http_response_code($e instanceof PDOException ? 500 : 400);
    
    // Return error response
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?>