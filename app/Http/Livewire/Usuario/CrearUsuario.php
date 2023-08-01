<?php

namespace App\Http\Livewire\Usuario;

use App\Models\Unidad;
use App\Models\User;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class CrearUsuario extends Component
{
    
    public function render()
    {

        $roles = Role::all();
        $permisos = Permission::all();
        $unidad = Unidad::All();

       // abort_unless(\Auth::user()->can('usuario.create'), '403', 'Unauthorized.');
       // $rols = Role::all();
        return view('livewire.usuario.crear-usuario',compact('roles','permisos','unidad'));
    }

    public $open = false;
    public $name,$apellido,$email, $estado, $password,$uni;//,$roles;
    public $rol;
    public $permiso = [];
    


    protected $rules = [
        'name' => 'required'
        ,'apellido'=> 'required'
       ,'email' => 'required'
       //,'estado' => 'required'
       ,'password' => 'required'
       ,'rol' => 'required'
       ,'permiso' => 'required'
       ,'uni' =>'required'
      // ,'roles' => 'required'
   ];

   public function updated($propertyName){
    $this->validateOnly($propertyName);
}


public function save(){

    $this->validate();

    $guardar = User::create(
        [

            'name' => $this->name
            ,'apellido'=> $this->apellido
            ,'email' => $this->email
            ,'password' => bcrypt($this->password)
            ,'estado' => 2        
            ,'unidad_id'  => $this->uni
        ]
    );

    $guardar->assignRole($this->rol);
    $guardar->syncPermissions($this->permiso);

    //$guardar->assignRole();


    $this->reset([
         'name'
        ,'email'
        ,'estado'
        ,'open'
        ,'rol'
        ,'permiso'
        ,'uni'
    ]);

    //$this->emit('render');
    $this->emitTo('usuario.mostrar-usuario','render');
    $this->emit('alert','Usuario creado','El usuario se ha creado satisfactoriamente');

}

public function updatingOpen(){
    if(!$this->open){
        $this->reset([ 
             'name'
             ,'apellido'
            ,'email'
            ,'estado'
            ,'open'
            ,'rol'
            ,'permiso'
            ,'uni'
        ]);
    }

}



public function closeModal(){
    $this->reset([ 
        'name'
     ,'apellido'
       ,'email'
       ,'estado'
       ,'open'
       ,'rol'
       ,'permiso'
       ,'uni'
   ]);
}

}
