<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class DetalleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $now = now();

        $detReales = [
              ['Videopanendoscopio','XXXXX','YYYYYY','Descripcion de ejemplo']
             ,['Bomba Infusión','XXXXXX','YYYYY','Descripcion de ejemplo']
             ,['Desfibrilador','XXXXX','YYYYYYY','Descripcion de ejemplo']

        ];
        $detReales = array_map(function ($dtr) use ($now) {
            return [
                 'nombre'           => $dtr[0] 
                ,'marca'            => $dtr[1]
                ,'modelo'           => $dtr[2]
                ,'descripcion'      => $dtr[3]
                ,'updated_at'       => $now
                ,'created_at'       => $now

            ];
        },$detReales);

        DB::table('detalles')->insert($detReales);


    }
}
