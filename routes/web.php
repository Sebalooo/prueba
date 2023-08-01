<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Inventario\MostrarInventario;
use App\Http\Livewire\OrdenDeTrabajo\CrearSolicitud;
use App\Http\Livewire\OrdenDeTrabajo\MostrarBitacora;
use App\Http\Livewire\OrdenDeTrabajo\MostrarSolicitud;
use App\Http\Livewire\OrdenDeTrabajo\MostrarTrabajo;
use App\Http\Livewire\OT\MostrarOrdendetrabajo;
use App\Http\Livewire\Rol\MostrarRoles;
use App\Http\Livewire\Unidad\MostrarUnidad;
use App\Http\Livewire\Usuario\MostrarUsuario;
use App\Http\Livewire\Proveedor\MostrarProveedor;
use App\Http\Livewire\Marca\MostrarMarca;
use App\Http\Livewire\Repuestos\MostrarRepuestos;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth\login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    /* Inventario Equipos, Accesorios, Repuestos y detalle(marca) */
    Route::get('/inventario', MostrarInventario::class)->name('inventario');
    Route::get('/marca', MostrarMarca::class)->name('marca');

    /* Roles, Usuarios y Permisos */
    Route::get('/usuarios', MostrarUsuario::class)->name('usuarios');
    Route::get('/roles', MostrarRoles::class)->name('roles');
    
    /* Estructuras [Unidades] */
    Route::get('/unidades', MostrarUnidad::class)->name('unidades');
   
     /* Estructuras [Proveedor] */
     Route::get('/Proveedor', MostrarProveedor::class)->name('proveedor');
   

   /*  Solicitud, Orden y Bitacoras */
    Route::get('/ordenes',MostrarTrabajo::class)->name('ot.orden');
    Route::get('/bitacoras',MostrarBitacora::class)->name('ot.mostrar.bitacora');
    
    Route::get('/adjunto/upload',CrearSolicitud::class)->name('ot.crear.adjunto');

    Route::get('/solicitud',CrearSolicitud::class)->name('ot.crear.solicitud');
    Route::get('/solicitudes',MostrarSolicitud::class)->name('ot.mostrar.solicitud');

   
   /*  Repuestos */
   Route::get('/repuestos',MostrarSolicitud::class)->name('repuestos');

    /**/
 
    
    
});

