<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               
            </h2>
        </x-slot>
        <div wire:init="loadUser" >
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
                              @livewire('usuario.crear-usuario')
                            @endrole
                      
                    </div>
                    @can('usuario.create')
                    
                    @if (count($usuarios))
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
                                        NOMBRE DE USUARIO
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
                                </th>
                                <th scope="col" class="cursor-pointer px-6 py-3" wire:click="order('apellido')">
                                    APELLIDO
                                    @if ($sort == 'apellido')
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
                                        EMAIL
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
                                    <th scope="col" class="cursor-pointer px-6 py-3" wire:click="order('estado')">
                                        ESTADO
                                        @if ($sort == 'estado')
                                            @if ($direction == 'asc')
                                                <i class="fas fa-sort-alpha-up float-right mt-1"></i>
                                            @else
                                                <i class="fas fa-sort-alpha-down float-right mt-1"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort float-right mt-1"></i>
                                        @endif
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        ACCIONES<span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usuarios as $item)
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
                                            {{$item->name}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$item->apellido}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$item->email}}
                                        </td>
                                        <td class="px-6 py-4">
                                            @switch($item->estado)
                                                @case('1')
                                                    INACTIVO
                                                    @break
                                                @case(2)
                                                    ACTIVO
                                                    @break
                                                @case(3)
                                                    BLOQUEADO
                                                    @break
                                                @default
                                                    OTRO
                                            @endswitch
                                        </td>
                                        
                                        <td class="px-6 py-4 flex">
                                            {{-- @livewire('inventario.editar-inventario', ['inventario' => $inv], key($inv->id)) --}}
                                            @role('Admin') 
                                             <a class="btn btn-green" wire:click="edit({{$item}})">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @endrole
                                            
                                            
                                                {{-- <a class="btn btn-red ml-2" wire:click="$emit('borrarU',{{$item->id}})" ><i class="fas fa-trash"></i></a>  --}}
                                           
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="px-6 py-3">
                            @if ($usuarios->hasPages())
                                {{ $usuarios->links() }}
                            @endif
                        </div> 
                    @else
                        <div class="px-6 py-4 ">
                            No existe ningun registro coincidente.
                        </div>
        
        
                    @endif
                    
                    @else
                        <div class="px-6 py-4 ">
                            No se permite la visualizacion con sus permisos actuales.
                        </div>  
                    @endcan
        
        
                </x-table>
        
          
                  
            
        
        
        </div>

    </div>


    <x-jet-dialog-modal  wire:model="open_edit">
        <x-slot name="title">
            <br/>
            Editar Usuario 
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="Nombre de usuario" />
                <x-jet-input wire:model="usuario.name" type="text" class="w-full" />  // readonly DESPUES DE W-FULLS
                <x-jet-input-error for='usuario.name'/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Apellido" />
                <x-jet-input wire:model="usuario.apellido" type="text" class="w-full"  /> // readonly DESPUES DE W-FULLS
                <x-jet-input-error for='usuario.apellido'/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Correo electronico" />
                <x-jet-input wire:model="usuario.email" type="email" class="w-full" />

                <x-jet-input-error for='usuario.email'/>
            </div>
            <div class="mb-4">
                <x-jet-label value="estado" />
                <select wire:model="usuario.estado" class="mx-2 form-control">
                    <option value="1">Desactivado</option>
                    <option value="2">Activo</option>
                    <option value="3">Bloqueado</option>
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
            Livewire.on('borrarU',itemId => {
            Swal.fire({
                title: 'Esta seguro de Desactivar al usuario?',
                text: "El usuario quedara desactivado",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, desactivar.'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('delete',itemId);
                    Swal.fire(
                        'Desactivado!',
                        'El usuario esta desactivado.',
                        'success'
                    )
                }
            })
           });
        </script>
    @endpush


   
</div>

