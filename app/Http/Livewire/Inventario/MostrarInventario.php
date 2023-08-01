<?php

namespace App\Http\Livewire\Inventario;

use App\Models\Detalle;
use App\Models\Inventario;
use App\Models\Unidad;
use Livewire\Component;
use Livewire\WithPagination;

class MostrarInventario extends Component
{
    use WithPagination;

    public $title, $inventario,$iSeleccion;
    public $search = '';
    public $sort = 'inventarios.id';
    public $direction = 'desc';
    public $cant = '10';
    public $readyToLoad = false;
    public $borrar;

    public $open_edit = false;
    public $unidad = null;

    protected $rules = [
         'inventario.serial' => 'required'
        //,'inventario.nombre' => 'required'
        //,'inventario.descripcion' => 'required'
       // ,'inventario.modelo' => 'required'
       // ,'inventario.marca' => 'required'
        ,'inventario.estado' => 'required'
        //,'fecha_ingreso' => 'required'
        //,'fecha_baja' => 'required'
       ,'inventario.unidad_id' => 'required'
       ,'inventario.detalle_id' => 'required'
    ];


    protected $listeners = [
        'render'
        ,'delete'
    ];
    /* protected $listeners = ['render' => 'render']; */


    protected $queryString = [
        'cant'     =>['except'=> '10' ]
        ,'sort'     =>['except'=> 'inventarios.id' ]
        ,'direction'=>['except'=> 'desc' ]
        ,'search'   =>['except'=> '' ]
    ];


    public function updatingSearch(){
        $this->resetPage();
    }

    public function loadInventario(){
        $this->readyToLoad = true;
    }

    

    public function render()
    {
        
        if($this->readyToLoad){

            $detalles = Detalle::where('nombre', 'like', '%' . $this->search . '%')
            ->orwhere('descripcion', 'like', '%' . $this->search . '%')
            ->orwhere('marca', 'like', '%' . $this->search . '%')
            ->orwhere('modelo', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'ASC')
            ->paginate('5');

            $inventarios = Inventario::join('detalles',
                    function ($join) {
                        $join->on('inventarios.detalle_id','=','detalles.id');
                    }
                )
                ->where('detalles.nombre', 'like', '%' . $this->search . '%')
                ->orwhere('detalles.descripcion', 'like', '%' . $this->search . '%')
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);
        }else{
            $inventarios = [];
            $detalles = [];
        }
        $this->unidad = Unidad::All();
        return view('livewire.inventario.mostrar-inventario', compact('inventarios','detalles'));
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

    public function delete(Inventario $inventario){
       // $inventario->delete();

       $this->borrar = $inventario;
       $this->borrar->estado = 5;
       $this->borrar->save();
       $this->reset(['open_edit,borrar']);

       
        //$this->emit('alert','eliminado','El item eliminado');
    }

    public function edit(Inventario $inventario){
        $this->inventario = $inventario;
        $this->open_edit = true;

    }

    public function update(){
        $this->validate();

       

        $this->inventario->save();

        $this->reset(['open_edit','inventario.serial','inventario.estado']);
        //$this->emit('render');
        //$this->emitTo('inventario.mostrar-inventario','render');
        $this->emit('alert','Actualizado','El Inventario se actualizado satisfactoriamente');
    }

}
