<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Dashboard') }}
        </x-header>
    </x-slot>

    <x-container>
        <x-form post :action="route('question.store')">

            <x-textarea label="Pergunta" name="question" />

            <x-btn.primary>Salvar</x-btn.primary>
            <x-btn.reset>Cancelar</x-btn.reset>

        </x-form>
    </x-container>
</x-app-layout>
