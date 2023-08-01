<div>
    <x-jet-danger-button  wire:click="$set('open','true')">
        Actualizar Orden de trabajo
    </x-jet-danger-button>
 
    <x-jet-dialog-modal style="vertical-align: middle" wire:model='open'>
        <x-slot name="title">
            Actualizar Orden de trabajo
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="Reasignar Prioridad" />
                <select wire:model="prioridad" class="mx-2 form-control">
                    <option value="" disabled>Seleccion</option>
                    <option value="4">Critica</option>
                    <option value="3">Alta</option>
                    <option value="2">Normal</option>
                    <option value="1">Baja</option>
                </select>
                <x-jet-input-error for='estado'/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Reasignar Estado" />
                <select wire:model="estado" class="mx-2 form-control">
                    <option value="" disabled>Seleccion</option>
                    <option value="1">SIN ASIGNAR</option>
                    <option value="2">ASIGNADA</option>
                    <option value="3">DESARROLLO</option>
                    <option value="4">CERRADA</option>
                </select>
                <x-jet-input-error for='estado'/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Razon o titulo" />
                <x-jet-input type="text" class="w-full" wire:model.defer='titulo'/>
                <x-jet-input-error for='titulo'/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Descripcion u Observacion" />
                <textarea rows="8" wire:model="observacion"
                    class="appearance-none block w-full bg-white text-gray-700 border border-gray-800 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                </textarea>
            </div>
            <hr>
            <div>
                <div class="px-6 py-4 flex  float-right">
                    <div class="items-right float-right">
                        <input type="text" class="w-full  float-right mx-4 items-end"
                            placeholder="Escriba busqueda para filtrar" wire:model='searchTwo'>
                    </div>


                    @role('Admin')
                    {{--@livewire('inventario.crear-inventario')--}}
                    @endrole
                </div>
                @if (count($repuestos))
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
                                    ESTADO

                                </th>
                                <th scope="col" class="cursor-pointer px-6 py-3">
                                    CANTIDAD
                                </th>
                                <th scope="col" class="cursor-pointer px-6 py-3">
                                    DESCRIPCION
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    SELECCIONE REPUESTOS PARA AGREGAR
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($repuestos as $item)
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
                                    {{$item->estado}}
                                        
                                </td>
                                <td class="px-6 py-4">
                                    {{$item->cantidad}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$item->detalle->nombre}}
                                </td>
                                {{-- <td class="px-6 py-4">
                                    @switch($item->estado)
                                    @case('1')
                                    EN STOCK
                                    @break
                                    @case(2)
                                    ALTA
                                    @break
                                    @case(3)
                                    BAJA
                                    @break
                                    @default
                                    REPARACION
                                    @endswitch
                                </td> --}}
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
                                    <input wire:model="seleccion" type="checkbox" value="{{$item->id}}" />

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="px-6 py-3">
                        @if ($repuestos->hasPages())
                        {{ $repuestos->links() }}
                        @endif
                    </div>
                @else
                    <div class="px-6 py-4 ">
                        No existe ningun registro coincidente.
                    </div>
                @endif
            </div>
            <hr>
            <div class="mb-4">
                <x-jet-label value="Adjuntar documentacion, si requiere" />
                <input type="file" class="w-full" wire:model="archivo" />
                <div wire:loading wire:target="archivo">
                    <strong>CARGANDO</strong>
                </div>
            </div>
            <hr>
            <div>
                <div class="px-6 py-4 flex  float-right">
                    <div class="items-right float-right">
                        <input type="text" class="w-full  float-right mx-4 items-end"
                            placeholder="Escriba busqueda para filtrar" wire:model='searchOne'>
                    </div>


                    @role('Admin')
                    {{--@livewire('inventario.crear-inventario')--}}
                    @endrole
                </div>
                @if (count($bitacoras))
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
                                    TITULO

                                </th>
                                <th scope="col" class="cursor-pointer px-6 py-3">
                                    OBSERVACION
                                </th>
                                <th scope="col" class="cursor-pointer px-6 py-3">
                                    FECHA
                                </th>
                                <th scope="col" class="cursor-pointer px-6 py-3">
                                    USUARIO ASIGNADO O RESPONSABLE
                                </th>
                                {{-- <th scope="col" class="px-6 py-3">
                                    SELECCIONAR
                                </th>--}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bitacoras as $item)
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
                                    {{$item->titulo}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$item->observacion}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$item->fecha}}
                                </td>
                                <td class="px-6 py-4">
                                    @json($item->usuario)
                                </td>
                                {{-- <td class="px-6 py-4">
                                    @switch($item->estado)
                                    @case('1')
                                    EN STOCK
                                    @break
                                    @case(2)
                                    ALTA
                                    @break
                                    @case(3)
                                    BAJA
                                    @break
                                    @default
                                    REPARACION
                                    @endswitch
                                </td> --}}
                               {{-- <td class="px-6 py-4 flex">
                                    @role('Admin|Tecnico')
                                    {{-- <a class="btn btn-green" wire:click="edit({{$item}})">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @else
                                    @endrole

                                    @role('Admin')
                                    {{-- <a class="btn btn-red ml-2" wire:click="$emit('borrarI',{{$item->id}})"><i
                                            class="fas fa-trash"></i></a> 
                                    @endrole
                                    <input wire:model="seleccion" type="checkbox" value="{{$item->id}}" />

                                </td>--}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="px-6 py-3">
                        @if ($bitacoras->hasPages())
                        {{ $bitacoras->links() }}
                        @endif
                    </div>
                @else
                    <div class="px-6 py-4 ">
                        No existe ningun registro coincidente.
                    </div>
                @endif
            </div>
            <hr>
            <div>
                <div class="px-6 py-4 flex  float-right">
                    <div class="items-right float-right">
                        <input type="text" class="w-full  float-right mx-4 items-end"
                            placeholder="Escriba busqueda para filtrar" wire:model='searchThree'>
                    </div>


                    @role('Admin')
                    {{--@livewire('inventario.crear-inventario')--}}
                    @endrole
                </div>
                @if (count($adjuntos))
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
                                    Bitacora Asignada

                                </th>
                                <th scope="col" class="cursor-pointer px-6 py-3">
                                    Fecha Subida
                                </th>
                                <th scope="col" class="cursor-pointer px-6 py-3">
                                    Justificacion
                                </th>
                                <th scope="col" class="cursor-pointer px-6 py-3">
                                    Enlace
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($adjuntos as $item)
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
                                    {{-- {{$item->bitacoras()->where('id', '=', $item->bitacora_id)->first()->titulo}} --}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$item->fecha_subida}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$item->razon}}
                                </td>
                                <td class="px-6 py-4">
                                   <a href=" {{$item->nombre_original}}">
                                    ENLACE
                                </a>
                                   
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="px-6 py-3">
                        @if ($adjuntos->hasPages())
                        {{ $adjuntos->links() }}
                        @endif
                    </div>
                @else
                    <div class="px-6 py-4 ">
                        No existe ningun registro coincidente.
                    </div>
                @endif
            </div>
         
                          
        </x-slot>
        <x-slot name="footer">
          
             <x-jet-secondary-button wire:click="closeModal">
                 Cancelar
             </x-jet-secondary-button>
             <x-jet-danger-button wire:click='save' wire:loading.attr="disabled" wire:target="save" class="disabled:opacity-25">
                 Actualizar
             </x-jet-danger-button>
             {{-- <span wire:loading wire:target="save">
                 Cargando...
             </span> --}}
        </x-slot>
 
        

    </x-jet-dialog-modal>
</div>

