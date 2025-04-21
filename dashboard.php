<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require 'db.php';

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM bills WHERE user_id='$user_id'";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Welcome to your Dashboard</h2>

    <!-- Generate Bill Button -->
    <form action="generate_bill.php" method="POST">
        <button type="submit" class="btn btn-primary">Generate Bill</button>
    </form>

    <table border="1">
        <tr>
            <th>Bill Date</th>
            <th>Units Consumed</th>
            <th>Total Amount</th>
            <th>Status</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['bill_date']; ?></td>
            <td><?php echo $row['units_consumed']; ?></td>
            <td><?php echo $row['total_amount']; ?></td>
            <td><?php echo $row['payment_status']; ?></td>
        </tr>
        <?php } ?>
    </table>
    <a href="logout.php" class="btn btn-danger">Logout</a>
</body>
</html>
