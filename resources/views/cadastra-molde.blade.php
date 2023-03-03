<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastra Molde') }}
        </h2>
    </x-slot>

    <section class="mt-4">
        <div class="container">
            <cadastra-molde url-filtro="{{ route('escala.filtro') }}" url="{{ route('cadastra.molde') }}">
                
            </cadastra-molde>
    </section>
</x-app-layout>
