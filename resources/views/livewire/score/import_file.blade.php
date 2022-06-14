<table>
    <thead>
        <tr>
            <th style="text-align:center" width="25px">No</th>
            <th style="text-align:center" width="150px">Nama</th>
            <th style="text-align:center" width="80px">NISN</th>
            <th style="text-align:center" width="50px">Status</th>
            <th style="text-align:center" width="50px">BID</th>
            <th style="text-align:center" width="50px">MAT</th>
            <th style="text-align:center" width="50px">BIG</th>
            <th style="text-align:center" width="50px">T-PRO</th>
            <th style="text-align:center" width="50px">P-PRO</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $k => $v)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $v[0]->name }}</td>
                <td style="text-align:center">{{ $v[0]->nisn }}</td>
                <td style="text-align:center">{{ $v[0]->status == 1 ? 1 : 0 }}</td>
                <td style="text-align:center">{{ isset($v[4]->score) ? $v[4]->score : '0' }}</td>
                <td style="text-align:center">{{ isset($v[3]->score) ? $v[3]->score : '0' }}</td>
                <td style="text-align:center">{{ isset($v[2]->score) ? $v[2]->score : '0' }}</td>
                <td style="text-align:center">{{ isset($v[1]->score) ? $v[1]->score : '0' }}</td>
                <td style="text-align:center">{{ isset($v[0]->score) ? $v[0]->score : '0' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
