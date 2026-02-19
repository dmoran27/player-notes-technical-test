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

        //Roles
        $playerRole = Role::firstOrCreate(['name' => 'player']); //Without permissions, just for role assignment
        $agentRole = Role::firstOrCreate(['name' => 'support-agent']);

        $agentRole->givePermissionTo(['manage-notes', 'view-notes']);       
        
        //Two users for testing: one agent and two player
        $agent = User::firstOrCreate([
            'name' => 'Support Agent',
            'email' => 'support@test.com',
            'password' => Hash::make('password'),
        ]);
        $agent->assignRole($agentRole);

        $player = User::firstOrCreate([
            'name' => 'Player User',
            'email' => 'player1@user.com',
            'password' => Hash::make('password'),
        ]);
        $player->assignRole($playerRole);

        $player2 = User::create([
            'name' => 'Player User 2',
            'email' => 'player2@user.com',
            'password' => Hash::make('password'),
        ]);
        $player2->assignRole($playerRole);

    }
}