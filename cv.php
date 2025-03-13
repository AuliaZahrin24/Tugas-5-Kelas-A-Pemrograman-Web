<?php
session_start();
if (!isset($_SESSION["email"])) {
  header("Location: index.php");
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nama = htmlspecialchars($_POST['nama']);
  $email = $_SESSION["email"];
  $ttl = htmlspecialchars($_POST['ttl']);
  $telepon = htmlspecialchars($_POST['telepon']);
  $alamat = htmlspecialchars($_POST['alamat']);
  $about = htmlspecialchars($_POST['about']);

  $pendidikan = [];
  if (!empty($_POST['thn-1']) && !empty($_POST['pendidikan-1'])) {
    $pendidikan[] = ["tahun" => htmlspecialchars($_POST['thn-1']), "riwayat" => htmlspecialchars($_POST['pendidikan-1'])];
  }
  if (!empty($_POST['thn-2']) && !empty($_POST['pendidikan-2'])) {
    $pendidikan[] = ["tahun" => htmlspecialchars($_POST['thn-2']), "riwayat" => htmlspecialchars($_POST['pendidikan-2'])];
  }
  if (!empty($_POST['thn-3']) && !empty($_POST['pendidikan-3'])) {
    $pendidikan[] = ["tahun" => htmlspecialchars($_POST['thn-3']), "riwayat" => htmlspecialchars($_POST['pendidikan-3'])];
  }
  if (!empty($_POST['thn-4']) && !empty($_POST['pendidikan-4'])) {
    $pendidikan[] = ["tahun" => htmlspecialchars($_POST['thn-4']), "riwayat" => htmlspecialchars($_POST['pendidikan-4'])];
  }

  $keahlian = array_map('trim', explode(',', $_POST['keahlian']));
  $bahasa = array_map('trim', explode(',', $_POST['bahasa']));

  $pengalaman = [];
  for ($i = 1; $i <= 4; $i++) {
    if (!empty($_POST["judul-$i"]) && !empty($_POST["pengalaman-$i"])) {
      $pengalaman[] = [
        "judul" => htmlspecialchars($_POST["judul-$i"]),
        "deskripsi" => htmlspecialchars($_POST["pengalaman-$i"])
      ];
    }
  }

  $gambarBase64 = '';
  if (!empty($_FILES['foto']['tmp_name'])) {
    $gambarData = file_get_contents($_FILES['foto']['tmp_name']);
    $gambarBase64 = 'data:' . mime_content_type($_FILES['foto']['tmp_name']) . ';base64,' . base64_encode($gambarData);
  }
} else {
  header("Location: input.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CV Novrila Aulia Zahrin</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 10px;
      padding: 0;
      background-color: #f4f4f4;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .container {
      width: 850px;
      display: flex;
      background-color: white;
      box-shadow: 0px 0px 10px rgba(69, 112, 223, 0.1);
      border-radius: 8px;
      overflow: hidden;
    }

    .sidebar {
      width: 30%;
      background-color:rgb(70, 140, 168);
      opacity: 0.9;
      color: white;
      padding: 20px;
    }

    .content {
      width: 70%;
      padding: 30px;
    }

    .photo {
      text-align: center;
      margin-bottom: 20px;
    }

    .photo img {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
    }

    h1 {
      font-size: 30px;
      text-transform: uppercase;
      margin-bottom: 20px;
      color: #2c3e50;
    }

    h2 {
      font-size: 20px;
      margin-bottom: 10px;
      color: #121213;
      border-bottom: 2px solid #2c3e50;
      padding-bottom: 5px;
    }

    p,
    span {
      font-size: 16px;
      line-height: 1.8;
      margin: 15px 0;
    }

    .section {
      margin-bottom: 20px;
    }

    .list-item {
      margin-bottom: 15px;
    }

    .bold {
      font-weight: bold;
    }

    .experience-list li {
      font-size: 14px;
      line-height: 1.2;
    }

    .skill-list {
      list-style-type: disc;
      padding: 20px;
      margin: 0;
    }

    .skill-list li {
      margin-bottom: 10px;
      font-size: 14px;
      font-weight: bold;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="sidebar">
      <div class="photo">
        <?php if (!empty($gambarBase64)): ?>
          <img src="<?= $gambarBase64 ?>" alt="Foto Profil">
        <?php endif; ?>
      </div>
      <div class="section">
        <h2>Informasi Pribadi </h2>
        <p class="bold">Email:</p>
        <p><?= $email ?></p>
        <p class="bold">Telepon:</p>
        <p><?= $telepon ?></p>
        <p class="bold">Alamat:</p>
        <p><?= $alamat ?></p>
        <p class="bold">TTL:</p>
        <p><?= $ttl ?></p>
      </div>
      <div class="section">
    <h2>Pendidikan</h2>
  <?php foreach ($pendidikan as $edu) : ?>
    <div class="list-item" style="margin-bottom: 20px;"> 
      <span class="bold"><?= $edu['tahun'] ?></span><br>
      <span><?= $edu['riwayat'] ?></span>
    </div>
  <?php endforeach; ?>
</div>
      <div class="section">
        <h2>Bahasa</h2>
        <?php foreach ($bahasa as $lang) : ?>
          <li><span class="bold"> <?= $lang ?></span></li>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="content">
  <h1><?= $nama ?></h1>
  <div class="section">
    <h2>Tentang Saya</h2>
    <p><?= nl2br($about) ?></p>
      <div class="section">
        <h2>Pengalaman</h2>
        <ul class="experience-list">
          <?php foreach ($pengalaman as $exp) : ?>
            <li><span class="bold"> <?= $exp['judul'] ?> </span></li>
            <p><?= $exp['deskripsi'] ?></p>
          <?php endforeach; ?>
        </ul>
      </div>
      <div class="section">
  <h2>Keahlian</h2>
  <ul class="skill-list">
    <?php foreach ($keahlian as $skill) : ?>
      <li><span><?= $skill ?></span></li> 
        <?php endforeach; ?>
      </ul>
      </div>
    </div>
  </div>
</body>

</html>