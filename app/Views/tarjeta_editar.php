<div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md mx-auto" >
    <h1 class="text-2xl font-bold mb-4 text-center"><?= esc($titulo) ?></h1>

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

    <!-- Formulario de edición de tarjeta -->
    <form id="form-tarjeta" action="/tarjeta/guardar/<?= esc($entrada['entrada_id']) ?>" method="POST" class="space-y-4 " id="form-editar" >
        <?= csrf_field() ?>

        <!-- Campo de nombre de la entrada -->
        <div>
            <label for="nombre" class="block text-sm font-medium">Nombre de la entrada</label>
            <input type="text" id="nombre" name="nombre" placeholder="Nombre para esta entrada" class="w-full border rounded p-2" value="<?= esc($entrada['nombre']) ?>" required>
        </div>

        <!-- Nombre de la tarjeta -->
        <div>
            <label for="nombre_tarjeta" class="block text-sm font-medium">Nombre en la Tarjeta</label>
            <input type="text" id="nombre_tarjeta" name="nombre_tarjeta" placeholder="Ej: Juan Pérez" class="w-full border rounded p-2" value="<?= esc($tarjeta['nombre_tarjeta']) ?>" required>
        </div>

        <!-- Marca de la tarjeta -->
        <div>
            <label for="marca" class="block text-sm font-medium">Marca</label>
            <input type="text" id="marca" name="marca" placeholder="Ej: Visa, MasterCard..." class="w-full border rounded p-2" value="<?= esc($tarjeta['marca']) ?>" required>
        </div>

        <!-- Número de tarjeta -->
        <div>
            <label for="numero" class="block text-sm font-medium">Número de tarjeta</label>
            <input type="text" id="numero" name="numero" placeholder="1234 5678 9012 3456" class="w-full border rounded p-2" value="<?= esc($tarjeta['numero']) ?>" required>
        </div>

        <!-- Fecha de expiración -->
        <div>
            <label for="exp_fecha" class="block text-sm font-medium">Fecha de Expiración</label>
            <input type="date" id="exp_fecha" name="exp_fecha" class="w-full border rounded p-2" value="<?= esc($tarjeta['exp_fecha']) ?>" required>
        </div>

        <!-- CVV -->
        <div>
            <label for="cvv" class="block text-sm font-medium">CVV</label>
            <input type="text" id="cvv" name="cvv" placeholder="***" class="w-full border rounded p-2" value="<?= esc($tarjeta['cvv']) ?>" required>
        </div>
        <!-- Selección de Caja Fuerte -->
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
            <textarea id="notas" name="notas" placeholder="Información adicional" class="w-full border rounded p-2"><?= esc($tarjeta['notas']) ?></textarea>
        </div>

        <!-- Pregunta clave -->
        <div>
            <label for="pregunta_clave" class="block text-sm font-medium">¿Volver a preguntar contraseña maestra?</label>
            <select id="pregunta_clave" name="pregunta_clave" class="w-full border rounded p-2">
                <option value="0" <?= $tarjeta['pregunta_clave'] == 0 ? 'selected' : '' ?>>No</option>
                <option value="1" <?= $tarjeta['pregunta_clave'] == 1 ? 'selected' : '' ?>>Sí</option>
            </select>
        </div>



        <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">Guardar</button>
    </form>

    <!-- Botón para abrir el modal de eliminación -->
    <button type="button" onclick="openModal()" class="w-full bg-red-500 text-white p-2 rounded mt-4">
        Eliminar Tarjeta
    </button>

    <!-- Modal de confirmación -->
    <div id="confirmation-modal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white rounded-lg p-6 w-1/3">
            <h2 class="text-lg font-bold mb-4">¿Estás seguro?</h2>
            <p>Esta acción eliminará permanentemente la tarjeta. ¿Estás seguro de que deseas continuar?</p>
            <div class="mt-4 flex justify-end space-x-4">
                <button onclick="closeModal()" class="bg-gray-300 text-gray-700 p-2 rounded">Cancelar</button>
                <form id="delete-form" action="/tarjeta/eliminar/<?= esc($entrada['entrada_id']) ?>" method="POST">
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
    document.getElementById('show_password').addEventListener('change', function () {
        var passwordField = document.getElementById('contrasenia');
        if (this.checked) {
            passwordField.type = 'text';  // Cambiar a tipo 'text' para mostrar la contraseña
        } else {
            passwordField.type = 'password';  // Volver a tipo 'password' para ocultarla
        }
    });
</script>
<script>
    // Mostrar modal si 'pregunta_clave' es "Sí"
    window.onload = function() {
        const preguntaClave = <?= json_encode($tarjeta['pregunta_clave']); ?>;
        if (preguntaClave == 1) {
            document.getElementById('password-modal').classList.remove('hidden');

        }
    };

    // Verificar la contraseña
    document.getElementById('submit-password').addEventListener('click', function() {
        const password = document.getElementById('master-password').value;
        if (password) {
            // Realizamos la solicitud de verificación
            fetch('/tarjeta/verificar-contrasenia', {
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
