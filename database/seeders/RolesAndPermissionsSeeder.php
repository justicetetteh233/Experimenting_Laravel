<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'edit voter']);
        Permission::create(['name' => 'delete voter']);
        Permission::create(['name' => 'create voter']);

        Permission::create(['name' => 'edit candidate']);
        Permission::create(['name' => 'delete candidate']);
        Permission::create(['name' => 'create candidate']);

        Permission::create(['name' => 'edit Commissioner']);
        Permission::create(['name' => 'delete Commissioner']);
        Permission::create(['name' => 'create Commissioner']);

        $executiveCommissioner = Role::create(['name' => 'Executive Commissioner']);
        $deputyCommissioner = Role::create(['name' => 'Deputy Commissioner']);
        $registerer=Role::create(['name' => 'Registerer']);

        $executiveCommissioner->givePermissionTo(Permission::all());
        $deputyCommissioner->givePermissionTo(['edit voter','delete voter','create voter','edit candidate','delete candidate']);
        $registerer->givePermissionTo(['edit voter','create voter']);



    }
}
