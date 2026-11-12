<?php
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $stmt = $conn->prepare("INSERT INTO feedback (name,message) VALUES (?,?)");
  $stmt->bind_param("ss", $_POST['name'], $_POST['message']);
  $stmt->execute();
}
$res = $conn->query("SELECT * FROM feedback ORDER BY id DESC");
?>
<!DOCTYPE html>
<html><head><title>Feedback</title><link rel="stylesheet" href="style.css"></head>
<body><div class="card">
  <h2>Feedback</h2>
  <form method="POST">
    <input name="name" placeholder="Your name" required>
    <textarea name="message" placeholder="Your message" required></textarea>
    <button type="submit">Send</button>
  </form>
  <?php while ($r = $res->fetch_assoc()):
    echo "<p><b>" . htmlspecialchars($r['name']) . "</b>: " . htmlspecialchars($r['message']) . "</p>";
  endwhile; ?>
</div></body></html>