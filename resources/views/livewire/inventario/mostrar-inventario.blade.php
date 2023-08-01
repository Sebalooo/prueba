<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               
            </h2>
        </x-slot>
        <div wire:init="loadInventario" >
                <x-table>
                    <div class="px-6 py-4 flex items-center">
                        <div class="flex items-center">
                            <span>
                                Mostrar
                            </span>
                            <select wire:model="cant" class="mx-2 form-control">
                                <option value="10">10&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <span>
                                Entradas
                            </span>
                        </div>
        
                        <input type="text" class="w-full flex-1 mx-4" placeholder="Escriba busqueda para filtrar"
                            wire:model='search'>
        
                       
                        @role('Admin') 
                         @livewire('inventario.crear-inventario')
                        @endrole
                    </div>
                    @if (count($inventarios))
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
                                    <th scope="col" class="w-24 cursor-pointer px-6 py-3">{{-- </th>wire:click="order('id')"> --}}
                                        ID
                                    </th>
                                    <th scope="col" class="cursor-pointer px-6 py-3">
                                        NOMBRE
                                        {{-- @if ($sort == 'nombre')
                                            @if ($direction == 'asc')
                                                <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                            @else
                                                <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort float-right mt-1"></i>
                                        @endif --}}
                                    </th>
                                    {{-- <th scope="col" class="cursor-pointer px-6 py-3">
                                        E/A*
                                    </th> --}}
                                    <th scope="col" class="cursor-pointer px-6 py-3">
                                        DESCRIPCION
                                    </th>
                                    <th scope="col" class="cursor-pointer px-6 py-3" >
                                        SERIAL
                                      
                                   
        
                                    </th>
                                    <th scope="col" class="cursor-pointer px-6 py-3" >
                                        MODELO
                                     
                                    </th>
                                    <th scope="col" class="cursor-pointer px-6 py-3" >
                                        MARCA
                                      
        
                                    </th>
                                    <th scope="col" class="cursor-pointer px-6 py-3" >
                                        FECHA INGRESO
                                       
        
                                    </th>
                                    <th scope="col" class="cursor-pointer px-6 py-3">
                                       Unidad
                                       
        
                                    </th>

                                    <th scope="col" class="cursor-pointer px-6 py-3">
                                        ESTADO
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        ACCIONES<span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inventarios as $item)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                       {{--  <td class="w-4 p-4">
                                            <div class="flex items-center">
                                                <input id="checkbox-table-search-1" type="checkbox"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                            </div>
                                        </td>  --}}
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white ">
                                            {{$item->serie}}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{$item->detalle->nombre}}
                                        </td>
                                        {{-- <td class="px-6 py-4">
                                            {{$item->tipo}}
                                        </td> --}}
                                        <td class="px-6 py-4">
                                            {{$item->detalle->descripcion}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$item->serial}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$item->detalle->modelo}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$item->detalle->marca}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$item->fecha_ingreso}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$item->unidad->unidad}}
                                        </td>
                                        <td class="px-6 py-4">
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
                                                @case(4)
                                                    REPARACION
                                                    @break
                                                @default
                                                    ELIMINADO
                                            @endswitch
                                        </td>
                                        <td class="px-6 py-4 flex">
                                            {{-- @livewire('inventario.editar-inventario', ['inventario' => $inv], key($inv->id)) --}}
                                            @role('Admin|Tecnico') 
                                                <a class="btn btn-green" wire:click="edit({{$item}})">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @else
                                            @endrole
                                            
                                            @role('Admin')    
                                                <a class="btn btn-red ml-2" wire:click="$emit('borrarI',{{$item->id}})" ><i class="fas fa-trash"></i></a> 
                                           @endrole
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="px-6 py-3">
                            @if ($inventarios->hasPages())
                                {{ $inventarios->links() }}
                            @endif
                        </div> 
                    @else
                        <div class="px-6 py-4 ">
                            No existe ningun registro coincidente.
                        </div>
        
        
                    @endif
        
                    
        
        
                </x-table>
        
          
                  
            
        
        
        </div>

    </div>


    <x-jet-dialog-modal  wire:model="open_edit">
        <x-slot name="title">
            <br/>
            Editar Modulo  @json('inventario')
        </x-slot>
        <x-slot name="content">
            {{-- <div class="mb-4">
                <x-jet-label value="Lote #" />
                <x-jet-input wire:model="inventario.lote" type="text" class="w-full" />
                <x-jet-input-error for='inventario.lote'/>
            </div> --}}
            <div class="mb-4">
                <x-jet-label value="Serial #" />
                <x-jet-input wire:model="inventario.serial" type="text" class="w-full" />
                <x-jet-input-error for='inventario.serial'/>
            </div>
            <div class="mb-4">
                <x-jet-label value="estado" />
                <select wire:model="inventario.estado" class="mx-2 form-control">
                   
                    <option value="1">En Stock</option>
                    <option value="2">Alta</option>
                    <option value="3">Baja</option>
                    <option value="4">Reparacion</option>
                </select>
            </div>
            {{-- <div>test: @json($inventario->unidad_id)</div>
            <div>test: @json($unidad)</div> --}}
            <div class="mb-4">
                <x-jet-label value="reasignar unidad" />
                <select wire:model="inventario.unidad_id" class="mx-2 form-control">
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
                                        <input wire:model="inventario.detalle_id" type="radio" value="{{$item->id}}" />

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
            <x-jet-secondary-button wire:click="$set('open_edit',false)">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click='update' wire:loading.attr="disabled" wire:target="save" class="disabled:opacity-25">
                Actualizar
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal> 


    @push('js')
    <script src="{{ asset('vendor/sw2/sweetalert2.all.min.js') }}"></script>
        <script>
            Livewire.on('borrarI',itemId => {
            Swal.fire({
                title: 'Esta seguro de Eliminar el Item del inventario?',
                text: "No se puede revertir esta accion!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar.'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('delete',itemId);
                    Swal.fire(
                        'Eliminado!',
                        'El Item de nventario ha sido eliminado del sistema.',
                        'success'
                    )
                }
            })
           });
        </script>
    @endpush


   
</div>

