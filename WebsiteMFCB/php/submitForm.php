<?php
header('Content-Type: application/json');

// Database configuration
$host = 'localhost'; // Replace with your database host
$dbname = 'maria_fide_db'; // Replace with your database name
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password

// Connect to the database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Error connecting to the database: ' . $e->getMessage()
    ]);
    exit;
}

// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = htmlspecialchars($_POST['nombre'] ?? '');
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars($_POST['sujeto'] ?? '');
    $message = htmlspecialchars($_POST['mensaje'] ?? '');

    // Validate inputs
    $errors = [];

    if (empty($name)) {
        $errors[] = 'El nombre es requerido.';
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Por favor, ingresa un correo electrónico válido.';
    }

    if (empty($subject)) {
        $errors[] = 'El asunto es requerido.';
    }

    if (empty($message)) {
        $errors[] = 'El mensaje es requerido.';
    }

    // If there are errors, return them
    if (!empty($errors)) {
        echo json_encode([
            'status' => 'error',
            'messages' => $errors
        ]);
        exit;
    }

    // If no errors, save the form submission to the database
    try {
        $stmt = $pdo->prepare("INSERT INTO form_submissions (name, email, subject, message) VALUES (:name, :email, :subject, :message)");
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':subject' => $subject,
            ':message' => $message
        ]);

        echo json_encode([
            'status' => 'success',
            'message' => '¡Gracias por contactarnos! Tu mensaje ha sido enviado y guardado.'
        ]);
    } catch (PDOException $e) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Error saving the form submission: ' . $e->getMessage()
        ]);
    }
} else {
    // If the form is not submitted via POST, return an error
    echo json_encode([
        'status' => 'error',
        'message' => 'Método de solicitud no válido.'
    ]);
}
?>