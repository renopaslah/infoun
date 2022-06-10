@if ($isOpen)
    @include('livewire.group.create')
@else
    <div class="container">
        <div class="row mb-2">
            <div class="col">
                <button wire:click="create()" class="float-end btn btn-sm btn-primary">Tambah</button>
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $v)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>
                                            <button wire:click="edit('{{ Hashids::encode($v->id) }}')"
                                                class="btn btn-sm btn-primary">Edit</button>
                                            <button wire:click="delete('{{ Hashids::encode($v->id) }}')"
                                                class="btn btn-sm btn-warning">Hapus</button>
                                        </td>
                                        <td>{{ $v->name }}</td>
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
