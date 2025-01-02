<?php
// Iniciar la sesión en el servidor
session_start();

// Verificar si se ha enviado el valor de vaultId
if (isset($_GET['vaultId'])) {
    // Guardar el vaultId en la sesión
    $_SESSION['selectedVaultId'] = $_GET['vaultId'];

    // Redirigir al usuario a la página donde se mostrarán las entradas de la caja seleccionada
    // Cambia la URL a la página donde deseas mostrar las entradas de la caja
    header("Location: home.php"); // Redirige a la página de entradas
    exit();
} else {
    // Si no se ha recibido el vaultId, redirigir a una página de error o de listado
    header("Location: index.php"); // Cambia esta URL según corresponda
    exit();
}
?>
