<?php require 'config/db.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <title>Studio Ghibli Movie Maker</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<header class="header">
  <h1>Studio Ghibli Movie Maker</h1>
</header>

<div class="container">
  <h2>Moving Castle Creations – 3D Animation Workshop</h2>

  <?php
  if (isset($_POST['submit'])) {
    $stmt = $conn->prepare(
      "INSERT INTO bookings (full_name,email,module,notes) VALUES (?,?,?,?)"
    );
    $stmt->bind_param(
      "ssss",
      $_POST['name'],
      $_POST['email'],
      $_POST['module'],
      $_POST['notes']
    );
    $stmt->execute();
    echo "<p class='success'>Booking submitted. This cannot be edited.</p>";
  } else {
  ?>

  <form method="post">
    <label>Full Name</label>
    <input name="name" required>

    <label>Email</label>
    <input type="email" name="email" required>

    <label>Module</label>
    <select name="module">
      <option>Intro to 3D Animation</option>
      <option>Character Rigging</option>
      <option>Castle Environment Design</option>
    </select>

    <label>Nice to have requests</label>
    <textarea name="notes"></textarea>

    <button name="submit">Submit Booking</button>
  </form>

  <?php } ?>
</div>

</body>
</html>
