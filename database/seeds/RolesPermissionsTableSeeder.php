<?php

use Database\traits\TruncateTable;
use Database\traits\DisableForeignKeys;
use Illuminate\Database\Seeder;

class RolesPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            'administrator' => ['edit', 'update'],
            'authenticated' => 'authenticated',
        ];

        foreach ($data as $name => $permission) {
            $role = \App\Models\Role::whereName($name)->first();

            if (!$role) continue;

            $permission = !is_array($permission) ? [$permission] : $permission;

            $permissions = \App\Models\Permission::whereIn('slug', $permission)->get();

            $role->permissions()->attach($permissions);
        }
    }
}
