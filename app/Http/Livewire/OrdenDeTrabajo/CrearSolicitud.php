<?php

namespace App\Http\Livewire\OrdenDeTrabajo;

use App\Models\Adjunto;
use App\Models\Bitacora;
use App\Models\EquipoTrabajo;
use App\Models\Inventario;
use App\Models\Trabajo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class CrearSolicitud extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $title,$birthday;
    public $seleccion=[];
    public $search = '';
    public $sort = 'id';
    public $direction = 'asc';
    public $cant = '5';
    public $readyToLoad = false;
    public $unidad ;
    public $fechaAsignada,$prioridad,$tipoSolicitud,$titulo,$observacion,$identificador;
    public $archivo;

    public function mount(){
       $this->identificador = rand();
    }

    protected $rules = [
         
        'archivo' => 'nullable|image|max:2048'

    ];

    
    
    protected $queryString = [
        'cant'     =>['except'=> '5' ]
        ,'sort'     =>['except'=> 'id' ]
        ,'direction'=>['except'=> 'asc' ]
        ,'search'   =>['except'=> '' ]
    ];

    public function updatingSearch(){
        $this->resetPage();
    }

    public function loadSolicitud(){
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

    public function render()
    {
        $this->unidad = Auth::user()->unidad->unidad;
        $auto =  Auth::user()->unidad->unidad;
        $solicitudes = [];
        if($this->readyToLoad){
            $inventarios = Inventario::where('tipo', 'like', '%' . $this->search . '%')
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);
        }else{
            $inventarios = [];
        }
        return view('livewire.orden-de-trabajo.crear-solicitud', compact('solicitudes','inventarios','auto'));
    }

    public function save(){
        $this->validate();


        //$archivo = $this->archivo->store('public/adjuntos');


        // CREAR ORDEN
        $trabajoId = Trabajo::create(
            [
                'estado' => '1'
                ,'tipo_orden' => $this->tipoSolicitud
                ,'prioridad' => $this->prioridad
                ,'tipo_mantencion' => '1'
                ,'fecha_inicio' => $this->fechaAsignada
                ,'fecha_termino' => NULL
            ]
        );
        $userId = Auth::user()->id;
       
        //CREAR BITACORA
        /**
         * No existe regla logica que consulte si es unica, al crear se usa bit fundador
         */
        $idBitacora = Bitacora::create(
            [
                 'titulo' => $this->titulo
                ,'observacion' => $this->observacion
                ,'fecha' =>now()
                ,'fundador' => 1
                ,'user_id' => $userId
                ,'trabajo_id' => $trabajoId->id
            ]
        );
        //ASIGNAR ADJUNTOS
        // esta opcion pueden ser muchos un for
       //  Adjunto::create(
        //     [
        //         'nombre_original' => $this->archivo->temporaryUrl()
         //       ,'nombre_random' => $archivo
         //       ,'fecha_subida' => now()
          //      ,'razon' => 'no'
          //      ,'bitacora_id' => $idBitacora->id
          //  ]
        //);
        //ASIGNAR EQUIPO Y ORDEN DE TRABAJO(EQUIPO_OT)
        // esta opcion puedenser muchos un for
        foreach(  $this->seleccion as $value){
            EquipoTrabajo::create(
                [
                    'cantidad' => '2'
                    ,'fecha' => now()
                    ,'inventario_id' => $value
                    ,'trabajo_id' => $trabajoId->id
                ]
            );
        }
      
        
        $this->identificador = rand();

        $this->emitTo('inventario.mostrar-inventario','render');
        $this->emit('alert','Solicitud ingresada','Se le contactara desde la administracion. gracias.');
        //return redirect()->to('/ordenes');
        //redirect()->route('ot.orden');


    }
}
