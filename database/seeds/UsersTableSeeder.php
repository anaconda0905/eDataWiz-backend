<?php

use Illuminate\Database\Seeder;

class UsersGenerate extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['id' => '1',
                'email' => 'admin@admin.com',
                'password' => bcrypt('admin'),
                'permissions' => '{"home.dashboard":true}',
                'first_name' => 'John',
                'last_name' => 'Doe',
                'QRpassword' => 'Dammy-CODE-1S4u7lJzehk62xDm3DgYgXXYWtbHE6gSP',
                'api_token' => 'PivvPlsQWxPl1bB5KrbKNBuraJit0PrUZekQUgtLyTRuyBq921atFtoR1HuA',
                'device_token' => null,
                'verified' => true,
                'company' => null,
                'phone' => null,
            ],

        ]);
        DB::table('roles')->insert([
            [
                'id' => '1',
                'slug' => 'admin',
                'name' => 'Admin',
                'permissions' => '{"password.request":true,"password.email":true,"password.reset":true,"home.dashboard":true,"user.index":true,"user.create":true,"user.store":true,"user.show":true,"user.edit":true,"user.update":true,"user.destroy":true,"user.permissions":true,"user.save":true,"user.activate":true,"user.deactivate":true,"role.index":true,"role.create":true,"role.store":true,"role.show":true,"role.edit":true,"role.update":true,"role.destroy":true,"role.permissions":true,"role.save":true}',
            ],
            [
                'id' => '2',
                'slug' => 'client',
                'name' => 'client',
                'permissions' => '{"home.dashboard":true}',
            ],
        ]);
        DB::table('category1')->insert([
            [
                'id' => '1',
                'name' => 'Marine Pressure Components',
            ],
            [
                'id' => '2',
                'name' => 'Mechanical Components',
            ],
        ]);
        DB::table('category2')->insert([
            [
                'id' => '1',
                'parent_id' => '1',
                'name' => 'Pressure Components1',
            ],
            [
                'id' => '2',
                'parent_id' => '1',
                'name' => 'Pressure Components2',
            ],
            [
                'id' => '3',
                'parent_id' => '2',
                'name' => 'Mechanical Components1',
            ],
            [
                'id' => '4',
                'parent_id' => '2',
                'name' => 'Mechanical Components2',
            ],
        ]);
        DB::table('role_users')->insert([
            [
                'user_id' => '1',
                'role_id' => '1',
            ],
        ]);
        DB::table('activations')->insert([
            [
                'user_id' => '1',
                'code' => '1S4u7lJzehk62xDm3DgYgXXYWtbHE6gSP',
                'completed' => '1',
            ],
        ]);
    }
}
