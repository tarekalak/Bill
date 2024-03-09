<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{

    /**
     * List of applications to add.
     */
    private $permissions = [
        'customers',
        'customer create',
        'customer edit',
        'customer delete',
        'products',
        'product create',
        'product edit',
        'product delete',
        'bills',
        'bill create',
        'bill show',
        'bill edit',
        'bill delete',
        'users',
        'user-create',
        'user-edit',
        'user-delete',
        'roles',
        'role-create',
        'role-edit',
        'role-delete',
        'company'


    ];


    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        foreach ($this->permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create admin User and assign the role to him.
        $user = User::create([
            'name' => 'tarek_alakrami',
            'email' => 'tarek@gmail.com',
            'password' => bcrypt('123456'),
            'roles_name'=>['owner'],
            'status'=>'مفعل'
        ]);

        $role = Role::create(['name' => 'owner']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

        Company::create([
            'name_ar'=>'اسم الشركة باللغة العربية',
            'name_en'=>'your company name in english',
            'phone'=>'09########',
            'email'=>'exmple@gmail.com',
            'logo'=>'yourLogo.png',
            'location_ar'=>'موقعك باللغة العربية',
            'location_en'=>'your location in english',
        ]);
    }
}
