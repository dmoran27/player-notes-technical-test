<?php

namespace App\Repositories;

use App\Models\PlayerNote;
use Illuminate\Support\Collection;

class EloquentPlayerNoteRepository implements PlayerNoteRepositoryInterface
{
    public function getNotesByPlayer(int $playerId): Collection
    {
        return PlayerNote::where('player_id', $playerId)
            ->with('author')
            ->latest()
            ->get();
    }

    public function createNote(array $data): PlayerNote
    {
        return PlayerNote::create($data);
    }

    public function getAllNotes() : Collection
    {
        return PlayerNote::with(['author', 'player'])->latest()->get();
    }

    public function getAllPlayers() : Collection {
        return \App\Models\User::whereHas('roles', function($q) {
            $q->where('name', 'player');
        })->get();
    }
}