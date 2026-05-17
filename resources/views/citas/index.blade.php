<x-app-layout>
    <x-slot name="header">Agenda de Citas</x-slot>

    <div class="flex justify-between items-center mb-6">
        <div class="flex gap-2 items-center">
            <button onclick="semanaAnterior()"
                class="w-8 h-8 rounded-lg border border-gray-200 flex items-center justify-center hover:bg-gray-50 transition dark:border-slate-700 dark:hover:bg-slate-800">
                <svg class="w-4 h-4 text-gray-400 dark:text-slate-400" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z" />
                </svg>
            </button>
            <button onclick="semanaSiguiente()"
                class="w-8 h-8 rounded-lg border border-gray-200 flex items-center justify-center hover:bg-gray-50 transition dark:border-slate-700 dark:hover:bg-slate-800">
                <svg class="w-4 h-4 text-gray-400 dark:text-slate-400" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z" />
                </svg>
            </button>
        </div>
        <a href="{{ route('citas.create') }}" class="text-white text-sm font-medium px-4 py-2 rounded-lg transition"
            style="background: linear-gradient(135deg, #7F77DD, #534AB7)">
            + Nueva Cita
        </a>
    </div>

    {{-- Selector de semana --}}
    <div id="semana" class="flex gap-2 mb-6 overflow-x-auto pb-1"></div>

    {{-- Fecha seleccionada --}}
    <p id="titulo-dia" class="text-sm font-medium text-purple-600 mb-4 dark:text-violet-300"></p>

    {{-- Lista de citas del dia --}}
    <div id="citas-dia" class="space-y-3"></div>

    {{-- Datos desde Laravel --}}
    <script>
        const citasPorDia = @json($citasPorDia);

        const diasSemana = ['domingo', 'lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado'];
        const diasCortos = ['DOM', 'LUN', 'MAR', 'MIE', 'JUE', 'VIE', 'SAB'];
        const meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];

        const badgeClases = {
            'Confirmada': 'bg-teal-50 text-teal-700 dark:bg-teal-500/15 dark:text-teal-300',
            'Pendiente': 'bg-amber-50 text-amber-700 dark:bg-amber-500/15 dark:text-amber-300',
            'En consulta': 'bg-purple-50 text-purple-700 dark:bg-violet-500/15 dark:text-violet-300',
            'Completada': 'bg-blue-50 text-blue-700 dark:bg-blue-500/15 dark:text-blue-300',
            'Cancelada': 'bg-red-50 text-red-700 dark:bg-red-500/15 dark:text-red-300',
        };

        let offsetSemana = 0;
        let diaSeleccionado = null;

        function getLunes(offset) {
            const hoy = new Date();
            const dia = hoy.getDay();
            const lunes = new Date(hoy);
            lunes.setDate(hoy.getDate() - (dia === 0 ? 6 : dia - 1) + (offset * 7));
            lunes.setHours(0, 0, 0, 0);
            return lunes;
        }

        function formatKey(date) {
            return date.toISOString().split('T')[0];
        }

        function isDarkMode() {
            return document.documentElement.classList.contains('dark');
        }

        function renderSemana() {
            const lunes = getLunes(offsetSemana);
            const contenedor = document.getElementById('semana');
            contenedor.innerHTML = '';

            for (let i = 0; i < 7; i++) {
                const dia = new Date(lunes);
                dia.setDate(lunes.getDate() + i);
                const key = formatKey(dia);
                const hoy = formatKey(new Date());
                const seleccionado = diaSeleccionado === key;
                const estaHoy = key === hoy;
                const tieneCitas = citasPorDia[key] && citasPorDia[key].length > 0;
                const dark = isDarkMode();

                const btn = document.createElement('button');
                btn.onclick = () => { diaSeleccionado = key; renderSemana(); renderCitas(); };
                btn.className = 'flex flex-col items-center justify-center w-16 h-18 rounded-xl border transition flex-shrink-0 px-2 py-3 relative';

                if (seleccionado) {
                    btn.style.cssText = 'background: linear-gradient(135deg, #7F77DD, #534AB7); border-color: transparent;';
                } else if (estaHoy) {
                    btn.style.cssText = dark
                        ? 'background: rgba(124,58,237,.18); border-color: rgba(139,92,246,.55);'
                        : 'background: #EEEDFE; border-color: #AFA9EC;';
                } else {
                    btn.style.cssText = dark
                        ? 'background: #0f172a; border-color: #334155;'
                        : 'background: white; border-color: #e5e7eb;';
                }

                const colorTexto = seleccionado ? 'white' : (estaHoy ? (dark ? '#c4b5fd' : '#534AB7') : (dark ? '#94a3b8' : '#6b7280'));
                const colorNum = seleccionado ? 'white' : (estaHoy ? (dark ? '#ddd6fe' : '#534AB7') : (dark ? '#f1f5f9' : '#111827'));
                const dotColor = seleccionado ? 'white' : (dark ? '#a78bfa' : '#7F77DD');

                btn.innerHTML = `
                    <span style="font-size:10px; font-weight:500; color:${colorTexto}">${diasCortos[dia.getDay()]}</span>
                    <span style="font-size:20px; font-weight:500; color:${colorNum}; line-height:1.2">${dia.getDate()}</span>
                    ${tieneCitas ? `<span style="width:6px;height:6px;border-radius:50%;background:${dotColor};margin-top:3px;display:block"></span>` : '<span style="width:6px;height:6px;margin-top:3px;display:block"></span>'}
                `;

                contenedor.appendChild(btn);
            }
        }

        function renderCitas() {
            const key = diaSeleccionado;
            const fecha = new Date(key + 'T12:00:00');
            const titulo = document.getElementById('titulo-dia');
            titulo.textContent = diasSemana[fecha.getDay()] + ', ' + fecha.getDate() + ' de ' + meses[fecha.getMonth()] + ' de ' + fecha.getFullYear();

            const contenedor = document.getElementById('citas-dia');
            const citas = citasPorDia[key] || [];

            if (citas.length === 0) {
                contenedor.innerHTML = `
                    <div class="bg-white rounded-xl border border-gray-100 p-16 flex flex-col items-center gap-3 dark:bg-slate-900 dark:border-slate-800">
                        <div class="border-violet-300 dark:border-violet-500/50" style="width:52px;height:52px;border-radius:50%;border-width:2px;display:flex;align-items:center;justify-content:center">
                            <svg class="text-violet-500 dark:text-violet-300" style="width:24px;height:24px" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67V7z"/>
                            </svg>
                        </div>
                        <p class="text-gray-400 dark:text-slate-400" style="font-size:14px">No hay citas agendadas para este dia</p>
                        <a href="{{ route('citas.create') }}"
                           style="background:linear-gradient(135deg,#7F77DD,#D4537E);color:white;padding:8px 20px;border-radius:8px;font-size:14px;font-weight:500;text-decoration:none">
                            Agendar Primera Cita
                        </a>
                    </div>`;
                return;
            }

            contenedor.innerHTML = citas.map(cita => `
                <div class="bg-white rounded-xl border border-gray-100 p-4 flex items-center gap-4 dark:bg-slate-900 dark:border-slate-800">
                    <div class="text-gray-400 dark:text-slate-400" style="font-size:13px;min-width:48px">${cita.hora}</div>
                    <div style="flex:1">
                        <p class="text-gray-700 dark:text-slate-100" style="font-size:14px;font-weight:500">${cita.paciente} <span class="text-gray-400 dark:text-slate-400" style="font-size:12px">- ${cita.cliente}</span></p>
                        ${cita.motivo ? `<p class="text-gray-400 dark:text-slate-400" style="font-size:12px;margin-top:2px">${cita.motivo}</p>` : ''}
                    </div>
                    <span style="font-size:11px;padding:3px 10px;border-radius:20px" class="${badgeClases[cita.estado] || 'bg-gray-100 text-gray-500 dark:bg-slate-800 dark:text-slate-300'}">${cita.estado}</span>
                    <div style="display:flex;gap:8px">
                        <a href="/citas/${cita.id}/edit" class="text-gray-300 hover:text-gray-500 dark:text-slate-500 dark:hover:text-slate-300">
                            <svg style="width:16px;height:16px" fill="currentColor" viewBox="0 0 24 24"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a1 1 0 0 0 0-1.41l-2.34-2.34a1 1 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>
                        </a>
                        <form action="/citas/${cita.id}" method="POST" data-confirm="Eliminar esta cita?" data-confirm-text="Esta accion no se puede deshacer." style="display:inline">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="text-gray-300 hover:text-red-400 dark:text-slate-500 dark:hover:text-red-400" style="background:none;border:none;cursor:pointer">
                                <svg style="width:16px;height:16px" fill="currentColor" viewBox="0 0 24 24"><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
            `).join('');
        }

        function semanaAnterior() { offsetSemana--; renderSemana(); renderCitas(); }
        function semanaSiguiente() { offsetSemana++; renderSemana(); renderCitas(); }

        diaSeleccionado = formatKey(new Date());
        renderSemana();
        renderCitas();

        new MutationObserver(() => {
            renderSemana();
            renderCitas();
        }).observe(document.documentElement, { attributes: true, attributeFilter: ['class'] });
    </script>
    <x-slot name="scripts">
        @vite('resources/js/citas.js')
    </x-slot>

</x-app-layout>
