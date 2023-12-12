<div>
    <div class="bg-[url('../../public/images/img2-homepage.png')] h-36 flex justify-center">
        <h1 class="text-white font-bold text-3xl flex self-center text-center">Cadastro de Funcionários</h1>
    </div>

    <x-card class="mb-4">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <x-label for="nome" value="{{ __('Nome') }}" />
                <x-input id="nome" wire:model="nome" class="block mt-1 w-full" type="text" name="nome" required />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" wire:model="email" class="block mt-1 w-full" type="email" name="email" required />
            </div>
            <div class="mt-4">
                <x-label for="telefone" value="{{ __('Telefone') }}" />
                <x-input id="telefone" wire:model="tel" class="block mt-1 w-full" type="tel" name="telefone" required
                    placeholder="(99) 99999-9999" />
            </div>
            <div class="mt-4">
                <x-label for="CEP" value="{{ __('CEP') }}" />
                <x-input id="CEP" wire:model="cep" wire:change="completarEndereco" class="block mt-1 w-full" type="text"
                    name="CEP" required />
            </div>
            <div class="mt-4">
                <x-label for="Logradouro" value="{{ __('Logradouro') }}" />
                <x-input id="Logradouro" wire:model="logradouro" class="block mt-1 w-full" type="text" name="Logradouro"
                    required />
            </div>
            <div class="mt-4">
                <x-label for="Bairro" value="{{ __('Bairro') }}" />
                <x-input id="Bairro" wire:model="bairro" class="block mt-1 w-full" type="text" name="Bairro" required />
            </div>
            <div class="mt-4">
                <x-label for="Cidade" value="{{ __('Cidade') }}" />
                <x-input id="Cidade" wire:model="cidade" class="block mt-1 w-full" type="text" name="Cidade" required />
            </div>
            <div class="mt-4">
                <x-label for="Estado" value="{{ __('Estado') }}" />
                <x-input id="Estado" wire:model="estado" class="block mt-1 w-full" type="text" name="Estado" required
                    maxlength="2" />
            </div>
            <div class="mt-4">
                <x-label for="data_inicio" value="{{ __('Data de Início') }}" />
                <x-input id="data_inicio" wire:model="data_inicio" class="block mt-1 w-full" type="date"
                    name="data_inicio" required />
            </div>
            <div class="mt-4">
                <x-label for="Salario" value="{{ __('Salário') }}" />
                <x-input id="Salario" wire:model="salario" class="block mt-1 w-full" type="text" name="Salario"
                    required />
            </div>

            <div class="mt-4">
                <x-label for="tipo" value="{{ __('Tipo') }}" />
                <select id="tipo" wire:model="tipo" wire:change="designarTipoFuncionario" class="block mt-1 w-full">
                    <option value="secretaria">Secretária</option>
                    <option value="medico">Médico</option>
                </select>
            </div>
            @if($imprimir_medico)
            <div class="mt-4">
                <x-label for="especialidade" value="{{ __('Especialidade') }}" />
                <x-input id="especialidade" wire:model="especialidade" class="block mt-1 w-full" type="text" name="especialidade"
                    required />
            </div>
            <div class="mt-4">
                <x-label for="crm" value="{{ __('CRM') }}" />
                <x-input id="crm" wire:model="crm" class="block mt-1 w-full" type="text" name="crm"
                    required />
            </div>
            @endif

            <div class="mt-4">
                <x-label for="senha" value="{{ __('Senha') }}" />
                <x-input id="senha" wire:model="senha" class="block mt-1 w-full" type="password" name="senha"
                    required />
            </div>
            <div class="mt-4">

                <x-button wire:click="cadastrar()">
                    {{ __('Cadastrar') }}
                </x-button>
            </div>
</div>
</form>
</x-card>
</div>