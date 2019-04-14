<?php

namespace Binthec\CmsBase\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Binthec\CmsBase\Models\User;

class UsersTableSeeder extends Seeder
{

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->truncate();
		DB::table('users')->insert([
			[
                'role' => User::SYSTEM_ADMIN,
				'name' => 'admin',
				'password' => bcrypt('aaaaaaaa'),
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now(),
			],
            [
                'role' => User::OWNER,
                'name' => 'hanako',
                'password' => bcrypt('aaaaaaaa'),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'role' => User::OPERATOR,
                'name' => 'taro',
                'password' => bcrypt('aaaaaaaa'),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
		]);
	}

}
