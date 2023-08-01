<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Assign;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();
        $usuariosReales = [
            ['administrador','feliz','admin@eira.com','123456789',2,14],
            ['tecnico','feliz','tecnico@eira.com','123456789',2,2],
            ['enfermer@','feliz','nurse@eira.com','123456789',2,14],
            ['vicente','feliz','vicente@gmail.com','123456789',2,14],
            ['sebastian', 'uribe','sebastian.uribe.p@gmail.com','123456789',2,14]
        ];
        $usuariosReales = array_map(function ($udr) use ($now){
            return [
                 'name'     => $udr[0]
                ,'apellido' => $udr[1]
                ,'email'    => $udr[2]
                ,'password' => bcrypt($udr[3])
                ,'email_verified_at' => now()
                ,'estado' => $udr[4]
                ,'unidad_id'=>$udr[5]
                
            ];
        },$usuariosReales);

        DB::table('users')->insert($usuariosReales);

        $user = User::where('email','vicente@gmail.com')->first();
        $user->assignRole('Admin');

        $user = User::where('email','sebastian.uribe.p@gmail.com')->first();
        $user->assignRole('Admin');

        $user = User::where('email','admin@eira.com')->first();
        $user->assignRole('Admin');

        $user = User::where('email','tecnico@eira.com')->first();
        $user->assignRole('Tecnico');

        $user = User::where('email','nurse@eira.com')->first();
        $user->assignRole('Enfermera');



    }
}
