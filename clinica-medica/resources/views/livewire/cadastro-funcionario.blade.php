<div>
    <div class="bg-[url('../../public/images/img2-homepage.png')] h-36 flex justify-center">
        <h1 class="text-white font-bold text-3xl flex self-center text-center">Cadastro de Funcionários</h1>
    </div>
    <x-card class="mb-4">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="nome" value="{{ __('Nome') }}" />
                <x-input id="nome" class="block mt-1 w-full" type="text" name="nome" :value="old('nome')" required
                    autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" required />
            </div>
            <div class="mt-4">
                <x-label for="telefone" value="{{ __('Telefone') }}" />
                <x-input id="telefone" class="block mt-1 w-full" type="text" name="telefone" required />
            </div>
            <div class="mt-4">
                <x-label for="CEP" value="{{ __('CEP') }}" />
                <x-input id="CEP" class="block mt-1 w-full" type="text" name="CEP" required />
            </div>
            <div class="mt-4">
                <x-label for="Logradouro" value="{{ __('Logradouro') }}" />
                <x-input id="Logradouro" class="block mt-1 w-full" type="text" name="Logradouro" required />
            </div>
            <div class="mt-4">
                <x-label for="Bairro" value="{{ __('Bairro') }}" />
                <x-input id="Bairro" class="block mt-1 w-full" type="text" name="Bairro" required />
            </div>
            <div class="mt-4">
                <x-label for="Cidade" value="{{ __('Cidade') }}" />
                <x-input id="Cidade" class="block mt-1 w-full" type="text" name="Cidade" required />
            </div>
            <div class="mt-4">
                <x-label for="Estado" value="{{ __('Estado') }}" />
                <x-input id="Estado" class="block mt-1 w-full" type="text" name="Estado" required />
            </div>
            <div class="mt-4">
                <x-label for="data_inicio" value="{{ __('Data de Início') }}" />
                <x-input id="data_inicio" class="block mt-1 w-full" type="text" name="data_inicio" required />
            </div>
            <div class="mt-4">
                <x-label for="Salario" value="{{ __('Salário') }}" />
                <x-input id="Salario" class="block mt-1 w-full" type="text" name="Salario" required />
            </div>
            <div class="mt-4">
                <x-label for="senha" value="{{ __('Senha') }}" />
                <x-input id="senha" class="block mt-1 w-full" type="password" name="senha" required />
            </div>
            <div class="mt-4">

            <x-button >
                {{ __('Cadastrar') }}
            </x-button>
            </div>
</div>
</form>
</x-card>
</div>