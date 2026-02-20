<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Produk</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 20px;
        }

        h1 {
            font-size: 28px;
            color: #2c3e50;
            margin: 0;
        }

        .btn-primary {
            background-color: #2ecc71;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: background-color 0.3s ease;
            display: inline-block;
        }

        .btn-primary:hover {
            background-color: #27ae60;
        }

        .alert-success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 12px 16px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        thead {
            background-color: #34495e;
            color: white;
        }

        th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #ecf0f1;
        }

        tbody tr:hover {
            background-color: #f8f9fa;
        }

        .actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .btn-edit {
            background-color: #3498db;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 3px;
            text-decoration: none;
            cursor: pointer;
            font-size: 12px;
            transition: background-color 0.3s ease;
            display: inline-block;
        }

        .btn-edit:hover {
            background-color: #2980b9;
        }

        .btn-delete {
            background-color: #e74c3c;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 12px;
            transition: background-color 0.3s ease;
        }

        .btn-delete:hover {
            background-color: #c0392b;
        }

        .form-delete {
            display: inline;
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #7f8c8d;
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            table {
                font-size: 13px;
            }

            th, td {
                padding: 10px;
            }

            .actions {
                flex-direction: column;
            }

            .btn-edit, .btn-delete {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Daftar Produk</h1>
            <a href="{{ route('produk.create') }}" class="btn-primary">Tambah Produk</a>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert-success">
                {{ $message }}
            </div>
        @endif

        @if ($produks->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produks as $p)
                        <tr>
                            <td><strong>{{ $p->nama }}</strong></td>
                            <td>{{ $p->deskripsi }}</td>
                            <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('produk.edit', $p->id) }}" class="btn-edit">Edit</a>
                                    <form action="{{ route('produk.destroy', $p->id) }}" method="POST" class="form-delete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete" onclick="return confirm('Yakin ingin menghapus data produk ini?')">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="empty-state">
                <p>Belum ada data produk. <a href="{{ route('produk.create') }}">Buat produk baru</a></p>
            </div>
        @endif
    </div>
</body>
</html>