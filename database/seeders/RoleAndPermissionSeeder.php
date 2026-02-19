<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        //Permissions
        Permission::firstOrCreate(['name' => 'manage-notes']);
        Permission::firstOrCreate(['name' => 'view-notes']);

        //Rol
        $playerRole = Role::firstOrCreate(['name' => 'player']); //Without permissions, just for role assignment
        $agentRole = Role::firstOrCreate(['name' => 'support-agent']);
        $viewerRole = Role::firstOrCreate(['name' => 'viewer-support']);
        

        $agentRole->givePermissionTo(['manage-notes', 'view-notes']);  
        $viewerRole->givePermissionTo('view-notes');     
        
        //Users for testing: two agent and two player
        $agent = User::firstOrCreate(
            ['email' => 'support@test.com'], // Único criterio de búsqueda
            [
                'name' => 'Support Agent',
                'password' => Hash::make('password'),
            ]
        );
        $agent->assignRole($agentRole);

        $viewer = User::firstOrCreate(
            ['email' => 'viewer@test.com'],
            [
                'name' => 'Support Viewer',
                'password' => Hash::make('password'),
            ]
        );
        $viewer->assignRole($viewerRole);

        $player = User::firstOrCreate(
            ['email' => 'player1@user.com'],
            [
                'name' => 'Player User',
                'password' => Hash::make('password'),
            ]
        );
        $player->assignRole($playerRole);

        $player2 = User::firstOrCreate(
            ['email' => 'player2@user.com'],
            [
                'name' => 'Player User 2',
                'password' => Hash::make('password'),
            ]
        );
        $player2->assignRole($playerRole);

    }
}