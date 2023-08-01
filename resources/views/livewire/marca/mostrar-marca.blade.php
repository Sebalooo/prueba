
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               
            </h2>
        </x-slot>
        <div wire:init="loadMarca" >
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
        
                            @livewire('marca.crear-marca')
                    </div>
                      
                    @if (count($marcas))
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
                                    <th scope="col" class="cursor-pointer px-6 py-3" wire:click="order('nombre')">
                                        NOMBRE
                                        @if ($sort == 'nombre')
                                            @if ($direction == 'asc')
                                                <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                            @else
                                                <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort float-right mt-1"></i>
                                        @endif
                                    </th>
                                    <th scope="col" class="cursor-pointer px-6 py-3" wire:click="order('marca')">
                                        MARCA
                                        @if ($sort == 'marca')
                                            @if ($direction == 'asc')
                                                <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                            @else
                                                <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort float-right mt-1"></i>
                                        @endif
        
                                    </th>
                                    <th scope="col" class="cursor-pointer px-6 py-3" wire:click="order('modelo')">
                                        MODELO
                                        @if ($sort == 'modelo')
                                            @if ($direction == 'asc')
                                                <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                            @else
                                                <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort float-right mt-1"></i>
                                        @endif
        
                                    </th>
                                    <th scope="col" class="cursor-pointer px-6 py-3" wire:click="order('descripcion')">
                                        DESCRIPCION
                                        @if ($sort == 'descripcion')
                                            @if ($direction == 'asc')
                                                <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                            @else
                                                <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort float-right mt-1"></i>
                                        @endif
        
                                    </th>
                                   
                                    <th scope="col" class="px-6 py-3">
                                        Editar<span class="sr-only">Edit</span>
                                        
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        ELiminar<span class="sr-only">Delete</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($marcas as $item)
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
                                               //Botones para editar y eliminar
                                                <td class="px-6 py-4 ">
                                                    {{-- @livewire('inventario.editar-inventario', ['inventario' => $inv], key($inv->id)) --}}
                                                    <a class="btn btn-green" wire:click="edit({{$item}})">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                                                                      
                                                    
                                                </td>
                                                <td class="px-6 py-4 ">
                                                    {{-- @livewire('inventario.editar-inventario', ['inventario' => $inv], key($inv->id)) --}}
                                                    <a class="btn btn-red" wire:click="$emit('borrarMarca',{{$item->id}})">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                                                                     
                                                    
                                                </td>
                                        
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="px-6 py-3">
                            @if ($marcas->hasPages())
                                {{ $marcas->links() }}
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
            Editar Marca 
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="Nombre" />
                <x-jet-input wire:model="marca.nombre" type="text" class="w-full" />
                <x-jet-input-error for='marca.nombre'/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Marca" />
                <x-jet-input wire:model="marca.marca" type="text" class="w-full" />
                <x-jet-input-error for='marca.marca'/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Modelo" />
                <x-jet-input wire:model="marca.modelo" type="text" class="w-full" />
                <x-jet-input-error for='marca.modelo'/>
            </div>
            
            <div class="mb-4">
                <x-jet-label value="Descripcion" />
                <x-jet-input wire:model="marca.descripcion" type="text" class="w-full" />
                <x-jet-input-error for='marca.descripcion'/>
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
            Livewire.on('borrarMarca',itemId => {
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
                    //Livewire.emit('reset'itemId);
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