<div>
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0">New Note for Player</h5>
        </div>
        <div class="card-body">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form wire:submit.prevent="saveNote">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Select Player</label>
                        <select wire:model="playerId" class="form-select @error('playerId') is-invalid @enderror">
                            <option value="">-- Select --</option>
                            @foreach($players as $player)
                                <option value="{{ $player->id }}">{{ $player->name }}</option>
                            @endforeach
                        </select>
                        @error('playerId') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-8">
                        <label class="form-label fw-bold">Note / Observation</label>
                        <textarea wire:model="content" class="form-control @error('content') is-invalid @enderror" rows="1" placeholder="Write here..."></textarea>
                        @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mt-3 text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Save Note
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0">Notes History</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Date</th>
                        <th>Player (Target)</th>
                        <th>Author (Created by)</th>
                        <th>Content</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($notes as $note)
                        <tr>
                            <td>{{ $note->created_at->format('d/m/Y H:i') }}</td>
                            <td class="fw-bold">{{ $note->player->name }}</td>
                            <td>{{ $note->author->name }}</td>
                            <td>{{ $note->content }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">No notes available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>