
<div class="flex justify-center items-start  bg-gray-100 py-6 px-4">
    <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-8">
        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Generador de Contraseña</h2>

        <!-- Formulario de generación de contraseña -->
        <form method="POST" action="<?= base_url('generate-password') ?>" class="space-y-6">
            <div>
                <label for="length" class="block text-sm font-medium text-gray-700">Longitud</label>
                <input type="number" name="length" id="length" class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required max="127" min="5">
            </div>

            <div>
                <label for="min_numbers" class="block text-sm font-medium text-gray-700">Mínimo de caracteres numéricos</label>
                <input type="number" name="min_numbers" id="min_numbers" class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required max="9" min="1">
            </div>

            <div>
                <label for="min_special_chars" class="block text-sm font-medium text-gray-700">Mínimo de caracteres especiales</label>
                <input type="number" name="min_special_chars" id="min_special_chars" class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required max="9" min="1">
            </div>

            <div>
                <label for="options" class="block  text-sm font-medium text-gray-700">Opciones</label>
                <div class="space-x-4 mt-4 flex items-center justify-center">
                    <input type="checkbox" name="options[]" value="a-z" class="h-5 w-5 text-blue-600 border-gray-300 rounded focus:ring-2 focus:ring-blue-500"> <span class="text-sm">a-z</span>
                    <input type="checkbox" name="options[]" value="A-Z" class="h-5 w-5 text-blue-600 border-gray-300 rounded focus:ring-2 focus:ring-blue-500"> <span class="text-sm">A-Z</span>
                    <input type="checkbox" name="options[]" value="0-9" class="h-5 w-5 text-blue-600 border-gray-300 rounded focus:ring-2 focus:ring-blue-500"> <span class="text-sm">0-9</span>
                    <input type="checkbox" name="options[]" value="!@#%&" class="h-5 w-5 text-blue-600 border-gray-300 rounded focus:ring-2 focus:ring-blue-500"> <span class="text-sm">!@#%&*</span>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="w-full py-3 bg-blue-800 text-white rounded-lg hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500">Generar Contraseña</button>
            </div>
        </form>

        <!-- Mostrar contraseña generada -->
        <?php if (isset($password)): ?>
            <div class="mt-6 bg-gray-50 p-4 rounded-lg shadow-inner">
                <h3 class="text-lg font-medium text-gray-800 mb-2">Contraseña Generada:</h3>
                <div class="flex items-center space-x-4">
                    <input id="generatedPassword" type="text" value="<?= esc($password) ?>" class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" readonly>
                    <button onclick="copyPassword()" class="bg-blue-800 text-white px-4 py-2 rounded-lg hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500">Copiar</button>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    function copyPassword() {
        var passwordField = document.getElementById('generatedPassword');
        passwordField.select();
        passwordField.setSelectionRange(0, 99999); // Para dispositivos móviles
        document.execCommand('copy');
        alert("Contraseña copiada: " + passwordField.value);
    }
</script>
