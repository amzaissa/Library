<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
        //    'show books of category',
        //    'add to favorite',
        //    'rate book'
        ];
        $userPermission = [
            'show books of category',
           'add to favorite',
           'rate book'
        ];

        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
        foreach($userPermission as $userPermission){
            Permission::create(['name' => $userPermission]);
        }

        
    }
}