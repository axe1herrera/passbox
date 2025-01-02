<!-- modal.php -->
<div id="createVaultModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg p-6 w-96">
        <h2 class="text-lg font-bold mb-4">Crear Nueva Caja Fuerte</h2>
        <!-- modal.php -->
        <form id="createVaultForm" method="POST" action="<?= base_url('crear_caja_fuerte') ?>">
            <div class="mb-4">
                <label for="vaultName" class="block text-sm font-medium text-gray-700">Nombre de la Caja Fuerte</label>
                <input
                        type="text"
                        name="nombre"
                        id="vaultName"
                        class="w-full p-2 border rounded mt-2"
                        placeholder="Ingresa el nombre de la caja fuerte"
                        required>
            </div>
            <div class="flex justify-end">
                <button type="button" id="closeModalButton" class="mr-2 bg-gray-300 text-black p-2 rounded">Cancelar</button>
                <button type="submit" class="bg-blue-800 text-white p-2 rounded">Crear</button>
            </div>
        </form>


    </div>
</div>

<script>
    // Mostrar el modal
    document.getElementById('openCreateVaultModal').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('createVaultModal').classList.remove('hidden');
    });

    // Cerrar el modal
    document.getElementById('closeModalButton').addEventListener('click', function() {
        document.getElementById('createVaultModal').classList.add('hidden');
    });
</script>

