<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header('Location: index.php');
    exit;
}

require './class/Connection.php';
$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT a.* FROM accommodations a
                        JOIN user_accommodations ua ON a.id = ua.accommodation_id
                        WHERE ua.user_id = ?");
$stmt->execute([$user_id]);
$selected_accommodations = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT * FROM accommodations WHERE id NOT IN (SELECT accommodation_id FROM user_accommodations WHERE user_id = ?)");
$stmt->execute([$user_id]);
$available_accommodations = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_accommodation'])) {
        $accommodation_id = $_POST['add_accommodation'];
        $stmt = $pdo->prepare("INSERT INTO user_accommodations (user_id, accommodation_id) VALUES (?, ?)");
        $stmt->execute([$user_id, $accommodation_id]);
        header('Location: user_account.php');
        exit;
    } elseif (isset($_POST['remove_accommodation'])) {
        $accommodation_id = $_POST['remove_accommodation'];
        $stmt = $pdo->prepare("DELETE FROM user_accommodations WHERE user_id = ? AND accommodation_id = ?");
        $stmt->execute([$user_id, $accommodation_id]);
        header('Location: user_account.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi cuenta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('https://i.pinimg.com/736x/02/22/06/02220693482f37f03ad4d38375bdd89b.jpg');
            font-family: 'Arial', sans-serif;
        }

        .container {
            max-width: 1000px;
            margin-top: 40px;
        }

        h2, h4 {
            color:rgb(255, 255, 255);
        }
        p{
            color: black;
        }
        .parraf{
            color: #ffff;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 20px;
        }
        .btn-primary, .btn-danger {
            border-radius: 8px;
            transition: all 0.3s;
        }

        .btn-primary:hover, .btn-danger:hover {
            opacity: 0.8;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: bold;
        }

        .text-center a {
            color:rgb(255, 0, 0);
        }

        .text-center a:hover {
            text-decoration: underline;
        }

        .row {
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 0 15px;
            }

            .col-md-4 {
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>BIENVENIDO/A</h2>
        <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
    </div>

    <h4>Alojamientos Seleccionados</h4>
    <div class="row">
        <?php if (count($selected_accommodations) > 0): ?>
            <?php foreach ($selected_accommodations as $accommodation): ?>
                <div class="col-md-4 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($accommodation['name']) ?></h5>
                            <p class="card-text">Ubicación: <?= htmlspecialchars($accommodation['location']) ?></p>
                            <p class="card-text">Precio: $<?= htmlspecialchars($accommodation['price']) ?></p>
                            <form method="POST">
                                <button type="submit" name="remove_accommodation" value="<?= $accommodation['id'] ?>" class="btn btn-danger w-100">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="parraf">No has seleccionado ningún alojamiento.</p>
        <?php endif; ?>
    </div>

    <h4>Alojamientos Disponibles</h4>
    <div class="row">
        <?php foreach ($available_accommodations as $accommodation): ?>
            <div class="col-md-4 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($accommodation['name']) ?></h5>
                        <p class="card-text">Ubicación: <?= htmlspecialchars($accommodation['location']) ?></p>
                        <p class="card-text">Precio: $<?= htmlspecialchars($accommodation['price']) ?></p>
                        <form method="POST">
                            <button type="submit" name="add_accommodation" value="<?= $accommodation['id'] ?>" class="btn btn-primary w-100">Agregar</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
