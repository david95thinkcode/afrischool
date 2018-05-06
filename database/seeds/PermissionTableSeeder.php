<?php

use Database\traits\TruncateTable;
use Database\traits\DisableForeignKeys;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [['slug' => 'edit'], ['slug' => 'update']];
        \App\Models\Permission::create($permissions);
        /*DB::table('permissions')->insert($permissions);*/
    }
}
