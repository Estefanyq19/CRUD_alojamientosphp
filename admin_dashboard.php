<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit;
}

require './class/Connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $price = $_POST['price'];

    $stmt = $pdo->prepare("INSERT INTO accommodations (name, location, price) VALUES (?, ?, ?)");
    $stmt->execute([$name, $location, $price]);
    header('Location: admin_dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('https://i.pinimg.com/736x/5d/fd/bd/5dfdbde46fed9f84cad89af4546539ab.jpg');
        }

        h2, h4 {
            color: #ffffff;
        }

        .container {
            background: rgba(0, 0, 0, 0.95);
            padding: 30px;
            border-radius: 8px;
        }

        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0b5ed7;
        }

        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .list-group-item {
            background-color: transparent;
            color: #fff;
        }

        .form-control {
            border-radius: 0.5rem;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center">
        <h2>Panel de Administrador</h2>
        <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
    </div>
    <form action="admin_dashboard.php" method="POST" class="mt-4">
        <div class="mb-3">
            <label for="name" class="form-label text-white">Nombre del Alojamiento</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label text-white">Ubicación</label>
            <input type="text" class="form-control" id="location" name="location" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label text-white">Precio</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <button type="submit" class="btn btn-primary">Agregar Alojamiento</button>
    </form>

    <div class="mt-5">
        <h4>Alojamientos Disponibles</h4>
        <ul class="list-group">
            <?php
            $stmt = $pdo->query("SELECT * FROM accommodations");
            $accommodations = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($accommodations as $accommodation): ?>
                <li class="list-group-item"><?= htmlspecialchars($accommodation['name']) ?> - <?= htmlspecialchars($accommodation['location']) ?> ($<?= htmlspecialchars($accommodation['price']) ?>)</li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
