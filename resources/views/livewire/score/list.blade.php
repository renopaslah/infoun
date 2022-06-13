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
            <input type="text" class="form-control" placeholder="Cari ...">
        </div>
        <div class="col-md-4">
            <button class="float-end btn btn-success">Import Nilai</button>
        </div>
    </div>
    <div class="row justify-content-center">
        @if ($isOpen)
            <div class="col-md-4">
                @include('livewire.score.create')
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
                                <th scope="col">Status</th>
                                <th scope="col">BID</th>
                                <th scope="col">MAT</th>
                                <th scope="col">BIG</th>
                                <th scope="col">T-PRO</th>
                                <th scope="col">P-PRO</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $k => $v)
                                <tr>
                                    <th scope="row">{{ $numberOfFirstRow = $numberOfFirstRow + 1 }}</th>
                                    <td>
                                        @if($v[0]->id)
                                        <button wire:click="edit('{{ Hashids::encode($v[0]->student_id) }}')" class="btn btn-sm btn-warning">Edit</button>
                                        @else
                                        <button wire:click="add('{{ Hashids::encode($v[0]->student_id) }}')" class="btn btn-sm btn-success">Tambah</button>
                                        @endif
                                    </td>
                                    <td>{{ $v[0]->name }}</td>
                                    <td></td>
                                    <td>{{ isset($v[4]->score) ? $v[4]->score : '-' }}</td>
                                    <td>{{ isset($v[3]->score) ? $v[3]->score : '-' }}</td>
                                    <td>{{ isset($v[2]->score) ? $v[2]->score : '-' }}</td>
                                    <td>{{ isset($v[1]->score) ? $v[1]->score : '-' }}</td>
                                    <td>{{ isset($v[0]->score) ? $v[0]->score : '-' }}</td>
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
                                <a class="page-link" href="#" aria-label="Previous">
                                    Previous
                                </a>
                                </li>
                                @foreach ($paginations as $k => $v)
                                    @if ($currentPage == $v)
                                        <li class="page-item active"><a class="page-link"
                                                href="#">{{ $v }}</a></li>
                                    @else
                                        <li class="page-item"><a class="page-link"
                                                href="#">{{ $v }}</a></li>
                                    @endif
                                @endforeach
                                @if ($canBeNext)
                                    <li class="page-item">
                                    @else
                                    <li class="page-item disabled">
                                @endif
                                <a class="page-link" href="#" aria-label="Next">
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
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Ya</button>
            </div>
        </div>
    </div>
</div>

</div>
