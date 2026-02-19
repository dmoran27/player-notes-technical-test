<?php

namespace App\Repositories;

use App\Models\PlayerNote;
use Illuminate\Support\Collection;

interface PlayerNoteRepositoryInterface
{
    public function getNotesByPlayer(int $playerId): Collection;
    
    public function createNote(array $data): PlayerNote;

    public function getAllNotes() : Collection;
    
    public function getAllPlayers() : Collection;
}