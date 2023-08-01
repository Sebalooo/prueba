<?php

namespace App\Http\Livewire\OrdenDeTrabajo;

use App\Models\Adjunto;
use App\Models\Bitacora;
use App\Models\Repuesto;
use App\Models\RepuestoBitacora;
use App\Models\Trabajo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use Livewire\WithFileUploads;
use Livewire\WithPagination;
use PhpParser\Node\Expr\FuncCall;

class CrearTrabajo extends Component
{

    
    use WithFileUploads;
    use WithPagination;

    public $title, $inventario,$iSeleccion;
    public $titulo,$observacion,$estado,$prioridad;
    public $searchOne = '';
    public $searchTwo = '';
    public $searchThree = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '5';
    public $readyToLoad = false;
    public $seleccion = [];
    public $archivo;
    
    

    public $open = false;
    public $unidad = null;
    
    public $trabajo;

    public function mount(Trabajo $trabajo){
        $this->trabajo = $trabajo;
        $this->prioridad=$this->trabajo->prioridad;
        $this->estado=$this->trabajo->estado;
    }

    public function render()
    {
       
        $bitacoras = Bitacora::where('id', 'like', '%' . $this->searchOne . '%')
        ->where('trabajo_id','=', $this->trabajo->id)
        ->orderBy('id', 'ASC')
        ->paginate('5');
        $repuestos = Repuesto::where('id', 'like', '%' . $this->searchTwo . '%')
        ->orderBy('id', 'ASC')
        ->paginate('5');
        $adjuntos = Adjunto::where('id', 'like', '%' . $this->searchThree . '%')
        ->where('bitacora_id','=', $this->trabajo->id)
        ->orderBy('id', 'ASC')
        ->paginate('5');
        

        return view('livewire.orden-de-trabajo.crear-trabajo',compact('repuestos','bitacoras','adjuntos'));
    }

    protected $rules = [
        'titulo' => 'required'
        ,'observacion' => 'required'
        ,'prioridad' => 'required'
        ,'estado' => 'required'
        ,'archivo' => 'nullable|image|max:2048'
   ];

    protected $listeners = [
        'render'
        ,'delete'
    ];

    protected $queryString = [
        'cant'     =>['except'=> '5' ]
        ,'sort'     =>['except'=> 'id' ]
        ,'direction'=>['except'=> 'desc' ]
        ,'searchOne'   =>['except'=> '' ]
        ,'searchTwo'   =>['except'=> '' ]
        ,'searchThree'   =>['except'=> '' ]
    ];

    public function updatingSearch(){
        $this->resetPage();
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


    public function save(){
        $this->validate();

        $this->trabajo->prioridad = $this->prioridad;
        $this->trabajo->estado = $this->estado;
               
        if (!empty($archivo)){
            $archivo =$this->archivo->store('public/adjuntos');    
        }
        $archivo =$this->archivo->store('public/adjuntos');

        //Actualizar Orden
        $this->trabajo->save();

        $userId = Auth::user()->id;

        //Nueva Bitacora
        $idBitacora = Bitacora::create(
            [
                 'titulo' => $this->titulo
                ,'observacion' => $this->observacion
                ,'fecha' =>now()
                ,'fundador' => 1
                ,'user_id' => $userId
                ,'trabajo_id' => $this->trabajo->id
            ]
        );


        //Asignar Adjuntos
        Adjunto::create(
            [
                'nombre_original' => $this->archivo->temporaryUrl()
               ,'nombre_random' => $archivo
               ,'fecha_subida' => now()
               ,'razon' => 'no'
               ,'bitacora_id' => $idBitacora->id
           ]
       );


        //Asignar Repuestos
        foreach(  $this->seleccion as $value){
             $repuestos = RepuestoBitacora::create(
                [
                    'cantidad' => '1'
                    ,'fecha' => now()
                    ,'bitacora_id' => $idBitacora->id
                    ,'repuesto_id' =>$value
                ]
            );
        }

        $this->reset([
            'archivo'
           ,'titulo'
           ,'observacion'
           ,'estado'
           ,'prioridad'
           ,'open'
           ,'seleccion'
       ]);

        

        //FIN
        $this->emitTo('orden-de-trabajo.mostrar-trabajo','render');
        $this->emit('alert','Cambios realizados','Todos los cambios han sido actualizados.');
        //return redirect()->to('/ordenes');
        //redirect()->route('ot.orden');
    }

    public function updatingOpen(){
        if(!$this->open){
            $this->reset([
                'archivo'
               ,'titulo'
               ,'observacion'
               ,'estado'
               ,'prioridad'
               ,'open'
               ,'seleccion'
           ]);
        }

    }

    public function closeModal(){
        $this->reset([
            'archivo'
           ,'titulo'
           ,'observacion'
           ,'estado'
           ,'prioridad'
           ,'open'
           ,'seleccion'
       ]);


    }
}
