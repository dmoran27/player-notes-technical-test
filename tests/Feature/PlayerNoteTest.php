<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

namespace Tests\Feature;

use App\Models\User;
use App\Models\Note;
use App\Livewire\PlayerNotes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PlayerNoteTest extends TestCase
{
    use RefreshDatabase;

    
    public function test_an_agent_can_create_a_note()
    {
        // 1. Preparar el escenario (Roles y Usuarios)
        $this->artisan('db:seed', ['--class' => 'RoleAndPermissionSeeder']);
        
        $agent = User::whereEmail('support@test.com')->first();
        $player = User::whereEmail('player1@test.com')->first();

        // 2. Actuar: Loguear y usar Livewire
        $this->actingAs($agent);

        Livewire::test(PlayerNotes::class)
            ->set('playerId', $player->id)
            ->set('content', 'Esta es una nota de prueba técnica.')
            ->call('saveNote')
            ->assertHasNoErrors()
            ->assertStatus(200);

        // 3. Verificar: ¿Está en la base de datos?
        $this->assertDatabaseHas('player_notes', [
            'player_id' => $player->id,
            'author_id' => $agent->id,
            'content'   => 'Esta es una nota de prueba técnica.'
        ]);
    }

    
    public function test_a_player_cannot_create_a_note()
    {
        $this->artisan('db:seed', ['--class' => 'RoleAndPermissionSeeder']);
        $player = User::whereEmail('player1@test.com')->first();

        $this->actingAs($player);

        // Intentar llamar al método saveNote debería fallar (403)
        Livewire::test(PlayerNotes::class)
            ->set('playerId', $player->id)
            ->set('content', 'Intento de hackeo')
            ->call('saveNote')
            ->assertStatus(403);
    }
}
