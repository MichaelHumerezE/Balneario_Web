<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $role1 = Role::create(['name' => 'Empleado']);
        /*$role2 = Role::create(['name' => 'Comerciante']);
        $role3 = Role::create(['name' => 'Almacenador']);
        $role4 = Role::create(['name' => 'Supervisor']);
        $role5 = Role::create(['name' => 'RRHH']);
        $role6 = Role::create(['name' => 'Marketing']);*/

        Permission::create(['name' => 'cliente.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'cliente.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'cliente.update'])->syncRoles([$role1]);
        Permission::create(['name' => 'cliente.delete'])->syncRoles([$role1]);

        Permission::create(['name' => 'empleado.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'empleado.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'empleado.update'])->syncRoles([$role1]);
        Permission::create(['name' => 'empleado.delete'])->syncRoles([$role1]);

        Permission::create(['name' => 'producto.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'producto.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'producto.update'])->syncRoles([$role1]);
        Permission::create(['name' => 'producto.delete'])->syncRoles([$role1]);

        Permission::create(['name' => 'categoria.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'categoria.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'categoria.update'])->syncRoles([$role1]);
        Permission::create(['name' => 'categoria.delete'])->syncRoles([$role1]);

        Permission::create(['name' => 'subcategorias.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'subcategorias.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'subcategorias.update'])->syncRoles([$role1]);
        Permission::create(['name' => 'subcategorias.delete'])->syncRoles([$role1]);

        Permission::create(['name' => 'menbresias.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'menbresias.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'menbresias.update'])->syncRoles([$role1]);
        Permission::create(['name' => 'menbresias.delete'])->syncRoles([$role1]);

        Permission::create(['name' => 'pagosAdmin.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'pagosAdmin.create'])->syncRoles($role1);
        Permission::create(['name' => 'pagosAdmin.update'])->syncRoles($role1);
        Permission::create(['name' => 'pagosAdmin.delete'])->syncRoles($role1);

        Permission::create(['name' => 'notaVentas.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'notaVentas.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'notaVentas.update'])->syncRoles([$role1]);
        Permission::create(['name' => 'notaVentas.delete'])->syncRoles([$role1]);

        Permission::create(['name' => 'bitacora.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'bitacora.export'])->syncRoles($role1);

    }
}
