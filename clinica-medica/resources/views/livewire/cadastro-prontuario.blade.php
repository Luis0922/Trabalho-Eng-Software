<div>
    <div class="bg-[url('../../public/images/img2-homepage.png')] h-36 flex justify-center">
        <h1 class="text-white font-bold text-3xl flex self-center text-center">Cadastro de Prontuário Eletrônico do Paciente</h1>
    </div>

    <x-card class="mb-4">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <x-label for="selected_user" value="{{ __('Email do paciente') }}" />
                <select class="w-full" wire:model="selected_user" name="selected_user" id="selected_user">
                    <option disabled>Selecione um paciente</option>
                    @foreach ($users as $user)
                        <option value="{{$user->id}}">{{$user->email}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <x-label for="anamnese" value="{{ __('Registro de anamnese') }}" />
                <x-textarea wire:model="anamnese" id="anamnese" class="block mt-1 w-full" 
                    type="text" name="anamnese" required />
            </div>
            <div class="mt-4">
                <x-label for="medicamentos" value="{{ __('Prescrição de medicamentos') }}" />
                <x-textarea  wire:model="medicamentos" id="medicamentos" class="block mt-1 w-full" 
                    type="text" name="medicamentos" required />
            </div>
            <div class="mt-4">
                <x-label for="atestados" value="{{ __('Emissão de atestados') }}" />
                <x-textarea id="atestados" wire:model="atestados" class="block mt-1 w-full" 
                    type="text" name="atestados" required />
            </div>
            <div class="mt-4">
                <x-label for="exames" value="{{ __('Solicitação de exames') }}" />
                <x-textarea id="exames" wire:model="exames" class="block mt-1 w-full" 
                    type="text" name="exames" required />
            </div>
        
            <div class="mt-4">

            <x-button wire:click="cadastro()">
                {{ __('Cadastrar') }}
            </x-button>
            </div>
</div>
</form>
</x-card>
</div>
