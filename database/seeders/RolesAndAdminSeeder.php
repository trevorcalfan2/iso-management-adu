<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesAndAdminSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['SystemAdmin','QualityManager','ProcessOwner','AreaAssistant','Auditor','Reader'];
        foreach ($roles as $r) Role::firstOrCreate(['name'=>$r]);

        $admin = User::firstOrCreate(
            ['email' => 'admin@local.test'],
            ['name' => 'Admin', 'password' => Hash::make('Admin12345!')]
        );
        $admin->assignRole('SystemAdmin');
        $admin->markEmailAsVerified();
    }
}