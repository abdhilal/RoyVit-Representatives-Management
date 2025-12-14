<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $warehouse = Warehouse::create([

            'name' => 'Warehouse 1',
            'location' => 'Location 1',
        ]);
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('password'),
            'warehouse_id' => $warehouse->id,
        ]);
        $warehouse->created_by = $superAdmin->id;
        $warehouse->save();
        $superAdmin = User::where('email', 'superadmin@gmail.com')->first();
        $superAdmin->assignRole('super-admin');
    }
}
