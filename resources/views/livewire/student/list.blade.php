<div class="container">
    <div class="row mb-2">
        <div class="col-md-4">
            <select {{ count($groups) ? '' : 'disabled' }} wire:click="setGroup($event.target.value)"
                class="form-select" aria-label="Default select example">
                @foreach ($groups as $k => $v)
                    <option {{ $v->id == $groupId ? 'selected' : '' }} value="{{ Hashids::encode($v->id) }}">
                        {{ $v->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <input wire:model.debounce.500ms="keyword" type="text" class="form-control" placeholder="Cari ...">
        </div>
        <div class="col-md-4">
            <button wire:click="openForm()" class="float-end btn btn-primary">Tambah Siswa</button>
            <button wire:click="openFormImport()" class="float-end btn btn-success me-md-2">Import Siswa</button>
        </div>
    </div>
    <div class="row justify-content-center">
        @if ($isOpen)
            <div class="col-md-4">
                @if ($isOpenImport)
                    @include('livewire.student.import')
                @else
                    @include('livewire.student.create')
                @endif
            </div>
            <div class="col-md-8">
            @else
                <div class="col-md-12">
        @endif

        <div class="card">
            <div class="card-body">
                @if (session()->has('message'))
                    <div class="alert alert-primary" role="alert">
                        {{ session('message') }}
                    </div>
                @endif
                @if (count($data))
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Aksi</th>
                                <th scope="col">Nama</th>
                                <th scope="col">NISN</th>
                                <th scope="col">User</th>
                                <th scope="col">Password</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $k => $v)
                                <tr>
                                    <th scope="row">{{ $numberOfFirstRow = $numberOfFirstRow + 1 }}</th>
                                    <td>
                                        <button wire:click="edit('{{ Hashids::encode($v->id) }}')"
                                            class="btn btn-sm btn-success">Edit</button>
                                        <button wire:click="setId('{{ Hashids::encode($v->id) }}')"
                                            data-bs-target="#exampleModal" data-bs-toggle="modal"
                                            class="btn btn-sm btn-warning">Hapus</button>
                                        <button class="btn btn-sm btn-danger">Reset Password</button>
                                    </td>
                                    <td>{{ $v->name }}</td>
                                    <td>{{ $v->nisn }}</td>
                                    <td>{{ $v->nis }}</td>
                                    <td>{{ $v->nisn }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="float-end">
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                @if ($canBePrev)
                                    <li class="page-item">
                                    @else
                                    <li class="page-item disabled">
                                @endif
                                <a wire:click="prev()" class="page-link" href="#" aria-label="Previous">
                                    Previous
                                </a>
                                </li>
                                @foreach ($paginations as $k => $v)
                                    @if ($currentPage == $v)
                                        <li wire:click="setPage({{ $v }})" class="page-item active"><a
                                                class="page-link" href="#">{{ $v }}</a></li>
                                    @else
                                        <li wire:click="setPage({{ $v }})" class="page-item"><a
                                                class="page-link" href="#">{{ $v }}</a></li>
                                    @endif
                                @endforeach
                                @if ($canBeNext)
                                    <li class="page-item">
                                    @else
                                    <li class="page-item disabled">
                                @endif
                                <a wire:click="next()" class="page-link" href="#" aria-label="Next">
                                    Next
                                </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                @else
                    <div class="alert alert-warning" role="alert">
                        Data tidak tersedia.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin akan menghapus siswa ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                <button wire:click="delete()" type="button" class="btn btn-primary" data-bs-dismiss="modal">Ya</button>
            </div>
        </div>
    </div>
</div>

</div>
