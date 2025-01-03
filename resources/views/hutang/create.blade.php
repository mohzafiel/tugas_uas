<!DOCTYPE html>
<html>
<head>
    <title>Tambah Hutang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #ffffff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: #1e1e2f;
            padding: 40px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 400px;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 24px;
        }

        label {
            display: block;
            text-align: left;
            margin: 10px 0 5px;
            font-size: 14px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #34354a;
            border-radius: 4px;
            background-color: #292940;
            color: #ffffff;
            font-size: 14px;
            box-sizing: border-box; 
        }

        input:focus, select:focus {
            outline: none;
            border-color: #5a5aff;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #5a5aff;
            border: none;
            border-radius: 4px;
            color: #ffffff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #4a4ae5;
        }

        button:active {
            transform: scale(0.98);
        }

        .form-footer {
            margin-top: 20px;
            font-size: 14px;
        }

        .form-footer a {
            color: #5a5aff;
            text-decoration: none;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Tambah Hutang</h1>
        <form action="{{ route('hutang.store') }}" method="POST">
            @csrf
            <input type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap" required>
            <input type="date" id="tanggal" name="tanggal" required>
            <input type="number" id="nominal" name="nominal" step="0.01" placeholder="Nominal" required>
            <select id="status" name="status" placeholder="Status" required>
                <option value="Lunas">Lunas</option>
                <option value="Belum Lunas">Belum Lunas</option>
            </select>
            <br><br><br>
            <button type="submit">Simpan</button>
        </form>
        <div class="form-footer">
            <p><a href="{{ route('hutang.index') }}">Kembali ke Daftar Hutang</a></p>
        </div>
    </div>
</body>
</html>