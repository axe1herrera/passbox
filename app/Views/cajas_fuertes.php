<!--<!-- Modal -->-->
<!--<div id="vaultModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">-->
<!--    <div class="bg-white rounded-lg p-6 w-96">-->
<!--        <div class="flex justify-between items-center">-->
<!--            <h5 class="text-lg font-semibold">Cajas Fuertes</h5>-->
<!--            <button id="closeModal" class="text-gray-500 hover:text-gray-700">&times;</button>-->
<!--        </div>-->
<!--        <div class="mt-4">-->
<!--            --><?php //if (!empty($vaults)): ?>
<!--                <ul class="space-y-4">-->
<!--                    --><?php //foreach ($vaults as $vault): ?>
<!--                        <li class="border-b pb-3">-->
<!--                            <strong class="text-gray-700">Nombre:</strong> --><?php //= esc($vault['nombre']) ?><!--<br>-->
<!--                        </li>-->
<!--                    --><?php //endforeach; ?>
<!--                </ul>-->
<!--            --><?php //else: ?>
<!--                <p>No tienes cajas fuertes.</p>-->
<!--            --><?php //endif; ?>
<!--        </div>-->
<!--        <div class="mt-6 text-right">-->
<!--            <button id="closeModalBtn" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Cerrar</button>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!---->
<!--<!-- Script para abrir el modal automáticamente (si deseas mostrarlo al cargar la página) -->-->
<!--<script>-->
<!--    document.addEventListener("DOMContentLoaded", function() {-->
<!--        // Abrir el modal al cargar la página-->
<!--        const modal = document.getElementById('vaultModal');-->
<!--        const closeModalBtn = document.getElementById('closeModal');-->
<!--        const closeModalBtn2 = document.getElementById('closeModalBtn');-->
<!---->
<!--        modal.classList.remove('hidden');-->
<!---->
<!--        // Cerrar el modal al hacer clic en la "X" o el botón "Cerrar"-->
<!--        closeModalBtn.addEventListener('click', function() {-->
<!--            modal.classList.add('hidden');-->
<!--        });-->
<!---->
<!--        closeModalBtn2.addEventListener('click', function() {-->
<!--            modal.classList.add('hidden');-->
<!--        });-->
<!--    });-->
<!--</script>-->

<!-- Modal -->
<div id="vaultModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden z-50">
    <div class="bg-white rounded-lg p-6 w-96">
        <div class="flex justify-between items-center">
            <h5 class="text-lg font-semibold">Cajas Fuertes</h5>
            <button id="closeModal" class="text-gray-500 hover:text-gray-700">&times;</button>
        </div>
        <div class="mt-4">
            <?php if (!empty($vaults)): ?>
                <ul class="space-y-4">
                    <?php foreach ($vaults as $vault): ?>
                        <li class="border-b pb-3">
                            <strong class="text-gray-700">Nombre:</strong> <?= esc($vault['nombre']) ?><br>

                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No tienes cajas fuertes.</p>
            <?php endif; ?>
        </div>
        <div class="mt-6 text-right">
            <button id="closeModalBtn" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Cerrar</button>
        </div>
    </div>
</div>

<!-- Script para abrir el modal -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const modal = document.getElementById('vaultModal');
        const closeModalBtn = document.getElementById('closeModal');
        const closeModalBtn2 = document.getElementById('closeModalBtn');

        // Mostrar el modal al cargar la página
        modal.classList.remove('hidden');

        // Cerrar el modal al hacer clic en la "X" o en el botón "Cerrar"
        closeModalBtn.addEventListener('click', function() {
            modal.classList.add('hidden');
        });

        closeModalBtn2.addEventListener('click', function() {
            modal.classList.add('hidden');
        });
    });
</script>


