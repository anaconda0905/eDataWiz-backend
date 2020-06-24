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
        DB::table('categories')->insert([
            [
                'id' => '1',
                'name' => 'Engineer Category',
            ],
            [
                'id' => '2',
                'name' => 'Group part or equipment',
            ],
            [
                'id' => '3',
                'name' => 'Engineering Application',
            ],
            [
                'id' => '4',
                'name' => 'Group description of part & equipment',
            ],
            [
                'id' => '5',
                'name' => 'Detail description of part & equipment',
            ],
            [
                'id' => '6',
                'name' => 'Part & Equipment Brand Name',
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
