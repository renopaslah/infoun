@if ($isOpen)
@else
    <div class="container">
        <div class="row mb-2">
            <div class="col">
                <select {{ count($groups) ? '' : 'disabled' }} wire:click="setGroup($event.target.value)"
                    class="form-select" aria-label="Default select example">
                    @foreach ($groups as $k => $v)
                        <option value="{{ Hashids::encode($v->id) }}">{{ $v->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <button class="float-end btn btn-primary">Tambah Siswa</button>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-body">
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
                                            <th scope="row">1</th>
                                            <td>
                                                <button class="btn btn-sm btn-success">Edit</button>
                                                <button class="btn btn-sm btn-warning">Hapus</button>
                                            </td>
                                            <td>{{ $v->name }}</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-warning" role="alert">
                                Data tidak tersedia.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
