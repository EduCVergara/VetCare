import './bootstrap';
import Swal from 'sweetalert2';
import TomSelect from 'tom-select';

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
    const themeButtons = document.querySelectorAll('[data-theme-toggle]');
    const syncThemeButtons = () => {
        const isDark = document.documentElement.classList.contains('dark');
        themeButtons.forEach(button => {
            button.setAttribute('aria-pressed', isDark ? 'true' : 'false');
            button.setAttribute('title', isDark ? 'Cambiar a modo claro' : 'Cambiar a modo oscuro');
        });
    };

    themeButtons.forEach(button => {
        button.addEventListener('click', () => {
            window.toggleVetCareTheme();
            syncThemeButtons();
        });
    });

    syncThemeButtons();

    document.querySelectorAll('[data-password-toggle]').forEach(button => {
        const input = document.getElementById(button.dataset.passwordToggle);

        if (!input) {
            return;
        }

        button.addEventListener('click', () => {
            const isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';
            button.setAttribute('aria-label', isHidden ? 'Ocultar contraseña' : 'Mostrar contraseña');
            input.focus();
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
