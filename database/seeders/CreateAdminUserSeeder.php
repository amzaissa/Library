<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define all permissions
        $permissions = [
            'show all books',
            'create book',
            'edit book',
            'delete book',
            'show book',
            'show all categories',
            'create category',
            'edit category',
            'delete category',
            'show books of category',
            'add to favorite',
            'rate book'
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        // Assign permissions directly to roles
        $adminRole->givePermissionTo($permissions);
        $userRole->givePermissionTo(['show books of category', 'add to favorite', 'rate book','show book']);

        // Create admin user
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'role_name' => ["admin"],
            'status' => 'active',
        ]);

        // Assign roles directly to admin user
        $admin->assignRole($adminRole);
        
        // Create regular user
        $user = User::create([
            'name' => 'hamza',
            'email' => 'hamza@gmail.com',
            'password' => bcrypt('hamza123@'),
            'role_name' => ["user"],
            'status' => 'active',
        ]);

        // Assign roles directly to regular user
        $user->assignRole($userRole);
    }
}