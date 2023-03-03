<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gerar Molde') }}
        </h2>
    </x-slot>

    <section class="mt-4">
        <div class="container">
            <gera-arquivo-molde
                url-escala="{{ route('escala.filtro') }}"
                url-molde="{{ route('molde.filtro') }}"
                url-gera-molde="{{ route('gera.molde') }}"
            >
            </gera-arquivo-molde>
        </div>
    </section>
</x-app-layout>
