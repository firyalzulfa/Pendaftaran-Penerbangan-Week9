<?php
$bandara_asal = [
    1 => "Soekarno Hatta",
    2 => "Husein Sastranegara",
    3 => "Abdul Rachman Saleh",
    4 => "Juanda"
];

$bandara_tujuan = [
    1 => "Ngurah Rai",
    2 => "Hasanuddin",
    3 => "Inanwatan",
    4 => "Sultan Iskandar Muda"
];

function pajakBandaraAsal($kode) {
    switch ($kode) {
        case 1: return 65000;
        case 2: return 50000;
        case 3: return 40000;
        case 4: return 30000;
        default: return 0;
    }
}

function pajakBandaraTujuan($kode) {
    switch ($kode) {
        case 1: return 85000;
        case 2: return 70000;
        case 3: return 90000;
        case 4: return 60000;
        default: return 0;
    }
}

$submitted = false;
$nomor_penerbangan = rand(100000, 999999);
$tanggal_input = date("Y-m-d");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $maskapai = $_POST['maskapai'];
    $tanggal = $_POST['tanggal'];
    $asal = $_POST['asal'];
    $tujuan = $_POST['tujuan'];
    $harga = $_POST['harga'];

    $pajak_asal = pajakBandaraAsal($asal);
    $pajak_tujuan = pajakBandaraTujuan($tujuan);
    $total_pajak = $pajak_asal + $pajak_tujuan;

    $total_harga_tiket = $harga + $total_pajak;

    $submitted = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Flight Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('pesawatt.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            font-family: 'Segoe UI', sans-serif;
        }

        .blur-card {
            background: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            color: #fff;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .btn:hover {
            cursor: pointer;
            background-color: #007bff; /* Biru */
            color: #fff; /* Warna teks putih */
        }


        .form-control, .form-select {
            background-color: rgba(255, 255, 255, 0.7);
            border: none;
            color: #333;
        }

        .form-control::placeholder {
            color: #777;
        }

        .form-select option {
            color: #000;
        }

        .form-label {
            color: #fff;
            font-weight: 600;
        }

        .summary-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            color: #000;
        }

        .title {
            font-weight: bold;
            font-size: 28px;
            color: #fff;
            margin-bottom: 20px;
        }

        .btn-pesan {
            background-color: transparent;
            border: 2px solid #007bff;
            color: #007bff;
            padding: 10px 20px;
            border-radius: 8px;
            transition: background-color 0.3s, color 0.3s;
        }

        .btn-pesan:hover {
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .row.flex-wrap {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="row d-flex justify-content-center align-items-start gap-4 flex-wrap">
        <!-- Form Card -->
        <div class="col-lg-5 col-md-10 blur-card">
            <div class="title">✈ Daftarkan Penerbanganmu</div>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Nama Maskapai</label>
                    <input type="text" class="form-control" name="maskapai" placeholder="Contoh: Garuda Indonesia" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Penerbangan</label>
                    <input type="date" class="form-control" name="tanggal" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Bandara Asal</label>
                    <select class="form-select" name="asal" required>
                        <option value="">-- Pilih Bandara Asal --</option>
                        <?php foreach ($bandara_asal as $key => $bandara): ?>
                            <option value="<?= $key ?>"><?= $bandara ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Bandara Tujuan</label>
                    <select class="form-select" name="tujuan" required>
                        <option value="">-- Pilih Bandara Tujuan --</option>
                        <?php foreach ($bandara_tujuan as $key => $bandara): ?>
                            <option value="<?= $key ?>"><?= $bandara ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga Tiket</label>
                    <input type="number" class="form-control" name="harga" placeholder="Contoh: 750000" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-light px-4">Simpan Rute</button>
                </div>
            </form>
        </div>

        <!-- Summary Card -->
        <?php if ($submitted): ?>
            <div class="col-lg-5 col-md-10 summary-card">
                <div class="title text-dark">🧾 Ringkasan Penerbangan</div>
                <table class="table table-borderless text-dark">
                    <tr>
                        <th>Nomor</th>
                        <td>: <?= $nomor_penerbangan ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td>: <?= $tanggal_input ?></td>
                    </tr>
                    <tr>
                        <th>Nama Maskapai</th>
                        <td>: <?= htmlspecialchars($maskapai) ?></td>
                    </tr>
                    <tr>
                        <th>Asal Penerbangan</th>
                        <td>: <?= $bandara_asal[$asal] ?></td>
                    </tr>
                    <tr>
                        <th>Tujuan Penerbangan</th>
                        <td>: <?= $bandara_tujuan[$tujuan] ?></td>
                    </tr>
                    <tr>
                        <th>Harga Tiket</th>
                        <td>: Rp <?= number_format($harga, 0, ',', '.') ?></td>
                    </tr>
                    <tr>
                        <th>Pajak</th>
                        <td>: Rp <?= number_format($total_pajak, 0, ',', '.') ?></td>
                    </tr>
                    <tr>
                        <th>Total Harga Tiket</th>
                        <td><strong>: Rp <?= number_format($total_harga_tiket, 0, ',', '.') ?></strong></td>
                    </tr>
                </table>
                <div class="text-center mt-4">
    <button class="btn-pesan">Pesan Tiket</button>
</div>
            </div>
        <?php endif; ?>
        
    </div>
</div>
</body>
</html>