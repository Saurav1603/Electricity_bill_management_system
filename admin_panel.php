<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}
require 'db.php';
$query = "SELECT * FROM bills";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Admin Dashboard</h2>
    <table border="1">
        <tr>
            <th>User ID</th>
            <th>Bill Date</th>
            <th>Units Consumed</th>
            <th>Total Amount</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['user_id']; ?></td>
            <td><?php echo $row['bill_date']; ?></td>
            <td><?php echo $row['units_consumed']; ?></td>
            <td><?php echo $row['total_amount']; ?></td>
            <td><?php echo $row['payment_status']; ?></td>
            <td>
                <form method="POST" action="update_payment.php">
                    <input type="hidden" name="bill_id" value="<?php echo $row['id']; ?>">
                    <select name="payment_status">
                        <option value="Paid">Paid</option>
                        <option value="Unpaid">Unpaid</option>
                    </select>
                    <button type="submit">Update</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>
    <a href="logout.php" class="btn btn-danger">Logout</a>
</body>
</html>
