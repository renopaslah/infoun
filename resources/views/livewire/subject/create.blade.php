<div class="card">
    <div class="card-header">
        @if ($subjectId)
            Ubah Mata Uji
        @else
            Tambah Mata Uji
        @endif
    </div>
    <div class="card-body">
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">Nama</label>
            <input type="text" class="form-control" name="name" wire:model="name">
        </div>
    </div>
    <div class="card-footer text-muted d-flex justify-content-between">
        <button wire:click="resetForm()" class="btn btn-sm btn-warning">Reset</button>
        <button wire:click="store" class="btn btn-sm btn-primary">Simpan</button>
    </div>
</div>
