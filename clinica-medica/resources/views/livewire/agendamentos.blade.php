<div>
    <div class="bg-[url('../../public/images/img2-homepage.png')] h-36 flex justify-center">
        <h1 class="text-white font-bold text-3xl flex self-center text-center">Agendamento de Consultas</h1>
    </div>
    <x-card class="mb-4">
        <form method="POST" action="">
            
            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="text" name="email" required />
            </div>

            <div class="mt-4">
                <x-label for="especialidade" value="{{ __('Especialidade Médica') }}" />
                <x-select id="especialidade" class="block mt-1 w-full" type="text" name="especialidade" required />
            </div>

            <div class="mt-4">
                <x-label for="medico" value="{{ __('Médico Especialista') }}" />
                <x-select id="medico" class="block mt-1 w-full" type="text" name="medico" required />
            </div>
            <div class="mt-4">
                <x-label for="data" value="{{ __('Data da Consulta') }}" />
                <x-select id="data" class="block mt-1 w-full" type="number" name="data" required />
            </div>
            <div class="mt-4">
                <x-label for="horario" value="{{ __('Horário da Consulta') }}" />
                <x-select id="horario" class="block mt-1 w-full" type="number" name="horario" required />
            </div>
            <div class="mt-4">
                <x-button>
                    {{ __('Agendar') }}
                </x-button>
            </div>
</div>
</form>
</x-card>
</div>


