<h2>Editar Entrada</h2>

<form method="POST" action="/entrada/guardar/<?= esc($entrada['entrada_id']) ?>">

    <!-- Campo nombre -->
    <div>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?= esc($entrada['nombre']) ?>" required>
    </div>

    <!-- Campo tipo -->
    <div>
        <label for="tipo">Tipo:</label>
        <select name="tipo" id="tipo">
            <option value="login" <?= $entrada['tipo'] == 'login' ? 'selected' : '' ?>>Login</option>
            <option value="identidad" <?= $entrada['tipo'] == 'identidad' ? 'selected' : '' ?>>Identidad</option>
            <option value="tarjeta" <?= $entrada['tipo'] == 'tarjeta' ? 'selected' : '' ?>>Tarjeta</option>
            <option value="nota" <?= $entrada['tipo'] == 'nota' ? 'selected' : '' ?>>Nota</option>
        </select>
    </div>

    <!-- Campos específicos según el tipo de entrada -->
    <?php if ($entrada['tipo'] == 'login'): ?>
        <div>
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" id="usuario" value="<?= esc($registro['usuario']) ?>" required>
        </div>
        <div>
            <label for="contrasenia">Contraseña:</label>
            <input type="password" name="contrasenia" id="contrasenia" value="<?= esc($registro['contrasenia']) ?>" required>
        </div>
        <div>
            <label for="url">URL:</label>
            <input type="url" name="url" id="url" value="<?= esc($registro['url']) ?>">
        </div>
        <div>
            <label for="notas">Notas:</label>
            <textarea name="notas" id="notas"><?= esc($registro['notas']) ?></textarea>
        </div>
    <?php elseif ($entrada['tipo'] == 'identidad'): ?>
        <div>
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo" value="<?= esc($registro['titulo']) ?>">
        </div>
        <div>
            <label for="primer_nombre">Primer Nombre:</label>
            <input type="text" name="primer_nombre" id="primer_nombre" value="<?= esc($registro['primer_nombre']) ?>" required>
        </div>
        <div>
            <label for="segundo_nombre">Segundo Nombre:</label>
            <input type="text" name="segundo_nombre" id="segundo_nombre" value="<?= esc($registro['segundo_nombre']) ?>">
        </div>
        <div>
            <label for="apellidos">Apellidos:</label>
            <input type="text" name="apellidos" id="apellidos" value="<?= esc($registro['apellidos']) ?>" required>
        </div>
        <div>
            <label for="email">Correo:</label>
            <input type="email" name="email" id="email" value="<?= esc($registro['email']) ?>">
        </div>
        <div>
            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" id="telefono" value="<?= esc($registro['telefono']) ?>">
        </div>
        <div>
            <label for="direccion_1">Dirección 1:</label>
            <input type="text" name="direccion_1" id="direccion_1" value="<?= esc($registro['direccion_1']) ?>">
        </div>
        <div>
            <label for="pais">País:</label>
            <input type="text" name="pais" id="pais" value="<?= esc($registro['pais']) ?>">
        </div>
    <?php elseif ($entrada['tipo'] == 'tarjeta'): ?>
        <div>
            <label for="nombre_tarjeta">Nombre de la Tarjeta:</label>
            <input type="text" name="nombre_tarjeta" id="nombre_tarjeta" value="<?= esc($registro['nombre_tarjeta']) ?>" required>
        </div>
        <div>
            <label for="numero">Número de la Tarjeta:</label>
            <input type="text" name="numero" id="numero" value="<?= esc($registro['numero']) ?>" required>
        </div>
        <div>
            <label for="exp_fecha">Fecha de Expiración:</label>
            <input type="month" name="exp_fecha" id="exp_fecha" value="<?= esc($registro['exp_fecha']) ?>" required>
        </div>
        <div>
            <label for="cvv">CVV:</label>
            <input type="text" name="cvv" id="cvv" value="<?= esc($registro['cvv']) ?>" required>
        </div>
        <div>
            <label for="notas">Notas:</label>
            <textarea name="notas" id="notas"><?= esc($registro['notas']) ?></textarea>
        </div>
    <?php elseif ($entrada['tipo'] == 'nota'): ?>
        <div>
            <label for="contenido">Contenido:</label>
            <textarea name="contenido" id="contenido"><?= esc($registro['contenido']) ?></textarea>
        </div>
    <?php endif; ?>

    <button type="submit">Guardar cambios</button>
</form>

