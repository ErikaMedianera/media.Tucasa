<?php
include("./controladores/conexion.php");

// Crear imagen
if (isset($_POST['action']) && $_POST['action'] == 'create') {
    $id_noticia = $_POST['id_noticia'];
    $id_propiedad = $_POST['id_propiedad'];
    $ruta_imagen = $_FILES['ruta_imagen']['name'];
    $ruta_imagen_tmp = $_FILES['ruta_imagen']['tmp_name'];
    $ruta_destino = "../uploads/" . $ruta_imagen;

    if (move_uploaded_file($ruta_imagen_tmp, $ruta_destino)) {
        $stmt = $conn->prepare("INSERT INTO imagenes (id_noticia, id_propiedad, ruta_imagen) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $id_noticia, $id_propiedad, $ruta_imagen);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Imagen creada correctamente']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al crear la imagen']);
        }
        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al subir la imagen']);
    }
}

// Leer imagenes
if (isset($_POST['action']) && $_POST['action'] == 'read') {
    $result = $conn->query("SELECT * FROM imagenes");
    $imagenes = [];
    while ($row = $result->fetch_assoc()) {
        $imagenes[] = $row;
    }
    echo json_encode($imagenes);
}

// Actualizar imagen
if (isset($_POST['action']) && $_POST['action'] == 'update') {
    $id_imagen = $_POST['id_imagen'];
    $id_noticia = $_POST['id_noticia'];
    $id_propiedad = $_POST['id_propiedad'];
    $ruta_imagen = $_FILES['ruta_imagen']['name'];
    $ruta_imagen_tmp = $_FILES['ruta_imagen']['tmp_name'];
    $ruta_destino = "../uploads/" . $ruta_imagen;

    if (move_uploaded_file($ruta_imagen_tmp, $ruta_destino)) {
        $stmt = $conn->prepare("UPDATE imagenes SET id_noticia = ?, id_propiedad = ?, ruta_imagen = ? WHERE id_imagen = ?");
        $stmt->bind_param("iisi", $id_noticia, $id_propiedad, $ruta_imagen, $id_imagen);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Imagen actualizada correctamente']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al actualizar la imagen']);
        }
        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al subir la imagen']);
    }
}

// Eliminar imagen
if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    $id_imagen = $_POST['id_imagen'];
    $stmt = $conn->prepare("DELETE FROM imagenes WHERE id_imagen = ?");
    $stmt->bind_param("i", $id_imagen);
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Imagen eliminada correctamente']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al eliminar la imagen']);
    }
    $stmt->close();
}

$conn->close();
?>