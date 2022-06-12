<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @include('livewire.subject.create')
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (session()->has('message'))
                        <div class="alert alert-primary" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Aksi</th>
                                <th scope="col">Nama</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $v)
                                @if ($v->deleted_at)
                                    <tr class="table-danger">
                                    @else
                                    <tr>
                                @endif
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>
                                    @if ($v->deleted_at)
                                        <span class="badge bg-primary">Sudah dihapus</span>
                                        <button wire:click="restore('{{ Hashids::encode($v->id) }}')"
                                            class="btn btn-sm btn-warning"><i
                                                class="bi bi-arrow-clockwise"></i></button>
                                    @else
                                        <button wire:click="edit('{{ Hashids::encode($v->id) }}')"
                                            class="btn btn-sm btn-primary">Edit</button>
                                        <button wire:click="delete('{{ Hashids::encode($v->id) }}')"
                                            class="btn btn-sm btn-warning">Hapus</button>
                                    @endif
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
