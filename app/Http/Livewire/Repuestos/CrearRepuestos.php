<?php

namespace App\Http\Livewire\Repuestos;
use App\Models\Repuesto;
use Livewire\Component;

class CrearRepuestos extends Component
{
    public function render()
    {
        return view('livewire.repuestos.crear-repuestos');
    }

    public $open = false;
    public $nombre,$serie,$marca,$modelo;

    protected $rules = [
         'nombre' => 'required'
         ,'serie' => 'serie'
        ,'marca' => 'required'
        ,'modelo' => 'required'
        
        
    ];

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }


    public function save(){
        

        $this->validate();

        Detalle::create(
            [
                'nombre' => $this->nombre
                ,'serie' => $this->serie
                ,'marca' => $this->marca
                ,'modelo' => $this->modelo
                
                
                
            ]
        );

        $this->reset([
             'nombre'
             ,'serie'
            ,'marca'
            ,'modelo'
            
            ,'open'
        ]);

        //$this->emit('render');
        $this->emitTo('repuesto.mostrar-reouesto','render');
        $this->emit('alert','repuesto ingresada','Repuesto se ha ingresado satisfactoriamente');

    }

    public function updatingOpen(){
        if(!$this->open){
            $this->reset([
                'nombre'
                ,'serie'
               ,'marca'
               ,'modelo'
                ,'open'    
            ]);
        }

    }
    
    

    public function closeModal(){
        $this->reset([ 
            'nombre'
            ,'serie'
            ,'marca'
            ,'modelo'
            ,'open'
        ]);
    }
}
