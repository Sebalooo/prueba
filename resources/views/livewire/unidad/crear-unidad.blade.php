<div>
    <x-jet-danger-button  wire:click="$set('open','true')">
        Ingresar unidad nuevaaaaaaa
    </x-jet-danger-button>
 
    <x-jet-dialog-modal style="vertical-align: middle" wire:model='open'>
        <x-slot name="title">
             Integrar nueva unidad
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="Unidad" />
                <x-jet-input type="text" class="w-full" wire:model.defer='unidad'/>
                <x-jet-input-error for='unidad'/>
            </div>
            <div class="mb-4">
                 <x-jet-label value="Edificio" />
                 <x-jet-input type="text" class="w-full" wire:model.defer='edificio'/>
                 <x-jet-input-error for='edificio'/>
             </div>
             <div class="mb-4">
                 <x-jet-label value="piso" />
                 <x-jet-input type="text" class="w-full" wire:model.defer='piso'/> 
                 <x-jet-input-error for='piso'/>
             </div>
             <div class="mb-4">
                <x-jet-label value="Anexo" />
                <x-jet-input type="text" class="w-full" wire:model.defer='anexo'/>
                <x-jet-input-error for='anexo'/>
            </div>
            
        </x-slot>
        <x-slot name="footer">
             <x-jet-secondary-button wire:click="closeModal">
                 Cancelar
             </x-jet-secondary-button>
             <x-jet-danger-button wire:click='save' wire:loading.attr="disabled" wire:target="save" class="disabled:opacity-25">
                 Generar Nuevo
             </x-jet-danger-button>
             {{-- <span wire:loading wire:target="save">
                 Cargando...
             </span> --}}
        </x-slot>
 
    </x-jet-dialog-modal>
</div>
