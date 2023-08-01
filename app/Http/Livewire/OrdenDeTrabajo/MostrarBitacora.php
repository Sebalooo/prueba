<?php

namespace App\Http\Livewire\OrdenDeTrabajo;

use App\Models\Inventario;
use Livewire\Component;
  use Livewire\WithPagination;
class MostrarBitacora extends Component
{
    use WithPagination;

    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '10';
    public $readyToLoad = false;
    public $open_edit = false;
    public $edicion,$equipo;

    public function render()
    {
        if($this->readyToLoad){
            $equipos = Inventario::join('equipo_trabajos','inventarios.id','=','equipo_trabajos.inventario_id')
                ->join('trabajos','trabajos.id','=','equipo_trabajos.trabajo_id')
                ->where('serial','like', '%' . $this->search . '%')
                ->orderBy('inventarios.id', 'ASC')
                ->paginate('10');
                
           /*  
            where('serial', 'like', '%' . $this->search . '%')
            ->orwhere('', 'like', '%' . $this->search . '%')
            ->orwhere('marca', 'like', '%' . $this->search . '%')
            ->orwhere('modelo', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'ASC')
            ->paginate('5');


            Especialidadsubespecialidad::join('subespecialidad','especialidadsubespecialidad.idsubespecialidad','=','subespecialidad.idsubespecialidad')
                ->where('especialidadsubespecialidad.idespecialidad','=',$request->id)
                ->select('subespecialidad.*')
                ->get(); */
            
        }else{
             $equipos = [];
        }



       
        return view('livewire.orden-de-trabajo.mostrar-bitacora',compact('equipos'));
    }

    protected $listeners = [
        'render'
        //,'delete'
    ];

    public function updatingSearch(){
        $this->resetPage();
    }

    public function loadBitacora(){
        $this->readyToLoad = true;
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


    public function edit(Inventario $Inventario){
        $this->emit('alert','NA','En construccion');
    }




}
