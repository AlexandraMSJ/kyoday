<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Content-Type: text/plain; charset=utf-8");

include('funciones/conecta.php');
$conexion = conecta();
$conexion->set_charset("utf8");

// Verifica que todos los datos estén definidos
$campos = ['mesero', 'comentarios_mesero', 'calidad_comida', 'atencion_personal', 'bebidas_tiempo', 'tiempo_comida', 'limpieza_lugar', 'recomendacion', 'comentarios_adicionales'];

foreach ($campos as $campo) {
    if (!isset($_POST[$campo])) {
        die("Falta el campo: $campo");
    }
}

$stmt = $conexion->prepare("INSERT INTO encuestas (
    mesero, comentarios_mesero, calidad_comida, atencion_personal, bebidas_tiempo,
    tiempo_comida, limpieza_lugar, recomendacion, comentarios_adicionales
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param(
    "sssssssss",
    $_POST['mesero'],
    $_POST['comentarios_mesero'],
    $_POST['calidad_comida'],
    $_POST['atencion_personal'],
    $_POST['bebidas_tiempo'],
    $_POST['tiempo_comida'],
    $_POST['limpieza_lugar'],
    $_POST['recomendacion'],
    $_POST['comentarios_adicionales']
);

if ($stmt->execute()) {
    echo "ok";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conexion->close();
?>
