<?php
session_start();

$dsn = 'mysql:host=localhost;dbname=taskflow';
$username = 'root';
$password = '';

try {

    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    if (isset($_POST['task_id'])) {
        $task_id = $_POST['task_id'];


        $stmt = $pdo->prepare("DELETE FROM tasks_tf WHERE id = :task_id AND user_id = :user_id");
        $stmt->bindParam(':task_id', $task_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $_SESSION['id'], PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo json_encode([
                'success' => true,
                'message' => 'Tarea eliminada exitosamente.'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'No se pudo eliminar la tarea.'
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'ID de tarea no proporcionado.'
        ]);
    }
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error en la consulta: ' . $e->getMessage()
    ]);
}
