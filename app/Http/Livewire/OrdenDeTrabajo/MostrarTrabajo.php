<?php

namespace App\Http\Livewire\OrdenDeTrabajo;

use App\Models\Trabajo;
use Livewire\Component;
use Livewire\WithPagination;

class MostrarTrabajo extends Component
{

    use WithPagination;

    public $title;
    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '10';
    public $readyToLoad = false;

    protected $rules = [

    ];


    protected $listeners = [
        'render'
        //,'delete'
    ];

    protected $queryString = [
        'cant'     =>['except'=> '10' ]
        ,'sort'     =>['except'=> 'id' ]
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
            $trabajos = Trabajo::whereIn('estado',['2','3','4','5'])
            ->where('tipo_mantencion', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);
        }else{
            $trabajos = [];
        }

        return view('livewire.orden-de-trabajo.mostrar-trabajo',compact('trabajos'));
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


}
