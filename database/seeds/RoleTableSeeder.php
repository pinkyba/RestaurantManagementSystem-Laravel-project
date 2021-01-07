<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Role::create(['name' => 'admin']);
        Role::create(['name' => 'vendor']);
        Role::create(['name' => 'chef']);
        Role::create(['name' => 'waiter']);
        Role::create(['name' => 'barcounterstaff']);
        Role::create(['name' => 'cashier']);
    }
}
