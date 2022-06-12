<div class="card">
    <form wire:submit.prevent="save">
        <div class="card-header">Import Siswa</div>
        <div class="card-body">
            <div class="d-grid gap-2 col mx-auto mb-2">
                <a href="student/download-template" type="button" class="btn btn-sm btn-info">Download Template Excel</a>
              </div>
            <input class="form-control" type="file" id="formFile" wire:model="importFile">
            @error('importFile')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="card-footer text-muted d-flex justify-content-between">
            <button wire:click="closeForm()" class="btn btn-sm btn-warning">Tutup</button>
            <button class="btn btn-sm btn-primary float-end" type="submit">Import</button>
        </div>
    </form>
</div>
