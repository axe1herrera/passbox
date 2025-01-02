
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Registro</title>
    <link rel="stylesheet" href="<?=base_url().'css/output.css'?>">
    <link rel="shortcut icon" type="image/png" href="https://img.icons8.com/plumpy/24/password.png">
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
<div class="w-11/12 sm:w-full max-w-md p-4 sm:p-8 bg-white shadow-lg rounded-lg">
    <div class="flex justify-center mb-6">
        <svg class="w-16 h-16 sm:w-24 sm:h-24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">-->
                        <circle cx="12" cy="6" r="4" stroke="#1C274C" stroke-width="1.5"></circle>
                        <path opacity="0.5" d="M15 13.3271C14.0736 13.1162 13.0609 13 12 13C7.58172 13 4 15.0147 4 17.5C4 19.9853 4 22 12 22C17.6874 22 19.3315 20.9817 19.8068 19.5" stroke="#1C274C" stroke-width="1.5"></path>
                        <circle cx="18" cy="16" r="4" stroke="#1C274C" stroke-width="1.5"></circle>
                        <path d="M18 14.6667V17.3333" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path>
                        <path d="M16.6665 16L19.3332 16" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path>
                    </svg>

    </div>
    <h1 class="text-lg sm:text-2xl font-bold text-center mb-6">Registro</h1>
<!--    --><?php //if (session()->getFlashdata('error')) : ?>
<!--        <div class="mb-4 text-red-500">--><?php //= session()->getFlashdata('error') ?><!--</div>-->
<!--    --><?php //endif; ?>
    <?php if (session()->getFlashdata('error')) : ?>
        <div class="mb-4 text-red-500"><?= session()->getFlashdata('error') ?></div>
    <?php elseif (session()->getFlashdata('success')) : ?>
        <div class="mb-4 text-green-500"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <form action="/auth/registerUser" method="POST">
        <div class="mb-4">
            <label class="block text-sm sm:text-base text-gray-700">Nombre</label>
            <input type="text" name="nombre" required class="w-full px-3 sm:px-4 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
        </div>
        <div class="mb-4">
            <label class="block text-sm sm:text-base text-gray-700">Correo electrónico</label>
            <input type="email" name="correo" required class="w-full px-3 sm:px-4 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
        </div>
        <div class="mb-4">
            <label class="block text-sm sm:text-base text-gray-700">Clave Maestra</label>
            <input type="password" id="clave_maestra" name="clave_maestra" required class="w-full px-3 sm:px-4 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
        </div>
<!--        Checkbox-->
        <div class="flex items-center mb-8">
            <input type="checkbox" id="show_password" class="mr-2">
            <label for="show_password" class="text-sm text-gray-700">Mostrar clave maestra</label>
        </div>
        <div class="mb-4">
            <label class="block text-sm sm:text-base text-gray-700">Confirmar Clave Maestra</label>
            <input type="password" id="clave_confirmacion" name="clave_confirmacion" required class="w-full px-3 sm:px-4 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
        </div>
<!--        checkbox-->
        <div class="flex items-center mb-8">
            <input type="checkbox" id="show_password2" class="mr-2">
            <label for="show_password2" class="text-sm text-gray-700">Mostrar clave maestra</label>
        </div>
        <div class="mb-4">
            <label class="block text-sm sm:text-base text-gray-700">Pista Clave</label>
            <input type="text" name="pista_clave" class="w-full px-3 sm:px-4 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
        </div>
        <button type="submit" class="w-full py-2 bg-blue-800 text-white rounded hover:bg-blue-700 transition">Registrar</button>
    </form>
    <div class="text-center mt-4">
        <a href="/auth/login" class="text-blue-500 hover:underline">¿Ya tienes una cuenta? Inicia sesión aquí</a>
    </div>
</div>
<script>
    document.getElementById('show_password').addEventListener('change', function () {
        var passwordField = document.getElementById('clave_maestra');
        if (this.checked) {
            passwordField.type = 'text';  // Cambiar a tipo 'text' para mostrar la contraseña
        } else {
            passwordField.type = 'password';  // Volver a tipo 'password' para ocultarla
        }
    });
</script>

<script>
    document.getElementById('show_password2').addEventListener('change', function () {
        var passwordField = document.getElementById('clave_confirmacion');
        if (this.checked) {
            passwordField.type = 'text';  // Cambiar a tipo 'text' para mostrar la contraseña
        } else {
            passwordField.type = 'password';  // Volver a tipo 'password' para ocultarla
        }
    });
</script>
</body>
</html>



