@if ($isOpen)
    @include('livewire.year.create')
@else
    <div class="container">
        <div class="row">
            <div class="col">
                <button wire:click="create()" class="float-end btn btn-sm btn-primary mb-2">Tambah</button>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">Kelas</div>
                    <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert alert-primary" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Aksi</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Aktif</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $v)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>
                                            <button wire:click="change_active('{{ Hashids::encode($v->id) }}')"
                                                class="btn btn-sm btn-success">Set Aktif</button>
                                            <button wire:click="edit({{ $v->id }})"
                                                class="btn btn-sm btn-primary">Edit</button>
                                            <button wire:click="delete({{ $v->id }})"
                                                class="btn btn-sm btn-warning">Hapus</button>
                                        </td>
                                        <td>{{ $v->name }}</td>
                                        <td>{{ $active = $v->is_active ? 'Ya' : 'Tidak' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
