<div class="py-12">
    <div class="  sm:px-6 lg:px-8">

        <x-slot name="header h12">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        </x-slot>
        <div wire:init="loadSolicitud">
            <x-table>
                {{--<div class="px-6 py-6 flex items-center">
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

                    @endrole

                </div>
                <div class="px-6 py-6 flex items-center">

                    <div class="mb-4">
                        <x-jet-label value="Unidad" />
                        <x-jet-input type="text" class="w-full" />
                        <x-jet-input-error for='unidad' />
                    </div>
                    <div class="mb-4">
                        <x-jet-label value="Edificio" />
                        <x-jet-input type="text" class="w-full" />
                        <x-jet-input-error for='edificio' />
                    </div>
                    <div class="mb-4">
                        <x-jet-label value="piso" />
                        <x-jet-input type="text" class="w-full" />
                        <x-jet-input-error for='piso' />
                    </div>
                    <div class="mb-4">
                        <x-jet-label value="Anexo" />
                        <x-jet-input type="text" class="w-full" />
                        <x-jet-input-error for='anexo' />
                    </div>
                    <x-jet-secondary-button wire:click="closeModal">
                        Cancelar
                    </x-jet-secondary-button>
                    <x-jet-danger-button wire:click='save' wire:loading.attr="disabled" wire:target="save"
                        class="disabled:opacity-25">
                        Generar Nuevo
                    </x-jet-danger-button>
                    <br>
                </div>--}}
                <div class="flex px-6 py-6 items-center">
                    <div class="flex items-center">
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="grid-state">

                            </label>
                        </div>
                    </div>
                </div>
                <div class="flex flex-auto -mx-3 mb-6">
                    <div class="w-1/2 md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-state">
                            Tipo de Solicitud @json($auto)
                        </label>
                        <div class="relative">
                            <select wire:model="tipoSolicitud"
                                class="block w-full border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 form-control"
                                >
                                <option selected disabled>Tipo de requerimiento</option>
                                <option value=1>compra</option>
                                <option value=2>reparacion</option>
                                <option value=3>mantencion</option>
                            </select>

                        </div>
                    </div>
                    <div class="w-1/2 md:w-1/3 px-3 mb-6 md:mb-0">
                        <label  class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-state">
                            Prioridad
                        </label>
                        <div class="relative">
                            <select wire:model="prioridad"
                                class="block w-full border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 form-control"
                                id="grid-state">
                                <option value="4">Critica</option>
                                <option value="3">Alta</option>
                                <option value="2">Normal</option>
                                <option value="1">Baja</option>
                            </select>

                        </div>

                    </div>
                    


                    
                    <div class=" w-1/5 md:w-1/3 px-3 mb-6 md:mb-0 ">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-first-name">
                            Fecha Asignada
                        </label>
                        <x-date class="block w-full border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 form-control" id="fechaAsignada" wire:model="fechaAsignada" />
                        
                    </div>
                    <div class=" w-1/5 md:w-1/3 px-3 mb-6 md:mb-0 ">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-first-name">
                            Unidad {{-- Unidad @json($auto) --}}
                        </label>
                        <x-jet-input disabled wire:model="unidad" type="text" class="block w-full border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 form-control" />
                    
                    </div>
                </div>
                <div>
                    <div class="px-6 py-4 flex  float-right">
                        <div class="items-right float-right">
                            <input type="text" class="w-full  float-right mx-4 items-end"
                                placeholder="Escriba busqueda para filtrar" wire:model='search'>
                        </div>


                        @role('Admin')
                        {{--@livewire('inventario.crear-inventario')--}}
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
                                        SERIAL

                                    </th>
                                    <th scope="col" class="cursor-pointer px-6 py-3">
                                        FECHA INGRESO
                                    </th>
                                    <th scope="col" class="cursor-pointer px-6 py-3">
                                        NOMBRE
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        SELECCIONAR
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inventarios as $item)
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
                                        {{$item->serial}}                                            
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$item->fecha_ingreso}}
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
                            @if ($inventarios->hasPages())
                            {{ $inventarios->links() }}
                            @endif
                        </div>
                    @else
                        <div class="px-6 py-4 ">
                            No existe ningun registro coincidente.
                        </div>
                    @endif
                </div>

                {{-- <div class="float-right "> seleccion maquinaria: @json($seleccion) </div> --}}
                <br>

                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-last-name">
                            Titulo resumen Problema
                        </label>
                        <x-jet-input wire:model="titulo" type="text" class="block w-full border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 form-control" />
                    
                    </div>

                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3">
                        <label  class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-last-name">
                            Breve Descripcion del Problema
                        </label>
                        <textarea rows="8" wire:model="observacion"
                            class="appearance-none block w-full bg-white text-gray-700 border border-gray-800 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">

                        </textarea>
                    </div>

                </div>


                

                <div class="float-right">
 `                  <x-jet-secondary-button wire:click="closeModal">
                        Cancelar
                    </x-jet-secondary-button>
                    <span></span>
                    <x-jet-danger-button wire:click='save' wire:loading.attr="disabled" wire:target="save"
                        class="disabled:opacity-25">
                        Generar Nuevo
                    </x-jet-danger-button>
                </div>

               


            </x-table>
        </div>


    </div>
     <script src="{{ asset('js/app.js') }}"></script>
</div>
