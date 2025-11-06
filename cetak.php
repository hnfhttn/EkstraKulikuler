<?php
// cetak.php
// Pastikan hanya bisa diakses lewat POST (form submit)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // kalau dibuka langsung, kembalikan ke index atau tampil pesan
    header('Location: index.html');
    exit;
}

// Ambil data sesuai name di form
$nama       = trim($_POST['namaLengkap'] ?? '');
$nisn       = trim($_POST['nisn'] ?? '');
$kelas      = trim($_POST['kelas'] ?? '');
$jurusan    = trim($_POST['jurusan'] ?? '');
$alamat     = trim($_POST['alamat'] ?? '');
$ekskul     = trim($_POST['ekstrakurikuler'] ?? '');

// Fungsi simple untuk mencegah XSS saat menampilkan di HTML
function e($s) {
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Bukti Pendaftaran</title>
  <style>
    body{font-family:Arial, sans-serif; background:#f4f6f8; padding:30px; text-align:center;}
    .card{background:#fff; max-width:900px; margin:0 auto; padding:25px; border-radius:8px; box-shadow:0 6px 20px rgba(0,0,0,0.08);}
    img.logo{width:80px; margin-bottom:10px;}
    h2{color:#0b5ed7; margin:0 0 6px;}
    p.sub{color:#666; margin:0 0 18px;}
    table{width:100%; border-collapse:collapse; margin-top:10px;}
    td{padding:14px 12px; border:1px solid #e0e0e0; text-align:left;}
    td:first-child{width:35%; background:#fafafa; font-weight:600;}
    .btn{display:inline-block; margin-top:22px; padding:12px 26px; background:#ffb300; color:#222; border-radius:30px; text-decoration:none; font-weight:700; border:0; cursor:pointer;}
  </style>
</head>
<body>
  <div class="card">
    <img class="logo" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTZ3tCFJt_WIIE0XsfNEccryA7oyGBhqDomtQ&s" alt="logo"><br>
    <h2>Bukti Pendaftaran Ekstrakurikuler</h2>
    <p class="sub">SMK Negeri 9 Semarang</p>

    <table>
      <tr><td>Nama Lengkap</td><td><?= e($nama) ?></td></tr>
      <tr><td>NISN</td><td><?= e($nisn) ?></td></tr>
      <tr><td>Kelas & Jurusan</td><td><?= e($kelas . ' ' . $jurusan) ?></td></tr>
      <tr><td>Alamat</td><td><?= nl2br(e($alamat)) ?></td></tr>
      <tr><td>Ekstrakurikuler</td><td><?= e($ekskul) ?></td></tr>
    </table>

    <!-- Kirim lagi data ke download.php untuk generate PDF (buka di tab baru) -->
    <form action="download.php" method="POST" target="_blank" style="margin-top:18px;">
      <input type="hidden" name="namaLengkap" value="<?= e($nama) ?>">
      <input type="hidden" name="nisn" value="<?= e($nisn) ?>">
      <input type="hidden" name="kelas" value="<?= e($kelas) ?>">
      <input type="hidden" name="jurusan" value="<?= e($jurusan) ?>">
      <input type="hidden" name="alamat" value="<?= e($alamat) ?>">
      <input type="hidden" name="ekstrakurikuler" value="<?= e($ekskul) ?>">
      <button type="submit" class="btn">📄 Cetak PDF</button>
    </form>
  </div>
</body>
</html>
