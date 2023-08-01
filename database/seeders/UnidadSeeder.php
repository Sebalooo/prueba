<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();
        $unidadReales = [
            [1  ,'Imágenes'           ,'1'    ,'1'    ,'1']
           ,[2  ,'Urgencia'           ,'1'    ,'1'    ,'1']
           ,[3  ,'Medico Quirurgico'  ,'1'    ,'2'    ,'1']
           ,[4  ,'Pediatria'          ,'1'    ,'3'    ,'1']
           ,[5  ,'UCI Pediatrica'     ,'1'    ,'3'    ,'1']
           ,[6  ,'Endoscopia'         ,'1'    ,'3'    ,'1']
           ,[7  ,'UTI'                ,'1'    ,'4'    ,'1']
           ,[8  ,'UCI Adulta'         ,'1'    ,'4'    ,'1']
           ,[9  ,'Maternidad'         ,'1'    ,'5'    ,'1']
           ,[10 ,'Neo'                ,'1'    ,'5'    ,'1']
           ,[11 ,'Recuperación'       ,'1'    ,'6'    ,'1']
           ,[12 ,'Esterilización'     ,'1'    ,'6'    ,'1']
           ,[13 ,'Pabellón'           ,'1'    ,'6'    ,'1']
           ,[14 ,'Equipos medicos'    ,'1'    ,'-2'   ,'1']
            
        ];
        $unidadReales = array_map(function ($udr) use ($now) {
            return [
                'id'                => $udr[0]
                ,'unidad'           => $udr[1]
                ,'edificio'         => $udr[2]
                ,'piso'             => $udr[3]
                ,'anexo'            => $udr[4]
                ,'activo'           => 1
                ,'updated_at'       => $now
                ,'created_at'       => $now

            ];
        },$unidadReales);

        DB::table('unidads')->insert($unidadReales);
    }
}
