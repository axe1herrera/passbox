<div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md mx-auto">
    <h1 class="text-2xl font-bold mb-4 text-center">Editar Identidad</h1>

    <!-- Mensaje de éxito -->
    <?php if (session()->getFlashdata('success')): ?>
        <div id="success-alert" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded mb-4 flex justify-between items-center">
            <span><?= session()->getFlashdata('success') ?></span>
            <button onclick="document.getElementById('success-alert').remove();" class="text-green-700 font-bold focus:outline-none ml-4">&times;</button>
        </div>
    <?php endif; ?>

    <!-- Mensajes de error -->
    <?php if (session()->get('errors')): ?>
        <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
            <ul>
                <?php foreach (session()->get('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Formulario de edición de la identidad -->
    <form action="/identidad/guardar/<?= esc($entrada['entrada_id']) ?>" method="POST" class="space-y-4">
        <?= csrf_field() ?>

        <!-- Campo de nombre de la entrada -->
        <div>
            <label for="nombre" class="block text-sm font-medium">Nombre de la entrada</label>
            <input type="text" id="nombre" name="nombre" class="w-full border rounded p-2" value="<?= esc($entrada['nombre']) ?>" required>
        </div>

        <!-- Título -->
        <div>
            <label for="titulo" class="block text-sm font-medium">Título</label>
            <input type="text" id="titulo" name="titulo" placeholder="Título de la identidad" class="w-full border rounded p-2" value="<?= esc($identidad['titulo']) ?>">
        </div>

        <!-- Primer nombre -->
        <div>
            <label for="primer_nombre" class="block text-sm font-medium">Primer nombre</label>
            <input type="text" id="primer_nombre" name="primer_nombre" placeholder="Tu primer nombre" class="w-full border rounded p-2" value="<?= esc($identidad['primer_nombre']) ?>" required>
        </div>

        <!-- Segundo nombre -->
        <div>
            <label for="segundo_nombre" class="block text-sm font-medium">Segundo nombre</label>
            <input type="text" id="segundo_nombre" name="segundo_nombre" placeholder="Tu segundo nombre (opcional)" class="w-full border rounded p-2" value="<?= esc($identidad['segundo_nombre']) ?>">
        </div>

        <!-- Apellidos -->
        <div>
            <label for="apellidos" class="block text-sm font-medium">Apellidos</label>
            <input type="text" id="apellidos" name="apellidos" placeholder="Tus apellidos" class="w-full border rounded p-2" value="<?= esc($identidad['apellidos']) ?>" required>
        </div>

        <!-- Empresa -->
        <div>
            <label for="empresa" class="block text-sm font-medium">Empresa</label>
            <input type="text" id="empresa" name="empresa" placeholder="Nombre de la empresa (opcional)" class="w-full border rounded p-2" value="<?= esc($identidad['empresa']) ?>">
        </div>

        <!-- NSS -->
        <div>
            <label for="nss" class="block text-sm font-medium">NSS</label>
            <input type="text" id="nss" name="nss" placeholder="Número de Seguridad Social" class="w-full border rounded p-2" value="<?= esc($identidad['nss']) ?>">
        </div>

        <!-- Pasaporte -->
        <div>
            <label for="pasaporte" class="block text-sm font-medium">Pasaporte</label>
            <input type="text" id="pasaporte" name="pasaporte" placeholder="Número de pasaporte" class="w-full border rounded p-2" value="<?= esc($identidad['pasaporte']) ?>">
        </div>

        <!-- Licencia -->
        <div>
            <label for="licencia" class="block text-sm font-medium">Licencia</label>
            <input type="text" id="licencia" name="licencia" placeholder="Número de licencia" class="w-full border rounded p-2" value="<?= esc($identidad['licencia']) ?>">
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium">Email</label>
            <input type="email" id="email" name="email" placeholder="correo@ejemplo.com" class="w-full border rounded p-2" value="<?= esc($identidad['email']) ?>">
        </div>

        <!-- Teléfono -->
        <div>
            <label for="telefono" class="block text-sm font-medium">Teléfono</label>
            <input type="text" id="telefono" name="telefono" placeholder="+34 123 456 789" class="w-full border rounded p-2" value="<?= esc($identidad['telefono']) ?>">
        </div>

        <!-- Dirección 1 -->
        <div>
            <label for="direccion_1" class="block text-sm font-medium">Dirección 1</label>
            <input type="text" id="direccion_1" name="direccion_1" placeholder="Calle Principal 123" class="w-full border rounded p-2" value="<?= esc($identidad['direccion_1']) ?>">
        </div>

        <!-- Dirección 2 -->
        <div>
            <label for="direccion_2" class="block text-sm font-medium">Dirección 2</label>
            <input type="text" id="direccion_2" name="direccion_2" placeholder="Apartamento, suite, etc." class="w-full border rounded p-2" value="<?= esc($identidad['direccion_2']) ?>">
        </div>

        <!-- Ciudad/Pueblo -->
        <div>
            <label for="ciudad_pueblo" class="block text-sm font-medium">Ciudad/Pueblo</label>
            <input type="text" id="ciudad_pueblo" name="ciudad_pueblo" placeholder="Tu ciudad" class="w-full border rounded p-2" value="<?= esc($identidad['ciudad_pueblo']) ?>">
        </div>

        <!-- Estado -->
        <div>
            <label for="estado" class="block text-sm font-medium">Estado</label>
            <input type="text" id="estado" name="estado" placeholder="Tu estado o provincia" class="w-full border rounded p-2" value="<?= esc($identidad['estado']) ?>">
        </div>

        <!-- Código Postal -->
        <div>
            <label for="codigo_postal" class="block text-sm font-medium">Código Postal</label>
            <input type="text" id="codigo_postal" name="codigo_postal" placeholder="12345" class="w-full border rounded p-2" value="<?= esc($identidad['codigo_postal']) ?>">
        </div>

        <!-- País -->
        <div>
            <label for="pais" class="block text-sm font-medium">País</label>
            <input type="text" id="pais" name="pais" placeholder="Tu país" class="w-full border rounded p-2" value="<?= esc($identidad['pais']) ?>">
        </div>

        <!-- Caja Fuerte -->
        <div>
            <label for="vault_id" class="block text-sm font-medium">Seleccionar Caja Fuerte</label>
            <select id="vault_id" name="vault_id" class="w-full border rounded p-2" required>
                <option value="" disabled <?= is_null($vaultId) ? 'selected' : '' ?>>Seleccione una caja fuerte</option>
                <?php foreach ($vaults as $vault): ?>
                    <option value="<?= $vault['vault_id'] ?>" <?= $vaultId == $vault['vault_id'] ? 'selected' : '' ?>>
                        <?= esc($vault['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Notas -->
        <div>
            <label for="notas" class="block text-sm font-medium">Notas</label>
            <textarea id="notas" name="notas" placeholder="Información adicional" class="w-full border rounded p-2"><?= esc($identidad['notas']) ?></textarea>
        </div>

        <!-- Pregunta clave -->
        <div>
            <label for="pregunta_clave" class="block text-sm font-medium">¿Volver a preguntar contraseña maestra?</label>
            <select id="pregunta_clave" name="pregunta_clave" class="w-full border rounded p-2">
                <option value="0" <?= $identidad['pregunta_clave'] == 0 ? 'selected' : '' ?>>No</option>
                <option value="1" <?= $identidad['pregunta_clave'] == 1 ? 'selected' : '' ?>>Sí</option>
            </select>
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">Guardar</button>
    </form>

    <!-- Botón para abrir el modal de eliminación -->
    <button type="button" onclick="openModal()" class="w-full bg-red-500 text-white p-2 rounded mt-4">
        Eliminar Identidad
    </button>

    <!-- Modal de confirmación -->
    <div id="confirmation-modal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white rounded-lg p-6 w-1/3">
            <h2 class="text-lg font-bold mb-4">¿Estás seguro?</h2>
            <p>Esta acción eliminará permanentemente la identidad. ¿Estás seguro de que deseas continuar?</p>
            <div class="mt-4 flex justify-end space-x-4">
                <button onclick="closeModal()" class="bg-gray-300 text-gray-700 p-2 rounded">Cancelar</button>
                <form id="delete-form" action="/identidad/eliminar/<?= esc($entrada['entrada_id']) ?>" method="POST">
                    <?= csrf_field() ?>
                    <button type="submit" class="bg-red-500 text-white p-2 rounded">Sí, Eliminar</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal de contraseña maestra -->
    <div id="password-modal" class="fixed inset-0 bg-white bg-opacity-100 flex justify-center items-center hidden">
        <div class="bg-white rounded-lg p-6 w-1/3 shadow-2xl">
            <h2 class="text-lg font-bold mb-4">Ingresar Contraseña Maestra</h2>
            <input type="text" id="master-password" placeholder="Contraseña maestra" class="w-full border rounded p-2 mb-4">
            <button id="submit-password" class="w-full bg-blue-500 text-white p-2 rounded">Aceptar</button>
        </div>
    </div>


</div>

<!-- Scripts para manejar el modal -->
<script>
    function openModal() {
        // Mostrar el modal
        document.getElementById('confirmation-modal').classList.remove('hidden');
    }

    function closeModal() {
        // Ocultar el modal
        document.getElementById('confirmation-modal').classList.add('hidden');
    }
</script>

<script>
    // Mostrar modal si 'pregunta_clave' es "Sí"
    window.onload = function() {
        const preguntaClave = <?= json_encode($identidad['pregunta_clave']); ?>;
        if (preguntaClave == 1) {
            document.getElementById('password-modal').classList.remove('hidden');

        }
    };

    // Verificar la contraseña
    document.getElementById('submit-password').addEventListener('click', function() {
        const password = document.getElementById('master-password').value;
        if (password) {
            // Realizamos la solicitud de verificación
            fetch('/identidad/verificar-contrasenia', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ password: password })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Si la contraseña es correcta, ocultamos el modal y mostramos los campos
                        document.getElementById('password-modal').classList.add('hidden');

                    } else {
                        alert('Contraseña incorrecta');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Hubo un error al verificar la contraseña');
                });
        }
    });
</script>
