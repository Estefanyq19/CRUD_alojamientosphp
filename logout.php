<?php
// logout.php: Finaliza la sesión del usuario
session_start();
session_unset();
session_destroy();

// Redirige al usuario a la página principal
header('Location: index.php');
exit;
?>
