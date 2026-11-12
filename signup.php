<?php
include 'db.php';
$msg = ''; $cls = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $u = trim($_POST['username']);
  $e = trim($_POST['email']);
  $p = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $stmt = $conn->prepare("INSERT INTO users (username,email,password) VALUES (?,?,?)");
  $stmt->bind_param("sss", $u, $e, $p);
  try {
    $stmt->execute();
    $msg = "Registered successfully! You can now log in."; $cls = 'ok';
  } catch (mysqli_sql_exception $ex) {
    $msg = "Username already taken."; $cls = 'err';
  }
}
?>
<!DOCTYPE html>
<html><head><title>Sign Up</title><link rel="stylesheet" href="style.css"></head>
<body><div class="card">
  <h2>Sign Up</h2>
  <?php if ($msg) echo "<div class='msg $cls'>" . htmlspecialchars($msg) . "</div>"; ?>
  <form method="POST">
    <input name="username" placeholder="Username" required>
    <input name="email" type="email" placeholder="Email" required>
    <input name="password" type="password" placeholder="Password" required>
    <button type="submit">Create account</button>
  </form>
  <p class="link">Already registered? <a href="login.php">Log in</a></p>
</div></body></html>