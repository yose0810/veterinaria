<?php
// Mensaje inicial vacío
$mensaje = "";

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
        $consultaId = $conn->insert_id; // Obtener el ID de la consulta insertada

        // Establecer el mensaje con el ID de la consulta
        $mensaje = "Consulta insertada correctamente. ID de la consulta: " . $consultaId;
    } else {
        $mensaje = "Error al insertar la consulta: " . $conn->error;
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
}

if (isset($_GET['ID'])) {
    $consultaId = $_GET['ID'];
    
    // Consultar la base de datos para obtener la información de la consulta
    $sql = "SELECT * FROM consultas WHERE ID = '$consultaId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // El ID existe en la base de datos, mostrar la información
        $row = $result->fetch_assoc();
        $dueñoConsulta = $row['Dueño'];
        $mascotaConsulta = $row['Mascota'];
        $especieConsulta = $row['Especie'];
        $motivoConsulta = $row['Motivo'];
    } else {
        // El ID no existe en la base de datos
        $mensajeConsulta = "No se encontró la consulta en la base de datos";
    }
}
?>

<html>
<head>
  <meta charset="UTF-8">
  <title>Contenido General</title>
  <link rel="stylesheet" type="text/css" href="../css/consulta.css">
</head>
<body>
 
  <div class="content-container">
    <h1>Verificar Consulta</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <label for="dueño">Dueño:</label>
      <input type="text" id="dueño" name="dueño" required>
      
      <label for="mascota">Mascota:</label>
      <input type="text" id="mascota" name="mascota" required>
      
      <label for="especie">Especie:</label>
      <select id="especie" name="especie" required>
        <option value="Perros">Perros</option>
        <option value="Gatos">Gatos</option>
        <option value="Aves">Aves</option>
        <option value="Peces">Peces</option>
      </select>
      
      <label for="motivo">Motivo:</label>
      <textarea id="motivo" name="motivo" required></textarea>
      
      <button type="submit">Insertar Consulta</button>
    </form>
    
    <?php if (!empty($mensaje)) { ?>
      <p><?php echo $mensaje; ?></p>
    <?php } ?>


    <div class="consulta-container">
  <h2>Verificar Consulta</h2>
  <form action="obtener_consulta.php" method="POST">
    <label for="consulta-id">ID de consulta:</label>
    <input type="text" id="consulta-id" name="consulta-id" required>
    <button type="submit">Verificar</button>
  </form>
</div>
  </div>

</body>
</html>
