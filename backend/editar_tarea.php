<?php
session_start();

$dsn = 'mysql:host=localhost;dbname=taskflow';
$username = 'root';
$password = '';

try {
    // Creamos conexión PDO
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verificamos si se recibieron los datos necesarios
    if (isset($_POST['task_id']) && isset($_POST['nombre_tarea-edit']) && isset($_POST['descripcion-edit']) && isset($_POST['status-edit']) && isset($_POST['prioridad-edit']) && isset($_POST['fecha_limite-edit'])) {
        $task_id = $_POST['task_id'];
        $nombre_tarea = $_POST['nombre_tarea-edit'];
        $descripcion = $_POST['descripcion-edit'];
        $status = $_POST['status-edit'];
        $prioridad = $_POST['prioridad-edit'];
        $fecha_limite = $_POST['fecha_limite-edit'];

        // Actualizar la tarea en la base de datos
        $stmt = $pdo->prepare("UPDATE tasks_tf SET nombre_tarea = :nombre_tarea, descripcion = :descripcion, status = :status, prioridad = :prioridad, fecha_limite = :fecha_limite WHERE id = :task_id AND user_id = :user_id");
        $stmt->bindParam(':nombre_tarea', $nombre_tarea);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':prioridad', $prioridad);
        $stmt->bindParam(':fecha_limite', $fecha_limite);
        $stmt->bindParam(':task_id', $task_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $_SESSION['id'], PDO::PARAM_INT);
        $stmt->execute();

        // Verificamos si la tarea fue actualizada
        if ($stmt->rowCount() > 0) {
            echo json_encode([
                'success' => true,
                'message' => 'Tarea actualizada exitosamente.'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'No se pudo actualizar la tarea.'
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Datos incompletos.'
        ]);
    }
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error en la consulta: ' . $e->getMessage()
    ]);
}
