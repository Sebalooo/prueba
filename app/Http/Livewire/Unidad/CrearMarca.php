<?php

namespace App\Http\Livewire\Unidad;

use App\Models\Unidad;
use Livewire\Component;

class CrearMarca extends Component
{
    public function render()
    {
        return view('livewire.unidad.crear-marca');
    }

    public $open = false;


}
