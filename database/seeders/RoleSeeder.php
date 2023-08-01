<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role1 = Role::create(['name'=> 'Admin']);
        $role2 = Role::create(['name'=> 'Enfermera']);
        $role3 = Role::create(['name'=> 'Tecnico']);



        Permission::create(['name'=>'unidades.index'])->syncRoles([$role1,$role2,$role3]);//->asignRole($Role1);
        Permission::create(['name'=>'unidades.create'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name'=>'unidades.edit'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name'=>'unidades.disable'])->syncRoles([$role1,$role2,$role3]);

        Permission::create(['name'=>'inventario.index'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name'=>'inventario.create'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name'=>'inventario.edit'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name'=>'inventario.delete'])->syncRoles([$role1]);


        Permission::create(['name'=>'usuario.index'])->syncRoles([$role1,$role3]);
        Permission::create(['name'=>'usuario.create'])->syncRoles([$role1]);
        Permission::create(['name'=>'usuario.edit'])->syncRoles([$role1]);

        Permission::create(['name'=>'solicitud.mostrar'])->syncRoles([$role1]);
        Permission::create(['name'=>'solicitud.crear'])->syncRoles([$role1]);
        Permission::create(['name'=>'solicitud.editar'])->syncRoles([$role1]);

        

       
        
    }
}
