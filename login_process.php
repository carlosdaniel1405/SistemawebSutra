<?php
session_start();
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuario WHERE usuario='$username' AND contraseña='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header('Location: menu_principal.php');
    } else {
        echo "Usuario o contraseña incorrectos.";
    }
} else {
    header('Location: login.php');
}
?>