<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    @if ($groupId)
                        Ubah Kelas
                    @else
                        Tambah Kelas
                    @endif
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="name" wire:model="name">
                    </div>
                </div>
                <div class="card-footer text-muted d-flex justify-content-between">
                    <button wire:click="closeForm()" class="btn btn-sm btn-warning">Batal</button>
                    <button wire:click.prevent="store()" class="btn btn-sm btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>
