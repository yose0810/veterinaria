<?php
// Obtener los valores del formulario
$dueño = $_POST['dueño'];
$mascota = $_POST['mascota'];
$especie = $_POST['especie'];
$motivo = $_POST['motivo'];

// Realizar la conexión a la base de datos (reemplaza los valores con los de tu configuración)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "veterinaria";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Preparar la consulta SQL para insertar los datos en la tabla
$sql = "INSERT INTO consultas (Dueño, Mascota, Especie, Motivo)
        VALUES ('$dueño', '$mascota', '$especie', '$motivo')";

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    echo "Consulta insertada correctamente.";
} else {
    echo "Error al insertar la consulta: " . $conn->error;
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
