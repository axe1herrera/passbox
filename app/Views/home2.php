<div class="flex gap-6 items-center justify-center">
    <!-- Primer contenedor (Opciones de usuario) -->

    <!-- Segundo contenedor (Resultados de búsqueda) -->
    <div class="w-full lg:w-3/4">
        <div class="grid grid-cols-1 gap-6">
            <?php
            // Verifica si se pasó algún resultado de la búsqueda
            if (isset($resultados) && !empty($resultados)) :
                ?>
                <div class="bg-white shadow-md rounded-lg p-4">
                    <h2 class="text-lg font-bold mb-4">Resultados de la Búsqueda</h2>
                    <table class="table-auto w-full border-collapse border border-gray-200">
                        <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 px-4 py-2 text-left">Nombre</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Tipo</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Editar</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($resultados as $entrada): ?>
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
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                             class="w-5 h-5 mr-2">
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
                </div>
            <?php elseif (isset($mensaje)): ?>
                <p class="text-gray-500 text-center mt-20"><?= esc($mensaje) ?></p> <!-- Muestra el mensaje si no se encuentran resultados -->
            <?php else: ?>
                <!-- Si no se han encontrado resultados, muestra la tabla vacía -->
                <div class="bg-white shadow-md rounded-lg p-4">
                    <h2 class="text-lg font-bold mb-4">Resultados de la Búsqueda</h2>
                    <table class="table-auto w-full border-collapse border border-gray-200">
                        <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 px-4 py-2 text-left">Nombre</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Tipo</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Editar</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr >
                            <td colspan="3" class="px-4 py-2 text-center text-gray-500">No se encontraron resultados.
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>


