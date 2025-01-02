<div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md mx-auto">
    <h1 class="text-2xl font-bold mb-4 text-center">Nueva identidad</h1>

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

    <form action="/identidad/submit" method="POST" class="space-y-4">
        <?= csrf_field() ?>

        <div>
            <label for="nombre" class="block text-sm font-medium">Nombre de la entrada</label>
            <input type="text" id="nombre" name="nombre" placeholder="Nombre para esta entrada"
                   class="w-full border rounded p-2" value="<?= old('nombre') ?>" required>
        </div>

        <div>
            <label for="titulo" class="block text-sm font-medium">Título</label>
            <input type="text" id="titulo" name="titulo" placeholder="Título de la identidad"
                   class="w-full border rounded p-2" value="<?= old('titulo') ?>">
        </div>

        <div>
            <label for="primer_nombre" class="block text-sm font-medium">Primer nombre</label>
            <input type="text" id="primer_nombre" name="primer_nombre" placeholder="Tu primer nombre"
                   class="w-full border rounded p-2" value="<?= old('primer_nombre') ?>" required>
        </div>

        <div>
            <label for="segundo_nombre" class="block text-sm font-medium">Segundo nombre</label>
            <input type="text" id="segundo_nombre" name="segundo_nombre" placeholder="Tu segundo nombre (opcional)"
                   class="w-full border rounded p-2" value="<?= old('segundo_nombre') ?>">
        </div>

        <div>
            <label for="apellidos" class="block text-sm font-medium">Apellidos</label>
            <input type="text" id="apellidos" name="apellidos" placeholder="Tus apellidos"
                   class="w-full border rounded p-2" value="<?= old('apellidos') ?>" required>
        </div>

        <div>
            <label for="empresa" class="block text-sm font-medium">Empresa</label>
            <input type="text" id="empresa" name="empresa" placeholder="Nombre de la empresa (opcional)"
                   class="w-full border rounded p-2" value="<?= old('empresa') ?>">
        </div>

        <div>
            <label for="nss" class="block text-sm font-medium">NSS</label>
            <input type="text" id="nss" name="nss" placeholder="Número de Seguridad Social"
                   class="w-full border rounded p-2" value="<?= old('nss') ?>">
        </div>

        <div>
            <label for="pasaporte" class="block text-sm font-medium">Pasaporte</label>
            <input type="text" id="pasaporte" name="pasaporte" placeholder="Número de pasaporte"
                   class="w-full border rounded p-2" value="<?= old('pasaporte') ?>">
        </div>

        <div>
            <label for="licencia" class="block text-sm font-medium">Licencia</label>
            <input type="text" id="licencia" name="licencia" placeholder="Número de licencia"
                   class="w-full border rounded p-2" value="<?= old('licencia') ?>">
        </div>

        <div>
            <label for="email" class="block text-sm font-medium">Email</label>
            <input type="email" id="email" name="email" placeholder="correo@ejemplo.com"
                   class="w-full border rounded p-2" value="<?= old('email') ?>">
        </div>

        <div>
            <label for="telefono" class="block text-sm font-medium">Teléfono</label>
            <input type="text" id="telefono" name="telefono" placeholder="+34 123 456 789"
                   class="w-full border rounded p-2" value="<?= old('telefono') ?>">
        </div>

        <div>
            <label for="direccion_1" class="block text-sm font-medium">Dirección 1</label>
            <input type="text" id="direccion_1" name="direccion_1" placeholder="Calle Principal 123"
                   class="w-full border rounded p-2" value="<?= old('direccion_1') ?>">
        </div>

        <div>
            <label for="direccion_2" class="block text-sm font-medium">Dirección 2</label>
            <input type="text" id="direccion_2" name="direccion_2" placeholder="Apartamento, suite, etc."
                   class="w-full border rounded p-2" value="<?= old('direccion_2') ?>">
        </div>

        <div>
            <label for="ciudad_pueblo" class="block text-sm font-medium">Ciudad/Pueblo</label>
            <input type="text" id="ciudad_pueblo" name="ciudad_pueblo" placeholder="Tu ciudad"
                   class="w-full border rounded p-2" value="<?= old('ciudad_pueblo') ?>">
        </div>

        <div>
            <label for="estado" class="block text-sm font-medium">Estado</label>
            <input type="text" id="estado" name="estado" placeholder="Tu estado o provincia"
                   class="w-full border rounded p-2" value="<?= old('estado') ?>">
        </div>

        <div>
            <label for="codigo_postal" class="block text-sm font-medium">Código Postal</label>
            <input type="text" id="codigo_postal" name="codigo_postal" placeholder="12345"
                   class="w-full border rounded p-2" value="<?= old('codigo_postal') ?>">
        </div>

        <div>
            <label for="pais" class="block text-sm font-medium">País</label>
            <input type="text" id="pais" name="pais" placeholder="Tu país"
                   class="w-full border rounded p-2" value="<?= old('pais') ?>">
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
            <label for="notas" class="block text-sm font-medium">Notas</label>
            <textarea id="notas" name="notas" placeholder="Información adicional"
                      class="w-full border rounded p-2"><?= old('notas') ?></textarea>
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
