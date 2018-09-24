<?php

use Database\traits\TruncateTable;
use Database\traits\DisableForeignKeys;

use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate('users');

        $users = [
            [
                'name' => 'Admin',
                'username' => 'admin@labs.com',
                'email' => 'admin@labs.com',
                'password' => bcrypt('admin'),
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Demo',
                'username' => 'demo@labs.com',
                'email' => 'demo@labs.com',
                'password' => bcrypt('demo'),
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Backend',
                'username' => 'dav',
                'email' => 'dav@labs.com',
                'password' => bcrypt('dav'),
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        DB::table('users')->insert($users);

        $this->enableForeignKeys();
    }
}