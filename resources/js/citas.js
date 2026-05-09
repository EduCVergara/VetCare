document.addEventListener('DOMContentLoaded', () => {
    const selCliente = document.getElementById('sel-cliente');
    const selPaciente = document.getElementById('sel-paciente');
    const selEstado = document.getElementById('sel-estado');

    let tsCliente = null;
    let tsPaciente = null;

    const renderPacientes = (clienteId) => {
        if (!tsPaciente || !selPaciente) {
            return;
        }

        const pacienteActual = selPaciente.value ?? '';
        const todasOpciones = window.pacientesData ?? [];
        const opcionesFiltradas = todasOpciones.filter((paciente) => !clienteId || paciente.cliente_id == clienteId);

        tsPaciente.clearOptions();

        if (!clienteId) {
            tsPaciente.addOption({ value: '', text: 'Primero seleccione un cliente...' });
            tsPaciente.setValue('', true);
            tsPaciente.refreshOptions(false);
            return;
        }

        opcionesFiltradas.forEach((paciente) => {
            tsPaciente.addOption({
                value: paciente.id,
                text: `${paciente.nombre} (${paciente.especie})`,
            });
        });

        const existePacienteActual = opcionesFiltradas.some((paciente) => String(paciente.id) === String(pacienteActual));
        tsPaciente.setValue(existePacienteActual ? pacienteActual : '', true);
        tsPaciente.refreshOptions(false);
    };

    if (selCliente) {
        tsCliente = new TomSelect(selCliente, {
            placeholder: 'Seleccionar cliente...',
            allowEmptyOption: true,
            maxOptions: null,
            onChange(clienteId) {
                renderPacientes(clienteId);
            },
        });
    }

    if (selPaciente) {
        tsPaciente = new TomSelect(selPaciente, {
            placeholder: 'Seleccionar paciente...',
            allowEmptyOption: true,
            maxOptions: null,
        });
    }

    if (selEstado) {
        new TomSelect(selEstado, {
            allowEmptyOption: false,
            create: false,
        });
    }

    if (selCliente && tsPaciente) {
        renderPacientes(selCliente.value);
    }
});
