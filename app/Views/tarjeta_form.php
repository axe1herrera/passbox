


<div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md mx-auto">
    <h1 class="text-2xl font-bold mb-4 text-center">Nueva tarjeta</h1>

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

    <form action="/tarjeta/submit" method="POST" class="space-y-4">
        <?= csrf_field() ?>

        <!-- Nombre de la Entrada -->
        <div>
            <label for="nombre" class="block text-sm font-medium">Nombre de la entrada</label>
            <input type="text" id="nombre" name="nombre" placeholder="Nombre para esta entrada"
                   class="w-full border rounded p-2" value="<?= old('nombre') ?>" required>
        </div>

        <!-- Nombre en la Tarjeta -->
        <div>
            <label for="nombre_tarjeta" class="block text-sm font-medium">Nombre en la Tarjeta</label>
            <input type="text" id="nombre_tarjeta" name="nombre_tarjeta" placeholder="Ej: Juan Pérez"
                   class="w-full border rounded p-2" value="<?= old('nombre_tarjeta') ?>" required>
        </div>

        <!-- Marca de la Tarjeta -->
        <div>
            <label for="marca" class="block text-sm font-medium">Marca</label>
            <input type="text" id="marca" name="marca" placeholder="Ej: Visa, MasterCard..."
                   class="w-full border rounded p-2" value="<?= old('marca') ?>" required>
        </div>

        <!-- Número de Tarjeta -->
        <div>
            <label for="numero" class="block text-sm font-medium">Número de Tarjeta</label>
            <input type="text" id="numero" name="numero" placeholder="1234 5678 9012 3456"
                   class="w-full border rounded p-2" value="<?= old('numero') ?>" required>
        </div>

        <!-- Fecha de Expiración -->
        <div>
            <label for="exp_fecha" class="block text-sm font-medium">Fecha de Expiración</label>
            <input type="date" id="exp_fecha" name="exp_fecha"
                   class="w-full border rounded p-2" value="<?= old('exp_fecha') ?>" required>
        </div>

        <!-- CVV -->
        <div>
            <label for="cvv" class="block text-sm font-medium">CVV</label>
            <input type="text" id="cvv" name="cvv" placeholder="***"
                   class="w-full border rounded p-2" value="<?= old('cvv') ?>" required>
        </div>

        <!-- Seleccionar Caja Fuerte -->
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

        <!-- Notas -->
        <div>
            <label for="notas" class="block text-sm font-medium">Notas</label>
            <textarea id="notas" name="notas" placeholder="Información adicional"
                      class="w-full border rounded p-2"><?= old('notas') ?></textarea>
        </div>

        <!-- Pregunta Clave -->
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
