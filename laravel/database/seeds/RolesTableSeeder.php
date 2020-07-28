<?php

use Illuminate\Database\Seeder;
use App\Roles;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Roles::truncate();
        $roles = [
            ['God', 'all'],
            ['Owner', 'all'],
            ['Sales', 'sales'],
            ['Accountant', 'sales;purchases']
        ];

        for($i = 0; $i < sizeof($roles); $i++){
            Roles::create([
                'description' => $roles[$i][0],
                'permissions' => $roles[$i][1]
            ]);
        }
    }
}
