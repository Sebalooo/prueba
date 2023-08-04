<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               
            </h2>
        </x-slot>
        <div wire:init="loadUnidad" >
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
                                Entradasssssssssssssssssssssssssssss
                            </span>
                        </div>
        
                        <input type="text" class="w-full flex-1 mx-4" placeholder="Escriba busqueda para filtrar"
                            wire:model='search'>
        
                        @livewire('unidad.crear-unidad')
                      
                        
                    </div>
                      
                    @if (count($unidades))
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
                                    <th scope="col" class="cursor-pointer px-6 py-3" wire:click="order('unidad')">
                                        UNIDAD
                                        @if ($sort == 'unidad')
                                            @if ($direction == 'asc')
                                                <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                            @else
                                                <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort float-right mt-1"></i>
                                        @endif
                                    </th>
                                    <th scope="col" class="cursor-pointer px-6 py-3" wire:click="order('edificio')">
                                        EDIFICIO
                                        @if ($sort == 'edificio')
                                            @if ($direction == 'asc')
                                                <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                            @else
                                                <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort float-right mt-1"></i>
                                        @endif
        
                                    </th>
                                    <th scope="col" class="cursor-pointer px-6 py-3" wire:click="order('piso')">
                                        PISO
                                        @if ($sort == 'piso')
                                            @if ($direction == 'asc')
                                                <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                            @else
                                                <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort float-right mt-1"></i>
                                        @endif
        
                                    </th>
                                    <th scope="col" class="cursor-pointer px-6 py-3" >
                                        ANEXO
                                     
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        ACCIONES<span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($unidades as $item)
                                    <tr

                                        class="bg-white border-b  dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                       {{--  <td class="w-4 p-4">
                                            <div class="flex items-center">
                                                <input id="checkbox-table-search-1" type="checkbox"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                            </div>
                                        </td>  --}}
                                         @if($item->activo=='0')
                                             <th scope="row" class="px-6 py-4 font-medium text-gray-20 dark:text-white bg-black">
                                                <strike>{{$item->id}}
                                                    </strike>
                                        @else
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white ">
                                                {{$item->id}}
                                        @endif
                                        </th>
                                        <td class="px-6 py-4">
                                            {{$item->unidad}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$item->edificio}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$item->piso}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$item->anexo}}
                                        </td>
                                        <td class="px-6 py-4 flex">
                                            {{-- @livewire('inventario.editar-inventario', ['inventario' => $inv], key($inv->id)) --}}
                                            <a class="btn btn-green" wire:click="edit({{$item}})">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                                @if ($item->activo==0)
                                                  <a class="btn btn-blue ml-2" wire:click="$emit('activar',{{$item}})" ><i class="fas fa-trash"></i></a> 
                                                @else  
                                                <a class="btn btn-red ml-2" wire:click="$emit('desactivar',{{$item}})" ><i class="fas fa-trash"></i></a> 
                                                @endif
                                              
                                           
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="px-6 py-3">
                            @if ($unidades->hasPages())
                                {{ $unidades->links() }}
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
            Editar Unidad 
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="unidad" />
                <x-jet-input wire:model="uni.unidad" type="text" class="w-full" />
                <x-jet-input-error for='uni.unidad'/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Edificio" />
                <x-jet-input wire:model="uni.edificio" type="text" class="w-full" />

                <x-jet-input-error for='uni.edificio'/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Piso" />
                {{--<x-jet-input wire:model="inventario.modelo" type="text" class="w-full form-control" min="1" max="5" placeholder="1" />--}}
                <x-jet-input wire:model="uni.piso" type="text" class="w-full" />
                <x-jet-input-error for='uni.piso'/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Anexo" />
                {{--<x-jet-input wire:model="inventario.modelo" type="text" class="w-full form-control" min="1" max="5" placeholder="1" />--}}
                <x-jet-input wire:model="uni.anexo" type="text" class="w-full" />
                <x-jet-input-error for='uni.anexo'/>
            </div>
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
            Livewire.on('desactivar',itemId => {
            Swal.fire({
                title: 'Esta seguro de Eliminar la unidad?',
                text: "No se puede revertir esta accion!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar.'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('desactivar',itemId);
                    Swal.fire(
                        'Eliminado!',
                        'la unidad ha sido eliminada.',
                        'success'
                    )
                }
            })
           });
           Livewire.on('activar',itemId => {
            Swal.fire({
                title: 'Esta seguro de activar la unidad?',
                text: "No se puede revertir esta accion!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar.'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('activar',itemId);
                    Swal.fire(
                        'Eliminado!',
                        'la unidad ha sido eliminada.',
                        'success'
                    )
                }
            })
           });
        </script>
    @endpush


   
</div>

