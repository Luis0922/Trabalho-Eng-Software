<div>
    <div class="bg-[url('../../public/images/img2-homepage.png')] h-36 flex justify-center">
        <h1 class="text-white font-bold text-3xl flex self-center text-center">Agendamento de Consultas</h1>
    </div>
    <x-card class="mb-4">
        <form action="{{ route('home') }}">
            @csrf
            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" wire:model="email" class="block mt-1 w-full" type="text" name="email" required />
            </div>

            <div>
                <x-label for="especialidade" value="{{ __('Especialidade Médica') }}" />
                <select id="especialidade" wire:model="especialidadeAtual" wire:change="especialidadeSelecionada" class="block mt-1 w-full" type="text" name="especialidade" required >
                    @foreach($especialidadeMedica as $espm)
                        <option value='{{$espm}}'>{{$espm}}</option>
                    @endforeach
                </select>

            </div>
            
            <div class="mt-4">
                <x-label for="medico" value="{{ __('Médico Especialista') }}" />
                <select id="medico" wire:model="nomeMedico" class="block mt-1 w-full" type="text" name="medico" required >
                    @foreach($medicosNaArea as $med)
                        <option value='{{$med}}'>{{$med}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4">
                <x-label for="data" value="{{ __('Data da Consulta') }}" />
                <x-input id="data" wire:model="dataEscolhida" wire:change="dataDefinida" class="block mt-1 w-full" type="date" name="data" required />
            </div>
            <div class="mt-4">
                <x-label for="horario" value="{{ __('Horário da Consulta') }}" />
                <select id="horario" wire:model="horarioEscolhido" class="block mt-1 w-full" type="number" name="horario" required >
                    @foreach($horariosPossiveis as $h)
                        <option value='{{$h}}'>{{$h}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-4">
                <x-button wire:click="cadastra()">
                    {{ __('Cadastrar') }}
                </x-button>
            </div>
        <form>
    </x-card>
</div>


