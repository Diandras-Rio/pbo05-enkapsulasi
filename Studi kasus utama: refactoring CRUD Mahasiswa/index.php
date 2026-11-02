<?php
require_once 'Mahasiswa.php';
require_once 'DataMahasiswa.php';
session_start();

function aman(string|int $data): string {
    return htmlspecialchars((string)$data, ENT_QUOTES, 'UTF-8');
}

$repo = new DataMahasiswa();
$error = '';
$sukses = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $m = new Mahasiswa(
            trim((string) ($_POST['nim'] ?? '')),
            trim((string) ($_POST['nama'] ?? '')),
            (int)($_POST['semester'] ?? 0),
            trim((string) ($_POST['prodi'] ?? ''))
        );
        $repo->tambah($m);
        $sukses = "Data mahasiswa berhasil disimpan!";
    } catch (InvalidArgumentException $e) {
        $error = $e->getMessage();
    }
}

$semuaData = $repo->getAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studi Kasus PBO - Enkapsulasi</title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            color: #333;
            margin: 0;
            padding: 30px 20px;
        }
        .header-title { text-align: center; margin-bottom: 30px; color: #2c3e50; }
        .container { display: flex; flex-wrap: wrap; gap: 25px; max-width: 1000px; margin: 0 auto; }
        .card {
            background-color: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
            flex: 1 1 300px;
        }
        .card-table { flex: 2 1 500px; }
        .card h3 {
            margin-top: 0;
            color: #2980b9;
            border-bottom: 2px solid #ecf0f1;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 6px; font-weight: 600; color: #555; font-size: 14px; }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-family: inherit;
        }
        input:focus { border-color: #2980b9; outline: none; }
        button {
            background-color: #2980b9;
            color: white;
            border: none;
            padding: 12px 15px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-weight: bold;
            font-size: 15px;
            margin-top: 10px;
            transition: background-color 0.3s;
        }
        button:hover { background-color: #2471a3; }
        .alert { padding: 12px; border-radius: 5px; margin-bottom: 20px; font-size: 14px; font-weight: 500; }
        .alert-error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #ecf0f1; }
        th { background-color: #f8f9fa; color: #2c3e50; font-weight: 600; }
        tr:hover { background-color: #fdfdfd; }
        .table-responsive { overflow-x: auto; }
        @media (max-width: 768px) { .container { flex-direction: column; } }
    </style>
</head>
<body>

    <h2 class="header-title">Data Mahasiswa - Studi Kasus Enkapsulasi</h2>

    <div class="container">
        <div class="card">
            <h3>Form Input Mahasiswa</h3>
            
            <?php if ($error): ?>
                <div class="alert alert-error">Error: <?= aman($error) ?></div>
            <?php endif; ?>
            
            <?php if ($sukses): ?>
                <div class="alert alert-success"><?= aman($sukses) ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <label>NIM:</label>
                    <input name="nim" type="text" placeholder="Masukkan NIM..." autocomplete="off">
                </div>
                
                <div class="form-group">
                    <label>Nama Lengkap:</label>
                    <input name="nama" type="text" placeholder="Masukkan Nama Lengkap..." autocomplete="off">
                </div>
                
                <div class="form-group">
                    <label>Semester:</label>
                    <input name="semester" type="number" placeholder="1-14">
                </div>
                
                <div class="form-group">
                    <label>Program Studi:</label>
                    <input name="prodi" type="text" placeholder="Masukkan Program Studi..." autocomplete="off">
                </div>
                
                <button type="submit">Simpan Data</button>
            </form>
        </div>

        <div class="card card-table">
            <h3>Daftar Mahasiswa (<?= count($semuaData) ?>)</h3>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>NIM</th>
                            <th>Nama Lengkap</th>
                            <th>Semester</th>
                            <th>Program Studi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($semuaData)): ?>
                            <tr>
                                <td colspan="4" style="text-align: center; color: #95a5a6; padding: 20px;">Belum ada data mahasiswa yang ditambahkan.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($semuaData as $m): ?>
                            <tr>
                                <td><strong><?= aman($m->getNim()) ?></strong></td>
                                <td><?= aman($m->getNama()) ?></td>
                                <td><?= aman($m->getSemester()) ?></td>
                                <td><?= aman($m->getProdi()) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>