<div>
    <div>
    <p class="text-xl pb-6 pt-4">Usuário: <span class="text-kgray">{{$user->name}}</span></p>
    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex justify-center centralizar">
        @if(Auth::user()->hasPermissionTo('adicionar_funcao_usuario'))
            <x-nav-link class="cursor-pointer text-custom-green" wire:click="tela_funcao()"
                :active="$action == 'roles'">
                {{ __('Funções') }}
            </x-nav-link>
        @endif
        @if(Auth::user()->hasPermissionTo('adicionar_permissao_usuario'))
            <x-nav-link class="cursor-pointer text-custom-green" wire:click="tela_permissao()"
                :active="$action == 'permissions'">
                {{ __('Permissões') }}
            </x-nav-link>
        @endif
    </div>
    <br>
    @if($action == 'roles')
        <div class="grid grid-cols-2 gap-4 justify-center">
            <div class="flex items-center justify-center border-t border-b border-gray-500 py-5">
                <p>Função</p>
            </div>
            <div class="flex items-center justify-center border-t border-b border-gray-500 py-5">
                <p>Alterar</p>
            </div>
            @foreach ($roles_colunas as $coluna)
                <div class="flex items-center justify-center cadastroborder-b border-gray-200 py-5">
                    <p>{{str_replace("_", " ", $coluna['nome'])}}</p>
                </div>
                <div class="flex items-center justify-center border-b border-gray-200 py-5">
                    <label class="relative inline-flex items-center cursor-pointer mt-2">
                    <input  wire:change="change_user_role('{{$coluna['nome']}}')" type="checkbox" 
                        class="sr-only peer" {{$coluna['ativo']}}>
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 
                        peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer 
                        dark:bg-gray-700 peer-checked:after:translate-x-full 
                        peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px]
                        after:left-[2px] after:bg-white after:border-gray-300 after:border 
                        after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600
                        peer-checked:bg-blue-600"></div>
                </div>
            @endforeach
        </div>
    @elseif ($action == 'permissions')
        <div class="grid grid-cols-2 gap-4 justify-center">
            <div class="flex items-center justify-center border-t border-b border-gray-500 py-5">
                <p>Permissão</p>
            </div>
            <div class="flex items-center justify-center border-t border-b border-gray-500 py-5">
                <p>Alterar</p>
            </div>
            @foreach ($permissions_colunas as $coluna)
                <div class="flex items-center justify-center border-b border-gray-200 py-5">
                    <p>{{str_replace("_", " ", $coluna['nome'])}}</p>
                    @if($coluna['disable'] == 'disabled')
                        <span class="text-red-500">*</span>
                    @endif
                </div> 
                <div class="flex items-center justify-center border-b border-gray-200 py-5">
                    <label class="relative inline-flex items-center cursor-pointer mt-2">
                    <input  wire:change="change_user_permission('{{$coluna['nome']}}')"
                        type="checkbox" class="sr-only peer" {{$coluna['ativo']}} {{$coluna['disable']}}>
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none
                        peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800
                        rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full
                        peer-checked:after:border-white after:content-[''] after:absolute
                        after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300
                        after:border after:rounded-full after:h-5 after:w-5 after:transition-all
                        dark:border-gray-600 peer-checked:bg-blue-600"></div>
                </div>
            @endforeach
        </div>
        <p class="text-red-500 centralizar">
            Obs.: Se não estiver conseguindo alterar alguma permissão é porque essa permissão é da 
            função do usuário. Logo, tem que alterar na aba "Atualizar Função"</p>
    </div>
    
    @endif
</div>