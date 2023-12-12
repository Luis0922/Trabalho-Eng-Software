<div>
    <div class="bg-[url('../../public/images/img2-homepage.png')] h-36 flex justify-center">
        <h1 class="text-white font-bold text-3xl flex self-center text-center">Listagens</h1>
    </div>
    <div class="m-20 mt-0" >
    <div class="mt-4">
                <x-label for="tabela" value="{{ __('Selecione qual tabela deseja visualizar') }}" />
                <select id="tabela" wire:model="tabela" wire:change="escolherTabela" class="block mt-1 w-full">
                    <option value="">Selecione...</option>
                    <option value="funcionario">Funcionário</option>
                    <option value="paciente">Paciente</option>
                </select>
            </div>
            @if($tabela=='funcionario')
                <livewire:funcionario-table/>
            @endif
            @if($tabela=='paciente')
                <livewire:paciente-table/>
            @endif
            </div>
</div>