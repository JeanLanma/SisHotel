<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'admin']);
        $manager = Role::create(['name' => 'manager']);
        $receptionist = Role::create(['name' => 'receptionist']);
        $agent = Role::create(['name' => 'agent']);
        $accountant = Role::create(['name' => 'accountant']);
        $staff = Role::create(['name' => 'staff']);

        /** Admin */
        Permission::create(['name' => 'manage.settings'])->syncRoles([$admin]);
        Permission::create(['name' => 'manage.rooms.types'])->syncRoles([$admin, $manager]);
        Permission::create(['name' => 'manage.rooms.rooms'])->syncRoles([$admin, $manager]);
        Permission::create(['name' => 'manage.rooms.status'])->syncRoles([$admin, $manager]);
        
        /** Reservations */
        Permission::create(['name' => 'manage.reservations.reservations'])->syncRoles([$admin, $manager, $receptionist]);
        Permission::create(['name' => 'manage.reservations.status'])->syncRoles([$admin, $manager, $receptionist]);
        Permission::create(['name' => 'manage.reservations.rates'])->syncRoles([$admin, $manager, $receptionist]);
        Permission::create(['name' => 'manage.reservations.payment'])->syncRoles([$admin, $manager, $receptionist]);
        Permission::create(['name' => 'manage.reservations.guests'])->syncRoles([$admin, $manager, $receptionist]);
        Permission::create(['name' => 'manage.reservations.arrivals'])->syncRoles([$admin, $manager, $receptionist]);
        Permission::create(['name' => 'manage.reservations.checkin'])->syncRoles([$admin, $manager, $receptionist]);
        Permission::create(['name' => 'manage.reservations.checkout'])->syncRoles([$admin, $manager, $receptionist]);

    }
}
