<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'view articles',
            'create articles',
            'edit articles',
            'delete articles',
            'write comments',
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission);
        }

        $user = Role::findOrCreate('user');
        $author = Role::findOrCreate('author');
        $admin = Role::findOrCreate('admin');

        $user->givePermissionTo([
            'view articles',
            'write comments',
        ]);

        $author->givePermissionTo([
            'view articles',
            'create articles',
            'edit articles',
        ]);

        $admin->givePermissionTo(Permission::all());
    }
}