<?php
require '../config/db.php';
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}

if (isset($_GET['cancel'])) {
  $stmt = $conn->prepare(
    "UPDATE bookings SET status='CANCELLED' WHERE id=?"
  );
  $stmt->bind_param("i", $_GET['cancel']);
  $stmt->execute();
}
?>

<h2>Bookings</h2>

<table border="1" cellpadding="10">
<tr>
  <th>Name</th><th>Email</th><th>Module</th><th>Status</th><th>Action</th>
</tr>

<?php
$result = $conn->query("SELECT * FROM bookings");
while ($b = $result->fetch_assoc()):
?>
<tr>
  <td><?=htmlspecialchars($b['full_name'])?></td>
  <td><?=htmlspecialchars($b['email'])?></td>
  <td><?=htmlspecialchars($b['module'])?></td>
  <td><?=$b['status']?></td>
  <td>
    <a href="?cancel=<?=$b['id']?>">Cancel</a>
  </td>
</tr>
<?php endwhile; ?>
</table>
