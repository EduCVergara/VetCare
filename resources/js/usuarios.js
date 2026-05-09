document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('buscar-usuarios');

    if (!input) {
        return;
    }

    input.addEventListener('keyup', () => {
        const q = input.value.toLowerCase();

        document.querySelectorAll('.usuario-card').forEach(card => {
            const nombre = card.dataset.nombre ?? '';
            const email = card.dataset.email ?? '';
            const cargo = card.dataset.cargo ?? '';
            const rol = card.dataset.rol ?? '';

            card.style.display = (nombre.includes(q) || email.includes(q) || cargo.includes(q) || rol.includes(q))
                ? ''
                : 'none';
        });
    });
});
