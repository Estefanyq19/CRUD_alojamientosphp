<?php
// register.php: Página de registro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require './class/Connection.php';

    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_POST['email'];

    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
        $stmt->execute([$username, $password, $email]);
        header('Location: index.php');
        exit;
    } catch (PDOException $e) {
        echo "Error al registrar usuario: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('https://i.pinimg.com/736x/2c/2f/a4/2c2fa443aa32ede78903bc18ca0aadc9.jpg');
        }

        .container {
            max-width: 600px;
            margin-top: 50px;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 4px 6px rgb(201, 86, 86);
        }

        .card-body {
            padding: 30px;
        }

        h2 {
            color:rgb(255, 255, 255);
            font-weight: bold;
        }

        .form-control {
            border-radius: 8px;
        }

        .btn-success {
            background-color:rgb(0, 0, 0);
            border-color: rgb(201, 86, 86);
            transition: background-color 0.3s, border-color 0.3s;
        }

        .btn-success:hover {
            background-color: rgb(201, 86, 86);
            border-color:rgb(0, 0, 0);
        }

        .text-center a {
            color:rgb(13, 0, 255);
        }

        .text-center a:hover {
            text-decoration: underline;
        }

        @media (max-width: 576px) {
            .container {
                padding: 0 15px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center">Crea tu cuenta</h2>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="register.php" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Nombre de Usuario:</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Registrarse</button>
                    </form>
                    <p class="text-center mt-3">¿Ya tienes cuenta? <a href="index.php">Inicia sesión aquí</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
