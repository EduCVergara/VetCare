import './bootstrap';
import Swal from 'sweetalert2';
import TomSelect from 'tom-select';
import 'tom-select/dist/css/tom-select.css';

window.Swal = Swal;
window.TomSelect = TomSelect;

const THEME_KEY = 'vetcare-theme';

function getPreferredTheme() {
    const savedTheme = localStorage.getItem(THEME_KEY);

    if (savedTheme === 'light' || savedTheme === 'dark') {
        return savedTheme;
    }

    return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
}

function applyTheme(theme) {
    const root = document.documentElement;
    root.classList.toggle('dark', theme === 'dark');
    root.dataset.theme = theme;
}

window.applyVetCareTheme = function(theme) {
    localStorage.setItem(THEME_KEY, theme);
    applyTheme(theme);
};

window.toggleVetCareTheme = function() {
    const nextTheme = document.documentElement.classList.contains('dark') ? 'light' : 'dark';
    window.applyVetCareTheme(nextTheme);
};

applyTheme(getPreferredTheme());

const systemTheme = window.matchMedia('(prefers-color-scheme: dark)');
systemTheme.addEventListener('change', (event) => {
    const savedTheme = localStorage.getItem(THEME_KEY);

    if (savedTheme === 'light' || savedTheme === 'dark') {
        return;
    }

    applyTheme(event.matches ? 'dark' : 'light');
});

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-theme-toggle]').forEach(button => {
        const syncLabel = () => {
            const isDark = document.documentElement.classList.contains('dark');
            button.setAttribute('aria-pressed', isDark ? 'true' : 'false');
            button.setAttribute('title', isDark ? 'Cambiar a modo claro' : 'Cambiar a modo oscuro');
        };

        syncLabel();
        button.addEventListener('click', () => {
            window.toggleVetCareTheme();
            syncLabel();
        });
    });

    document.querySelectorAll('[data-confirm]').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: this.dataset.confirm,
                text: this.dataset.confirmText ?? '',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#7F77DD',
                cancelButtonColor: '#d1d5db',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
            }).then(result => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    });
});
