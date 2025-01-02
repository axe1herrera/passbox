
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Identificarse</title>
    <link rel="stylesheet" href="<?=base_url().'css/output.css'?>">
    <link rel="shortcut icon" type="image/png" href="https://img.icons8.com/plumpy/24/password.png">
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
<!--Seccion para hacer el login-->
<div class="w-11/12 sm:w-full max-w-md p-4 sm:p-8 bg-white shadow-xl rounded-lg">
    <div class="flex justify-center mb-6">
        <svg class="w-16 h-16 sm:w-24 sm:h-24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M2 16C2 13.1716 2 11.7574 2.87868 10.8787C3.75736 10 5.17157 10 8 10H16C18.8284 10 20.2426 10 21.1213 10.8787C22 11.7574 22 13.1716 22 16C22 18.8284 22 20.2426 21.1213 21.1213C20.2426 22 18.8284 22 16 22H8C5.17157 22 3.75736 22 2.87868 21.1213C2 20.2426 2 18.8284 2 16Z" stroke="#1C274C" stroke-width="1.5"></path>
            <path opacity="0.5" d="M6 10V8C6 4.68629 8.68629 2 12 2C15.3137 2 18 4.68629 18 8V10" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path>
            <g opacity="0.5">
                <path d="M9 16C9 16.5523 8.55228 17 8 17C7.44772 17 7 16.5523 7 16C7 15.4477 7.44772 15 8 15C8.55228 15 9 15.4477 9 16Z" fill="#1C274C"></path>
                <path d="M13 16C13 16.5523 12.5523 17 12 17C11.4477 17 11 16.5523 11 16C11 15.4477 11.4477 15 12 15C12.5523 15 13 15.4477 13 16Z" fill="#1C274C"></path>
                <path d="M17 16C17 16.5523 16.5523 17 16 17C15.4477 17 15 16.5523 15 16C15 15.4477 15.4477 15 16 15C16.5523 15 17 15.4477 17 16Z" fill="#1C274C"></path>
            </g>
        </svg>
    </div>
    <h1 class="text-lg sm:text-2xl font-bold text-center mb-6">Identificarse</h1>
    <?php if (session()->getFlashdata('error')) : ?>
        <div class="mb-4 text-red-500"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
    <form action="/auth/loginUser" method="POST">
        <div class="mb-4">
            <label class="block text-sm sm:text-base text-gray-700">Correo electrónico</label>
            <input type="email" name="correo" required class="w-full px-3 sm:px-4 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
        </div>
        <div class="mb-4">
            <label class="block text-sm sm:text-base text-gray-700">Clave Maestra</label>
            <input type="password" name="clave_maestra" required class="w-full px-3 sm:px-4 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
        </div>
        <button type="submit" class="w-full py-2 bg-blue-800 text-white rounded hover:bg-blue-700 transition">Continuar</button>
    </form>
    <div class="text-center mt-4">
        <a href="/auth/register" class="text-blue-500 hover:underline">¿No tienes una cuenta? Regístrate aquí</a>
    </div>
</div>
</body>
</html>


