<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST["email"];
  $password = $_POST["password"];

  $email_parts = explode("@", $email);
  if (count($email_parts) == 2) {
    $correct_password = $email_parts[1];

    if ($password === $correct_password) {
      $_SESSION["email"] = $email;
      header("Location: input.php");
      exit();
    } else {
      $error = "Password salah!";
    }
  } else {
    $error = "Format email tidak valid!";
  }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: rgb(28, 51, 72);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .login-container {
      background: white;
      padding: 20px 40px;
      border-radius: 30px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      border: 1px solid #2c3e50;
      text-align: center;
    }

    h1 {
      margin-bottom: 20px;
      text-align: center;
      color: #2c3e50;
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

    input {
      width: 95%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    button {
      width: 100%;
      margin-top: 20px;
      margin-bottom: 20px;
      font-weight: bold;
      background: #2c3e50;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 30px;
      cursor: pointer;
    }

    button:hover {
      background: rgb(66, 89, 111);
    }

    .error {
      color: red;
    }
  </style>
</head>

<body>
  <div class="login-container">
    <h1>Login</h1>
    <div class="line"></div>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="post">
      <div class="input-container">
        <label for="email" class="label">Email</label>
        <input id="email" type="email" name="email" placeholder="Email" required>
      </div>
      <div class="input-container">
        <label for="password" class="label">Password</label>
        <input id="password" type="password" name="password" placeholder="Password" required>
      </div>
      <button type="submit">SUBMIT</button>
    </form>
  </div>
</body>

</html>