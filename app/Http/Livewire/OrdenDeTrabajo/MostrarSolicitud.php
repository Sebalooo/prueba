<?php

namespace App\Http\Livewire\OrdenDeTrabajo;

use App\Models\Bitacora;
use App\Models\Trabajo;
use App\Models\User;
use Livewire\Component;

use Livewire\WithPagination;

class MostrarSolicitud extends Component
{
   


    use WithPagination;

    public $title,$trabajo,$usuario,$observacion;
    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '10';
    public $readyToLoad = false;
    public $open_edit = false;

    protected $rules = [
         'trabajo.estado' => 'required'
         ,'trabajo.prioridad' => 'required'
         ,'observacion' => 'required'
    
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
            $trabajos = Trabajo::where('tipo_mantencion', 'like', '%' . $this->search . '%')
            ->orwhere('tipo_orden', 'like', '%' . $this->search . '%')
            ->orwhere('estado', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);
            $tecnicos = User::whereHas(
                'roles', function($q){
                    $q->where('name', 'Tecnico')->orwhere('name', 'Admin');
                }
            )->get();
            
        }else{
            $trabajos = [];
            $tecnicos = [];
        }

        return view('livewire.orden-de-trabajo.mostrar-solicitud',compact('trabajos','tecnicos'));
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

    public function edit(Trabajo $trabajo){
       
        $this->open_edit = true;
        $this->trabajo = $trabajo;

    }

    public function update(){
        $this->validate();
        $this->trabajo->save();

        Bitacora::create(
            [
                 'titulo' => 'Asignacion de Solicitudes'
                ,'observacion' => $this->observacion
                ,'fecha' =>now()
                ,'fundador' => NULL
                ,'user_id' => $this->usuario
                ,'trabajo_id' => $this->trabajo->id
            ]
        );

        

        $this->reset(['open_edit']);
        //$this->emit('render');
        //$this->emitTo('inventario.mostrar-inventario','render');
        $this->emit('alert','Actualizado','El Inventario se actualizado satisfactoriamente');
    }

}