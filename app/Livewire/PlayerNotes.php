<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Rule;
use App\Repositories\PlayerNoteRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PlayerNotes extends Component
{
    public ?int $playerId = null;
        
    public string $content = '';

    public bool $isRestricted = false;

    public bool $saveNotes = false;

    public function mount()
    {
        // Si el usuario tiene el rol de jugador, lanzamos un error 403 (Prohibido)
        if (auth()->user()->hasRole('player')) {
            $this->isRestricted = true;
        }

        if (Auth::user()->can('manage-notes')) {
            $this->saveNotes = true;
        }
    }

    public function render(PlayerNoteRepositoryInterface $repository): View
    {
       return view('livewire.player-notes', [
            'notes' => $repository->getAllNotes(),
            'players' => $repository->getAllPlayers()
        ]);
    }

    protected function rules(): array
    {
        return [
            'content' => 'required|string|min:5,max:1000',
            'playerId' => ['required', 'exists:users,id'],
        ];
    }

 
    public function saveNote(PlayerNoteRepositoryInterface $repository): void
    {
        if (!auth()->user()->can('manage-notes')) {
            abort(403, 'Unauthorized');
        }

        $this->validate();

        $repository->createNote([
            'player_id' => $this->playerId,
            'author_id' => Auth::id(),
            'content'   => $this->content,
        ]);

        $this->reset('content');
        session()->flash('message', 'Note saved successfully.');
    }
}