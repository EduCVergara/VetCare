document.addEventListener('DOMContentLoaded', () => {

    // Búsqueda en tiempo real
    const input = document.getElementById('buscar-pacientes');
    if (input) {
        input.addEventListener('keyup', () => {
            const q = input.value.toLowerCase();
            document.querySelectorAll('.paciente-card').forEach(card => {
                const nombre = card.dataset.nombre ?? '';
                const dueno  = card.dataset.dueno ?? '';
                card.style.display = (nombre.includes(q) || dueno.includes(q)) ? '' : 'none';
            });
        });
    }

    // TomSelect en selects de formulario
    const selCliente = document.getElementById('sel-paciente-cliente');
    const selEspecie = document.getElementById('sel-especie');

    if (selCliente && !selCliente.tomselect) {
        new TomSelect(selCliente, {
            placeholder: 'Seleccionar cliente...',
            allowEmptyOption: true,
        });
    }

    if (selEspecie && !selEspecie.tomselect) {
        new TomSelect(selEspecie, {
            placeholder: 'Seleccionar especie...',
            allowEmptyOption: true,
        });
    }

});
