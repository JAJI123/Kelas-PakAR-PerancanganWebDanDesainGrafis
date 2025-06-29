<?php session_start(); include 'koneksi.php'; ?>
<form method="post">
  Username: <input name="username"><br>
  Password: <input type="password" name="password"><br>
  <button type="submit" name="login">Login</button>
</form>

<?php
if (isset($_POST['login'])) {
  $u = $_POST['username'];
  $p = md5($_POST['password']);

  $q = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$u' AND password='$p'");
  $user = mysqli_fetch_assoc($q);

  if ($user) {
    $_SESSION['user'] = $user;
    header("Location: indeks.php");
  } else {
    echo "Login gagal.";
  }
}
?>
