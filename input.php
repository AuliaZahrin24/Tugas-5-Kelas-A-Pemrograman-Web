<?php
session_start();
if (!isset($_SESSION["email"])) {
  header("Location: index.php");
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  session_destroy();
  header("Location: index.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Input CV</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: rgb(28, 51, 72);
      padding: 0px 20px;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0;
    }

    .cv-container {
      margin: 20px 0px;
      background: white;
      padding: 10px 20px;
      border-radius: 30px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      border: 1px solid #2c3e50;
      text-align: center;
    }

    .header-container {
      display: flex;
      align-items: center;
      justify-content: space-between;
      border-bottom: 2px solid #ddd;
    }

    .header-container h2 {
      flex-grow: 1;
      text-align: center;
      color: #2c3e50;
      margin-right: 80px;
    }

    .box {
      display: flex;
      width: 100%;
    }

    .left,
    .right {
      flex: 1;
      background: white;
      border-radius: 10px;
      padding: 0px 10px;
    }

    .input-container {
      text-align: left;
      min-width: 400px;
    }

    .line {
      border-bottom: 4px solid #2c3e50;
      margin-bottom: 25px;
    }

    label {
      color: #2c3e50;
    }

    .notes {
      color: rgb(158, 40, 40);
      font-size: 14px;
    }

    input,
    textarea {
      width: 95%;
      padding: 10px;
      margin-bottom: 8px;
      margin-top: 4px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .input-group {
      display: flex;
      align-items: baseline;
      gap: 10px;
      margin-top: 0px;
      margin-bottom: 8px;
    }

    .group-left {
      flex: 1;
      margin-bottom: 0px;
    }

    .group-right {
      flex: 3;
      margin-bottom: 0px;
    }

    button {
      width: 100%;
      margin-top: 10px;
      margin-bottom: 10px;
      font-weight: bold;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 30px;
      cursor: pointer;
    }

    .btn-submit {
      background: #2c3e50;
    }

    .btn-logout {
      background: white;
      border-radius: 10px;
      border: 3px solid #2c3e50;
      color: #2c3e50;
    }

    .btn-submit:hover {
      background: rgb(66, 89, 111);
    }

    .btn-logout:hover {
      background: rgb(186, 197, 208);
    }

    .error {
      color: red;
    }

    @media (max-width: 768px) {
      .box {
        flex-direction: column;
        height: auto;
      }

      .left,
      .right {
        flex: none;
        width: 100%;
      }
    }
  </style>
</head>

<body>
  <div class="cv-container">
    <div class="header-container">
      <form method="post">
        <button class="btn-logout" type="submit">&larr; Logout</button>
      </form>
      <h2>Informasi CV</h2>
    </div>
    <div class="line"></div>
    <form method="post" action="cv.php" target="_blank" enctype="multipart/form-data">
      <div class="box">
        <div class="left">
          <div class="input-container">
            <label for="ttl" class="label">Tempat Tanggal Lahir</label>
            <input id="ttl" type="text" name="ttl" placeholder="tempat tanggal lahir" required>
          </div>
          <div class="input-container">
            <label for="telepon" class="label">No Telepon</label>
            <input id="telepon" type="text" name="telepon" placeholder="Masukan nomor telepon anda" required>
          </div>
          <div class="input-container">
            <label for="alamat" class="label">Alamat</label>
            <input id="alamat" type="text" name="alamat" placeholder="Alamat" required>
          </div>
          <div class="input-container">
            <label for="pendidikan" class="label">Riwayat Pendidikan</label>
            <div class="input-group">
              <input id="pendidikan" type="text" class="group-left" name="thn-1" placeholder="cth: 2019-2020" required>
              <input id="pendidikan" type="text" class="group-right" name="pendidikan-1" placeholder="riwayat pendidikan 1" required>
            </div>
            <div class="input-group">
              <input id="pendidikan" type="text" class="group-left" name="thn-2" placeholder="cth: 2019-2020">
              <input id="pendidikan" type="text" class="group-right" name="pendidikan-2" placeholder="riwayat pendidikan 2">
            </div>
            <div class="input-group">
              <input id="pendidikan" type="text" class="group-left" name="thn-3" placeholder="cth: 2019-2020">
              <input id="pendidikan" type="text" class="group-right" name="pendidikan-3" placeholder="riwayat pendidikan 3">
            </div>
            <div class="input-group">
              <input id="pendidikan" type="text" class="group-left" name="thn-4" placeholder="cth: 2019-2020">
              <input id="pendidikan" type="text" class="group-right" name="pendidikan-4" placeholder="riwayat pendidikan 4">
            </div>
          </div>
          <div class="input-container">
            <label for="keahlian" class="label">Keahlian <span class="notes">*pisahkan dengan tanda koma (,) jika lebih dari satu</span></label>
            <input id="keahlian" type="text" name="keahlian" placeholder="cth: teamwork,public speaking" required>
          </div>
          <div class="input-container">
            <label for="bahasa" class="label">Bahasa <span class="notes">*pisahkan dengan tanda koma (,) jika lebih dari satu</span></label>
            <input id="bahasa" type="text" name="bahasa" placeholder="cth: Inggris, Indonesia" required>
          </div>
        </div>
        <div class="right">
          <div class="input-container">
            <label for="nama" class="label">Nama</label>
            <input id="nama" type="text" name="nama" placeholder="Nama" required>
          </div>
          <div class="input-container">
            <label for="about" class="label">Tentang Saya</label>
            <textarea id="about" name="about" placeholder="isi deskripsi tentang anda..." required></textarea>
          </div>
          <div class="input-container">
            <label for="pengalaman" class="label">Pengalaman</label>
            <div class="input-group">
              <input id="pengalaman" type="text" class="group-left" name="judul-1" placeholder="judul" required>
              <textarea id="pengalaman" type="text" class="group-right" name="pengalaman-1" placeholder="deskripsi pengalaman" required></textarea>
            </div>
            <div class="input-group">
              <input id="pengalaman" type="text" class="group-left" name="judul-2" placeholder="judul">
              <textarea id="pengalaman" type="text" class="group-right" name="pengalaman-2" placeholder="deskripsi pengalaman"></textarea>
            </div>
            <div class="input-group">
              <input id="pengalaman" type="text" class="group-left" name="judul-3" placeholder="judul">
              <textarea id="pengalaman" type="text" class="group-right" name="pengalaman-3" placeholder="deskripsi pengalaman"></textarea>
            </div>
            <div class="input-group">
              <input id="pengalaman" type="text" class="group-left" name="judul-4" placeholder="judul">
              <textarea id="pengalaman" type="text" class="group-right" name="pengalaman-4" placeholder="deskripsi pengalaman"></textarea>
            </div>
            <div class="input-group">
              <label for="foto" class="label">Foto</label>
              <input id="foto" type="file" name="foto" placeholder="Upload Foto" required>
            </div>
          </div>
        </div>
      </div>
      <button class="btn-submit" type="submit">Simpan</button>
    </form>
  </div>
</body>

</html>