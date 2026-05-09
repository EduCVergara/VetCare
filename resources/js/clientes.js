document.addEventListener('DOMContentLoaded', () => {

    // Búsqueda en tiempo real
    const input = document.getElementById('buscar-clientes');
    if (input) {
        input.addEventListener('keyup', () => {
            const q = input.value.toLowerCase();
            document.querySelectorAll('.cliente-card').forEach(card => {
                const nombre = card.dataset.nombre ?? '';
                const email  = card.dataset.email ?? '';
                card.style.display = (nombre.includes(q) || email.includes(q)) ? '' : 'none';
            });
        });
    }

});