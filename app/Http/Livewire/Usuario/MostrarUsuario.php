<?php

namespace App\Http\Livewire\Usuario;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class MostrarUsuario extends Component
{
    
    use WithPagination;

    public $title, $usuario;
    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '10';
    public $readyToLoad = false;
    public $rol;
    public $permiso = [];

    public $open_edit = false;
    
    //public $unidad = null;

    protected $rules = [
         'usuario.name' => 'required'
         ,'usuario.apellido'=> 'required'
        ,'usuario.email' => 'required'
        ,'usuario.estado' => 'required'
        ,'rol' => 'required'
        ,'permiso' => 'required'
       // ,'usuario.password' => 'required'
    ];


    protected $listeners = [
        'render'
        ,'delete'
    ];
    /* protected $listeners = ['render' => 'render']; */


    protected $queryString = [
        'cant'     =>['except'=> '10' ]
        ,'sort'     =>['except'=> 'id' ]
        ,'direction'=>['except'=> 'desc' ]
        ,'search'   =>['except'=> '' ]
    ];


    public function updatingSearch(){
        $this->resetPage();
    }

    public function loadUser(){
        $this->readyToLoad = true;
    }


    public function render()
    {
        $roles = Role::all();
        $permisos = Permission::all();
        
        if($this->readyToLoad){
            $usuarios = User::where('name', 'like', '%' . $this->search . '%')
                ->orwhere('apellido', 'like', '%' . $this->search . '%')
                ->orwhere('email', 'like', '%' . $this->search . '%')
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);
        }else{
            $usuarios = [];
        }
        //$this->unidad = Unidad::All();
        return view('livewire.usuario.mostrar-usuario', compact('usuarios','roles','permisos'));
    }




    public function order($sort)
    {
        if ($this->sort == $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    public function delete(User $usuario){
        $usuario->delete();
        //$this->emit('alert','eliminado','El item eliminado');
    }

   // public $chimenea = [];
    public function edit(User $usuario){
        $this->reset(['rol','permiso']);
        $this->usuario = $usuario;
        $this->rol = $this->usuario->roles->first()->id;// = $this->usuario->getRoleNames();
        $this->permiso = $this->usuario->permissions;
        $this->open_edit = true;
        
       // $this->chimenea = User::permission($this->role)->get();;

    }

    public function update(){
        $this->validate();
        $this->usuario->save();
        $this->usuario->assignRole($this->rol);
        $this->usuario->syncPermissions($this->permiso);
        $this->reset(['open_edit','rol','permiso']);
        //$this->emit('render');
        //$this->emitTo('inventario.mostrar-inventario','render');
        $this->emit('alert','Actualizado','El Usuario ha sido modificado exitosamente.');
    }

}
