


<br><br><br><br><br>

<?php
// Conectar a la base de datos (asegúrate de tener el archivo de conexión)
include_once "db_connection.php";

// Inicializar la variable de consulta
$consulta = "";

// Verificar si se ha enviado el formulario de búsqueda
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["btnbuscar"])) {
    // Recuperar el valor de búsqueda
    $consulta = $_POST["txtconsulta"];

    // Consulta SQL con filtro
    $sql = "SELECT
                mes,
                IF(estado, '✔', '') AS estado,
                año,
                observacion
            FROM personal
            WHERE codigo LIKE '%$consulta%' OR nombres LIKE '%$consulta%' OR mes LIKE '%$consulta%' OR año LIKE '%$consulta%'";
} else {
    // Consulta SQL sin filtro (mostrar todos los datos)
    $sql = "SELECT
                mes,
                IF(estado, '✔', '') AS estado,
                año,
                observacion
            FROM personal";
}

// Ejecutar la consulta
$result = $conn->query($sql);

// Inicializar las variables para almacenar la cantidad total de "checks" en estado y la suma total de observacion
$totalEstado = 0;
$totalObservacion = 0;

// Verificar si se obtuvieron resultados
if ($result->num_rows > 0) {
    // Mostrar resultados en una tabla con estilos
    echo "<table border='1' style='width: 80%; margin: auto; background-color: #f2f2f2; margin-top: 20px;'>
            <tr>
                <th>Mes</th>
                <th>Estado</th>
                <th>Año</th>
                <th>Pago</th>
            </tr>";

    // Iterar sobre los resultados y mostrar en la tabla
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['mes']}</td>
                <td>{$row['estado']}</td>
                <td>{$row['año']}</td>
                <td>{$row['observacion']}</td>
            </tr>";

        // Sumar 1 al total de "checks" en estado
        if ($row['estado'] == '✔') {
            $totalEstado++;
        }

        // Sumar el valor de observacion al total de observaciones
        $totalObservacion += intval($row['observacion']);
    }

    echo "</table>";

    // Mostrar la cantidad total de "checks" en estado en un label centrado y con color
    echo "<label style='text-align: center; color: green; margin-top: 10px; display: block;'>Aporte de Años : $totalEstado</label>";

    // Mostrar la suma total de observacion en un label centrado y con color
    echo "<label style='text-align: center; color: blue; margin-top: 10px; display: block;'>Total : $totalObservacion</label>";
} else {
    // No se encontraron resultados
    echo "<p style='text-align: center; color: red; margin-top: 20px;'>No se encontraron resultados.</p>";
}

// Liberar resultados
$result->free_result();

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Personas</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }

        form {
            width: 300px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input, button {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        table {
            width: 80%;
            margin-top: 20px;
            margin-bottom: 20px;
            border-collapse: collapse;
            background-color: #fff;
        }

        table, th, td {
            border: 1px solid #fff;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        p {
            text-align: center;
            color: red;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <form action="consultar_persona.php" method="post">
        <label for="txtconsulta">Consulta:</label>
        <input type="text" id="txtconsulta" name="txtconsulta" value="<?php echo $consulta; ?>">
        <button type="submit" name="btnbuscar">Buscar</button>
    </form>

</body>
</html>



