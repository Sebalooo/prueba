<?php

namespace App\Http\Livewire\Marca;


use App\Models\Detalle;
use Livewire\Component;
use Livewire\WithPagination;

class MostrarMarca extends Component
{

    use WithPagination;

    public $title, $marca;
    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '10';
    public $readyToLoad = false;

    public $open_edit = false;
    //public $unidad = null;

    protected $rules = [
         'marca.nombre' => 'required'
        ,'marca.marca' => 'required'
        ,'marca.modelo' => 'required'
        ,'marca.descripcion' => 'required'
        
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

    public function loadMarca(){
        $this->readyToLoad = true;
    }





    public function render()
    {


        if($this->readyToLoad){
            $marcas = Detalle::where('nombre', 'like', '%' . $this->search . '%')
                ->orwhere('marca', 'like', '%' . $this->search . '%')
                ->orwhere('modelo', 'like', '%' . $this->search . '%')
                ->orwhere('descripcion', 'like', '%' . $this->search . '%')
                ->orderBy($this->sort, $this->direction)
                //->orderBy('activo','ASC')
                ->paginate($this->cant);
        }else{
            $marcas = [];
        }
        return view('livewire.marca.mostrar-marca',compact('marcas'));
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

    public function delete(Detalle $marca){
       
        //$unidad->delete();
       
        $marca->delete('id');
        $marca->decrement('id');
        //$proveedor->truncate('id');
        //$this->borrar->save();
       // $this->reset(['open_edit,borrar']);

        //$this->emit('alert','eliminado','El item eliminado');
    }
   

   
    

    public function edit(Detalle $marca){
        $this->marca = $marca;
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
