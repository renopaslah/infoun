<div class="card">
    <div class="card-header">
        @if ($hasScore)
            Ubah Nilai
        @else
            Atur Nilai
        @endif
    </div>
    <div class="card-body">
        <div class="d-grid col-12 gap-2 d-md-block mb-3 mx-auto">
            <label for="formGroupExampleInput" class="form-label">Status</label>
            <div>
                <button wire:click="setGraduationStatus(1)"
                    class="btn btn-sm {{ $graduationStatus == 1 ? 'btn-success' : 'btn-outline-success' }}"
                    type="button">Lulus</button>
                <button wire:click="setGraduationStatus(0)"
                    class="btn btn-sm {{ $graduationStatus == 0 ? 'btn-danger' : 'btn-outline-danger' }}"
                    type="button">Tidak
                    Lulus</button>
            </div>
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">Bahasa Indonesia</label>
            <input type="text" class="form-control" name="bidscore" wire:model="bidScore">
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">Matematika</label>
            <input type="text" class="form-control" name="bidscore" wire:model="matScore">
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">Bahasa Inggris</label>
            <input type="text" class="form-control" name="bidscore" wire:model="bigScore">
        </div>
        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="formGroupExampleInput" class="form-label">Teori Produktif</label>
                <input type="text" class="form-control" name="bidscore" wire:model="tproScore">
            </div>
            <div class="mb-3 col-md-6">
                <label for="formGroupExampleInput" class="form-label">Praktik Produktif</label>
                <input type="text" class="form-control" name="bidscore" wire:model="pproScore">
            </div>
        </div>
    </div>
    <div class="card-footer text-muted d-flex justify-content-between">
        <button wire:click="closeForm()" class="btn btn-sm btn-warning">Batal</button>
        <button wire:click.prevent="store()"" class="  btn btn-sm btn-primary">Simpan</button>
    </div>
</div>
