<?php

$dsn = 'mysql:host=localhost;dbname=taskflow';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        // Buscamos usuario por email
        $stmt = $pdo->prepare("SELECT * FROM users_tf WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if (password_verify($password, $user['contraseña'])) {

                session_start();
                
                //Si existe creamos las variables de sesión con su
                //id y con su nombre de usuario
                $_SESSION['nombre'] = $user['nombre'];
                $_SESSION['id'] = strval($user['id']);

                echo json_encode([
                    'type' => 'html',
                    'content' => file_get_contents('../views/grid.php')
                ]);
            } else {
                echo json_encode(['type' => 'error', 'message' => 'Contraseña incorrecta.']);
            }
        } else {
            echo json_encode(['type' => 'error', 'message' => 'Usuario no encontrado.']);
        }
    }
} catch (PDOException $e) {
    echo json_encode([
        'type' => 'error',
        'message' => 'Error en la consulta: ' . $e->getMessage()
    ]);
}
?>
