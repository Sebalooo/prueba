<?php

namespace App\Http\Livewire\Unidad;

use App\Models\Unidad;
use Livewire\Component;

class CrearUnidad extends Component
{
    public function render()
    {
        return view('livewire.unidad.crear-unidad');
    }
    public $open = false;
    public $unidad,$edificio,$piso,$anexo,$activo;

    protected $rules = [
         'unidad' => 'required'
        ,'edificio' => 'required'
        ,'piso' => 'required'
        ,'anexo' => 'required'
    ];

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }


    public function save(){

        $this->validate();

        Unidad::create(
            [
                'unidad' => $this->unidad
                ,'edificio' => $this->edificio
                ,'piso' => $this->piso
                ,'anexo' => $this->anexo
                ,'activo'=> 1
            ]
        );

        $this->reset([
             'unidad'
            ,'edificio'
            ,'piso'
            ,'anexo'
            ,'open'
        ]);

        //$this->emit('render');
        $this->emitTo('unidad.mostrar-unidad','render');
        $this->emit('alert','unidad ingresada','La unidad se ha ingresado satisfactoriamente');

    }

    public function updatingOpen(){
        if(!$this->open){
            $this->reset([
                 'unidad'
                ,'edificio'
                ,'piso'
                ,'anexo'
                ,'open'    
            ]);
        }

    }
    
    

    public function closeModal(){
        $this->reset([ 
            'unidad'
            ,'edificio'
            ,'piso'
            ,'anexo'
            ,'open'
        ]);
    }
}
