<?php

namespace App\Http\Livewire\Proveedor;

use App\Models\Repuesto;
use App\Models\Proveedor;
use Livewire\Component;

class CrearProveedor extends Component
{
  
    public function render()
    {
        return view('livewire.proveedor.crear-proveedor');
    }

    public $open = false;
    public $nombre,$rut,$telefono;

    protected $rules = [
         'nombre' => 'required'
        ,'rut' => 'required'
        ,'telefono' => 'required'
        
    ];

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }


    public function save(){
        

        $this->validate();

        Proveedor::create(
            [
                'nombre' => $this->nombre
                ,'rut' => $this->rut
                ,'telefono' => $this->telefono
                
                
            ]
        );

        $this->reset([
             'nombre'
            ,'rut'
            ,'telefono'
            ,'open'
        ]);

        //$this->emit('render');
        $this->emitTo('proveedor.mostrar-proveedor','render');
        $this->emit('alert','proveedor ingresada','Proveedor se ha ingresado satisfactoriamente');

    }

    public function updatingOpen(){
        if(!$this->open){
            $this->reset([
                 'nombre'
                ,'rut'
                ,'telefono'
                ,'open'    
            ]);
        }

    }
    
    

    public function closeModal(){
        $this->reset([ 
            'nombre'
            ,'rut'
            ,'telefono'
            ,'open'
        ]);
    }





}
