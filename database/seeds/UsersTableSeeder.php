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
                'email' => 'admin@edatawiz.com',
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
                'permissions' => '{"home.dashboard":true,"password.request":true,"password.email":true,"password.reset":true,"questions.index":true,"questions.create":true,"questions.store":true,"questions.show":true,"questions.edit":true,"questions.update":true,"questions.destroy":true,"categories.index":true,"categories.create":true,"categories.store":true,"categories.show":true,"categories.edit":true,"categories.update":true,"categories.destroy":true,"user.index":true,"user.create":true,"user.store":true,"user.show":true,"user.edit":true,"user.update":true,"user.destroy":true,"user.permissions":true,"user.save":true,"user.activate":true,"user.deactivate":true,"role.index":true,"role.create":true,"role.store":true,"role.show":true,"role.edit":true,"role.update":true,"role.destroy":true,"role.permissions":true,"role.save":true}',
            ],
            [
                'id' => '2',
                'slug' => 'client',
                'name' => 'client',
                'permissions' => '{"home.dashboard":true,"questions.index":true,"questions.show":true,"categories.index":true,"categories.show":true,"user.show":true,"user.edit":true,"user.update":true}',
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
