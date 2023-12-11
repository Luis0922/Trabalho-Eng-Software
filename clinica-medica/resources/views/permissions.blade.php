<x-app-layout>
    <div class="text-center mt-20">
        @if($mostrar_opcao == 'true')
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex justify-center centralizar">
                @if(Auth::user()->hasPermissionTo('atualizar_funcao'))
                    <x-nav-link class="cursor-pointer bg-[#038e83] text-white rounded-md p-1" 
                        href="{{ route('permissoes.atualizar_funcao') }}"
                        :active="$action == 'atualizar_funcao'">
                        {{ __('Funções') }}
                    </x-nav-link>
                @endif
                @if(Auth::user()->hasPermissionTo('atualizar_permissao_usuario'))
                    <x-nav-link class="cursor-pointer bg-[#038e83] text-white rounded-md p-1" 
                    href="{{ route('permissoes.') }}"
                        :active="$action == 'mostrar_usuarios'">
                        {{ __('Usuários') }}
                    </x-nav-link>
                @endif
            </div>
        @endif
        @if ($action === 'mostrar_usuarios')
            <div class="m-20 mt-0">
                <livewire:user-table/>
            </div>
        @elseif ($action === 'atualizar_funcao')
            @livewire('tela-permissoes', ['action' => 'funcao'])
        @elseif ($action === 'editar_permissoes')
            @livewire('tela-permissoes', ['user_id' => $user_id])
        @endif
    </div>
</x-app-layout>