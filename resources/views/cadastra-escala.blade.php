<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar Escala') }}
        </h2>
    </x-slot>

    <section class="mt-4">
        <div class="container">
            <cadastra-escala url="{{ route('cadastra.escala') }}">
                
            </cadastra-escala>
    </section>
</x-app-layout>
