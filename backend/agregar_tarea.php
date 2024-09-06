<?php
$dsn = 'mysql:host=localhost;dbname=taskflow';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        session_start();
        
        $nombre_tarea = trim($_POST['nombre_tarea']);
        $descripcion = trim($_POST['descripcion']);
        $status = trim($_POST['status']);
        $prioridad = trim($_POST['prioridad']);
        $fecha_limite = trim($_POST['fecha_limite']);
        $user_id = $_SESSION['id'];

        $stmt = $pdo->prepare("INSERT INTO tasks_tf (nombre_tarea, descripcion, status, prioridad, fecha_limite, user_id) 
            VALUES (:nombre_tarea, :descripcion, :status, :prioridad, :fecha_limite, :user_id)");
        
        $stmt->bindParam(':nombre_tarea', $nombre_tarea);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':prioridad', $prioridad);
        $stmt->bindParam(':fecha_limite', $fecha_limite);
        $stmt->bindParam(':user_id', $user_id);
        
        if ($stmt->execute()) {
            // Obtengo el último ID insertado
            $last_id = $pdo->lastInsertId();

            echo json_encode([
                'success' => true,
                'tarea' => [
                    'id' => $last_id,
                    'nombre_tarea' => $nombre_tarea,
                    'descripcion' => $descripcion,
                    'status' => $status,
                    'prioridad' => $prioridad,
                    'fecha_limite' => $fecha_limite
                ]
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al agregar la tarea.']);
        }
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
?>
