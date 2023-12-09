<x-app-layout>
    <div class="text-center">
        @if ($action === 'mostrar_usuarios')
            <livewire:user-table/>
        @elseif ($action === 'editar_permissoes')
            @livewire('tela-permissoes', ['user_id' => $user_id])
        @endif
    </div>
</x-app-layout>