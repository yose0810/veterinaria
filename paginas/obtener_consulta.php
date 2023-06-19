<?php
// Obtener la ID de consulta enviada desde el formulario
$id = $_POST['consulta-id'];

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

// Preparar la consulta SQL para obtener los datos de la consulta
$sql = "SELECT * FROM consultas WHERE ID = '$id'";
$result = $conn->query($sql);

// Establecer el estilo CSS
echo '<style>
body {
  background: linear-gradient(135deg, #044997, #1B7087);
  font-family: Arial, sans-serif;
  margin: 0;
}

.content-container {
  background-color: #F7FFFF;
  width: 70%;
  margin: 20px auto;
  padding: 20px;
  box-sizing: border-box;
  border-radius: 10px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

h2 {
  color: #003D59;
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 20px;
  text-align: center;
}

label {
  font-weight: bold;
  margin-bottom: 10px;
}

input,
select,
textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #CCCCCC;
  border-radius: 5px;
  margin-bottom: 20px;
  box-sizing: border-box;
  font-size: 16px;
}

button[type="submit"] {
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 5px;
  padding: 10px 20px;
  font-size: 16px;
  cursor: pointer;
}

button[type="submit"]:hover {
  background-color: #45a049;
}
</style>';

// Mostrar el contenido HTML


if ($result->num_rows > 0) {
    // La consulta fue encontrada, mostrar los datos
    $row = $result->fetch_assoc();
    echo "<h2>Datos de la consulta con ID: " . $row['ID'] . "</h2>";
    echo "<label>Dueño:</label> " . $row['Dueño'] . "<br>";
    echo "<label>Mascota:</label> " . $row['Mascota'] . "<br>";
    echo "<label>Especie:</label> " . $row['Especie'] . "<br>";
    echo "<label>Motivo:</label> " . $row['Motivo'] . "<br>";
} else {
    // La consulta no fue encontrada
    echo "<h2>No se encontró la consulta con ID: " . $id . "</h2>";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
