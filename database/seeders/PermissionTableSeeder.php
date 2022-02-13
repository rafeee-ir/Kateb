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
            'dashboard-visit',
            'admin',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'ticket-list',
            'ticket-create',
            'ticket-edit',
            'ticket-delete',
            'project-list',
            'project-create',
            'project-edit',
            'project-delete',
            'portfolio-list',
            'portfolio-create',
            'portfolio-edit',
            'portfolio-delete',
            'department-list',
            'department-create',
            'department-edit',
            'department-delete',
            'task-list',
            'task-create',
            'task-edit',
            'task-delete',
            'comment-list',
            'comment-create',
            'comment-edit',
            'comment-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'site-list',
            'site-create',
            'site-edit',
            'site-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
