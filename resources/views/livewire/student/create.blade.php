<div class="card">
    <div class="card-header">
        @if ($profileId)
            Ubah Siswa
        @else
            Tambah Siswa
        @endif
    </div>
    <div class="card-body">
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">Nama</label>
            <input type="text" class="form-control" name="name" wire:model="name">
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">NISN</label>
            <input type="text" class="form-control" name="nisn" wire:model="nisn">
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">NIS</label>
            <input type="text" class="form-control" name="nisn" wire:model="nis">
        </div>
    </div>
    <div class="card-footer text-muted d-flex justify-content-between">
        <button wire:click="closeForm()" class="btn btn-sm btn-warning">Tutup</button>
        <button wire:click.prevent="store()"" class="btn btn-sm btn-primary">Simpan</button>
    </div>
</div>