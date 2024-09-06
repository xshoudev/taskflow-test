<?php
session_start();

$dsn = 'mysql:host=localhost;dbname=taskflow';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_SESSION['id'])) {
        $user_id = $_SESSION['id'];

        if (isset($_POST['task_id'])) {
            //Si esta setteado el task_id
            // Consultamos una tarea específica
            $task_id = $_POST['task_id'];
            $stmt = $pdo->prepare("SELECT * FROM tasks_tf WHERE id = :task_id AND user_id = :user_id");
            $stmt->bindParam(':task_id', $task_id, PDO::PARAM_INT);
        } else {
            // Consultamos todas las tareas del usuario
            $stmt = $pdo->prepare("SELECT * FROM tasks_tf WHERE user_id = :user_id");
        }

        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'success' => true,
            'tasks' => $tasks
        ]);
    }

} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error en la consulta: ' . $e->getMessage()
    ]);
}

