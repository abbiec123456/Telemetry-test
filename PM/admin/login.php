<?php require '../config/db.php'; ?>

<?php
if (isset($_POST['login'])) {
  $stmt = $conn->prepare(
    "SELECT * FROM admins WHERE username=?"
  );
  $stmt->bind_param("s", $_POST['username']);
  $stmt->execute();
  $admin = $stmt->get_result()->fetch_assoc();

  if ($admin && password_verify($_POST['password'], $admin['password_hash'])) {
    $_SESSION['admin'] = true;
    header("Location: dashboard.php");
    exit;
  }

  $error = "Invalid login";
}
?>

<form method="post">
  <h2>Admin Login</h2>
  <?php if(isset($error)) echo $error; ?>
  <input name="username" placeholder="Username">
  <input type="password" name="password" placeholder="Password">
  <button name="login">Login</button>
</form>
