@props(['route', 'icon'])

@php
    $icons = [
        'dashboard' => 'M3 3h7v7H3V3zm0 11h7v7H3v-7zm11-11h7v7h-7V3zm0 11h7v7h-7v-7z',
        'clientes' => 'M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z',
        'pacientes' => 'M4.5 10.5C4.5 9.12 5.62 8 7 8s2.5 1.12 2.5 2.5S8.38 13 7 13s-2.5-1.12-2.5-2.5zm10 0C14.5 9.12 15.62 8 17 8s2.5 1.12 2.5 2.5S18.38 13 17 13s-2.5-1.12-2.5-2.5zM9.5 11.5C8.01 11.5 6 13.51 6 16v1h6v-1c0-2.49-2.01-4.5-4.5-4.5zM17 13c-2.49 0-4.5 2.01-4.5 4.5v1H18v-1c0-2.49-2.01-4.5-4.5-4.5z',
        'citas' => 'M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z',
        'usuarios' => 'M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z',
    ];

    $active = request()->routeIs($route) || request()->routeIs(str_replace('.index', '.*', $route));
@endphp

<a href="{{ route($route) }}"
    class="group vet-sidebar-link {{ $active ? 'vet-sidebar-link-active' : 'vet-sidebar-link-idle' }}"
    @if($active) aria-current="page" @endif>
    <span class="vet-sidebar-icon">
        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path d="{{ $icons[$icon] }}" />
        </svg>
    </span>
    <span class="truncate">{{ $slot }}</span>
</a>
