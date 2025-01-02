<div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md mx-auto">
    <h1 class="text-2xl font-bold mb-4 text-center">Nuevo login</h1>

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
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="/login/submit" method="POST" class="space-y-4">
        <div>
            <label for="nombre" class="block text-sm font-medium">Nombre</label>
            <input type="text" id="nombre" name="nombre" placeholder="Nombre del login"
                   class="w-full border rounded p-2" value="<?= old('nombre') ?>" required>
        </div>
        <div>
            <label for="usuario" class="block text-sm font-medium">Usuario</label>
            <input type="text" id="usuario" name="usuario" placeholder="Usuario"
                   class="w-full border rounded p-2" value="<?= old('usuario') ?>" required>
        </div>
        <div>
            <label for="contrasenia" class="block text-sm font-medium">Contraseña</label>
            <input type="password" id="contrasenia" name="contrasenia" placeholder="********"
                   class="w-full border rounded p-2" required>
        </div>

        <!-- Checkbox para mostrar la contraseña -->
        <div class="flex items-center">
            <input type="checkbox" id="show_password" class="mr-2">
            <label for="show_password" class="text-sm text-gray-700">Mostrar contraseña</label>
        </div>
        <div>
            <label for="vault_id" class="block text-sm font-medium">Seleccionar Caja Fuerte</label>
            <select id="vault_id" name="vault_id" class="w-full border rounded p-2" required>
                <?php foreach ($vaults as $vault): ?>
                    <option value="<?= $vault['vault_id'] ?>"><?= esc($vault['nombre']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>


        <div>
            <label for="url" class="block text-sm font-medium">URL</label>
            <input type="url" id="url" name="url" placeholder="https://example.com"
                   class="w-full border rounded p-2" value="<?= old('url') ?>">
        </div>
        <div>
            <label for="notas" class="block text-sm font-medium">Notas</label>
            <textarea id="notas" name="notas" placeholder="Información adicional"
                      class="w-full border rounded p-2"><?= old('notas') ?></textarea>
        </div>
        <div>
            <label for="pregunta_clave" class="block text-sm font-medium">¿Volver a preguntar contreña maestra?</label>
            <select id="pregunta_clave" name="pregunta_clave" class="w-full border rounded p-2">
                <option value="0" <?= old('pregunta_clave') == '0' ? 'selected' : '' ?>>No</option>
                <option value="1" <?= old('pregunta_clave') == '1' ? 'selected' : '' ?>>Sí</option>
            </select>
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">Guardar</button>
    </form>
</div>

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

