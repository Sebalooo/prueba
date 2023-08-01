<?php

namespace App\Http\Livewire\Marca;
use App\Models\Detalle;
use Livewire\Component;

class CrearMarca extends Component
{
    public function render()
    {
        return view('livewire.marca.crear-marca');
    }
    public $open = false;
    public $nombre,$marca,$modelo,$descripcion;

    protected $rules = [
         'nombre' => 'required'
        ,'marca' => 'required'
        ,'modelo' => 'required'
        ,'descripcion' => 'required'
        
    ];

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }


    public function save(){
        

        $this->validate();

        Detalle::create(
            [
                'nombre' => $this->nombre
                ,'marca' => $this->marca
                ,'modelo' => $this->modelo
                ,'descripcion' => $this->descripcion
                
                
            ]
        );

        $this->reset([
             'nombre'
            ,'marca'
            ,'modelo'
            ,'descripcion'
            ,'open'
        ]);

        //$this->emit('render');
        $this->emitTo('marca.mostrar-marca','render');
        $this->emit('alert','marca ingresada','Marca se ha ingresado satisfactoriamente');

    }

    public function updatingOpen(){
        if(!$this->open){
            $this->reset([
                 'nombre'
                ,'marca'
                ,'modelo'
                ,'descripcion'
                ,'open'    
            ]);
        }

    }
    
    

    public function closeModal(){
        $this->reset([ 
            'nombre'
            ,'marca'
            ,'modelo'
            ,'descripcion'
            ,'open'
        ]);
    }



}
