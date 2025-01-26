<?php
session_start();
require './class/Connection.php';

// Redirigir al dashboard correspondiente cuando se inicie la sesión, si el usuario es administrador o usuario final
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] === 'admin') {
        header("Location: admin_dashboard.php");
    } else {
        header("Location: user_account.php");
    }
    exit();
}

// Para obtener los alojamientos
$stmt = $pdo->query("SELECT * FROM accommodations");
$accommodations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            /**background-color:rgba(0, 0, 0, 0.86);*/
            background-image: url(https://i.pinimg.com/736x/b1/25/e3/b125e38d87ce70ca61eda71601472def.jpg);
        }
        h2, h3 {
            color:rgb(255, 255, 255);
        }
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        .btn-primary {
            background-color:rgb(0, 0, 0);
            border-color: #0d6efd;
        }
        .btn-primary:hover {
            background-color: #0b5ed7;
            border-color:rgb(28, 60, 108);
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Bienvenidos/as a KodiAlojamientos</h2>
    <div class="row">
        <!-- Sección exclusiva para que nos aparezcan todos los alojamientos que estan disponibles en nuestra bd o los nuevos que cree el administrador -->
        <div class="col-lg-8">
            <h3>Alojamientos Disponibles</h3>
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <?php foreach ($accommodations as $accommodation): ?>
                    <div class="col">
                        <div class="card h-100 shadow-sm rounded-3">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($accommodation['name']) ?></h5>
                                <p class="card-text">Ubicación: <?= htmlspecialchars($accommodation['location']) ?></p>
                                <p class="card-text"><strong>Precio: $<?= htmlspecialchars($accommodation['price']) ?></strong></p>
                                <a href="#" class="btn btn-primary btn-sm">Ver más</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Para que aparezca nuestro login y podamos iniciar sesión o registrarnos -->
        <div class="col-lg-4">
            <h3 class="text-center">Iniciar Sesión</h3>
            <div class="card shadow-lg rounded-3">
                <div class="card-body">
                    <form action="login.php" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Ingresa tu nombre de Usuario:</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
                    </form>
                    <p class="text-center mt-3">¿No tienes cuenta? <a href="register.php" class="text-primary">Regístrate aquí</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
