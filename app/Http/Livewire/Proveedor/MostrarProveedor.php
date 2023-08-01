<?php

namespace App\Http\Livewire\Proveedor;

use App\Models\Repuesto;
use App\Models\Proveedor;
use Livewire\Component;
use Livewire\WithPagination;

class MostrarProveedor extends Component

{
    use WithPagination;

    public $title, $prove;
    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '10';
    public $readyToLoad = false;

    public $open_edit = false;
    //public $unidad = null;

    protected $rules = [
         'prove.nombre' => 'required'
        ,'prove.rut' => 'required'
        ,'prove.telefono' => 'required'
        
    ];


    protected $listeners = [
        'render'
        ,'delete'
        ,'activar'
        ,'desactivar'
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

    public function loadProveedor(){
        $this->readyToLoad = true;
    }






    public function render()
    {
        if($this->readyToLoad){
            $proveedores = Proveedor::where('nombre', 'like', '%' . $this->search . '%')
                ->orwhere('rut', 'like', '%' . $this->search . '%')
                ->orwhere('telefono', 'like', '%' . $this->search . '%')
                ->orderBy($this->sort, $this->direction)
                //->orderBy('activo','ASC')
                ->paginate($this->cant);
        }else{
            $proveedores = [];
        }

        return view('livewire.proveedor.mostrar-proveedor',compact('proveedores'));
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

    public function delete(Proveedor $proveedor){
       
        //$unidad->delete();
       
        $proveedor->delete('id');
        $proveedor->decrement('id');
        //$proveedor->truncate('id');
        //$this->borrar->save();
       // $this->reset(['open_edit,borrar']);

        //$this->emit('alert','eliminado','El item eliminado');
    }
   

   
    

    public function edit(Proveedor $proveedor){
        $this->prove = $proveedor;
        $this->open_edit = true;

    }

    public function update(){
        $this->validate();
        $this->prove->save();

        $this->reset(['open_edit']);
        //$this->emit('render');
        //$this->emitTo('inventario.mostrar-inventario','render');
        $this->emit('alert','Actualizado','La unidad se ha actualizado satisfactoriamente');
    }

}
