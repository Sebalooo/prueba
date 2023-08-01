<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              
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
                        {{--@livewire('inventario.crear-inventario')--}}
                        @endrole
                    </div>
                      
                    @if (count($trabajos))
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
                                    <th scope="col" class="cursor-pointer px-6 py-3" wire:click="order('estado')">
                                        ESTADO
                                        @if ($sort == 'estado')
                                            @if ($direction == 'asc')
                                                <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                            @else
                                                <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort float-right mt-1"></i>
                                        @endif
                                    </th>
                                    <th scope="col" class="cursor-pointer px-6 py-3" wire:click="order('tipo_orden')">
                                        TIPO ORDEN
                                        @if ($sort == 'tipo_orden')
                                            @if ($direction == 'asc')
                                                <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                            @else
                                                <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort float-right mt-1"></i>
                                        @endif
        
                                    </th>
                                    <th scope="col" class="cursor-pointer px-6 py-3" wire:click="order('prioridad')">
                                        PRIORIDAD
                                      
                                   
        
                                    </th>
                                    <th scope="col" class="cursor-pointer px-6 py-3" wire:click="order('tipo_mantencion')">
                                        TIPO MANTENCION
                                     
                                    </th>
                                    <th scope="col" class="cursor-pointer px-6 py-3" wire:click="order('fecha_inicio')">
                                        FECHA INICIO CASO
                                      
        
                                    </th>
                                    <th scope="col" class="cursor-pointer px-6 py-3" wire:click="order('fecha_inicio')">
                                        FECHA TERMINO CASO
                                      
        
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        ACCIONES<span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($trabajos as $item)
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
                                            {{$item->id}}
                                        </th>
                                        <td class="px-6 py-4">
                                            @switch($item->estado)
                                            @case('1')
                                                SIN ASIGNAR
                                                @break
                                            @case(2)
                                                ASIGNADA
                                                @break
                                            @case(3)
                                                DESARROLLO
                                                @break
                                            @default
                                                CERRADA
                                        @endswitch
                                        </td>
                                        <td class="px-6 py-4">
                                            @switch($item->orden)
                                            @case('1')
                                                COMPRA
                                                @break
                                            @case(2)
                                                REPARACION
                                                @break
                                            @default
                                                MANTENCION
                                        @endswitch
                                        </td>
                                        <td class="px-6 py-4">
                                            @switch($item->prioridad)
                                            @case('1')
                                                BAJA
                                                @break
                                            @case(2)
                                                NORMAL
                                                @break
                                            @case(3)
                                                ALTA
                                                @break
                                            @default
                                                CRITICA
                                        @endswitch
                                        </td>
                                        <td class="px-6 py-4">
                                            @switch($item->tipo_mantencion)
                                            @case('1')
                                                SIN ASIGNAR
                                                @break
                                            @case(2)
                                                CORRECTIVA
                                                @break
                                            @default
                                                PREVENTIVA
                                        @endswitch
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$item->fecha_inicio}}
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($item->fecha_termino == NULL)
                                             <b>PENDIENTE</b>
                                            @else
                                            {{$item->fecha_termino}}
                                            @endif

                                        </td>
                                        <td class="px-6 py-4 flex">
                                            {{-- @livewire('inventario.editar-inventario', ['inventario' => $inv], key($inv->id)) --}}
                                           @livewire('orden-de-trabajo.crear-trabajo',['trabajo' => $item],key($item->id))

                                            @role('Admin|Tecnico') 
                                                <a class="ml-2 btn btn-green" wire:click="edit({{$item}})">
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
                            @if ($trabajos->hasPages())
                                {{ $trabajos->links() }}
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


    

   
</div>


