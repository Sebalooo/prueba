<div>
    <x-jet-danger-button  wire:click="$set('open','true')">
        Ingresar Proveedor Nuevo
    </x-jet-danger-button>
 
    <x-jet-dialog-modal style="vertical-align: middle" wire:model='open'>
        <x-slot name="title">
             Integrar nuevo Proveedor
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="Nombre" />
                <x-jet-input type="text" class="w-full" wire:model.defer='nombre'/>
                <x-jet-input-error for='nombre'/>
            </div>
            <div class="mb-4">
                 <x-jet-label value="Rut" />
                 <x-jet-input type="text" class="w-full" wire:model.defer='rut'/>
                 <x-jet-input-error for='rut'/>
             </div>
             <div class="mb-4">
                 <x-jet-label value="telefono" />
                 <x-jet-input type="text" class="w-full" wire:model.defer='telefono'/> 
                 <x-jet-input-error for='telefono'/>
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