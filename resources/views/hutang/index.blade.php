<!DOCTYPE html>
<html>
<head>
    <title>Daftar Hutang</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #ffffff;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        a.tambah-hutang {
            display: inline-block;
            margin: 20px 0;
            padding: 10px 20px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        a.tambah-hutang:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #1e1e2f;
            color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
        }

        thead {
            background-color: #292940;
            text-align: left;
        }

        thead th {
            padding: 15px;
            font-weight: bold;
            font-size: 14px;
        }

        tbody tr {
            border-bottom: 1px solid #34354a;
        }

        tbody tr:last-child {
            border-bottom: none;
        }

        tbody td {
            padding: 15px;
            font-size: 14px;
        }

        tbody tr:hover {
            background-color: #2d2d44;
        }

        .status {
            padding: 5px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
            text-align: center;
            display: inline-block;
        }

        .status.lunas {
            background-color: rgba(5, 250, 62, 0.7);
            color: #ffffff;
        }

        .status.hutang {
            background-color: rgba(233, 20, 20, 0.89);
            color: #ffffff;
        }

        a {
            padding: 5px 15px;
            margin: 5px;
            border-radius: 8px;
            font-size: 14px;
            color: #ffffff;
            text-decoration: none;
            display: inline-block;
            transition: all 0.2s ease;
        }

        a {
            background-color: #ffc107;
        }
        
        a:hover {
            background-color: #e0a800;
        }

        button {
            padding: 5px 15px;
            margin: 5px;
            border-radius: 8px;
            font-size: 14px;
            border: none;
            color: #ffffff;
            cursor: pointer;
            background-color: #dc3545;
        }

        button:hover {
            background-color: #b02a37;
        }

         /* Click Animation */
         a:active, button:active {
            transform: scale(0.95);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        #confirmModal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        justify-content: center;
        align-items: center;
        }

        #confirmModal div {
            background: #fff;
            padding: 30px; 
            border-radius: 8px;
            text-align: center;
            width: 400px; 
        }

        #confirmModal p {
            font-size: 18px; 
            color: #000;
            margin-bottom: 20px;
        }

        #confirmModal button {
            margin: 10px;
            padding: 10px 20px; 
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #confirmModal button#cancelButton {
            background: #6c757d;
            color: white;
        }

        #confirmModal button#confirmButton {
            background: #dc3545;
            color: white;
        }

        .chart-container {
            margin: 40px 0;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            width: 30%;
            margin: 30px auto; 
        }

        canvas {
            max-width: 100%;
            height: 70px; 
        }
    </style>
</head>
<body>
    <h1>Catatan Hutang</h1>
    <div class="container">
        <a href="{{ route('hutang.create') }}" class="tambah-hutang"><b>+</b> Tambah Hutang</a>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Tanggal</th>
                    <th>Nominal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hutang as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_lengkap }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                    <td>{{ 'Rp' . number_format($item->nominal, 0, ',', '.') }}</td>
                    <td>
                        <span class="status {{ $item->status == 'Lunas' ? 'lunas' : 'hutang' }}">
                            {{ $item->status }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('hutang.edit', $item->id) }}">Edit</a>
                        <form action="{{ route('hutang.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="deleteButton" data-id="{{ $item->id }}">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="chart-container">
            <h2>Statistik Hutang</h2>
            <canvas id="hutangChart"></canvas>
        </div>

        <div id="confirmModal">
            <div>
                <p>Apakah kamu yakin ingin menghapus data ini?</p>
                <button id="cancelButton">Batal</button>
                <button id="confirmButton">Hapus</button>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.deleteButton');
            const confirmModal = document.getElementById('confirmModal');
            const cancelButton = document.getElementById('cancelButton');
            const confirmButton = document.getElementById('confirmButton');

            let formToSubmit;

            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const form = this.closest('form');
                    formToSubmit = form;
                    confirmModal.style.display = 'flex';
                });
            });

            cancelButton.addEventListener('click', function () {
                confirmModal.style.display = 'none';
            });

            confirmButton.addEventListener('click', function () {
                if (formToSubmit) {
                    formToSubmit.submit();
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('hutangChart').getContext('2d');
            const lunasCount = {{ $hutang->where('status', 'Lunas')->count() }};
            const hutangCount = {{ $hutang->where('status', '!=', 'Lunas')->count() }};
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Lunas', 'Hutang'],
                    datasets: [{
                        data: [lunasCount, hutangCount],
                        backgroundColor: ['#05fa3e', '#e91414'],
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top'
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>