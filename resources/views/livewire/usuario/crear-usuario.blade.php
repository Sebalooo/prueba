<div>
    <x-jet-danger-button  wire:click="$set('open','true')">
        Crear Usuario
    </x-jet-danger-button>
 
    <x-jet-dialog-modal style="vertical-align: middle" wire:model='open'>
        <x-slot name="title">
             Crear nuevo usuario
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="Nombre Usuario #" />
                <x-jet-input type="text" class="w-full" wire:model='name'/>
                <x-jet-input-error for='name'/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Apellido" />
                <x-jet-input type="text" class="w-full" wire:model='apellido'/>
                <x-jet-input-error for='apellido'/>
            </div>
             <div class="mb-4">
                 <x-jet-label value="Correo electronico" />
                 <x-jet-input type="email" class="w-full" wire:model='email'/> 
                 <x-jet-input-error for='email'/>
             </div>
             <div class="mb-4">
                <x-jet-label value="Clave" />
                <x-jet-input type="password" class="w-full" wire:model='password'/> 
                <x-jet-input-error for='password'/>
            </div> 
            <div class="mb-4">
                <x-jet-label value="Asignar unidad" />
                <select wire:model.defer="uni" class="mx-2 form-control">
                    <option value="" disabled>None</option>
                    @foreach ($unidad as $unit )
                        <option value="{{$unit->id}}">{{$unit->unidad}}</option>    
                    @endforeach
                </select>
            </div>
            <hr>
            <div>Rol y Permisos</div>
            <div class="grid grid-cols-2 gap-4">
               <div class="mb-4">
                <x-jet-label value="Rol" />
                <select wire:model="rol" class="mx-2 form-control">
                    @foreach ($roles as $r )
                        <option value="{{$r->id}}">{{$r->name}}</option>    
                    @endforeach
                    
                </select>
            </div>
            <div wire:ignore>
                <x-jet-label value="Permisos" />
                <select wire:model="permiso" class="mx-2 form-control" multiple>
                    @foreach ($permisos as $p )
                        <option value="{{$p->id}}">{{$p->name}}</option>    
                    @endforeach
                    
                </select>
            </div>

           



        </x-slot>
        <x-slot name="footer">
             <x-jet-secondary-button wire:click="closeModal">
                 Cancelar
             </x-jet-secondary-button>
           
             <x-jet-danger-button wire:click='save' wire:loading.attr="disabled" wire:target="save" class="disabled:opacity-25">
                 Crear Nuevo
             </x-jet-danger-button>
            
             {{-- <span wire:loading wire:target="save">
                 Cargando...
             </span> 
        </x-slot>
 
    </x-jet-dialog-modal>
</div>
