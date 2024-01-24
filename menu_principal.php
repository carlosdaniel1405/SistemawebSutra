<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0; 
        }

        .menu-container {
            width: 80%;
            max-width: 400px; 
            margin: 100px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .menu-container a {
            display: block;
            margin: 10px 0;
            padding: 10px;
            text-decoration: none;
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
            text-align: center;
            font-size: 14px; 
        }

        .menu-container a:hover {
            background-color: #0056b3;
        }
    </style>
    <title>Menú Principal</title>
</head>
<body>

    <div class="menu-container">
        <a href="persona.php">Registrar</a>
        <a href="consultar_persona.php">Consultar</a>
    </div>

</body>
</html>