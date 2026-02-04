<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class PartnerRolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // Create Roles
        $partnerRole = Role::firstOrCreate(['name' => 'partner', 'guard_name' => 'web']);
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $customerRole = Role::firstOrCreate(['name' => 'customer', 'guard_name' => 'web']);

        // Create Permissions for Partners
        $partnerPermissions = [
            'publish.offers',
            'edit.own.offers',
            'view.own.inquiries',
            'respond.to.inquiries',
            'view.own.profile',
            'edit.own.profile',
        ];

        foreach ($partnerPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create Permissions for Admin
        $adminPermissions = [
            'manage.offers',
            'approve.offers',
            'reject.offers',
            'manage.inquiries',
            'manage.partners',
            'approve.partners',
            'view.notification.logs',
            'view.analytics',
        ];

        foreach ($adminPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create Permissions for Customers
        $customerPermissions = [
            'view.offers',
            'create.inquiry',
            'view.own.inquiries',
            'view.own.profile',
            'edit.own.profile',
        ];

        foreach ($customerPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Assign Permissions to Roles
        $partnerRole->syncPermissions($partnerPermissions);
        $adminRole->syncPermissions(array_merge($adminPermissions, $customerPermissions));
        $customerRole->syncPermissions($customerPermissions);

        $this->command->info('Partner Roles and Permissions Seeder executed successfully!');
    }
}
