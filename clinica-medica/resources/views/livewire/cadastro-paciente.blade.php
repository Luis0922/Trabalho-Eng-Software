<div>
    <div class="bg-[url('../../public/images/img2-homepage.png')] h-36 flex justify-center">
        <h1 class="text-white font-bold text-3xl flex self-center text-center">Cadastro de Pacientes</h1>
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
                <x-label for="senha" value="{{ __('Senha') }}" />
                <x-input id="senha" wire:model="senha" class="block mt-1 w-full" type="password" name="senha" required />
            </div>
            <div class="mt-4">
                <x-label for="telefone" value="{{ __('Telefone') }}" />
                <x-input id="telefone" wire:model="telefone" class="block mt-1 w-full" type="tel" name="telefone" required placeholder="(99) 99999-9999"/>        
            </div>
            <div class="mt-4">
                <x-label for="CEP" value="{{ __('CEP') }}" />
                <x-input id="CEP" wire:model="cep" wire:change="completarEndereco" class="block mt-1 w-full" type="text" name="CEP" required />
            </div>
            <div class="mt-4">
                <x-label for="logradouro" value="{{ __('Logradouro') }}" />
                <x-input id="logradouro" wire:model="logradouro" class="block mt-1 w-full" type="text" name="logradouro" required />
            </div>
            <div class="mt-4">
                <x-label for="bairro" value="{{ __('Bairro') }}" />
                <x-input id="bairro" wire:model="bairro" class="block mt-1 w-full" type="text" name="bairro" required />
            </div>
            <div class="mt-4">
                <x-label for="cidade" value="{{ __('Cidade') }}" />
                <x-input id="cidade" wire:model="cidade" class="block mt-1 w-full" type="text" name="cidade" required />
            </div>
            <div class="mt-4">
                <x-label for="estado" value="{{ __('Estado') }}" />
                <x-input id="estado" wire:model="estado" class="block mt-1 w-full" type="text" name="estado" required />
            </div>
            <div class="mt-4">
                <x-label for="peso" value="{{ __('Peso') }}" />
                <x-input id="peso" wire:model="peso" class="block mt-1 w-full" type="text" name="peso" required />
            </div>
            <div class="mt-4">
                <x-label for="altura" value="{{ __('Altura') }}" />
                <x-input id="altura" wire:model="altura" class="block mt-1 w-full" type="text" name="altura" required />
            </div>
            <div class="mt-4">
                <x-label for="tipoSanguineo" value="{{ __('Tipo Sanguíneo') }}" />
                <x-input id="tipoSanguineo" wire:model="tipoSanguineo" class="block mt-1 w-full" type="text" name="tipoSanguineo" required />
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
