


 <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4; /* Puedes ajustar el color de fondo según tu preferencia */
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50; /* Color verde - puedes ajustar según tu preferencia */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049; /* Cambia el color al pasar el ratón sobre el botón */
        }
    </style>

<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Recuperar los datos del formulario
    $codigo = $_POST["codigo"];
    $nombres = $_POST["nombres"];
    $mes = $_POST["mes"];
    $estado = isset($_POST["estado"]) ? 1 : 0; // Convertir a 1 si está marcado, 0 si no
    $año = $_POST["año"];
    $observacion = $_POST["observacion"];

    // Conectar a la base de datos (asegúrate de tener el archivo de conexión)
    include_once "db_connection.php";

    // Preparar la consulta SQL para la inserción
    $sql = "INSERT INTO personal (codigo, nombres, mes, estado, año, observacion) VALUES (?, ?, ?, ?, ?, ?)";

    // Preparar la sentencia
    $stmt = $conn->prepare($sql);

    // Vincular los parámetros
    $stmt->bind_param("sssiis", $codigo, $nombres, $mes, $estado, $año, $observacion);

    // Ejecutar la sentencia
    if ($stmt->execute()) {
        // Inserción exitosa
     

        // Agregar script JavaScript para mostrar una alerta, limpiar el formulario y deseleccionar el combo
     

         echo "<script>";
    echo "alert('Registro guardado exitosamente.');";
 



        echo "document.getElementById('codigo').value = '';"; // ID del campo de texto
        echo "document.getElementById('nombres').value = '';"; // ID del campo de texto
        echo "document.getElementById('mes').value = '';"; // ID del combo
        echo "document.getElementById('estado').checked = false;"; // ID del checkbox
        echo "document.getElementById('año').value = '';"; // ID del campo de texto
        echo "document.getElementById('observacion').value = '';"; // ID del campo de texto
        echo "window.location.href = 'persona.php';";

      

        echo "</script>";
    } else {
        // Error en la inserción
        echo "Error al guardar el registro: " . $stmt->error;
    }

    // Cerrar la conexión
    $stmt->close();
    $conn->close();
} else {
    // Redireccionar si el formulario no ha sido enviado
    header("Location: persona.php");
    exit();
}
?>


<button onclick="window.location.href = 'persona.php';">Ir Registrar</button>

<button onclick="window.location.href = 'consultar_persona.php';">Consultar</button>