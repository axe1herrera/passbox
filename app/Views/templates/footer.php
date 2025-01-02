

<!--<footer class=" text-gray-700 text-center p-4">-->
<!--    <p>&copy; 2024 Password Manager</p>-->
<!--</footer>-->
<!--</div>-->
<!--</div>-->
<!--</body>-->
<!--</html>-->

<!--<footer class="text-gray-700 text-center p-4">-->
<!--    <p>&copy; 2024 Password Manager</p>-->
<!--</footer>-->
</div>
</div>
<script>
    const dropdownButton = document.getElementById('dropdownButton');
    const dropdownMenu = document.getElementById('dropdownMenu');

    dropdownButton.addEventListener('click', () => {
        dropdownMenu.classList.toggle('hidden');
    });

    window.addEventListener('click', (e) => {
        if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });
</script>
<script>
    // Obtener el enlace que abre el modal
    const openModalBtn = document.querySelector('a[href="<?= base_url('cajas_fuertes') ?>"]');

    // Modal y botones de cierre
    const modal = document.getElementById('vaultModal');
    const closeModalBtn = document.getElementById('closeModal');
    const closeModalBtn2 = document.getElementById('closeModalBtn');

    // Abrir el modal al hacer clic en "Ver Cajas Fuertes"
    openModalBtn.addEventListener('click', function(event) {
        event.preventDefault(); // Evitar que se ejecute la redirección
        modal.classList.remove('hidden'); // Mostrar el modal
    });

    // Cerrar el modal al hacer clic en la "X"
    closeModalBtn.addEventListener('click', function() {
        modal.classList.add('hidden'); // Ocultar el modal
    });

    // Cerrar el modal al hacer clic en el botón "Cerrar"
    closeModalBtn2.addEventListener('click', function() {
        modal.classList.add('hidden'); // Ocultar el modal
    });

    // Cerrar el modal si el usuario hace clic fuera de él
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.classList.add('hidden'); // Ocultar el modal si el clic es fuera del modal
        }
    });
</script>

<script>
    // Función para manejar la selección de una caja fuerte
    function selectVault(vaultId) {
        // Aquí puedes almacenar el ID de la caja seleccionada en una variable o redirigir a otra página

        sessionStorage.setItem('selectedVaultId', vaultId); // Usando sessionStorage para mantenerlo entre vistas
        var value = sessionStorage.getItem('selectedVaultId');
        console.log("Caja fuerte seleccionada: " + value);
        // Si deseas redirigir a una página que muestra más detalles de la caja seleccionada, usa:
        // window.location.href = '/ruta/a/la/caja/' + vaultId;

        // Cerrar el modal después de la selección (opcional)
        document.getElementById('vaultModal').classList.add('hidden');
    }

    // Cerrar el modal al hacer clic en la "X"
    document.getElementById('closeModal').addEventListener('click', function() {
        document.getElementById('vaultModal').classList.add('hidden');
    });

    // Cerrar el modal al hacer clic en el botón "Cerrar"
    document.getElementById('closeModalBtn').addEventListener('click', function() {
        document.getElementById('vaultModal').classList.add('hidden');
    });
</script>


</body>
</html>