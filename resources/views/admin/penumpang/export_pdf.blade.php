<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekap Data Penumpang</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #333; padding: 4px 6px; text-align: left; }
        th { background: #f0f0f0; }
        h1 { font-size: 18px; margin-bottom: 4px; }
    </style>
</head>
<body>
    <h1>Rekap Data Penumpang</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Lokasi</th>
                <th>Jenis</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $row)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($row->tanggal)->format('d/m/Y') }}</td>
                    <td>{{ $row->lokasi }}</td>
                    <td>{{ ucfirst($row->jenis) }}</td>
                    <td>{{ $row->jumlah }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
