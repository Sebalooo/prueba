<?php

namespace App\Http\Livewire\Inventario;

use App\Models\Detalle;
use App\Models\Inventario;
use App\Models\Unidad;
use Livewire\Component;
use Livewire\WithPagination;

class CrearInventario extends Component
{
    use WithPagination;

    //public $detalles;
    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '5';
    public $readyToLoad = false;


    protected $queryString = [
        'cant'     =>['except'=> '5' ]
        ,'sort'     =>['except'=> 'id' ]
        ,'direction'=>['except'=> 'desc' ]
        ,'search'   =>['except'=> '' ]
    ];

    public function updatingSearch(){
        $this->resetPage();
    }




    public function render()
    {

            $detalles = Detalle::where('nombre', 'like', '%' . $this->search . '%')
            ->orwhere('descripcion', 'like', '%' . $this->search . '%')
            ->orwhere('marca', 'like', '%' . $this->search . '%')
            ->orwhere('modelo', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);
        

        $this->unidad = Unidad::All();
        return view('livewire.inventario.crear-inventario',compact('detalles'));
    }
    public $open = false;
    public $seleccion;
    public $serial,$tipo,$nombre,$descripcion,$modelo,$marca,$estado,$fecha_ingreso,$fecha_baja,$unidad_id,$unidad;

    protected $rules = [
         'serial' => 'required'
        //,'nombre' => 'required|max:20'
        //,'descripcion' => 'required|min:3'
        //,'modelo' => 'required'
        //,'marca' => 'required' 
        //,'estado' => 'required'
        
       // ,'fecha_ingreso' => 'required'
       // ,'fecha_baja' => 'required'
        ,'unidad_id' => 'required'
    ];

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }


    public function save(){

        $this->validate();

        
        //Se debe Guardar Inventario
        $guardado = Inventario::create(
            [

                'serial' => $this->serial
                ,'lote' => $this->serial
                ,'tipo' => 1 //$this->tipo
                ,'serie' => '0000000'
                //,'nombre' => $this->nombre
                //,'descripcion' => $this->descripcion
                //,'modelo' => $this->modelo
                //,'marca' => $this->marca
                ,'estado' => $this->estado
                ,'fecha_ingreso' => now()
                ,'fecha_baja' => now()
                ,'unidad_id' => $this->unidad_id
              ,'detalle_id' => $this->seleccion
            ]
        );

        $guardado->serie = $guardado->id;
        $guardado->save();


        $this->reset([
             'serial'
            ,'nombre'
            ,'descripcion'
            ,'modelo'
            ,'marca'
            ,'estado'
            ,'fecha_ingreso'
            ,'fecha_baja'
            ,'unidad_id'
            ,'open'
            ,'seleccion'
        ]);

        //$this->emit('render');
        $this->emitTo('inventario.mostrar-inventario','render');
        $this->emit('alert','item ingresado','El inventario se creo satisfactoriamente');

    }

    public function updatingOpen(){
        if(!$this->open){
            $this->reset(['serial'
                ,'nombre'
                ,'descripcion'
                ,'modelo'
                ,'marca'
                ,'estado'
                ,'fecha_ingreso'
                ,'fecha_baja'
                ,'seleccion'
                ,'unidad_id']);
        }

    }
    
    

    public function closeModal(){
        $this->reset(['serial'
            ,'nombre'
            ,'descripcion'
            ,'modelo'
            ,'marca'
            ,'estado'
            ,'fecha_ingreso'
            ,'fecha_baja'
            ,'unidad_id'
            ,'seleccion'
            ,'unidad'
            ,'open'
        ]);
        //$this->dispatchBrowserEvent('mostrar-inventario');
       // $this->dispatchBrowserEvent('closeModal');
        //$this->emitTo('show-stuff','render');
    }

    

    public function loadInventario(){
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

}
