<div>
    <x-jet-danger-button  wire:click="$set('open','true')">
        Ingresar Objeto Inventario
    </x-jet-danger-button>
 
    <x-jet-dialog-modal style="vertical-align: middle" wire:model='open'>
        <x-slot name="title">
             Integrar nuevo Instrumento
        </x-slot>
        <x-slot name="content">
            {{-- <div class="mb-4">
                <x-jet-label value="Lote #" />
                <x-jet-input type="text" class="w-full" wire:model.defer='serial'/>
                <x-jet-input-error for='serial'/>
            </div> --}}
            <div class="mb-4">
                <x-jet-label value="Serial #" />
                <x-jet-input type="text" class="w-full" wire:model.defer='serial'/>
                <x-jet-input-error for='serie'/>
            </div>
           
             <div class="mb-4">
                <x-jet-label value="Estado" />
                <select wire:model.defer="estado" class="mx-2 form-control">
                    <option value="" disabled>Seleccion</option>
                    <option value="1">En Stock</option>
                    <option value="2">Alta</option>
                    <option value="3">Baja</option>
                    <option value="4">Reparacion</option>
                </select>
                <x-jet-input-error for='estado'/>
            </div>
            {{-- <div class="mb-4">
                <x-jet-label value="Tipo " />
                <select wire:model="tipo" class="mx-2 form-control">
                    <option value="" disabled>Seleccion</option>
                    <option value="1">Equipo</option>
                    <option value="2">Accesorio</option>
                </select>
                <x-jet-input-error for='tipo'/>
            </div> --}}
            <div class="mb-4">
                <x-jet-label value="Asignar unidad" />
                <select wire:model.defer="unidad_id" class="mx-2 form-control">
                    <option value="" disabled>None</option>
                    @foreach ($unidad as $unit )
                        <option value="{{$unit->id}}">{{$unit->unidad}}</option>    
                    @endforeach
                </select>
            </div>
             <x-table>
               
                <div>
                   
                        <div class="float-right">
                            <input type="text" class="w-full  float-right mx-4 items-end"
                                placeholder="Escriba busqueda para filtrar" wire:model='search'>
                        </div>
                    
                      <label class=" block uppercase tracking-wide text-gray-700 text-xs font-bold">
                                Seleccion de Nombre y Marca de Instrumento
                           </label>

                    @if (count($detalles))
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    {{-- <th scope="col" class="p-4">
                                        <div class="cursor-pointer flex items-center">
                                            <input id="checkbox-all-search" type="checkbox"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="checkbox-all-search" class="sr-only">checkbox</label>
                                        </div>
                                    </th> --}}
                                    <th scope="col" class="w-24 cursor-pointer px-6 py-3" wire:click="order('id')">
                                        ID
                                        @if ($sort == 'id')
                                        @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                        @else
                                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                        @endif
                                        @else
                                        <i class="fas fa-sort float-right mt-1"></i>
                                        @endif
                                    </th>
                                    <th scope="col" class="cursor-pointer px-6 py-3">
                                        NOMBRE

                                    </th>
                                    <th scope="col" class="cursor-pointer px-6 py-3">
                                        MARCA
                                    </th>
                                    <th scope="col" class="cursor-pointer px-6 py-3">
                                        MODELO
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        DESCRIPCION
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detalles as $item)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    {{-- <td class="w-4 p-4">
                                        <div class="flex items-center">
                                            <input id="checkbox-table-search-1" type="checkbox"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                        </div>
                                    </td> --}}
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white ">
                                        {{$item->id}}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{$item->nombre}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$item->marca}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$item->modelo}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$item->descripcion}}
                                    </td>
                                    <td class="px-6 py-4 flex">
                                        {{-- @livewire('inventario.editar-inventario', ['inventario' => $inv],
                                        key($inv->id)) --}}
                                        @role('Admin|Tecnico')
                                        {{-- <a class="btn btn-green" wire:click="edit({{$item}})">
                                            <i class="fas fa-edit"></i>
                                        </a> --}}
                                        @else
                                        @endrole

                                        @role('Admin')
                                        {{-- <a class="btn btn-red ml-2" wire:click="$emit('borrarI',{{$item->id}})"><i
                                                class="fas fa-trash"></i></a> --}}
                                        @endrole
                                        <input wire:model="seleccion" type="radio" value="{{$item->id}}" />

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="px-6 py-3">
                            @if ($detalles->hasPages())
                            {{ $detalles->links() }}
                            @endif
                        </div>
                    @else
                        <div class="px-6 py-4 ">
                            No existe ningun registro coincidente.
                        </div>
                    @endif
                </div>
             </x-table>

             
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
