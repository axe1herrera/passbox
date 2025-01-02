
    <div class="flex gap-6">
        <!-- Primer contenedor (Opciones de usuario) -->
        <div class="ml-4 w-full lg:w-[30%]">
            <div class="bg-white shadow-md rounded-lg p-4">
                <h2 class="text-lg font-bold mb-4">Opciones</h2>

                <form method="GET" action="<?= base_url('buscar') ?>" class="mb-6">
                    <label for="search" class="block text-sm font-medium text-gray-700">Buscar elemento</label>
                    <div class="flex items-center mt-2">
                        <input
                                type="text"
                                name="query"
                                id="search"
                                placeholder="Buscar por nombre..."
                                class="flex-1 p-2 border rounded"
                                required>
                        <button
                                type="submit"
                                class="ml-2 bg-blue-800 text-white px-4 py-2 rounded hover:bg-blue-900">
                            Buscar
                        </button>
                    </div>
                </form>



                <!-- Ver cajas fuertes -->
                <a href="<?= base_url('cajas_fuertes') ?>"
                   class="block p-2 mb-4 bg-blue-800 text-white text-center rounded hover:bg-blue-900">
                    Ver Cajas Fuertes
                </a>

                <a href="javascript:void(0);" id="openCreateVaultModal"
                   class="block p-2 mb-4 bg-green-600 text-white text-center rounded hover:bg-green-700">
                    Crear Nueva Caja Fuerte
                </a>

                <a href="javascript:void(0);" onclick="filterByType('Login')" class="flex gap-x-2 p-2 mb-2 text-black text-center rounded hover:text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 3.03v.568c0 .334.148.65.405.864l1.068.89c.442.369.535 1.01.216 1.49l-.51.766a2.25 2.25 0 0 1-1.161.886l-.143.048a1.107 1.107 0 0 0-.57 1.664c.369.555.169 1.307-.427 1.605L9 13.125l.423 1.059a.956.956 0 0 1-1.652.928l-.679-.906a1.125 1.125 0 0 0-1.906.172L4.5 15.75l-.612.153M12.75 3.031a9 9 0 0 0-8.862 12.872M12.75 3.031a9 9 0 0 1 6.69 14.036m0 0-.177-.529A2.25 2.25 0 0 0 17.128 15H16.5l-.324-.324a1.453 1.453 0 0 0-2.328.377l-.036.073a1.586 1.586 0 0 1-.982.816l-.99.282c-.55.157-.894.702-.8 1.267l.073.438c.08.474.49.821.97.821.846 0 1.598.542 1.865 1.345l.215.643m5.276-3.67a9.012 9.012 0 0 1-5.276 3.67m0 0a9 9 0 0 1-10.275-4.835M15.75 9c0 .896-.393 1.7-1.016 2.25" />
                    </svg>
                    Inicios de sesión
                </a>
                <a href="javascript:void(0);" onclick="filterByType('Tarjeta')" class="flex gap-x-2 p-2 mb-2 text-black text-center rounded hover:text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                    </svg>
                    Tarjetas
                </a>

                <!-- Botón "Identidades" -->
                <a href="javascript:void(0);" onclick="filterByType('Identidad')" class="flex gap-x-2 p-2 mb-2 text-black text-center rounded hover:text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                    </svg>
                    Identidades
                </a>

                <!-- Botón "Notas" -->
                <a href="javascript:void(0);" onclick="filterByType('Nota')" class="flex gap-x-2 p-2 mb-2 text-black text-center rounded hover:text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                    Notas
                </a>
            </div>

        </div>
        <div class="mr-4 w-full lg:w-[70%]">
            <div class="grid grid-cols-1 gap-6">
                <?php

                $selectedVaultId = session()->get('selectedVaultId');

                // Verifica si hay un valor en la sesión
                if ($selectedVaultId) {
                    // Filtra las cajas fuertes para encontrar la seleccionada usando el vaultId de la sesión
                    $miCaja = array_filter($cajas_fuertes, function ($caja) use ($selectedVaultId) {
                        return $caja['vault_id'] == $selectedVaultId; // Compara el ID de la caja seleccionada
                    });

                    $miCaja = array_shift($miCaja); // Obtiene la primera coincidencia
                } else {
                    // Si no se ha seleccionado ninguna caja, muestra la caja por defecto
                    $miCaja = array_filter($cajas_fuertes, function ($caja) {
                        return $caja['nombre'] === 'Mi caja fuerte';
                    });

                    $miCaja = array_shift($miCaja); // Obtiene la primera coincidencia
                }

                if (!empty($miCaja)):
                    ?>
                    <div class="bg-white shadow-md rounded-lg p-4">
                        <h2 class="text-lg font-bold mb-4"><?= esc($miCaja['nombre']) ?></h2>

                        <?php if (!empty($entradas[$miCaja['vault_id']])): ?>
                            <table class="table-auto w-full border-collapse border border-gray-200">
                                <thead>
                                <tr class="bg-gray-200">
                                    <th class="border border-gray-300 px-4 py-2 text-left">Nombre</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Tipo</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Editar</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($entradas[$miCaja['vault_id']] as $entrada): ?>
                                    <tr data-type="<?= esc($entrada['tipo']) ?>">
                                        <td class="px-4 py-2"><?= esc($entrada['nombre']) ?></td>
                                        <td class="px-4 py-2"><?= esc($entrada['tipo']) ?></td>
                                        <td class="px-0 py-2 flex justify-center">
                                            <?php
                                            // Establece la ruta según el tipo de entrada
                                            $ruta = '';
                                            switch ($entrada['tipo']) {
                                                case 'Nota':
                                                    $ruta = '/nota/cargar/' . $entrada['entrada_id'];
                                                    break;
                                                case 'Identidad':
                                                    $ruta = '/identidad/cargar/' . $entrada['entrada_id'];
                                                    break;
                                                case 'Tarjeta':
                                                    $ruta = '/tarjeta/cargar/' . $entrada['entrada_id'];
                                                    break;
                                                case 'Login':
                                                    $ruta = '/login/cargar/' . $entrada['entrada_id'];
                                                    break;
                                                default:
                                                    $ruta = '/entrada/cargar/' . $entrada['entrada_id']; // Ruta predeterminada
                                                    break;
                                            }
                                            ?>
                                            <a href="<?= $ruta ?>"
                                               class="bg-yellow-500 text-white py-1 px-8 rounded-xl flex items-center justify-center w-auto">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-2">
                                                    <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z"/>
                                                    <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z"/>
                                                </svg>
                                                Editar
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p class="text-gray-500">Sin entradas disponibles.</p>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <p class="text-gray-500">No se encontró la caja seleccionada.</p>
                <?php endif; ?>

            </div>


        <!-- Modal -->
        <div id="vaultModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden z-50">
            <div class="bg-white rounded-lg p-6 w-96">
                <div class="flex justify-between items-center">
                    <h5 class="text-lg font-semibold">Cajas Fuertes</h5>
                    <button id="closeModal" class="text-gray-500 hover:text-gray-700">&times;</button>
                </div>
                <div class="mt-4">
                    <?php if (!empty($cajas_fuertes)): ?>
                        <ul class="space-y-4">
                            <?php foreach ($cajas_fuertes as $caja): ?>
                                <li class="flex justify-between items-center border-b pb-3">
                                    <div>
                                        <strong class="text-gray-700">Nombre:</strong> <?= esc($caja['nombre']) ?><br>
                                    </div>
                                    <!-- Enlace con parámetro GET para enviar el vaultId al servidor -->
                                    <a href="<?= site_url('select-vault/' . $caja['vault_id']) ?>" class="text-blue-600 hover:text-blue-800">
                                        Seleccionar
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>No tienes cajas fuertes.</p>
                    <?php endif; ?>
                </div>
                <div class="mt-6 text-right">
                    <button id="closeModalBtn" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Cerrar</button>
                </div>
            </div>
        </div>

            <!-- Modal para Crear Nueva Caja Fuerte -->
            <div id="createVaultModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden z-50">
                <div class="bg-white rounded-lg p-6 w-96">
                    <div class="flex justify-between items-center">
                        <h5 class="text-lg font-semibold">Crear Nueva Caja Fuerte</h5>
                        <button id="closeCreateVaultModal" class="text-gray-500 hover:text-gray-700">&times;</button>
                    </div>
                    <div class="mt-4">
                        <!-- Formulario para crear nueva caja fuerte -->
                        <form action="<?= base_url('crear-caja-fuerte') ?>" method="POST">
                            <div class="mb-4">
                                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre de la Caja Fuerte</label>
                                <input type="text" id="nombre" name="nombre" class="mt-2 p-2 border rounded w-full" required>
                            </div>
                            <div class="mt-6 text-right">
                                <button type="submit" class="bg-blue-800 text-white px-4 py-2 rounded hover:bg-blue-900">Crear</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Script para abrir y cerrar el modal -->
            <script>
                // Mostrar el modal cuando se hace clic en "Crear Nueva Caja Fuerte"
                document.getElementById('openCreateVaultModal').addEventListener('click', function() {
                    document.getElementById('createVaultModal').classList.remove('hidden');
                });

                // Cerrar el modal
                document.getElementById('closeCreateVaultModal').addEventListener('click', function() {
                    document.getElementById('createVaultModal').classList.add('hidden');
                });
            </script>


            <script>
            function filterByType(type) {
                // Obtener todas las filas
                var rows = document.querySelectorAll('table tbody tr');
                rows.forEach(function(row) {
                    // Si el data-type coincide con el tipo seleccionado, mostrar la fila, de lo contrario ocultarla
                    if (row.getAttribute('data-type') === type || type === 'All') {
                        row.style.display = ''; // Mostrar la fila
                    } else {
                        row.style.display = 'none'; // Ocultar la fila
                    }
                });
            }
        </script>

