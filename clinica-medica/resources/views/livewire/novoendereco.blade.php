<div>
    <div class="bg-[url('../../public/images/img2-homepage.png')] h-36 flex justify-center">
        <h1 class="text-white font-bold text-3xl flex self-center text-center">Novo Endereço</h1>
    </div>
    <x-card class="mb-4">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <x-label for="cep" value="{{ __('CEP') }}" />
                <x-input id="cep" class="block mt-1 w-full" type="text" name="cep" required />
            </div>

            <div class="mt-4">
                <x-label for="logradouro" value="{{ __('Logradouro') }}" />
                <x-input id="logradouro" class="block mt-1 w-full" type="text" name="logradouro" required />
            </div>
            <div class="mt-4">
                <x-label for="bairro" value="{{ __('Bairro') }}" />
                <x-input id="bairro" class="block mt-1 w-full" type="text" name="bairro" required />
            </div>
            <div class="mt-4">
                <x-label for="cidade" value="{{ __('Cidade') }}" />
                <x-input id="cidade" class="block mt-1 w-full" type="text" name="cidade" required />
            </div>
            <div class="mt-4">
                <x-label for="estado" value="{{ __('Estado') }}" />
                <x-input id="estado" class="block mt-1 w-full" type="text" name="estado" required />
            </div>

            <div class="mt-4">
                <x-button>
                    {{ __('Cadastrar') }}
                </x-button>
            </div>
</div>
</form>
</x-card>
</div>