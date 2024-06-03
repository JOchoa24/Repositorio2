<?php
require '../config/db.php';

// Recibir datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Buscar usuario por nombre de usuario
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if (!$user || !password_verify($password, $user['password'])) {
        echo "Usuario o contraseña incorrectos.";
        exit();
    }

    echo "Autenticación satisfactoria.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
</head>
<body>
    <form action="login.php" method="POST">
        <label for="username">Usuario:</label>
        <input type="text" name="username" required>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" required>
        <button type="submit">Iniciar Sesión</button>
    </form>
</body>
</html>
