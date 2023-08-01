<?php

namespace App\Http\Livewire\Unidad;

use App\Models\Unidad;
use Livewire\Component;
use Livewire\WithPagination;

class MostrarUnidad extends Component
{
   

    use WithPagination;

    public $title, $uni;
    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '10';
    public $readyToLoad = false;

    public $open_edit = false;
    //public $unidad = null;

    protected $rules = [
         'uni.unidad' => 'required'
        ,'uni.edificio' => 'required'
        ,'uni.piso' => 'required'
        ,'uni.anexo' => 'required'
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

    public function loadUnidad(){
        $this->readyToLoad = true;
    }


    public function render()
    {
        if($this->readyToLoad){
            $unidades = Unidad::where('unidad', 'like', '%' . $this->search . '%')
                ->orwhere('edificio', 'like', '%' . $this->search . '%')
                ->orwhere('piso', 'like', '%' . $this->search . '%')
                ->orderBy($this->sort, $this->direction)
                ->orderBy('activo','ASC')
                ->paginate($this->cant);
        }else{
            $unidades = [];
        }
        //$this->unidad = Unidad::All();
        return view('livewire.unidad.mostrar-unidad', compact('unidades'));
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

    public function delete(Unidad $unidad){
        $unidad->activo = '0';
        $unidad->update();
        //$unidad->delete();
        //$this->emit('alert','eliminado','El item eliminado');
    }

    public function activar(Unidad $unidad){
        $unidad->activo = '1';
        $unidad->update();
    }

    public function desactivar(Unidad $unidad){
        $unidad->activo = '0';
        $unidad->update();
    }

    

    public function edit(Unidad $unidad){
        $this->uni = $unidad;
        $this->open_edit = true;

    }

    public function update(){
        $this->validate();
        $this->uni->save();

        $this->reset(['open_edit']);
        //$this->emit('render');
        //$this->emitTo('inventario.mostrar-inventario','render');
        $this->emit('alert','Actualizado','La unidad se ha actualizado satisfactoriamente');
    }
 
}
