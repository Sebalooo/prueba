<?php

namespace App\Http\Livewire\Repuestos;
use App\Models\Repuesto;
use Livewire\Component;

class MostrarRepuestos extends Component
{
    use WithPagination;

    public $title, $repuestos;
    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '10';
    public $readyToLoad = false;

    public $open_edit = false;
    //public $unidad = null;

    protected $rules = [
         'repuestos.nombre' => 'required'
        ,'repuestos.marca' => 'required'
        ,'repuestos.modelo' => 'required'
        ,'repuestos.descripcion' => 'required'
        
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

    public function loadRepuesto(){
        $this->readyToLoad = true;
    }




    public function render()
    {
        if($this->readyToLoad){
            $repuestos = Repuesto::where('nombre', 'like', '%' . $this->search . '%')
                ->orwhere('serie', 'like', '%' . $this->search . '%')
                ->orwhere('marca', 'like', '%' . $this->search . '%')
                ->orwhere('modelo', 'like', '%' . $this->search . '%')
                ->orderBy($this->sort, $this->direction)
                //->orderBy('activo','ASC')
                ->paginate($this->cant);
        }else{
            $repuestos = [];
        }
        return view('livewire.repuestos.mostrar-repuestos');
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

    public function delete(Repuesto $repuesto){
       
        //$unidad->delete();
       
        $repuesto->delete('id');
        $repuesto->decrement('id');
        //$proveedor->truncate('id');
        //$this->borrar->save();
       // $this->reset(['open_edit,borrar']);

        //$this->emit('alert','eliminado','El item eliminado');
    }
   
 
    

    public function edit(Repuesto $repuesto){
        $this->repuesto = $repuesto;
        $this->open_edit = true;

    }

    public function update(){
        $this->validate();
        $this->prove->save();

        $this->reset(['open_edit']);
        //$this->emit('render');
        //$this->emitTo('inventario.mostrar-inventario','render');
        $this->emit('alert','Actualizado','La marca se ha actualizado satisfactoriamente');
    }
}
