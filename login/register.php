<?php

$dsn = 'mysql:host=localhost;dbname=taskflow';
$username = 'root';
$password = '';

    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT);

            $stmt = $pdo->prepare("INSERT INTO users_tf (nombre, email, contraseña) VALUES (:name, :email, :password)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);

            if ($stmt->execute()) {

                session_start();
                $_SESSION['nombre'] = $name; 
                include '../views/grid.php';
                
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Error en la consulta: ' . $e->getMessage()
                ]);
            }
        }
    } catch (PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Error en la consulta: ' . $e->getMessage()
        ]);
    }
?>
