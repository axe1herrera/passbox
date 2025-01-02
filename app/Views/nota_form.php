<div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md mx-auto">
    <h1 class="text-2xl font-bold mb-4 text-center">Nueva nota</h1>

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

    <form action="/nota/submit" method="POST" class="space-y-4">
        <?= csrf_field() ?>

        <div>
            <label for="nombre" class="block text-sm font-medium">Nombre de la entrada</label>
            <input type="text" id="nombre" name="nombre" placeholder="Nombre para esta nota"
                   class="w-full border rounded p-2" value="<?= old('nombre') ?>" required>
        </div>

        <div>
            <label for="vault_id" class="block text-sm font-medium">Seleccionar Caja Fuerte</label>
            <select id="vault_id" name="vault_id" class="w-full border rounded p-2" required>
                <?php foreach ($vaults as $vault): ?>
                    <option value="<?= $vault['vault_id'] ?>" <?= old('vault_id') == $vault['vault_id'] ? 'selected' : '' ?>>
                        <?= esc($vault['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label for="contenido" class="block text-sm font-medium">Contenido</label>
            <textarea id="contenido" name="contenido" placeholder="Escribe aquí el contenido de la nota"
                      class="w-full border rounded p-2" required><?= old('contenido') ?></textarea>
        </div>

        <div>
            <label for="pregunta_clave" class="block text-sm font-medium">¿Volver a preguntar contraseña maestra?</label>
            <select id="pregunta_clave" name="pregunta_clave" class="w-full border rounded p-2">
                <option value="0" <?= old('pregunta_clave') == '0' ? 'selected' : '' ?>>No</option>
                <option value="1" <?= old('pregunta_clave') == '1' ? 'selected' : '' ?>>Sí</option>
            </select>
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">Guardar</button>
    </form>
</div>

